<?php

namespace App\Http\Controllers\Modules;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingHistoryBulkRequest;
use App\Http\Requests\TrainingHistoryRequest;
use App\Mail\TrainingHistoryMail;
use App\Models\Modules\TrainingHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;
use Yajra\DataTables\Facades\DataTables;

class TrainingHistoryController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];

        $selectedSite = $request->query('site');

        // Query for records where employee_name is numeric (an ID)
        $query1 = TrainingHistory::orderBy('training_history.id', 'desc')
            ->leftJoin('users', 'training_history.employee_name', '=', 'users.id')
            ->select([
                'training_history.*',
                'users.first_name as user_first_name',
                'users.last_name as user_last_name',
                'users.site as user_site'
            ])
            ->whereRaw('CAST(training_history.employee_name AS UNSIGNED) > 0');

        // Query for records where employee_name is not numeric (a proper name)
        $query2 = TrainingHistory::orderBy('training_history.id', 'desc')
            ->select([
                'training_history.*',
                DB::raw('"" as user_first_name'), // Empty value for first_name
                DB::raw('"" as user_last_name'),  // Empty value for last_name
                DB::raw('"" as user_site')        // Empty value for site
            ])
            ->whereRaw('CAST(training_history.employee_name AS UNSIGNED) = 0');

        // Combine the queries using union
        $query = $query1->union($query2);

        if (!empty($selectedSite) && $selectedSite != 'Applicable to All Sites') {
            $query->where('users.site', $selectedSite);
        }

        $training_history = $query->get();

        $training_history_refined = collect();

        foreach ($training_history as $history) {
            $newTrainingRecord = [
                'employee_first_name' => $history->user_first_name ?? ($history->employee_name ?? ''), // Use user_first_name or employee_name if it's non-numeric
                'employee_last_name' => $history->user_last_name ?? '', // Use user_last_name or empty string
                'id' => $history->id,
                'trr_id' => $history->trr_id,
                'assessment_date' => $history->assessment_date,
                'must_be_completed_by' => $history->must_be_completed_by,
                'learning_session_title' => $history->learning_session_title,
                'training_type' => $history->training_type,
                'instructor' => $history->instructor,
                'learning_time' => $history->learning_time,
                'learning_session_completion_date' => $history->learning_session_completion_date,
                'link_to_learning_module' => $history->link_to_learning_module,
                'comments' => $history->comments,
                'attachment_1' => $history->attachment_1,
                'attachment_2' => $history->attachment_2,
                'attachment_3' => $history->attachment_3,
                'site' => $history->user_site ?? '',
                'current_job_title' => $history->current_job_title ?? '',
                'employee_status' => $history->status ?? '',
            ];

            $training_history_refined->push($newTrainingRecord);
        }

        return view('modules.training_history.training_history')
            ->with('training_history', $training_history_refined)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function getTrainingHistoryData(Request $request)
    {
        // Get the selected site from the request, if provided
        $selectedSite = $request->query('site', null);

        // Start the query with a left join to the users table
        $query = TrainingHistory::leftJoin('users', 'training_history.employee_name', '=', 'users.id')
            ->select([
                'training_history.id as training_id',
                'training_history.trr_id',
                'training_history.learning_session_title',
                'training_history.learning_session_completion_date',
                'training_history.assessment_date',
                'training_history.attachment_1',
                DB::raw('IF(CAST(training_history.employee_name AS UNSIGNED) > 0, users.first_name, training_history.employee_name) as employee_first_name'),
                DB::raw('IF(CAST(training_history.employee_name AS UNSIGNED) > 0, users.last_name, "") as employee_last_name'),
                'users.site as user_site' // Add the site column from the users table
            ]);

        // Apply the site filter if a site is selected
        if (!empty($selectedSite) && $selectedSite !== 'Applicable to All Sites') {
            $query->where('users.site', '=', $selectedSite);
        }

        return DataTables::of($query)
            ->editColumn('employee_first_name', function ($row) {
                return trim($row->employee_first_name . ' ' . $row->employee_last_name);
            })
            ->editColumn('learning_session_completion_date', function ($row) {
                return format_date($row->learning_session_completion_date); // Apply format_date to learning_session_completion_date
            })
            ->editColumn('assessment_date', function ($row) {
                return format_date($row->assessment_date); // Apply format_date to assessment_date
            })
            ->editColumn('attachment_1', function ($row) {
                if (!empty($row->attachment_1)) {
                    $attachment = preg_replace('/\s+\.pdf$/', '.pdf', $row->attachment_1);
                    return '<a target="_blank" href="/uploads/training_history/' . $attachment . '">' . $attachment . '</a>';
                }
                return '';
            })
            ->addColumn('actions', function ($row) {
                $actions = '';

                if (auth()->user()->can('read_training_history')) {
                    $actions .= '<a href="read_training_history/' . $row->training_id . '" class="dropdown-item">View</a>';
                }
                if (auth()->user()->can('edit_training_history')) {
                    $actions .= '<a href="edit_training_history/' . $row->training_id . '" class="dropdown-item">Edit</a>';
                }
                if (auth()->user()->can('delete_training_history')) {
                    $actions .= '<a href="delete_training_history/' . $row->training_id . '" class="dropdown-item" onclick="return confirm(\'Are you sure to delete the record?\')">Delete</a>';
                }

                return '<div class="dropdown">
                    <button class="btn btn-light btn-active-light-primary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        ' . $actions . '
                    </ul>
                </div>';
            })
            ->filterColumn('employee_first_name', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('users.first_name', 'like', "%$keyword%")
                        ->orWhere('users.last_name', 'like', "%$keyword%")
                        ->orWhere('training_history.employee_name', 'like', "%$keyword%");
                });
            })
            ->rawColumns(['attachment_1', 'actions'])
            ->make(true);
    }

    public function create()
    {
        $options = dynamicOptions();
        $trainingTypeArr = $options['training_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.training_history.create_training_history')
            ->with('trainingTypeArr', $trainingTypeArr)
            ->with('users', $users);

    }

    public function addTrainingType(Request $request)
    {
        $newTrainingType = $request->input('value');

        if (empty($newTrainingType)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('training_type', $newTrainingType);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }

    public function create_bulk()
    {
        $options = dynamicOptions();
        $trainingTypeArr = $options['training_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.training_history.create_bulk_training')
            ->with('trainingTypeArr', $trainingTypeArr)
            ->with('users', $users);
    }

    public function store_bulk(TrainingHistoryBulkRequest $request)
    {
        $employee_nameArr = $request->input('employee_name');

        $assessment_date = $request->assessment_date;
        $must_be_completed_by = $request->must_be_completed_by;
        $learning_session_title = $request->learning_session_title;
        $training_type = $request->training_type;
        $instructor = $request->instructor;
        $learning_time = $request->learning_time;
        $learning_session_completion_date = $request->learning_session_completion_date;
        $link_to_learning_module = $request->link_to_learning_module;
        $comments = $request->comments;

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $filename_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/training_history';

            // Upload file
            $file->move($location, $filename_1);
        } else {
            $filename_1 = '';
        }

        $get_all_trr_id = TrainingHistory::pluck('trr_id');

        if ($get_all_trr_id->isNotEmpty()) {
            // Extract the prefix dynamically from the first item in the collection
            $firstTRRid = $get_all_trr_id->first();
            $prefix = substr($firstTRRid, 0, strrpos($firstTRRid, '-') + 1); // Extracts the prefix

            // Remove the prefix dynamically from each item and convert to collection
            $cleanedItems = $get_all_trr_id->map(function ($item) use ($prefix) {
                return (int)str_replace($prefix, '', $item);
            });

            // Get the maximum value
            $maxValue = $cleanedItems->max();

        } else {
            $maxValue = 0;
        }

        foreach ($employee_nameArr as $emp_name) {
            // Increment the max value for each employee
            $maxValue++;
            $maxValueTRR = str_pad($maxValue, 4, '0', STR_PAD_LEFT);

            // Generate unique TRR ID for each record
            $trr_id = $prefix . $maxValueTRR;

            $employee_name = $emp_name;

            $training_history = TrainingHistory::create([
                'trr_id' => $trr_id,
                'employee_name' => $employee_name,
                'assessment_date' => $assessment_date,
                'must_be_completed_by' => $must_be_completed_by,
                'learning_session_title' => $learning_session_title,
                'training_type' => $training_type,
                'instructor' => $instructor,
                'learning_time' => $learning_time,
                'learning_session_completion_date' => $learning_session_completion_date,
                'link_to_learning_module' => $link_to_learning_module,
                'comments' => $comments,
                'attachment_1' => $filename_1,
            ]);
        }

        if ($training_history) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('training_history'));
    }

    public function getEmployeeDetails(Request $request)
    {
        $employee_id = $request->employee_id;

        $user = User::find($employee_id);

        $person_to_notify = $user->person_to_notify;
        $site = $user->site;
        $current_job_title = $user->current_job_title;
        $results_area_1 = $user->results_area_1;
        $results_area_2 = $user->results_area_2;
        $results_area_3 = $user->results_area_3;
        $results_area_4 = $user->results_area_4;
        $results_area_5 = $user->results_area_5;
        $results_area_6 = $user->results_area_6;
        $results_area_7 = $user->results_area_7;
        $results_area_8 = $user->results_area_8;
        $results_area_9 = $user->results_area_9;
        $results_area_10 = $user->results_area_10;
        $results_area_11 = $user->results_area_11;
        $results_area_12 = $user->results_area_12;
        $employee_status = $user->status;

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
            'current_job_title' => $current_job_title,
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
            'employee_status' => $employee_status,
        ];

        // Return the JSON response
        return response()->json($jsonData);
    }

    public function store(TrainingHistoryRequest $request)
    {
        $employee_name = $request->employee_name;
        $assessment_date = $request->assessment_date;
        $must_be_completed_by = $request->must_be_completed_by;
        $learning_session_title = $request->learning_session_title;
        $training_type = $request->training_type;
        $instructor = $request->instructor;
        $learning_time = $request->learning_time;
        $learning_session_completion_date = $request->learning_session_completion_date;
        $link_to_learning_module = $request->link_to_learning_module;
        $comments = $request->comments;
        $training_expiry_date = $request->training_expiry_date;

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $filename_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/training_history';

            // Upload file
            $file->move($location, $filename_1);
        } else {
            $filename_1 = '';
        }

        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $filename_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/training_history';

            // Upload file
            $file->move($location, $filename_2);
        } else {
            $filename_2 = '';
        }

        if ($request->file('attachment_3')) {
            $file = $request->file('attachment_3');
            $filename_3 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/training_history';

            // Upload file
            $file->move($location, $filename_3);
        } else {
            $filename_3 = '';
        }

        $get_all_trr_id = TrainingHistory::pluck('trr_id');

        if ($get_all_trr_id->isNotEmpty()) {
            // Extract the prefix dynamically from the first item in the collection
            $firstTRRid = $get_all_trr_id->first();
            $prefix = substr($firstTRRid, 0, strrpos($firstTRRid, '-') + 1); // Extracts the prefix

            // Remove the prefix dynamically from each item and convert to collection
            $cleanedItems = $get_all_trr_id->map(function ($item) use ($prefix) {
                return (int)str_replace($prefix, '', $item);
            });

            // Get the maximum value
            $maxValue = $cleanedItems->max();

            $maxValueTRR = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);

        } else {
            $maxValue = 0;

            $maxValueTRR = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);
        }

        $trr_id = "TRR-" . $maxValueTRR;

        $training_history = TrainingHistory::create([
            'trr_id' => $trr_id,
            'employee_name' => $employee_name,
            'assessment_date' => $assessment_date,
            'must_be_completed_by' => $must_be_completed_by,
            'learning_session_title' => $learning_session_title,
            'training_type' => $training_type,
            'instructor' => $instructor,
            'learning_time' => $learning_time,
            'learning_session_completion_date' => $learning_session_completion_date,
            'link_to_learning_module' => $link_to_learning_module,
            'comments' => $comments,
            'attachment_1' => $filename_1,
            'attachment_2' => $filename_2,
            'attachment_3' => $filename_3,
            'training_expiry_date' => $training_expiry_date,
        ]);

        if ($training_history) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('training_history'));
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $trainingTypeArr = $options['training_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $training_history = TrainingHistory::find($id);

        // Check if employee_name is numeric (ID) or a string (name)
        if (is_numeric($training_history->employee_name)) {
            $user = User::find($training_history->employee_name);

            if ($user) {
                $employee_first_name = $user->first_name;
                $employee_last_name = $user->last_name;
            } else {
                $employee_first_name = '';
                $employee_last_name = '';
            }
        } else {
            // Directly use employee_name if it's not an ID
            session()->flash('info', nl2br('This record was imported from a spreadsheet. No matching user was found in our database. To modify this data, please create or select a user, and then save the record again.'));
            $employee_first_name = $training_history->employee_name;
            $employee_last_name = '';
        }

        $person_to_notify = $user->person_to_notify ?? null;
        $site = $user->site ?? '';
        $current_job_title = $user->current_job_title ?? '';
        $results_area_1 = $user->results_area_1 ?? '';
        $results_area_2 = $user->results_area_2 ?? '';
        $results_area_3 = $user->results_area_3 ?? '';
        $results_area_4 = $user->results_area_4 ?? '';
        $results_area_5 = $user->results_area_5 ?? '';
        $results_area_6 = $user->results_area_6 ?? '';
        $results_area_7 = $user->results_area_7 ?? '';
        $results_area_8 = $user->results_area_8 ?? '';
        $results_area_9 = $user->results_area_9 ?? '';
        $results_area_10 = $user->results_area_10 ?? '';
        $results_area_11 = $user->results_area_11 ?? '';
        $results_area_12 = $user->results_area_12 ?? '';
        $employee_status = $user->status ?? '';

        $person_to_notify_details = $person_to_notify ? User::find($person_to_notify) : null;

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

        return view('modules.training_history.read_training_history')
            ->with('trainingTypeArr', $trainingTypeArr)
            ->with('users', $users)
            ->with('training_history', $training_history)
            ->with('employee_first_name', $employee_first_name)
            ->with('employee_last_name', $employee_last_name)
            ->with('site', $site)
            ->with('current_job_title', $current_job_title)
            ->with('results_area_1', $results_area_1)
            ->with('results_area_2', $results_area_2)
            ->with('results_area_3', $results_area_3)
            ->with('results_area_4', $results_area_4)
            ->with('results_area_5', $results_area_5)
            ->with('results_area_6', $results_area_6)
            ->with('results_area_7', $results_area_7)
            ->with('results_area_8', $results_area_8)
            ->with('results_area_9', $results_area_9)
            ->with('results_area_10', $results_area_10)
            ->with('results_area_11', $results_area_11)
            ->with('results_area_12', $results_area_12)
            ->with('ptn_first_name', $ptn_first_name)
            ->with('ptn_last_name', $ptn_last_name)
            ->with('employee_status', $employee_status);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $trainingTypeArr = $options['training_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $training_history = TrainingHistory::find($id);

        // Check if training history exists
        if (!$training_history) {
            session()->flash('error', 'Training history record not found.');
            return redirect()->back();
        }

        // Check if employee_name is numeric (ID) or a string (name)
        if (is_numeric($training_history->employee_name)) {
            $user = User::find($training_history->employee_name);

            if ($user) {
                $employee_first_name = $user->first_name;
                $employee_last_name = $user->last_name;
            } else {
                session()->flash('warning', 'Employee not found.');
                $employee_first_name = '';
                $employee_last_name = '';
            }
        } else {
            // Directly use employee_name if it's not an ID
            session()->flash('info', 'This record was imported from a spreadsheet. To edit the data, please create and select a user, then save the record again.');
            $employee_first_name = $training_history->employee_name;
            $employee_last_name = '';
        }

        $person_to_notify = $user->person_to_notify ?? null;
        $site = $user->site ?? '';
        $current_job_title = $user->current_job_title ?? '';
        $results_area_1 = $user->results_area_1 ?? '';
        $results_area_2 = $user->results_area_2 ?? '';
        $results_area_3 = $user->results_area_3 ?? '';
        $results_area_4 = $user->results_area_4 ?? '';
        $results_area_5 = $user->results_area_5 ?? '';
        $results_area_6 = $user->results_area_6 ?? '';
        $results_area_7 = $user->results_area_7 ?? '';
        $results_area_8 = $user->results_area_8 ?? '';
        $results_area_9 = $user->results_area_9 ?? '';
        $results_area_10 = $user->results_area_10 ?? '';
        $results_area_11 = $user->results_area_11 ?? '';
        $results_area_12 = $user->results_area_12 ?? '';
        $employee_status = $user->status ?? '';

        $person_to_notify_details = $person_to_notify ? User::find($person_to_notify) : null;

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
            $employee_status = "Inactive";
        }

        return view('modules.training_history.edit_training_history')
            ->with('trainingTypeArr', $trainingTypeArr)
            ->with('users', $users)
            ->with('training_history', $training_history)
            ->with('employee_first_name', $employee_first_name)
            ->with('employee_last_name', $employee_last_name)
            ->with('site', $site)
            ->with('current_job_title', $current_job_title)
            ->with('results_area_1', $results_area_1)
            ->with('results_area_2', $results_area_2)
            ->with('results_area_3', $results_area_3)
            ->with('results_area_4', $results_area_4)
            ->with('results_area_5', $results_area_5)
            ->with('results_area_6', $results_area_6)
            ->with('results_area_7', $results_area_7)
            ->with('results_area_8', $results_area_8)
            ->with('results_area_9', $results_area_9)
            ->with('results_area_10', $results_area_10)
            ->with('results_area_11', $results_area_11)
            ->with('results_area_12', $results_area_12)
            ->with('ptn_first_name', $ptn_first_name)
            ->with('ptn_last_name', $ptn_last_name)
            ->with('employee_status', $employee_status);
    }

    public function update(TrainingHistoryRequest $request)
    {
        $id = $request->id;
        $trr_id = $request->trr_id;
        $employee_name = $request->employee_name;
        $assessment_date = $request->assessment_date;
        $must_be_completed_by = $request->must_be_completed_by;
        $learning_session_title = $request->learning_session_title;
        $training_type = $request->training_type;
        $instructor = $request->instructor;
        $learning_time = $request->learning_time;
        $learning_session_completion_date = $request->learning_session_completion_date;
        $link_to_learning_module = $request->link_to_learning_module;
        $comments = $request->comments;
        $training_expiry_date = $request->training_expiry_date;

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $filename_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/training_history';

            // Upload file
            $file->move($location, $filename_1);
        } else {
            $filename_1 = $request->old_attachment_1;
        }

        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $filename_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/training_history';

            // Upload file
            $file->move($location, $filename_2);
        } else {
            $filename_2 = $request->old_attachment_2;
        }

        if ($request->file('attachment_3')) {
            $file = $request->file('attachment_3');
            $filename_3 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/training_history';

            // Upload file
            $file->move($location, $filename_3);
        } else {
            $filename_3 = $request->old_attachment_3;
        }

        $training_history = DB::table('training_history')
            ->where('id', $id)
            ->update([
                'trr_id' => $trr_id,
                'employee_name' => $employee_name,
                'assessment_date' => $assessment_date,
                'must_be_completed_by' => $must_be_completed_by,
                'learning_session_title' => $learning_session_title,
                'training_type' => $training_type,
                'instructor' => $instructor,
                'learning_time' => $learning_time,
                'learning_session_completion_date' => $learning_session_completion_date,
                'link_to_learning_module' => $link_to_learning_module,
                'comments' => $comments,
                'attachment_1' => $filename_1,
                'attachment_2' => $filename_2,
                'attachment_3' => $filename_3,
                'training_expiry_date' => $training_expiry_date,
            ]);

        if ($training_history) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('training_history'));
    }

    public function delete($id)
    {
        $training_history = TrainingHistory::find($id);
        $training_history_del = $training_history->delete();

        if ($training_history_del) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('training_history'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $trainingTypeArr = $options['training_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $training_history = TrainingHistory::find($id);

        // Check if employee_name is numeric (ID) or a string (name)
        if (is_numeric($training_history->employee_name)) {
            $user = User::find($training_history->employee_name);

            if ($user) {
                $employee_first_name = $user->first_name;
                $employee_last_name = $user->last_name;
            } else {
                $employee_first_name = '';
                $employee_last_name = '';
            }
        } else {
            // Directly use employee_name if it's not an ID
            $employee_first_name = $training_history->employee_name;
            $employee_last_name = '';
        }

        $person_to_notify = $user->person_to_notify ?? null;
        $site = $user->site ?? '';
        $current_job_title = $user->current_job_title ?? '';
        $results_area_1 = $user->results_area_1 ?? '';
        $results_area_2 = $user->results_area_2 ?? '';
        $results_area_3 = $user->results_area_3 ?? '';
        $results_area_4 = $user->results_area_4 ?? '';
        $results_area_5 = $user->results_area_5 ?? '';
        $results_area_6 = $user->results_area_6 ?? '';
        $results_area_7 = $user->results_area_7 ?? '';
        $results_area_8 = $user->results_area_8 ?? '';
        $results_area_9 = $user->results_area_9 ?? '';
        $results_area_10 = $user->results_area_10 ?? '';
        $results_area_11 = $user->results_area_11 ?? '';
        $results_area_12 = $user->results_area_12 ?? '';
        $employee_status = $user->status ?? '';

        $person_to_notify_details = $person_to_notify ? User::find($person_to_notify) : null;

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

        return view('modules.training_history.print_training_history')
            ->with('trainingTypeArr', $trainingTypeArr)
            ->with('users', $users)
            ->with('training_history', $training_history)
            ->with('site', $site)
            ->with('current_job_title', $current_job_title)
            ->with('results_area_1', $results_area_1)
            ->with('results_area_2', $results_area_2)
            ->with('results_area_3', $results_area_3)
            ->with('results_area_4', $results_area_4)
            ->with('results_area_5', $results_area_5)
            ->with('results_area_6', $results_area_6)
            ->with('results_area_7', $results_area_7)
            ->with('results_area_8', $results_area_8)
            ->with('results_area_9', $results_area_9)
            ->with('results_area_10', $results_area_10)
            ->with('results_area_11', $results_area_11)
            ->with('results_area_12', $results_area_12)
            ->with('employee_first_name', $employee_first_name)
            ->with('employee_last_name', $employee_last_name)
            ->with('ptn_first_name', $ptn_first_name)
            ->with('ptn_last_name', $ptn_last_name)
            ->with('employee_status', $employee_status);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $trainingTypeArr = $options['training_type'];

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $training_history = TrainingHistory::find($id);

        // Check if employee_name is numeric (ID) or a string (name)
        if (is_numeric($training_history->employee_name)) {
            $user = User::find($training_history->employee_name);

            if ($user) {
                $employee_first_name = $user->first_name;
                $employee_last_name = $user->last_name;
            } else {
                $employee_first_name = '';
                $employee_last_name = '';
            }
        } else {
            // Directly use employee_name if it's not an ID
            $employee_first_name = $training_history->employee_name;
            $employee_last_name = '';
        }

        $person_to_notify = $user->person_to_notify ?? null;
        $site = $user->site ?? '';
        $current_job_title = $user->current_job_title ?? '';
        $results_area_1 = $user->results_area_1 ?? '';
        $results_area_2 = $user->results_area_2 ?? '';
        $results_area_3 = $user->results_area_3 ?? '';
        $results_area_4 = $user->results_area_4 ?? '';
        $results_area_5 = $user->results_area_5 ?? '';
        $results_area_6 = $user->results_area_6 ?? '';
        $results_area_7 = $user->results_area_7 ?? '';
        $results_area_8 = $user->results_area_8 ?? '';
        $results_area_9 = $user->results_area_9 ?? '';
        $results_area_10 = $user->results_area_10 ?? '';
        $results_area_11 = $user->results_area_11 ?? '';
        $results_area_12 = $user->results_area_12 ?? '';
        $employee_status = $user->status ?? '';

        $person_to_notify_details = $person_to_notify ? User::find($person_to_notify) : null;

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

        return view('modules.training_history.mail_training_history')
            ->with('trainingTypeArr', $trainingTypeArr)
            ->with('users', $users)
            ->with('training_history', $training_history)
            ->with('site', $site)
            ->with('current_job_title', $current_job_title)
            ->with('results_area_1', $results_area_1)
            ->with('results_area_2', $results_area_2)
            ->with('results_area_3', $results_area_3)
            ->with('results_area_4', $results_area_4)
            ->with('results_area_5', $results_area_5)
            ->with('results_area_6', $results_area_6)
            ->with('results_area_7', $results_area_7)
            ->with('results_area_8', $results_area_8)
            ->with('results_area_9', $results_area_9)
            ->with('results_area_10', $results_area_10)
            ->with('results_area_11', $results_area_11)
            ->with('results_area_12', $results_area_12)
            ->with('employee_first_name', $employee_first_name)
            ->with('employee_last_name', $employee_last_name)
            ->with('ptn_first_name', $ptn_first_name)
            ->with('ptn_last_name', $ptn_last_name)
            ->with('employee_status', $employee_status);
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

        $training_history = TrainingHistory::find($id);

        // Check if employee_name is numeric (ID) or a string (name)
        if (is_numeric($training_history->employee_name)) {
            $user = User::find($training_history->employee_name);

            if ($user) {
                $employee_first_name = $user->first_name;
                $employee_last_name = $user->last_name;
            } else {
                $employee_first_name = '';
                $employee_last_name = '';
            }
        } else {
            // Directly use employee_name if it's not an ID
            $employee_first_name = $training_history->employee_name;
            $employee_last_name = '';
        }

        $person_to_notify = $user->person_to_notify ?? null;
        $site = $user->site ?? '';
        $current_job_title = $user->current_job_title ?? '';
        $results_area_1 = $user->results_area_1 ?? '';
        $results_area_2 = $user->results_area_2 ?? '';
        $results_area_3 = $user->results_area_3 ?? '';
        $results_area_4 = $user->results_area_4 ?? '';
        $results_area_5 = $user->results_area_5 ?? '';
        $results_area_6 = $user->results_area_6 ?? '';
        $results_area_7 = $user->results_area_7 ?? '';
        $results_area_8 = $user->results_area_8 ?? '';
        $results_area_9 = $user->results_area_9 ?? '';
        $results_area_10 = $user->results_area_10 ?? '';
        $results_area_11 = $user->results_area_11 ?? '';
        $results_area_12 = $user->results_area_12 ?? '';
        $employee_status = $user->status ?? '';

        $person_to_notify_details = $person_to_notify ? User::find($person_to_notify) : null;

        if ($person_to_notify_details == null) {
            $ptn_first_name = "";
            $ptn_last_name = "";
        } else {
            $ptn_first_name = $person_to_notify_details->first_name;
            $ptn_last_name = $person_to_notify_details->last_name;
        }

        $mailData = [
            'base_url' => $base_url,
            'personal_message' => $personal_message,
            'person_to_notify' => $person_to_notify,
            'site' => $site,
            'current_job_title' => $current_job_title,
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
            'employee_status' => $employee_status,
            'trr_id' => $training_history->trr_id,
            'employee_first_name' => $employee_first_name,
            'employee_last_name' => $employee_last_name,
            'ptn_first_name' => $ptn_first_name,
            'ptn_last_name' => $ptn_last_name,
            'assessment_date' => $training_history->assessment_date,
            'must_be_completed_by' => $training_history->must_be_completed_by,
            'learning_session_title' => $training_history->learning_session_title,
            'training_type' => $training_history->training_type,
            'instructor' => $training_history->instructor,
            'learning_time' => $training_history->learning_time,
            'learning_session_completion_date' => $training_history->learning_session_completion_date,
            'link_to_learning_module' => $training_history->link_to_learning_module,
            'comments' => $training_history->comments,
            'attachment_1' => $training_history->attachment_1,
            'attachment_2' => $training_history->attachment_2,
            'attachment_3' => $training_history->attachment_3,
            'training_expiry_date' => $training_history->training_expiry_date,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new TrainingHistoryMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('training_history'));
    }

}
