<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\DCRsRequest;
use App\Mail\DCRsMail;
use App\Models\Modules\Dcrs;
use App\Models\Modules\Documents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DCRsController extends Controller
{
    public function index()
    {
        $dcrs = Dcrs::orderBy('id', 'desc')->get();
        return view('modules.dcrs.dcrs')->with('dcrs', $dcrs);
    }

    public function create()
    {
        $options = dynamicOptions();
        $results_areaArr = $options['results_area'];
        $dcr_approversArr = $options['dcr_approvers'];

        $allDocuments = Documents::all();

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.dcrs.create_dcrs')
            ->with('allDocuments', $allDocuments)
            ->with('users', $users)
            ->with('dcr_approversArr', $dcr_approversArr)
            ->with('results_areaArr', $results_areaArr);
    }

    public function getDocumentDetails(Request $request)
    {
        $document_id = $request->document_id;

        $document = Documents::find($document_id);

        $documentsDCR = DB::table('documents')
            ->join('dcrs', 'documents.id', '=', 'dcrs.source_document')
            ->select('documents.*', 'dcrs.rev', 'dcrs.dcr_num')
            ->where('documents.ID', '=', $document_id)
            ->get();

        // Retrieve all dcr_num values from the database
        $get_all_dcr_num = Dcrs::pluck('dcr_num');

        // Check if there are any dcr_num values
        if ($get_all_dcr_num->isNotEmpty()) {
            // Extract the prefix dynamically from the first item in the collection
            $firstDcrNum = $get_all_dcr_num->first();
            $prefix = substr($firstDcrNum, 0, strrpos($firstDcrNum, '-') + 1); // Extracts the prefix

            // Remove the prefix dynamically from each item and convert to collection
            $cleanedItems = $get_all_dcr_num->map(function ($item) use ($prefix) {
                return (int)str_replace($prefix, '', $item);
            });

            // Get the maximum value
            $maxValue = $cleanedItems->max();

            $maxValueDCR = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);

        } else {
            $maxValue = 0;

            $maxValueDCR = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);
        }

        if ($documentsDCR->isEmpty()) {

            $jsonData = [
                'site' => $document->site,
                'location' => $document->location,
                'sub_location' => $document->sub_location,
                'document_type' => $document->document_type,
                'title' => $document->title,
                'doc_id' => $document->doc_id,
                'document_attachment' => $document->document_attachment,
                'internal_folder' => $document->internal_folder,
                'external_folder' => $document->external_folder,
                'distributor_folder' => $document->distributor_folder,
                'website_product_documents' => $document->website_product_documents,
                'website_technical_documents' => $document->website_technical_documents,
//                'rev' => 1,
                'dcr_num' => $maxValueDCR,
            ];
        } else {

            $jsonData = [
                'site' => $documentsDCR->first()->site,
                'location' => $documentsDCR->first()->location,
                'sub_location' => $documentsDCR->first()->sub_location,
                'document_type' => $documentsDCR->first()->document_type,
                'title' => $documentsDCR->first()->title,
                'doc_id' => $documentsDCR->first()->doc_id,
                'document_attachment' => $documentsDCR->first()->document_attachment,
                'internal_folder' => $documentsDCR->first()->internal_folder,
                'external_folder' => $documentsDCR->first()->external_folder,
                'distributor_folder' => $documentsDCR->first()->distributor_folder,
                'website_product_documents' => $documentsDCR->first()->website_product_documents,
                'website_technical_documents' => $documentsDCR->first()->website_technical_documents,
//                'rev' => $documentsDCR->first()->rev + 1,
                'dcr_num' => $maxValueDCR,
            ];
        }

        return response()->json($jsonData);
    }

    public function store(DCRsRequest $request)
    {
        $doc_id = $request->doc_id;
        $title = $request->title;
        $rev = $request->rev;
        $dcr_num = $request->dcr_num;
        $source_document = $request->source_document;
        $effective_date = $request->effective_date;
        $approver_1 = $request->approver_1;
        $approver_2 = $request->approver_2;
        $approved_by_1 = $request->approved_by_1;
        $approved_by_2 = $request->approved_by_2;
        $document_approved = $request->document_approved;
        $approval_review_comments = $request->approval_review_comments;
        $date_approved = $request->date_approved;
        $training_assessed = $request->training_assessed;

        if ($document_approved == "approved" && (empty($approved_by_1) && empty($approved_by_1))) {
            session()->flash('error', 'Please select at least one approver.');
            return redirect(route('create_dcrs'));
        }

        if ((!empty($approved_by_1) || !empty($approved_by_2)) && empty($document_approved)) {
            session()->flash('error', 'You must check the option to approve the document');
            return redirect(route('create_dcrs'));
        }

        if ($request->file('new_source_document')) {
            $file = $request->file('new_source_document');
            $new_source_document = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/DCRs';

            // Upload file
            $file->move($location, $new_source_document);
        } else {
            $new_source_document = '';
        }

        if ($request->file('document_for_approval')) {
            $file = $request->file('document_for_approval');
            $document_for_approval = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/DCRs';

            // Upload file
            $file->move($location, $document_for_approval);
        } else {
            $document_for_approval = '';
        }

        $dcrs = Dcrs::create([
            'doc_id' => $doc_id,
            'title' => $title,
            'rev' => $rev,
            'dcr_num' => $dcr_num,
            'source_document' => $source_document,
            'new_source_document' => $new_source_document,
            'document_for_approval' => $document_for_approval,
            'effective_date' => $effective_date,
            'approver_1' => $approver_1,
            'approver_2' => $approver_2,
            'approved_by_1' => $approved_by_1,
            'approved_by_2' => $approved_by_2,
            'approval_review_comments' => $approval_review_comments,
            'date_approved' => $date_approved,
            'training_assessed' => $training_assessed,
        ]);

        if ($dcrs) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('dcrs'));

    }

    public function read($id)
    {
        $options = dynamicOptions();
        $results_areaArr = $options['results_area'];
        $dcr_approversArr = $options['dcr_approvers'];

        $allDocuments = Documents::all();

        $dcr = Dcrs::find($id);

        $document = Documents::find($dcr->source_document);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.dcrs.read_dcrs')
            ->with('allDocuments', $allDocuments)
            ->with('users', $users)
            ->with('dcr_approversArr', $dcr_approversArr)
            ->with('dcr', $dcr)
            ->with('document', $document)
            ->with('results_areaArr', $results_areaArr);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $results_areaArr = $options['results_area'];
        $dcr_approversArr = $options['dcr_approvers'];

        $allDocuments = Documents::all();

        $dcr = Dcrs::find($id);

        $document = Documents::find($dcr->source_document);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.dcrs.edit_dcrs')
            ->with('allDocuments', $allDocuments)
            ->with('users', $users)
            ->with('dcr_approversArr', $dcr_approversArr)
            ->with('dcr', $dcr)
            ->with('document', $document)
            ->with('results_areaArr', $results_areaArr);
    }

    //Todo: Automatically document update when approved.
    public function update(DCRsRequest $request)
    {
        $id = $request->id;
        $doc_id = $request->doc_id;
        $title = $request->title;
        $rev = $request->rev;
        $dcr_num = $request->dcr_num;
        $source_document = $request->source_document;
        $effective_date = $request->effective_date;
        $approver_1 = $request->approver_1;
        $approver_2 = $request->approver_2;
        $approved_by_1 = $request->approved_by_1;
        $approved_by_2 = $request->approved_by_2;
        $document_approved = $request->document_approved;
        $approval_review_comments = $request->approval_review_comments;
        $date_approved = $request->date_approved;
        $training_assessed = $request->training_assessed;

        if ($document_approved == "approved" && (empty($approved_by_1) && empty($approved_by_1))) {
            session()->flash('error', 'Please select at least one approver.');
            return redirect("edit_dcrs/" . $id);
        }

        if ((!empty($approved_by_1) || !empty($approved_by_2)) && empty($document_approved)) {
            session()->flash('error', 'You must check the option to approve the document');
            return redirect("edit_dcrs/" . $id);
        }

        if ($request->file('document_for_approval')) {
            $file = $request->file('document_for_approval');
            $document_for_approval = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/DCRs';

            // Upload file
            $file->move($location, $document_for_approval);
        } else {
            $document_for_approval = $request->old_document_for_approval;
        }

        $dcr = DB::table('dcrs')
            ->where('id', $id)
            ->update([
                'doc_id' => $doc_id,
                'title' => $title,
                'rev' => $rev,
                'dcr_num' => $dcr_num,
                'source_document' => $source_document,
                'document_for_approval' => $document_for_approval,
                'effective_date' => $effective_date,
                'approver_1' => $approver_1,
                'approver_2' => $approver_2,
                'approved_by_1' => $approved_by_1,
                'approved_by_2' => $approved_by_2,
                'document_approved' => $document_approved,
                'approval_review_comments' => $approval_review_comments,
                'date_approved' => $date_approved,
                'training_assessed' => $training_assessed,
            ]);

        if ($dcr) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('dcrs'));
    }

    public function delete($id)
    {
        $dcr = Dcrs::find($id);
        $dcrDel = $dcr->delete();

        if ($dcrDel) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('dcrs'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $results_areaArr = $options['results_area'];
        $dcr_approversArr = $options['dcr_approvers'];

        $allDocuments = Documents::all();

        $dcr = Dcrs::find($id);

        $document = Documents::find($dcr->source_document);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $approver_1_record = User::find($dcr->approver_1);
        if ($approver_1_record) {
            $approver_1 = $approver_1_record->first_name . " " . $approver_1_record->last_name;
        } else {
            $approver_1 = "";
        }

        $approver_2_record = User::find($dcr->approver_2);
        if ($approver_2_record) {
            $approver_2 = $approver_2_record->first_name . " " . $approver_2_record->last_name;
        } else {
            $approver_2 = "";
        }

        $approved_by_1_record = User::find($dcr->approved_by_1);
        if ($approved_by_1_record) {
            $approved_by_1 = $approved_by_1_record->first_name . " " . $approved_by_1_record->last_name;
        } else {
            $approved_by_1 = "";
        }

        $approved_by_2_record = User::find($dcr->approved_by_2);
        if ($approved_by_2_record) {
            $approved_by_2 = $approved_by_2_record->first_name . " " . $approved_by_2_record->last_name;
        } else {
            $approved_by_2 = "";
        }


        return view('modules.dcrs.print_dcrs')
            ->with('allDocuments', $allDocuments)
            ->with('users', $users)
            ->with('dcr_approversArr', $dcr_approversArr)
            ->with('dcr', $dcr)
            ->with('approver_1', $approver_1)
            ->with('approver_2', $approver_2)
            ->with('approved_by_1', $approved_by_1)
            ->with('approved_by_2', $approved_by_2)
            ->with('document', $document)
            ->with('results_areaArr', $results_areaArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $results_areaArr = $options['results_area'];
        $dcr_approversArr = $options['dcr_approvers'];

        $allDocuments = Documents::all();

        $dcr = Dcrs::find($id);

        $document = Documents::find($dcr->source_document);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $approver_1_record = User::find($dcr->approver_1);
        if ($approver_1_record) {
            $approver_1 = $approver_1_record->first_name . " " . $approver_1_record->last_name;
        } else {
            $approver_1 = "";
        }

        $approver_2_record = User::find($dcr->approver_2);
        if ($approver_2_record) {
            $approver_2 = $approver_2_record->first_name . " " . $approver_2_record->last_name;
        } else {
            $approver_2 = "";
        }

        $approved_by_1_record = User::find($dcr->approved_by_1);
        if ($approved_by_1_record) {
            $approved_by_1 = $approved_by_1_record->first_name . " " . $approved_by_1_record->last_name;
        } else {
            $approved_by_1 = "";
        }

        $approved_by_2_record = User::find($dcr->approved_by_2);
        if ($approved_by_2_record) {
            $approved_by_2 = $approved_by_2_record->first_name . " " . $approved_by_2_record->last_name;
        } else {
            $approved_by_2 = "";
        }


        return view('modules.dcrs.mail_dcrs')
            ->with('allDocuments', $allDocuments)
            ->with('users', $users)
            ->with('dcr_approversArr', $dcr_approversArr)
            ->with('dcr', $dcr)
            ->with('approver_1', $approver_1)
            ->with('approver_2', $approver_2)
            ->with('approved_by_1', $approved_by_1)
            ->with('approved_by_2', $approved_by_2)
            ->with('document', $document)
            ->with('users', $users)
            ->with('results_areaArr', $results_areaArr);
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

        $dcr = Dcrs::find($id);

        $document = Documents::find($dcr->source_document);

        $approver_1_record = User::find($dcr->approver_1);
        if ($approver_1_record) {
            $approver_1 = $approver_1_record->first_name . " " . $approver_1_record->last_name;
        } else {
            $approver_1 = "";
        }

        $approver_2_record = User::find($dcr->approver_2);
        if ($approver_2_record) {
            $approver_2 = $approver_2_record->first_name . " " . $approver_2_record->last_name;
        } else {
            $approver_2 = "";
        }

        $approved_by_1_record = User::find($dcr->approved_by_1);
        if ($approved_by_1_record) {
            $approved_by_1 = $approved_by_1_record->first_name . " " . $approved_by_1_record->last_name;
        } else {
            $approved_by_1 = "";
        }

        $approved_by_2_record = User::find($dcr->approved_by_2);
        if ($approved_by_2_record) {
            $approved_by_2 = $approved_by_2_record->first_name . " " . $approved_by_2_record->last_name;
        } else {
            $approved_by_2 = "";
        }


        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'doc_id' => $dcr->doc_id,
            'title' => $dcr->title,
            'rev' => $dcr->rev,
            'dcr_num' => $dcr->dcr_num,
            'source_document' => $document->document_attachment,
            'document_for_approval' => $dcr->document_for_approval,
            'effective_date' => $dcr->effective_date,
            'document_approved' => $dcr->document_approved,
            'approval_review_comments' => $dcr->approval_review_comments,
            'date_approved' => $dcr->date_approved,
            'training_assessed' => $dcr->training_assessed,
            'approver_1' => $approver_1,
            'approver_2' => $approver_2,
            'approved_by_1' => $approved_by_1,
            'approved_by_2' => $approved_by_2,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new DCRsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('dcrs'));
    }
}
