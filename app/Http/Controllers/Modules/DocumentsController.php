<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentsRequest;
use App\Models\Modules\Dcrs;
use App\Models\Modules\Documents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\DocumentMail;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;
use Illuminate\Database\QueryException;


class DocumentsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $document_typeArr = $options['document_type'];
        $management_systemArr = $options['management_system'];
        $locationArr = $options['location'];

        $query = Documents::orderBy('id', 'desc');

        $query = FilterHelper::filterBySite($query, $request);
        $query = FilterHelper::filterByDocumentType($query, $request);
        $query = FilterHelper::filterByLocation($query, $request);

        $documents = $query->get();

        return view('modules.documents.documents')
            ->with('documents', $documents)
            ->with('siteArr', $siteArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('document_typeArr', $document_typeArr)
            ->with('locationArr', $locationArr)
            ->with('selected_document_type', $request->query('document_type'))
            ->with('selected_location', $request->query('location')) // Fix the reference here
            ->with('selectedSite', $request->query('site'));
    }
    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $management_systemArr = $options['management_system'];
        $locationArr = $options['location'];
        $sub_locationArr = $options['sub_location'];
        $document_typeArr = $options['document_type'];
        $results_areaArr = $options['results_area'];

        return view('modules.documents.create_documents')
            ->with('siteArr', $siteArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('locationArr', $locationArr)
            ->with('sub_locationArr', $sub_locationArr)
            ->with('results_areaArr', $results_areaArr)
            ->with('document_typeArr', $document_typeArr);
    }

    public function store(DocumentsRequest $request)
    {
        try {
            $site = $request->site;
            $management_system = $request->management_system;
            $location = $request->location;
            $sub_location = $request->sub_location;
            $document_type = $request->document_type;
            $title = $request->title;
            $doc_id = trim($request->doc_id);
            $revision = $request->revision;
            $internal_folder = $request->internal_folder;
            $external_folder = $request->external_folder;
            $distributor_folder = $request->distributor_folder;
            $website_product_documents = $request->website_product_documents;
            $website_technical_documents = $request->website_technical_documents;
            $document_review_date = $request->document_review_date;
            $document_next_review_date = $request->document_next_review_date;

            // Admin Use Only
            $results_area_1 = $request->results_area_1;
            $results_area_2 = $request->results_area_2;
            $results_area_3 = $request->results_area_3;
            $results_area_4 = $request->results_area_4;
            $results_area_5 = $request->results_area_5;
            $results_area_6 = $request->results_area_6;
            $results_area_7 = $request->results_area_7;
            $results_area_8 = $request->results_area_8;
            $results_area_9 = $request->results_area_9;
            $results_area_10 = $request->results_area_10;
            $results_area_11 = $request->results_area_11;
            $results_area_12 = $request->results_area_12;
            $training_completion_days_allowed = $request->training_completion_days_allowed;
            $learning_time = $request->learning_time;
            $training_note_for_training_history_comments = $request->training_note_for_training_history_comments;

            // Handle file upload for 'document_attachment'
            $document_attachment = '';
            if ($request->hasFile('document_attachment')) {
                $file = $request->file('document_attachment');
                $document_attachment = $file->getClientOriginalName();
                $file_location = 'uploads/Documents';
                $file->move($file_location, $document_attachment);
            }

            // Handle file upload for 'master_document_attachment'
            $master_document_attachment = '';
            if ($request->hasFile('master_document_attachment')) {
                $file = $request->file('master_document_attachment');
                $master_document_attachment = $file->getClientOriginalName();
                $file_location = 'uploads/Documents/Master';
                $file->move($file_location, $master_document_attachment);
            }

            // Insert document data
            $documents = Documents::create([
                'site' => $site,
                'management_system' => $management_system,
                'location' => $location,
                'sub_location' => $sub_location,
                'document_type' => $document_type,
                'title' => $title,
                'doc_id' => $doc_id,
                'revision' => $revision,
                'document_attachment' => $document_attachment,
                'master_document_attachment' => $master_document_attachment,
                'internal_folder' => $internal_folder,
                'external_folder' => $external_folder,
                'distributor_folder' => $distributor_folder,
                'website_product_documents' => $website_product_documents,
                'website_technical_documents' => $website_technical_documents,
                'document_review_date' => $document_review_date,
                'document_next_review_date' => $document_next_review_date,
                'results_area_1' => $results_area_1,
                'results_area_2' => $results_area_2,
                'results_area_3' => $results_area_3,
                'results_area_4' => $results_area_4,
                'results_area_5' => $results_area_5,
                'results_area_6' => $results_area_6,
                'results_area_7' => $results_area_7,
                'results_area_8' => $results_area_8,
                'results_area_9' => $results_area_9,
                'results_area_10' => $results_area_10,
                'results_area_11' => $results_area_11,
                'results_area_12' => $results_area_12,
                'training_completion_days_allowed' => $training_completion_days_allowed,
                'learning_time' => $learning_time,
                'training_note_for_training_history_comments' => $training_note_for_training_history_comments,
            ]);

            // Success message
            session()->flash('success', 'Record has been added successfully');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error
                session()->flash('error', 'A document with this Document ID already exists. Please use a unique Document ID.');
            } else {
                // General error message
                session()->flash('error', 'Something went wrong! Please try again.');
            }
        }

        return redirect()->route('documents');
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $management_systemArr = $options['management_system'];
        $locationArr = $options['location'];
        $sub_locationArr = $options['sub_location'];
        $document_typeArr = $options['document_type'];
        $results_areaArr = $options['results_area'];

        $document = Documents::find($id);

        return view('modules.documents.read_documents')
            ->with('siteArr', $siteArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('locationArr', $locationArr)
            ->with('sub_locationArr', $sub_locationArr)
            ->with('results_areaArr', $results_areaArr)
            ->with('document', $document)
            ->with('document_typeArr', $document_typeArr);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $management_systemArr = $options['management_system'];
        $locationArr = $options['location'];
        $sub_locationArr = $options['sub_location'];
        $document_typeArr = $options['document_type'];
        $results_areaArr = $options['results_area'];

        $document = Documents::find($id);

        return view('modules.documents.edit_documents')
            ->with('siteArr', $siteArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('locationArr', $locationArr)
            ->with('sub_locationArr', $sub_locationArr)
            ->with('results_areaArr', $results_areaArr)
            ->with('document', $document)
            ->with('document_typeArr', $document_typeArr);
    }

    public function update(DocumentsRequest $request)
    {
        $id = $request->id;
        $site = $request->site;
        $management_system = $request->management_system;
        $location = $request->location;
        $sub_location = $request->sub_location;
        $document_type = $request->document_type;
        $title = $request->title;
        $doc_id = trim($request->doc_id);
        $revision = $request->revision;
        $internal_folder = $request->internal_folder;
        $external_folder = $request->external_folder;
        $distributor_folder = $request->distributor_folder;
        $website_product_documents = $request->website_product_documents;
        $website_technical_documents = $request->website_technical_documents;
        $document_review_date = $request->document_review_date;
        $document_next_review_date = $request->document_next_review_date;

        //Admin Use Only

        $results_area_1 = $request->results_area_1;
        $results_area_2 = $request->results_area_2;
        $results_area_3 = $request->results_area_3;
        $results_area_4 = $request->results_area_4;
        $results_area_5 = $request->results_area_5;
        $results_area_6 = $request->results_area_6;
        $results_area_7 = $request->results_area_7;
        $results_area_8 = $request->results_area_8;
        $results_area_9 = $request->results_area_9;
        $results_area_10 = $request->results_area_10;
        $results_area_11 = $request->results_area_11;
        $results_area_12 = $request->results_area_12;
        $training_completion_days_allowed = $request->training_completion_days_allowed;
        $learning_time = $request->learning_time;
        $training_note_for_training_history_comments = $request->training_note_for_training_history_comments;

        if ($request->file('document_attachment')) {
            $file = $request->file('document_attachment');
            $document_attachment = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Documents';

            // Upload file
            $file->move($file_location, $document_attachment);
        } else {
            $document_attachment = $request->old_document_attachment;
        }

        if ($request->file('master_document_attachment')) {
            $file = $request->file('master_document_attachment');
            $master_document_attachment = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Documents/Master';

            // Upload file
            $file->move($file_location, $master_document_attachment);
        } else {
            $master_document_attachment = $request->old_master_document_attachment;
        }

        try {
            $documents = DB::table('documents')
                ->where('id', $id)
                ->update([
                    'site' => $site,
                    'management_system' => $management_system,
                    'location' => $location,
                    'sub_location' => $sub_location,
                    'document_type' => $document_type,
                    'title' => $title,
                    'doc_id' => $doc_id,
                    'revision' => $revision,
                    'document_attachment' => $document_attachment,
                    'master_document_attachment' => $master_document_attachment,
                    'internal_folder' => $internal_folder,
                    'external_folder' => $external_folder,
                    'distributor_folder' => $distributor_folder,
                    'website_product_documents' => $website_product_documents,
                    'website_technical_documents' => $website_technical_documents,
                    'document_review_date' => $document_review_date,
                    'document_next_review_date' => $document_next_review_date,
                    'results_area_1' => $results_area_1,
                    'results_area_2' => $results_area_2,
                    'results_area_3' => $results_area_3,
                    'results_area_4' => $results_area_4,
                    'results_area_5' => $results_area_5,
                    'results_area_6' => $results_area_6,
                    'results_area_7' => $results_area_7,
                    'results_area_8' => $results_area_8,
                    'results_area_9' => $results_area_9,
                    'results_area_10' => $results_area_10,
                    'results_area_11' => $results_area_11,
                    'results_area_12' => $results_area_12,
                    'training_completion_days_allowed' => $training_completion_days_allowed,
                    'learning_time' => $learning_time,
                    'training_note_for_training_history_comments' => $training_note_for_training_history_comments,
                ]);

            session()->flash('success', 'Record has been added successfully');
        } catch (\Exception $e) {
            // Handle error
            session()->flash("Update failed: " . $e->getMessage());
        }

        return redirect(route('documents'));
    }

    public function delete($id)
    {
        $document = Documents::find($id);
        $documentDel = $document->delete();

        $dcr = DB::table('dcrs')
            ->where('source_document', $id)->get();

        if (!$dcr->isEmpty()) {
            foreach ($dcr as $record) {
                DB::table('dcrs')->where('id', $record->id)->delete();
            }
        }

        if ($documentDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('documents'));


    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $management_systemArr = $options['management_system'];
        $locationArr = $options['location'];
        $sub_locationArr = $options['sub_location'];
        $document_typeArr = $options['document_type'];
        $results_areaArr = $options['results_area'];

        $document = Documents::find($id);

        return view('modules.documents.print_documents')
            ->with('siteArr', $siteArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('locationArr', $locationArr)
            ->with('sub_locationArr', $sub_locationArr)
            ->with('results_areaArr', $results_areaArr)
            ->with('document', $document)
            ->with('document_typeArr', $document_typeArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $management_systemArr = $options['management_system'];
        $locationArr = $options['location'];
        $sub_locationArr = $options['sub_location'];
        $document_typeArr = $options['document_type'];
        $results_areaArr = $options['results_area'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $document = Documents::find($id);

        return view('modules.documents.mail_documents')
            ->with('siteArr', $siteArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('locationArr', $locationArr)
            ->with('sub_locationArr', $sub_locationArr)
            ->with('results_areaArr', $results_areaArr)
            ->with('document', $document)
            ->with('document_typeArr', $document_typeArr)
            ->with('users', $users);
    }

    public function send_email(Request $request)
    {
//        $userEmails = $request->input('recipient');
        $userEmails = [
            'faakharshahwar@gmail.com',
            'fakhirshahwar@gmail.com',
        ];

        // Validate the incoming request
        $validatedData = $request->validate([
            'recipient' => 'required',
        ]);

        $options = dynamicOptions();
        $site_urlArr = $options['site_url'];

        $id = $request->id;
        $document = Documents::find($id);
        $base_url = $site_urlArr['base_url'];

        $personal_message = $request->personal_message;

        $mailData = [
            'personal_message' => $personal_message,
            'site' => $document->site,
            'management_system' => $document->management_system,
            'location' => $document->location,
            'sub_location' => $document->sub_location,
            'document_type' => $document->document_type,
            'title' => $document->title,
            'doc_id' => $document->doc_id,
            'revision' => $document->revision,
            'document_attachment' => $document->document_attachment,
            'document_review_date' => $document->document_review_date,
            'document_next_review_date' => $document->document_next_review_date,
            'results_area_1' => $document->results_area_1,
            'results_area_2' => $document->results_area_2,
            'results_area_3' => $document->results_area_3,
            'results_area_4' => $document->results_area_4,
            'results_area_5' => $document->results_area_5,
            'results_area_6' => $document->results_area_6,
            'results_area_7' => $document->results_area_7,
            'results_area_8' => $document->results_area_8,
            'results_area_9' => $document->results_area_9,
            'results_area_10' => $document->results_area_10,
            'results_area_11' => $document->results_area_11,
            'results_area_12' => $document->results_area_12,
            'master_document_attachment' => $document->master_document_attachment,
            'training_completion_days_allowed' => $document->training_completion_days_allowed,
            'learning_time' => $document->learning_time,
            'training_note_for_training_history_comments' => $document->training_note_for_training_history_comments,
            'base_url' => $base_url,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new DocumentMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('documents'));
    }

    public function get_documents_by_site(Request $request)
    {
        $site = $request->site;

        $documents = Documents::whereIn('site', [$site, 'Applicable to All Sites'])->get();

        return response()->json(['data' => $documents]);
    }

    public function get_documents_by_management_system(Request $request)
    {
        $management_system = $request->management_system;

        $documents = Documents::whereIn('management_system', [$management_system, 'All'])->get();

        return response()->json(['data' => $documents]);
    }
}
