<?php

namespace App\Http\Controllers\Travel;

use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TravelBookingRequest;
use App\Models\Travel\TravelBooking;
use App\Models\Travel\TravelBookingAttachment;
use App\Models\Travel\TravelBookingChangeLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Travel\TravelRequestNotification;

class TravelBookingController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $query = TravelBooking::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);

        // ============================
        // >>> ADVANCED FILTERS <<<
        // ============================
        $fmt = '%Y-%m-%d';

        if ($request->filled('booking_date_from')) {
            $query->whereRaw("STR_TO_DATE(booking_date, '{$fmt}') >= STR_TO_DATE(?, '{$fmt}')",
                [$request->booking_date_from]);
        }
        if ($request->filled('booking_date_to')) {
            $query->whereRaw("STR_TO_DATE(booking_date, '{$fmt}') <= STR_TO_DATE(?, '{$fmt}')",
                [$request->booking_date_to]);
        }

        if ($request->filled('approval_status')) {
            $query->where('management_approval_status', $request->approval_status);
        }


        if ($request->filled('traveler')) {
            $query->where('traveler', $request->traveler);
        }

        if ($request->filled('destination')) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }


        if ($request->filled('departure_date_from')) {
            $query->whereRaw("STR_TO_DATE(departure_date, '{$fmt}') >= STR_TO_DATE(?, '{$fmt}')",
                [$request->departure_date_from]);
        }
        if ($request->filled('departure_date_to')) {
            $query->whereRaw("STR_TO_DATE(departure_date, '{$fmt}') <= STR_TO_DATE(?, '{$fmt}')",
                [$request->departure_date_to]);
        }

        if ($request->filled('return_date_from')) {
            $query->whereRaw("STR_TO_DATE(return_date, '{$fmt}') >= STR_TO_DATE(?, '{$fmt}')",
                [$request->return_date_from]);
        }
        if ($request->filled('return_date_to')) {
            $query->whereRaw("STR_TO_DATE(return_date, '{$fmt}') <= STR_TO_DATE(?, '{$fmt}')",
                [$request->return_date_to]);
        }


        if ($request->filled('month')) {
            $query->whereRaw("MONTH(STR_TO_DATE(departure_date, '{$fmt}')) = ?", [(int)$request->month]);
        }
        if ($request->filled('year')) {
            $query->whereRaw("YEAR(STR_TO_DATE(departure_date, '{$fmt}')) = ?", [(int)$request->year]);
        }

        $query->orderByRaw("STR_TO_DATE(departure_date, '{$fmt}') DESC");

        // ============================
        // END FILTERS
        // ============================

        $tbs = $query->get();

        // Attach approver details for each record (your existing code)
        foreach ($tbs as $tb) {
            $approver = User::find($tb->approver_name);
            if ($approver) {
                $tb->approver_first_name = $approver->first_name;
                $tb->approver_last_name = $approver->last_name;
            } else {
                $tb->approver_first_name = null;
                $tb->approver_last_name = null;
            }
        }

        // Attach traveller details for each record (your existing code)
        foreach ($tbs as $tb) {
            $traveller = User::find($tb->traveler);
            if ($traveller) {
                $tb->traveller_first_name = $traveller->first_name;
                $tb->traveller_last_name = $traveller->last_name;
            } else {
                $tb->traveller_first_name = null;
                $tb->traveller_last_name = null;
            }
        }

        // Get full traveller list (not from filtered bookings)
        $get_travellers = \App\Models\User::orderBy('first_name')
            ->orderBy('last_name')
            ->get(['id', 'first_name', 'last_name', 'email']);

        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $travellers = $get_travellers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });


        return view('travel.travel_bookings')
            ->with('travel_bookings', $tbs)
            ->with('siteArr', $siteArr)
            ->with('travellers', $travellers);

    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $travelArr = $options['travel_type'];
        $modeOfTravelArr = $options['mode_of_travel'];
        $travelAttachmentsArr = $options['travel_attachments'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('travel.create_travel_booking')
            ->with('travelArr', $travelArr)
            ->with('siteArr', $siteArr)
            ->with('modeOfTravelArr', $modeOfTravelArr)
            ->with('travelAttachmentsArr', $travelAttachmentsArr)
            ->with('users', $users);
    }

    public function store(TravelBookingRequest $request)
    {
        $current_user = Auth::user();

        if ($current_user) {
            $userId = $current_user->id;
        }

        //Risk High, Extreme need approval

        $risk_status = $request->risk_status;

        /*
         * $management_approval_status
         * 0 = Pending for approval
         * 1 = Approved
         * 2 = Not Approved
         */

        if ($risk_status == "High" || $risk_status == "Extreme") {
            $management_approval_status = 0;
        } else {
            $management_approval_status = 1;
        }

        $booking_date = $request->booking_date;
        $travel_type = $request->travel_type;
        $purpose_of_travel = $request->purpose_of_travel;
        $traveler = $request->traveler;
        $destination = $request->destination;
        $client = $request->client;
        $departure_date = $request->departure_date;
        $return_date = $request->return_date;
        $mode_of_travel = $request->mode_of_travel;
        $booking_reference_pnr = $request->booking_reference_pnr;
        $passenger_last_name = $request->passenger_last_name;
        $estimated_travel_cost = $request->estimated_travel_cost;
        $actual_travel_cost = $request->actual_travel_cost;
        $visa_requirement = $request->visa_requirement;
        $travel_insurance_provider = $request->travel_insurance_provider;
        $safety_notes = $request->safety_notes;
        $risk_status = $request->risk_status;
        $additional_comments = $request->additional_comments;

        //Management Approval Status = 2: Pre approved if Risk Status is low

        $tb = TravelBooking::create([
            'booking_date' => $booking_date,
            'travel_type' => $travel_type,
            'purpose_of_travel' => $purpose_of_travel,
            'management_approval_status' => $management_approval_status,
            'traveler' => $traveler,
            'destination' => $destination,
            'client' => $client,
            'departure_date' => $departure_date,
            'return_date' => $return_date,
            'mode_of_travel' => $mode_of_travel,
            'booking_reference_pnr' => $booking_reference_pnr,
            'passenger_last_name' => $passenger_last_name,
            'estimated_travel_cost' => $estimated_travel_cost,
            'actual_travel_cost' => $actual_travel_cost,
            'visa_requirement' => $visa_requirement,
            'travel_insurance_provider' => $travel_insurance_provider,
            'safety_notes' => $safety_notes,
            'risk_status' => $risk_status,
            'additional_comments' => $additional_comments,
        ]);

        $bookingId = $tb->id;


        $rows = $request->input('kt_docs_repeater_basic');

        if (!empty($rows) && is_array($rows)) {
            foreach ($rows as $key => $value) {

                $attachment_types = $value['attachment_type'];

                $attachment_data = $request->file('kt_docs_repeater_basic') ?? [];

                if (($attachment_types == "N/A") && (!isset($attachment_data))) {
                    $travel_booking_attachment_types_data = 1;
                } elseif (($attachment_types != "N/A") && (!isset($attachment_data))) {
                    $validated = $request->validate([
                        'doc_attachment_1' => 'required',
                    ]);
                } else {

                    if (!isset($attachment_data)) {
                        $attachment_1 = '';
                        $attachment_2 = '';
                    } else {
                        $attachment_1 = $attachment_data[$key]['doc_attachment_1'] ?? null;

                        if (isset($attachment_data[$key]['doc_attachment_2'])) {
                            $attachment_2 = $attachment_data[$key]['doc_attachment_2'];
                        } else {
                            $attachment_2 = '';
                        }
                    }

                    if ($attachment_1) {
                        $file = $attachment_1;
                        $doc_attachment_1 = $file->getClientOriginalName();

                        // File upload location
                        $file_location = 'uploads/travel_bookings';

                        // Upload file
                        $file->move($file_location, $doc_attachment_1);
                    } else {
                        $doc_attachment_1 = '';
                    }

                    if ($attachment_2) {
                        $file = $attachment_2;
                        $doc_attachment_2 = $file->getClientOriginalName();

                        // File upload location
                        $file_location = 'uploads/travel_bookings';

                        // Upload file
                        $file->move($file_location, $doc_attachment_2);
                    } else {
                        $doc_attachment_2 = '';
                    }

                    $travel_booking_attachment_types_data = TravelBookingAttachment::create([
                        'travel_booking_id' => $bookingId,
                        'attachment_type' => $attachment_types,
                        'attachment_1' => $doc_attachment_1,
                        'attachment_2' => $doc_attachment_2,
                    ]);
                }
            }
        }

        $options = dynamicOptions();

        $get_traveler_details = User::find($traveler);
        $traveler_name = trim(($get_traveler_details->first_name ?? '') . ' ' . ($get_traveler_details->last_name ?? ''));
        $traveler_manger_id = $get_traveler_details->person_to_notify ?? null;

        $get_manager_details = $traveler_manger_id ? User::find($traveler_manger_id) : null;

        $manager_email = $get_manager_details->email ?? null;
        $hr_email = $options['hr_email'] ?? null;

        $link = '<a href="' . url('/edit_travel_booking/' . $bookingId) . '">Click here</a> to view the record.';

        if ($risk_status === 'High' || $risk_status === 'Extreme') {
            $bodyText = $traveler_name
                . ' has been added to a new travel request. '
                . 'Since the destination is classified as high-risk, the manager’s approval is required before proceeding. '
                . $link;
        } else {
            $bodyText = $traveler_name
                . ' has been added to a new travel request. '
                . 'Since the destination is not classified as high-risk, the manager’s approval is not required. '
                . $link;
        }


        $mailData = [
            'traveler_name' => $traveler_name,
            'risk_status' => $risk_status,
            'bodyText' => $bodyText,
        ];

        $recipients = [];

        if (!empty($manager_email)) {
            $recipients[] = $manager_email;
        }

        if (!empty($hr_email)) {
            if (is_array($hr_email)) {
                $recipients = array_merge($recipients, array_values($hr_email));
            } else {
                $recipients[] = $hr_email;
            }
        }

        $recipients = array_unique(array_filter($recipients)); // clean up

        if (!empty($recipients)) {
            Mail::to($recipients)->send(new TravelRequestNotification($mailData));
        }

        if ($tb) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('travel_booking'));
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $travelArr = $options['travel_type'];
        $modeOfTravelArr = $options['mode_of_travel'];
        $travelAttachmentsArr = $options['travel_attachments'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $tb = TravelBooking::find($id);

        $travel_booking_attachments = TravelBookingAttachment::where('travel_booking_id', $id)->get();

        $traveller_id = $tb->traveler;

        //Get user details
        $traveller_details = User::find($traveller_id);

        $department = $traveller_details->department;
        $nationality = $traveller_details->nationality;
        $passport_number = $traveller_details->passport_number;
        $work_phone = $traveller_details->work_phone;
        $site = $traveller_details->site;
        $emergency_contact_name = $traveller_details->emergency_contact_name;
        $emergency_contact_phone = $traveller_details->emergency_contact_phone;

        $get_approver_name = $tb->approver_name;

        if ($get_approver_name) {
            $approver = User::find($get_approver_name);
        } else {
            $approver = null;
        }

        if ($approver) {
            $approved_by = $approver->first_name . " " . $approver->last_name;
        } else {
            $approved_by = "";
        }

        $approved_date = $tb->approved_date;

        if ($approved_date) {
            $approved_on = $approved_date;
        } else {
            $approved_on = "";
        }

        $change_logs = TravelBookingChangeLog::with('user')
            ->where('travel_booking_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('travel.read_travel_booking')
            ->with('tb', $tb)
            ->with('travel_booking_attachments', $travel_booking_attachments)
            ->with('travelArr', $travelArr)
            ->with('approved_by', $approved_by)
            ->with('approved_on', $approved_on)
            ->with('siteArr', $siteArr)
            ->with('modeOfTravelArr', $modeOfTravelArr)
            ->with('travelAttachmentsArr', $travelAttachmentsArr)
            ->with('users', $users)
            ->with('department', $department)
            ->with('nationality', $nationality)
            ->with('passport_number', $passport_number)
            ->with('work_phone', $work_phone)
            ->with('site', $site)
            ->with('emergency_contact_name', $emergency_contact_name)
            ->with('emergency_contact_phone', $emergency_contact_phone)
            ->with('change_logs', $change_logs);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $travelArr = $options['travel_type'];
        $modeOfTravelArr = $options['mode_of_travel'];
        $travelAttachmentsArr = $options['travel_attachments'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $tb = TravelBooking::find($id);

        $travel_booking_attachments = TravelBookingAttachment::where('travel_booking_id', $id)->get();

        $traveller_id = $tb->traveler;

        //Get user details
        $traveller_details = User::find($traveller_id);

        $department = $traveller_details->department;
        $nationality = $traveller_details->nationality;
        $passport_number = $traveller_details->passport_number;
        $work_phone = $traveller_details->work_phone;
        $site = $traveller_details->site;
        $emergency_contact_name = $traveller_details->emergency_contact_name;
        $emergency_contact_phone = $traveller_details->emergency_contact_phone;

        $get_approver_name = $tb->approver_name;

        if ($get_approver_name) {
            $approver = User::find($get_approver_name);
        } else {
            $approver = null;
        }

        if ($approver) {
            $approved_by = $approver->first_name . " " . $approver->last_name;
        } else {
            $approved_by = "";
        }

        $approved_date = $tb->approved_date;

        if ($approved_date) {
            $approved_on = $approved_date;
        } else {
            $approved_on = "";
        }

        $change_logs = TravelBookingChangeLog::with('user')
            ->where('travel_booking_id', $id)
            ->orderBy('id', 'desc')
            ->get();



        return view('travel.edit_travel_booking')
            ->with('tb', $tb)
            ->with('travel_booking_attachments', $travel_booking_attachments)
            ->with('travelArr', $travelArr)
            ->with('approved_by', $approved_by)
            ->with('approved_on', $approved_on)
            ->with('siteArr', $siteArr)
            ->with('modeOfTravelArr', $modeOfTravelArr)
            ->with('travelAttachmentsArr', $travelAttachmentsArr)
            ->with('users', $users)
            ->with('department', $department)
            ->with('nationality', $nationality)
            ->with('passport_number', $passport_number)
            ->with('work_phone', $work_phone)
            ->with('site', $site)
            ->with('emergency_contact_name', $emergency_contact_name)
            ->with('emergency_contact_phone', $emergency_contact_phone)
            ->with('change_logs', $change_logs);
    }

    public function update(TravelBookingRequest $request)
    {
        $current_user = Auth::user();
        $currentUserId = $current_user ? $current_user->id : null;

        $id = $request->id;

        $tbModel = TravelBooking::findOrFail($id);

        // remarks is optional always (especially for pending)
        $remarks = $request->input('remarks');

        // fields you update today
        $fields = [
            'booking_date',
            'travel_type',
            'purpose_of_travel',
            'traveler',
            'destination',
            'client',
            'departure_date',
            'return_date',
            'mode_of_travel',
            'booking_reference_pnr',
            'passenger_last_name',
            'estimated_travel_cost',
            'actual_travel_cost',
            'visa_requirement',
            'travel_insurance_provider',
            'safety_notes',
            'risk_status',
            'additional_comments',
        ];

        $before = $tbModel->only($fields);

        // Keep your structure: update record (using model instead of DB::table so we can diff cleanly)
        $tbModel->fill($request->only($fields));
        $tbSaved = $tbModel->save();

        $after = $tbModel->fresh()->only($fields);

        // Build diff in a simple "old/new" format
        $changes = [];
        foreach ($fields as $f) {
            $old = $before[$f] ?? null;
            $new = $after[$f] ?? null;

            // normalize to strings for safe compare (optional)
            if ((string)$old !== (string)$new) {
                $changes[$f] = ['old' => $old, 'new' => $new];
            }
        }

        // ---- Your existing attachment logic stays (paste your current foreach here) ----
        $travel_booking_attachment_types_data = false;

        $items = $request->input('kt_docs_repeater_basic', []);
        $files = $request->file('kt_docs_repeater_basic', []);

        foreach ($items as $key => $value) {
            $rowId = $value['id'] ?? null; // hidden input in Blade
            $attachment_type = $value['attachment_type'] ?? null;

            $attachment_1 = $files[$key]['doc_attachment_1'] ?? null;
            $attachment_2 = $files[$key]['doc_attachment_2'] ?? null;

            if ($attachment_type !== 'N/A' && !$attachment_1 && !$attachment_2 && !$rowId) {
                $request->validate([
                    "kt_docs_repeater_basic.$key.doc_attachment_1" => 'required|file',
                ]);
            }

            $doc_attachment_1 = '';
            $doc_attachment_2 = '';
            $file_location = public_path('uploads/travel_bookings');

            if ($attachment_1) {
                $doc_attachment_1 = $attachment_1->getClientOriginalName();
                $attachment_1->move($file_location, $doc_attachment_1);
            }
            if ($attachment_2) {
                $doc_attachment_2 = $attachment_2->getClientOriginalName();
                $attachment_2->move($file_location, $doc_attachment_2);
            }

            $payload = [
                'travel_booking_id' => $id,
                'attachment_type' => $attachment_type,
            ];

            $payload['attachment_1'] = $doc_attachment_1 ?: ($value['existing_attachment_1'] ?? '');
            $payload['attachment_2'] = $doc_attachment_2 ?: ($value['existing_attachment_2'] ?? '');

            $travel_booking_attachment_types_data = \App\Models\Travel\TravelBookingAttachment::updateOrCreate(
                ['id' => $rowId],
                $payload
            );
        }
        // ---------------------------------------------------------------------------

        // If anything changed (fields or attachments), write a log
        // (For attachments, simplest is: if attachment loop ran and updated something, set a flag in changes)
        if ($travel_booking_attachment_types_data) {
            $changes['_attachments'] = ['old' => 'See previous', 'new' => 'Updated attachments'];
        }

        if (!empty($changes)) {
            TravelBookingChangeLog::create([
                'travel_booking_id' => $id,
                'user_id' => $currentUserId,
                'status_at_time' => $tbModel->management_approval_status,
                'remarks' => $remarks,
                'changes' => $changes,
                'ip' => $request->ip(),
                'user_agent' => (string) $request->userAgent(),
            ]);
        }

        if ($tbSaved || $travel_booking_attachment_types_data) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('travel_booking'));
    }



    public function deleteAttachments(Request $request)
    {
        $tb = TravelBookingAttachment::findOrFail($request->id);
        $del = $tb->delete();

        if ($del) {
            $msg = '<div class="alert alert-success" role="alert">
                    Record has been deleted.
                </div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">
                    Something went wrong
                </div>';
        }
        return $msg;
    }


    public function getTravelerDetails(Request $request)
    {
        $employee_id = $request->employee_id;

        $user = User::find($employee_id);

        $person_to_notify = $user->person_to_notify;
        $site = $user->site;
        $department = $user->department;
        $nationality = $user->nationality;
        $passport_number = $user->passport_number;
        $contact_number = $user->work_phone;
        $employee_status = $user->status;
        $emergency_contact_name = $user->emergency_contact_name;
        $emergency_contact_phone = $user->emergency_contact_phone;

        $person_to_notify_details = User::find($person_to_notify);

        if ($person_to_notify_details == null) {
            $ptn_first_name = "";
            $ptn_last_name = "";
        } else {
            $ptn_first_name = $person_to_notify_details->first_name;
            $ptn_last_name = $person_to_notify_details->last_name;
        }

        if ($employee_status == 1) {
            $employee_status = "Active";
        } else {
            $employee_status = "In-Active";
        }

        $jsonData = [
            'person_to_notify' => $ptn_first_name . " " . $ptn_last_name,
            'site' => $site,
            'department' => $department,
            'nationality' => $nationality,
            'passport_number' => $passport_number,
            'contact_number' => $contact_number,
            'employee_status' => $employee_status,
            'emergency_contact_name' => $emergency_contact_name,
            'emergency_contact_phone' => $emergency_contact_phone,
        ];

        // Return the JSON response
        return response()->json($jsonData);
    }

    public function delete($id)
    {
        $tbs = TravelBooking::find($id);

        if ($tbs) {
            TravelBookingAttachment::where('travel_booking_id', $id)->delete();
            $del = $tbs->delete();

            if ($del) {
                session()->flash('success', 'Record and related attachments have been deleted successfully');
            } else {
                session()->flash('error', 'Something went wrong!');
            }
        } else {
            session()->flash('error', 'Record not found!');
        }

        return redirect(route('travel_booking'));
    }

    public function approval($id, $status)
    {
        $current_user = Auth::user();

        if ($current_user) {
            $currentUserId = $current_user->id;
        }

        $current_date = now()->toDateString();

        $tb = DB::table('travel_bookings')
            ->where('id', $id)
            ->update([
                'management_approval_status' => $status,
                'approver_name' => $currentUserId,
                'approved_date' => $current_date,
            ]);

        $tbs = TravelBooking::find($id);

        $traveler_id = $tbs->traveler;
        $get_traveler_details = User::find($traveler_id);
        $traveler_name = $get_traveler_details->first_name . " " . $get_traveler_details->last_name;

        //Get Manager Details
        $get_manager_details = User::find($current_user->id);
        $manager_name = $get_manager_details->first_name . " " . $get_manager_details->last_name;

        $options = dynamicOptions();

        $manager_email = $get_manager_details->email ?? null;
        $hr_email = $options['hr_email'] ?? null;

        $link = '<a href="' . url('/read_travel_booking/' . $id) . '">Click here</a> to view the record.';

        if ($status == 1) {
            $bodyText = 'Your travel request has been approved by ' . $manager_name . ' ' . $link;
        } else {
            $bodyText = 'Your travel request has been rejected by ' . $manager_name . ' ' . $link;
        }


        $mailData = [
            'traveler_name' => $traveler_name,
            'bodyText' => $bodyText,
        ];

        $recipients = [];

        if (!empty($manager_email)) {
            $recipients[] = $manager_email;
        }

        if (!empty($hr_email)) {
            if (is_array($hr_email)) {
                $recipients = array_merge($recipients, array_values($hr_email));
            } else {
                $recipients[] = $hr_email;
            }
        }

        $recipients = array_unique(array_filter($recipients)); // clean up

        if (!empty($recipients)) {
            Mail::to($recipients)->send(new TravelRequestNotification($mailData));
        }

        if ($tb) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('travel_booking'));
    }

}
