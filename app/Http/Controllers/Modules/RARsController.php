<?php

namespace App\Http\Controllers\Modules;

use App\Exports\RarsExport;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RARsRequest;
use App\Imports\RarsImport;
use App\Mail\RARsMail;
use App\Models\Modules\Rars;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class RARsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = Rars::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $rars = $query->get();

        return view('modules.rars.rars')
            ->with('rars', $rars)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $departmentArr = $options['department'];
        $risk_typeArr = $options['risk_type'];
        $risk_sourceArr = $options['risk_source'];
        $risk_categoryArr = $options['risk_category'];
        $risk_probabilityArr = $options['risk_probability'];
        $risk_impactArr = $options['risk_impact'];
        $risk_priorityArr = $options['risk_priority'];
        $management_systemArr = $options['management_system'];

        return view('modules.rars.create_rars')
            ->with('siteArr', $siteArr)
            ->with('departmentArr', $departmentArr)
            ->with('risk_typeArr', $risk_typeArr)
            ->with('risk_sourceArr', $risk_sourceArr)
            ->with('risk_categoryArr', $risk_categoryArr)
            ->with('risk_probabilityArr', $risk_probabilityArr)
            ->with('risk_impactArr', $risk_impactArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('risk_priorityArr', $risk_priorityArr);
    }

    public function addDepartment(Request $request)
    {
        $newDepartment = $request->input('value');

        if (empty($newDepartment)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('department', $newDepartment);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }

    public function addRiskType(Request $request)
    {
        $newRiskType = $request->input('value');

        if (empty($newRiskType)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('risk_type', $newRiskType);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }

    public function addRiskSource(Request $request)
    {
        $newRiskSource = $request->input('value');

        if (empty($newRiskSource)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('risk_source', $newRiskSource);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }

    public function addRiskCategory(Request $request)
    {
        $newRiskCategory = $request->input('value');

        if (empty($newRiskCategory)) {
            return response()->json(['success' => false, 'message' => 'Invalid input']);
        }

        $result = GlobalHelper::addOptionToArray('risk_category', $newRiskCategory);

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Report Type already exists']);
        }
    }

    public function store(RARsRequest $request)
    {
        $site = $request->site;
        $date_identified = $request->date_identified;
        $department = $request->department;
        $risk_type = $request->risk_type;
        $risk_title = $request->risk_title;
        $risk_description = $request->risk_description;
        $risk_source = $request->risk_source;
        $risk_category = $request->risk_category;
        $risk_probability = $request->risk_probability;
        $risk_impact = $request->risk_impact;
        $management_system = $request->management_system;
        $mitigation = $request->mitigation;
        $risk_priority = $request->risk_priority;
        $responsible_person = $request->responsible_person;
        $next_risk_review_date = $request->next_risk_review_date;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $cpar_num = $request->cpar_num;
        $status = $request->status;
        $comments = $request->comments;
        $closed_date = $request->closed_date;

        // Retrieve all dcr_num values from the database
        $get_all_rar_id = Rars::pluck('rar_id');

        // Check if there are any dcr_num values
        if ($get_all_rar_id->isNotEmpty()) {
            // Extract the prefix dynamically from the first item in the collection
            $firstRARid = $get_all_rar_id->first();
            $prefix = substr($firstRARid, 0, strrpos($firstRARid, '-') + 1); // Extracts the prefix

            // Remove the prefix dynamically from each item and convert to collection
            $cleanedItems = $get_all_rar_id->map(function ($item) use ($prefix) {
                return (int)str_replace($prefix, '', $item);
            });

            // Get the maximum value
            $maxValue = $cleanedItems->max();

            $maxValueRAR = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);

        } else {
            $maxValue = 0;

            $maxValueRAR = str_pad($maxValue + 1, 4, '0', STR_PAD_LEFT);
        }
        if ($site == "Applicable to All Sites") {

            $rar_id = "RAR-CPCP-" . $maxValueRAR;

        } else if ($site == "CPAE - Dubai") {

            $rar_id = "RAR-CPAE-" . $maxValueRAR;

        } else if ($site == "CPLA - Mandeville") {

            $rar_id = "RAR-CPLA-" . $maxValueRAR;

        } else if ($site == "CPTX - West Texas") {

            $rar_id = "RAR-CPTX-" . $maxValueRAR;

        } else if ($site == "CPUK - Aberdeen") {

            $rar_id = "RAR-CPUK-" . $maxValueRAR;
        }

        $rar = Rars::create([
            'rar_id' => $rar_id,
            'site' => $site,
            'date_identified' => $date_identified,
            'department' => $department,
            'risk_type' => $risk_type,
            'risk_title' => $risk_title,
            'risk_description' => $risk_description,
            'risk_source' => $risk_source,
            'risk_category' => $risk_category,
            'risk_probability' => $risk_probability,
            'risk_impact' => $risk_impact,
            'management_system' => $management_system,
            'mitigation' => $mitigation,
            'risk_priority' => $risk_priority,
            'responsible_person' => $responsible_person,
            'next_risk_review_date' => $next_risk_review_date,
            'effectiveness_evaluated' => $effectiveness_evaluated,
            'action_taken_effective' => $action_taken_effective,
            'what_action_was_taken' => $what_action_was_taken,
            'action_taken_by' => $action_taken_by,
            'cpar_num' => $cpar_num,
            'status' => $status,
            'comments' => $comments,
            'closed_date' => $closed_date,
        ]);

        if ($rar) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('rars'));
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $departmentArr = $options['department'];
        $risk_typeArr = $options['risk_type'];
        $risk_sourceArr = $options['risk_source'];
        $risk_categoryArr = $options['risk_category'];
        $risk_probabilityArr = $options['risk_probability'];
        $risk_impactArr = $options['risk_impact'];
        $risk_priorityArr = $options['risk_priority'];
        $management_systemArr = $options['management_system'];

        $rar = Rars::find($id);

        return view('modules.rars.read_rars')
            ->with('siteArr', $siteArr)
            ->with('departmentArr', $departmentArr)
            ->with('risk_typeArr', $risk_typeArr)
            ->with('risk_sourceArr', $risk_sourceArr)
            ->with('risk_categoryArr', $risk_categoryArr)
            ->with('risk_probabilityArr', $risk_probabilityArr)
            ->with('risk_impactArr', $risk_impactArr)
            ->with('risk_priorityArr', $risk_priorityArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('rar', $rar);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $departmentArr = $options['department'];
        $risk_typeArr = $options['risk_type'];
        $risk_sourceArr = $options['risk_source'];
        $risk_categoryArr = $options['risk_category'];
        $risk_probabilityArr = $options['risk_probability'];
        $risk_impactArr = $options['risk_impact'];
        $risk_priorityArr = $options['risk_priority'];
        $management_systemArr = $options['management_system'];

        $rar = Rars::find($id);

        return view('modules.rars.edit_rars')
            ->with('siteArr', $siteArr)
            ->with('departmentArr', $departmentArr)
            ->with('risk_typeArr', $risk_typeArr)
            ->with('risk_sourceArr', $risk_sourceArr)
            ->with('risk_categoryArr', $risk_categoryArr)
            ->with('risk_probabilityArr', $risk_probabilityArr)
            ->with('risk_impactArr', $risk_impactArr)
            ->with('risk_priorityArr', $risk_priorityArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('rar', $rar);
    }

    public function update(RARsRequest $request)
    {
        $id = $request->id;
        $site = $request->site;
        $date_identified = $request->date_identified;
        $department = $request->department;
        $risk_type = $request->risk_type;
        $risk_title = $request->risk_title;
        $risk_description = $request->risk_description;
        $risk_source = $request->risk_source;
        $risk_category = $request->risk_category;
        $risk_probability = $request->risk_probability;
        $risk_impact = $request->risk_impact;
        $management_system = $request->management_system;
        $mitigation = $request->mitigation;
        $risk_priority = $request->risk_priority;
        $responsible_person = $request->responsible_person;
        $next_risk_review_date = $request->next_risk_review_date;
        $effectiveness_evaluated = $request->effectiveness_evaluated;
        $action_taken_effective = $request->action_taken_effective;
        $what_action_was_taken = $request->what_action_was_taken;
        $action_taken_by = $request->action_taken_by;
        $cpar_num = $request->cpar_num;
        $status = $request->status;
        $comments = $request->comments;
        $closed_date = $request->closed_date;

        $rar = DB::table('rars')
            ->where('id', $id)
            ->update([
                'site' => $site,
                'date_identified' => $date_identified,
                'department' => $department,
                'risk_type' => $risk_type,
                'risk_title' => $risk_title,
                'risk_description' => $risk_description,
                'risk_source' => $risk_source,
                'risk_category' => $risk_category,
                'risk_probability' => $risk_probability,
                'risk_impact' => $risk_impact,
                'management_system' => $management_system,
                'mitigation' => $mitigation,
                'risk_priority' => $risk_priority,
                'responsible_person' => $responsible_person,
                'next_risk_review_date' => $next_risk_review_date,
                'effectiveness_evaluated' => $effectiveness_evaluated,
                'action_taken_effective' => $action_taken_effective,
                'what_action_was_taken' => $what_action_was_taken,
                'action_taken_by' => $action_taken_by,
                'cpar_num' => $cpar_num,
                'status' => $status,
                'comments' => $comments,
                'closed_date' => $closed_date,
            ]);

        if ($rar) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('rars'));
    }

    public function delete($id)
    {
        $rar = Rars::find($id);
        $rarDel = $rar->delete();

        if ($rarDel) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('rars'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new RarsExport(), 'rars.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new RarsImport(), $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('rars'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('rars'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('rars'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $departmentArr = $options['department'];
        $risk_typeArr = $options['risk_type'];
        $risk_sourceArr = $options['risk_source'];
        $risk_categoryArr = $options['risk_category'];
        $risk_probabilityArr = $options['risk_probability'];
        $risk_impactArr = $options['risk_impact'];
        $risk_priorityArr = $options['risk_priority'];
        $management_systemArr = $options['management_system'];

        $rar = Rars::find($id);

        return view('modules.rars.print_rars')
            ->with('siteArr', $siteArr)
            ->with('departmentArr', $departmentArr)
            ->with('risk_typeArr', $risk_typeArr)
            ->with('risk_sourceArr', $risk_sourceArr)
            ->with('risk_categoryArr', $risk_categoryArr)
            ->with('risk_probabilityArr', $risk_probabilityArr)
            ->with('risk_impactArr', $risk_impactArr)
            ->with('risk_priorityArr', $risk_priorityArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('rar', $rar);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $departmentArr = $options['department'];
        $risk_typeArr = $options['risk_type'];
        $risk_sourceArr = $options['risk_source'];
        $risk_categoryArr = $options['risk_category'];
        $risk_probabilityArr = $options['risk_probability'];
        $risk_impactArr = $options['risk_impact'];
        $risk_priorityArr = $options['risk_priority'];
        $management_systemArr = $options['management_system'];

        $rar = Rars::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.rars.mail_rars')
            ->with('siteArr', $siteArr)
            ->with('departmentArr', $departmentArr)
            ->with('risk_typeArr', $risk_typeArr)
            ->with('risk_sourceArr', $risk_sourceArr)
            ->with('risk_categoryArr', $risk_categoryArr)
            ->with('risk_probabilityArr', $risk_probabilityArr)
            ->with('risk_impactArr', $risk_impactArr)
            ->with('risk_priorityArr', $risk_priorityArr)
            ->with('management_systemArr', $management_systemArr)
            ->with('rar', $rar)
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
        $base_url = $site_urlArr['base_url'];
        $rar = Rars::find($id);

        $personal_message = $request->personal_message;

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'rar_id' => $rar->rar_id,
            'site' => $rar->site,
            'date_identified' => $rar->date_identified,
            'department' => $rar->department,
            'risk_type' => $rar->risk_type,
            'risk_title' => $rar->risk_title,
            'risk_description' => $rar->risk_description,
            'risk_source' => $rar->risk_source,
            'risk_category' => $rar->risk_category,
            'risk_probability' => $rar->risk_probability,
            'risk_impact' => $rar->risk_impact,
            'management_system' => $rar->management_system,
            'mitigation' => $rar->mitigation,
            'risk_priority' => $rar->risk_priority,
            'responsible_person' => $rar->responsible_person,
            'next_risk_review_date' => $rar->next_risk_review_date,
            'effectiveness_evaluated' => $rar->effectiveness_evaluated,
            'action_taken_effective' => $rar->action_taken_effective,
            'what_action_was_taken' => $rar->what_action_was_taken,
            'action_taken_by' => $rar->action_taken_by,
            'cpar_num' => $rar->cpar_num,
            'status' => $rar->status,
            'comments' => $rar->comments,
            'closed_date' => $rar->closed_date,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new RARsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('rars'));
    }
}
