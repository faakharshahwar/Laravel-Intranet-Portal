<?php

namespace App\Http\Controllers\Modules;

use App\Exports\InspectionReportExport;
use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\InspectionReportRequest;
use App\Imports\InspectionReportImport;
use App\Mail\InspectionReportMail;
use App\Models\Modules\InspectionReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;
use App\Helpers\GlobalHelper;

class InspectionReportsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $query = InspectionReport::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $inspection_reports = $query->get();

        return view('modules.inspection_reports.inspection_reports')
            ->with('siteArr', $siteArr)
            ->with('inspection_reports', $inspection_reports)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $reportTypeArr = $options['report_type'];
        $statusArr = $options['status'];

        return view('modules.inspection_reports.create_inspection_reports')
            ->with('siteArr', $siteArr)
            ->with('reportTypeArr', $reportTypeArr)
            ->with('statusArr', $statusArr);
    }

    public function store(InspectionReportRequest $request)
    {
        $site = $request->site;
        $description = $request->description;
        $report_type = $request->report_type;
        $completion_date = $request->completion_date;
        $status = $request->status;
        $next_due_date = $request->next_due_date;
        $remarks = $request->remarks;

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $attachment_1 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/inspection_reports';

            // Upload file
            $file->move($file_location, $attachment_1);
        } else {
            $attachment_1 = $request->attachment_1;
        }

        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $attachment_2 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/inspection_reports';

            // Upload file
            $file->move($file_location, $attachment_2);
        } else {
            $attachment_2 = $request->attachment_2;
        }

        if ($request->file('attachment_3')) {
            $file = $request->file('attachment_3');
            $attachment_3 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/inspection_reports';

            // Upload file
            $file->move($file_location, $attachment_3);
        } else {
            $attachment_3 = $request->attachment_3;
        }

        $inspection_report = InspectionReport::create([
            'site' => $site,
            'description' => $description,
            'report_type' => $report_type,
            'completion_date' => $completion_date,
            'status' => $status,
            'next_due_date' => $next_due_date,
            'remarks' => $remarks,
            'attachment_1' => $attachment_1,
            'attachment_2' => $attachment_2,
            'attachment_3' => $attachment_3
        ]);

        if ($inspection_report) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('inspection_reports'));
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $reportTypeArr = $options['report_type'];
        $statusArr = $options['status'];

        $inspection_report = InspectionReport::find($id);

        return view('modules.inspection_reports.read_inspection_reports')
            ->with('siteArr', $siteArr)
            ->with('inspection_report', $inspection_report)
            ->with('statusArr', $statusArr)
            ->with('reportTypeArr', $reportTypeArr);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $reportTypeArr = $options['report_type'];
        $statusArr = $options['status'];

        $inspection_report = InspectionReport::find($id);

        return view('modules.inspection_reports.edit_inspection_reports')
            ->with('siteArr', $siteArr)
            ->with('inspection_report', $inspection_report)
            ->with('statusArr', $statusArr)
            ->with('reportTypeArr', $reportTypeArr);
    }

    public function update(InspectionReportRequest $request)
    {
        $id = $request->id;
        $site = $request->site;
        $description = $request->description;
        $report_type = $request->report_type;
        $completion_date = $request->completion_date;
        $next_due_date = $request->next_due_date;
        $remarks = $request->remarks;
        $status = $request->status;

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $attachment_1 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/inspection_reports';

            // Upload file
            $file->move($file_location, $attachment_1);
        } else {
            $attachment_1 = $request->old_attachment_1;
        }

        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $attachment_2 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/inspection_reports';

            // Upload file
            $file->move($file_location, $attachment_2);
        } else {
            $attachment_2 = $request->old_attachment_2;
        }

        if ($request->file('attachment_3')) {
            $file = $request->file('attachment_3');
            $attachment_3 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/inspection_reports';

            // Upload file
            $file->move($file_location, $attachment_3);
        } else {
            $attachment_3 = $request->old_attachment_3;
        }

        $inspection_report = DB::table('inspection_reports')
            ->where('id', $id)
            ->update([
                'site' => $site,
                'description' => $description,
                'report_type' => $report_type,
                'completion_date' => $completion_date,
                'status' => $status,
                'next_due_date' => $next_due_date,
                'remarks' => $remarks,
                'attachment_1' => $attachment_1,
                'attachment_2' => $attachment_2,
                'attachment_3' => $attachment_3
            ]);

        if ($inspection_report) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('inspection_reports'));
    }

    public function delete($id)
    {
        $inspection_report = InspectionReport::find($id);
        $inspection_reportDel = $inspection_report->delete();

        if ($inspection_reportDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('inspection_reports'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $reportTypeArr = $options['report_type'];
        $statusArr = $options['status'];

        $inspection_report = InspectionReport::find($id);

        return view('modules.inspection_reports.print_inspection_report')
            ->with('siteArr', $siteArr)
            ->with('inspection_report', $inspection_report)
            ->with('statusArr', $statusArr)
            ->with('reportTypeArr', $reportTypeArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $reportTypeArr = $options['report_type'];
        $statusArr = $options['status'];

        $inspection_report = InspectionReport::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.inspection_reports.mail_inspection_report')
            ->with('siteArr', $siteArr)
            ->with('inspection_report', $inspection_report)
            ->with('users', $users)
            ->with('statusArr', $statusArr)
            ->with('reportTypeArr', $reportTypeArr);
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

        $inspection_report = InspectionReport::find($id);

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'site' => $inspection_report->site,
            'description' => $inspection_report->description,
            'report_type' => $inspection_report->report_type,
            'completion_date' => $inspection_report->completion_date,
            'status' => $inspection_report->status,
            'next_due_date' => $inspection_report->next_due_date,
            'attachment_1' => $inspection_report->attachment_1,
            'attachment_2' => $inspection_report->attachment_2,
            'attachment_3' => $inspection_report->attachment_3,
            'remarks' => $inspection_report->remarks,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new InspectionReportMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('inspection_reports'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new InspectionReportExport, 'inspectionReport.csv');
    }

    public function ImportIntoCSV(Request $request)
    {

        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new InspectionReportImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('inspection_reports'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('external_document'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('inspection_reports'));
    }

    public function addReportType(Request $request)
    {
        $newReportType = $request->input('value');

        if (empty($newReportType)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('report_type', $newReportType);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }
}
