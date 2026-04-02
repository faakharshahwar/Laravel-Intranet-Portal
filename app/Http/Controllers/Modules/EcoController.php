<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\EcoRequest;
use App\Http\Requests\EditEcoRequest;
use App\Models\Modules\Ecos;
use App\Models\Modules\EcosItems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EcoController extends Controller
{
    public function index()
    {
        if (isset($_GET['approval_status'])) {

            if ($_GET['approval_status'] == 1) {

                $approval_status_text = 'Approved';

                $ecos = DB::table('ecos')
                    ->join('users as originator', 'ecos.originator', '=', 'originator.id')
                    ->join('users as submitter', 'ecos.submitted_by', '=', 'submitter.id')
                    ->select('ecos.*', 'originator.first_name as originator_first_name', 'originator.last_name as originator_last_name', 'submitter.first_name as submitter_first_name', 'submitter.last_name as submitter_last_name')
                    ->where('ecos.approval_status', '=', 1)
                    ->get();

            } else {

                $approval_status_text = 'Rejected';

                $ecos = DB::table('ecos')
                    ->join('users as originator', 'ecos.originator', '=', 'originator.id')
                    ->join('users as submitter', 'ecos.submitted_by', '=', 'submitter.id')
                    ->select('ecos.*', 'originator.first_name as originator_first_name', 'originator.last_name as originator_last_name', 'submitter.first_name as submitter_first_name', 'submitter.last_name as submitter_last_name')
                    ->where('ecos.approval_status', '=', 0)
                    ->get();

            }
        } else {
            $approval_status_text = '';
            $ecos = DB::table('ecos')
                ->join('users as originator', 'ecos.originator', '=', 'originator.id')
                ->join('users as submitter', 'ecos.submitted_by', '=', 'submitter.id')
                ->select('ecos.*', 'originator.first_name as originator_first_name', 'originator.last_name as originator_last_name', 'submitter.first_name as submitter_first_name', 'submitter.last_name as submitter_last_name')
                ->whereNotNull('ecos.approval_status')
                ->get();
        }


        return view('modules.ecos.ecos')->with('ecos', $ecos)->with('approval_status_text', $approval_status_text);
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $current_user = Auth::user();

        if ($current_user) {
            $userId = $current_user->id;
        }

        $submitted = User::find($userId);

        if ($submitted) {
            $submitted_by = $submitted->first_name . " " . $submitted->last_name;
        } else {
            $submitted_by = '';
        }

        return view('modules.ecos.create_ecos')
            ->with('siteArr', $siteArr)
            ->with('submitted_by', $submitted_by)
            ->with('userId', $userId)
            ->with('users', $users);
    }

    public function store(EcoRequest $request)
    {
        $site = $request->site;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $details_for_request = $request->details_for_request;
        $message_to_initiator = $request->message_to_initiator;
        $importance = $request->importance;
        $eco_part_type = $request->eco_part_type;
        $reviewed_by = $request->reviewed_by;
        $date_reviewed = $request->date_reviewed;
        $submitted_by = $request->submitted_by;

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $attachment_1 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_1);
        } else {
            $attachment_1 = '';
        }

        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $attachment_2 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_2);
        } else {
            $attachment_2 = '';
        }

        if ($request->file('attachment_3')) {
            $file = $request->file('attachment_3');
            $attachment_3 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_3);
        } else {
            $attachment_3 = '';
        }

        if ($request->file('attachment_4')) {
            $file = $request->file('attachment_4');
            $attachment_4 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_4);
        } else {
            $attachment_4 = '';
        }

        if ($request->file('attachment_5')) {
            $file = $request->file('attachment_5');
            $attachment_5 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_5);
        } else {
            $attachment_5 = '';
        }

        // Retrieve all dcr_num values from the database
        $get_all_eco_id = Ecos::pluck('eco_id');

        // Check if there are any dcr_num values
        if ($get_all_eco_id->isNotEmpty()) {
            // Extract the prefix dynamically from the first item in the collection
            $firstECOid = $get_all_eco_id->first();
            $prefix = substr($firstECOid, 0, strrpos($firstECOid, '-') + 1); // Extracts the prefix

            // Remove the prefix dynamically from each item and convert to collection
            $cleanedItems = $get_all_eco_id->map(function ($item) use ($prefix) {
                return (int)str_replace($prefix, '', $item);
            });

            // Get the maximum value
            $maxValue = $cleanedItems->max();

            $maxValueECO = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);

        } else {
            $maxValue = 0;

            $maxValueECO = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);
        }
        if ($site == "Applicable to All Sites") {

            $eco_id = "ECO-CPCP-" . $maxValueECO;

        } else if ($site == "CPAE - Dubai") {

            $eco_id = "ECO-CPAE-" . $maxValueECO;

        } else if ($site == "CPLA - Mandeville") {

            $eco_id = "ECO-CPLA-" . $maxValueECO;

        } else if ($site == "CPTX - West Texas") {

            $eco_id = "ECO-CPTX-" . $maxValueECO;

        } else if ($site == "CPUK - Aberdeen") {

            $eco_id = "ECO-CPUK-" . $maxValueECO;
        }

        $eco = Ecos::create([
            'eco_id' => $eco_id,
            'site' => $site,
            'originator' => $originator,
            'date_originated' => $date_originated,
            'attachment_1' => $attachment_1,
            'attachment_2' => $attachment_2,
            'attachment_3' => $attachment_3,
            'attachment_4' => $attachment_4,
            'attachment_5' => $attachment_5,
            'details_for_request' => $details_for_request,
            'message_to_initiator' => $message_to_initiator,
            'importance' => $importance,
            'eco_part_type' => $eco_part_type,
            'reviewed_by' => $reviewed_by,
            'date_reviewed' => $date_reviewed,
            'submitted_by' => $submitted_by,
        ]);

        if ($eco) {

            $ecoId = $eco->id;

            foreach ($request->input('kt_docs_repeater_basic') as $key => $value) {

                $current_part_number = $value['current_part_number'];
                $drawing = $value['drawing'];
                $revision = $value['revision'];

                EcosItems::create([
                    'eco_id' => $ecoId,
                    'current_part_number' => $current_part_number,
                    'drawing' => $drawing,
                    'revision' => $revision,
                ]);
            }
        }

        if ($eco) {
            session()->flash('success', 'Record has been created successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('eco'));

    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $current_user = Auth::user();

        if ($current_user) {
            $userId = $current_user->id;
        }

        $submitted = User::find($userId);

        if ($submitted) {
            $submitted_by = $submitted->first_name . " " . $submitted->last_name;
        } else {
            $submitted_by = '';
        }

        $eco = Ecos::find($id);
        $ecos_items = EcosItems::where('eco_id', $id)->get();

        return view('modules.ecos.edit_eco')
            ->with('siteArr', $siteArr)
            ->with('submitted_by', $submitted_by)
            ->with('userId', $userId)
            ->with('eco', $eco)
            ->with('ecos_items', $ecos_items)
            ->with('users', $users);
    }

    public function pending_for_approval()
    {
        $ecos = DB::table('ecos')
            ->join('users as originator', 'ecos.originator', '=', 'originator.id')
            ->join('users as submitter', 'ecos.submitted_by', '=', 'submitter.id')
            ->select('ecos.*', 'originator.first_name as originator_first_name', 'originator.last_name as originator_last_name', 'submitter.first_name as submitter_first_name', 'submitter.last_name as submitter_last_name')
            ->WhereNull('ecos.approval_status')
            ->get();

        return view('modules.ecos.pending_for_approval')->with('ecos', $ecos);
    }

    public function view_eco_for_approval($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $current_user = Auth::user();

        if ($current_user) {
            $userId = $current_user->id;
        }

        $submitted = User::find($userId);

        if ($submitted) {
            $submitted_by = $submitted->first_name . " " . $submitted->last_name;
        } else {
            $submitted_by = '';
        }

        $eco = Ecos::find($id);
        $ecos_items = EcosItems::where('eco_id', $id)->get();

        return view('modules.ecos.view_eco_for_approval')
            ->with('siteArr', $siteArr)
            ->with('submitted_by', $submitted_by)
            ->with('userId', $userId)
            ->with('eco', $eco)
            ->with('ecos_items', $ecos_items)
            ->with('users', $users);
    }

    public function submit_for_approval(EditEcoRequest $request)
    {
        $id = $request->id;
        $eco_id = $request->eco_id;
        $site = $request->site;
        $originator = $request->originator;
        $date_originated = $request->date_originated;
        $details_for_request = $request->details_for_request;
        $message_to_initiator = $request->message_to_initiator;
        $importance = $request->importance;
        $eco_part_type = $request->eco_part_type;
        $reviewed_by = $request->reviewed_by;
        $date_reviewed = $request->date_reviewed;
        $submitted_by = $request->submitted_by;
        $approvalStatus = $request->approvalStatus;

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $attachment_1 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_1);
        } else {
            $attachment_1 = $request->old_attachment_1;
        }

        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $attachment_2 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_2);
        } else {
            $attachment_2 = $request->old_attachment_2;
        }

        if ($request->file('attachment_3')) {
            $file = $request->file('attachment_3');
            $attachment_3 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_3);
        } else {
            $attachment_3 = $request->old_attachment_3;
        }

        if ($request->file('attachment_4')) {
            $file = $request->file('attachment_4');
            $attachment_4 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_4);
        } else {
            $attachment_4 = $request->old_attachment_4;
        }

        if ($request->file('attachment_5')) {
            $file = $request->file('attachment_5');
            $attachment_5 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/Eco';

            // Upload file
            $file->move($file_location, $attachment_5);
        } else {
            $attachment_5 = $request->old_attachment_5;
        }

        // Extract the prefix dynamically from the first item in the collection
        $firstECOid = $eco_id;
        $prefix = substr($firstECOid, 0, strrpos($firstECOid, '-') + 1); // Extracts the prefix

        // Remove the prefix dynamically from each item and convert to collection
        $cleanedItems = str_replace($prefix, '', $firstECOid);

        // Get the maximum value
        $maxValue = $cleanedItems;

        $maxValueNCR = str_pad($maxValue, 4, '0', STR_PAD_LEFT);

        if ($site == "Applicable to All Sites") {

            $eco_id = "ECO-CPCP-" . $maxValueNCR;

        } else if ($site == "CPAE - Dubai") {

            $eco_id = "ECO-CPAE-" . $maxValueNCR;

        } else if ($site == "CPLA - Mandeville") {

            $eco_id = "ECO-CPLA-" . $maxValueNCR;

        } else if ($site == "CPTX - West Texas") {

            $eco_id = "ECO-CPTX-" . $maxValueNCR;

        } else if ($site == "CPUK - Aberdeen") {

            $eco_id = "ECO-CPUK-" . $maxValueNCR;
        }

        $eco = DB::table('ecos')
            ->where('id', $id)
            ->update([
                'eco_id' => $eco_id,
                'site' => $site,
                'originator' => $originator,
                'date_originated' => $date_originated,
                'attachment_1' => $attachment_1,
                'attachment_2' => $attachment_2,
                'attachment_3' => $attachment_3,
                'attachment_4' => $attachment_4,
                'attachment_5' => $attachment_5,
                'details_for_request' => $details_for_request,
                'message_to_initiator' => $message_to_initiator,
                'importance' => $importance,
                'eco_part_type' => $eco_part_type,
                'reviewed_by' => $reviewed_by,
                'date_reviewed' => $date_reviewed,
                'submitted_by' => $submitted_by,
                'approval_status' => $approvalStatus,
            ]);

        $eco_item_id = $request->eco_item_id;
        $current_part_number = $request->current_part_number;
        $drawing = $request->drawing;
        $revision = $request->revision;

        $ecos_items = DB::table('ecos_items')
            ->where('id', $eco_item_id)
            ->update([
                'current_part_number' => $current_part_number,
                'drawing' => $drawing,
                'revision' => $revision,
            ]);

        $ecoId = $id;

        foreach ($request->input('kt_docs_repeater_basic') as $key => $value) {

            $current_part_number = $value['current_part_number'];
            $drawing = $value['drawing'];
            $revision = $value['revision'];

            if ($current_part_number == null && $drawing == null && $revision == null) {

            } else {
                EcosItems::create([
                    'eco_id' => $ecoId,
                    'current_part_number' => $current_part_number,
                    'drawing' => $drawing,
                    'revision' => $revision,
                ]);
            }
        }

        if ($eco || $ecos_items) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('eco'));
    }
}
