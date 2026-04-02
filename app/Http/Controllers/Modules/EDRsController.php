<?php

namespace App\Http\Controllers\Modules;

use App\Exports\EdrsExport;
use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EDRsRequest;
use App\Imports\EdrsImport;
use App\Mail\EDRsMail;
use App\Models\Modules\Edr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;

class EDRsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $query = Edr::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);

        $edrs = $query->get();
        return view('modules.edrs.edrs')
            ->with('edrs', $edrs)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $type_of_emergency_simulatedArr = $options['type_of_emergency_simulated'];
        $notification_usedArr = $options['notification_used'];

        return view('modules.edrs.create_edrs')
            ->with('siteArr', $siteArr)
            ->with('type_of_emergency_simulatedArr', $type_of_emergency_simulatedArr)
            ->with('notification_usedArr', $notification_usedArr);
    }

    public function store(EDRsRequest $request)
    {
        $date_and_time_drill = $request->date_and_time_drill;
        $site = $request->site;
        $type_of_emergency_simulated = $request->type_of_emergency_simulated;
        $person_conducting_the_drill = $request->person_conducting_the_drill;
        $notification_used = $request->notification_used;
        $staff_on_duty = $request->staff_on_duty;
        $number_evacuated = $request->number_evacuated;
        $weather_conditions = $request->weather_conditions;
        $time_required = $request->time_required;
        $problems_encountered = $request->problems_encountered;
        $cpars = $request->cpars;
        $comments = $request->comments;
        $photo_1_description = $request->photo_1_description;
        $photo_2_description = $request->photo_2_description;

        $formatteddateAndTimeDrill = date('Y-m-d H:i:s', strtotime($date_and_time_drill));

        if ($request->file('attachment_staff_participating')) {
            $file = $request->file('attachment_staff_participating');
            $attachment_staff_participating = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/edrs';

            // Upload file
            $file->move($file_location, $attachment_staff_participating);
        } else {
            $attachment_staff_participating = "";
        }

        if ($request->file('photo_1')) {
            $file = $request->file('photo_1');
            $photo_1 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/edrs';

            // Upload file
            $file->move($file_location, $photo_1);
        } else {
            $photo_1 = "";
        }

        if ($request->file('photo_2')) {
            $file = $request->file('photo_2');
            $photo_2 = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/edrs';

            // Upload file
            $file->move($file_location, $photo_2);
        } else {
            $photo_2 = "";
        }

        // Get next global EDR running number (across ALL sites)
        $maxNumeric = Edr::pluck('edr_id')
            ->map(function ($id) {
                // Example: EDR-CPLA-0002 → 2
                return (int) substr($id, strrpos($id, '-') + 1);
            })
            ->max();

        $nextNumber = ($maxNumeric ?? 0) + 1;
        $maxValueEDR = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "EDR-CPCP-",
            "CPAE - Dubai"            => "EDR-CPAE-",
            "CPLA - Mandeville"       => "EDR-CPLA-",
            "CPTX - West Texas"       => "EDR-CPTX-",
            "CPUK - Aberdeen"         => "EDR-CPUK-",
        ];

        $edrPrefix = $prefixMap[$site] ?? "EDR-";
        $edr_id = $edrPrefix . $maxValueEDR;

        $edr = Edr::create([
            'edr_id' => $edr_id,
            'date_and_time_drill' => $formatteddateAndTimeDrill,
            'site' => $site,
            'type_of_emergency_simulated' => $type_of_emergency_simulated,
            'person_conducting_the_drill' => $person_conducting_the_drill,
            'notification_used' => $notification_used,
            'staff_on_duty' => $staff_on_duty,
            'attachment_staff_participating' => $attachment_staff_participating,
            'number_evacuated' => $number_evacuated,
            'weather_conditions' => $weather_conditions,
            'time_required' => $time_required,
            'problems_encountered' => $problems_encountered,
            'cpars' => $cpars,
            'comments' => $comments,
            'photo_1_description' => $photo_1_description,
            'photo_1' => $photo_1,
            'photo_2_description' => $photo_2_description,
            'photo_2' => $photo_2,
        ]);

        if ($edr) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('edrs'));
    }

    public function read($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $type_of_emergency_simulatedArr = $options['type_of_emergency_simulated'];
        $notification_usedArr = $options['notification_used'];

        $edr = Edr::find($id);

        return view('modules.edrs.read_edrs')
            ->with('siteArr', $siteArr)
            ->with('type_of_emergency_simulatedArr', $type_of_emergency_simulatedArr)
            ->with('notification_usedArr', $notification_usedArr)
            ->with('edr', $edr);
    }

    public function edit($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $type_of_emergency_simulatedArr = $options['type_of_emergency_simulated'];
        $notification_usedArr = $options['notification_used'];

        $edr = Edr::find($id);

        return view('modules.edrs.edit_edrs')
            ->with('siteArr', $siteArr)
            ->with('type_of_emergency_simulatedArr', $type_of_emergency_simulatedArr)
            ->with('notification_usedArr', $notification_usedArr)
            ->with('edr', $edr);
    }

    public function update(EDRsRequest $request)
    {
        $id = $request->id;
        $edr_id = $request->edr_id;
        $date_and_time_drill = $request->date_and_time_drill;
        $site = $request->site;
        $type_of_emergency_simulated = $request->type_of_emergency_simulated;
        $person_conducting_the_drill = $request->person_conducting_the_drill;
        $notification_used = $request->notification_used;
        $staff_on_duty = $request->staff_on_duty;
        $number_evacuated = $request->number_evacuated;
        $weather_conditions = $request->weather_conditions;
        $time_required = $request->time_required;
        $problems_encountered = $request->problems_encountered;
        $cpars = $request->cpars;
        $comments = $request->comments;
        $photo_1_description = $request->photo_1_description;
        $photo_2_description = $request->photo_2_description;

        $formatteddateAndTimeDrill = date('Y-m-d H:i:s', strtotime($date_and_time_drill));

        if ($request->file('attachment_staff_participating')) {
            $file = $request->file('attachment_staff_participating');
            $attachment_staff_participating = $file->getClientOriginalName();

            $file_location = 'uploads/edrs';

            $file->move($file_location, $attachment_staff_participating);
        } else {
            $attachment_staff_participating = $request->old_attachment_staff_participating;
        }

        if ($request->file('photo_1')) {
            $file = $request->file('photo_1');
            $photo_1 = $file->getClientOriginalName();

            $file_location = 'uploads/edrs';

            $file->move($file_location, $photo_1);
        } else {
            $photo_1 = $request->old_photo_1;
        }

        if ($request->file('photo_2')) {
            $file = $request->file('photo_2');
            $photo_2 = $file->getClientOriginalName();

            $file_location = 'uploads/edrs';

            $file->move($file_location, $photo_2);
        } else {
            $photo_2 = $request->old_photo_2;
        }

        // Keep SAME running number, only update prefix based on site
        $numericPart = substr($edr_id, strrpos($edr_id, '-') + 1); // e.g. "0007"
        $numericPart = str_pad((int)$numericPart, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "EDR-CPCP-",
            "CPAE - Dubai"            => "EDR-CPAE-",
            "CPLA - Mandeville"       => "EDR-CPLA-",
            "CPTX - West Texas"       => "EDR-CPTX-",
            "CPUK - Aberdeen"         => "EDR-CPUK-",
        ];

        $edrPrefix = $prefixMap[$site] ?? "EDR-";
        $edr_id = $edrPrefix . $numericPart;

        $edr = DB::table('edrs')
            ->where('id', $id)
            ->update([
                'edr_id' => $edr_id,
                'date_and_time_drill' => $formatteddateAndTimeDrill,
                'site' => $site,
                'type_of_emergency_simulated' => $type_of_emergency_simulated,
                'person_conducting_the_drill' => $person_conducting_the_drill,
                'notification_used' => $notification_used,
                'staff_on_duty' => $staff_on_duty,
                'attachment_staff_participating' => $attachment_staff_participating,
                'number_evacuated' => $number_evacuated,
                'weather_conditions' => $weather_conditions,
                'time_required' => $time_required,
                'problems_encountered' => $problems_encountered,
                'cpars' => $cpars,
                'comments' => $comments,
                'photo_1_description' => $photo_1_description,
                'photo_1' => $photo_1,
                'photo_2_description' => $photo_2_description,
                'photo_2' => $photo_2,
            ]);

        if ($edr) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('edrs'));
    }

    public function print($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $type_of_emergency_simulatedArr = $options['type_of_emergency_simulated'];
        $notification_usedArr = $options['notification_used'];

        $edr = Edr::find($id);

        return view('modules.edrs.print_edrs')
            ->with('siteArr', $siteArr)
            ->with('type_of_emergency_simulatedArr', $type_of_emergency_simulatedArr)
            ->with('notification_usedArr', $notification_usedArr)
            ->with('edr', $edr);
    }

    public function email($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $type_of_emergency_simulatedArr = $options['type_of_emergency_simulated'];
        $notification_usedArr = $options['notification_used'];

        $edr = Edr::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.edrs.mail_edrs')
            ->with('siteArr', $siteArr)
            ->with('type_of_emergency_simulatedArr', $type_of_emergency_simulatedArr)
            ->with('notification_usedArr', $notification_usedArr)
            ->with('users', $users)
            ->with('edr', $edr);
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

        $edr = Edr::find($id);

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'edr_id' => $edr->edr_id,
            'date_and_time_drill' => $edr->date_and_time_drill,
            'site' => $edr->site,
            'type_of_emergency_simulated' => $edr->type_of_emergency_simulated,
            'person_conducting_the_drill' => $edr->person_conducting_the_drill,
            'notification_used' => $edr->notification_used,
            'staff_on_duty' => $edr->staff_on_duty,
            'attachment_staff_participating' => $edr->attachment_staff_participating,
            'number_evacuated' => $edr->number_evacuated,
            'weather_conditions' => $edr->weather_conditions,
            'time_required' => $edr->time_required,
            'problems_encountered' => $edr->problems_encountered,
            'cpars' => $edr->cpars,
            'comments' => $edr->comments,
            'photo_1_description' => $edr->photo_1_description,
            'photo_1' => $edr->photo_1,
            'photo_2_description' => $edr->photo_2_description,
            'photo_2' => $edr->photo_2,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new EDRsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('edrs'));
    }

    public function delete($id)
    {
        $edr = Edr::find($id);
        $edrDel = $edr->delete();

        if ($edrDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('edrs'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new EdrsExport, 'edrs.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new EdrsImport, $path);

                session()->flash('success', 'EDRs has been imported successfully');
                return redirect(route('edrs'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('edrs'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('edrs'));
    }
}
