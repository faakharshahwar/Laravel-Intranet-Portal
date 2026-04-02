<?php

namespace App\Http\Controllers\Modules;

use App\Exports\CustomerFeedbackRecordsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerFeedbackRecordsRequest;
use App\Imports\CustomerFeedbackRecordsImport;
use App\Mail\CustomerFeedbackRecordsMail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Modules\CustomerFeedbackRecords;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class CustomerFeedbackRecordsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $query = CustomerFeedbackRecords::orderBy('id', 'desc');

        $query = FilterHelper::filterBySite($query, $request);

        $cfr = $query->get();

        return view('modules.customer_feedback_records.customer_feedback_records')
            ->with('customer_feedback_records', $cfr)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        return view('modules.customer_feedback_records.create_customer_feedback_records')
            ->with('siteArr', $siteArr);
    }

    public function store(CustomerFeedbackRecordsRequest $request)
    {
        $site = $request->site;
        $type = $request->type;
        $customer = $request->customer;
        $customer_location = $request->customer_location;
        $customer_contact = $request->customer_contact;
        $customer_phone = $request->customer_phone;
        $customer_email = $request->customer_email;
        $description = $request->description;
        $cfr_category = $request->cfr_category;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $root_cause = $request->root_cause;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $target_completion_date = $request->target_completion_date;
        $completed_by = $request->completed_by;
        $date_completed = $request->date_completed;
        $feedback_to_customer = $request->feedback_to_customer;
        $feedback_by = $request->feedback_by;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $date_of_feedback = $request->date_of_feedback;
        $cpar_required = $request->cpar_required;
        $if_yes_cpar = $request->if_yes_cpar;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        // Get next global CFR running number (across ALL sites)
        $maxNumeric = CustomerFeedbackRecords::pluck('cfr_id')
            ->map(function ($id) {
                // Example: CFR-CPLA-0002 → 2
                return (int) substr($id, strrpos($id, '-') + 1);
            })
            ->max();

        $nextNumber = ($maxNumeric ?? 0) + 1;
        $maxValueCFR = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "CFR-CPCP-",
            "CPAE - Dubai"            => "CFR-CPAE-",
            "CPLA - Mandeville"       => "CFR-CPLA-",
            "CPTX - West Texas"       => "CFR-CPTX-",
            "CPUK - Aberdeen"         => "CFR-CPUK-",
        ];

        $cfrPrefix = $prefixMap[$site] ?? "CFR-";
        $cfr_id = $cfrPrefix . $maxValueCFR;


        if ($request->file('attachment_field')) {
            $file = $request->file('attachment_field');
            $attachment_field = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/customer_feedback_records';

            // Upload file
            $file->move($location, $attachment_field);
        } else {
            $attachment_field = '';
        }

        if ($request->file('photo_field')) {
            $file = $request->file('photo_field');
            $photo_field = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/customer_feedback_records';

            // Upload file
            $file->move($location, $photo_field);
        } else {
            $photo_field = '';
        }

        $cfr = CustomerFeedbackRecords::create([
            'cfr_id' => $cfr_id,
            'site' => $site,
            'type' => $type,
            'customer' => $customer,
            'customer_location' => $customer_location,
            'customer_contact' => $customer_contact,
            'customer_phone' => $customer_phone,
            'customer_email' => $customer_email,
            'description' => $description,
            'cfr_category' => $cfr_category,
            'originator' => $originator,
            'date_originated' => $date_originated,
            'root_cause' => $root_cause,
            'action_to_be_taken' => $action_to_be_taken,
            'assigned_to' => $assigned_to,
            'target_completion_date' => $target_completion_date,
            'completed_by' => $completed_by,
            'date_completed' => $date_completed,
            'feedback_to_customer' => $feedback_to_customer,
            'feedback_by' => $feedback_by,
            'effectiveness_evaluated' => $effectiveness_evaluated,
            'action_taken_effective' => $action_taken_effective,
            'what_action_was_taken' => $what_action_was_taken,
            'action_taken_by' => $action_taken_by,
            'date_of_feedback' => $date_of_feedback,
            'cpar_required' => $cpar_required,
            'if_yes_cpar' => $if_yes_cpar,
            'closed_by' => $closed_by,
            'closure_date' => $closure_date,
            'attachment_field' => $attachment_field,
            'photo_field' => $photo_field,
        ]);

        session()->flash('success', 'Record has been added successfully');

        return redirect(route('customer_feedback_records'));
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cfr = CustomerFeedbackRecords::find($id);
        return view('modules.customer_feedback_records.read_customer_feedback_records')->with('cfr', $cfr)
            ->with('siteArr', $siteArr);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cfr = CustomerFeedbackRecords::find($id);
        return view('modules.customer_feedback_records.edit_customer_feedback_records')->with('cfr', $cfr)
            ->with('siteArr', $siteArr);
    }

    public function update(CustomerFeedbackRecordsRequest $request)
    {
        $id = $request->id;
        $full_cfr_id = $request->cfr_id;
        $site = $request->site;
        $type = $request->type;
        $customer = $request->customer;
        $customer_location = $request->customer_location;
        $customer_contact = $request->customer_contact;
        $customer_phone = $request->customer_phone;
        $customer_email = $request->customer_email;
        $description = $request->description;
        $cfr_category = $request->cfr_category;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $root_cause = $request->root_cause;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $target_completion_date = $request->target_completion_date;
        $completed_by = $request->completed_by;
        $date_completed = $request->date_completed;
        $feedback_to_customer = $request->feedback_to_customer;
        $feedback_by = $request->feedback_by;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $date_of_feedback = $request->date_of_feedback;
        $cpar_required = $request->cpar_required;
        $if_yes_cpar = $request->if_yes_cpar;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        // Keep SAME running number, only update prefix based on site
        $numericPart = substr($full_cfr_id, strrpos($full_cfr_id, '-') + 1); // e.g. "0007"
        $numericPart = str_pad((int)$numericPart, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "CFR-CPCP-",
            "CPAE - Dubai"            => "CFR-CPAE-",
            "CPLA - Mandeville"       => "CFR-CPLA-",
            "CPTX - West Texas"       => "CFR-CPTX-",
            "CPUK - Aberdeen"         => "CFR-CPUK-",
        ];

        $cfrPrefix = $prefixMap[$site] ?? "CFR-";
        $cfr_id = $cfrPrefix . $numericPart;

        if ($request->file('attachment_field')) {
            $file = $request->file('attachment_field');
            $attachment_field = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/customer_feedback_records';

            // Upload file
            $file->move($location, $attachment_field);
        } else {
            $attachment_field = $request->old_attachment_field;
        }

        if ($request->file('photo_field')) {
            $file = $request->file('photo_field');
            $photo_field = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/customer_feedback_records';

            // Upload file
            $file->move($location, $photo_field);
        } else {
            $photo_field = $request->old_photo_field;
        }

        $cfr = DB::table('customer_feedback_records')
            ->where('id', $id)
            ->update([
                'cfr_id' => $cfr_id,
                'site' => $site,
                'type' => $type,
                'customer' => $customer,
                'customer_location' => $customer_location,
                'customer_contact' => $customer_contact,
                'customer_phone' => $customer_phone,
                'customer_email' => $customer_email,
                'description' => $description,
                'cfr_category' => $cfr_category,
                'originator' => $originator,
                'date_originated' => $date_originated,
                'root_cause' => $root_cause,
                'action_to_be_taken' => $action_to_be_taken,
                'assigned_to' => $assigned_to,
                'target_completion_date' => $target_completion_date,
                'completed_by' => $completed_by,
                'date_completed' => $date_completed,
                'feedback_to_customer' => $feedback_to_customer,
                'feedback_by' => $feedback_by,
                'effectiveness_evaluated' => $effectiveness_evaluated,
                'action_taken_effective' => $action_taken_effective,
                'what_action_was_taken' => $what_action_was_taken,
                'action_taken_by' => $action_taken_by,
                'date_of_feedback' => $date_of_feedback,
                'cpar_required' => $cpar_required,
                'if_yes_cpar' => $if_yes_cpar,
                'closed_by' => $closed_by,
                'closure_date' => $closure_date,
                'attachment_field' => $attachment_field,
                'photo_field' => $photo_field,
            ]);

        if ($cfr) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong');
        }

        return redirect(route('customer_feedback_records'));
    }

    public function delete($id)
    {
        $cfr = CustomerFeedbackRecords::find($id);
        $cfr->delete();

        session()->flash('success', 'Record has been deleted successfully');

        return redirect(route('customer_feedback_records'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new CustomerFeedbackRecordsExport(), 'customerfeedbackrecords.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new CustomerFeedbackRecordsImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('customer_feedback_records'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('customer_feedback_records'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('customer_feedback_records'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cfr = CustomerFeedbackRecords::find($id);
        return view('modules.customer_feedback_records.print_customer_feedback_records')->with('cfr', $cfr)
            ->with('siteArr', $siteArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $cfr = CustomerFeedbackRecords::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.customer_feedback_records.mail_customer_feedback_records')->with('cfr', $cfr)
            ->with('siteArr', $siteArr)->with('users', $users);
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
        $cfr = CustomerFeedbackRecords::find($id);
        $base_url = $site_urlArr['base_url'];

        $personal_message = $request->personal_message;

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'cfr_id' => $cfr->cfr_id,
            'site' => $cfr->site,
            'type' => $cfr->type,
            'customer' => $cfr->customer,
            'customer_location' => $cfr->customer_location,
            'customer_contact' => $cfr->customer_contact,
            'customer_phone' => $cfr->customer_phone,
            'customer_email' => $cfr->customer_email,
            'description' => $cfr->description,
            'cfr_category' => $cfr->cfr_category,
            'originator' => $cfr->originator,
            'date_originated' => $cfr->date_originated,
            'root_cause' => $cfr->root_cause,
            'action_to_be_taken' => $cfr->action_to_be_taken,
            'assigned_to' => $cfr->assigned_to,
            'target_completion_date' => $cfr->target_completion_date,
            'completed_by' => $cfr->completed_by,
            'date_completed' => $cfr->date_completed,
            'feedback_to_customer' => $cfr->feedback_to_customer,
            'feedback_by' => $cfr->feedback_by,
            'effectiveness_evaluated' => $cfr->effectiveness_evaluated,
            'action_taken_effective' => $cfr->action_taken_effective,
            'what_action_was_taken' => $cfr->what_action_was_taken,
            'action_taken_by' => $cfr->action_taken_by,
            'date_of_feedback' => $cfr->date_of_feedback,
            'cpar_required' => $cfr->cpar_required,
            'if_yes_cpar' => $cfr->if_yes_cpar,
            'attachment_field' => $cfr->attachment_field,
            'photo_field' => $cfr->photo_field,
            'closed_by' => $cfr->closed_by,
            'closure_date' => $cfr->closure_date,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new CustomerFeedbackRecordsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('customer_feedback_records'));
    }
}
