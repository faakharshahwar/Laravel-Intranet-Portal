<?php

namespace App\Http\Controllers\Modules;

use App\Exports\ManagementReviewsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementReviewsRequest;
use App\Imports\ManagementReviewsImport;
use App\Mail\ManagementReviewsMail;
use App\Models\Modules\ManagementReviews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Helpers\FilterHelper;

class ManagementReviewsController extends Controller
{
    public function index(Request $request)
    {
        $options = dynamicOptions();
        $siteArr = $options['site'];
        $query = ManagementReviews::orderBy('id', 'desc');
        $query = FilterHelper::filterBySite($query, $request);
        $management_reviews = $query->get();

        return view('modules.management_reviews.management_reviews')
            ->with('management_reviews', $management_reviews)
            ->with('siteArr', $siteArr)
            ->with('selectedSite', $request->query('site'));
    }

    public function create()
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $statusArr = $options['status'];

        return view('modules.management_reviews.create_management_reviews')
            ->with('siteArr', $siteArr)
            ->with('statusArr', $statusArr);
    }

    public function store(ManagementReviewsRequest $request)
    {
        $date_of_management_review = $request->date_of_management_review;
        $site = $request->site;
        $status = $request->status;
        $comments = $request->comments;

        if ($request->file('agenda')) {
            $file = $request->file('agenda');
            $agenda = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $agenda);
        } else {
            $agenda = '';
        }

        if ($request->file('minutes_attachment')) {
            $file = $request->file('minutes_attachment');
            $minutes_attachment = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $minutes_attachment);
        } else {
            $minutes_attachment = '';
        }

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $attachment_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $attachment_1);
        } else {
            $attachment_1 = '';
        }

        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $attachment_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $attachment_2);
        } else {
            $attachment_2 = '';
        }

        if ($request->file('attachment_3')) {
            $file = $request->file('attachment_3');
            $attachment_3 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $attachment_3);
        } else {
            $attachment_3 = '';
        }

        $management_reviews = ManagementReviews::create([
            'date_of_management_review' => $date_of_management_review,
            'site' => $site,
            'status' => $status,
            'agenda' => $agenda,
            'minutes_attachment' => $minutes_attachment,
            'attachment_1' => $attachment_1,
            'attachment_2' => $attachment_2,
            'attachment_3' => $attachment_3,
            'comments' => $comments,
        ]);

        if ($management_reviews) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('management_reviews'));
    }

    public function read($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $statusArr = $options['status'];

        $management_reviews = ManagementReviews::find($id);

        return view('modules.management_reviews.read_management_reviews')
            ->with('siteArr', $siteArr)
            ->with('statusArr', $statusArr)
            ->with('management_reviews', $management_reviews);
    }

    public function edit($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $statusArr = $options['status'];

        $management_reviews = ManagementReviews::find($id);

        return view('modules.management_reviews.edit_management_reviews')
            ->with('siteArr', $siteArr)
            ->with('statusArr', $statusArr)
            ->with('management_reviews', $management_reviews);
    }

    public function update(ManagementReviewsRequest $request)
    {
        $id = $request->id;
        $date_of_management_review = $request->date_of_management_review;
        $site = $request->site;
        $status = $request->status;
        $comments = $request->comments;

        if ($request->file('agenda')) {
            $file = $request->file('agenda');
            $agenda = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $agenda);
        } else {
            $agenda = $request->old_agenda;
        }

        if ($request->file('minutes_attachment')) {
            $file = $request->file('minutes_attachment');
            $minutes_attachment = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $minutes_attachment);
        } else {
            $minutes_attachment = $request->old_minutes_attachment;
        }

        if ($request->file('attachment_1')) {
            $file = $request->file('attachment_1');
            $attachment_1 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $attachment_1);
        } else {
            $attachment_1 = $request->old_attachment_1;
        }

        if ($request->file('attachment_2')) {
            $file = $request->file('attachment_2');
            $attachment_2 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $attachment_2);
        } else {
            $attachment_2 = $request->old_attachment_2;
        }

        if ($request->file('attachment_3')) {
            $file = $request->file('attachment_3');
            $attachment_3 = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/management_reviews';

            // Upload file
            $file->move($location, $attachment_3);
        } else {
            $attachment_3 = $request->old_attachment_3;
        }

        $management_reviews = DB::table('management_reviews')
            ->where('id', $id)
            ->update([
                'date_of_management_review' => $date_of_management_review,
                'site' => $site,
                'status' => $status,
                'agenda' => $agenda,
                'minutes_attachment' => $minutes_attachment,
                'attachment_1' => $attachment_1,
                'attachment_2' => $attachment_2,
                'attachment_3' => $attachment_3,
                'comments' => $comments,
            ]);

        if ($management_reviews) {
            session()->flash('success', 'Record has been updated successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('management_reviews'));
    }

    public function delete($id)
    {
        $management_reviews = ManagementReviews::find($id);
        $management_reviews_del = $management_reviews->delete();

        if ($management_reviews_del) {
            session()->flash('success', 'Record has been deleted successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('management_reviews'));
    }

    public function ExportIntoCSV()
    {
        return Excel::download(new ManagementReviewsExport(), 'ManagementReviews.csv');
    }

    public function ImportIntoCSV(Request $request)
    {
        $validated = $request->validate([
            'attachment_csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validated) {
            if ($request->file('attachment_csv_file')) {

                $path = $request->file('attachment_csv_file');
                Excel::import(new ManagementReviewsImport, $path);

                session()->flash('success', 'Record has been imported successfully');
                return redirect(route('management_reviews'));

            } else {
                session()->flash('error', 'Sorry! Something went wrong.');

                return redirect(route('management_reviews'));
            }
        }
        session()->flash('error', 'Sorry! Something went wrong.');

        return redirect(route('management_reviews'));
    }

    public function print($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $statusArr = $options['status'];

        $management_reviews = ManagementReviews::find($id);

        return view('modules.management_reviews.print_management_reviews')
            ->with('siteArr', $siteArr)
            ->with('statusArr', $statusArr)
            ->with('management_reviews', $management_reviews);
    }

    public function email($id)
    {
        $options = dynamicOptions();

        $siteArr = $options['site'];
        $statusArr = $options['status'];

        $management_reviews = ManagementReviews::find($id);

        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('modules.management_reviews.mail_management_reviews')
            ->with('siteArr', $siteArr)
            ->with('statusArr', $statusArr)
            ->with('users', $users)
            ->with('management_reviews', $management_reviews);
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
        $management_reviews = ManagementReviews::find($id);

        $base_url = $site_urlArr['base_url'];
        $personal_message = $request->personal_message;

        $mailData = [
            'personal_message' => $personal_message,
            'base_url' => $base_url,
            'date_of_management_review' => $management_reviews->date_of_management_review,
            'site' => $management_reviews->site,
            'status' => $management_reviews->status,
            'agenda' => $management_reviews->agenda,
            'minutes_attachment' => $management_reviews->minutes_attachment,
            'attachment_1' => $management_reviews->attachment_1,
            'attachment_2' => $management_reviews->attachment_2,
            'attachment_3' => $management_reviews->attachment_3,
            'comments' => $management_reviews->comments,
        ];

        foreach ($validatedData['recipient'] as $email) {
            Mail::to($email)->send(new ManagementReviewsMail($mailData));
        }

        session()->flash('success', 'Mail has been sent successfully');

        return redirect(route('management_reviews'));
    }
}
