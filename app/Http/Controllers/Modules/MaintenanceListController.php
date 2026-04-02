<?php

namespace App\Http\Controllers\Modules;

use App\Exports\MaintenanceListExport;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceListRequest;
use App\Imports\MaintenanceListImport;
use App\Mail\MaintenanceListMail;
use App\Models\Modules\MaintenanceList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class MaintenanceListController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = MaintenanceList::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $maintenance_lists = $query->get();

        return view('modules.maintenance_list.maintenance_list')
            ->with('maintenance_lists', $maintenance_lists)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $frequencyArr = $options['frequency'];
        $maintenance_byArr = $options['maintenance_by'];
        $equipment_statusArr = $options['equipment_status'];

        return view('modules.maintenance_list.create_maintenance_list')
            ->with('siteArr', $siteArr)
            ->with('frequencyArr', $frequencyArr)
            ->with('maintenance_byArr', $maintenance_byArr)
            ->with('equipment_statusArr', $equipment_statusArr);
    }

    public function store(MaintenanceListRequest $request)
    {
        $equipment_id = $request->equipment_id;
        $site = $request->site;
        $serial_num = $request->serial_num;
        $equipment_description = $request->equipment_description;
        $manufacturer = $request->manufacturer;
        $model = $request->model;
        $location = $request->location;
        $frequency = $request->frequency;
        $last_maintenance_performed = $request->last_maintenance_performed;
        $next_maintenance_performed = $request->next_maintenance_performed;
        $maintenance_by = $request->maintenance_by;
        $comments = $request->comments;
        $equipment_status = $request->equipment_status;
        $action_required = $request->action_required;

        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $attachment = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/maintenance_list';

            // Upload file
            $file->move($file_location, $attachment);
        } else {
            $attachment = '';
        }

        $maintenance_list = MaintenanceList::create([
            'equipment_id' => $equipment_id,
            'site' => $site,
            'serial_num' => $serial_num,
            'equipment_description' => $equipment_description,
            'manufacturer' => $manufacturer,
            'model' => $model,
            'location' => $location,
            'frequency' => $frequency,
            'last_maintenance_performed' => $last_maintenance_performed,
            'next_maintenance_performed' => $next_maintenance_performed,
            'maintenance_by' => $maintenance_by,
            'comments' => $comments,
            'equipment_status' => $equipment_status,
            'action_required' => $action_required,
            'attachment' => $attachment,
        ]);

        if ($maintenance_list) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('maintenance_list'));
    }

    public function read($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $frequencyArr = $options['frequency'];
        $maintenance_byArr = $options['maintenance_by'];
        $equipment_statusArr = $options['equipment_status'];

        $maintenance_list = MaintenanceList::find($id);

        return view('modules.maintenance_list.read_maintenance_list')
            ->with('siteArr', $siteArr)
            ->with('frequencyArr', $frequencyArr)
            ->with('maintenance_byArr', $maintenance_byArr)
            ->with('equipment_statusArr', $equipment_statusArr)
            ->with('maintenance_list', $maintenance_list);
    }

    public function edit($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $frequencyArr = $options['frequency'];
        $maintenance_byArr = $options['maintenance_by'];
        $equipment_statusArr = $options['equipment_status'];

        $maintenance_list = MaintenanceList::find($id);

        return view('modules.maintenance_list.edit_maintenance_list')
            ->with('siteArr', $siteArr)
            ->with('frequencyArr', $frequencyArr)
            ->with('maintenance_byArr', $maintenance_byArr)
            ->with('equipment_statusArr', $equipment_statusArr)
            ->with('maintenance_list', $maintenance_list);
    }

    public function update(MaintenanceListRequest $request)
    {
        $id = $request->id;
        $equipment_id = $request->equipment_id;
        $site = $request->site;
        $serial_num = $request->serial_num;
        $equipment_description = $request->equipment_description;
        $manufacturer = $request->manufacturer;
        $model = $request->model;
        $location = $request->location;
        $frequency = $request->frequency;
        $last_maintenance_performed = $request->last_maintenance_performed;
        $next_maintenance_performed = $request->next_maintenance_performed;
        $maintenance_by = $request->maintenance_by;
        $comments = $request->comments;
        $equipment_status = $request->equipment_status;
        $action_required = $request->action_required;

        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $attachment = $file->getClientOriginalName();

            // File upload location
            $file_location = 'uploads/maintenance_list';

            // Upload file
            $file->move($file_location, $attachment);
        } else {
            $attachment = $request->old_attachment;
        }

        $maintenance_list = DB::table('maintenance_lists')
            ->where('id', $id)
            ->update([
                'equipment_id' => $equipment_id,
                'site' => $site,
                'serial_num' => $serial_num,
                'equipment_description' => $equipment_description,
                'manufacturer' => $manufacturer,
                'model' => $model,
                'location' => $location,
                'frequency' => $frequency,
                'last_maintenance_performed' => $last_maintenance_performed,
                'next_maintenance_performed' => $next_maintenance_performed,
                'maintenance_by' => $maintenance_by,
                'comments' => $comments,
                'equipment_status' => $equipment_status,
                'action_required' => $action_required,
                'attachment' => $attachment,
            ]);

        if ($maintenance_list) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('maintenance_list'));
    }

    public function delete($id)
    {
        $maintenance_list = MaintenanceList::find($id);
        $maintenance_list_del = $maintenance_list->delete();

        if ($maintenance_list_del) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('maintenance_list'));

    }

    public function print($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $frequencyArr = $options['frequency'];
        $maintenance_byArr = $options['maintenance_by'];
        $equipment_statusArr = $options['equipment_status'];

        $maintenance_list = MaintenanceList::find($id);

        return view('modules.maintenance_list.print_maintenance_list')
            ->with('siteArr', $siteArr)
            ->with('frequencyArr', $frequencyArr)
            ->with('maintenance_byArr', $maintenance_byArr)
            ->with('equipment_statusArr', $equipment_statusArr)
            ->with('maintenance_list', $maintenance_list);
    }

    public function email($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $frequencyArr = $options['frequency'];
        $maintenance_byArr = $options['maintenance_by'];
        $equipment_statusArr = $options['equipment_status'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $maintenance_list = MaintenanceList::find($id);

        return view('modules.maintenance_list.mail_maintenance_list')
            ->with('siteArr', $siteArr)
            ->with('frequencyArr', $frequencyArr)
            ->with('maintenance_byArr', $maintenance_byArr)
            ->with('equipment_statusArr', $equipment_statusArr)
            ->with('users', $users)
            ->with('maintenance_list', $maintenance_list);
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
        $maintenance_list = MaintenanceList::find($id);
        $base_url = $site_urlArr['base_url'];

        $personal_message = $request->personal_message;

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'equipment_id' => $maintenance_list->equipment_id,
            'site' => $maintenance_list->site,
            'serial_num' => $maintenance_list->serial_num,
            'equipment_description' => $maintenance_list->equipment_description,
            'manufacturer' => $maintenance_list->manufacturer,
            'model' => $maintenance_list->model,
            'location' => $maintenance_list->location,
            'frequency' => $maintenance_list->frequency,
            'last_maintenance_performed' => $maintenance_list->last_maintenance_performed,
            'next_maintenance_performed' => $maintenance_list->next_maintenance_performed,
            'maintenance_by' => $maintenance_list->maintenance_by,
            'comments' => $maintenance_list->comments,
            'equipment_status' => $maintenance_list->equipment_status,
            'action_required' => $maintenance_list->action_required,
            'attachment' => $maintenance_list->attachment,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new MaintenanceListMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('maintenance_list'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new MaintenanceListExport, 'MaintenanceList.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new MaintenanceListImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('maintenance_list'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('maintenance_list'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('maintenance_list'));
    }

    public function addMaintenanceBy(Request $request)
    {
        $newMaintenanceBy = $request->input('value');

        if (empty($newMaintenanceBy)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('maintenance_by', $newMaintenanceBy);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }
    }
}
