<?php

namespace App\Console\Commands;

use App\Services\ReminderService;
use Illuminate\Console\Command;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ReminderService $reminderService)
    {
        parent::__construct();
        $this->reminderService = $reminderService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->reminderService->sendCalibrationReminders();
        $this->reminderService->sendMaintenanceReminders();
        $this->reminderService->sendFirstAidExpiryReminders();
        $this->reminderService->sendInspectionReportReminders();
        $this->reminderService->sendDocumentNextDueDateReminders();
        $this->reminderService->sendCPARTargetDateReminders();
        $this->reminderService->sendCIRTargetDateReminders();
        $this->reminderService->sendNCRTargetDateReminders();
        $this->reminderService->sendAuditScheduleStartDateReminders();
        $this->reminderService->sendExternalDocumentNextVerificationDateReminders();
        $this->reminderService->sendManagementReviewsDateReminders();
        return 0;
    }
}
