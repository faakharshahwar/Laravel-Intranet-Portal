<?php

namespace App\Http\Controllers\Modules;

use App\Exports\CustomerSatisfactionRecordsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerSatisfactionRecordsRequest;
use App\Imports\CustomerSatisfactionReportImport;
use App\Mail\CustomerSatisfactionRecordsMail;
use App\Models\Modules\CustomerSatisfactionRecords;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class CustomerSatisfactionRecordsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = CustomerSatisfactionRecords::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $csrs = $query->get();

        return view('modules.customer_satisfaction_records.customer_satisfaction_records')
            ->with('csrs', $csrs)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $ratingArr = $options['rating'];

        return view('modules.customer_satisfaction_records.create_customer_satisfaction_records')->with('siteArr', $siteArr)
            ->with('ratingArr', $ratingArr);
    }

    public function store(CustomerSatisfactionRecordsRequest $request)
    {
        $date_data_collected = $request->date_data_collected;
        $customer_company_name = $request->customer_company_name;
        $customer_contact = $request->customer_contact;
        $customer_location = $request->customer_location;
        $contact_phone = $request->contact_phone;
        $contact_email_address = $request->contact_email_address;
        $site_representative = $request->site_representative;
        $site = $request->site;
        $customer_service_assistance = $request->customer_service_assistance;
        $quality_of_product = $request->quality_of_product;
        $performance_vs_expectation = $request->performance_vs_expectation;
        $on_time_shipment = $request->on_time_shipment;
        $permission = $request->permission;
        $like_a_sales_rep = $request->like_a_sales_rep;
        $comments = $request->comments;
        $cfr_no = $request->cfr_no;
        $sales_note = $request->sales_note;

        // Get next global CSR running number (across ALL sites)
        $maxNumeric = CustomerSatisfactionRecords::pluck('csr_id')
            ->map(function ($id) {
                // Example: CSR-CPLA-0002 → 2
                return (int) substr($id, strrpos($id, '-') + 1);
            })
            ->max();

        $nextNumber = ($maxNumeric ?? 0) + 1;
        $maxValueNCR = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "CSR-CPCP-",
            "CPAE - Dubai"            => "CSR-CPAE-",
            "CPLA - Mandeville"       => "CSR-CPLA-",
            "CPTX - West Texas"       => "CSR-CPTX-",
            "CPUK - Aberdeen"         => "CSR-CPUK-",
        ];

        $csrPrefix = $prefixMap[$site] ?? "CSR-";
        $csr_id = $csrPrefix . $maxValueNCR;

        $csr = CustomerSatisfactionRecords::create([
            'csr_id' => $csr_id,
            'date_data_collected' => $date_data_collected,
            'customer_company_name' => $customer_company_name,
            'customer_contact' => $customer_contact,
            'customer_location' => $customer_location,
            'contact_phone' => $contact_phone,
            'contact_email_address' => $contact_email_address,
            'site_representative' => $site_representative,
            'site' => $site,
            'customer_service_assistance' => $customer_service_assistance,
            'quality_of_product' => $quality_of_product,
            'performance_vs_expectation' => $performance_vs_expectation,
            'on_time_shipment' => $on_time_shipment,
            'permission' => $permission,
            'like_a_sales_rep' => $like_a_sales_rep,
            'comments' => $comments,
            'cfr_no' => $cfr_no,
            'sales_note' => $sales_note,
        ]);

        if ($csr) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('customer_satisfaction_records'));
    }

    public function read($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $ratingArr = $options['rating'];

        $csr = CustomerSatisfactionRecords::find($id);

        return view('modules.customer_satisfaction_records.read_customer_satisfaction_records')
            ->with('siteArr', $siteArr)->with('ratingArr', $ratingArr)->with('csr', $csr);
    }

    public function edit($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $ratingArr = $options['rating'];

        $csr = CustomerSatisfactionRecords::find($id);

        return view('modules.customer_satisfaction_records.edit_customer_satisfaction_records')
            ->with('siteArr', $siteArr)->with('ratingArr', $ratingArr)->with('csr', $csr);
    }

    public function update(CustomerSatisfactionRecordsRequest $request)
    {
        $id = $request->id;
        $csr_id = $request->csr_id;
        $date_data_collected = $request->date_data_collected;
        $customer_company_name = $request->customer_company_name;
        $customer_contact = $request->customer_contact;
        $customer_location = $request->customer_location;
        $contact_phone = $request->contact_phone;
        $contact_email_address = $request->contact_email_address;
        $site_representative = $request->site_representative;
        $site = $request->site;
        $customer_service_assistance = $request->customer_service_assistance;
        $quality_of_product = $request->quality_of_product;
        $performance_vs_expectation = $request->performance_vs_expectation;
        $on_time_shipment = $request->on_time_shipment;
        $permission = $request->permission;
        $like_a_sales_rep = $request->like_a_sales_rep;
        $comments = $request->comments;
        $cfr_no = $request->cfr_no;
        $sales_note = $request->sales_note;

        // Keep SAME running number, only update prefix based on site
        $numericPart = substr($csr_id, strrpos($csr_id, '-') + 1); // e.g. "0007"
        $numericPart = str_pad((int)$numericPart, 4, '0', STR_PAD_LEFT);

        $prefixMap = [
            "Applicable to All Sites" => "CSR-CPCP-",
            "CPAE - Dubai"            => "CSR-CPAE-",
            "CPLA - Mandeville"       => "CSR-CPLA-",
            "CPTX - West Texas"       => "CSR-CPTX-",
            "CPUK - Aberdeen"         => "CSR-CPUK-",
        ];

        $csrPrefix = $prefixMap[$site] ?? "CSR-";
        $csr_id = $csrPrefix . $numericPart;

        $csr = DB::table('customer_satisfaction_records')
            ->where('id', $id)
            ->update([
                'csr_id' => $csr_id,
                'date_data_collected' => $date_data_collected,
                'customer_company_name' => $customer_company_name,
                'customer_contact' => $customer_contact,
                'customer_location' => $customer_location,
                'contact_phone' => $contact_phone,
                'contact_email_address' => $contact_email_address,
                'site_representative' => $site_representative,
                'site' => $site,
                'customer_service_assistance' => $customer_service_assistance,
                'quality_of_product' => $quality_of_product,
                'performance_vs_expectation' => $performance_vs_expectation,
                'on_time_shipment' => $on_time_shipment,
                'permission' => $permission,
                'like_a_sales_rep' => $like_a_sales_rep,
                'comments' => $comments,
                'cfr_no' => $cfr_no,
                'sales_note' => $sales_note,
            ]);

        if ($csr) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('customer_satisfaction_records'));
    }

    public function delete($id)
    {
        $csr = CustomerSatisfactionRecords::find($id);
        $csrDel = $csr->delete();

        if ($csrDel) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
        return redirect(route('customer_satisfaction_records'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new CustomerSatisfactionRecordsExport(), 'customer_satisfaction_records.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        if ($request->file('attachment_csv_file')) {

            $path = $request->file('attachment_csv_file');
            Excel::import(new CustomerSatisfactionReportImport(), $path);

            session()->flash('success', 'Record has been imported successfully');

        } else {
            session()->flash('error', 'Sorry! Something went wrong.');
        }
        return redirect(route('customer_satisfaction_records'));
    }

    public function print($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $ratingArr = $options['rating'];

        $csr = CustomerSatisfactionRecords::find($id);

        return view('modules.customer_satisfaction_records.print_customer_satisfaction_records')
            ->with('siteArr', $siteArr)->with('ratingArr', $ratingArr)->with('csr', $csr);
    }

    public function email($id)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $ratingArr = $options['rating'];

        $csr = CustomerSatisfactionRecords::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.customer_satisfaction_records.mail_customer_satisfaction_records')
            ->with('siteArr', $siteArr)->with('ratingArr', $ratingArr)->with('csr', $csr)->with('users', $users);
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

        $csr = CustomerSatisfactionRecords::find($id);

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'csr_id' => $csr->cfr_id,
            'date_data_collected' => $csr->date_data_collected,
            'customer_company_name' => $csr->customer_company_name,
            'customer_contact' => $csr->customer_contact,
            'customer_location' => $csr->customer_location,
            'contact_phone' => $csr->contact_phone,
            'contact_email_address' => $csr->contact_email_address,
            'site_representative' => $csr->site_representative,
            'site' => $csr->site,
            'customer_service_assistance' => $csr->customer_service_assistance,
            'quality_of_product' => $csr->quality_of_product,
            'performance_vs_expectation' => $csr->performance_vs_expectation,
            'on_time_shipment' => $csr->on_time_shipment,
            'permission' => $csr->permission,
            'like_a_sales_rep' => $csr->like_a_sales_rep,
            'comments' => $csr->comments,
            'cfr_no' => $csr->cfr_no,
            'sales_note' => $csr->sales_note,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new CustomerSatisfactionRecordsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('customer_satisfaction_records'));

    }
}
