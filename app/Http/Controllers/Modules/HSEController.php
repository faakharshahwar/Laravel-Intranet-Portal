<?php

namespace App\Http\Controllers\Modules;

use App\Exports\HseExport;
use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Imports\HseImport;
use App\Mail\HSEMail;
use App\Models\Modules\Hse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;

class HSEController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = Hse::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $hses = $query->get();

        return view('modules.hse.hse')
            ->with('siteArr', $siteArr)
            ->with('hses', $hses)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];

        return view('modules.hse.create_hse')
            ->with('siteArr', $siteArr);
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $hse = Hse::find($id);

        return view('modules.hse.read_hse')
            ->with('hse', $hse)
            ->with('siteArr', $siteArr);
    }

    public function store(Request $request)
    {
        $for_month_starting = $request->for_month_starting;
        $site = $request->site;
        $num_of_first_aids = $request->num_of_first_aids;
        $num_of_near_misses = $request->num_of_near_misses;
        $num_of_safety_violations = $request->num_of_safety_violations;
        $num_of_medical_cases = $request->num_of_medical_cases;
        $num_of_restricted_cases = $request->num_of_restricted_cases;
        $num_of_lost_time_cases = $request->num_of_lost_time_cases;
        $num_of_recordable_cases = $request->num_of_recordable_cases;
        $num_of_environmental_issues = $request->num_of_environmental_issues;
        $comments = $request->comments;

        $hse = Hse::create([
            'for_month_starting' => $for_month_starting,
            'site' => $site,
            'num_of_first_aids' => $num_of_first_aids,
            'num_of_near_misses' => $num_of_near_misses,
            'num_of_safety_violations' => $num_of_safety_violations,
            'num_of_medical_cases' => $num_of_medical_cases,
            'num_of_restricted_cases' => $num_of_restricted_cases,
            'num_of_lost_time_cases' => $num_of_lost_time_cases,
            'num_of_recordable_cases' => $num_of_recordable_cases,
            'num_of_environmental_issues' => $num_of_environmental_issues,
            'comments' => $comments,
        ]);

        if ($hse) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('hse'));
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $hse = Hse::find($id);

        return view('modules.hse.edit_hse')
            ->with('hse', $hse)
            ->with('siteArr', $siteArr);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $for_month_starting = $request->for_month_starting;
        $site = $request->site;
        $num_of_first_aids = $request->num_of_first_aids;
        $num_of_near_misses = $request->num_of_near_misses;
        $num_of_safety_violations = $request->num_of_safety_violations;
        $num_of_medical_cases = $request->num_of_medical_cases;
        $num_of_restricted_cases = $request->num_of_restricted_cases;
        $num_of_lost_time_cases = $request->num_of_lost_time_cases;
        $num_of_recordable_cases = $request->num_of_recordable_cases;
        $num_of_environmental_issues = $request->num_of_environmental_issues;
        $comments = $request->comments;

        $hse = DB::table('hses')
            ->where('id', $id)
            ->update([
                'for_month_starting' => $for_month_starting,
                'site' => $site,
                'num_of_first_aids' => $num_of_first_aids,
                'num_of_near_misses' => $num_of_near_misses,
                'num_of_safety_violations' => $num_of_safety_violations,
                'num_of_medical_cases' => $num_of_medical_cases,
                'num_of_restricted_cases' => $num_of_restricted_cases,
                'num_of_lost_time_cases' => $num_of_lost_time_cases,
                'num_of_recordable_cases' => $num_of_recordable_cases,
                'num_of_environmental_issues' => $num_of_environmental_issues,
                'comments' => $comments,
            ]);

        if ($hse) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('hse'));
    }

    public function delete($id)
    {
        $hse = Hse::find($id);
        $hseDel = $hse->delete();

        if ($hseDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('hse'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $hse = Hse::find($id);

        return view('modules.hse.print_hse')
            ->with('hse', $hse)
            ->with('siteArr', $siteArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $hse = Hse::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.hse.mail_hse')
            ->with('hse', $hse)
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

        $hse = Hse::find($id);

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'for_month_starting' => $hse->for_month_starting,
            'site' => $hse->site,
            'num_of_first_aids' => $hse->num_of_first_aids,
            'num_of_near_misses' => $hse->num_of_near_misses,
            'num_of_safety_violations' => $hse->num_of_safety_violations,
            'num_of_medical_cases' => $hse->num_of_medical_cases,
            'num_of_restricted_cases' => $hse->num_of_restricted_cases,
            'num_of_lost_time_cases' => $hse->num_of_lost_time_cases,
            'num_of_recordable_cases' => $hse->num_of_recordable_cases,
            'num_of_environmental_issues' => $hse->num_of_environmental_issues,
            'comments' => $hse->comments,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new HSEMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('hse'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new HseExport, 'hse.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new HseImport, $path);

                session()->flash('success', 'HSE has been imported successfully');
                return redirect(route('hse'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('hse'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('hse'));
    }
}
