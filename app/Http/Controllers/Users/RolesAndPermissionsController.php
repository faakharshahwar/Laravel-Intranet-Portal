<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsController extends Controller
{
    public function index()
    {

        $role_permissions = Role::with('permissions')->get();

        $RoleToRemove = "Super Admin";
        $rolesPermissions = $role_permissions->reject(function ($role) use ($RoleToRemove) {
            return $role->name === $RoleToRemove;
        });

        return view('users.role_list')->with('role_permissions', $rolesPermissions);
    }

    public function create(Request $request)
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role_name = $request->role_name;

        $role = Role::create(['name' => $role_name]);

        //User Permissions Check
        $user_management_read = $request->read_user;
        $user_management_edit = $request->edit_user;
        $user_management_create = $request->create_user;
        $user_management_delete = $request->delete_user;

        //Calibrated Devices Permissions Check
        $calibrated_devices_read = $request->read_calibrated_devices;
        $calibrated_devices_edit = $request->edit_calibrated_devices;
        $calibrated_devices_create = $request->create_calibrated_devices;
        $calibrated_devices_delete = $request->delete_calibrated_devices;

        //Customer Feedback Permissions Check
        $customer_feedback_record_read = $request->read_customer_feedback_records;
        $customer_feedback_record_edit = $request->edit_customer_feedback_records;
        $customer_feedback_record_create = $request->create_customer_feedback_records;
        $customer_feedback_record_delete = $request->delete_customer_feedback_records;

        //Continual Improvement Records Permissions Check
        $continual_improvement_records_read = $request->read_continual_improvement_records;
        $continual_improvement_records_edit = $request->edit_continual_improvement_records;
        $continual_improvement_records_create = $request->create_continual_improvement_records;
        $continual_improvement_records_delete = $request->delete_continual_improvement_records;

        //CPARS
        $cpars_read = $request->read_cpars;
        $cpars_edit = $request->edit_cpars;
        $cpars_create = $request->create_cpars;
        $cpars_delete = $request->delete_cpars;

        //Customer Satisfaction Records Permissions Check
        $customer_satisfaction_records_read = $request->read_customer_satisfaction_records;
        $customer_satisfaction_records_edit = $request->edit_customer_satisfaction_records;
        $customer_satisfaction_records_create = $request->create_customer_satisfaction_records;
        $customer_satisfaction_records_delete = $request->delete_customer_satisfaction_records;

        //NCRS
        $ncrs_read = $request->read_ncrs;
        $ncrs_edit = $request->edit_ncrs;
        $ncrs_create = $request->create_ncrs;
        $ncrs_delete = $request->delete_ncrs;

        //SNRS
        $snrs_read = $request->read_snrs;
        $snrs_edit = $request->edit_snrs;
        $snrs_create = $request->create_snrs;
        $snrs_delete = $request->delete_snrs;

        //RARS
        $rars_read = $request->read_rars;
        $rars_edit = $request->edit_rars;
        $rars_create = $request->create_rars;
        $rars_delete = $request->delete_rars;

        //Training History
        $training_history_read = $request->read_training_history;
        $training_history_edit = $request->edit_training_history;
        $training_history_create = $request->create_training_history;
        $training_history_delete = $request->delete_training_history;

        //Audit Schedule
        $audit_schedule_read = $request->read_audit_schedule;
        $audit_schedule_edit = $request->edit_audit_schedule;
        $audit_schedule_create = $request->create_audit_schedule;
        $audit_schedule_delete = $request->delete_audit_schedule;

        //Management Reviews
        $management_reviews_read = $request->read_management_reviews;
        $management_reviews_edit = $request->edit_management_reviews;
        $management_reviews_create = $request->create_management_reviews;
        $management_reviews_delete = $request->delete_management_reviews;

        //Maintenance List
        $maintenance_list_read = $request->read_maintenance_list;
        $maintenance_list_edit = $request->edit_maintenance_list;
        $maintenance_list_create = $request->create_maintenance_list;
        $maintenance_list_delete = $request->delete_maintenance_list;

        //Documents
        $documents_read = $request->read_documents;
        $documents_edit = $request->edit_documents;
        $documents_create = $request->create_documents;
        $documents_delete = $request->delete_documents;

        //Dcrs
        $dcrs_read = $request->read_dcrs;
        $dcrs_edit = $request->edit_dcrs;
        $dcrs_create = $request->create_dcrs;
        $dcrs_delete = $request->delete_dcrs;

        //External Document
        $external_document_read = $request->read_external_document;
        $external_document_edit = $request->edit_external_document;
        $external_document_create = $request->create_external_document;
        $external_document_delete = $request->delete_external_document;

        //Record Summary
        $record_summary_read = $request->read_record_summary;
        $record_summary_edit = $request->edit_record_summary;
        $record_summary_create = $request->create_record_summary;
        $record_summary_delete = $request->delete_record_summary;

        //HSE
        $hse_read = $request->read_hse;
        $hse_edit = $request->edit_hse;
        $hse_create = $request->create_hse;
        $hse_delete = $request->delete_hse;

        //MOCR
        $mocr_read = $request->read_mocr;
        $mocr_edit = $request->edit_mocr;
        $mocr_create = $request->create_mocr;
        $mocr_delete = $request->delete_mocr;

        //EDR
        $edr_read = $request->read_edr;
        $edr_edit = $request->edit_edr;
        $edr_create = $request->create_edr;
        $edr_delete = $request->delete_edr;

        //Qualified Auditors List
        $qualified_auditors_list_read = $request->read_qualified_auditors_list;
        $qualified_auditors_list_edit = $request->edit_qualified_auditors_list;
        $qualified_auditors_list_create = $request->create_qualified_auditors_list;
        $qualified_auditors_list_delete = $request->delete_qualified_auditors_list;

        //First Aid
        $first_aid_read = $request->read_first_aid;
        $first_aid_edit = $request->edit_first_aid;
        $first_aid_create = $request->create_first_aid;
        $first_aid_delete = $request->delete_first_aid;

        //Inspection Report
        $inspection_report_read = $request->read_inspection_report;
        $inspection_report_edit = $request->edit_inspection_report;
        $inspection_report_create = $request->create_inspection_report;
        $inspection_report_delete = $request->delete_inspection_report;

        //EFR
        $efr_read = $request->read_efr;
        $efr_edit = $request->edit_efr;
        $efr_create = $request->create_efr;
        $efr_delete = $request->delete_efr;

        //Permits
        $permits_read = $request->read_permits;
        $permits_edit = $request->edit_permits;
        $permits_create = $request->create_permits;
        $permits_delete = $request->delete_permits;

        //Assign User Permissions
        if ($user_management_read == 'read_user') {
            $role->givePermissionTo('read_user');
        }
        if ($user_management_edit == 'edit_user') {
            $role->givePermissionTo('edit_user');
        }
        if ($user_management_create == 'create_user') {
            $role->givePermissionTo('create_user');
        }
        if ($user_management_delete == 'delete_user') {
            $role->givePermissionTo('delete_user');
        }

        //Assign Calibrated Devices
        if ($calibrated_devices_read == 'read_calibrated_devices') {
            $role->givePermissionTo('read_calibrated_devices');
        }
        if ($calibrated_devices_edit == 'edit_calibrated_devices') {
            $role->givePermissionTo('edit_calibrated_devices');
        }
        if ($calibrated_devices_create == 'create_calibrated_devices') {
            $role->givePermissionTo('create_calibrated_devices');
        }
        if ($calibrated_devices_delete == 'delete_calibrated_devices') {
            $role->givePermissionTo('delete_calibrated_devices');
        }

        //Assign Customer Feedback Records
        if ($customer_feedback_record_read == 'read_customer_feedback_records') {
            $role->givePermissionTo('read_customer_feedback_records');
        }
        if ($customer_feedback_record_edit == 'edit_customer_feedback_records') {
            $role->givePermissionTo('edit_customer_feedback_records');
        }
        if ($customer_feedback_record_create == 'create_customer_feedback_records') {
            $role->givePermissionTo('create_customer_feedback_records');
        }
        if ($customer_feedback_record_delete == 'delete_customer_feedback_records') {
            $role->givePermissionTo('delete_customer_feedback_records');
        }

        //Assign Continual Improvement Records
        if ($continual_improvement_records_read == 'read_continual_improvement_records') {
            $role->givePermissionTo('read_continual_improvement_records');
        }
        if ($continual_improvement_records_edit == 'edit_continual_improvement_records') {
            $role->givePermissionTo('edit_continual_improvement_records');
        }
        if ($continual_improvement_records_create == 'create_continual_improvement_records') {
            $role->givePermissionTo('create_continual_improvement_records');
        }
        if ($continual_improvement_records_delete == 'delete_continual_improvement_records') {
            $role->givePermissionTo('delete_continual_improvement_records');
        }

        //Assign CPARS
        if ($cpars_read == 'read_cpars') {
            $role->givePermissionTo('read_cpars');
        }
        if ($cpars_edit == 'edit_cpars') {
            $role->givePermissionTo('edit_cpars');
        }
        if ($cpars_create == 'create_cpars') {
            $role->givePermissionTo('create_cpars');
        }
        if ($cpars_delete == 'delete_cpars') {
            $role->givePermissionTo('delete_cpars');
        }

        //Assign Customer Satisfaction Records
        if ($customer_satisfaction_records_read == 'read_customer_satisfaction_records') {
            $role->givePermissionTo('read_customer_satisfaction_records');
        }
        if ($customer_satisfaction_records_edit == 'edit_customer_satisfaction_records') {
            $role->givePermissionTo('edit_customer_satisfaction_records');
        }
        if ($customer_satisfaction_records_create == 'create_customer_satisfaction_records') {
            $role->givePermissionTo('create_customer_satisfaction_records');
        }
        if ($customer_satisfaction_records_delete == 'delete_customer_satisfaction_records') {
            $role->givePermissionTo('delete_customer_satisfaction_records');
        }

        //Assign NCRS
        if ($ncrs_read == 'read_ncrs') {
            $role->givePermissionTo('read_ncrs');
        }
        if ($ncrs_edit == 'edit_ncrs') {
            $role->givePermissionTo('edit_ncrs');
        }
        if ($ncrs_create == 'create_ncrs') {
            $role->givePermissionTo('create_ncrs');
        }
        if ($ncrs_delete == 'delete_ncrs') {
            $role->givePermissionTo('delete_ncrs');
        }

        //Assign SNRS
        if ($snrs_read == 'read_snrs') {
            $role->givePermissionTo('read_snrs');
        }
        if ($snrs_edit == 'edit_snrs') {
            $role->givePermissionTo('edit_snrs');
        }
        if ($snrs_create == 'create_snrs') {
            $role->givePermissionTo('create_snrs');
        }
        if ($snrs_delete == 'delete_ncrs') {
            $role->givePermissionTo('delete_snrs');
        }

        //Assign RARS
        if ($rars_read == 'read_rars') {
            $role->givePermissionTo('read_rars');
        }
        if ($rars_edit == 'edit_rars') {
            $role->givePermissionTo('edit_rars');
        }
        if ($rars_create == 'create_rars') {
            $role->givePermissionTo('create_rars');
        }
        if ($rars_delete == 'delete_rars') {
            $role->givePermissionTo('delete_rars');
        }

        //Assign Training History
        if ($training_history_read == 'read_training_history') {
            $role->givePermissionTo('read_training_history');
        }
        if ($training_history_edit == 'edit_training_history') {
            $role->givePermissionTo('edit_training_history');
        }
        if ($training_history_create == 'create_training_history') {
            $role->givePermissionTo('create_training_history');
        }
        if ($training_history_delete == 'delete_training_history') {
            $role->givePermissionTo('delete_training_history');
        }

        //Assign Audit Schedule
        if ($audit_schedule_read == 'read_audit_schedule') {
            $role->givePermissionTo('read_audit_schedule');
        }
        if ($audit_schedule_edit == 'edit_audit_schedule') {
            $role->givePermissionTo('edit_audit_schedule');
        }
        if ($audit_schedule_create == 'create_audit_schedule') {
            $role->givePermissionTo('create_audit_schedule');
        }
        if ($audit_schedule_delete == 'delete_audit_schedule') {
            $role->givePermissionTo('delete_audit_schedule');
        }

        //Assign Management Reviews
        if ($management_reviews_read == 'read_management_reviews') {
            $role->givePermissionTo('read_management_reviews');
        }
        if ($management_reviews_edit == 'edit_management_reviews') {
            $role->givePermissionTo('edit_management_reviews');
        }
        if ($management_reviews_create == 'create_management_reviews') {
            $role->givePermissionTo('create_management_reviews');
        }
        if ($management_reviews_delete == 'delete_management_reviews') {
            $role->givePermissionTo('delete_management_reviews');
        }

        //Assign Maintenance List
        if ($maintenance_list_read == 'read_maintenance_list') {
            $role->givePermissionTo('read_maintenance_list');
        }
        if ($maintenance_list_edit == 'edit_maintenance_list') {
            $role->givePermissionTo('edit_maintenance_list');
        }
        if ($maintenance_list_create == 'create_maintenance_list') {
            $role->givePermissionTo('create_maintenance_list');
        }
        if ($maintenance_list_delete == 'delete_maintenance_list') {
            $role->givePermissionTo('delete_maintenance_list');
        }

        //Assign Documents
        if ($documents_read == 'read_documents') {
            $role->givePermissionTo('read_documents');
        }
        if ($documents_edit == 'edit_documents') {
            $role->givePermissionTo('edit_documents');
        }
        if ($documents_create == 'create_documents') {
            $role->givePermissionTo('create_documents');
        }
        if ($documents_delete == 'delete_documents') {
            $role->givePermissionTo('delete_documents');
        }

        //Dcrs
        if ($dcrs_read == 'read_dcrs') {
            $role->givePermissionTo('read_dcrs');
        }
        if ($dcrs_edit == 'edit_dcrs') {
            $role->givePermissionTo('edit_dcrs');
        }
        if ($dcrs_create == 'create_dcrs') {
            $role->givePermissionTo('create_dcrs');
        }
        if ($dcrs_delete == 'delete_dcrs') {
            $role->givePermissionTo('delete_dcrs');
        }

        //External Document
        if ($external_document_read == 'read_external_document') {
            $role->givePermissionTo('read_external_document');
        }
        if ($external_document_edit == 'edit_external_document') {
            $role->givePermissionTo('edit_external_document');
        }
        if ($external_document_create == 'create_external_document') {
            $role->givePermissionTo('create_external_document');
        }
        if ($external_document_delete == 'delete_external_document') {
            $role->givePermissionTo('delete_external_document');
        }

        //Record Summary
        if ($record_summary_read == 'read_record_summary') {
            $role->givePermissionTo('read_record_summary');
        }
        if ($record_summary_edit == 'edit_record_summary') {
            $role->givePermissionTo('edit_record_summary');
        }
        if ($record_summary_create == 'create_record_summary') {
            $role->givePermissionTo('create_record_summary');
        }
        if ($record_summary_delete == 'delete_record_summary') {
            $role->givePermissionTo('delete_record_summary');
        }

        //HSE
        if ($hse_read == 'read_hse') {
            $role->givePermissionTo('read_hse');
        }
        if ($hse_edit == 'edit_hse') {
            $role->givePermissionTo('edit_hse');
        }
        if ($hse_create == 'create_hse') {
            $role->givePermissionTo('create_hse');
        }
        if ($hse_delete == 'delete_hse') {
            $role->givePermissionTo('delete_hse');
        }

        //MOCR
        if ($mocr_read == 'read_mocr') {
            $role->givePermissionTo('read_mocr');
        }
        if ($mocr_edit == 'edit_mocr') {
            $role->givePermissionTo('edit_mocr');
        }
        if ($mocr_create == 'create_mocr') {
            $role->givePermissionTo('create_mocr');
        }
        if ($mocr_delete == 'delete_mocr') {
            $role->givePermissionTo('delete_mocr');
        }

        //EDR
        if ($edr_read == 'read_edr') {
            $role->givePermissionTo('read_edr');
        }
        if ($edr_edit == 'edit_edr') {
            $role->givePermissionTo('edit_edr');
        }
        if ($edr_create == 'create_edr') {
            $role->givePermissionTo('create_edr');
        }
        if ($edr_delete == 'delete_edr') {
            $role->givePermissionTo('delete_edr');
        }

        //Qualified Auditors List
        if ($qualified_auditors_list_read == 'read_qualified_auditors_list') {
            $role->givePermissionTo('read_qualified_auditors_list');
        }
        if ($qualified_auditors_list_edit == 'edit_qualified_auditors_list') {
            $role->givePermissionTo('edit_qualified_auditors_list');
        }
        if ($qualified_auditors_list_create == 'create_qualified_auditors_list') {
            $role->givePermissionTo('create_qualified_auditors_list');
        }
        if ($qualified_auditors_list_delete == 'delete_qualified_auditors_list') {
            $role->givePermissionTo('delete_qualified_auditors_list');
        }

        //First Aid
        if ($first_aid_read == 'read_first_aid') {
            $role->givePermissionTo('read_first_aid');
        }
        if ($first_aid_edit == 'edit_first_aid') {
            $role->givePermissionTo('edit_first_aid');
        }
        if ($first_aid_create == 'create_first_aid') {
            $role->givePermissionTo('create_first_aid');
        }
        if ($first_aid_delete == 'delete_first_aid') {
            $role->givePermissionTo('delete_first_aid');
        }

        //Inspection Report
        if ($inspection_report_read == 'read_inspection_report') {
            $role->givePermissionTo('read_inspection_report');
        }
        if ($inspection_report_edit == 'edit_inspection_report') {
            $role->givePermissionTo('edit_inspection_report');
        }
        if ($inspection_report_create == 'create_inspection_report') {
            $role->givePermissionTo('create_inspection_report');
        }
        if ($inspection_report_delete == 'delete_inspection_report') {
            $role->givePermissionTo('delete_inspection_report');
        }

        //EFR
        if ($efr_read == 'read_efr') {
            $role->givePermissionTo('read_efr');
        }
        if ($efr_edit == 'edit_efr') {
            $role->givePermissionTo('edit_efr');
        }
        if ($efr_create == 'create_efr') {
            $role->givePermissionTo('create_efr');
        }
        if ($efr_delete == 'delete_efr') {
            $role->givePermissionTo('delete_efr');
        }

        //Permits
        if ($permits_read == 'read_permits') {
            $role->givePermissionTo('read_permits');
        }
        if ($permits_edit == 'edit_permits') {
            $role->givePermissionTo('edit_permits');
        }
        if ($permits_create == 'create_permits') {
            $role->givePermissionTo('create_permits');
        }
        if ($permits_delete == 'delete_permits') {
            $role->givePermissionTo('delete_permits');
        }

        session()->flash('success', 'Role has been added successfully');

        return redirect(route('role_list'));
    }

    //Ajax Call
    public function edit(Request $request)
    {
        $roleId = $request->id;
        $row = DB::table('roles')->where('id', $roleId)->first();
        $roleWithPermission = Role::where('id', $roleId)->with('permissions')->get();
        $dataArr = [];
        $permissionsArr = [];
        foreach ($roleWithPermission as $r) {
            $role = $row->name;
            foreach ($r->permissions as $p) {
                $permissionsArr[] = $p->name;
            }
            $dataArr = [
                'role' => $role,
                'permissions' => $permissionsArr,
            ];
        }
        $output = $dataArr;
        return $output;
    }

    public function update(Request $request)
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role_id = $request->role_id;
        $role_name = $request->role_name;

        $update_role_name = Role::where('id', $role_id)->update(array('name' => $role_name));

        //Get Role Attributes
        $roleElq = Role::where('id', $role_id)->get();
        foreach ($roleElq as $r) {
            $role = $r;
        }

        //User Permissions Check
        $user_management_read = $request->read_user;
        $user_management_edit = $request->edit_user;
        $user_management_create = $request->create_user;
        $user_management_delete = $request->delete_user;

        //Calibrated Devices Permissions Check
        $calibrated_devices_read = $request->read_calibrated_devices;
        $calibrated_devices_edit = $request->edit_calibrated_devices;
        $calibrated_devices_create = $request->create_calibrated_devices;
        $calibrated_devices_delete = $request->delete_calibrated_devices;

        //Customer Feedback Permissions Check
        $customer_feedback_record_read = $request->read_customer_feedback_records;
        $customer_feedback_record_edit = $request->edit_customer_feedback_records;
        $customer_feedback_record_create = $request->create_customer_feedback_records;
        $customer_feedback_record_delete = $request->delete_customer_feedback_records;

        //Continual Improvement Records Permissions Check
        $continual_improvement_records_read = $request->read_continual_improvement_records;
        $continual_improvement_records_edit = $request->edit_continual_improvement_records;
        $continual_improvement_records_create = $request->create_continual_improvement_records;
        $continual_improvement_records_delete = $request->delete_continual_improvement_records;

        //CPARS
        $cpars_read = $request->read_cpars;
        $cpars_edit = $request->edit_cpars;
        $cpars_create = $request->create_cpars;
        $cpars_delete = $request->delete_cpars;

        //Customer Satisfaction Records Permissions Check
        $customer_satisfaction_records_read = $request->read_customer_satisfaction_records;
        $customer_satisfaction_records_edit = $request->edit_customer_satisfaction_records;
        $customer_satisfaction_records_create = $request->create_customer_satisfaction_records;
        $customer_satisfaction_records_delete = $request->delete_customer_satisfaction_records;

        //NCRS
        $ncrs_read = $request->read_ncrs;
        $ncrs_edit = $request->edit_ncrs;
        $ncrs_create = $request->create_ncrs;
        $ncrs_delete = $request->delete_ncrs;

        //NCRS
        $snrs_read = $request->read_snrs;
        $snrs_edit = $request->edit_snrs;
        $snrs_create = $request->create_snrs;
        $snrs_delete = $request->delete_snrs;

        //RARS
        $rars_read = $request->read_rars;
        $rars_edit = $request->edit_rars;
        $rars_create = $request->create_rars;
        $rars_delete = $request->delete_rars;

        //Training History
        $training_history_read = $request->read_training_history;
        $training_history_edit = $request->edit_training_history;
        $training_history_create = $request->create_training_history;
        $training_history_delete = $request->delete_training_history;

        //Audit Schedule
        $audit_schedule_read = $request->read_audit_schedule;
        $audit_schedule_edit = $request->edit_audit_schedule;
        $audit_schedule_create = $request->create_audit_schedule;
        $audit_schedule_delete = $request->delete_audit_schedule;

        //Management Reviews
        $management_reviews_read = $request->read_management_reviews;
        $management_reviews_edit = $request->edit_management_reviews;
        $management_reviews_create = $request->create_management_reviews;
        $management_reviews_delete = $request->delete_management_reviews;

        //Maintenance List
        $maintenance_list_read = $request->read_maintenance_list;
        $maintenance_list_edit = $request->edit_maintenance_list;
        $maintenance_list_create = $request->create_maintenance_list;
        $maintenance_list_delete = $request->delete_maintenance_list;

        //Documents
        $documents_read = $request->read_documents;
        $documents_edit = $request->edit_documents;
        $documents_create = $request->create_documents;
        $documents_delete = $request->delete_documents;

        //DCR
        $dcrs_read = $request->read_dcrs;
        $dcrs_edit = $request->edit_dcrs;
        $dcrs_create = $request->create_dcrs;
        $dcrs_delete = $request->delete_dcrs;

        //External Document
        $external_document_read = $request->read_external_document;
        $external_document_edit = $request->edit_external_document;
        $external_document_create = $request->create_external_document;
        $external_document_delete = $request->delete_external_document;

        //Record Summary
        $record_summary_read = $request->read_record_summary;
        $record_summary_edit = $request->edit_record_summary;
        $record_summary_create = $request->create_record_summary;
        $record_summary_delete = $request->delete_record_summary;


        //HSE
        $hse_read = $request->read_hse;
        $hse_edit = $request->edit_hse;
        $hse_create = $request->create_hse;
        $hse_delete = $request->delete_hse;

        //MOCR
        $mocr_read = $request->read_mocr;
        $mocr_edit = $request->edit_mocr;
        $mocr_create = $request->create_mocr;
        $mocr_delete = $request->delete_mocr;

        //EDR
        $edr_read = $request->read_edr;
        $edr_edit = $request->edit_edr;
        $edr_create = $request->create_edr;
        $edr_delete = $request->delete_edr;

        //Qualified Auditors List
        $qualified_auditors_list_read = $request->read_qualified_auditors_list;
        $qualified_auditors_list_edit = $request->edit_qualified_auditors_list;
        $qualified_auditors_list_create = $request->create_qualified_auditors_list;
        $qualified_auditors_list_delete = $request->delete_qualified_auditors_list;

        //First Aid
        $first_aid_read = $request->read_first_aid;
        $first_aid_edit = $request->edit_first_aid;
        $first_aid_create = $request->create_first_aid;
        $first_aid_delete = $request->delete_first_aid;

        //Inspection Report
        $inspection_report_read = $request->read_inspection_report;
        $inspection_report_edit = $request->edit_inspection_report;
        $inspection_report_create = $request->create_inspection_report;
        $inspection_report_delete = $request->delete_inspection_report;

        //EFR
        $efr_read = $request->read_efr;
        $efr_edit = $request->edit_efr;
        $efr_create = $request->create_efr;
        $efr_delete = $request->delete_efr;

        //Permits
        $permits_read = $request->read_permits;
        $permits_edit = $request->edit_permits;
        $permits_create = $request->create_permits;
        $permits_delete = $request->delete_permits;

        //Assign User Permissions
        if ($user_management_read == 'read_user') {
            $role->givePermissionTo('read_user');
        } else {
            $role->revokePermissionTo('read_user');
        }
        if ($user_management_edit == 'edit_user') {
            $role->givePermissionTo('edit_user');
        } else {
            $role->revokePermissionTo('edit_user');
        }
        if ($user_management_create == 'create_user') {
            $role->givePermissionTo('create_user');
        } else {
            $role->revokePermissionTo('create_user');
        }
        if ($user_management_delete == 'delete_user') {
            $role->givePermissionTo('delete_user');
        } else {
            $role->revokePermissionTo('delete_user');
        }

        //Assign Calibrated Devices
        if ($calibrated_devices_read == 'read_calibrated_devices') {
            $role->givePermissionTo('read_calibrated_devices');
        } else {
            $role->revokePermissionTo('read_calibrated_devices');
        }
        if ($calibrated_devices_edit == 'edit_calibrated_devices') {
            $role->givePermissionTo('edit_calibrated_devices');
        } else {
            $role->revokePermissionTo('edit_calibrated_devices');
        }
        if ($calibrated_devices_create == 'create_calibrated_devices') {
            $role->givePermissionTo('create_calibrated_devices');
        } else {
            $role->revokePermissionTo('create_calibrated_devices');
        }
        if ($calibrated_devices_delete == 'delete_calibrated_devices') {
            $role->givePermissionTo('delete_calibrated_devices');
        } else {
            $role->revokePermissionTo('delete_calibrated_devices');
        }

        //Assign Customer Feedback Records
        if ($customer_feedback_record_read == 'read_customer_feedback_records') {
            $role->givePermissionTo('read_customer_feedback_records');
        } else {
            $role->revokePermissionTo('read_customer_feedback_records');
        }
        if ($customer_feedback_record_edit == 'edit_customer_feedback_records') {
            $role->givePermissionTo('edit_customer_feedback_records');
        } else {
            $role->revokePermissionTo('edit_customer_feedback_records');
        }
        if ($customer_feedback_record_create == 'create_customer_feedback_records') {
            $role->givePermissionTo('create_customer_feedback_records');
        } else {
            $role->revokePermissionTo('create_customer_feedback_records');
        }
        if ($customer_feedback_record_delete == 'delete_customer_feedback_records') {
            $role->givePermissionTo('delete_customer_feedback_records');
        } else {
            $role->revokePermissionTo('delete_customer_feedback_records');
        }

        //Assign Continual Improvement Records
        if ($continual_improvement_records_read == 'read_continual_improvement_records') {
            $role->givePermissionTo('read_continual_improvement_records');
        } else {
            $role->revokePermissionTo('read_continual_improvement_records');
        }
        if ($continual_improvement_records_edit == 'edit_continual_improvement_records') {
            $role->givePermissionTo('edit_continual_improvement_records');
        } else {
            $role->revokePermissionTo('edit_continual_improvement_records');
        }
        if ($continual_improvement_records_create == 'create_continual_improvement_records') {
            $role->givePermissionTo('create_continual_improvement_records');
        } else {
            $role->revokePermissionTo('create_continual_improvement_records');
        }
        if ($continual_improvement_records_delete == 'delete_continual_improvement_records') {
            $role->givePermissionTo('delete_continual_improvement_records');
        } else {
            $role->revokePermissionTo('delete_continual_improvement_records');
        }

        //Assign CPARS
        if ($cpars_read == 'read_cpars') {
            $role->givePermissionTo('read_cpars');
        } else {
            $role->revokePermissionTo('read_cpars');
        }
        if ($cpars_edit == 'edit_cpars') {
            $role->givePermissionTo('edit_cpars');
        } else {
            $role->revokePermissionTo('edit_cpars');
        }
        if ($cpars_create == 'create_cpars') {
            $role->givePermissionTo('create_cpars');
        } else {
            $role->revokePermissionTo('create_cpars');
        }
        if ($cpars_delete == 'delete_cpars') {
            $role->givePermissionTo('delete_cpars');
        } else {
            $role->revokePermissionTo('delete_cpars');
        }

        //Assign Customer Satisfaction Records
        if ($customer_satisfaction_records_read == 'read_customer_satisfaction_records') {
            $role->givePermissionTo('read_customer_satisfaction_records');
        } else {
            $role->revokePermissionTo('read_customer_satisfaction_records');
        }
        if ($customer_satisfaction_records_edit == 'edit_customer_satisfaction_records') {
            $role->givePermissionTo('edit_customer_satisfaction_records');
        } else {
            $role->revokePermissionTo('edit_customer_satisfaction_records');
        }
        if ($customer_satisfaction_records_create == 'create_customer_satisfaction_records') {
            $role->givePermissionTo('create_customer_satisfaction_records');
        } else {
            $role->revokePermissionTo('create_customer_satisfaction_records');
        }
        if ($customer_satisfaction_records_delete == 'delete_customer_satisfaction_records') {
            $role->givePermissionTo('delete_customer_satisfaction_records');
        } else {
            $role->revokePermissionTo('delete_customer_satisfaction_records');
        }

        //Assign NCRS
        if ($ncrs_read == 'read_ncrs') {
            $role->givePermissionTo('read_ncrs');
        } else {
            $role->revokePermissionTo('read_ncrs');
        }
        if ($ncrs_edit == 'edit_ncrs') {
            $role->givePermissionTo('edit_ncrs');
        } else {
            $role->revokePermissionTo('edit_ncrs');
        }
        if ($ncrs_create == 'create_ncrs') {
            $role->givePermissionTo('create_ncrs');
        } else {
            $role->revokePermissionTo('create_ncrs');
        }
        if ($ncrs_delete == 'delete_ncrs') {
            $role->givePermissionTo('delete_ncrs');
        } else {
            $role->revokePermissionTo('delete_ncrs');
        }

        //Assign NCRS
        if ($snrs_read == 'read_snrs') {
            $role->givePermissionTo('read_snrs');
        } else {
            $role->revokePermissionTo('read_snrs');
        }
        if ($snrs_edit == 'edit_snrs') {
            $role->givePermissionTo('edit_snrs');
        } else {
            $role->revokePermissionTo('edit_snrs');
        }
        if ($snrs_create == 'create_snrs') {
            $role->givePermissionTo('create_snrs');
        } else {
            $role->revokePermissionTo('create_snrs');
        }
        if ($snrs_delete == 'delete_snrs') {
            $role->givePermissionTo('delete_snrs');
        } else {
            $role->revokePermissionTo('delete_snrs');
        }

        //Assign RARS
        if ($rars_read == 'read_rars') {
            $role->givePermissionTo('read_rars');
        } else {
            $role->revokePermissionTo('read_rars');
        }
        if ($rars_edit == 'edit_rars') {
            $role->givePermissionTo('edit_rars');
        } else {
            $role->revokePermissionTo('edit_rars');
        }
        if ($rars_create == 'create_rars') {
            $role->givePermissionTo('create_rars');
        } else {
            $role->revokePermissionTo('create_rars');
        }
        if ($rars_delete == 'delete_rars') {
            $role->givePermissionTo('delete_rars');
        } else {
            $role->revokePermissionTo('delete_rars');
        }

        //Assign Training History
        if ($training_history_read == 'read_training_history') {
            $role->givePermissionTo('read_training_history');
        } else {
            $role->revokePermissionTo('read_training_history');
        }
        if ($training_history_edit == 'edit_training_history') {
            $role->givePermissionTo('edit_training_history');
        } else {
            $role->revokePermissionTo('edit_training_history');
        }
        if ($training_history_create == 'create_training_history') {
            $role->givePermissionTo('create_training_history');
        } else {
            $role->revokePermissionTo('create_training_history');
        }
        if ($training_history_delete == 'delete_training_history') {
            $role->givePermissionTo('delete_training_history');
        } else {
            $role->revokePermissionTo('delete_training_history');
        }

        //Assign Audit Schedule
        if ($audit_schedule_read == 'read_audit_schedule') {
            $role->givePermissionTo('read_audit_schedule');
        } else {
            $role->revokePermissionTo('read_audit_schedule');
        }
        if ($audit_schedule_edit == 'edit_audit_schedule') {
            $role->givePermissionTo('edit_audit_schedule');
        } else {
            $role->revokePermissionTo('edit_audit_schedule');
        }
        if ($audit_schedule_create == 'create_audit_schedule') {
            $role->givePermissionTo('create_audit_schedule');
        } else {
            $role->revokePermissionTo('create_audit_schedule');
        }
        if ($audit_schedule_delete == 'delete_audit_schedule') {
            $role->givePermissionTo('delete_audit_schedule');
        } else {
            $role->revokePermissionTo('delete_audit_schedule');
        }

        //Assign Audit Schedule
        if ($management_reviews_read == 'read_management_reviews') {
            $role->givePermissionTo('read_management_reviews');
        } else {
            $role->revokePermissionTo('read_management_reviews');
        }
        if ($management_reviews_edit == 'edit_management_reviews') {
            $role->givePermissionTo('edit_management_reviews');
        } else {
            $role->revokePermissionTo('edit_management_reviews');
        }
        if ($management_reviews_create == 'create_management_reviews') {
            $role->givePermissionTo('create_management_reviews');
        } else {
            $role->revokePermissionTo('create_management_reviews');
        }
        if ($management_reviews_delete == 'delete_management_reviews') {
            $role->givePermissionTo('delete_management_reviews');
        } else {
            $role->revokePermissionTo('delete_management_reviews');
        }

        //Assign Maintenance List
        if ($maintenance_list_read == 'read_maintenance_list') {
            $role->givePermissionTo('read_maintenance_list');
        } else {
            $role->revokePermissionTo('read_maintenance_list');
        }
        if ($maintenance_list_edit == 'edit_maintenance_list') {
            $role->givePermissionTo('edit_maintenance_list');
        } else {
            $role->revokePermissionTo('edit_maintenance_list');
        }
        if ($maintenance_list_create == 'create_maintenance_list') {
            $role->givePermissionTo('create_maintenance_list');
        } else {
            $role->revokePermissionTo('create_maintenance_list');
        }
        if ($maintenance_list_delete == 'delete_maintenance_list') {
            $role->givePermissionTo('delete_maintenance_list');
        } else {
            $role->revokePermissionTo('delete_maintenance_list');
        }

        //Assign Documents
        if ($documents_read == 'read_documents') {
            $role->givePermissionTo('read_documents');
        } else {
            $role->revokePermissionTo('read_documents');
        }
        if ($documents_edit == 'edit_documents') {
            $role->givePermissionTo('edit_documents');
        } else {
            $role->revokePermissionTo('edit_documents');
        }
        if ($documents_create == 'create_documents') {
            $role->givePermissionTo('create_documents');
        } else {
            $role->revokePermissionTo('create_documents');
        }
        if ($documents_delete == 'delete_documents') {
            $role->givePermissionTo('delete_documents');
        } else {
            $role->revokePermissionTo('delete_documents');
        }

        //Assign DCRs
        if ($dcrs_read == 'read_dcrs') {
            $role->givePermissionTo('read_dcrs');
        } else {
            $role->revokePermissionTo('read_dcrs');
        }
        if ($dcrs_edit == 'edit_dcrs') {
            $role->givePermissionTo('edit_dcrs');
        } else {
            $role->revokePermissionTo('edit_dcrs');
        }
        if ($dcrs_create == 'create_dcrs') {
            $role->givePermissionTo('create_dcrs');
        } else {
            $role->revokePermissionTo('create_dcrs');
        }
        if ($dcrs_delete == 'delete_dcrs') {
            $role->givePermissionTo('delete_dcrs');
        } else {
            $role->revokePermissionTo('delete_dcrs');
        }

        //Assign External Document
        if ($external_document_read == 'read_external_document') {
            $role->givePermissionTo('read_external_document');
        } else {
            $role->revokePermissionTo('read_external_document');
        }
        if ($external_document_edit == 'edit_external_document') {
            $role->givePermissionTo('edit_external_document');
        } else {
            $role->revokePermissionTo('edit_external_document');
        }
        if ($external_document_create == 'create_external_document') {
            $role->givePermissionTo('create_external_document');
        } else {
            $role->revokePermissionTo('create_external_document');
        }
        if ($external_document_delete == 'delete_external_document') {
            $role->givePermissionTo('delete_external_document');
        } else {
            $role->revokePermissionTo('delete_external_document');
        }

        //Assign Record Summary
        if ($record_summary_read == 'read_record_summary') {
            $role->givePermissionTo('read_record_summary');
        } else {
            $role->revokePermissionTo('read_record_summary');
        }
        if ($record_summary_edit == 'edit_record_summary') {
            $role->givePermissionTo('edit_record_summary');
        } else {
            $role->revokePermissionTo('edit_record_summary');
        }
        if ($record_summary_create == 'create_record_summary') {
            $role->givePermissionTo('create_record_summary');
        } else {
            $role->revokePermissionTo('create_record_summary');
        }
        if ($record_summary_delete == 'delete_record_summary') {
            $role->givePermissionTo('delete_record_summary');
        } else {
            $role->revokePermissionTo('delete_record_summary');
        }

        //Assign HSE
        if ($hse_read == 'read_hse') {
            $role->givePermissionTo('read_hse');
        } else {
            $role->revokePermissionTo('read_hse');
        }
        if ($hse_edit == 'edit_hse') {
            $role->givePermissionTo('edit_hse');
        } else {
            $role->revokePermissionTo('edit_hse');
        }
        if ($hse_create == 'create_hse') {
            $role->givePermissionTo('create_hse');
        } else {
            $role->revokePermissionTo('create_hse');
        }
        if ($hse_delete == 'delete_hse') {
            $role->givePermissionTo('delete_hse');
        } else {
            $role->revokePermissionTo('delete_hse');
        }

        //Assign MOCR
        if ($mocr_read == 'read_mocr') {
            $role->givePermissionTo('read_mocr');
        } else {
            $role->revokePermissionTo('read_mocr');
        }
        if ($mocr_edit == 'edit_mocr') {
            $role->givePermissionTo('edit_mocr');
        } else {
            $role->revokePermissionTo('edit_mocr');
        }
        if ($mocr_create == 'create_mocr') {
            $role->givePermissionTo('create_mocr');
        } else {
            $role->revokePermissionTo('create_mocr');
        }
        if ($mocr_delete == 'delete_mocr') {
            $role->givePermissionTo('delete_mocr');
        } else {
            $role->revokePermissionTo('delete_mocr');
        }

        //Assign EDR
        if ($edr_read == 'read_edr') {
            $role->givePermissionTo('read_edr');
        } else {
            $role->revokePermissionTo('read_edr');
        }
        if ($edr_edit == 'edit_edr') {
            $role->givePermissionTo('edit_edr');
        } else {
            $role->revokePermissionTo('edit_edr');
        }
        if ($edr_create == 'create_edr') {
            $role->givePermissionTo('create_edr');
        } else {
            $role->revokePermissionTo('create_edr');
        }
        if ($edr_delete == 'delete_edr') {
            $role->givePermissionTo('delete_edr');
        } else {
            $role->revokePermissionTo('delete_edr');
        }

        //Assign Qualified Auditors List
        if ($qualified_auditors_list_read == 'read_qualified_auditors_list') {
            $role->givePermissionTo('read_qualified_auditors_list');
        } else {
            $role->revokePermissionTo('read_qualified_auditors_list');
        }
        if ($qualified_auditors_list_edit == 'edit_qualified_auditors_list') {
            $role->givePermissionTo('edit_qualified_auditors_list');
        } else {
            $role->revokePermissionTo('edit_qualified_auditors_list');
        }
        if ($qualified_auditors_list_create == 'create_qualified_auditors_list') {
            $role->givePermissionTo('create_qualified_auditors_list');
        } else {
            $role->revokePermissionTo('create_qualified_auditors_list');
        }
        if ($qualified_auditors_list_delete == 'delete_qualified_auditors_list') {
            $role->givePermissionTo('delete_qualified_auditors_list');
        } else {
            $role->revokePermissionTo('delete_qualified_auditors_list');
        }

        //Assign First Aid
        if ($first_aid_read == 'read_first_aid') {
            $role->givePermissionTo('read_first_aid');
        } else {
            $role->revokePermissionTo('read_first_aid');
        }
        if ($first_aid_edit == 'edit_first_aid') {
            $role->givePermissionTo('edit_first_aid');
        } else {
            $role->revokePermissionTo('edit_first_aid');
        }
        if ($first_aid_create == 'create_first_aid') {
            $role->givePermissionTo('create_first_aid');
        } else {
            $role->revokePermissionTo('create_first_aid');
        }
        if ($first_aid_delete == 'delete_first_aid') {
            $role->givePermissionTo('delete_first_aid');
        } else {
            $role->revokePermissionTo('delete_first_aid');
        }

        //Assign Inspection Report
        if ($inspection_report_read == 'read_inspection_report') {
            $role->givePermissionTo('read_inspection_report');
        } else {
            $role->revokePermissionTo('read_inspection_report');
        }
        if ($inspection_report_edit == 'edit_inspection_report') {
            $role->givePermissionTo('edit_inspection_report');
        } else {
            $role->revokePermissionTo('edit_inspection_report');
        }
        if ($inspection_report_create == 'create_inspection_report') {
            $role->givePermissionTo('create_inspection_report');
        } else {
            $role->revokePermissionTo('create_inspection_report');
        }
        if ($inspection_report_delete == 'delete_inspection_report') {
            $role->givePermissionTo('delete_inspection_report');
        } else {
            $role->revokePermissionTo('delete_inspection_report');
        }

        //EFR
        if ($efr_read == 'read_efr') {
            $role->givePermissionTo('read_efr');
        } else {
            $role->revokePermissionTo('read_efr');
        }
        if ($efr_edit == 'edit_efr') {
            $role->givePermissionTo('edit_efr');
        } else {
            $role->revokePermissionTo('edit_efr');
        }
        if ($efr_create == 'create_efr') {
            $role->givePermissionTo('create_efr');
        } else {
            $role->revokePermissionTo('create_efr');
        }
        if ($efr_delete == 'delete_efr') {
            $role->givePermissionTo('delete_efr');
        } else {
            $role->revokePermissionTo('delete_efr');
        }

        //Permits
        if ($permits_read == 'read_permits') {
            $role->givePermissionTo('read_permits');
        } else {
            $role->revokePermissionTo('read_permits');
        }
        if ($permits_edit == 'edit_permits') {
            $role->givePermissionTo('edit_permits');
        } else {
            $role->revokePermissionTo('edit_permits');
        }
        if ($permits_create == 'create_permits') {
            $role->givePermissionTo('create_permits');
        } else {
            $role->revokePermissionTo('create_permits');
        }
        if ($permits_delete == 'delete_permits') {
            $role->givePermissionTo('delete_permits');
        } else {
            $role->revokePermissionTo('delete_permits');
        }

        session()->flash('success', 'Role has been updated successfully');

        return redirect(route('role_list'));
    }

    public function delete(Request $request)
    {
        $role = Role::findOrFail($request->id);
        $r = $role->delete();
        if ($r) {
            $msg = '<div class="alert alert-success" role="alert">
                    Role has been deleted.
                </div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">
                    Something went wrong
                </div>';
        }
        return $msg;
    }

    //Create Permissions Manually

    public function createPermissions()
    {
        //Create User Permissions
//        Permission::create(['name' => 'read_user']);
//        Permission::create(['name' => 'edit_user']);
//        Permission::create(['name' => 'create_user']);
//        Permission::create(['name' => 'delete_user']);
//
//        //Create Calibrated Devices Permissions
//        Permission::create(['name' => 'read_calibrated_devices']);
//        Permission::create(['name' => 'edit_calibrated_devices']);
//        Permission::create(['name' => 'create_calibrated_devices']);
//        Permission::create(['name' => 'delete_calibrated_devices']);
//
//        //Create Customer Feedback Records
//        Permission::create(['name' => 'read_customer_feedback_records']);
//        Permission::create(['name' => 'edit_customer_feedback_records']);
//        Permission::create(['name' => 'create_customer_feedback_records']);
//        Permission::create(['name' => 'delete_customer_feedback_records']);
//
//        //Create Continual Improvement Records
//        Permission::create(['name' => 'read_continual_improvement_records']);
//        Permission::create(['name' => 'edit_continual_improvement_records']);
//        Permission::create(['name' => 'create_continual_improvement_records']);
//        Permission::create(['name' => 'delete_continual_improvement_records']);
//
//        //Create CPARS
//        Permission::create(['name' => 'read_cpars']);
//        Permission::create(['name' => 'edit_cpars']);
//        Permission::create(['name' => 'create_cpars']);
//        Permission::create(['name' => 'delete_cpars']);
//
//        //Create Customer Satisfaction Records
//        Permission::create(['name' => 'read_customer_satisfaction_records']);
//        Permission::create(['name' => 'edit_customer_satisfaction_records']);
//        Permission::create(['name' => 'create_customer_satisfaction_records']);
//        Permission::create(['name' => 'delete_customer_satisfaction_records']);
//
//        //Create NCRS
//        Permission::create(['name' => 'read_ncrs']);
//        Permission::create(['name' => 'edit_ncrs']);
//        Permission::create(['name' => 'create_ncrs']);
//        Permission::create(['name' => 'delete_ncrs']);
//
//        //Create SNRS
//        Permission::create(['name' => 'read_snrs']);
//        Permission::create(['name' => 'edit_snrs']);
//        Permission::create(['name' => 'create_snrs']);
//        Permission::create(['name' => 'delete_snrs']);
//
//        //Create RARS
//        Permission::create(['name' => 'read_rars']);
//        Permission::create(['name' => 'edit_rars']);
//        Permission::create(['name' => 'create_rars']);
//        Permission::create(['name' => 'delete_rars']);
//
//        //Create Training History
//        Permission::create(['name' => 'read_training_history']);
//        Permission::create(['name' => 'edit_training_history']);
//        Permission::create(['name' => 'create_training_history']);
//        Permission::create(['name' => 'delete_training_history']);
//
//        //Create Audit Schedule
//        Permission::create(['name' => 'read_audit_schedule']);
//        Permission::create(['name' => 'edit_audit_schedule']);
//        Permission::create(['name' => 'create_audit_schedule']);
//        Permission::create(['name' => 'delete_audit_schedule']);
//
//        //Create Management Reviews
//        Permission::create(['name' => 'read_management_reviews']);
//        Permission::create(['name' => 'edit_management_reviews']);
//        Permission::create(['name' => 'create_management_reviews']);
//        Permission::create(['name' => 'delete_management_reviews']);
//
//        //Create Maintenance List
//        Permission::create(['name' => 'read_maintenance_list']);
//        Permission::create(['name' => 'edit_maintenance_list']);
//        Permission::create(['name' => 'create_maintenance_list']);
//        Permission::create(['name' => 'delete_maintenance_list']);
//
//        //Create Documents
//        Permission::create(['name' => 'read_documents']);
//        Permission::create(['name' => 'edit_documents']);
//        Permission::create(['name' => 'create_documents']);
//        Permission::create(['name' => 'delete_documents']);
//
//        //Create Documents
//        Permission::create(['name' => 'read_dcrs']);
//        Permission::create(['name' => 'edit_dcrs']);
//        Permission::create(['name' => 'create_dcrs']);
//        Permission::create(['name' => 'delete_dcrs']);
//
//        //Create External Document
//        Permission::create(['name' => 'read_external_document']);
//        Permission::create(['name' => 'edit_external_document']);
//        Permission::create(['name' => 'create_external_document']);
//        Permission::create(['name' => 'delete_external_document']);
//
//        //Create Record Summary
//        Permission::create(['name' => 'read_record_summary']);
//        Permission::create(['name' => 'edit_record_summary']);
//        Permission::create(['name' => 'create_record_summary']);
//        Permission::create(['name' => 'delete_record_summary']);

//        //Create HSE
//        Permission::create(['name' => 'read_hse']);
//        Permission::create(['name' => 'edit_hse']);
//        Permission::create(['name' => 'create_hse']);
//        Permission::create(['name' => 'delete_hse']);

//        //Create MOCR
//        Permission::create(['name' => 'read_mocr']);
//        Permission::create(['name' => 'edit_mocr']);
//        Permission::create(['name' => 'create_mocr']);
//        Permission::create(['name' => 'delete_mocr']);

//        //Create EDR
//        Permission::create(['name' => 'read_edr']);
//        Permission::create(['name' => 'edit_edr']);
//        Permission::create(['name' => 'create_edr']);
//        Permission::create(['name' => 'delete_edr']);

//        //Create Qualified Auditors List
//        Permission::create(['name' => 'read_qualified_auditors_list']);
//        Permission::create(['name' => 'edit_qualified_auditors_list']);
//        Permission::create(['name' => 'create_qualified_auditors_list']);
//        Permission::create(['name' => 'delete_qualified_auditors_list']);

//        //Create First Aid
//        Permission::create(['name' => 'read_first_aid']);
//        Permission::create(['name' => 'edit_first_aid']);
//        Permission::create(['name' => 'create_first_aid']);
//        Permission::create(['name' => 'delete_first_aid']);
//
        //Create Inspection Report
//        Permission::create(['name' => 'read_inspection_report']);
//        Permission::create(['name' => 'edit_inspection_report']);
//        Permission::create(['name' => 'create_inspection_report']);
//        Permission::create(['name' => 'delete_inspection_report']);

        //EFR

//        Permission::create(['name' => 'read_efr']);
//        Permission::create(['name' => 'edit_efr']);
//        Permission::create(['name' => 'create_efr']);
//        Permission::create(['name' => 'delete_efr']);

        //Permits
        Permission::create(['name' => 'read_permits']);
        Permission::create(['name' => 'edit_permits']);
        Permission::create(['name' => 'create_permits']);
        Permission::create(['name' => 'delete_permits']);

        dd("Done...");

    }

    public function createSuperAdminRole()
    {
        $role = Role::create(['name' => 'Super Admin']);
        if ($role) {
            dd("Done");
        }
    }

    public function createDevUser()
    {
        $createDevUser = User::create([
            'first_name' => "Faakhar",
            'last_name' => "Shahwar",
            'email' => "faakharshahwar@gmail.com",
            'password' => Hash::make("@Chatter@123"),
            'status' => 1,
            'dev_user' => 1,
        ]);

        if ($createDevUser) {
            dd("Dev User Added");
        } else {
            dd("There is a problem to add Dev User");
        }
    }

    //Add dev super admin
    public function createSuperAdmin()
    {
        $user = User::where('email', 'faakharshahwar@gmail.com')->first();
        $user->assignRole('Super Admin');
        dd("Done");
    }

    //Add vendor super admin by email
    public function createVendorSuperAdmin()
    {
        $user = User::where('email', 'faakharshahwar@gmail.com')->first();
        $user->assignRole('Super Admin');
        dd("Done");
    }
}
