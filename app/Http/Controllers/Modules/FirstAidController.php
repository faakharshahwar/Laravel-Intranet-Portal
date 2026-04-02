<?php

namespace App\Http\Controllers\Modules;

use App\Exports\FirstAidExport;
use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FirstAidRequest;
use App\Imports\FirstAidImport;
use App\Mail\FirstAidMail;
use App\Models\Modules\FirstAids;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;

class FirstAidController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = FirstAids::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $first_aids = $query->get();

        return view('modules.first_aid.first_aid')->with('siteArr', $siteArr)
            ->with('first_aids', $first_aids)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];

        return view('modules.first_aid.create_first_aid')
            ->with('siteArr', $siteArr);
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $first_aid = FirstAids::find($id);

        return view('modules.first_aid.read_first_aid')
            ->with('first_aid', $first_aid)
            ->with('siteArr', $siteArr);
    }

    public function store(FirstAidRequest $request)
    {
        $site = $request->site;
        $item_name = $request->item_name;
        $description = $request->description;
        $production_date = $request->production_date;
        $expiry_date = $request->expiry_date;
        $required_quantity = $request->required_quantity;
        $available_quantity = $request->available_quantity;

        $first_aid = FirstAids::create([
            'site' => $site,
            'item_name' => $item_name,
            'description' => $description,
            'production_date' => $production_date,
            'expiry_date' => $expiry_date,
            'required_quantity' => $required_quantity,
            'available_quantity' => $available_quantity,
        ]);

        if ($first_aid) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('first_aid'));
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $first_aid = FirstAids::find($id);

        return view('modules.first_aid.edit_first_aid')
            ->with('first_aid', $first_aid)
            ->with('siteArr', $siteArr);
    }

    public function update(FirstAidRequest $request)
    {
        $id = $request->id;
        $site = $request->site;
        $item_name = $request->item_name;
        $description = $request->description;
        $production_date = $request->production_date;
        $expiry_date = $request->expiry_date;
        $required_quantity = $request->required_quantity;
        $available_quantity = $request->available_quantity;

        $first_aid = DB::table('first_aids')
            ->where('id', $id)
            ->update([
                'site' => $site,
                'item_name' => $item_name,
                'description' => $description,
                'production_date' => $production_date,
                'expiry_date' => $expiry_date,
                'required_quantity' => $required_quantity,
                'available_quantity' => $available_quantity,
            ]);

        if ($first_aid) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('first_aid'));
    }

    public function delete($id)
    {
        $first_aid = FirstAids::find($id);
        $first_aidDel = $first_aid->delete();

        if ($first_aidDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('first_aid'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $first_aid = FirstAids::find($id);

        return view('modules.first_aid.print_first_aid')
            ->with('first_aid', $first_aid)
            ->with('siteArr', $siteArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $first_aid = FirstAids::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.first_aid.mail_first_aid')
            ->with('first_aid', $first_aid)
            ->with('users', $users)
            ->with('siteArr', $siteArr);
    }

    public function send_email(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'recipient' => 'required',
        ]);

        $options = dynamicOptions();
        $site_urlArr = $options['site_url'];

        $id = $request->id;

        $base_url = $site_urlArr['base_url'];
        $personal_message = $request->personal_message;

        $first_aid = FirstAids::find($id);

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'site' => $first_aid->site,
            'item_name' => $first_aid->item_name,
            'description' => $first_aid->description,
            'production_date' => $first_aid->production_date,
            'expiry_date' => $first_aid->expiry_date,
            'required_quantity' => $first_aid->required_quantity,
            'available_quantity' => $first_aid->available_quantity,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new FirstAidMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('first_aid'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new FirstAidExport, 'first_aid.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new FirstAidImport, $path);

                session()->flash('success', 'First Aid has been imported successfully');
                return redirect(route('first_aid'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('first_aid'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('first_aid'));
    }
}
