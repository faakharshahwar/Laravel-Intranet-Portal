<?php

namespace App\Http\Controllers\Modules;

use App\Exports\QualifiedAuditorsListExport;
use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\QualifiedAuditorsListRequest;
use App\Imports\QualifiedAuditorsListImport;
use App\Mail\QualifiedAuditorsMail;
use App\Models\Modules\QualifiedAuditorsLists;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Excel;

class QualifiedAuditorsListController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = QualifiedAuditorsLists::orderBy('qualified_auditors_lists.id', 'desc')
            ->leftJoin('users as name', 'qualified_auditors_lists.auditor_name', '=', 'name.id')
            ->select([
                'qualified_auditors_lists.*',
                'name.first_name as auditor_name_first_name',
                'name.last_name as auditor_name_last_name',
            ]);
        $query = FilterHelper::filterBySite($query, $request);
        $auditors = $query->get();

        return view('modules.qualified_auditors_list.qualified_auditors_list')
            ->with('auditors', $auditors)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $auditor_statusArr = $options['auditor_status'];
        $qualification_basisArr = $options['qualification_basis'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.qualified_auditors_list.create_qualified_auditors_list')
            ->with('users', $users)
            ->with('siteArr', $siteArr)
            ->with('auditor_statusArr', $auditor_statusArr)
            ->with('qualification_basisArr', $qualification_basisArr);
    }

    public function store(QualifiedAuditorsListRequest $request)
    {
        $auditor_name = $request->auditor_name;
        $site = $request->site;
        $auditor_status = $request->auditor_status;
        $qualification_basis_1 = $request->qualification_basis_1;
        $qualification_basis_2 = $request->qualification_basis_2;
        $qualification_basis_3 = $request->qualification_basis_3;
        $comments = $request->comments;
        $web_link_1 = $request->web_link_1;
        $web_link_2 = $request->web_link_2;

        if ($request->file('file_attachment_1')) {
            $file = $request->file('file_attachment_1');
            $file_attachment_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/qualified_auditors_list';

            // Upload file
            $file->move($location, $file_attachment_1);
        } else {
            $file_attachment_1 = '';
        }

        if ($request->file('file_attachment_2')) {
            $file = $request->file('file_attachment_2');
            $file_attachment_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/qualified_auditors_list';

            // Upload file
            $file->move($location, $file_attachment_2);
        } else {
            $file_attachment_2 = '';
        }

        $qal = QualifiedAuditorsLists::create([
            'auditor_name' => $auditor_name,
            'site' => $site,
            'auditor_status' => $auditor_status,
            'qualification_basis_1' => $qualification_basis_1,
            'qualification_basis_2' => $qualification_basis_2,
            'qualification_basis_3' => $qualification_basis_3,
            'comments' => $comments,
            'web_link_1' => $web_link_1,
            'web_link_2' => $web_link_2,
            'file_attachment_1' => $file_attachment_1,
            'file_attachment_2' => $file_attachment_2,
        ]);

        if ($qal) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('qualified_auditors_list'));
    }

    public function read($id)
    {
        $qal = QualifiedAuditorsLists::find($id);

        $options = dynamicOptions();

        $siteArr = $options['site'];
        $auditor_statusArr = $options['auditor_status'];
        $qualification_basisArr = $options['qualification_basis'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.qualified_auditors_list.read_qualified_auditors_list')
            ->with('qal', $qal)
            ->with('users', $users)
            ->with('siteArr', $siteArr)
            ->with('auditor_statusArr', $auditor_statusArr)
            ->with('qualification_basisArr', $qualification_basisArr);
    }

    public function edit($id)
    {
        $qal = QualifiedAuditorsLists::find($id);

        $options = dynamicOptions();

        $siteArr = $options['site'];
        $auditor_statusArr = $options['auditor_status'];
        $qualification_basisArr = $options['qualification_basis'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.qualified_auditors_list.edit_qualified_auditors_list')
            ->with('qal', $qal)
            ->with('users', $users)
            ->with('siteArr', $siteArr)
            ->with('auditor_statusArr', $auditor_statusArr)
            ->with('qualification_basisArr', $qualification_basisArr);
    }

    public function update(QualifiedAuditorsListRequest $request)
    {
        $id = $request->id;
        $auditor_name = $request->auditor_name;
        $site = $request->site;
        $auditor_status = $request->auditor_status;
        $qualification_basis_1 = $request->qualification_basis_1;
        $qualification_basis_2 = $request->qualification_basis_2;
        $qualification_basis_3 = $request->qualification_basis_3;
        $comments = $request->comments;
        $web_link_1 = $request->web_link_1;
        $web_link_2 = $request->web_link_2;

        if ($request->file('file_attachment_1')) {
            $file = $request->file('file_attachment_1');
            $file_attachment_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/qualified_auditors_list';

            // Upload file
            $file->move($location, $file_attachment_1);
        } else {
            $file_attachment_1 = $request->old_file_attachment_1;
        }

        if ($request->file('file_attachment_2')) {
            $file = $request->file('file_attachment_2');
            $file_attachment_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/qualified_auditors_list';

            // Upload file
            $file->move($location, $file_attachment_2);
        } else {
            $file_attachment_2 = $request->old_file_attachment_2;
        }

        try {
            $qal = DB::table('qualified_auditors_lists')
                ->where('id', $id)
                ->update([
                    'auditor_name' => $auditor_name,
                    'site' => $site,
                    'auditor_status' => $auditor_status,
                    'qualification_basis_1' => $qualification_basis_1,
                    'qualification_basis_2' => $qualification_basis_2,
                    'qualification_basis_3' => $qualification_basis_3,
                    'comments' => $comments,
                    'web_link_1' => $web_link_1,
                    'web_link_2' => $web_link_2,
                    'file_attachment_1' => $file_attachment_1,
                    'file_attachment_2' => $file_attachment_2,
                ]);
            if ($qal) {
                session()->flash('success', 'Record has been updated successfully');
            } else {
                session()->flash('error', 'No changes were made.');
            }
        } catch (\Exception $e) {
            Log::error('Error updating record: ' . $e->getMessage());
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('qualified_auditors_list'));
    }

    public function delete($id)
    {
        $qal = QualifiedAuditorsLists::find($id);
        $qalDelete = $qal->delete();

        if ($qalDelete) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('qualified_auditors_list'));
    }

    public function print($id)
    {
        $qal = QualifiedAuditorsLists::orderBy('qualified_auditors_lists.id', 'desc')
            ->leftJoin('users as name', 'qualified_auditors_lists.auditor_name', '=', 'name.id')
            ->select([
                'qualified_auditors_lists.*',
                'name.first_name as auditor_name_first_name',
                'name.last_name as auditor_name_last_name',
            ])
            ->where('qualified_auditors_lists.id', $id)
            ->first();

        return view('modules.qualified_auditors_list.print_qualified_auditors_list')
            ->with('qal', $qal);
    }

    public function email($id)
    {
        $qal = QualifiedAuditorsLists::find($id);

        $options = dynamicOptions();

        $siteArr = $options['site'];
        $auditor_statusArr = $options['auditor_status'];
        $qualification_basisArr = $options['qualification_basis'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.qualified_auditors_list.mail_qualified_auditors_list')
            ->with('qal', $qal)
            ->with('users', $users)
            ->with('siteArr', $siteArr)
            ->with('auditor_statusArr', $auditor_statusArr)
            ->with('qualification_basisArr', $qualification_basisArr);
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

        $qal = QualifiedAuditorsLists::find($id);

        $auditor_name = User::find($qal->auditor_name);
        if ($auditor_name) {
            $auditor_name = $auditor_name->first_name . " " . $auditor_name->last_name;
        } else {
            $auditor_name = "";
        }

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'auditor_name' => $auditor_name,
            'site' => $qal->site,
            'auditor_status' => $qal->auditor_status,
            'qualification_basis_1' => $qal->qualification_basis_1,
            'qualification_basis_2' => $qal->qualification_basis_2,
            'qualification_basis_3' => $qal->qualification_basis_3,
            'comments' => $qal->comments,
            'file_attachment_1' => $qal->file_attachment_1,
            'file_attachment_2' => $qal->file_attachment_2,
            'web_link_1' => $qal->web_link_1,
            'web_link_2' => $qal->web_link_2,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new QualifiedAuditorsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('qualified_auditors_list'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new QualifiedAuditorsListExport(), 'QualifiedAuditorsList.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new QualifiedAuditorsListImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('qualified_auditors_list'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('qualified_auditors_list'));
            }
        }

        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('qualified_auditors_list'));

    }
}
