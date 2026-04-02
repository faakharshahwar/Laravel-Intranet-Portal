<?php

namespace App\Http\Controllers\Modules;

use App\Exports\EfrsExport;
use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EfrRequest;
use App\Imports\EfrsImport;
use App\Mail\EFRsMail;
use App\Models\Modules\Efr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;

class EFRController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $query = Efr::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $efrs = $query->get();

        return view('modules.efrs.efrs')
            ->with('siteArr', $siteArr)
            ->with('efrs', $efrs)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $typeArr = $options['efr_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.efrs.create_efr')
            ->with('users', $users)
            ->with('typeArr', $typeArr)
            ->with('siteArr', $siteArr);
    }

    public function store(EfrRequest $request)
    {
        $site = $request->site;
        $type = $request->type;
        $interested_party = $request->interested_party;
        $ip_location = $request->ip_location;
        $ip_contact = $request->ip_contact;
        $ip_contact_telephone = $request->ip_contact_telephone;
        $feedback = $request->feedback;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $action_taken = $request->action_taken;
        $completed_by = $request->completed_by;
        $feedback_to_ip = $request->feedback_to_ip;
        $feedback_to_ip_by = $request->feedback_to_ip_by;
        $date_of_feedback = $request->date_of_feedback;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        $efr = Efr::create([
            'site' => $site,
            'type' => $type,
            'interested_party' => $interested_party,
            'ip_location' => $ip_location,
            'ip_contact' => $ip_contact,
            'ip_contact_telephone' => $ip_contact_telephone,
            'feedback' => $feedback,
            'originator' => $originator,
            'date_originated' => $date_originated,
            'action_taken' => $action_taken,
            'completed_by' => $completed_by,
            'feedback_to_ip' => $feedback_to_ip,
            'feedback_to_ip_by' => $feedback_to_ip_by,
            'date_of_feedback' => $date_of_feedback,
            'closed_by' => $closed_by,
            'closure_date' => $closure_date,
        ]);

        if ($efr) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('efrs'));

    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $typeArr = $options['efr_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $efr = Efr::find($id);

        return view('modules.efrs.read_efr')
            ->with('users', $users)
            ->with('efr', $efr)
            ->with('typeArr', $typeArr)
            ->with('siteArr', $siteArr);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $typeArr = $options['efr_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $efr = Efr::find($id);

        return view('modules.efrs.edit_efr')
            ->with('users', $users)
            ->with('efr', $efr)
            ->with('typeArr', $typeArr)
            ->with('siteArr', $siteArr);
    }

    public function update(EfrRequest $request)
    {
        $id = $request->id;
        $site = $request->site;
        $type = $request->type;
        $interested_party = $request->interested_party;
        $ip_location = $request->ip_location;
        $ip_contact = $request->ip_contact;
        $ip_contact_telephone = $request->ip_contact_telephone;
        $feedback = $request->feedback;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $action_taken = $request->action_taken;
        $completed_by = $request->completed_by;
        $feedback_to_ip = $request->feedback_to_ip;
        $feedback_to_ip_by = $request->feedback_to_ip_by;
        $date_of_feedback = $request->date_of_feedback;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        $efr = DB::table('efrs')
            ->where('id', $id)
            ->update([
                'site' => $site,
                'type' => $type,
                'interested_party' => $interested_party,
                'ip_location' => $ip_location,
                'ip_contact' => $ip_contact,
                'ip_contact_telephone' => $ip_contact_telephone,
                'feedback' => $feedback,
                'originator' => $originator,
                'date_originated' => $date_originated,
                'action_taken' => $action_taken,
                'completed_by' => $completed_by,
                'feedback_to_ip' => $feedback_to_ip,
                'feedback_to_ip_by' => $feedback_to_ip_by,
                'date_of_feedback' => $date_of_feedback,
                'closed_by' => $closed_by,
                'closure_date' => $closure_date,
            ]);

        if ($efr) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('efrs'));
    }

    public function delete($id)
    {
        $efr = Efr::find($id);
        $eft_del = $efr->delete();

        if ($eft_del) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('efrs'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $typeArr = $options['efr_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        $efr = Efr::find($id);

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $originator = User::find($efr->originator);
        if ($originator) {
            $originator = $originator->first_name . " " . $originator->last_name;
        } else {
            $originator = "";
        }

        $completed_by = User::find($efr->completed_by);
        if ($completed_by) {
            $completed_by = $completed_by->first_name . " " . $completed_by->last_name;
        } else {
            $completed_by = "";
        }

        $feedback_to_ip_by = User::find($efr->feedback_to_ip_by);
        if ($feedback_to_ip_by) {
            $feedback_to_ip_by = $feedback_to_ip_by->first_name . " " . $feedback_to_ip_by->last_name;
        } else {
            $feedback_to_ip_by = "";
        }

        $closed_by = User::find($efr->closed_by);
        if ($closed_by) {
            $closed_by = $closed_by->first_name . " " . $closed_by->last_name;
        } else {
            $closed_by = "";
        }

        return view('modules.efrs.print_efr')
            ->with('users', $users)
            ->with('originator', $originator)
            ->with('completed_by', $completed_by)
            ->with('feedback_to_ip_by', $feedback_to_ip_by)
            ->with('closed_by', $closed_by)
            ->with('efr', $efr)
            ->with('typeArr', $typeArr)
            ->with('siteArr', $siteArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $typeArr = $options['efr_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $efr = Efr::find($id);

        return view('modules.efrs.mail_efr')
            ->with('users', $users)
            ->with('efr', $efr)
            ->with('typeArr', $typeArr)
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

        $efr = Efr::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $originator = User::find($efr->originator);
        if ($originator) {
            $originator = $originator->first_name . " " . $originator->last_name;
        } else {
            $originator = "";
        }

        $completed_by = User::find($efr->completed_by);
        if ($completed_by) {
            $completed_by = $completed_by->first_name . " " . $completed_by->last_name;
        } else {
            $completed_by = "";
        }

        $feedback_to_ip_by = User::find($efr->feedback_to_ip_by);
        if ($feedback_to_ip_by) {
            $feedback_to_ip_by = $feedback_to_ip_by->first_name . " " . $feedback_to_ip_by->last_name;
        } else {
            $feedback_to_ip_by = "";
        }

        $closed_by = User::find($efr->closed_by);
        if ($closed_by) {
            $closed_by = $closed_by->first_name . " " . $closed_by->last_name;
        } else {
            $closed_by = "";
        }

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'site' => $efr->site,
            'type' => $efr->type,
            'interested_party' => $efr->interested_party,
            'ip_location' => $efr->ip_location,
            'ip_contact' => $efr->ip_contact,
            'ip_contact_telephone' => $efr->ip_contact_telephone,
            'feedback' => $efr->feedback,
            'originator' => $originator,
            'date_originated' => $efr->date_originated,
            'action_taken' => $efr->action_taken,
            'completed_by' => $completed_by,
            'feedback_to_ip' => $efr->feedback_to_ip,
            'feedback_to_ip_by' => $feedback_to_ip_by,
            'date_of_feedback' => $efr->date_of_feedback,
            'closed_by' => $closed_by,
            'closure_date' => $efr->closure_date,

        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new EFRsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('efrs'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new EfrsExport, 'efrs.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new EfrsImport, $path);

                session()->flash('success', 'EFRs has been imported successfully');
                return redirect(route('efrs'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('efrs'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('efrs'));
    }

}
