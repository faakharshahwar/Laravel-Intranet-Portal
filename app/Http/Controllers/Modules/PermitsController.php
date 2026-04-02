<?php

namespace App\Http\Controllers\Modules;

use App\Exports\PermitsExport;
use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermitsRequest;
use App\Imports\PermitsImport;
use App\Mail\PermitMail;
use App\Models\Modules\Permits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;

class PermitsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $query = Permits::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $permits = $query->get();

        return view('modules.permits.permits')
            ->with('siteArr', $siteArr)
            ->with('permits', $permits)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $agencyTypeArr = $options['agency_type'];

        return view('modules.permits.create_permit')
            ->with('agencyTypeArr', $agencyTypeArr)
            ->with('siteArr', $siteArr);
    }

    public function store(PermitsRequest $request)
    {
        $site = $request->site;
        $permit_type = $request->permit_type;
        $permit_id = $request->permit_id;
        $agency_type = $request->agency_type;
        $agency_name = $request->agency_name;
        $expiration_date = $request->expiration_date;
        $monthly_requirements = $request->monthly_requirements;
        $quarterly_requirements = $request->quarterly_requirements;
        $annual_requirements = $request->annual_requirements;
        $comments = $request->comments;

        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $attachment = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/permits';

            // Upload file
            $file->move($file_location, $attachment);
        } else {
            $attachment = "";
        }

        if ($request->file('copy_of_permit')) {
            $file = $request->file('copy_of_permit');
            $copy_of_permit = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/permits';

            // Upload file
            $file->move($file_location, $copy_of_permit);
        } else {
            $copy_of_permit = "";
        }

        $permit = Permits::create([
            'site' => $site,
            'permit_type' => $permit_type,
            'permit_id' => $permit_id,
            'agency_type' => $agency_type,
            'agency_name' => $agency_name,
            'expiration_date' => $expiration_date,
            'monthly_requirements' => $monthly_requirements,
            'quarterly_requirements' => $quarterly_requirements,
            'annual_requirements' => $annual_requirements,
            'comments' => $comments,
            'attachment' => $attachment,
            'copy_of_permit' => $copy_of_permit,
        ]);

        if ($permit) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('permits'));

    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $agencyTypeArr = $options['agency_type'];

        $permit = Permits::find($id);

        return view('modules.permits.read_permit')
            ->with('agencyTypeArr', $agencyTypeArr)
            ->with('permit', $permit)
            ->with('siteArr', $siteArr);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $agencyTypeArr = $options['agency_type'];

        $permit = Permits::find($id);

        return view('modules.permits.edit_permit')
            ->with('agencyTypeArr', $agencyTypeArr)
            ->with('permit', $permit)
            ->with('siteArr', $siteArr);
    }

    public function update(PermitsRequest $request)
    {
        $id = $request->id;
        $site = $request->site;
        $permit_type = $request->permit_type;
        $permit_id = $request->permit_id;
        $agency_type = $request->agency_type;
        $agency_name = $request->agency_name;
        $expiration_date = $request->expiration_date;
        $monthly_requirements = $request->monthly_requirements;
        $quarterly_requirements = $request->quarterly_requirements;
        $annual_requirements = $request->annual_requirements;
        $comments = $request->comments;

        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $attachment = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/permits';

            // Upload file
            $file->move($file_location, $attachment);
        } else {
            $attachment = $request->old_attachment;
        }

        if ($request->file('copy_of_permit')) {
            $file = $request->file('copy_of_permit');
            $copy_of_permit = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/permits';

            // Upload file
            $file->move($file_location, $copy_of_permit);
        } else {
            $copy_of_permit = $request->old_copy_of_permit;
        }

        $permit = DB::table('permits')
            ->where('id', $id)
            ->update([
                'site' => $site,
                'permit_type' => $permit_type,
                'permit_id' => $permit_id,
                'agency_type' => $agency_type,
                'agency_name' => $agency_name,
                'expiration_date' => $expiration_date,
                'monthly_requirements' => $monthly_requirements,
                'quarterly_requirements' => $quarterly_requirements,
                'annual_requirements' => $annual_requirements,
                'comments' => $comments,
                'attachment' => $attachment,
                'copy_of_permit' => $copy_of_permit,
            ]);

        if ($permit) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('permits'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $agencyTypeArr = $options['agency_type'];

        $permit = Permits::find($id);

        return view('modules.permits.print_permit')
            ->with('agencyTypeArr', $agencyTypeArr)
            ->with('permit', $permit)
            ->with('siteArr', $siteArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $agencyTypeArr = $options['agency_type'];

        $permit = Permits::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.permits.mail_permit')
            ->with('agencyTypeArr', $agencyTypeArr)
            ->with('permit', $permit)
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

        $permit = Permits::find($id);

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'site' => $permit->site,
            'permit_type' => $permit->permit_type,
            'permit_id' => $permit->permit_id,
            'agency_type' => $permit->agency_type,
            'agency_name' => $permit->agency_name,
            'expiration_date' => $permit->expiration_date,
            'attachment' => $permit->attachment,
            'copy_of_permit' => $permit->copy_of_permit,
            'monthly_requirements' => $permit->monthly_requirements,
            'quarterly_requirements' => $permit->quarterly_requirements,
            'annual_requirements' => $permit->annual_requirements,
            'comments' => $permit->comments,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new PermitMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('permits'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new PermitsExport, 'permits.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new PermitsImport, $path);

                session()->flash('success', 'Permits has been imported successfully');
                return redirect(route('permits'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('permits'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('permits'));
    }
}
