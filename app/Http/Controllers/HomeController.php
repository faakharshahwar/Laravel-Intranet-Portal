<?php

namespace App\Http\Controllers;

use App\Models\Modules\CalibratedDevices;
use App\Models\Modules\ContinualImprovementRecords;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $externalLinks = externalLinks();
        $intranetName = "CheckPoint Intranet";

        $cirHeading = "CIRs - Due in 10 Days, Overdue, or No Target Date";

        // Define the current date
        $currentDate = Carbon::now();

        $cirs = ContinualImprovementRecords::where(function ($query) use ($currentDate) {
            $query->where(function ($q) use ($currentDate) {
                // Records due within the next 10 days (not beyond)
                $q->where('target_completion_date', '>=', $currentDate)
                    ->where('target_completion_date', '<=', $currentDate->copy()->addDays(10));
            })
                ->orWhere(function ($q) use ($currentDate) {
                    // Overdue records
                    $q->where('target_completion_date', '<', $currentDate);
                })
                ->orWhereNull('target_completion_date'); // Records with no due date
        })
            ->whereNull('closure_date') // Only records where closure_date is NULL
            ->get();



        $cdHeading = "Calibrated Device - Due in 10 Days, Overdue, or No Due Date";

        $cds = CalibratedDevices::where(function ($query) use ($currentDate) {
            $query->where(function ($q) use ($currentDate) {
                // Records due within the next 10 days (but not beyond)
                $q->where('next_calibration_due_date', '>=', $currentDate)
                    ->where('next_calibration_due_date', '<=', $currentDate->copy()->addDays(10));
            })
                ->orWhere(function ($q) use ($currentDate) {
                    // Overdue records
                    $q->where('next_calibration_due_date', '<', $currentDate);
                })
                ->orWhereNull('next_calibration_due_date');
        })
            ->where('device_status', 'Active')
            ->get();

        return view('home')
            ->with('externalLinks', $externalLinks)
            ->with('intranetName', $intranetName)
            ->with('cirHeading', $cirHeading)
            ->with('cirs', $cirs)
            ->with('cdHeading', $cdHeading)
            ->with('cds', $cds);
    }
}
