<?php

namespace App\Http\Controllers\Modules;

use App\Exports\NcrsExport;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\NCRsRequest;
use App\Imports\NcrsImport;
use App\Mail\NCRsMail;
use App\Models\Modules\Ncrs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class NCRsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = Ncrs::orderBy('id', 'desc');

        // Apply site filter
        $selectedSite = $request->query('site');
        if (!empty($selectedSite) && $selectedSite !== 'Remove Filter') {
            $query->where('originating_site', $selectedSite);
        }

        // Apply NCR status filter
        $ncrStatus = $request->query('ncr_status');
        if ($ncrStatus === 'Open') {
            $query->where(function ($q) {
                $q->whereNull('closure_date')
                    ->orWhere('closure_date', '');
            });
        } elseif ($ncrStatus === 'Closed') {
            $query->whereNotNull('closure_date')
                ->where('closure_date', '!=', '');
        }


        $ncrs = $query->get();

//        dd($ncrs);

        return view('modules.ncrs.ncrs')
            ->with('ncrs', $ncrs)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $selectedSite)
            ->with('ncrStatus', $ncrStatus);
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparResultsAreaArr = $options['cparResultsArea'];
        $ncrNonconformanceType = $options['nonconformanceType'];
        $ncrCategory = $options['ncr_category'];
        $ncrSystemType = $options['system_type'];
        $ncrResultsArea = $options['results_area'];
        $ncrDispositionDecisionArr = $options['disposition_decision'];

        return view('modules.ncrs.create_ncrs')->with('siteArr', $siteArr)
            ->with('cparResultsAreaArr', $cparResultsAreaArr)
            ->with('ncrNonconformanceTypeArr', $ncrNonconformanceType)
            ->with('ncrCategoryArr', $ncrCategory)
            ->with('ncrSystemTypeArr', $ncrSystemType)
            ->with('ncrDispositionDecisionArr', $ncrDispositionDecisionArr)
            ->with('ncrResultsAreaArr', $ncrResultsArea);
    }

    public function addNcrCategory(Request $request)
    {
        $newNcrCategory = $request->input('value');

        if (empty($newNcrCategory)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('ncr_category', $newNcrCategory);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }

    public function addResultsArea(Request $request)
    {
        $newResultsArea = $request->input('value');

        if (empty($newResultsArea)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('results_area', $newResultsArea);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }

    public function store(NCRsRequest $request)
    {
        $originating_site = $request->originating_site;
        $date_of_issue = $request->date_of_issue;
        $results_area = $request->results_area;
        $responsible_site = $request->responsible_site;
        $quantity = $request->quantity;
        $process_description = $request->process_description;
        $order_num = $request->order_num;
        $nonconformance_type = $request->nonconformance_type;
        $customer_if_applicable = $request->customer_if_applicable;
        $description_of_nonconformance = $request->description_of_nonconformance;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $ncr_category = $request->ncr_category;
        $system_type = $request->system_type;
        $results_area = $request->results_area;
        $disposition_decision = $request->disposition_decision;
        $disposition_if_other = $request->disposition_if_other;
        $root_cause = $request->root_cause;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $target_date = $request->target_date;
        $comments_if_any = $request->comments_if_any;
        $authorized_by = $request->authorized_by;
        $authorization_date = $request->authorization_date;
        $action_taken = $request->action_taken;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $completed_by = $request->completed_by;
        $date_completed = $request->date_completed;
        $cpar_required = $request->cpar_required;
        $cpar_num = $request->cpar_num;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        // Get next global NCR running number (across ALL originating sites)
        $maxNumeric = Ncrs::pluck('ncr_id')
            ->map(function ($id) {
                // Example: NCR-CPLA-0002 → 2
                return (int) substr($id, strrpos($id, '-') + 1);
            })
            ->max();

        $nextNumber = ($maxNumeric ?? 0) + 1;
        $maxValueNCR = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "NCR-CPCP-",
            "CPAE - Dubai"            => "NCR-CPAE-",
            "CPLA - Mandeville"       => "NCR-CPLA-",
            "CPTX - West Texas"       => "NCR-CPTX-",
            "CPUK - Aberdeen"         => "NCR-CPUK-",
        ];

        $ncrPrefix = $prefixMap[$originating_site] ?? "NCR-";
        $ncr_id = $ncrPrefix . $maxValueNCR;

        $ncr = Ncrs::create([
            'ncr_id' => $ncr_id,
            'originating_site' => $originating_site,
            'date_of_issue' => $date_of_issue,
            'responsible_site' => $responsible_site,
            'quantity' => $quantity,
            'process_description' => $process_description,
            'order_num' => $order_num,
            'nonconformance_type' => $nonconformance_type,
            'customer_if_applicable' => $customer_if_applicable,
            'description_of_nonconformance' => $description_of_nonconformance,
            'originator' => $originator,
            'date_originated' => $date_originated,
            'ncr_category' => $ncr_category,
            'system_type' => $system_type,
            'results_area' => $results_area,
            'disposition_decision' => $disposition_decision,
            'disposition_if_other' => $disposition_if_other,
            'root_cause' => $root_cause,
            'action_to_be_taken' => $action_to_be_taken,
            'assigned_to' => $assigned_to,
            'target_date' => $target_date,
            'comments_if_any' => $comments_if_any,
            'authorized_by' => $authorized_by,
            'authorization_date' => $authorization_date,
            'action_taken' => $action_taken,
            'effectiveness_evaluated' => $effectiveness_evaluated,
            'action_taken_effective' => $action_taken_effective,
            'what_action_was_taken' => $what_action_was_taken,
            'action_taken_by' => $action_taken_by,
            'completed_by' => $completed_by,
            'date_completed' => $date_completed,
            'cpar_required' => $cpar_required,
            'cpar_num' => $cpar_num,
            'closed_by' => $closed_by,
            'closure_date' => $closure_date,
        ]);

        if ($ncr) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('ncrs'));
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparResultsAreaArr = $options['cparResultsArea'];
        $ncrNonconformanceType = $options['nonconformanceType'];
        $ncrCategory = $options['ncr_category'];
        $ncrSystemType = $options['system_type'];
        $ncrResultsArea = $options['results_area'];
        $ncrDispositionDecisionArr = $options['disposition_decision'];

        $ncr = Ncrs::find($id);

        return view('modules.ncrs.edit_ncrs')->with('siteArr', $siteArr)
            ->with('cparResultsAreaArr', $cparResultsAreaArr)
            ->with('ncrNonconformanceTypeArr', $ncrNonconformanceType)
            ->with('ncrCategoryArr', $ncrCategory)
            ->with('ncrSystemTypeArr', $ncrSystemType)
            ->with('ncrResultsAreaArr', $ncrResultsArea)
            ->with('ncrDispositionDecisionArr', $ncrDispositionDecisionArr)
            ->with('ncr', $ncr);
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparResultsAreaArr = $options['cparResultsArea'];
        $ncrNonconformanceType = $options['nonconformanceType'];
        $ncrCategory = $options['ncr_category'];
        $ncrSystemType = $options['system_type'];
        $ncrResultsArea = $options['results_area'];

        $ncr = Ncrs::find($id);

        return view('modules.ncrs.read_ncrs')->with('siteArr', $siteArr)
            ->with('cparResultsAreaArr', $cparResultsAreaArr)
            ->with('ncrNonconformanceTypeArr', $ncrNonconformanceType)
            ->with('ncrCategoryArr', $ncrCategory)
            ->with('ncrSystemTypeArr', $ncrSystemType)
            ->with('ncrResultsAreaArr', $ncrResultsArea)
            ->with('ncr', $ncr);
    }

    public function update(NCRsRequest $request)
    {
        $id = $request->id;
        $ncr_id = $request->ncr_id;
        $originating_site = $request->originating_site;
        $date_of_issue = $request->date_of_issue;
        $results_area = $request->results_area;
        $responsible_site = $request->responsible_site;
        $quantity = $request->quantity;
        $process_description = $request->process_description;
        $order_num = $request->order_num;
        $nonconformance_type = $request->nonconformance_type;
        $customer_if_applicable = $request->customer_if_applicable;
        $description_of_nonconformance = $request->description_of_nonconformance;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $ncr_category = $request->ncr_category;
        $system_type = $request->system_type;
        $results_area = $request->results_area;
        $disposition_decision = $request->disposition_decision;
        $disposition_if_other = $request->disposition_if_other;
        $root_cause = $request->root_cause;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $target_date = $request->target_date;
        $comments_if_any = $request->comments_if_any;
        $authorized_by = $request->authorized_by;
        $authorization_date = $request->authorization_date;
        $action_taken = $request->action_taken;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $completed_by = $request->completed_by;
        $date_completed = $request->date_completed;
        $cpar_required = $request->cpar_required;
        $cpar_num = $request->cpar_num;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        // Keep SAME running number, only update prefix based on originating_site
        $numericPart = substr($ncr_id, strrpos($ncr_id, '-') + 1); // e.g. "0007"
        $numericPart = str_pad((int)$numericPart, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "NCR-CPCP-",
            "CPAE - Dubai"            => "NCR-CPAE-",
            "CPLA - Mandeville"       => "NCR-CPLA-",
            "CPTX - West Texas"       => "NCR-CPTX-",
            "CPUK - Aberdeen"         => "NCR-CPUK-",
        ];

        $ncrPrefix = $prefixMap[$originating_site] ?? "NCR-";
        $ncr_id = $ncrPrefix . $numericPart;

        $ncr = DB::table('ncrs')
            ->where('id', $id)
            ->update([
                'ncr_id' => $ncr_id,
                'originating_site' => $originating_site,
                'date_of_issue' => $date_of_issue,
                'responsible_site' => $responsible_site,
                'quantity' => $quantity,
                'process_description' => $process_description,
                'order_num' => $order_num,
                'nonconformance_type' => $nonconformance_type,
                'customer_if_applicable' => $customer_if_applicable,
                'description_of_nonconformance' => $description_of_nonconformance,
                'originator' => $originator,
                'date_originated' => $date_originated,
                'ncr_category' => $ncr_category,
                'system_type' => $system_type,
                'results_area' => $results_area,
                'disposition_decision' => $disposition_decision,
                'disposition_if_other' => $disposition_if_other,
                'root_cause' => $root_cause,
                'action_to_be_taken' => $action_to_be_taken,
                'assigned_to' => $assigned_to,
                'target_date' => $target_date,
                'comments_if_any' => $comments_if_any,
                'authorized_by' => $authorized_by,
                'authorization_date' => $authorization_date,
                'action_taken' => $action_taken,
                'effectiveness_evaluated' => $effectiveness_evaluated,
                'action_taken_effective' => $action_taken_effective,
                'what_action_was_taken' => $what_action_was_taken,
                'action_taken_by' => $action_taken_by,
                'completed_by' => $completed_by,
                'date_completed' => $date_completed,
                'cpar_required' => $cpar_required,
                'cpar_num' => $cpar_num,
                'closed_by' => $closed_by,
                'closure_date' => $closure_date,
            ]);

        if ($ncr) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('ncrs'));
    }

    public function delete($id)
    {
        $ncr = Ncrs::find($id);
        $ncrDel = $ncr->delete();

        if ($ncrDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('ncrs'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new NcrsExport(), 'ncrs.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new NcrsImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('ncrs'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('ncrs'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('ncrs'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparResultsAreaArr = $options['cparResultsArea'];
        $ncrNonconformanceType = $options['nonconformanceType'];
        $ncrCategory = $options['ncr_category'];
        $ncrSystemType = $options['system_type'];
        $ncrResultsArea = $options['results_area'];

        $ncr = Ncrs::find($id);

        return view('modules.ncrs.print_ncrs')->with('siteArr', $siteArr)
            ->with('cparResultsAreaArr', $cparResultsAreaArr)
            ->with('ncrNonconformanceTypeArr', $ncrNonconformanceType)
            ->with('ncrCategoryArr', $ncrCategory)
            ->with('ncrSystemTypeArr', $ncrSystemType)
            ->with('ncrResultsAreaArr', $ncrResultsArea)
            ->with('ncr', $ncr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cparResultsAreaArr = $options['cparResultsArea'];
        $ncrNonconformanceType = $options['nonconformanceType'];
        $ncrCategory = $options['ncr_category'];
        $ncrSystemType = $options['system_type'];
        $ncrResultsArea = $options['results_area'];

        $ncr = Ncrs::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.ncrs.mail_ncrs')->with('siteArr', $siteArr)
            ->with('cparResultsAreaArr', $cparResultsAreaArr)
            ->with('ncrNonconformanceTypeArr', $ncrNonconformanceType)
            ->with('ncrCategoryArr', $ncrCategory)
            ->with('ncrSystemTypeArr', $ncrSystemType)
            ->with('ncrResultsAreaArr', $ncrResultsArea)
            ->with('users', $users)
            ->with('ncr', $ncr);
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

        $ncr = Ncrs::find($id);

        $personal_message = $request->personal_message;

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'ncr_id' => $ncr->ncr_id,
            'originating_site' => $ncr->originating_site,
            'date_of_issue' => $ncr->date_of_issue,
            'results_area' => $ncr->results_area,
            'responsible_site' => $ncr->responsible_site,
            'quantity' => $ncr->quantity,
            'process_description' => $ncr->process_description,
            'order_num' => $ncr->order_num,
            'nonconformance_type' => $ncr->nonconformance_type,
            'customer_if_applicable' => $ncr->customer_if_applicable,
            'description_of_nonconformance' => $ncr->description_of_nonconformance,
            'originator' => $ncr->originator,
            'date_originated' => $ncr->date_originated,
            'ncr_category' => $ncr->ncr_category,
            'system_type' => $ncr->system_type,
            'disposition_decision' => $ncr->disposition_decision,
            'disposition_if_other' => $ncr->disposition_if_other,
            'root_cause' => $ncr->root_cause,
            'action_to_be_taken' => $ncr->action_to_be_taken,
            'assigned_to' => $ncr->assigned_to,
            'target_date' => $ncr->target_date,
            'comments_if_any' => $ncr->comments_if_any,
            'authorized_by' => $ncr->authorized_by,
            'authorization_date' => $ncr->authorization_date,
            'action_taken' => $ncr->action_taken,
            'effectiveness_evaluated' => $ncr->effectiveness_evaluated,
            'action_taken_effective' => $ncr->action_taken_effective,
            'what_action_was_taken' => $ncr->what_action_was_taken,
            'action_taken_by' => $ncr->action_taken_by,
            'completed_by' => $ncr->completed_by,
            'date_completed' => $ncr->date_completed,
            'cpar_required' => $ncr->cpar_required,
            'cpar_num' => $ncr->cpar_num,
            'closed_by' => $ncr->closed_by,
            'closure_date' => $ncr->closure_date,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new NCRsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('ncrs'));
    }
}
