<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('users.users_list')->with('users', $users);
    }

    public function store(UsersRequest $request)
    {
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'status' => $request['status'],
            'dev_user' => 1,
        ]);

        session()->flash('success', 'User created successfully. Please complete the employee details and assign a role to activate the account.');

        // redirect to edit page with the created user's id
        return redirect()->route('edit_user', ['id' => $user->id]);
    }


    public function edit($id)
    {
        $allUsers = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        $options = dynamicOptions();
        $siteArr = $options['site'];
        $departmentArr = $options['department'];
        $results_areaArr = $options['results_area'];
        $countriesArr = $options['countries'];

        $users = $allUsers->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        $user = User::find($id);

        $initCode = $user->home_airport ?? '';
        $initLabel = $user->home_airport_text ?? '';

        return view('users.edit_user')
            ->with('user', $user)
            ->with('persons_to_notify', $users)
            ->with('siteArr', $siteArr)
            ->with('departmentArr', $departmentArr)
            ->with('countriesArr', $countriesArr)
            ->with('results_areaArr', $results_areaArr)
            ->with('initCode', $initCode)
            ->with('initLabel', $initLabel);
    }


    public function update(EditUserRequest $request)
    {
        $id = $request->id;
        $status = $request['status'];

        $getUser = User::findOrFail($id);
        $user_role_id = $getUser->roles()->pluck('id');
        $checkRoleAssigned = count($user_role_id) > 0;

        if ($checkRoleAssigned == false && $status == '1') {
            session()->flash('error', 'Assign role to activate the user');
            return redirect(route('users_list'));
        }

        try {
            DB::transaction(function () use ($request, $getUser, $status) {
                // build update data for users table
                $userData = [
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'status' => $status,
                    'person_to_notify' => $request->input('person_to_notify'),
                    'site' => $request->input('site'),
                    'current_job_title' => $request->input('current_job_title'),
                    'department' => $request->input('department'),
                    'work_phone' => $request->input('work_phone'),
                    'personal_phone' => $request->input('personal_phone'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'home_airport' => $request->input('home_airport'),
                    'home_airport_text' => $request->input('home_airport_text'),
                    'nationality' => $request->input('nationality'),
                    'residency' => $request->input('residency'),
                    'work_permits' => $request->input('work_permits'),
                    'current_visas' => $request->input('current_visas'),
                    'valid_us_visa' => $request->input('valid_us_visa'),
                    'passport_number' => $request->input('passport_number'),
                    'passport_issuing_country' => $request->input('passport_issuing_country'),
                    'passport_expiry_date' => $request->input('passport_expiry_date'),
                    'twic_card' => $request->input('twic_card'),
                    'safety_training_list' => $request->input('safety_training_list'),
                    'emergency_contact_name' => $request->input('emergency_contact_name'),
                    'emergency_contact_phone' => $request->input('emergency_contact_phone'),
                    'restricted_countries' => $request->input('restricted_countries'),
                    'results_area_1' => $request->input('results_area_1'),
                    'results_area_2' => $request->input('results_area_2'),
                    'results_area_3' => $request->input('results_area_3'),
                    'results_area_4' => $request->input('results_area_4'),
                    'results_area_5' => $request->input('results_area_5'),
                    'results_area_6' => $request->input('results_area_6'),
                    'results_area_7' => $request->input('results_area_7'),
                    'results_area_8' => $request->input('results_area_8'),
                    'results_area_9' => $request->input('results_area_9'),
                    'results_area_10' => $request->input('results_area_10'),
                    'results_area_11' => $request->input('results_area_11'),
                    'results_area_12' => $request->input('results_area_12'),
                    'dev_user' => 0,
                ];

                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->input('password'));
                }

                // update user row
                $getUser->update($userData);

                // --- Sync Known Traveler Numbers ---
                $getUser->travelerNumbers()->delete();
                if ($request->has('traveler_numbers')) {
                    foreach ($request->input('traveler_numbers') as $num) {
                        if (!empty($num)) {
                            $getUser->travelerNumbers()->create(['number' => $num]);
                        }
                    }
                }

                // --- Sync Flight Loyalty Numbers ---
                $getUser->loyaltyNumbers()->delete();
                if ($request->has('loyalty_numbers')) {
                    foreach ($request->input('loyalty_numbers') as $num) {
                        if (!empty($num)) {
                            $getUser->loyaltyNumbers()->create(['number' => $num]);
                        }
                    }
                }
            });

            session()->flash('success', 'User has been updated successfully');
        } catch (\Throwable $e) {
            report($e);
            session()->flash('error', 'Sorry! Something went wrong!');
        }

        return redirect(route('users_list'));
    }


    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        session()->flash('success', 'User has been deleted successfully');
        return redirect(route('users_list'));
    }
}
