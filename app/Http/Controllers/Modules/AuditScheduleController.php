<?php

namespace App\Http\Controllers\Modules;

use App\Exports\AuditScheduleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuditScheduleRequest;
use App\Imports\AuditScheduleImport;
use App\Mail\AuditScheduleMail;
use App\Mail\CPARsMail;
use App\Models\Modules\AuditSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class AuditScheduleController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = AuditSchedule::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $audit_schedules = $query->get();

        return view('modules.audit_schedule.audit_schedule')
            ->with('audit_schedules', $audit_schedules)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $auditTypeArr = $options['audit_type'];
        $subTypeArr = $options['sub_type'];
        $auditYearArr = $options['audit_year'];
        $statusArr = $options['status'];

        return view('modules.audit_schedule.create_audit_schedule')
            ->with('siteArr', $siteArr)
            ->with('auditTypeArr', $auditTypeArr)
            ->with('subTypeArr', $subTypeArr)
            ->with('auditYearArr', $auditYearArr)
            ->with('statusArr', $statusArr);
    }

    public function store(AuditScheduleRequest $request)
    {
        $site = $request->site;
        $audit_id = $request->audit_id;
        $audit_type = $request->audit_type;
        $sub_type = $request->sub_type;
        $start_date = $request->start_date;
        $dates = $request->dates;
        $audit_year = $request->audit_year;
        $status = $request->status;
        $audit_completion_date = $request->audit_completion_date;
        $num_of_issues = $request->num_of_issues;
        $comments = $request->comments;

        if ($request->file('audit_schedule')) {
            $file = $request->file('audit_schedule');
            $audit_schedule = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $audit_schedule);
        } else {
            $audit_schedule = '';
        }

        if ($request->file('audit_checklist')) {
            $file = $request->file('audit_checklist');
            $audit_checklist = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $audit_checklist);
        } else {
            $audit_checklist = '';
        }

        if ($request->file('audit_report')) {
            $file = $request->file('audit_report');
            $audit_report = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $audit_report);
        } else {
            $audit_report = '';
        }

        if ($request->file('abs_cpar_acceptance')) {
            $file = $request->file('abs_cpar_acceptance');
            $abs_cpar_acceptance = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $abs_cpar_acceptance);
        } else {
            $abs_cpar_acceptance = '';
        }

        if ($request->file('nonconformity_note_attachment')) {
            $file = $request->file('nonconformity_note_attachment');
            $nonconformity_note_attachment = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $nonconformity_note_attachment);
        } else {
            $nonconformity_note_attachment = '';
        }

        $audit_schedule = AuditSchedule::create([
            'site' => $site,
            'audit_id' => $audit_id,
            'audit_type' => $audit_type,
            'sub_type' => $sub_type,
            'start_date' => $start_date,
            'dates' => $dates,
            'audit_year' => $audit_year,
            'status' => $status,
            'audit_completion_date' => $audit_completion_date,
            'num_of_issues' => $num_of_issues,
            'comments' => $comments,
            'audit_schedule' => $audit_schedule,
            'audit_checklist' => $audit_checklist,
            'audit_report' => $audit_report,
            'abs_cpar_acceptance' => $abs_cpar_acceptance,
            'nonconformity_note_attachment' => $nonconformity_note_attachment,
        ]);

        if ($audit_schedule) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('audit_schedule'));
    }

    public function read($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $auditTypeArr = $options['audit_type'];
        $subTypeArr = $options['sub_type'];
        $auditYearArr = $options['audit_year'];
        $statusArr = $options['status'];

        $audit_schedule = AuditSchedule::find($id);

        return view('modules.audit_schedule.read_audit_schedule')
            ->with('siteArr', $siteArr)
            ->with('auditTypeArr', $auditTypeArr)
            ->with('subTypeArr', $subTypeArr)
            ->with('auditYearArr', $auditYearArr)
            ->with('statusArr', $statusArr)
            ->with('audit_schedule', $audit_schedule);
    }

    public function edit($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $auditTypeArr = $options['audit_type'];
        $subTypeArr = $options['sub_type'];
        $auditYearArr = $options['audit_year'];
        $statusArr = $options['status'];

        $audit_schedule = AuditSchedule::find($id);

        return view('modules.audit_schedule.edit_audit_schedule')
            ->with('siteArr', $siteArr)
            ->with('auditTypeArr', $auditTypeArr)
            ->with('subTypeArr', $subTypeArr)
            ->with('auditYearArr', $auditYearArr)
            ->with('statusArr', $statusArr)
            ->with('audit_schedule', $audit_schedule);
    }

    public function update(AuditScheduleRequest $request)
    {
        $id = $request->id;
        $site = $request->site;
        $audit_id = $request->audit_id;
        $audit_type = $request->audit_type;
        $sub_type = $request->sub_type;
        $start_date = $request->start_date;
        $dates = $request->dates;
        $audit_year = $request->audit_year;
        $audit_completion_date = $request->audit_completion_date;
        $status = $request->status;
        $num_of_issues = $request->num_of_issues;
        $comments = $request->comments;

        if ($request->file('audit_schedule')) {
            $file = $request->file('audit_schedule');
            $audit_schedule = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $audit_schedule);
        } else {
            $audit_schedule = $request->old_audit_schedule;
        }

        if ($request->file('audit_checklist')) {
            $file = $request->file('audit_checklist');
            $audit_checklist = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $audit_checklist);
        } else {
            $audit_checklist = $request->old_audit_checklist;
        }

        if ($request->file('audit_report')) {
            $file = $request->file('audit_report');
            $audit_report = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $audit_report);
        } else {
            $audit_report = $request->old_audit_report;
        }

        if ($request->file('abs_cpar_acceptance')) {
            $file = $request->file('abs_cpar_acceptance');
            $abs_cpar_acceptance = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $abs_cpar_acceptance);
        } else {
            $abs_cpar_acceptance = $request->old_abs_cpar_acceptance;
        }

        if ($request->file('nonconformity_note_attachment')) {
            $file = $request->file('nonconformity_note_attachment');
            $nonconformity_note_attachment = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/audit_schedule';

            // Upload file
            $file->move($location, $nonconformity_note_attachment);
        } else {
            $nonconformity_note_attachment = $request->old_nonconformity_note_attachment;
        }

        $audit_schedule = DB::table('audit_schedules')
            ->where('id', $id)
            ->update([
                'site' => $site,
                'audit_id' => $audit_id,
                'audit_type' => $audit_type,
                'sub_type' => $sub_type,
                'start_date' => $start_date,
                'dates' => $dates,
                'audit_year' => $audit_year,
                'status' => $status,
                'audit_completion_date' => $audit_completion_date,
                'num_of_issues' => $num_of_issues,
                'comments' => $comments,
                'audit_schedule' => $audit_schedule,
                'audit_checklist' => $audit_checklist,
                'audit_report' => $audit_report,
                'abs_cpar_acceptance' => $abs_cpar_acceptance,
                'nonconformity_note_attachment' => $nonconformity_note_attachment,
            ]);

        if ($audit_schedule) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('audit_schedule'));
    }

    public function delete($id)
    {
        $audit_schedule = AuditSchedule::find($id);
        $audit_schedule_del = $audit_schedule->delete();

        if ($audit_schedule_del) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('audit_schedule'));
    }

    public function print($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $auditTypeArr = $options['audit_type'];
        $subTypeArr = $options['sub_type'];
        $auditYearArr = $options['audit_year'];
        $statusArr = $options['status'];

        $audit_schedule = AuditSchedule::find($id);

        return view('modules.audit_schedule.print_audit_schedule')
            ->with('siteArr', $siteArr)
            ->with('auditTypeArr', $auditTypeArr)
            ->with('subTypeArr', $subTypeArr)
            ->with('auditYearArr', $auditYearArr)
            ->with('statusArr', $statusArr)
            ->with('audit_schedule', $audit_schedule);
    }

    public function email($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $auditTypeArr = $options['audit_type'];
        $subTypeArr = $options['sub_type'];
        $auditYearArr = $options['audit_year'];
        $statusArr = $options['status'];

        $audit_schedule = AuditSchedule::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.audit_schedule.mail_audit_schedule')
            ->with('siteArr', $siteArr)
            ->with('auditTypeArr', $auditTypeArr)
            ->with('subTypeArr', $subTypeArr)
            ->with('auditYearArr', $auditYearArr)
            ->with('statusArr', $statusArr)
            ->with('audit_schedule', $audit_schedule)
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

        $audit_schedule = AuditSchedule::find($id);

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'site' => $audit_schedule->site,
            'audit_id' => $audit_schedule->audit_id,
            'audit_type' => $audit_schedule->audit_type,
            'sub_type' => $audit_schedule->sub_type,
            'start_date' => $audit_schedule->start_date,
            'dates' => $audit_schedule->dates,
            'audit_year' => $audit_schedule->audit_year,
            'status' => $audit_schedule->status,
            'audit_completion_date' => $audit_schedule->audit_completion_date,
            'num_of_issues' => $audit_schedule->num_of_issues,
            'comments' => $audit_schedule->comments,
            'audit_schedule' => $audit_schedule->audit_schedule,
            'audit_checklist' => $audit_schedule->audit_checklist,
            'audit_report' => $audit_schedule->audit_report,
            'abs_cpar_acceptance' => $audit_schedule->abs_cpar_acceptance,
            'nonconformity_note_attachment' => $audit_schedule->nonconformity_note_attachment,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new AuditScheduleMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('audit_schedule'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new AuditScheduleExport, 'AuditSchedule.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new AuditScheduleImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('audit_schedule'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('audit_schedule'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('audit_schedule'));
    }
}
