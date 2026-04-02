<?php

namespace App\Services;

use App\Mail\Reminders\AuditScheduleDueMail;
use App\Mail\Reminders\CIRTargetCompletionDueMail;
use App\Mail\Reminders\CPARTargetCompletionDueMail;
use App\Mail\Reminders\DocumentNextDueDateMail;
use App\Mail\Reminders\ExternalDocumentNextVerificationDueDateMail;
use App\Mail\Reminders\FirstAidExpiryMail;
use App\Mail\Reminders\InspectionReportDueMail;
use App\Mail\Reminders\MaintenanceDueMail;
use App\Mail\Reminders\ManagementReviewMail;
use App\Mail\Reminders\NCRTargetCompletionDueMail;
use App\Models\Modules\AuditSchedule;
use App\Models\Modules\CalibratedDevices;
use App\Models\Modules\ContinualImprovementRecords;
use App\Models\Modules\Cpars;
use App\Models\Modules\Documents;
use App\Models\Modules\ExternalDocument;
use App\Models\Modules\FirstAids;
use App\Models\Modules\InspectionReport;
use App\Models\Modules\MaintenanceList;
use App\Models\Modules\ManagementReviews;
use App\Models\Modules\Ncrs;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reminders\CalibrationDueMail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ReminderService
{
    protected $recipients = [
        'faakhar@cppumps.com',
        'kuldeep@cppumps.com',
        'angelam@cppumps.com',
    ];

    public function sendCalibrationReminders()
    {
        $dueRecords = $this->getDueCalibratedDevices()
            ->where('device_status', '!=', 'Out of Service');

        if ($dueRecords->isNotEmpty()) {
            Log::info('Calibration reminders found: ' . $dueRecords->count());

            $details = $dueRecords->map(function ($record) {
                return [
                    'id' => $record->id,
                    'device_id' => $record->device_id,
                    'next_calibration_due_date' => $record->next_calibration_due_date,
                    'formatted_date' => Carbon::parse($record->next_calibration_due_date)->format('d F Y'),
                ];
            });

            $this->sendCalibrationEmail($details);
        } else {
            Log::info('No calibration reminders found.');
        }
    }

    protected function getDueCalibratedDevices()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return CalibratedDevices::whereBetween('next_calibration_due_date', [$today, $tenDaysFromNow])
            ->orWhere('next_calibration_due_date', '<', $today) // Overdue records
            ->orWhereNull('next_calibration_due_date')           // No due date
            ->get();
    }

    protected function sendCalibrationEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new CalibrationDueMail($details));
            Log::info('Calibration reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send calibration reminder email: ' . $e->getMessage());
        }
    }

    // Maintenance Due Date Reminders

    public function sendMaintenanceReminders()
    {
        $dueRecords = $this->getDueMaintenanceRecords();

        if ($dueRecords->isNotEmpty()) {
            Log::info('Maintenance reminders found: ' . $dueRecords->count());

            $details = $dueRecords->map(function ($record) {
                return [
                    'id' => $record->id,
                    'equipment_id' => $record->equipment_id,
                    'next_maintenance_performed' => $record->next_maintenance_performed,
                    'formatted_date' => Carbon::parse($record->next_maintenance_performed)->format('d F Y'),
                ];
            });

            $this->sendMaintenanceEmail($details);
        } else {
            Log::info('No maintenance reminders found.');
        }
    }

    protected function getDueMaintenanceRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return MaintenanceList::whereBetween('next_maintenance_performed', [$today, $tenDaysFromNow])
            ->orWhere('next_maintenance_performed', '<', $today)
            ->orWhereNull('next_maintenance_performed')
            ->get();
    }

    protected function sendMaintenanceEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new MaintenanceDueMail($details));
            Log::info('Maintenance reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send maintenance reminder email: ' . $e->getMessage());
        }
    }

    //First Aid Expiry
    public function sendFirstAidExpiryReminders()
    {
        $dueRecords = $this->getFirstAidExpiryRecords();

        if ($dueRecords->isNotEmpty()) {
            Log::info('First Aid Expiry reminders found: ' . $dueRecords->count());

            $details = $dueRecords->map(function ($record) {
                return [
                    'id' => $record->id,
                    'item_name' => $record->item_name,
                    'expiry_date' => $record->expiry_date,
                    'formatted_date' => Carbon::parse($record->expiry_date)->format('d F Y'),
                ];
            });

            $this->sendFirstAidExpiryEmail($details);
        } else {
            Log::info('No first aid expiry reminders found.');
        }
    }

    protected function getFirstAidExpiryRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return FirstAids::whereBetween('expiry_date', [$today, $tenDaysFromNow])
            ->orWhere('expiry_date', '<', $today)
            ->orWhereNull('expiry_date')
            ->get();
    }

    protected function sendFirstAidExpiryEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new FirstAidExpiryMail($details));
            Log::info('First Aid Expiry reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send first aid expiry reminder email: ' . $e->getMessage());
        }
    }

    //Inspection Report Reminder
    public function sendInspectionReportReminders()
    {
        $dueRecords = $this->getInspectionReportDueDateRecords();

        if ($dueRecords->isNotEmpty()) {
            Log::info('Inspection Report reminders found: ' . $dueRecords->count());

            $details = $dueRecords->map(function ($record) {
                return [
                    'id' => $record->id,
                    'site' => $record->site,
                    'report_type' => $record->report_type,
                    'next_due_date' => $record->next_due_date,
                    'formatted_date' => Carbon::parse($record->next_due_date)->format('d F Y'),
                ];
            });

            $this->sendInspectionReportDueDateEmail($details);
        } else {
            Log::info('No Inspection Report Due Date reminders found.');
        }
    }

    protected function getInspectionReportDueDateRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return InspectionReport::where('status', 'Planned')
            ->where(function ($query) use ($today, $tenDaysFromNow) {
                $query->whereBetween('next_due_date', [$today, $tenDaysFromNow])
                    ->orWhere('next_due_date', '<', $today)
                    ->orWhereNull('next_due_date');
            })
            ->get();
    }

    protected function sendInspectionReportDueDateEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new InspectionReportDueMail($details));
            Log::info('Inspection Report due reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send inspection report due reminder email: ' . $e->getMessage());
        }
    }

    //Document Next Review Date
    public function sendDocumentNextDueDateReminders()
    {
        $dueDate = $this->getDocumentNextDueDateRecords();

        if ($dueDate->isNotEmpty()) {
            Log::info('Document next due date reminders found: ' . $dueDate->count());

            $details = $dueDate->map(function ($record) {
                return [
                    'id' => $record->id,
                    'site' => $record->site,
                    'title' => $record->title,
                    'document_next_review_date' => $record->document_next_review_date,
                    'formatted_date' => Carbon::parse($record->document_next_review_date)->format('d F Y'),
                ];
            });

            $this->sendDocumentNextDueDateEmail($details);
        } else {
            Log::info('No Document next due date reminders found.');
        }
    }

    protected function getDocumentNextDueDateRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return Documents::whereBetween('document_next_review_date', [$today, $tenDaysFromNow])
            ->orWhere('document_next_review_date', '<', $today)
            ->orWhereNull('document_next_review_date')
            ->get();
    }

    protected function sendDocumentNextDueDateEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new DocumentNextDueDateMail($details));
            Log::info('Document next due date reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send document next due date reminder email: ' . $e->getMessage());
        }
    }

    //CPAR Target Date
    public function sendCPARTargetDateReminders()
    {
        $dueDate = $this->getCPARTargetDateRecords();

        if ($dueDate->isNotEmpty()) {
            Log::info('CPAR Target Completion next due date reminders found: ' . $dueDate->count());

            $details = $dueDate->map(function ($record) {
                return [
                    'id' => $record->id,
                    'site' => $record->site,
                    'cpar_type' => $record->cpar_type,
                    'target_completion_date' => $record->target_completion_date,
                    'formatted_date' => Carbon::parse($record->target_completion_date)->format('d F Y'),
                ];
            });

            $this->sendCPARTargetDateEmail($details);
        } else {
            Log::info('No CPAR target date reminders found.');
        }
    }

    protected function getCPARTargetDateRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return Cpars::where(function ($query) use ($today, $tenDaysFromNow) {
            $query->whereBetween('target_completion_date', [$today, $tenDaysFromNow])
                ->orWhere('target_completion_date', '<', $today)
                ->orWhereNull('target_completion_date');
        })
            ->whereNull('closure_date') // Ensures closure_date is null
            ->get();
    }


    protected function sendCPARTargetDateEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new CPARTargetCompletionDueMail($details));
            Log::info('CPAR target date reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send CPAR target date reminder email: ' . $e->getMessage());
        }
    }

    //CIR Target Date
    public function sendCIRTargetDateReminders()
    {
        $dueDate = $this->getCIRTargetDateRecords();

        if ($dueDate->isNotEmpty()) {
            Log::info('CIR Target Completion next due date reminders found: ' . $dueDate->count());

            $details = $dueDate->map(function ($record) {
                return [
                    'id' => $record->id,
                    'site' => $record->site,
                    'cir_type' => $record->cir_type,
                    'target_completion_date' => $record->target_completion_date,
                    'formatted_date' => Carbon::parse($record->target_completion_date)->format('d F Y'),
                ];
            });

            $this->sendCIRTargetDateEmail($details);
        } else {
            Log::info('No CIR target date reminders found.');
        }
    }

    protected function getCIRTargetDateRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return ContinualImprovementRecords::where(function ($query) use ($today, $tenDaysFromNow) {
            $query->whereBetween('target_completion_date', [$today, $tenDaysFromNow])
                ->orWhere('target_completion_date', '<', $today)
                ->orWhereNull('target_completion_date');
        })
            ->whereNull('closure_date') // Ensures closure_date is null
            ->get();
    }

    protected function sendCIRTargetDateEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new CIRTargetCompletionDueMail($details));
            Log::info('CIR target date reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send CIR target date reminder email: ' . $e->getMessage());
        }
    }

    //NCR Target Date
    public function sendNCRTargetDateReminders()
    {
        $dueDate = $this->getNCRTargetDateRecords();

        if ($dueDate->isNotEmpty()) {
            Log::info('NCR Target Completion next due date reminders found: ' . $dueDate->count());

            $details = $dueDate->map(function ($record) {
                return [
                    'id' => $record->id,
                    'originating_site' => $record->originating_site,
                    'ncr_category' => $record->ncr_category,
                    'target_date' => $record->target_date,
                    'formatted_date' => Carbon::parse($record->target_date)->format('d F Y'),
                ];
            });

            $this->sendNCRTargetDateEmail($details);
        } else {
            Log::info('No NCR target date reminders found.');
        }
    }

    protected function getNCRTargetDateRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return Ncrs::where(function ($query) use ($today, $tenDaysFromNow) {
            $query->whereBetween('target_date', [$today, $tenDaysFromNow])
                ->orWhere('target_date', '<', $today)
                ->orWhereNull('target_date');
        })
            ->whereNull('closure_date') // Ensures closure_date is null
            ->get();
    }

    protected function sendNCRTargetDateEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new NCRTargetCompletionDueMail($details));
            Log::info('NCR target date reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send NCR target date reminder email: ' . $e->getMessage());
        }
    }

    //Audit Schedule Start Date Reminder
    public function sendAuditScheduleStartDateReminders()
    {
        $dueDate = $this->getAuditScheduleStartDateRecords();

        if ($dueDate->isNotEmpty()) {
            Log::info('Audit Schedule Start date reminders found: ' . $dueDate->count());

            $details = $dueDate->map(function ($record) {
                return [
                    'id' => $record->id,
                    'audit_id' => $record->audit_id,
                    'audit_type' => $record->audit_type,
                    'start_date' => $record->start_date,
                    'formatted_date' => Carbon::parse($record->start_date)->format('d F Y'),
                ];
            });

            $this->sendAuditScheduleStartDateEmail($details);
        } else {
            Log::info('No Audit Schedule Start date reminders found.');
        }
    }

    protected function getAuditScheduleStartDateRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return AuditSchedule::where(function ($query) use ($today, $tenDaysFromNow) {
            $query->whereBetween('start_date', [$today, $tenDaysFromNow])
                ->orWhere('start_date', '<', $today)
                ->orWhereNull('start_date');
        })
            ->whereNull('audit_completion_date') // Ensures Audit Completion Date is null
            ->get();
    }

    protected function sendAuditScheduleStartDateEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new AuditScheduleDueMail($details));
            Log::info('Audit Schedule Start date reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send Audit Schedule Start date reminder email: ' . $e->getMessage());
        }
    }

    //External Document Next Verification Due Date
    public function sendExternalDocumentNextVerificationDateReminders()
    {
        $dueDate = $this->getExternalDocumentNextVerificationDateRecords();

        if ($dueDate->isNotEmpty()) {
            Log::info('External Document next verification due date reminders found: ' . $dueDate->count());

            $details = $dueDate->map(function ($record) {
                return [
                    'id' => $record->id,
                    'doc_id' => $record->doc_id,
                    'document_type' => $record->document_type,
                    'next_verification_due_date' => $record->next_verification_due_date,
                    'formatted_date' => Carbon::parse($record->next_verification_due_date)->format('d F Y'),
                ];
            });

            $this->sendExternalDocumentNextVerificationDateEmail($details);
        } else {
            Log::info('External Document next verification due date reminders found.');
        }
    }

    protected function getExternalDocumentNextVerificationDateRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return ExternalDocument::whereBetween('next_verification_due_date', [$today, $tenDaysFromNow])
            ->orWhere('next_verification_due_date', '<', $today)
            ->orWhereNull('next_verification_due_date')
            ->get();
    }

    protected function sendExternalDocumentNextVerificationDateEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new ExternalDocumentNextVerificationDueDateMail($details));
            Log::info('External Document next verification date reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send External Document next verification date reminder email: ' . $e->getMessage());
        }
    }

    //Management Reviews Reminder
    public function sendManagementReviewsDateReminders()
    {
        $dueDate = $this->getManagementReviewsDateRecords();

        if ($dueDate->isNotEmpty()) {
            Log::info('Management review date reminders found: ' . $dueDate->count());

            $details = $dueDate->map(function ($record) {
                return [
                    'id' => $record->id,
                    'date_of_management_review' => $record->date_of_management_review,
                    'site' => $record->site,
                    'status' => $record->status,
                    'formatted_date' => Carbon::parse($record->date_of_management_review)->format('d F Y'),
                ];
            });

            $this->sendManagementReviewsDateEmail($details);
        } else {
            Log::info('Management review date reminders found.');
        }
    }

    protected function getManagementReviewsDateRecords()
    {
        $today = Carbon::now()->toDateString();
        $tenDaysFromNow = Carbon::now()->addDays(10)->toDateString();

        return ManagementReviews::where(function ($query) use ($today, $tenDaysFromNow) {
            $query->whereBetween('date_of_management_review', [$today, $tenDaysFromNow])
                ->orWhere('date_of_management_review', '<', $today)
                ->orWhereNull('date_of_management_review');
        })
            ->where('status', '!=', 'Completed')
            ->get();
    }

    protected function sendManagementReviewsDateEmail($details)
    {
        try {
            Mail::to($this->recipients)->send(new ManagementReviewMail($details));
            Log::info('Management review date reminder email sent to: ' . implode(', ', $this->recipients));
        } catch (\Exception $e) {
            Log::error('Failed to send Management review date reminder email: ' . $e->getMessage());
        }
    }
}

//Todo:Need to add cron to send reminders, for now run commands:
// cd /homeb/cppumpsdb/public_html
// php artisan emails:send-reminders
