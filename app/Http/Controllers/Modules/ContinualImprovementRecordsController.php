<?php

namespace App\Http\Controllers\Modules;

use App\Exports\ContinualImprovementRecordsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContinualImprovementRecordsRequest;
use App\Imports\ContinualImprovementRecordsImport;
use App\Mail\ContinualImprovementRecordsMail;
use App\Models\Modules\ContinualImprovementRecords;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class ContinualImprovementRecordsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = ContinualImprovementRecords::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $cir = $query->get();

        return view('modules.continual_improvement_records.continual_improvement_records')
            ->with('continual_improvement_records', $cir)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        return view('modules.continual_improvement_records.create_continual_improvement_records')
            ->with('siteArr', $siteArr);
    }

    public function store(ContinualImprovementRecordsRequest $request)
    {
        $site = $request->site;
        $cir_concise_description = $request->cir_concise_description;
        $improvement_opportunity = $request->improvement_opportunity;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $cir_type = $request->cir_type;
        $department = $request->department;
        $responsible_manager = $request->responsible_manager;
        $responsible_mgr_approval_date = $request->responsible_mgr_approval_date;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $target_completion_date = $request->target_completion_date;
        $action_that_was_taken = $request->action_that_was_taken;
        $action_completed_by = $request->action_completed_by;
        $date_action_was_completed = $request->date_action_was_completed;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        if ($request->file('file_attachment_1')) {
            $file = $request->file('file_attachment_1');
            $filename_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/continual_improvement_records';

            // Upload file
            $file->move($location, $filename_1);
        } else {
            $filename_1 = '';
        }
        if ($request->file('file_attachment_2')) {
            $file = $request->file('file_attachment_2');
            $filename_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/continual_improvement_records';

            // Upload file
            $file->move($location, $filename_2);
        } else {
            $filename_2 = '';
        }

        // Get next global CIR running number (across ALL sites)
        $maxNumeric = ContinualImprovementRecords::pluck('cir_id')
            ->map(function ($id) {
                // Example: CIR-CPLA-0002 → 2
                return (int) substr($id, strrpos($id, '-') + 1);
            })
            ->max();

        $nextNumber = ($maxNumeric ?? 0) + 1;
        $maxValueNCR = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "CIR-CPCP-",
            "CPAE - Dubai"            => "CIR-CPAE-",
            "CPLA - Mandeville"       => "CIR-CPLA-",
            "CPTX - West Texas"       => "CIR-CPTX-",
            "CPUK - Aberdeen"         => "CIR-CPUK-",
        ];

        $cirPrefix = $prefixMap[$site] ?? "CIR-";
        $cir_id = $cirPrefix . $maxValueNCR;


        $cir = ContinualImprovementRecords::create([
            'cir_id' => $cir_id,
            'site' => $site,
            'cir_concise_description' => $cir_concise_description,
            'improvement_opportunity' => $improvement_opportunity,
            'originator' => $originator,
            'date_originated' => $date_originated,
            'cir_type' => $cir_type,
            'department' => $department,
            'responsible_manager' => $responsible_manager,
            'responsible_mgr_approval_date' => $responsible_mgr_approval_date,
            'action_to_be_taken' => $action_to_be_taken,
            'file_attachment_1' => $filename_1,
            'file_attachment_2' => $filename_2,
            'assigned_to' => $assigned_to,
            'target_completion_date' => $target_completion_date,
            'action_that_was_taken' => $action_that_was_taken,
            'action_completed_by' => $action_completed_by,
            'date_action_was_completed' => $date_action_was_completed,
            'closed_by' => $closed_by,
            'closure_date' => $closure_date,
        ]);

        if ($cir) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('continual_improvement_records'));
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $cir = ContinualImprovementRecords::find($id);

        return view('modules.continual_improvement_records.edit_continual_improvement_records')->with('cir', $cir)
            ->with('siteArr', $siteArr);
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $cir = ContinualImprovementRecords::find($id);

        return view('modules.continual_improvement_records.read_continual_improvement_records')->with('cir', $cir)
            ->with('siteArr', $siteArr);
    }

    public function update(ContinualImprovementRecordsRequest $request)
    {
        $id = $request->id;
        $cir_id = $request->cir_id;
        $site = $request->site;
        $cir_concise_description = $request->cir_concise_description;
        $improvement_opportunity = $request->improvement_opportunity;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $cir_type = $request->cir_type;
        $department = $request->department;
        $responsible_manager = $request->responsible_manager;
        $responsible_mgr_approval_date = $request->responsible_mgr_approval_date;
        $action_to_be_taken = $request->action_to_be_taken;
        $assigned_to = $request->assigned_to;
        $target_completion_date = $request->target_completion_date;
        $action_that_was_taken = $request->action_that_was_taken;
        $action_completed_by = $request->action_completed_by;
        $date_action_was_completed = $request->date_action_was_completed;
        $closed_by = $request->closed_by;
        $closure_date = $request->closure_date;

        if ($request->file('file_attachment_1')) {
            $file = $request->file('file_attachment_1');
            $filename_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/continual_improvement_records';

            // Upload file
            $file->move($location, $filename_1);
        } else {
            $filename_1 = $request->old_attachment_1;
        }
        if ($request->file('file_attachment_2')) {
            $file = $request->file('file_attachment_2');
            $filename_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/continual_improvement_records';

            // Upload file
            $file->move($location, $filename_2);
        } else {
            $filename_2 = $request->old_attachment_2;
        }

        // Keep SAME running number, only update prefix based on site
        $numericPart = substr($cir_id, strrpos($cir_id, '-') + 1); // e.g. "0007"
        $numericPart = str_pad((int)$numericPart, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "CIR-CPCP-",
            "CPAE - Dubai"            => "CIR-CPAE-",
            "CPLA - Mandeville"       => "CIR-CPLA-",
            "CPTX - West Texas"       => "CIR-CPTX-",
            "CPUK - Aberdeen"         => "CIR-CPUK-",
        ];

        $cirPrefix = $prefixMap[$site] ?? "CIR-";
        $cir_id = $cirPrefix . $numericPart;


        $cir = DB::table('continual_improvement_records')
            ->where('id', $id)
            ->update([
                'cir_id' => $cir_id,
                'site' => $site,
                'cir_concise_description' => $cir_concise_description,
                'improvement_opportunity' => $improvement_opportunity,
                'originator' => $originator,
                'date_originated' => $date_originated,
                'cir_type' => $cir_type,
                'department' => $department,
                'responsible_manager' => $responsible_manager,
                'responsible_mgr_approval_date' => $responsible_mgr_approval_date,
                'action_to_be_taken' => $action_to_be_taken,
                'file_attachment_1' => $filename_1,
                'file_attachment_2' => $filename_2,
                'assigned_to' => $assigned_to,
                'target_completion_date' => $target_completion_date,
                'action_that_was_taken' => $action_that_was_taken,
                'action_completed_by' => $action_completed_by,
                'date_action_was_completed' => $date_action_was_completed,
                'closed_by' => $closed_by,
                'closure_date' => $closure_date,
            ]);

        if ($cir) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('continual_improvement_records'));
    }

    public function delete($id)
    {
        $cir = ContinualImprovementRecords::find($id);
        $cir->delete();

        session()->flash('success', 'Record has been deleted successfully');
        return redirect(route('continual_improvement_records'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new ContinualImprovementRecordsExport, 'continualImprovementRecords.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new ContinualImprovementRecordsImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('continual_improvement_records'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('continual_improvement_records'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('continual_improvement_records'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $cir = ContinualImprovementRecords::find($id);

        return view('modules.continual_improvement_records.print_continual_improvement_records')->with('cir', $cir)
            ->with('siteArr', $siteArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $cir = ContinualImprovementRecords::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.continual_improvement_records.mail_continual_improvement_records')->with('cir', $cir)
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
        $base_url = $site_urlArr['base_url'];

        $cir = ContinualImprovementRecords::find($id);

        $personal_message = $request->personal_message;

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'cir_id' => $cir->cir_id,
            'site' => $cir->site,
            'cir_concise_description' => $cir->cir_concise_description,
            'improvement_opportunity' => $cir->improvement_opportunity,
            'originator' => $cir->originator,
            'date_originated' => $cir->date_originated,
            'cir_type' => $cir->cir_type,
            'department' => $cir->department,
            'responsible_manager' => $cir->responsible_manager,
            'responsible_mgr_approval_date' => $cir->responsible_mgr_approval_date,
            'action_to_be_taken' => $cir->action_to_be_taken,
            'file_attachment_1' => $cir->filename_1,
            'file_attachment_2' => $cir->filename_2,
            'assigned_to' => $cir->assigned_to,
            'target_completion_date' => $cir->target_completion_date,
            'action_that_was_taken' => $cir->action_that_was_taken,
            'action_completed_by' => $cir->action_completed_by,
            'date_action_was_completed' => $cir->date_action_was_completed,
            'closed_by' => $cir->closed_by,
            'closure_date' => $cir->closure_date,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new ContinualImprovementRecordsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('rars'));
    }
}
