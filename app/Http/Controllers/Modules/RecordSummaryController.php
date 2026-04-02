<?php

namespace App\Http\Controllers\Modules;

use App\Exports\RecordSummaryExport;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecordSummaryRequest;
use App\Imports\RecordSummaryImport;
use App\Mail\RecordSummaryMail;
use App\Models\Modules\RecordSummary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;
use App\Helpers\FilterHelper;

class RecordSummaryController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = RecordSummary::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $record_summaries = $query->get();

        return view('modules.record_summary.record_summary')
            ->with('record_summaries', $record_summaries)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function read($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $record_summary_locationArr = $options['record_summary_location'];
        $record_summary_typeArr = $options['record_summary_type'];
        $record_summary_fileArr = $options['record_summary_file'];
        $record_summary_maintained_byArr = $options['record_summary_maintained_by'];
        $record_summary_minimum_retention_byArr = $options['record_summary_minimum_retention'];
        $record_summary_record_status_byArr = $options['record_summary_record_status'];

        $record_summaries = RecordSummary::find($id);

        return view('modules.record_summary.read_record_summary')
            ->with('siteArr', $siteArr)
            ->with('record_summary_locationArr', $record_summary_locationArr)
            ->with('record_summary_typeArr', $record_summary_typeArr)
            ->with('record_summary_fileArr', $record_summary_fileArr)
            ->with('record_summary_maintained_byArr', $record_summary_maintained_byArr)
            ->with('record_summary_minimum_retention_byArr', $record_summary_minimum_retention_byArr)
            ->with('record_summary_record_status_byArr', $record_summary_record_status_byArr)
            ->with('record_summaries', $record_summaries);
    }

    public function create()
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $record_summary_locationArr = $options['record_summary_location'];
        $record_summary_typeArr = $options['record_summary_type'];
        $record_summary_fileArr = $options['record_summary_file'];
        $record_summary_maintained_byArr = $options['record_summary_maintained_by'];
        $record_summary_minimum_retention_byArr = $options['record_summary_minimum_retention'];
        $record_summary_record_status_byArr = $options['record_summary_record_status'];

        return view('modules.record_summary.create_record_summary')
            ->with('siteArr', $siteArr)
            ->with('record_summary_locationArr', $record_summary_locationArr)
            ->with('record_summary_typeArr', $record_summary_typeArr)
            ->with('record_summary_fileArr', $record_summary_fileArr)
            ->with('record_summary_maintained_byArr', $record_summary_maintained_byArr)
            ->with('record_summary_minimum_retention_byArr', $record_summary_minimum_retention_byArr)
            ->with('record_summary_record_status_byArr', $record_summary_record_status_byArr);
    }

    public function store(RecordSummaryRequest $request)
    {
        $record_title = $request->record_title;
        $doc_id = $request->doc_id;
        $site = $request->site;
        $location = $request->location;
        $type = $request->type;
        $file_manual_title = $request->file_manual_title;
        $maintained_by = $request->maintained_by;
        $minimum_retention = $request->minimum_retention;
        $record_status = $request->record_status;
        $comments = $request->comments;

        $record_summary = RecordSummary::create([
            'record_title' => $record_title,
            'doc_id' => $doc_id,
            'site' => $site,
            'location' => $location,
            'type' => $type,
            'file_manual_title' => $file_manual_title,
            'maintained_by' => $maintained_by,
            'minimum_retention' => $minimum_retention,
            'record_status' => $record_status,
            'comments' => $comments,
        ]);

        if ($record_summary) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('record_summary'));
    }

    public function edit($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $record_summary_locationArr = $options['record_summary_location'];
        $record_summary_typeArr = $options['record_summary_type'];
        $record_summary_fileArr = $options['record_summary_file'];
        $record_summary_maintained_byArr = $options['record_summary_maintained_by'];
        $record_summary_minimum_retention_byArr = $options['record_summary_minimum_retention'];
        $record_summary_record_status_byArr = $options['record_summary_record_status'];

        $record_summaries = RecordSummary::find($id);

        return view('modules.record_summary.edit_record_summary')
            ->with('siteArr', $siteArr)
            ->with('record_summary_locationArr', $record_summary_locationArr)
            ->with('record_summary_typeArr', $record_summary_typeArr)
            ->with('record_summary_fileArr', $record_summary_fileArr)
            ->with('record_summary_maintained_byArr', $record_summary_maintained_byArr)
            ->with('record_summary_minimum_retention_byArr', $record_summary_minimum_retention_byArr)
            ->with('record_summary_record_status_byArr', $record_summary_record_status_byArr)
            ->with('record_summaries', $record_summaries);
    }

    public function update(RecordSummaryRequest $request)
    {
        $id = $request->id;
        $record_title = $request->record_title;
        $doc_id = $request->doc_id;
        $site = $request->site;
        $location = $request->location;
        $type = $request->type;
        $file_manual_title = $request->file_manual_title;
        $maintained_by = $request->maintained_by;
        $minimum_retention = $request->minimum_retention;
        $record_status = $request->record_status;
        $comments = $request->comments;

        $record_summaries = DB::table('record_summaries')
            ->where('id', $id)
            ->update([
                'record_title' => $record_title,
                'doc_id' => $doc_id,
                'site' => $site,
                'location' => $location,
                'type' => $type,
                'file_manual_title' => $file_manual_title,
                'maintained_by' => $maintained_by,
                'minimum_retention' => $minimum_retention,
                'record_status' => $record_status,
                'comments' => $comments,
            ]);

        if ($record_summaries) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('record_summary'));
    }

    public function delete($id)
    {
        $record_summaries = RecordSummary::find($id);
        $record_summariesDel = $record_summaries->delete();

        if ($record_summariesDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('record_summary'));
    }

    public function print($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $record_summary_locationArr = $options['record_summary_location'];
        $record_summary_typeArr = $options['record_summary_type'];
        $record_summary_fileArr = $options['record_summary_file'];
        $record_summary_maintained_byArr = $options['record_summary_maintained_by'];
        $record_summary_minimum_retention_byArr = $options['record_summary_minimum_retention'];
        $record_summary_record_status_byArr = $options['record_summary_record_status'];

        $record_summaries = RecordSummary::find($id);

        return view('modules.record_summary.print_record_summary')
            ->with('siteArr', $siteArr)
            ->with('record_summary_locationArr', $record_summary_locationArr)
            ->with('record_summary_typeArr', $record_summary_typeArr)
            ->with('record_summary_fileArr', $record_summary_fileArr)
            ->with('record_summary_maintained_byArr', $record_summary_maintained_byArr)
            ->with('record_summary_minimum_retention_byArr', $record_summary_minimum_retention_byArr)
            ->with('record_summary_record_status_byArr', $record_summary_record_status_byArr)
            ->with('record_summaries', $record_summaries);
    }

    public function email($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $record_summary_locationArr = $options['record_summary_location'];
        $record_summary_typeArr = $options['record_summary_type'];
        $record_summary_fileArr = $options['record_summary_file'];
        $record_summary_maintained_byArr = $options['record_summary_maintained_by'];
        $record_summary_minimum_retention_byArr = $options['record_summary_minimum_retention'];
        $record_summary_record_status_byArr = $options['record_summary_record_status'];

        $record_summaries = RecordSummary::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.record_summary.mail_record_summary')
            ->with('siteArr', $siteArr)
            ->with('record_summary_locationArr', $record_summary_locationArr)
            ->with('record_summary_typeArr', $record_summary_typeArr)
            ->with('record_summary_fileArr', $record_summary_fileArr)
            ->with('record_summary_maintained_byArr', $record_summary_maintained_byArr)
            ->with('record_summary_minimum_retention_byArr', $record_summary_minimum_retention_byArr)
            ->with('record_summary_record_status_byArr', $record_summary_record_status_byArr)
            ->with('users', $users)
            ->with('record_summaries', $record_summaries);
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

        $record_summaries = RecordSummary::find($id);


        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'record_title' => $record_summaries->record_title,
            'doc_id' => $record_summaries->doc_id,
            'site' => $record_summaries->site,
            'location' => $record_summaries->location,
            'type' => $record_summaries->type,
            'file_manual_title' => $record_summaries->file_manual_title,
            'maintained_by' => $record_summaries->maintained_by,
            'minimum_retention' => $record_summaries->minimum_retention,
            'record_status' => $record_summaries->record_status,
            'comments' => $record_summaries->comments,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new RecordSummaryMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('record_summary'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new RecordSummaryExport, 'record_summary.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new RecordSummaryImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('record_summary'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('record_summary'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('record_summary'));
    }

    public function addLocation(Request $request)
    {
        $newLocation = $request->input('value');

        if (empty($newLocation)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('record_summary_location', $newLocation);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }
    }
    public function addType(Request $request)
    {
        $newType = $request->input('value');

        if (empty($newType)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('record_summary_type', $newType);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }
    }
    public function addFileManualTitle(Request $request)
    {
        $newFileManualTitle = $request->input('value');

        if (empty($newFileManualTitle)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('record_summary_file', $newFileManualTitle);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }
    }
    public function addMaintainedBy(Request $request)
    {
        $newMaintainedBy = $request->input('value');

        if (empty($newMaintainedBy)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('record_summary_maintained_by', $newMaintainedBy);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }
    }
    public function addMinimumRetention(Request $request)
    {
        $newMinimumRetention = $request->input('value');

        if (empty($newMinimumRetention)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('record_summary_minimum_retention', $newMinimumRetention);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }
    }
}
