<?php

namespace App\Http\Controllers\Modules;

use App\Exports\ExternalDocumentExport;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExternalDocumentRequest;
use App\Imports\ExternalDocumentImport;
use App\Mail\ExternalDocumentMail;
use App\Models\Modules\ExternalDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;
use App\Helpers\FilterHelper;

class ExternalDocumentController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = ExternalDocument::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $external_documents = $query->get();

        return view('modules.external_document.external_document')
            ->with('external_documents', $external_documents)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function read($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $external_document_typeArr = $options['external_document_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $external_documents = ExternalDocument::find($id);

        return view('modules.external_document.read_external_document')
            ->with('siteArr', $siteArr)
            ->with('users', $users)
            ->with('external_documents', $external_documents)
            ->with('external_document_typeArr', $external_document_typeArr);
    }

    public function create()
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $external_document_typeArr = $options['external_document_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.external_document.create_external_document')
            ->with('siteArr', $siteArr)
            ->with('users', $users)
            ->with('external_document_typeArr', $external_document_typeArr);
    }

    public function store(ExternalDocumentRequest $request)
    {
        $site = $request->site;
        $doc_id = $request->doc_id;
        $document_type = $request->document_type;
        $organization = $request->organization;
        $title = $request->title;
        $effective_date = $request->effective_date;
        $verification_date = $request->verification_date;
        $verification_method = $request->verification_method;
        $verified_by = $request->verified_by;
        $next_verification_due_date = $request->next_verification_due_date;
        $primary_location_held = $request->primary_location_held;
        $web_linked_file = $request->web_linked_file;
        $comments = $request->comments;

        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $attachment = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/external_documents';

            // Upload file
            $file->move($file_location, $attachment);
        } else {
            $attachment = $request->attachment;
        }

        $external_document = ExternalDocument::create([
            'site' => $site,
            'doc_id' => $doc_id,
            'document_type' => $document_type,
            'organization' => $organization,
            'title' => $title,
            'effective_date' => $effective_date,
            'verification_date' => $verification_date,
            'verification_method' => $verification_method,
            'verified_by' => $verified_by,
            'next_verification_due_date' => $next_verification_due_date,
            'primary_location_held' => $primary_location_held,
            'attachment' => $attachment,
            'web_linked_file' => $web_linked_file,
            'comments' => $comments,
        ]);

        if ($external_document) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('external_document'));
    }

    public function edit($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $external_document_typeArr = $options['external_document_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $external_documents = ExternalDocument::find($id);

        return view('modules.external_document.edit_external_document')
            ->with('siteArr', $siteArr)
            ->with('users', $users)
            ->with('external_documents', $external_documents)
            ->with('external_document_typeArr', $external_document_typeArr);
    }

    public function update(ExternalDocumentRequest $request)
    {
        $id = $request->id;
        $site = $request->site;
        $doc_id = $request->doc_id;
        $document_type = $request->document_type;
        $organization = $request->organization;
        $title = $request->title;
        $effective_date = $request->effective_date;
        $verification_date = $request->verification_date;
        $verification_method = $request->verification_method;
        $verified_by = $request->verified_by;
        $next_verification_due_date = $request->next_verification_due_date;
        $primary_location_held = $request->primary_location_held;
        $web_linked_file = $request->web_linked_file;
        $comments = $request->comments;

        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $attachment = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/external_documents';

            // Upload file
            $file->move($file_location, $attachment);
        } else {
            $attachment = $request->old_attachment;
        }

        $external_document = DB::table('external_documents')
            ->where('id', $id)
            ->update([
                'site' => $site,
                'doc_id' => $doc_id,
                'document_type' => $document_type,
                'organization' => $organization,
                'title' => $title,
                'effective_date' => $effective_date,
                'verification_date' => $verification_date,
                'verification_method' => $verification_method,
                'verified_by' => $verified_by,
                'next_verification_due_date' => $next_verification_due_date,
                'primary_location_held' => $primary_location_held,
                'attachment' => $attachment,
                'web_linked_file' => $web_linked_file,
                'comments' => $comments,
            ]);

        if ($external_document) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('external_document'));
    }

    public function delete($id)
    {
        $external_documents = ExternalDocument::find($id);
        $external_documentsDel = $external_documents->delete();

        if ($external_documentsDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('external_document'));
    }

    public function print($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $external_document_typeArr = $options['external_document_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $external_documents = ExternalDocument::find($id);

        $verified_by = User::find($external_documents->verified_by);
        if ($verified_by) {
            $verified_by = $verified_by->first_name . " " . $verified_by->last_name;
        } else {
            $verified_by = "";
        }

        return view('modules.external_document.print_external_document')
            ->with('siteArr', $siteArr)
            ->with('users', $users)
            ->with('verified_by', $verified_by)
            ->with('external_documents', $external_documents)
            ->with('external_document_typeArr', $external_document_typeArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $external_document_typeArr = $options['external_document_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $external_documents = ExternalDocument::find($id);

        $verified_by = User::find($external_documents->verified_by);
        if ($verified_by) {
            $verified_by = $verified_by->first_name . " " . $verified_by->last_name;
        } else {
            $verified_by = "";
        }

        return view('modules.external_document.mail_external_document')
            ->with('siteArr', $siteArr)
            ->with('users', $users)
            ->with('verified_by', $verified_by)
            ->with('external_documents', $external_documents)
            ->with('external_document_typeArr', $external_document_typeArr);
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

        $external_documents = ExternalDocument::find($id);

        $verified_by = User::find($external_documents->verified_by);
        if ($verified_by) {
            $verified_by = $verified_by->first_name . " " . $verified_by->last_name;
        } else {
            $verified_by = "";
        }

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'site' => $external_documents->site,
            'doc_id' => $external_documents->doc_id,
            'document_type' => $external_documents->document_type,
            'organization' => $external_documents->organization,
            'title' => $external_documents->title,
            'effective_date' => $external_documents->effective_date,
            'verification_date' => $external_documents->verification_date,
            'verification_method' => $external_documents->verification_method,
            'verified_by' => $verified_by,
            'next_verification_due_date' => $external_documents->next_verification_due_date,
            'primary_location_held' => $external_documents->primary_location_held,
            'attachment' => $external_documents->attachment,
            'web_linked_file' => $external_documents->web_linked_file,
            'comments' => $external_documents->comments,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new ExternalDocumentMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('external_document'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new ExternalDocumentExport, 'externalDocument.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new ExternalDocumentImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('external_document'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('external_document'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('external_document'));
    }

    public function addDocumentType(Request $request)
    {
        $newDocumentType = $request->input('value');

        if (empty($newDocumentType)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('external_document_type', $newDocumentType);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }
    }
}
