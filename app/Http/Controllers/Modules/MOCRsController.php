<?php

namespace App\Http\Controllers\Modules;

use App\Exports\MocrsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MocrRequest;
use App\Imports\MocrsImport;
use App\Mail\MocrsMail;
use App\Models\Modules\Mocr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;

class MOCRsController extends Controller
{
    public function index()
    {
        $query = Mocr::orderBy('mocrs.id', 'desc')
            ->leftJoin('users as requested_by', 'mocrs.change_requested_by', '=', 'requested_by.id')
            ->leftJoin('users as authorized_by', 'mocrs.change_authorized_by', '=', 'authorized_by.id')
            ->select([
                'mocrs.*',
                'requested_by.first_name as requested_by_first_name',
                'requested_by.last_name as requested_by_last_name',
                'authorized_by.first_name as authorized_by_first_name',
                'authorized_by.last_name as authorized_by_last_name',
            ]);

        $mocrs = $query->get();

        return view('modules.mocrs.mocrs')->with('mocrs', $mocrs);
    }

    public function read($id)
    {
        $mocr = Mocr::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.mocrs.read_mocrs')
            ->with('users', $users)
            ->with('mocr', $mocr);
    }

    public function create()
    {
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

        return view('modules.mocrs.create_mocrs')->with('users', $users);
    }

    public function store(MocrRequest $request)
    {
        $change_requested_by = $request->change_requested_by;
        $date_requested = $request->date_requested;
        $proposed_qms_change = $request->proposed_qms_change;
        $purpose_of_change = $request->purpose_of_change;
        $potential_consequence_of_change = $request->potential_consequence_of_change;
        $impact_on_integrity_of_qms = $request->impact_on_integrity_of_qms;
        $availability_of_resources = $request->availability_of_resources;
        $allocation_or_reallocation = $request->allocation_or_reallocation;
        $additional_considerations = $request->additional_considerations;
        $change_authorized_by = $request->change_authorized_by;
        $date_authorized = $request->date_authorized;

        // Retrieve all dcr_num values from the database
        $get_all_mocr_id = Mocr::pluck('mocr_id');

        if ($get_all_mocr_id->isNotEmpty()) {

            $firstMOCRid = $get_all_mocr_id->first();
            $prefix = substr($firstMOCRid, 0, strrpos($firstMOCRid, '-') + 1);

            $cleanedItems = $get_all_mocr_id->map(function ($item) use ($prefix) {
                return (int)str_replace($prefix, '', $item);
            });

            $maxValue = $cleanedItems->max();

            $maxValueMOCR = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);

        } else {
            $maxValue = 0;

            $maxValueMOCR = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);
        }

        $mocr_id = "MOCR-" . $maxValueMOCR;

        $mocr = Mocr::create([
            'mocr_id' => $mocr_id,
            'change_requested_by' => $change_requested_by,
            'date_requested' => $date_requested,
            'proposed_qms_change' => $proposed_qms_change,
            'purpose_of_change' => $purpose_of_change,
            'potential_consequence_of_change' => $potential_consequence_of_change,
            'impact_on_integrity_of_qms' => $impact_on_integrity_of_qms,
            'availability_of_resources' => $availability_of_resources,
            'allocation_or_reallocation' => $allocation_or_reallocation,
            'additional_considerations' => $additional_considerations,
            'change_authorized_by' => $change_authorized_by,
            'date_authorized' => $date_authorized,
        ]);

        if ($mocr) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('mocrs'));
    }

    public function edit($id)
    {
        $mocr = Mocr::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.mocrs.edit_mocrs')
            ->with('users', $users)
            ->with('mocr', $mocr);
    }

    public function update(MocrRequest $request)
    {
        $id = $request->id;
        $mocr_id = $request->mocr_id;
        $change_requested_by = $request->change_requested_by;
        $date_requested = $request->date_requested;
        $proposed_qms_change = $request->proposed_qms_change;
        $purpose_of_change = $request->purpose_of_change;
        $potential_consequence_of_change = $request->potential_consequence_of_change;
        $impact_on_integrity_of_qms = $request->impact_on_integrity_of_qms;
        $availability_of_resources = $request->availability_of_resources;
        $allocation_or_reallocation = $request->allocation_or_reallocation;
        $additional_considerations = $request->additional_considerations;
        $change_authorized_by = $request->change_authorized_by;
        $date_authorized = $request->date_authorized;

        $mocr = DB::table('mocrs')
            ->where('id', $id)
            ->update([
                'mocr_id' => $mocr_id,
                'change_requested_by' => $change_requested_by,
                'date_requested' => $date_requested,
                'proposed_qms_change' => $proposed_qms_change,
                'purpose_of_change' => $purpose_of_change,
                'potential_consequence_of_change' => $potential_consequence_of_change,
                'impact_on_integrity_of_qms' => $impact_on_integrity_of_qms,
                'availability_of_resources' => $availability_of_resources,
                'allocation_or_reallocation' => $allocation_or_reallocation,
                'additional_considerations' => $additional_considerations,
                'change_authorized_by' => $change_authorized_by,
                'date_authorized' => $date_authorized,
            ]);

        if ($mocr) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('mocrs'));
    }

    public function delete($id)
    {
        $mocr = Mocr::find($id);
        $mocrDel = $mocr->delete();

        if ($mocrDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('mocrs'));
    }

    public function print($id)
    {
        $mocr = Mocr::orderBy('mocrs.id', 'desc')
            ->leftJoin('users as requested_by', 'mocrs.change_requested_by', '=', 'requested_by.id')
            ->leftJoin('users as authorized_by', 'mocrs.change_authorized_by', '=', 'authorized_by.id')
            ->select([
                'mocrs.*',
                'requested_by.first_name as requested_by_first_name',
                'requested_by.last_name as requested_by_last_name',
                'authorized_by.first_name as authorized_by_first_name',
                'authorized_by.last_name as authorized_by_last_name',
            ])
            ->where('mocrs.id', $id)
            ->first();

        return view('modules.mocrs.print_mocrs')->with('mocr', $mocr);
    }

    public function email($id)
    {
        $mocr = Mocr::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.mocrs.mail_mocrs')
            ->with('users', $users)
            ->with('mocr', $mocr);
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

        $mocr = Mocr::orderBy('mocrs.id', 'desc')
            ->leftJoin('users as requested_by', 'mocrs.change_requested_by', '=', 'requested_by.id')
            ->leftJoin('users as authorized_by', 'mocrs.change_authorized_by', '=', 'authorized_by.id')
            ->select([
                'mocrs.*',
                'requested_by.first_name as requested_by_first_name',
                'requested_by.last_name as requested_by_last_name',
                'authorized_by.first_name as authorized_by_first_name',
                'authorized_by.last_name as authorized_by_last_name',
            ])
            ->where('mocrs.id', $id)
            ->first();

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'change_requested_by' => $mocr->requested_by_first_name . " " . $mocr->requested_by_last_name,
            'date_requested' => $mocr->date_requested,
            'mocr_id' => $mocr->mocr_id,
            'proposed_qms_change' => $mocr->proposed_qms_change,
            'purpose_of_change' => $mocr->purpose_of_change,
            'potential_consequence_of_change' => $mocr->potential_consequence_of_change,
            'impact_on_integrity_of_qms' => $mocr->impact_on_integrity_of_qms,
            'availability_of_resources' => $mocr->availability_of_resources,
            'allocation_or_reallocation' => $mocr->allocation_or_reallocation,
            'additional_considerations' => $mocr->additional_considerations,
            'change_authorized_by' => $mocr->authorized_by_first_name . " " . $mocr->authorized_by_last_name,
            'date_authorized' => $mocr->date_authorized,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new MocrsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');
        return redirect(route('mocrs'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new MocrsExport(), 'Mocrs.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new MocrsImport, $path);

                session()->flash('success', 'MOCRs has been imported successfully');
                return redirect(route('mocrs'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('mocrs'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('mocrs'));
    }
}
