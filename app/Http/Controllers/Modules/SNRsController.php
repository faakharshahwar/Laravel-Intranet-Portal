<?php

namespace App\Http\Controllers\Modules;

use App\Exports\NcrsExport;
use App\Exports\SnrsExport;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SNRsRequest;
use App\Imports\SnrsImport;
use App\Mail\SNRsMail;
use App\Models\Modules\Snrs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class SNRsController extends Controller
{

    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = Snrs::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $snrs = $query->get();

        return view('modules.snrs.snrs')
            ->with('snrs', $snrs)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $supplierArr = $options['supplier'];
        $dispositionDecisionArr = $options['disposition_decision'];
        return view('modules.snrs.create_snrs')
            ->with('siteArr', $siteArr)
            ->with('supplierArr', $supplierArr)
            ->with('dispositionDecisionArr', $dispositionDecisionArr);
    }

    public function addSupplier(Request $request)
    {
        $newSupplier = $request->input('value');

        if (empty($newSupplier)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('supplier', $newSupplier);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }

    public function addDispositionDecision(Request $request)
    {
        $newDispositionDecision = $request->input('value');

        if (empty($newDispositionDecision)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('disposition_decision', $newDispositionDecision);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }


    public function store(SNRsRequest $request)
    {
        $site = $request->site;
        $origination_date = $request->origination_date;
        $supplier = $request->supplier;
        $supplier_representative = $request->supplier_representative;
        $our_po = $request->our_po;
        $supplier_order = $request->supplier_order;
        $product_name = $request->product_name;
        $quantity = $request->quantity;
        $product_description = $request->product_description;
        $supplier_rma = $request->supplier_rma;
        $requisition = $request->requisition;
        $sales_order = $request->sales_order;
        $customer = $request->customer;
        $other = $request->other;
        $description_of_nonconformance = $request->description_of_nonconformance;
        $originator = $request->originator;
        $root_cause = $request->root_cause;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $target_completion_date = $request->target_completion_date;
        $action_that_was_taken = $request->action_that_was_taken;
        $completed_by = $request->completed_by;
        $disposition_decision = $request->disposition_decision;
        $date_completed = $request->date_completed;
        $cpar_required = $request->cpar_required;
        $cpar_num = $request->cpar_num;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        if ($request->file('file_attachment_1')) {
            $file = $request->file('file_attachment_1');
            $filename_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/snrs';

            // Upload file
            $file->move($location, $filename_1);
        } else {
            $filename_1 = '';
        }

        if ($request->file('file_attachment_2')) {
            $file = $request->file('file_attachment_2');
            $filename_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/snrs';

            // Upload file
            $file->move($location, $filename_2);
        } else {
            $filename_2 = '';
        }

        if ($request->file('file_attachment_3')) {
            $file = $request->file('file_attachment_3');
            $filename_3 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/snrs';

            // Upload file
            $file->move($location, $filename_3);
        } else {
            $filename_3 = '';
        }

        // Get next global SNR running number (across ALL sites)
        $maxNumeric = Snrs::pluck('snr_id')
            ->map(function ($id) {
                // Example: SNR-CPLA-0002 → 2
                return (int)substr($id, strrpos($id, '-') + 1);
            })
            ->max();

        $nextNumber = ($maxNumeric ?? 0) + 1;
        $maxValueNCR = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);


        $prefixMap = [
            "Applicable to All Sites" => "SNR-CPCP-",
            "CPAE - Dubai" => "SNR-CPAE-",
            "CPLA - Mandeville" => "SNR-CPLA-",
            "CPTX - West Texas" => "SNR-CPTX-",
            "CPUK - Aberdeen" => "SNR-CPUK-",
        ];

        $snrPrefix = $prefixMap[$site] ?? "SNR-";
        $snr_id = $snrPrefix . $maxValueNCR;


        $snr = Snrs::create([
            'snr_id' => $snr_id,
            'site' => $site,
            'origination_date' => $origination_date,
            'supplier' => $supplier,
            'supplier_representative' => $supplier_representative,
            'our_po' => $our_po,
            'supplier_order' => $supplier_order,
            'product_name' => $product_name,
            'quantity' => $quantity,
            'product_description' => $product_description,
            'supplier_rma' => $supplier_rma,
            'requisition' => $requisition,
            'sales_order' => $sales_order,
            'customer' => $customer,
            'other' => $other,
            'description_of_nonconformance' => $description_of_nonconformance,
            'originator' => $originator,
            'root_cause' => $root_cause,
            'action_to_be_taken' => $action_to_be_taken,
            'assigned_to' => $assigned_to,
            'effectiveness_evaluated' => $effectiveness_evaluated,
            'action_taken_effective' => $action_taken_effective,
            'what_action_was_taken' => $what_action_was_taken,
            'action_taken_by' => $action_taken_by,
            'target_completion_date' => $target_completion_date,
            'action_that_was_taken' => $action_that_was_taken,
            'completed_by' => $completed_by,
            'disposition_decision' => $disposition_decision,
            'date_completed' => $date_completed,
            'cpar_required' => $cpar_required,
            'cpar_num' => $cpar_num,
            'closed_by' => $closed_by,
            'closure_date' => $closure_date,
            'file_attachment_1' => $filename_1,
            'file_attachment_2' => $filename_2,
            'file_attachment_3' => $filename_3,
        ]);

        if ($snr) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('snrs'));
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $supplierArr = $options['supplier'];
        $dispositionDecisionArr = $options['disposition_decision'];

        $snr = Snrs::find($id);

        return view('modules.snrs.read_snrs')
            ->with('siteArr', $siteArr)
            ->with('supplierArr', $supplierArr)
            ->with('dispositionDecisionArr', $dispositionDecisionArr)
            ->with('snr', $snr);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $supplierArr = $options['supplier'];
        $dispositionDecisionArr = $options['disposition_decision'];

        $snr = Snrs::find($id);

        return view('modules.snrs.edit_snrs')
            ->with('siteArr', $siteArr)
            ->with('supplierArr', $supplierArr)
            ->with('dispositionDecisionArr', $dispositionDecisionArr)
            ->with('snr', $snr);
    }

    public function update(SNRsRequest $request)
    {
        $id = $request->id;
        $snr_id = $request->snr_id;
        $site = $request->site;
        $origination_date = $request->origination_date;
        $supplier = $request->supplier;
        $supplier_representative = $request->supplier_representative;
        $our_po = $request->our_po;
        $supplier_order = $request->supplier_order;
        $product_name = $request->product_name;
        $quantity = $request->quantity;
        $product_description = $request->product_description;
        $supplier_rma = $request->supplier_rma;
        $requisition = $request->requisition;
        $sales_order = $request->sales_order;
        $customer = $request->customer;
        $other = $request->other;
        $description_of_nonconformance = $request->description_of_nonconformance;
        $originator = $request->originator;
        $root_cause = $request->root_cause;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $target_completion_date = $request->target_completion_date;
        $action_that_was_taken = $request->action_that_was_taken;
        $completed_by = $request->completed_by;
        $disposition_decision = $request->disposition_decision;
        $date_completed = $request->date_completed;
        $cpar_required = $request->cpar_required;
        $cpar_num = $request->cpar_num;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        if ($request->file('file_attachment_1')) {
            $file = $request->file('file_attachment_1');
            $filename_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/snrs';

            // Upload file
            $file->move($location, $filename_1);
        } else {
            $filename_1 = $request->old_attachment_1;
        }

        if ($request->file('file_attachment_2')) {
            $file = $request->file('file_attachment_2');
            $filename_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/snrs';

            // Upload file
            $file->move($location, $filename_2);
        } else {
            $filename_2 = $request->old_attachment_2;
        }

        if ($request->file('file_attachment_3')) {
            $file = $request->file('file_attachment_3');
            $filename_3 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/snrs';

            // Upload file
            $file->move($location, $filename_3);
        } else {
            $filename_3 = $request->old_attachment_3;
        }

        // Keep the SAME running number, only change prefix based on site
        $numericPart = substr($snr_id, strrpos($snr_id, '-') + 1); // e.g. "0007"
        $numericPart = str_pad((int)$numericPart, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "SNR-CPCP-",
            "CPAE - Dubai" => "SNR-CPAE-",
            "CPLA - Mandeville" => "SNR-CPLA-",
            "CPTX - West Texas" => "SNR-CPTX-",
            "CPUK - Aberdeen" => "SNR-CPUK-",
        ];

        $snrPrefix = $prefixMap[$site] ?? "SNR-";
        $snr_id = $snrPrefix . $numericPart;


        $snr = DB::table('snrs')
            ->where('id', $id)
            ->update([
                'snr_id' => $snr_id,
                'site' => $site,
                'origination_date' => $origination_date,
                'supplier' => $supplier,
                'supplier_representative' => $supplier_representative,
                'our_po' => $our_po,
                'supplier_order' => $supplier_order,
                'product_name' => $product_name,
                'quantity' => $quantity,
                'product_description' => $product_description,
                'supplier_rma' => $supplier_rma,
                'requisition' => $requisition,
                'sales_order' => $sales_order,
                'customer' => $customer,
                'other' => $other,
                'description_of_nonconformance' => $description_of_nonconformance,
                'originator' => $originator,
                'root_cause' => $root_cause,
                'action_to_be_taken' => $action_to_be_taken,
                'assigned_to' => $assigned_to,
                'effectiveness_evaluated' => $effectiveness_evaluated,
                'action_taken_effective' => $action_taken_effective,
                'what_action_was_taken' => $what_action_was_taken,
                'action_taken_by' => $action_taken_by,
                'target_completion_date' => $target_completion_date,
                'action_that_was_taken' => $action_that_was_taken,
                'completed_by' => $completed_by,
                'disposition_decision' => $disposition_decision,
                'date_completed' => $date_completed,
                'cpar_required' => $cpar_required,
                'cpar_num' => $cpar_num,
                'closed_by' => $closed_by,
                'closure_date' => $closure_date,
                'file_attachment_1' => $filename_1,
                'file_attachment_2' => $filename_2,
                'file_attachment_3' => $filename_3,
            ]);

        if ($snr) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('snrs'));
    }

    public function delete($id)
    {
        $snr = Snrs::find($id);
        $snrDel = $snr->delete();

        if ($snrDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('snrs'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new SnrsExport(), 'snrs.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new SnrsImport(), $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('snrs'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('snrs'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('snrs'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $supplierArr = $options['supplier'];
        $dispositionDecisionArr = $options['disposition_decision'];

        $snr = Snrs::find($id);

        return view('modules.snrs.print_snrs')
            ->with('siteArr', $siteArr)
            ->with('supplierArr', $supplierArr)
            ->with('dispositionDecisionArr', $dispositionDecisionArr)
            ->with('snr', $snr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $supplierArr = $options['supplier'];
        $dispositionDecisionArr = $options['disposition_decision'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $snr = Snrs::find($id);

        return view('modules.snrs.mail_snrs')
            ->with('siteArr', $siteArr)
            ->with('supplierArr', $supplierArr)
            ->with('dispositionDecisionArr', $dispositionDecisionArr)
            ->with('users', $users)
            ->with('snr', $snr);
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

        $snr = Snrs::find($id);

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'snr_id' => $snr->snr_id,
            'site' => $snr->site,
            'origination_date' => $snr->origination_date,
            'supplier' => $snr->supplier,
            'supplier_representative' => $snr->supplier_representative,
            'our_po' => $snr->our_po,
            'supplier_order' => $snr->supplier_order,
            'product_name' => $snr->product_name,
            'quantity' => $snr->quantity,
            'product_description' => $snr->product_description,
            'supplier_rma' => $snr->supplier_rma,
            'requisition' => $snr->requisition,
            'sales_order' => $snr->sales_order,
            'customer' => $snr->customer,
            'other' => $snr->other,
            'description_of_nonconformance' => $snr->description_of_nonconformance,
            'originator' => $snr->originator,
            'root_cause' => $snr->root_cause,
            'action_to_be_taken' => $snr->action_to_be_taken,
            'assigned_to' => $snr->assigned_to,
            'effectiveness_evaluated' => $snr->effectiveness_evaluated,
            'action_taken_effective' => $snr->action_taken_effective,
            'what_action_was_taken' => $snr->what_action_was_taken,
            'action_taken_by' => $snr->action_taken_by,
            'target_completion_date' => $snr->target_completion_date,
            'action_that_was_taken' => $snr->action_that_was_taken,
            'completed_by' => $snr->completed_by,
            'disposition_decision' => $snr->disposition_decision,
            'date_completed' => $snr->date_completed,
            'cpar_required' => $snr->cpar_required,
            'cpar_num' => $snr->cpar_num,
            'closed_by' => $snr->closed_by,
            'closure_date' => $snr->closure_date,
            'file_attachment_1' => $snr->file_attachment_1,
            'file_attachment_2' => $snr->file_attachment_2,
            'file_attachment_3' => $snr->file_attachment_3,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new SNRsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('snrs'));

    }
}
