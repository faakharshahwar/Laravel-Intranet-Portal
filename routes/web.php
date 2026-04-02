<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use App\Services\ReminderService;
//
//Route::get('/test-send-calibration-reminders', function (ReminderService $reminderService) {
//    $reminderService->sendCalibrationReminders(now()->toDateString());
//    return 'Calibration reminders sent!';
//});
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Api\AirportLookupController;
use App\Http\Controllers\Api\CityLookupController;
use App\Http\Controllers\Api\RiskLookupController;


Route::get('api/airports/suggest', [AirportLookupController::class, 'travelpayouts']);
Route::get('/api/cities/suggest', [CityLookupController::class, 'suggest'])->name('cities.suggest');
//Route::get('/api/risk/lookup', [RiskLookupController::class, 'lookup'])->name('api.risk.lookup');

Route::post('/api/risk/lookup', [RiskLookupController::class, 'lookup'])->name('api.risk.lookup');


Route::get('/send-test-email', function () {
    Mail::raw('This is a test email sent from Laravel!', function ($message) {
        $message->to('faakharshahwar@gmail.com')
            ->subject('Test Email');
    });

    return 'Test email sent!';
});

Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::to('dashboard');
    } else {
        return view('auth.login');
    }
})->name('/')->middleware('application_settings');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('application_settings');

//Module Routes
Route::group(['middleware' => ['auth', 'application_settings']], function () {

    //Todo: Device ID auto generate on the current numbers
    //Calibrated Devices Routes
    Route::group(['middleware' => ['can:read_calibrated_devices']], function () {
        Route::get('calibrated_devices', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'index'])->name('calibrated_devices');
        Route::get('read_calibrated_devices/{id}', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'read'])->name('read_calibrated_devices');
        Route::get('export_calibrated_devices', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'ExportIntoCSV'])->name('export_calibrated_devices');
        Route::get('print_calibrated_devices/{id}', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'print'])->name('print_calibrated_devices');
        Route::get('email_calibrated_devices/{id}', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'email'])->name('email_calibrated_devices');
        Route::post('send_email_calibrated_devices', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'send_email'])->name('send_email_calibrated_devices');
    });
    Route::group(['middleware' => ['can:edit_calibrated_devices']], function () {
        Route::get('edit_calibrated_devices/{id}', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'edit'])->name('edit_calibrated_devices');
        Route::post('update_calibrated_devices', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'update'])->name('update_calibrated_devices');
        Route::post('delete_calibrated_devices_past_record', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'deletePastRecord'])->name('delete_calibrated_devices_past_record');
    });
    Route::group(['middleware' => ['can:create_calibrated_devices']], function () {
        Route::get('create_calibrated_devices', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'create'])->name('create_calibrated_devices');
        Route::post('store_calibrated_devices', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'store'])->name('store_calibrated_devices');
        Route::post('import_calibrated_devices', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'ImportIntoCSV'])->name('import_calibrated_devices');
    });
    Route::group(['middleware' => ['can:delete_calibrated_devices']], function () {
        Route::get('delete_calibrated_devices/{id}', [\App\Http\Controllers\Modules\CalibratedDevicesController::class, 'delete'])->name('delete_calibrated_devices');
    });

    //Customer Feedbacks Records
    Route::group(['middleware' => ['can:read_customer_feedback_records']], function () {
        Route::get('customer_feedback_records', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'index'])->name('customer_feedback_records');
        Route::get('export_customer_feedback_records', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'ExportIntoCSV'])->name('export_customer_feedback_records');
        Route::get('read_customer_feedback_records/{id}', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'read'])->name('read_customer_feedback_records');
        Route::get('print_customer_feedback_records/{id}', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'print'])->name('print_customer_feedback_records');
        Route::get('email_customer_feedback_records/{id}', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'email'])->name('email_customer_feedback_records');
        Route::post('send_email_customer_feedback_records', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'send_email'])->name('send_email_customer_feedback_records');
    });
    Route::group(['middleware' => ['can:edit_customer_feedback_records']], function () {
        Route::get('edit_customer_feedback_records/{id}', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'edit'])->name('edit_customer_feedback_records');
        Route::post('update_customer_feedback_records', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'update'])->name('update_customer_feedback_records');
    });
    Route::group(['middleware' => ['can:create_customer_feedback_records']], function () {
        Route::get('create_customer_feedback_records', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'create'])->name('create_customer_feedback_records');
        Route::post('store_customer_feedback_records', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'store'])->name('store_customer_feedback_records');
        Route::post('import_customer_feedback_records', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'ImportIntoCSV'])->name('import_customer_feedback_records');
    });
    Route::group(['middleware' => ['can:delete_customer_feedback_records']], function () {
        Route::get('delete_customer_feedback_records/{id}', [\App\Http\Controllers\Modules\CustomerFeedbackRecordsController::class, 'delete'])->name('delete_customer_feedback_records');
    });

    //CIRs Continual Improvement Records
    //Todo: Make view,mail and print
    Route::group(['middleware' => ['can:read_continual_improvement_records']], function () {
        Route::get('continual_improvement_records', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'index'])->name('continual_improvement_records');
        Route::get('read_continual_improvement_records/{id}', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'read'])->name('read_continual_improvement_records');
        Route::get('print_continual_improvement_records/{id}', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'print'])->name('print_continual_improvement_records');
        Route::get('email_continual_improvement_records/{id}', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'email'])->name('email_continual_improvement_records');
        Route::post('send_email_continual_improvement_records', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'send_email'])->name('send_email_continual_improvement_records');
        Route::get('export_continual_improvement_records', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'ExportIntoCSV'])->name('export_continual_improvement_records');
    });
    Route::group(['middleware' => ['can:edit_continual_improvement_records']], function () {
        Route::get('edit_continual_improvement_records/{id}', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'edit'])->name('edit_continual_improvement_records');
        Route::post('update_continual_improvement_records', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'update'])->name('update_continual_improvement_records');
    });
    Route::group(['middleware' => ['can:create_continual_improvement_records']], function () {
        Route::get('create_continual_improvement_records', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'create'])->name('create_continual_improvement_records');
        Route::post('store_continual_improvement_records', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'store'])->name('store_continual_improvement_records');
        Route::post('import_continual_improvement_records', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'ImportIntoCSV'])->name('import_continual_improvement_records');
    });
    Route::group(['middleware' => ['can:delete_continual_improvement_records']], function () {
        Route::get('delete_continual_improvement_records/{id}', [\App\Http\Controllers\Modules\ContinualImprovementRecordsController::class, 'delete'])->name('delete_continual_improvement_records');
    });

    //CPARs Corr./Prev. Action Records
    Route::group(['middleware' => ['can:read_cpars']], function () {
        Route::get('cpars', [\App\Http\Controllers\Modules\CPARsController::class, 'index'])->name('cpars');
        Route::get('read_cpars/{id}', [\App\Http\Controllers\Modules\CPARsController::class, 'read'])->name('read_cpars');
        Route::get('print_cpars/{id}', [\App\Http\Controllers\Modules\CPARsController::class, 'print'])->name('print_cpars');
        Route::get('email_cpars/{id}', [\App\Http\Controllers\Modules\CPARsController::class, 'email'])->name('email_cpars');
        Route::post('send_email_cpars', [\App\Http\Controllers\Modules\CPARsController::class, 'send_email'])->name('send_email_cpars');
        Route::get('export_cpars', [\App\Http\Controllers\Modules\CPARsController::class, 'ExportIntoCSV'])->name('export_cpars');
    });
    Route::group(['middleware' => ['can:edit_cpars']], function () {
        Route::get('edit_cpars/{id}', [\App\Http\Controllers\Modules\CPARsController::class, 'edit'])->name('edit_cpars');
        Route::post('update_cpars', [\App\Http\Controllers\Modules\CPARsController::class, 'update'])->name('update_cpars');
    });
    Route::group(['middleware' => ['can:create_cpars']], function () {
        Route::get('create_cpars', [\App\Http\Controllers\Modules\CPARsController::class, 'create'])->name('create_cpars');
        Route::post('store_cpars', [\App\Http\Controllers\Modules\CPARsController::class, 'store'])->name('store_cpars');
        Route::post('import_cpars', [\App\Http\Controllers\Modules\CPARsController::class, 'ImportIntoCSV'])->name('import_cpars');
    });
    Route::group(['middleware' => ['can:delete_cpars']], function () {
        Route::get('delete_cpars/{id}', [\App\Http\Controllers\Modules\CPARsController::class, 'delete'])->name('delete_cpars');
    });
    Route::post('/add-reason', [\App\Http\Controllers\Modules\CPARsController::class, 'addReason']);
    Route::post('/add-results_area', [\App\Http\Controllers\Modules\CPARsController::class, 'addResultsArea']);

    //CSRs Customer Satisfaction Records
    Route::group(['middleware' => ['can:read_customer_satisfaction_records']], function () {
        Route::get('customer_satisfaction_records', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'index'])->name('customer_satisfaction_records');
        Route::get('read_customer_satisfaction_records/{id}', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'read'])->name('read_customer_satisfaction_records');
        Route::get('print_customer_satisfaction_records/{id}', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'print'])->name('print_customer_satisfaction_records');
        Route::get('email_customer_satisfaction_records/{id}', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'email'])->name('email_customer_satisfaction_records');
        Route::post('send_email_customer_satisfaction_records', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'send_email'])->name('send_email_customer_satisfaction_records');
        Route::get('export_customer_satisfaction_records', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'ExportIntoCSV'])->name('export_customer_satisfaction_records');
    });
    Route::group(['middleware' => ['can:edit_customer_satisfaction_records']], function () {
        Route::get('edit_customer_satisfaction_records/{id}', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'edit'])->name('edit_customer_satisfaction_records');
        Route::post('update_customer_satisfaction_records', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'update'])->name('update_customer_satisfaction_records');
    });
    Route::group(['middleware' => ['can:create_customer_satisfaction_records']], function () {
        Route::get('create_customer_satisfaction_records', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'create'])->name('create_customer_satisfaction_records');
        Route::post('store_customer_satisfaction_records', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'store'])->name('store_customer_satisfaction_records');
        Route::post('import_customer_satisfaction_records', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'ImportIntoCSV'])->name('import_customer_satisfaction_records');
    });
    Route::group(['middleware' => ['can:delete_customer_satisfaction_records']], function () {
        Route::get('delete_customer_satisfaction_records/{id}', [\App\Http\Controllers\Modules\CustomerSatisfactionRecordsController::class, 'delete'])->name('delete_customer_satisfaction_records');
    });

    //Documents
    Route::group(['middleware' => ['can:read_documents']], function () {
        Route::get('documents', [\App\Http\Controllers\Modules\DocumentsController::class, 'index'])->name('documents');
        Route::get('read_documents/{id}', [\App\Http\Controllers\Modules\DocumentsController::class, 'read'])->name('read_documents');
        Route::get('print_documents/{id}', [\App\Http\Controllers\Modules\DocumentsController::class, 'print'])->name('print_documents');
        Route::get('email_documents/{id}', [\App\Http\Controllers\Modules\DocumentsController::class, 'email'])->name('email_documents');
        Route::post('send_email_documents', [\App\Http\Controllers\Modules\DocumentsController::class, 'send_email'])->name('send_email_documents');
    });
    Route::group(['middleware' => ['can:edit_documents']], function () {
        Route::get('edit_documents/{id}', [\App\Http\Controllers\Modules\DocumentsController::class, 'edit'])->name('edit_documents');
        Route::post('update_documents', [\App\Http\Controllers\Modules\DocumentsController::class, 'update'])->name('update_documents');
    });
    Route::group(['middleware' => ['can:create_documents']], function () {
        Route::get('create_documents', [\App\Http\Controllers\Modules\DocumentsController::class, 'create'])->name('create_documents');
        Route::post('store_documents', [\App\Http\Controllers\Modules\DocumentsController::class, 'store'])->name('store_documents');
    });
    Route::group(['middleware' => ['can:delete_documents']], function () {
        Route::get('delete_documents/{id}', [\App\Http\Controllers\Modules\DocumentsController::class, 'delete'])->name('delete_documents');
    });
    //Todo: Adjust it according to permission
    Route::post('get_documents_by_site', [\App\Http\Controllers\Modules\DocumentsController::class, 'get_documents_by_site'])->name('get_documents_by_site');
    Route::post('get_documents_by_management_system', [\App\Http\Controllers\Modules\DocumentsController::class, 'get_documents_by_management_system'])->name('get_documents_by_management_system');

    //DCRs
    Route::group(['middleware' => ['can:read_dcrs']], function () {
        Route::get('dcrs', [\App\Http\Controllers\Modules\DCRsController::class, 'index'])->name('dcrs');
        Route::get('read_dcrs/{id}', [\App\Http\Controllers\Modules\DCRsController::class, 'read'])->name('read_dcrs');
        Route::get('print_dcrs/{id}', [\App\Http\Controllers\Modules\DCRsController::class, 'print'])->name('print_dcrs');
        Route::get('email_dcrs/{id}', [\App\Http\Controllers\Modules\DCRsController::class, 'email'])->name('email_dcrs');
        Route::post('send_email_dcrs', [\App\Http\Controllers\Modules\DCRsController::class, 'send_email'])->name('send_email_dcrs');
    });
    Route::group(['middleware' => ['can:edit_dcrs']], function () {
        Route::get('edit_dcrs/{id}', [\App\Http\Controllers\Modules\DCRsController::class, 'edit'])->name('edit_dcrs');
        Route::post('update_dcrs', [\App\Http\Controllers\Modules\DCRsController::class, 'update'])->name('update_dcrs');
    });
    Route::group(['middleware' => ['can:create_dcrs']], function () {
        Route::get('create_dcrs', [\App\Http\Controllers\Modules\DCRsController::class, 'create'])->name('create_dcrs');
        Route::post('store_dcrs', [\App\Http\Controllers\Modules\DCRsController::class, 'store'])->name('store_dcrs');
    });
    Route::group(['middleware' => ['can:delete_dcrs']], function () {
        Route::get('delete_dcrs/{id}', [\App\Http\Controllers\Modules\DCRsController::class, 'delete'])->name('delete_dcrs');
    });
    Route::post('get_documents_details', [\App\Http\Controllers\Modules\DCRsController::class, 'getDocumentDetails'])->name('get_documents_details');

    //NCRs Nonconformance Records
    Route::group(['middleware' => ['can:read_ncrs']], function () {
        Route::get('ncrs', [\App\Http\Controllers\Modules\NCRsController::class, 'index'])->name('ncrs');
        Route::get('read_ncrs/{id}', [\App\Http\Controllers\Modules\NCRsController::class, 'read'])->name('read');
        Route::get('print_ncrs/{id}', [\App\Http\Controllers\Modules\NCRsController::class, 'print'])->name('print_ncrs');
        Route::get('email_ncrs/{id}', [\App\Http\Controllers\Modules\NCRsController::class, 'email'])->name('email_ncrs');
        Route::post('send_email_ncrs', [\App\Http\Controllers\Modules\NCRsController::class, 'send_email'])->name('send_email_ncrs');
        Route::get('export_ncrs', [\App\Http\Controllers\Modules\NCRsController::class, 'ExportIntoCSV'])->name('export_ncrs');
    });
    Route::group(['middleware' => ['can:edit_ncrs']], function () {
        Route::get('edit_ncrs/{id}', [\App\Http\Controllers\Modules\NCRsController::class, 'edit'])->name('edit_ncrs');
        Route::post('update_ncrs', [\App\Http\Controllers\Modules\NCRsController::class, 'update'])->name('update_ncrs');
    });
    Route::group(['middleware' => ['can:create_ncrs']], function () {
        Route::get('create_ncrs', [\App\Http\Controllers\Modules\NCRsController::class, 'create'])->name('create_ncrs');
        Route::post('store_ncrs', [\App\Http\Controllers\Modules\NCRsController::class, 'store'])->name('store_ncrs');
        Route::post('import_ncrs', [\App\Http\Controllers\Modules\NCRsController::class, 'ImportIntoCSV'])->name('import_ncrs');
    });
    Route::group(['middleware' => ['can:delete_ncrs']], function () {
        Route::get('delete_ncrs/{id}', [\App\Http\Controllers\Modules\NCRsController::class, 'delete'])->name('delete_ncrs');
    });
    Route::post('/add-ncr-category', [\App\Http\Controllers\Modules\NCRsController::class, 'addNcrCategory']);
    Route::post('/add-results-area', [\App\Http\Controllers\Modules\NCRsController::class, 'addResultsArea']);

    //SNRs Supplier Nonconformance Records
    Route::group(['middleware' => ['can:read_snrs']], function () {
        Route::get('snrs', [\App\Http\Controllers\Modules\SNRsController::class, 'index'])->name('snrs');
        Route::get('read_snrs/{id}', [\App\Http\Controllers\Modules\SNRsController::class, 'read'])->name('read_snrs');
        Route::get('print_snrs/{id}', [\App\Http\Controllers\Modules\SNRsController::class, 'print'])->name('print_snrs');
        Route::get('email_snrs/{id}', [\App\Http\Controllers\Modules\SNRsController::class, 'email'])->name('email_snrs');
        Route::post('send_email_snrs', [\App\Http\Controllers\Modules\SNRsController::class, 'send_email'])->name('send_email_snrs');
        Route::get('export_snrs', [\App\Http\Controllers\Modules\SNRsController::class, 'ExportIntoCSV'])->name('export_snrs');
    });
    Route::group(['middleware' => ['can:edit_snrs']], function () {
        Route::get('edit_snrs/{id}', [\App\Http\Controllers\Modules\SNRsController::class, 'edit'])->name('edit_snrs');
        Route::post('update_snrs', [\App\Http\Controllers\Modules\SNRsController::class, 'update'])->name('update_snrs');
    });
    Route::group(['middleware' => ['can:create_snrs']], function () {
        Route::get('create_snrs', [\App\Http\Controllers\Modules\SNRsController::class, 'create'])->name('create_snrs');
        Route::post('store_snrs', [\App\Http\Controllers\Modules\SNRsController::class, 'store'])->name('store_snrs');
        Route::post('import_snrs', [\App\Http\Controllers\Modules\SNRsController::class, 'ImportIntoCSV'])->name('import_snrs');
    });
    Route::group(['middleware' => ['can:delete_snrs']], function () {
        Route::get('delete_snrs/{id}', [\App\Http\Controllers\Modules\SNRsController::class, 'delete'])->name('delete_snrs');
    });
    Route::post('/add-supplier', [\App\Http\Controllers\Modules\SNRsController::class, 'addSupplier']);
    Route::post('/add-disposition-decision', [\App\Http\Controllers\Modules\SNRsController::class, 'addDispositionDecision']);

    //RARs Risk Assessment Records
    Route::group(['middleware' => ['can:read_rars']], function () {
        Route::get('rars', [\App\Http\Controllers\Modules\RARsController::class, 'index'])->name('rars');
        Route::get('read_rars/{id}', [\App\Http\Controllers\Modules\RARsController::class, 'read'])->name('read_rars');
        Route::get('print_rars/{id}', [\App\Http\Controllers\Modules\RARsController::class, 'print'])->name('print_rars');
        Route::get('email_rars/{id}', [\App\Http\Controllers\Modules\RARsController::class, 'email'])->name('email_rars');
        Route::post('send_email_rars', [\App\Http\Controllers\Modules\RARsController::class, 'send_email'])->name('send_email_rars');
        Route::get('export_rars', [\App\Http\Controllers\Modules\RARsController::class, 'ExportIntoCSV'])->name('export_rars');
    });
    Route::group(['middleware' => ['can:edit_rars']], function () {
        Route::get('edit_rars/{id}', [\App\Http\Controllers\Modules\RARsController::class, 'edit'])->name('edit_rars');
        Route::post('update_rars', [\App\Http\Controllers\Modules\RARsController::class, 'update'])->name('update_rars');
    });
    Route::group(['middleware' => ['can:create_rars']], function () {
        Route::get('create_rars', [\App\Http\Controllers\Modules\RARsController::class, 'create'])->name('create_rars');
        Route::post('store_rars', [\App\Http\Controllers\Modules\RARsController::class, 'store'])->name('store_rars');
        Route::post('import_rars', [\App\Http\Controllers\Modules\RARsController::class, 'ImportIntoCSV'])->name('import_rars');
    });
    Route::group(['middleware' => ['can:delete_rars']], function () {
        Route::get('delete_rars/{id}', [\App\Http\Controllers\Modules\RARsController::class, 'delete'])->name('delete_rars');
    });

    Route::post('/add-department', [\App\Http\Controllers\Modules\RARsController::class, 'addDepartment']);
    Route::post('/add-risk-type', [\App\Http\Controllers\Modules\RARsController::class, 'addRiskType']);
    Route::post('/add-risk-source', [\App\Http\Controllers\Modules\RARsController::class, 'addRiskSource']);
    Route::post('/add-risk-category', [\App\Http\Controllers\Modules\RARsController::class, 'addRiskCategory']);

    //Training History
    Route::group(['middleware' => ['can:read_training_history']], function () {
        Route::get('training_history', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'index'])->name('training_history');
        Route::get('read_training_history/{id}', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'read'])->name('read_training_history');
        Route::get('print_training_history/{id}', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'print'])->name('print_training_history');
        Route::get('email_training_history/{id}', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'email'])->name('email_training_history');
        Route::post('send_email_training_history', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'send_email'])->name('send_email_training_history');
    });
    Route::group(['middleware' => ['can:edit_training_history']], function () {
        Route::get('edit_training_history/{id}', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'edit'])->name('edit_training_history');
        Route::post('update_training_history', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'update'])->name('update_training_history');
    });
    Route::group(['middleware' => ['can:create_training_history']], function () {
        Route::get('create_training_history', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'create'])->name('create_training_history');
        Route::post('store_training_history', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'store'])->name('store_training_history');
        Route::get('create_bulk_training_history', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'create_bulk'])->name('create_bulk_training_history');
        Route::post('store_bulk_training_history', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'store_bulk'])->name('store_bulk_training_history');
    });
    Route::group(['middleware' => ['can:delete_training_history']], function () {
        Route::get('delete_training_history/{id}', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'delete'])->name('delete_training_history');
    });
    //Todo: Adjust it according to permission
    Route::post('get_employee_details', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'getEmployeeDetails'])->name('get_employee_details');
    Route::get('/training-history-data', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'getTrainingHistoryData'])->name('training_history_data');
    Route::post('/add-training-type', [\App\Http\Controllers\Modules\TrainingHistoryController::class, 'addTrainingType']);

    //Audit Schedule
    Route::group(['middleware' => ['can:read_audit_schedule']], function () {
        Route::get('audit_schedule', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'index'])->name('audit_schedule');
        Route::get('read_audit_schedule/{id}', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'read'])->name('read_audit_schedule');
        Route::get('print_audit_schedule/{id}', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'print'])->name('print_audit_schedule');
        Route::get('email_audit_schedule/{id}', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'email'])->name('email_audit_schedule');
        Route::post('send_email_audit_schedule', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'send_email'])->name('send_email_audit_schedule');
        Route::get('export_audit_schedule', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'ExportIntoCSV'])->name('export_audit_schedule');
    });
    Route::group(['middleware' => ['can:edit_audit_schedule']], function () {
        Route::get('edit_audit_schedule/{id}', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'edit'])->name('edit_audit_schedule');
        Route::post('update_audit_schedule', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'update'])->name('update_audit_schedule');
    });
    Route::group(['middleware' => ['can:create_audit_schedule']], function () {
        Route::get('create_audit_schedule', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'create'])->name('create_audit_schedule');
        Route::post('store_audit_schedule', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'store'])->name('store_audit_schedule');
        Route::post('import_audit_schedule', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'ImportIntoCSV'])->name('import_audit_schedule');
    });
    Route::group(['middleware' => ['can:delete_audit_schedule']], function () {
        Route::get('delete_audit_schedule/{id}', [\App\Http\Controllers\Modules\AuditScheduleController::class, 'delete'])->name('delete_audit_schedule');
    });

    //Management Reviews
    Route::group(['middleware' => ['can:read_management_reviews']], function () {
        Route::get('management_reviews', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'index'])->name('management_reviews');
        Route::get('read_management_reviews/{id}', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'read'])->name('read_management_reviews');
        Route::get('print_management_reviews/{id}', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'print'])->name('print_management_reviews');
        Route::get('email_management_reviews/{id}', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'email'])->name('email_management_reviews');
        Route::post('send_email_management_reviews', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'send_email'])->name('send_email_management_reviews');
        Route::get('export_management_reviews', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'ExportIntoCSV'])->name('export_management_reviews');
    });
    Route::group(['middleware' => ['can:edit_management_reviews']], function () {
        Route::get('edit_management_reviews/{id}', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'edit'])->name('edit_management_reviews');
        Route::post('update_management_reviews', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'update'])->name('update_management_reviews');
    });
    Route::group(['middleware' => ['can:create_management_reviews']], function () {
        Route::get('create_management_reviews', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'create'])->name('create_management_reviews');
        Route::post('store_management_reviews', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'store'])->name('store_management_reviews');
        Route::post('import_management_reviews', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'ImportIntoCSV'])->name('import_management_reviews');
    });
    Route::group(['middleware' => ['can:delete_management_reviews']], function () {
        Route::get('delete_management_reviews/{id}', [\App\Http\Controllers\Modules\ManagementReviewsController::class, 'delete'])->name('delete_management_reviews');
    });

    //Maintenance List
    Route::group(['middleware' => ['can:read_maintenance_list']], function () {
        Route::get('maintenance_list', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'index'])->name('maintenance_list');
        Route::get('read_maintenance_list/{id}', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'read'])->name('read_maintenance_list');
        Route::get('print_maintenance_list/{id}', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'print'])->name('print_maintenance_list');
        Route::get('email_maintenance_list/{id}', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'email'])->name('email_maintenance_list');
        Route::post('send_email_maintenance_list', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'send_email'])->name('send_email_maintenance_list');
        Route::get('export_maintenance_list', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'ExportIntoCSV'])->name('export_maintenance_list');
    });
    Route::group(['middleware' => ['can:edit_maintenance_list']], function () {
        Route::get('edit_maintenance_list/{id}', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'edit'])->name('edit_maintenance_list');
        Route::post('update_maintenance_list', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'update'])->name('update_maintenance_list');
    });
    Route::group(['middleware' => ['can:create_maintenance_list']], function () {
        Route::get('create_maintenance_list', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'create'])->name('create_maintenance_list');
        Route::post('store_maintenance_list', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'store'])->name('store_maintenance_list');
        Route::post('import_maintenance_list', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'ImportIntoCSV'])->name('import_maintenance_list');
    });
    Route::group(['middleware' => ['can:delete_maintenance_list']], function () {
        Route::get('delete_maintenance_list/{id}', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'delete'])->name('delete_maintenance_list');
    });
    Route::post('/add-maintenance-by', [\App\Http\Controllers\Modules\MaintenanceListController::class, 'addMaintenanceBy']);

    //Qualified Auditors List
    Route::group(['middleware' => ['can:read_qualified_auditors_list']], function () {
        Route::get('qualified_auditors_list', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'index'])->name('qualified_auditors_list');
        Route::get('read_qualified_auditors_list/{id}', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'read'])->name('read_qualified_auditors_list');
        Route::get('print_qualified_auditors_list/{id}', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'print'])->name('print_qualified_auditors_list');
        Route::get('email_qualified_auditors_list/{id}', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'email'])->name('email_qualified_auditors_list');
        Route::post('send_email_qualified_auditors_list', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'send_email'])->name('send_email_qualified_auditors_list');
        Route::get('export_qualified_auditors_list', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'ExportIntoCSV'])->name('export_qualified_auditors_list');
    });

    Route::group(['middleware' => ['can:edit_qualified_auditors_list']], function () {
        Route::get('edit_qualified_auditors_list/{id}', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'edit'])->name('edit_qualified_auditors_list');
        Route::post('update_qualified_auditors_list', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'update'])->name('update_qualified_auditors_list');
    });

    Route::group(['middleware' => ['can:create_qualified_auditors_list']], function () {
        Route::get('create_qualified_auditors_list', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'create'])->name('create_qualified_auditors_list');
        Route::post('store_qualified_auditors_list', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'store'])->name('store_qualified_auditors_list');
        Route::post('import_qualified_auditors_list', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'ImportIntoCSV'])->name('import_qualified_auditors_list');
    });

    Route::group(['middleware' => ['can:delete_qualified_auditors_list']], function () {
        Route::get('delete_qualified_auditors_list/{id}', [\App\Http\Controllers\Modules\QualifiedAuditorsListController::class, 'delete'])->name('delete_qualified_auditors_list');
    });

    //EDRs
    Route::group(['middleware' => ['can:read_edr']], function () {
        Route::get('edrs', [\App\Http\Controllers\Modules\EDRsController::class, 'index'])->name('edrs');
        Route::get('read_edr/{id}', [\App\Http\Controllers\Modules\EDRsController::class, 'read'])->name('read_edr');
        Route::get('print_edr/{id}', [\App\Http\Controllers\Modules\EDRsController::class, 'print'])->name('print_edr');
        Route::get('email_edr/{id}', [\App\Http\Controllers\Modules\EDRsController::class, 'email'])->name('email_edr');
        Route::post('send_email_edr', [\App\Http\Controllers\Modules\EDRsController::class, 'send_email'])->name('send_email_edr');
        Route::get('export_edr', [\App\Http\Controllers\Modules\EDRsController::class, 'ExportIntoCSV'])->name('export_edr');
    });
    Route::group(['middleware' => ['can:edit_edr']], function () {
        Route::get('edit_edr/{id}', [\App\Http\Controllers\Modules\EDRsController::class, 'edit'])->name('edit_edr');
        Route::post('update_edrs', [\App\Http\Controllers\Modules\EDRsController::class, 'update'])->name('update_edrs');
    });
    Route::group(['middleware' => ['can:create_edr']], function () {
        Route::get('create_edrs', [\App\Http\Controllers\Modules\EDRsController::class, 'create'])->name('create_edrs');
        Route::post('store_edrs', [\App\Http\Controllers\Modules\EDRsController::class, 'store'])->name('store_edrs');
        Route::post('import_email_edr', [\App\Http\Controllers\Modules\EDRsController::class, 'ImportIntoCSV'])->name('import_email_edr');
    });
    Route::group(['middleware' => ['can:delete_edr']], function () {
        Route::get('delete_edr/{id}', [\App\Http\Controllers\Modules\EDRsController::class, 'delete'])->name('delete_edr');
    });

    //EFRs
    Route::group(['middleware' => ['can:read_efr']], function () {
        Route::get('efrs', [\App\Http\Controllers\Modules\EFRController::class, 'index'])->name('efrs');
        Route::get('read_efr/{id}', [\App\Http\Controllers\Modules\EFRController::class, 'read'])->name('read_efr');
        Route::get('print_efr/{id}', [\App\Http\Controllers\Modules\EFRController::class, 'print'])->name('print_efr');
        Route::get('email_efr/{id}', [\App\Http\Controllers\Modules\EFRController::class, 'email'])->name('email_efr');
        Route::post('send_email_efr', [\App\Http\Controllers\Modules\EFRController::class, 'send_email'])->name('send_email_efr');
        Route::get('export_efr', [\App\Http\Controllers\Modules\EFRController::class, 'ExportIntoCSV'])->name('export_efr');
    });
    Route::group(['middleware' => ['can:edit_efr']], function () {
        Route::get('edit_efr/{id}', [\App\Http\Controllers\Modules\EFRController::class, 'edit'])->name('edit_efr');
        Route::post('update_efr', [\App\Http\Controllers\Modules\EFRController::class, 'update'])->name('update_efr');
    });
    Route::group(['middleware' => ['can:create_efr']], function () {
        Route::get('create_efr', [\App\Http\Controllers\Modules\EFRController::class, 'create'])->name('create_efr');
        Route::post('store_efr', [\App\Http\Controllers\Modules\EFRController::class, 'store'])->name('store_efr');
        Route::post('import_efr', [\App\Http\Controllers\Modules\EFRController::class, 'ImportIntoCSV'])->name('import_efr');
    });
    Route::group(['middleware' => ['can:delete_efr']], function () {
        Route::get('delete_efr/{id}', [\App\Http\Controllers\Modules\EFRController::class, 'delete'])->name('delete_efr');
    });

    //External Document
    Route::group(['middleware' => ['can:read_external_document']], function () {
        Route::get('external_document', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'index'])->name('external_document');
        Route::get('read_external_document/{id}', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'read'])->name('read_external_document');
        Route::get('print_external_document/{id}', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'print'])->name('print_external_document');
        Route::get('email_external_document/{id}', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'email'])->name('email_external_document');
        Route::post('send_email_external_document', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'send_email'])->name('send_email_external_document');
        Route::get('export_external_document', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'ExportIntoCSV'])->name('export_external_document');
    });
    Route::group(['middleware' => ['can:edit_external_document']], function () {
        Route::get('edit_external_document/{id}', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'edit'])->name('edit_external_document');
        Route::post('update_external_document', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'update'])->name('update_external_document');
    });
    Route::group(['middleware' => ['can:create_external_document']], function () {
        Route::get('create_external_document', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'create'])->name('create_external_document');
        Route::post('store_external_document', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'store'])->name('store_external_document');
        Route::post('import_external_document', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'ImportIntoCSV'])->name('import_external_document');
    });
    Route::group(['middleware' => ['can:delete_external_document']], function () {
        Route::get('delete_external_document/{id}', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'delete'])->name('delete_external_document');
    });
    Route::post('/add-document_type', [\App\Http\Controllers\Modules\ExternalDocumentController::class, 'addDocumentType']);

    //Inspection Reports
    Route::group(['middleware' => ['can:read_inspection_report']], function () {
        Route::get('inspection_reports', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'index'])->name('inspection_reports');
        Route::get('read_inspection_report/{id}', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'read'])->name('read_inspection_report');
        Route::get('print_inspection_report/{id}', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'print'])->name('print_inspection_report');
        Route::get('email_inspection_report/{id}', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'email'])->name('email_inspection_report');
        Route::post('send_email_inspection_report', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'send_email'])->name('send_email_inspection_report');
        Route::get('export_inspection_report', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'ExportIntoCSV'])->name('export_inspection_report');
    });
    Route::group(['middleware' => ['can:edit_inspection_report']], function () {
        Route::get('edit_inspection_report/{id}', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'edit'])->name('edit_inspection_report');
        Route::post('update_inspection_reports', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'update'])->name('update_inspection_reports');
    });
    Route::group(['middleware' => ['can:create_inspection_report']], function () {
        Route::get('create_inspection_reports', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'create'])->name('create_inspection_reports');
        Route::post('store_inspection_reports', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'store'])->name('store_inspection_reports');
        Route::post('import_inspection_reports', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'ImportIntoCSV'])->name('import_inspection_reports');
    });
    Route::group(['middleware' => ['can:delete_inspection_report']], function () {
        Route::get('delete_inspection_report/{id}', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'delete'])->name('delete_inspection_report');
    });
    Route::post('/add-report-type', [\App\Http\Controllers\Modules\InspectionReportsController::class, 'addReportType']);

    //Record Summary
    Route::group(['middleware' => ['can:read_record_summary']], function () {
        Route::get('record_summary', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'index'])->name('record_summary');
        Route::get('read_record_summary/{id}', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'read'])->name('read_record_summary');
        Route::get('print_record_summary/{id}', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'print'])->name('print_record_summary');
        Route::get('email_record_summary/{id}', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'email'])->name('email_record_summary');
        Route::post('send_email_record_summary', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'send_email'])->name('send_email_record_summary');
        Route::get('export_record_summary', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'ExportIntoCSV'])->name('export_record_summary');
    });
    Route::group(['middleware' => ['can:edit_record_summary']], function () {
        Route::get('edit_record_summary/{id}', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'edit'])->name('edit_record_summary');
        Route::post('update_record_summary', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'update'])->name('update_record_summary');
    });
    Route::group(['middleware' => ['can:create_record_summary']], function () {
        Route::post('import_record_summary', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'ImportIntoCSV'])->name('import_record_summary');
        Route::get('create_record_summary', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'create'])->name('create_record_summary');
        Route::post('store_record_summary', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'store'])->name('store_record_summary');
    });
    Route::group(['middleware' => ['can:delete_record_summary']], function () {
        Route::get('delete_record_summary/{id}', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'delete'])->name('delete_record_summary');
    });
    Route::post('/add-location', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'addLocation']);
    Route::post('/add-type', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'addType']);
    Route::post('/add-file_manual_title', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'addFileManualTitle']);
    Route::post('/add-maintained_by', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'addMaintainedBy']);
    Route::post('/add-minimum_retention', [\App\Http\Controllers\Modules\RecordSummaryController::class, 'addMinimumRetention']);

    //HSE
    Route::group(['middleware' => ['can:read_hse']], function () {
        Route::get('hse', [\App\Http\Controllers\Modules\HSEController::class, 'index'])->name('hse');
        Route::get('read_hse/{id}', [\App\Http\Controllers\Modules\HSEController::class, 'read'])->name('read_hse');
        Route::get('print_hse/{id}', [\App\Http\Controllers\Modules\HSEController::class, 'print'])->name('print_hse');
        Route::get('email_hse/{id}', [\App\Http\Controllers\Modules\HSEController::class, 'email'])->name('email_hse');
        Route::post('send_email_hse', [\App\Http\Controllers\Modules\HSEController::class, 'send_email'])->name('send_email_hse');
        Route::get('export_hse', [\App\Http\Controllers\Modules\HSEController::class, 'ExportIntoCSV'])->name('export_hse');
    });
    Route::group(['middleware' => ['can:edit_hse']], function () {
        Route::get('edit_hse/{id}', [\App\Http\Controllers\Modules\HSEController::class, 'edit'])->name('edit_hse');
        Route::post('update_hse', [\App\Http\Controllers\Modules\HSEController::class, 'update'])->name('update_hse');
    });
    Route::group(['middleware' => ['can:create_hse']], function () {
        Route::get('create_hse', [\App\Http\Controllers\Modules\HSEController::class, 'create'])->name('create_hse');
        Route::post('store_hse', [\App\Http\Controllers\Modules\HSEController::class, 'store'])->name('store_hse');
        Route::post('import_hse', [\App\Http\Controllers\Modules\HSEController::class, 'ImportIntoCSV'])->name('import_hse');
    });
    Route::group(['middleware' => ['can:delete_hse']], function () {
        Route::get('delete_hse/{id}', [\App\Http\Controllers\Modules\HSEController::class, 'delete'])->name('delete_hse');
    });

    //First Aid
    Route::get('first_aid', [\App\Http\Controllers\Modules\FirstAidController::class, 'index'])->name('first_aid');
    Route::get('create_first_aid', [\App\Http\Controllers\Modules\FirstAidController::class, 'create'])->name('create_first_aid');
    Route::post('store_first_aid', [\App\Http\Controllers\Modules\FirstAidController::class, 'store'])->name('store_first_aid');
    Route::get('read_first_aid/{id}', [\App\Http\Controllers\Modules\FirstAidController::class, 'read'])->name('read_first_aid');
    Route::get('edit_first_aid/{id}', [\App\Http\Controllers\Modules\FirstAidController::class, 'edit'])->name('edit_first_aid');
    Route::post('update_first_aid', [\App\Http\Controllers\Modules\FirstAidController::class, 'update'])->name('update_first_aid');
    Route::get('delete_first_aid/{id}', [\App\Http\Controllers\Modules\FirstAidController::class, 'delete'])->name('delete_first_aid');
    Route::get('export_first_aid', [\App\Http\Controllers\Modules\FirstAidController::class, 'ExportIntoCSV'])->name('export_first_aid');
    Route::post('import_first_aid', [\App\Http\Controllers\Modules\FirstAidController::class, 'ImportIntoCSV'])->name('import_first_aid');
    Route::get('print_first_aid/{id}', [\App\Http\Controllers\Modules\FirstAidController::class, 'print'])->name('print_first_aid');
    Route::get('email_first_aid/{id}', [\App\Http\Controllers\Modules\FirstAidController::class, 'email'])->name('email_first_aid');
    Route::post('send_email_first_aid', [\App\Http\Controllers\Modules\FirstAidController::class, 'send_email'])->name('send_email_first_aid');

    //MOCRs
    Route::group(['middleware' => ['can:read_mocr']], function () {
        Route::get('mocrs', [\App\Http\Controllers\Modules\MOCRsController::class, 'index'])->name('mocrs');
        Route::get('read_mocr/{id}', [\App\Http\Controllers\Modules\MOCRsController::class, 'read'])->name('read_mocr');
        Route::get('print_mocr/{id}', [\App\Http\Controllers\Modules\MOCRsController::class, 'print'])->name('print_mocr');
        Route::get('email_mocr/{id}', [\App\Http\Controllers\Modules\MOCRsController::class, 'email'])->name('email_mocr');
        Route::post('send_email_mocr', [\App\Http\Controllers\Modules\MOCRsController::class, 'send_email'])->name('send_email_mocr');
        Route::get('export_mocr', [\App\Http\Controllers\Modules\MOCRsController::class, 'ExportIntoCSV'])->name('export_mocr');
    });
    Route::group(['middleware' => ['can:edit_mocr']], function () {
        Route::get('edit_mocr/{id}', [\App\Http\Controllers\Modules\MOCRsController::class, 'edit'])->name('edit_mocr');
        Route::post('update_mocrs', [\App\Http\Controllers\Modules\MOCRsController::class, 'update'])->name('update_mocrs');
    });
    Route::group(['middleware' => ['can:create_mocr']], function () {
        Route::get('create_mocrs', [\App\Http\Controllers\Modules\MOCRsController::class, 'create'])->name('create_mocrs');
        Route::post('store_mocrs', [\App\Http\Controllers\Modules\MOCRsController::class, 'store'])->name('store_mocrs');
        Route::post('import_mocr', [\App\Http\Controllers\Modules\MOCRsController::class, 'ImportIntoCSV'])->name('import_mocr');
    });
    Route::group(['middleware' => ['can:delete_mocr']], function () {
        Route::get('delete_mocr/{id}', [\App\Http\Controllers\Modules\MOCRsController::class, 'delete'])->name('delete_mocr');
    });

    //Permits
    Route::get('permits', [\App\Http\Controllers\Modules\PermitsController::class, 'index'])->name('permits');
    Route::get('create_permit', [\App\Http\Controllers\Modules\PermitsController::class, 'create'])->name('create_permit');
    Route::post('store_permit', [\App\Http\Controllers\Modules\PermitsController::class, 'store'])->name('store_permit');
    Route::get('edit_permit/{id}', [\App\Http\Controllers\Modules\PermitsController::class, 'edit'])->name('edit_permit');
    Route::post('update_permit', [\App\Http\Controllers\Modules\PermitsController::class, 'update'])->name('update_permit');
    Route::get('read_permit/{id}', [\App\Http\Controllers\Modules\PermitsController::class, 'read'])->name('read_permit');
    Route::get('export_permit', [\App\Http\Controllers\Modules\PermitsController::class, 'ExportIntoCSV'])->name('export_permit');
    Route::post('import_permit', [\App\Http\Controllers\Modules\PermitsController::class, 'ImportIntoCSV'])->name('import_permit');
    Route::get('print_permit/{id}', [\App\Http\Controllers\Modules\PermitsController::class, 'print'])->name('print_permit');
    Route::get('email_permit/{id}', [\App\Http\Controllers\Modules\PermitsController::class, 'email'])->name('email_permit');
    Route::post('send_email_permit', [\App\Http\Controllers\Modules\PermitsController::class, 'send_email'])->name('send_email_permit');

    //ECOs
    Route::get('eco', [\App\Http\Controllers\Modules\EcoController::class, 'index'])->name('eco');
    Route::get('create_eco', [\App\Http\Controllers\Modules\EcoController::class, 'create'])->name('create_eco');
    Route::post('store_eco', [\App\Http\Controllers\Modules\EcoController::class, 'store'])->name('store_eco');
    Route::get('edit_eco/{id}', [\App\Http\Controllers\Modules\EcoController::class, 'edit'])->name('edit_eco');
    Route::get('eco/pending_for_approval', [\App\Http\Controllers\Modules\EcoController::class, 'pending_for_approval'])->name('eco_pending_for_approval');
    Route::get('eco/view_eco_for_approval/{id}', [\App\Http\Controllers\Modules\EcoController::class, 'view_eco_for_approval'])->name('view_eco_for_approval');
    Route::post('submit_for_approval', [\App\Http\Controllers\Modules\EcoController::class, 'submit_for_approval'])->name('submit_for_approval');


    /*
     ****************************************************************TRAVEL BOOKING*********************************************************************
     */

    Route::get('create_travel_booking', [\App\Http\Controllers\Travel\TravelBookingController::class, 'create'])->name('create_travel_booking');
    Route::post('store_travel_booking', [\App\Http\Controllers\Travel\TravelBookingController::class, 'store'])->name('store_travel_booking');
    Route::post('get_traveler_details', [\App\Http\Controllers\Travel\TravelBookingController::class, 'getTravelerDetails'])->name('get_traveler_details');
    Route::get('travel_booking', [\App\Http\Controllers\Travel\TravelBookingController::class, 'index'])->name('travel_booking');
    Route::get('edit_travel_booking/{id}', [\App\Http\Controllers\Travel\TravelBookingController::class, 'edit'])->name('edit_travel_booking');
    Route::get('read_travel_booking/{id}', [\App\Http\Controllers\Travel\TravelBookingController::class, 'read'])->name('read_travel_booking');
    Route::get('delete_travel_booking/{id}', [\App\Http\Controllers\Travel\TravelBookingController::class, 'delete'])->name('delete_travel_booking');
    Route::post('update_travel_booking', [\App\Http\Controllers\Travel\TravelBookingController::class, 'update'])->name('update_travel_booking');
    Route::post('delete_travel_booking_attachments', [\App\Http\Controllers\Travel\TravelBookingController::class, 'deleteAttachments'])->name('delete_travel_booking_attachments');

    Route::get('approval_travel_booking/{id}/{status}', [\App\Http\Controllers\Travel\TravelBookingController::class, 'approval'])->name('approval_travel_booking');

    //Travel Reports
    Route::get('/travel-reports/upcoming-travel-calendar', [\App\Http\Controllers\Travel\TravelReportController::class, 'calendarPage'])->name('reports.travel.calendar');
    Route::get('/api/upcoming-travel-events', [\App\Http\Controllers\Travel\TravelReportController::class, 'calendarFeed'])->name('api.reports.travel.events');


    /*
   *******************************************************************Users******************************************************************
   */

    Route::group(['middleware' => ['can:read_user']], function () {
        Route::get('users_list', [\App\Http\Controllers\Users\UsersController::class, 'index'])->name('users_list');

        Route::get('role_list', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'index'])->name('role_list');

        Route::get('user_access_role', [\App\Http\Controllers\Users\UserAccessRoleController::class, 'index'])->name('user_access_role');
    });
    Route::group(['middleware' => ['can:edit_user']], function () {
        Route::get('edit_user/{id}', [\App\Http\Controllers\Users\UsersController::class, 'edit'])->name('edit_user');
        Route::post('update_users', [\App\Http\Controllers\Users\UsersController::class, 'update'])->name('update_users');

        Route::post('edit_role', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'edit'])->name('edit_role');
        Route::post('update_role', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'update'])->name('update_role');

        Route::get('edit_user_access_role/{id}', [\App\Http\Controllers\Users\UserAccessRoleController::class, 'edit'])->name('edit_user_access_role');
        Route::post('update_role_to_user', [\App\Http\Controllers\Users\UserAccessRoleController::class, 'update'])->name('update_role_to_user');
    });
    Route::group(['middleware' => ['can:create_user']], function () {
        Route::post('add_users', [\App\Http\Controllers\Users\UsersController::class, 'store'])->name('add_users');

        Route::post('create_role', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'create'])->name('create_role');

        Route::get('assign_role_to_user', [\App\Http\Controllers\Users\UserAccessRoleController::class, 'create'])->name('assign_role_to_user');
        Route::post('assign_role_to_user', [\App\Http\Controllers\Users\UserAccessRoleController::class, 'store'])->name('assign_role_to_user');
    });
    Route::group(['middleware' => ['can:delete_user']], function () {
        Route::get('delete_user/{id}', [\App\Http\Controllers\Users\UsersController::class, 'delete'])->name('delete_user');

        Route::post('delete_role', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'delete'])->name('delete_role');

        Route::get('delete_user_access_role/{id}', [\App\Http\Controllers\Users\UserAccessRoleController::class, 'delete'])->name('delete_user_access_role');
    });

    Route::get('application_settings', [\App\Http\Controllers\Modules\ApplicationSettingsController::class, 'create'])->name('application_settings');
    Route::post('application_settings', [\App\Http\Controllers\Modules\ApplicationSettingsController::class, 'store'])->name('application_settings');
});

/*
 * Comment these routes when deploy. The routes are only for first time deployment
 * */
Route::get('createDevUser', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'createDevUser'])->name('createDevUser');
Route::get('createPermissions', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'createPermissions'])->name('createPermissions');
Route::get('createSuperAdminRole', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'createSuperAdminRole'])->name('createSuperAdminRole');
Route::get('createSuperAdmin', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'createSuperAdmin'])->name('createSuperAdmin');
Route::get('createVendorSuperAdmin', [\App\Http\Controllers\Users\RolesAndPermissionsController::class, 'createVendorSuperAdmin'])->name('createVendorSuperAdmin');
