<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalibratedDevicesRequest;
use App\Imports\CalibratedDevicesImport;
use App\Mail\CalibratedDevicesMail;
use App\Mail\DocumentMail;
use App\Models\Modules\CalibratedDevicePastYearsData;
use App\Models\Modules\CalibratedDevices;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\CalibratedDevicesExport;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;
use Illuminate\Database\QueryException;


class CalibratedDevicesController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $calibrationCategoryArr = $options['calibrationCategory'];

        $query = CalibratedDevices::orderBy('id', 'desc');

        $query = FilterHelper::filterBySite($query, $request);
        $query = FilterHelper::filterByCalibrationCategory($query, $request);
        $query = FilterHelper::filterByDeviceStatus($query, $request);

        $cds = $query->get();

        return view('modules.calibrated_devices.calibrated_devices')
            ->with('siteArr', $siteArr)
            ->with('calibrationCategoryArr', $calibrationCategoryArr)
            ->with('calibrated_devices', $cds)
            ->with('selectedSite', $request->query('site'))
            ->with('selectedCalibrationCategory', $request->query('calibration_category'))
            ->with('selectedDeviceStatus', $request->query('device_status'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $calibrationCategoryArr = $options['calibrationCategory'];
        $methodOfCalibrationArr = $options['methodOfCalibration'];
        return view('modules.calibrated_devices.create_calibrated_devices')
            ->with('siteArr', $siteArr)
            ->with('calibrationCategoryArr', $calibrationCategoryArr)
            ->with('methodOfCalibrationArr', $methodOfCalibrationArr);
    }

    public function store(CalibratedDevicesRequest $request)
    {
        $current_user = Auth::user();

        if ($current_user) {
            $userId = $current_user->id;
        }

        $device_id = $request->device_id;
        $site = $request->site;
        $calibration_category = $request->calibration_category;
        $calibration_report = $request->calibration_report;
        $calibration_supplier = $request->calibration_supplier;
        $serial_no = $request->serial_no;
        $device_description = $request->device_description;
        $manufacturer = $request->manufacturer;
        $model = $request->model;
        $location = $request->location;
        $calibration_type = $request->calibration_type;
        $calibration_frequency = $request->calibration_frequency;
        $accuracy_required = $request->accuracy_required;
        $standards_used = $request->standards_used;
        $method_of_calibration = $request->method_of_calibration;
        $readings_nominal_values = $request->readings_nominal_values;
        $readings_actual_values_1 = $request->readings_actual_values_1;
        $readings_actual_values_2 = $request->readings_actual_values_2;
        $readings_actual_values_3 = $request->readings_actual_values_3;
        $readings_corrected_values = $request->readings_corrected_values;
        $date_last_calibrated = $request->date_last_calibrated;
        $temperature = $request->temperature;
        $temp_unit = $request->temp_unit;
        $next_calibration_due_date = $request->next_calibration_due_date;
        $humidity = $request->humidity;
        $calibrated_by = $request->calibrated_by;
        $approved_by = $request->approved_by;
        $device_status = $request->device_status;
        $calibration_status = $request->calibration_status;
        $tp_calibrated_results_as_found = $request->tp_calibrated_results_as_found;
        $tp_calibrated_results_as_left = $request->tp_calibrated_results_as_left;
        $ncr = $request->ncr;
        $comments = $request->comments;
        $created_by = $userId;

        if ($request->file('calibration_device_front_image')) {
            $file = $request->file('calibration_device_front_image');

            // Get the original file extension
            $extension = $file->getClientOriginalExtension();

            // Generate a unique filename using timestamp and original name
            $calibration_device_front_image = time() . '_' . uniqid() . '.' . $extension;

            // File upload location
            $file_location = 'uploads/calibrated_devices';

            // Upload file
            $file->move($file_location, $calibration_device_front_image);
        } else {
            $calibration_device_front_image = '';
        }

        if ($request->file('calibration_device_back_image')) {
            $file = $request->file('calibration_device_back_image');

            // Get the original file extension
            $extension = $file->getClientOriginalExtension();

            // Generate a unique filename using timestamp and unique ID
            $calibration_device_back_image = time() . '_back_' . uniqid() . '.' . $extension;

            // File upload location
            $file_location = 'uploads/calibrated_devices';

            // Upload file
            $file->move($file_location, $calibration_device_back_image);
        } else {
            $calibration_device_back_image = '';
        }

        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $original_filename = $file->getClientOriginalName();

            $filename = $original_filename;

            $file_location = 'uploads/calibrated_devices';

            $file->move($file_location, $filename);
        } else {
            $filename = "";
        }

        $cd = CalibratedDevices::create([
            'device_id' => $device_id,
            'site' => $site,
            'calibration_device_front_image' => $calibration_device_front_image,
            'calibration_device_back_image' => $calibration_device_back_image,
            'calibration_category' => $calibration_category,
            'calibration_report' => $calibration_report,
            'calibration_supplier' => $calibration_supplier,
            'serial_no' => $serial_no,
            'device_description' => $device_description,
            'manufacturer' => $manufacturer,
            'model' => $model,
            'location' => $location,
            'calibration_type' => $calibration_type,
            'calibration_frequency' => $calibration_frequency,
            'accuracy_required' => $accuracy_required,
            'standards_used' => $standards_used,
            'method_of_calibration' => $method_of_calibration,
            'readings_nominal_values' => $readings_nominal_values,
            'readings_actual_values_1' => $readings_actual_values_1,
            'readings_actual_values_2' => $readings_actual_values_2,
            'readings_actual_values_3' => $readings_actual_values_3,
            'readings_corrected_values' => $readings_corrected_values,
            'date_last_calibrated' => $date_last_calibrated,
            'next_calibration_due_date' => $next_calibration_due_date,
            'temperature' => $temperature,
            'temp_unit' => $temp_unit,
            'humidity' => $humidity,
            'calibrated_by' => $calibrated_by,
            'approved_by' => $approved_by,
            'device_status' => $device_status,
            'calibration_status' => $calibration_status,
            'tp_calibrated_results_as_found' => $tp_calibrated_results_as_found,
            'tp_calibrated_results_as_left' => $tp_calibrated_results_as_left,
            'attachment' => $filename,
            'ncr' => $ncr,
            'comments' => $comments,
            'created_by' => $created_by,
        ]);

        if ($cd) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('calibrated_devices'));

    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $calibrationCategoryArr = $options['calibrationCategory'];
        $methodOfCalibrationArr = $options['methodOfCalibration'];
        $cds = CalibratedDevices::find($id);
        $cdsPastData = CalibratedDevicePastYearsData::where('calibrated_device_id', $id)->get();

        $cds_created_by = $cds->created_by;
        $created_by_user = User::find($cds_created_by);

        if ($created_by_user) {
            $created_by = $created_by_user->first_name . " " . $created_by_user->last_name;
        } else {
            $created_by = 'Record created before this feature';
        }


        $cds_updated_by = $cds->updated_by;
        $updated_by_user = User::find($cds_updated_by);

        if ($updated_by_user) {
            $updated_by = $updated_by_user->first_name . " " . $updated_by_user->last_name;
        } else {
            $updated_by = 'Record created before this feature';
        }

        return view('modules.calibrated_devices.read_calibrated_devices')->with('cds', $cds)
            ->with('siteArr', $siteArr)
            ->with('calibrationCategoryArr', $calibrationCategoryArr)
            ->with('methodOfCalibrationArr', $methodOfCalibrationArr)
            ->with('cdsPastData', $cdsPastData)
            ->with('created_by', $created_by)
            ->with('updated_by', $updated_by);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $calibrationCategoryArr = $options['calibrationCategory'];
        $methodOfCalibrationArr = $options['methodOfCalibration'];
        $cds = CalibratedDevices::find($id);
        $cdsPastData = CalibratedDevicePastYearsData::where('calibrated_device_id', $id)->get();
        return view('modules.calibrated_devices.edit_calibrated_devices')->with('cds', $cds)
            ->with('siteArr', $siteArr)
            ->with('calibrationCategoryArr', $calibrationCategoryArr)
            ->with('methodOfCalibrationArr', $methodOfCalibrationArr)
            ->with('cdsPastData', $cdsPastData);
    }

    public function update(CalibratedDevicesRequest $request)
    {
        $current_user = Auth::user();

        if ($current_user) {
            $userId = $current_user->id;
        }

        $id = $request->id;
        $device_id = $request->device_id;
        $site = $request->site;
        $calibration_category = $request->calibration_category;
        $calibration_report = $request->calibration_report;
        $calibration_supplier = $request->calibration_supplier;
        $serial_no = $request->serial_no;
        $device_description = $request->device_description;
        $manufacturer = $request->manufacturer;
        $model = $request->model;
        $location = $request->location;
        $calibration_type = $request->calibration_type;
        $calibration_frequency = $request->calibration_frequency;
        $accuracy_required = $request->accuracy_required;
        $standards_used = $request->standards_used;
        $method_of_calibration = $request->method_of_calibration;
        $readings_nominal_values = $request->readings_nominal_values;
        $readings_actual_values_1 = $request->readings_actual_values_1;
        $readings_actual_values_2 = $request->readings_actual_values_2;
        $readings_actual_values_3 = $request->readings_actual_values_3;
        $readings_corrected_values = $request->readings_corrected_values;
        $date_last_calibrated = $request->date_last_calibrated;
        $next_calibration_due_date = $request->next_calibration_due_date;
        $temperature = $request->temperature;
        $temp_unit = $request->temp_unit;
        $humidity = $request->humidity;
        $calibrated_by = $request->calibrated_by;
        $approved_by = $request->approved_by;
        $device_status = $request->device_status;
        $calibration_status = $request->calibration_status;
        $tp_calibrated_results_as_found = $request->tp_calibrated_results_as_found;
        $tp_calibrated_results_as_left = $request->tp_calibrated_results_as_left;
        $ncr = $request->ncr;
        $comments = $request->comments;
        $updated_by = $userId;

        if ($request->file('calibration_device_front_image')) {
            $file = $request->file('calibration_device_front_image');

            // Get the original file extension
            $extension = $file->getClientOriginalExtension();

            // Generate a unique filename
            $calibration_device_front_image = time() . '_front_' . uniqid() . '.' . $extension;

            // File upload location
            $file_location = 'uploads/calibrated_devices';

            // Upload file
            $file->move($file_location, $calibration_device_front_image);
        } else {
            $calibration_device_front_image = $request->old_calibration_device_front_image;
        }

        if ($request->file('calibration_device_back_image')) {
            $file = $request->file('calibration_device_back_image');

            // Get the original file extension
            $extension = $file->getClientOriginalExtension();

            // Generate a unique filename
            $calibration_device_back_image = time() . '_back_' . uniqid() . '.' . $extension;

            // File upload location
            $file_location = 'uploads/calibrated_devices';

            // Upload file
            $file->move($file_location, $calibration_device_back_image);
        } else {
            $calibration_device_back_image = $request->old_calibration_device_back_image;
        }

        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $original_filename = $file->getClientOriginalName();

            $filename = $original_filename;

            $file_location = 'uploads/calibrated_devices';

            $file->move($file_location, $filename);
        } else {
            $filename = $request->old_attachment;
        }

        $cds = DB::table('calibrated_devices')
            ->where('id', $id)
            ->update([
                'device_id' => $device_id,
                'site' => $site,
                'calibration_device_front_image' => $calibration_device_front_image,
                'calibration_device_back_image' => $calibration_device_back_image,
                'calibration_category' => $calibration_category,
                'calibration_report' => $calibration_report,
                'calibration_supplier' => $calibration_supplier,
                'serial_no' => $serial_no,
                'device_description' => $device_description,
                'manufacturer' => $manufacturer,
                'model' => $model,
                'location' => $location,
                'calibration_type' => $calibration_type,
                'calibration_frequency' => $calibration_frequency,
                'accuracy_required' => $accuracy_required,
                'standards_used' => $standards_used,
                'method_of_calibration' => $method_of_calibration,
                'readings_nominal_values' => $readings_nominal_values,
                'readings_actual_values_1' => $readings_actual_values_1,
                'readings_actual_values_2' => $readings_actual_values_2,
                'readings_actual_values_3' => $readings_actual_values_3,
                'readings_corrected_values' => $readings_corrected_values,
                'date_last_calibrated' => $date_last_calibrated,
                'next_calibration_due_date' => $next_calibration_due_date,
                'temperature' => $temperature,
                'temp_unit' => $temp_unit,
                'humidity' => $humidity,
                'calibrated_by' => $calibrated_by,
                'approved_by' => $approved_by,
                'device_status' => $device_status,
                'calibration_status' => $calibration_status,
                'tp_calibrated_results_as_found' => $tp_calibrated_results_as_found,
                'tp_calibrated_results_as_left' => $tp_calibrated_results_as_left,
                'attachment' => $filename,
                'ncr' => $ncr,
                'comments' => $comments,
                'updated_by' => $updated_by,
                'updated_at' => now(),
            ]);

        foreach ($request->input('kt_docs_repeater_basic') as $key => $value) {

            $past_years = $value['past_year'];

            $attachment_data = $request->file('kt_docs_repeater_basic');

            if (($past_years == "N/A") && (!isset($attachment_data))) {
                $calibrated_device_past_years_data = 1;
            } elseif (($past_years != "N/A") && (!isset($attachment_data))) {
                $validated = $request->validate([
                    'past_attachment_1' => 'required',
                ]);
            } else {

                if (!isset($attachment_data)) {
                    $attachment_1 = '';
                    $attachment_2 = '';
                } else {
                    $attachment_1 = $attachment_data[$key]['past_attachment_1'];

                    if (isset($attachment_data[$key]['past_attachment_2'])) {
                        $attachment_2 = $attachment_data[$key]['past_attachment_2'];
                    } else {
                        $attachment_2 = '';
                    }
                }


                if ($attachment_1) {
                    $file = $attachment_1;
                    $past_attachment_1 = $file->getClientOriginalName();

                    // File upload location
                    $file_location = 'uploads/calibrated_devices/past_attachments';

                    // Upload file
                    $file->move($file_location, $past_attachment_1);
                } else {
                    $past_attachment_1 = '';
                }

                if ($attachment_2) {
                    $file = $attachment_2;
                    $past_attachment_2 = $file->getClientOriginalName();

                    // File upload location
                    $file_location = 'uploads/calibrated_devices/past_attachments';

                    // Upload file
                    $file->move($file_location, $past_attachment_2);
                } else {
                    $past_attachment_2 = '';
                }


                $calibrated_device_past_years_data = CalibratedDevicePastYearsData::updateOrCreate(
                    ['id' => $id], // Check if record with this ID exists
                    [
                        'calibrated_device_id' => $id,
                        'past_year' => $past_years,
                        'past_attachment_1' => $past_attachment_1,
                        'past_attachment_2' => $past_attachment_2,
                    ]
                );
            }

        }

        if ($cds || $calibrated_device_past_years_data) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('calibrated_devices'));
    }

    public function delete($id)
    {
        $cds = CalibratedDevices::find($id);
        $cds->delete();

        session()->flash('success', 'Record has been deleted successfully');

        return redirect(route('calibrated_devices'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $calibrationCategoryArr = $options['calibrationCategory'];
        $methodOfCalibrationArr = $options['methodOfCalibration'];
        $cds = CalibratedDevices::find($id);

        return view('modules.calibrated_devices.print_calibrated_devices')->with('cds', $cds)
            ->with('siteArr', $siteArr)
            ->with('calibrationCategoryArr', $calibrationCategoryArr)
            ->with('methodOfCalibrationArr', $methodOfCalibrationArr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $calibrationCategoryArr = $options['calibrationCategory'];
        $methodOfCalibrationArr = $options['methodOfCalibration'];
        $cds = CalibratedDevices::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.calibrated_devices.mail_calibrated_devices')->with('cds', $cds)
            ->with('siteArr', $siteArr)
            ->with('calibrationCategoryArr', $calibrationCategoryArr)
            ->with('methodOfCalibrationArr', $methodOfCalibrationArr)
            ->with('users', $users);
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
        $cds = CalibratedDevices::find($id);
        $base_url = $site_urlArr['base_url'];

        $personal_message = $request->personal_message;

        $mailData = [
            'calibration_device_front_image' => $cds->calibration_device_front_image,
            'calibration_device_back_image' => $cds->calibration_device_back_image,
            'personal_message' => $personal_message,
            'device_id' => $cds->device_id,
            'site' => $cds->site,
            'calibration_category' => $cds->calibration_category,
            'calibration_report' => $cds->calibration_report,
            'calibration_supplier' => $cds->calibration_supplier,
            'serial_no' => $cds->serial_no,
            'device_description' => $cds->device_description,
            'manufacturer' => $cds->manufacturer,
            'model' => $cds->model,
            'location' => $cds->location,
            'calibration_type' => $cds->calibration_type,
            'calibration_frequency' => $cds->calibration_frequency,
            'accuracy_required' => $cds->accuracy_required,
            'standards_used' => $cds->standards_used,
            'method_of_calibration' => $cds->method_of_calibration,
            'readings_nominal_values' => $cds->readings_nominal_values,
            'readings_actual_values_1' => $cds->readings_actual_values_1,
            'readings_actual_values_2' => $cds->readings_actual_values_2,
            'readings_actual_values_3' => $cds->readings_actual_values_3,
            'readings_corrected_values' => $cds->readings_corrected_values,
            'date_last_calibrated' => $cds->date_last_calibrated,
            'next_calibration_due_date' => $cds->next_calibration_due_date,
            'temperature' => $cds->temperature,
            'temp_unit' => $cds->temp_unit,
            'humidity' => $cds->humidity,
            'calibrated_by' => $cds->calibrated_by,
            'approved_by' => $cds->approved_by,
            'device_status' => $cds->device_status,
            'calibration_status' => $cds->calibration_status,
            'tp_calibrated_results_as_found' => $cds->tp_calibrated_results_as_found,
            'attachment' => $cds->attachment,
            'ncr' => $cds->ncr,
            'comments' => $cds->comments,
            'base_url' => $base_url,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new CalibratedDevicesMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('calibrated_devices'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new CalibratedDevicesExport, 'calibratedDevices.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new CalibratedDevicesImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('calibrated_devices'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('calibrated_devices'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('calibrated_devices'));
    }

    public function deletePastRecord(Request $request)
    {
        $cds = CalibratedDevicePastYearsData::findOrFail($request->id);
        $c = $cds->delete();

        if ($c) {
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
}
