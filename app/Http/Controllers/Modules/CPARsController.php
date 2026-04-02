<?php

namespace App\Http\Controllers\Modules;

use App\Exports\CparsExport;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CPARsRequest;
use App\Imports\CparsImport;
use App\Mail\CPARsMail;
use App\Models\Modules\Cpars;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class CPARsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $query = Cpars::orderBy('id', 'desc');

        $query = FilterHelper::filterBySite($query, $request);

        $cpars = $query->get();

        return view('modules.cpars.cpars')
            ->with('cpars', $cpars)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparTypeArr = $options['cparType'];
        $cparReasonArr = $options['cparReason'];
        $cparResultsAreaArr = $options['cparResultsArea'];
        return view('modules.cpars.create_cpars')->with('siteArr', $siteArr)->with('cparTypeArr', $cparTypeArr)
            ->with('cparReasonArr', $cparReasonArr)->with('cparResultsAreaArr', $cparResultsAreaArr);
    }

    public function store(CPARsRequest $request)
    {
        $site = $request->site;
        $date_of_issue = $request->date_of_issue;
        $cpar_type = $request->cpar_type;
        $reason = $request->reason;
        $reason_if_other = $request->reason_if_other;
        $description_of_issue = $request->description_of_issue;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $results_area = $request->results_area;
        $responsible_manager = $request->responsible_manager;
        $manager_acceptance_date = $request->manager_acceptance_date;
        $root_cause = $request->root_cause;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $target_completion_date = $request->target_completion_date;
        $date_action_was_completed = $request->date_action_was_completed;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $documents_revised = $request->documents_revised;
        $date_documents_revised = $request->date_documents_revised;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        // Get next global CPAR running number (across ALL sites)
        $maxNumeric = Cpars::pluck('cpar_id')
            ->map(function ($id) {
                // Example: CPAR-CPLA-0002 → 2
                return (int) substr($id, strrpos($id, '-') + 1);
            })
            ->max();

        $nextNumber = ($maxNumeric ?? 0) + 1;
        $maxValueCPAR = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "CPAR-CPCP-",
            "CPAE - Dubai"            => "CPAR-CPAE-",
            "CPLA - Mandeville"       => "CPAR-CPLA-",
            "CPTX - West Texas"       => "CPAR-CPTX-",
            "CPUK - Aberdeen"         => "CPAR-CPUK-",
        ];

        $cparPrefix = $prefixMap[$site] ?? "CPAR-";
        $cpar_id = $cparPrefix . $maxValueCPAR;

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $attachment_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/CPARs';

            // Upload file
            $file->move($location, $attachment_1);
        } else {
            $attachment_1 = '';
        }
        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $attachment_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/CPARs';

            // Upload file
            $file->move($location, $attachment_2);
        } else {
            $attachment_2 = '';
        }

        $cpar = Cpars::create([
            'cpar_id' => $cpar_id,
            'site' => $site,
            'date_of_issue' => $date_of_issue,
            'cpar_type' => $cpar_type,
            'reason' => $reason,
            'reason_if_other' => $reason_if_other,
            'description_of_issue' => $description_of_issue,
            'originator' => $originator,
            'date_originated' => $date_originated,
            'results_area' => $results_area,
            'responsible_manager' => $responsible_manager,
            'manager_acceptance_date' => $manager_acceptance_date,
            'root_cause' => $root_cause,
            'attachment_1' => $attachment_1,
            'attachment_2' => $attachment_2,
            'action_to_be_taken' => $action_to_be_taken,
            'assigned_to' => $assigned_to,
            'target_completion_date' => $target_completion_date,
            'date_action_was_completed' => $date_action_was_completed,
            'effectiveness_evaluated' => $effectiveness_evaluated,
            'action_taken_effective' => $action_taken_effective,
            'what_action_was_taken' => $what_action_was_taken,
            'action_taken_by' => $action_taken_by,
            'documents_revised' => $documents_revised,
            'date_documents_revised' => $date_documents_revised,
            'closed_by' => $closed_by,
            'closure_date' => $closure_date,
        ]);

        if ($cpar) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('cpars'));
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparTypeArr = $options['cparType'];
        $cparReasonArr = $options['cparReason'];
        $cparResultsAreaArr = $options['cparResultsArea'];

        $cpar = Cpars::find($id);
        return view('modules.cpars.edit_cpars')->with('siteArr', $siteArr)->with('cparTypeArr', $cparTypeArr)
            ->with('cparReasonArr', $cparReasonArr)->with('cparResultsAreaArr', $cparResultsAreaArr)->with('cpar', $cpar);

    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparTypeArr = $options['cparType'];
        $cparReasonArr = $options['cparReason'];
        $cparResultsAreaArr = $options['cparResultsArea'];

        $cpar = Cpars::find($id);
        return view('modules.cpars.read_cpars')->with('siteArr', $siteArr)->with('cparTypeArr', $cparTypeArr)
            ->with('cparReasonArr', $cparReasonArr)->with('cparResultsAreaArr', $cparResultsAreaArr)->with('cpar', $cpar);
    }

    public function update(CPARsRequest $request)
    {
        $id = $request->id;
        $cpar_id = $request->cpar_id;
        $site = $request->site;
        $date_of_issue = $request->date_of_issue;
        $cpar_type = $request->cpar_type;
        $reason = $request->reason;
        $reason_if_other = $request->reason_if_other;
        $description_of_issue = $request->description_of_issue;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $results_area = $request->results_area;
        $responsible_manager = $request->responsible_manager;
        $manager_acceptance_date = $request->manager_acceptance_date;
        $root_cause = $request->root_cause;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $target_completion_date = $request->target_completion_date;
        $date_action_was_completed = $request->date_action_was_completed;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $documents_revised = $request->documents_revised;
        $date_documents_revised = $request->date_documents_revised;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        // Keep SAME running number, only update prefix based on site
        $numericPart = substr($cpar_id, strrpos($cpar_id, '-') + 1); // e.g. "0007"
        $numericPart = str_pad((int)$numericPart, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "CPAR-CPCP-",
            "CPAE - Dubai"            => "CPAR-CPAE-",
            "CPLA - Mandeville"       => "CPAR-CPLA-",
            "CPTX - West Texas"       => "CPAR-CPTX-",
            "CPUK - Aberdeen"         => "CPAR-CPUK-",
        ];

        $cparPrefix = $prefixMap[$site] ?? "CPAR-";
        $cpar_id = $cparPrefix . $numericPart;

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $attachment_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/CPARs';

            // Upload file
            $file->move($location, $attachment_1);
        } else {
            $attachment_1 = $request->old_attachment_1;
        }
        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $attachment_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/CPARs';

            // Upload file
            $file->move($location, $attachment_2);
        } else {
            $attachment_2 = $request->old_attachment_2;
        }

        $cpar = DB::table('cpars')
            ->where('id', $id)
            ->update([
                'cpar_id' => $cpar_id,
                'site' => $site,
                'date_of_issue' => $date_of_issue,
                'cpar_type' => $cpar_type,
                'reason' => $reason,
                'reason_if_other' => $reason_if_other,
                'description_of_issue' => $description_of_issue,
                'originator' => $originator,
                'date_originated' => $date_originated,
                'results_area' => $results_area,
                'responsible_manager' => $responsible_manager,
                'manager_acceptance_date' => $manager_acceptance_date,
                'root_cause' => $root_cause,
                'attachment_1' => $attachment_1,
                'attachment_2' => $attachment_2,
                'action_to_be_taken' => $action_to_be_taken,
                'assigned_to' => $assigned_to,
                'target_completion_date' => $target_completion_date,
                'date_action_was_completed' => $date_action_was_completed,
                'effectiveness_evaluated' => $effectiveness_evaluated,
                'action_taken_effective' => $action_taken_effective,
                'what_action_was_taken' => $what_action_was_taken,
                'action_taken_by' => $action_taken_by,
                'documents_revised' => $documents_revised,
                'date_documents_revised' => $date_documents_revised,
                'closed_by' => $closed_by,
                'closure_date' => $closure_date,
            ]);
        if ($cpar) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('cpars'));

    }

    public function delete($id)
    {
        $cpar = Cpars::find($id);
        $cparDel = $cpar->delete();

        if ($cparDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('cpars'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new CparsExport(), 'cpars.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new CparsImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('cpars'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('cpars'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('cpars'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparTypeArr = $options['cparType'];
        $cparReasonArr = $options['cparReason'];
        $cparResultsAreaArr = $options['cparResultsArea'];

        $cpar = Cpars::find($id);
        return view('modules.cpars.print_cpars')->with('siteArr', $siteArr)->with('cparTypeArr', $cparTypeArr)
            ->with('cparReasonArr', $cparReasonArr)->with('cparResultsAreaArr', $cparResultsAreaArr)->with('cpar', $cpar);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparTypeArr = $options['cparType'];
        $cparReasonArr = $options['cparReason'];
        $cparResultsAreaArr = $options['cparResultsArea'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $cpar = Cpars::find($id);
        return view('modules.cpars.mail_cpars')
            ->with('siteArr', $siteArr)
            ->with('cparTypeArr', $cparTypeArr)
            ->with('cparReasonArr', $cparReasonArr)
            ->with('cparResultsAreaArr', $cparResultsAreaArr)
            ->with('cpar', $cpar)
            ->with('users', $users);
    }

    public function send_email(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'recipient' => 'required',
        ]);

        $options = dynamicOptions();
        $site_urlArr = $options['site_url'];
        $base_url = $site_urlArr['base_url'];
        $personal_message = $request->personal_message;

        $id = $request->id;
        $cpar = Cpars::find($id);

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'cpar_id' => $cpar->cpar_id,
            'site' => $cpar->site,
            'date_of_issue' => $cpar->date_of_issue,
            'cpar_type' => $cpar->cpar_type,
            'reason' => $cpar->reason,
            'reason_if_other' => $cpar->reason_if_other,
            'description_of_issue' => $cpar->description_of_issue,
            'originator' => $cpar->originator,
            'date_originated' => $cpar->date_originated,
            'results_area' => $cpar->results_area,
            'responsible_manager' => $cpar->responsible_manager,
            'manager_acceptance_date' => $cpar->manager_acceptance_date,
            'root_cause' => $cpar->root_cause,
            'attachment_1' => $cpar->attachment_1,
            'attachment_2' => $cpar->attachment_2,
            'action_to_be_taken' => $cpar->action_to_be_taken,
            'assigned_to' => $cpar->assigned_to,
            'target_completion_date' => $cpar->target_completion_date,
            'date_action_was_completed' => $cpar->date_action_was_completed,
            'effectiveness_evaluated' => $cpar->effectiveness_evaluated,
            'action_taken_effective' => $cpar->action_taken_effective,
            'what_action_was_taken' => $cpar->what_action_was_taken,
            'action_taken_by' => $cpar->action_taken_by,
            'documents_revised' => $cpar->documents_revised,
            'date_documents_revised' => $cpar->date_documents_revised,
            'closed_by' => $cpar->closed_by,
            'closure_date' => $cpar->closure_date,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new CPARsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('cpars'));
    }

    public function addReason(Request $request)
    {
        $newReason = $request->input('value');

        if (empty($newReason)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('cparReason', $newReason);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }
    }

    public function addResultsArea(Request $request)
    {
        $newResultsArea = $request->input('value');

        if (empty($newResultsArea)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('cparResultsArea', $newResultsArea);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }
    }
}
