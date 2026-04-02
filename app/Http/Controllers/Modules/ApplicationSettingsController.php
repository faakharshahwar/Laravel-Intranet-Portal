<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationSettingsRequest;
use App\Models\ApplicationSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ApplicationSettingsController extends Controller
{
    public function create()
    {
        return view('settings.application_settings');
    }

    public function store(ApplicationSettingsRequest $request)
    {
        $application_name = $request->application_name;
        $logo = $request->logo;

        if ($request->file('favicon')) {
            $file = $request->file('favicon');
            $favicon = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/application_settings';

            // Upload file
            $file->move($location, $favicon);
        }

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $logo = $file->getClientOriginalName();

            // File upload location
            $location = 'uploads/application_settings';

            // Upload file
            $file->move($location, $logo);
        }

        $application_settings = ApplicationSettings::all();

        if (!empty($application_settings)) {
            ApplicationSettings::truncate();
        } else {
            return false;
        }

        $as = ApplicationSettings::updateOrCreate([
            'application_name' => $application_name,
            'favicon' => $favicon,
            'logo' => $logo,
        ]);

        if ($as) {
            session()->flash('success', 'Record has been added successfully');
        } else {
            session()->flash('error', 'Something went wrong!');
        }

        return redirect(route('application_settings'));
    }
}
