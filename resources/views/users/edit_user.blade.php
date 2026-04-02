@extends('layouts.app')

@section('pageTitle')
    Edit User
@endsection

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <div class="container-xxl" id="kt_content_container">
                <div class="card">
                    <div class="card-body p-lg-17">
                        <div class="d-flex flex-column flex-lg-row mb-17">

                            <div class="flex-lg-row-fluid me-0 me-lg-20">
                                @if($errors->any())
                                    <div class="alert alert-outline-danger alert-dismissible fade show" role="alert">
                                        <ul class="list-group">
                                            @foreach($errors->all() as $error)
                                                <li class="list-group-item text-danger">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('update_users') }}" enctype="multipart/form-data"
                                      class="form mb-15" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">

                                    {{-- ============== Identity & Org ============== --}}
                                    <div class="identity">
                                        <h1 class="mb-8">Identity and Organization</h1>

                                        <div class="row mb-8">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Status</label><br>
                                                @php $status = old('status', (string)$user->status); @endphp
                                                <label class="me-4">
                                                    <input type="radio" class="form-check-input me-2" name="status"
                                                           value="1" {{ $status==='1' ? 'checked' : '' }}/>
                                                    Active
                                                </label>
                                                <label>
                                                    <input type="radio" class="form-check-input me-2" name="status"
                                                           value="0" {{ $status==='0' ? 'checked' : '' }}/>
                                                    In-Active
                                                </label>
                                                @error('status')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">First Name</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="first_name"
                                                       value="{{ old('first_name', $user->first_name) }}"/>
                                                @error('first_name')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Last Name</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="last_name"
                                                       value="{{ old('last_name', $user->last_name) }}"/>
                                                @error('last_name')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-12 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Email</label>
                                                <input type="text" class="form-control form-control-solid" name="email"
                                                       value="{{ old('email', $user->email) }}"/>
                                                @error('email')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Password</label>
                                                <input id="password" type="password"
                                                       class="form-control form-control-solid mb-3 mb-lg-0 @error('password') is-invalid @enderror"
                                                       name="password" autocomplete="new-password">
                                                @error('password')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Confirm Password</label>
                                                <input id="password-confirm" type="password"
                                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                                       name="password_confirmation" autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Manager <em>Person to
                                                        Notify</em></label>
                                                @php $personToNotify = (string)old('person_to_notify', (string)$user->person_to_notify); @endphp
                                                <select name="person_to_notify" data-control="select2"
                                                        data-placeholder="Select a person..."
                                                        class="form-select form-select-solid">
                                                    <option value=""></option>
                                                    @foreach($persons_to_notify as $p)
                                                        <option
                                                            value="{{ $p->id }}" {{ $personToNotify===(string)$p->id ? 'selected' : '' }}>
                                                            {{ $p->first_name . ' ' . $p->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('person_to_notify')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Site</label>
                                                @php $siteVal = old('site', $user->site); @endphp
                                                <select name="site" data-control="select2"
                                                        data-placeholder="Select a site..."
                                                        class="form-select form-select-solid">
                                                    <option value=""></option>
                                                    @foreach($siteArr as $site)
                                                        <option
                                                            value="{{ $site }}" {{ $siteVal===$site ? 'selected' : '' }}>{{ $site }}</option>
                                                    @endforeach
                                                </select>
                                                @error('site')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Current Job Title</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="current_job_title"
                                                       value="{{ old('current_job_title', $user->current_job_title) }}"/>
                                                @error('current_job_title')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Department</label>
                                                @php $departmentVal = old('department', $user->department ?? null); @endphp
                                                <select name="department" data-control="select2"
                                                        data-placeholder="Select a department..."
                                                        class="form-select form-select-solid">
                                                    <option value=""></option>
                                                    @foreach($departmentArr as $department)
                                                        <option
                                                            value="{{ $department }}" {{ $departmentVal===$department ? 'selected' : '' }}>
                                                            {{ $department }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('department')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Work Phone</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="work_phone"
                                                       value="{{ old('work_phone', $user->work_phone) }}"/>
                                                @error('work_phone')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">Personal Phone</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="personal_phone"
                                                       value="{{ old('personal_phone', $user->personal_phone) }}"/>
                                                @error('personal_phone')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-12 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Date of Birth</label>
                                                <input type="date" class="form-control form-control-solid"
                                                       name="date_of_birth"
                                                       value="{{ old('date_of_birth', $user->date_of_birth) }}"/>
                                                @error('date_of_birth')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ============== Travel Profile ============== --}}
                                    <div class="mt-10 travel-profile">
                                        <h1 class="mb-8">Travel Profile</h1>

                                        @php
                                            $initCode  = old('home_airport', $employee->home_airport_iata ?? null);
                                            $initLabel = old('home_airport_text', $employee->home_airport_label ?? null);
                                            $nationality = old('nationality', $user->nationality ?? null);

                                            // Arrays with defaults
                                            $residency = old('residency', $user->residency ?? []);
                                            $workPermits = old('work_permits', $user->work_permits ?? []);
                                            $currentVisas = old('current_visas', $user->current_visas ?? []);
                                            $restrictedCountries = old('restricted_countries', $user->restricted_countries ?? []);

                                            // Helper closures
                                            $isSelected = function($needle, $haystack) {
                                                return in_array($needle, (array)$haystack, true) ? 'selected' : '';
                                            };

                                            // Traveler / Loyalty numbers
                                            $oldTraveler = old('traveler_numbers', optional($user->travelerNumbers)->pluck('number')->toArray() ?? []);
                                            $oldLoyalty  = old('loyalty_numbers',  optional($user->loyaltyNumbers)->pluck('number')->toArray() ?? []);
                                        @endphp

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Home Airport</label>

                                                <select class="form-select form-select-solid"
                                                        id="home_airport"
                                                        name="home_airport"
                                                        data-placeholder="Type airport or city..."
                                                        {{-- bind directly from DB/old --}}
                                                        data-init-code="{{ old('home_airport', $user->home_airport) }}"
                                                        data-init-label="{{ old('home_airport_text', $user->home_airport_text) }}"
                                                        style="width:100%">
                                                    @php
                                                        $initCode  = old('home_airport', $user->home_airport);
                                                        $initLabel = old('home_airport_text', $user->home_airport_text);
                                                    @endphp

                                                    @if($initCode)
                                                        <option value="{{ $initCode }}" selected>
                                                            {{ $initLabel ?: $initCode }}
                                                        </option>
                                                    @endif
                                                </select>

                                                <input type="hidden" name="home_airport_text" id="home_airport_text"
                                                       value="{{ $initLabel }}">

                                                @error('home_airport')
                                                <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Nationality</label>
                                                <select class="form-select form-select-lg form-select-solid"
                                                        data-control="select2" data-placeholder="Select an option"
                                                        data-allow-clear="true" name="nationality">
                                                    <option value=""></option>
                                                    @foreach($countriesArr as $c)
                                                        <option
                                                            value="{{ $c }}" {{ $nationality===$c ? 'selected' : '' }}>{{ $c }}</option>
                                                    @endforeach
                                                </select>
                                                @error('nationality')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Residency</label>
                                                <select class="form-select form-select-lg form-select-solid"
                                                        data-control="select2" data-close-on-select="false"
                                                        data-placeholder="Select an option" data-allow-clear="true"
                                                        multiple="multiple" name="residency[]">
                                                    @foreach($countriesArr as $c)
                                                        <option value="{{ $c }}"
                                                            {{ in_array(
                                                                  $c,
                                                                  (array) old('residency', is_string($residency ?? null) ? json_decode($residency, true) : ($residency ?? [])),
                                                                  true
                                                               ) ? 'selected' : '' }}>
                                                            {{ $c }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('residency')
                                                <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Work Permits</label>
                                                <select class="form-select form-select-lg form-select-solid"
                                                        data-control="select2" data-close-on-select="false"
                                                        data-placeholder="Select an option" data-allow-clear="true"
                                                        multiple="multiple" name="work_permits[]">
                                                    @foreach($countriesArr as $c)
                                                        <option value="{{ $c }}"
                                                            {{ in_array(
                                                                  $c,
                                                                  (array) old('work_permits', is_string($workPermits ?? null) ? json_decode($workPermits, true) : ($workPermits ?? [])),
                                                                  true
                                                               ) ? 'selected' : '' }}>
                                                            {{ $c }}
                                                        </option>

                                                    @endforeach
                                                </select>
                                                @error('work_permits')
                                                <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Current Visas</label>
                                                <select class="form-select form-select-lg form-select-solid"
                                                        data-control="select2" data-close-on-select="false"
                                                        data-placeholder="Select an option" data-allow-clear="true"
                                                        multiple="multiple" name="current_visas[]">
                                                    @foreach($countriesArr as $c)
                                                        <option value="{{ $c }}"
                                                            {{ in_array(
                                                                  $c,
                                                                  (array) old('current_visas', is_string($currentVisas ?? null) ? json_decode($currentVisas, true) : ($currentVisas ?? [])),
                                                                  true
                                                               ) ? 'selected' : '' }}>
                                                            {{ $c }}
                                                        </option>

                                                    @endforeach
                                                </select>
                                                @error('current_visas')
                                                <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Valid US Visa</label>
                                                @php $validUsVisa = old('valid_us_visa', $user->valid_us_visa ?? ''); @endphp
                                                <select name="valid_us_visa" data-control="select2"
                                                        data-placeholder="Select an option..."
                                                        class="form-select form-select-solid">
                                                    <option value=""></option>
                                                    <option value="Yes" {{ $validUsVisa==='Yes' ? 'selected' : '' }}>
                                                        Yes
                                                    </option>
                                                    <option value="No" {{ $validUsVisa==='No'  ? 'selected' : '' }}>No
                                                    </option>
                                                </select>
                                                @error('valid_us_visa')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-4 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Passport Number</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="passport_number"
                                                       value="{{ old('passport_number', $user->passport_number ?? '') }}"/>
                                                @error('passport_number')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-4 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Passport Issuing
                                                    Country</label>
                                                @php $issuing = old('passport_issuing_country', $user->passport_issuing_country ?? ''); @endphp
                                                <select class="form-select form-select-lg form-select-solid"
                                                        data-control="select2" data-placeholder="Select an option"
                                                        data-allow-clear="true" name="passport_issuing_country">
                                                    <option value=""></option>
                                                    @foreach($countriesArr as $c)
                                                        <option
                                                            value="{{ $c }}" {{ $issuing===$c ? 'selected' : '' }}>{{ $c }}</option>
                                                    @endforeach
                                                </select>
                                                @error('passport_issuing_country')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-4 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Passport Expiry
                                                    Date</label>
                                                <input type="date" class="form-control form-control-solid"
                                                       name="passport_expiry_date"
                                                       value="{{ old('passport_expiry_date', $user->passport_expiry_date ?? '') }}"/>
                                                @error('passport_expiry_date')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">Known Traveler Numbers</label>
                                                <div id="traveler-numbers">
                                                    @forelse($oldTraveler as $tn)
                                                        <input type="text" name="traveler_numbers[]"
                                                               value="{{ $tn }}"
                                                               class="form-control form-control-solid mb-2">
                                                    @empty
                                                        <input type="text" name="traveler_numbers[]"
                                                               class="form-control form-control-solid mb-2">
                                                    @endforelse
                                                </div>
                                                <button type="button" class="btn btn-sm btn-light-primary mt-2"
                                                        onclick="addTravelerNumber()">+ Add More
                                                </button>
                                            </div>

                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">Flight Loyalty Numbers</label>
                                                <div id="loyalty-numbers">
                                                    @forelse($oldLoyalty as $ln)
                                                        <input type="text" name="loyalty_numbers[]"
                                                               value="{{ $ln }}"
                                                               class="form-control form-control-solid mb-2">
                                                    @empty
                                                        <input type="text" name="loyalty_numbers[]"
                                                               class="form-control form-control-solid mb-2">
                                                    @endforelse
                                                </div>
                                                <button type="button" class="btn btn-sm btn-light-primary mt-2"
                                                        onclick="addLoyaltyNumber()">+ Add More
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Twic card</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="twic_card"
                                                       value="{{ old('twic_card', $user->twic_card ?? '') }}"/>
                                                @error('twic_card')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Safety training
                                                    (List)</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="safety_training_list"
                                                       value="{{ old('safety_training_list', $user->safety_training_list ?? '') }}"/>
                                                @error('safety_training_list')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ============== Safety & Compliance ============== --}}
                                    <div class="mt-10 safety-compliance">
                                        <h1 class="mb-8">Safety & Compliance</h1>

                                        <div class="row mb-5">
                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Emergency Contact
                                                    Name</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="emergency_contact_name"
                                                       value="{{ old('emergency_contact_name', $user->emergency_contact_name ?? '') }}"/>
                                                @error('emergency_contact_name')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Emergency Contact
                                                    Phone</label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="emergency_contact_phone"
                                                       value="{{ old('emergency_contact_phone', $user->emergency_contact_phone ?? '') }}"/>
                                                @error('emergency_contact_phone')
                                                <div class="text-danger small">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col-md-12 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">Restricted Countries</label>
                                                <select class="form-select form-select-lg form-select-solid"
                                                        data-control="select2" data-close-on-select="false"
                                                        data-placeholder="Select an option" data-allow-clear="true"
                                                        multiple="multiple" name="restricted_countries[]">
                                                    @foreach($countriesArr as $c)
                                                        <option value="{{ $c }}"
                                                            {{ in_array(
                                                                  $c,
                                                                  (array) old('restricted_countries', is_string($restrictedCountries ?? null) ? json_decode($restrictedCountries, true) : ($restrictedCountries ?? [])),
                                                                  true
                                                               ) ? 'selected' : '' }}>
                                                            {{ $c }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('restricted_countries')
                                                <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    {{-- ============== Results Area ============== --}}
                                    <div class="mt-10 results-area">
                                        <h1 class="mb-8">Results Area</h1>

                                        @for($i=1; $i<=12; $i++)
                                            @php
                                                $field = "results_area_{$i}";
                                                $val = old($field, $user->{$field} ?? '');
                                            @endphp
                                            @if($i % 2 === 1)
                                                <div class="row mb-5">@endif
                                                    <div class="col-md-6 fv-row">
                                                        <label class="fs-5 fw-semibold mb-2">Results
                                                            Area {{ $i }}</label>
                                                        <select name="{{ $field }}" data-control="select2"
                                                                data-placeholder="Select a department..."
                                                                class="form-select form-select-solid">
                                                            <option value=""></option>
                                                            @foreach($results_areaArr as $opt)
                                                                <option
                                                                    value="{{ $opt }}" {{ $val===$opt ? 'selected' : '' }}>{{ $opt }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error($field)
                                                        <div class="text-danger small">{{ $message }}</div>@enderror
                                                    </div>
                                                    @if($i % 2 === 0)</div>
                                            @endif
                                        @endfor
                                    </div>

                                    <div class="separator mb-8"></div>

                                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                        <span class="indicator-label">Update</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            const $sel = $('#home_airport');

            // If your theme auto-initialized it, kill it first (safe to call even if not inited)
            if ($sel.data('select2')) {
                $sel.select2('destroy');
            }

            const initCode = ($sel.data('init-code') || '').toString().trim();
            const initLabel = ($sel.data('init-label') || '').toString().trim();

            // Ensure the option is present (Blade already added it, but this is belt & suspenders)
            if (initCode && !$sel.find("option[value=\"" + initCode.replace(/"/g, '\\"') + "\"]").length) {
                $sel.append(new Option(initLabel || initCode, initCode, true, true));
            }

            // Initialize Select2
            $sel.select2({
                placeholder: $sel.data('placeholder') || 'Type airport or city...',
                minimumInputLength: 2,
                allowClear: true,
                ajax: {
                    url: '/api/airports/suggest',
                    dataType: 'json',
                    delay: 250,
                    data: params => ({q: params.term, limit: 20, locale: 'en'}),
                    processResults: data => data // already {results:[...]}
                },
                templateSelection: item => item.text || item.id,
                templateResult: item => item.text || ''
            });

            // Set value + sync hidden text right after init
            if (initCode) {
                $sel.val(initCode).trigger('change');
                $('#home_airport_text').val(initLabel || initCode);
            } else {
                $('#home_airport_text').val('');
            }

            // Keep hidden text in sync on user changes
            $sel.on('select2:select', function (e) {
                const item = e.params?.data || {};
                $('#home_airport_text').val(item.text || item.id || '');
            });
            $sel.on('select2:clear', function () {
                $('#home_airport_text').val('');
            });
        });
    </script>

    <script>
        function addTravelerNumber() {
            document.getElementById('traveler-numbers')
                .insertAdjacentHTML('beforeend','<input type="text" name="traveler_numbers[]" class="form-control mb-2">');
        }
        function addLoyaltyNumber() {
            document.getElementById('loyalty-numbers')
                .insertAdjacentHTML('beforeend','<input type="text" name="loyalty_numbers[]" class="form-control mb-2">');
        }
    </script>


@endsection
