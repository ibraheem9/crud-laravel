<form id="customer_form" method="POST"
      action="{{ $customer ? route('developer.advancedCrud.update') : route('developer.advancedCrud.store') }}"
      data-after="{{ route('developer.advancedCrud.index') }}" enctype="multipart/form-data">
    @csrf
    <input value="{{ $customer ? $customer->id : 0 }}" name="customer_id" type="hidden"/>

    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

        {{-- ═══════════════════════════════════════════════════════════
             SECTION: PROFILE IMAGE (Metronic KT Image Input)
        ═══════════════════════════════════════════════════════════ --}}
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title"><h2>Profile Image</h2></div>
            </div>
            <div class="card-body text-center pt-0">
                <div class="image-input image-input-outline" data-kt-image-input="true"
                     style="background-image: url('{{ asset('cpanel/media/svg/avatars/blank.svg') }}')">
                    <div class="image-input-wrapper w-150px h-150px"
                         style="background-image: url('{{ $customer && $customer->img ? $customer->img_url : asset('cpanel/media/svg/avatars/blank.svg') }}')"></div>
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                           data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <input type="file" name="img" accept=".png,.jpg,.jpeg,.webp"/>
                        <input type="hidden" name="img_remove"/>
                    </label>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                          data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                          data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                </div>
                <div class="text-muted fs-7 mt-5">Set the customer profile image. Only *.png, *.jpg and *.jpeg files are accepted.</div>
                <div class="_laravel_error text-danger mt-1" data-error="img"></div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════
             SECTION 1: TEXT INPUTS
        ═══════════════════════════════════════════════════════════ --}}
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title"><h2>Text Inputs</h2></div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    {{-- Text Input --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Full Name <code>type="text"</code></label>
                            <input value="{{ $customer ? $customer->name : '' }}" name="name" type="text"
                                   class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Enter full name"/>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Email Input --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Email <code>type="email"</code></label>
                            <input value="{{ $customer ? $customer->email : '' }}" name="email" type="email"
                                   class="form-control form-control-solid mb-3 mb-lg-0 email_mask" placeholder="example@domain.com"/>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Password with Toggle --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="{{ $customer ? '' : 'required' }} fw-bold fs-6 mb-2">Password <code>type="password"</code></label>
                            <div class="input-group input-group-solid">
                                <input class="form-control form-control-solid" type="password" name="password" autocomplete="new-password"
                                       placeholder="{{ $customer ? 'Leave empty to keep' : 'Min 8 characters' }}"/>
                                <span class="input-group-text cursor-pointer" onclick="togglePassword(this)">
                                    <i class="bi bi-eye fs-4"></i>
                                </span>
                            </div>
                            <div class="form-text">Password with show/hide toggle button.</div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Phone / Tel --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Mobile <code>type="tel"</code></label>
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><i class="bi bi-phone fs-4"></i></span>
                                <input value="{{ $customer ? $customer->mobile : '' }}" name="mobile" type="tel"
                                       class="form-control form-control-solid" placeholder="05x-xxx-xxxx"/>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Civil ID --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Civil ID <code>input-group</code></label>
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><i class="bi bi-credit-card-2-front fs-4"></i></span>
                                <input value="{{ $customer ? $customer->civil_id : '' }}" name="civil_id" type="text"
                                       class="form-control form-control-solid" placeholder="Enter ID number"/>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Input with Prefix Text --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Passport No <code>input-group prefix</code></label>
                            <div class="input-group input-group-solid">
                                <span class="input-group-text">PP</span>
                                <input value="{{ $customer ? $customer->passport_no : '' }}" name="passport_no" type="text"
                                       class="form-control form-control-solid" placeholder="Enter passport number"/>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Textarea --}}
                    <div class="col-md-8">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Address <code>textarea</code></label>
                            <textarea name="address" class="form-control form-control-solid mb-3 mb-lg-0" rows="3"
                                      placeholder="Enter full address...">{{ $customer ? $customer->address : '' }}</textarea>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Text with Helper Text --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Profession <code>with helper text</code></label>
                            <input value="{{ $customer ? $customer->profession : '' }}" name="profession" type="text"
                                   class="form-control form-control-solid mb-3 mb-lg-0" placeholder="e.g. Software Engineer"/>
                            <div class="form-text">This is a helper text below the input.</div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════
             SECTION 2: SELECT & DROPDOWNS
        ═══════════════════════════════════════════════════════════ --}}
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title"><h2>Select & Dropdowns</h2></div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    {{-- Basic Select --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Type <code>select</code></label>
                            <select name="type" class="form-select form-select-solid">
                                <option value="">-- Select --</option>
                                <option @if($customer && $customer->type == 'customer') selected @endif value="customer">Customer</option>
                                <option @if($customer && $customer->type == 'guardian') selected @endif value="guardian">Guardian</option>
                            </select>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Select2 Single --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Country <code>Select2</code></label>
                            <select name="country" class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Search country...">
                                <option value=""></option>
                                <option value="AE">United Arab Emirates</option>
                                <option value="SA">Saudi Arabia</option>
                                <option value="KW">Kuwait</option>
                                <option value="QA">Qatar</option>
                                <option value="BH">Bahrain</option>
                                <option value="OM">Oman</option>
                                <option value="JO">Jordan</option>
                                <option value="EG">Egypt</option>
                                <option value="US">United States</option>
                                <option value="GB">United Kingdom</option>
                            </select>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Select2 Multiple --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Skills <code>Select2 multiple</code></label>
                            <select name="skills[]" class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Select skills..." multiple>
                                <option value="php">PHP</option>
                                <option value="laravel">Laravel</option>
                                <option value="javascript">JavaScript</option>
                                <option value="vue">Vue.js</option>
                                <option value="react">React</option>
                                <option value="mysql">MySQL</option>
                                <option value="css">CSS/Tailwind</option>
                            </select>
                            <div class="form-text">Multi-select with Select2 search.</div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════
             SECTION 3: DATE & TIME
        ═══════════════════════════════════════════════════════════ --}}
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title"><h2>Date & Time Pickers</h2></div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    {{-- Date Picker --}}
                    <div class="col-md-3">
                        <div class="_input_group fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Date of Birth <code>date_picker</code></label>
                            <input value="{{ $customer ? $customer->dob?->format('Y-m-d') : '' }}" name="dob" type="text"
                                   class="form-control form-control-solid date_picker" placeholder="YYYY-MM-DD"/>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Time Picker --}}
                    <div class="col-md-3">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Appointment Time <code>time_picker</code></label>
                            <input name="appointment_time" type="text"
                                   class="form-control form-control-solid time_picker" placeholder="HH:MM"/>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- DateTime Picker --}}
                    <div class="col-md-3">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Start DateTime <code>datetime_picker</code></label>
                            <input name="start_datetime" type="text"
                                   class="form-control form-control-solid datetime_picker" placeholder="YYYY-MM-DD HH:MM"/>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Date Range --}}
                    <div class="col-md-3">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Date Range <code>date_range</code></label>
                            <input name="date_range" type="text"
                                   class="form-control form-control-solid date_range_picker" placeholder="From — To"/>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════
             SECTION 4: TOGGLES, RADIOS & CHECKBOXES
        ═══════════════════════════════════════════════════════════ --}}
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title"><h2>Toggles, Radios & Checkboxes</h2></div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    {{-- Radio Buttons --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Gender <code>radio</code></label>
                            <div class="d-flex gap-5 mt-2">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input @if($customer && $customer->gender == 'male') checked @endif
                                           name="gender" class="form-check-input" type="radio" value="male" id="gender_male"/>
                                    <label class="form-check-label" for="gender_male">Male</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input @if($customer && $customer->gender == 'female') checked @endif
                                           name="gender" class="form-check-input" type="radio" value="female" id="gender_female"/>
                                    <label class="form-check-label" for="gender_female">Female</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input @if($customer && $customer->gender == 'other') checked @endif
                                           name="gender" class="form-check-input" type="radio" value="other" id="gender_other"/>
                                    <label class="form-check-label" for="gender_other">Other</label>
                                </div>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Switch Toggles --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Status Switches <code>switch</code></label>
                            <div class="d-flex flex-column gap-3 mt-2">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input name="is_vip" type="hidden" value="0"/>
                                    <input @if($customer && $customer->is_vip) checked @endif
                                           name="is_vip" class="form-check-input h-20px w-30px" type="checkbox" value="1" id="sw_vip"/>
                                    <label class="form-check-label" for="sw_vip">VIP Member</label>
                                </div>
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input name="banned_at" type="hidden" value="0"/>
                                    <input @if($customer && $customer->banned_at) checked @endif
                                           name="banned_at" class="form-check-input h-20px w-30px" type="checkbox" value="1" id="sw_banned"/>
                                    <label class="form-check-label" for="sw_banned">Banned</label>
                                </div>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Checkboxes --}}
                    <div class="col-md-4">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Notifications <code>checkbox</code></label>
                            <div class="d-flex flex-column gap-3 mt-2">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input name="notify_email" class="form-check-input" type="checkbox" value="1" id="cb_email" checked/>
                                    <label class="form-check-label" for="cb_email">Email Notifications</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input name="notify_sms" class="form-check-input" type="checkbox" value="1" id="cb_sms"/>
                                    <label class="form-check-label" for="cb_sms">SMS Notifications</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input name="notify_push" class="form-check-input" type="checkbox" value="1" id="cb_push"/>
                                    <label class="form-check-label" for="cb_push">Push Notifications</label>
                                </div>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════
             SECTION 5: SPECIAL INPUTS
        ═══════════════════════════════════════════════════════════ --}}
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title"><h2>Special Inputs</h2></div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    {{-- Color Picker --}}
                    <div class="col-md-3">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Favorite Color <code>type="color"</code></label>
                            <div class="d-flex align-items-center gap-3">
                                <input value="{{ $customer ? $customer->color : '#3b82f6' }}" name="color" type="color"
                                       class="form-control form-control-color" id="color_input"
                                       style="width:50px;height:40px;border-radius:8px;cursor:pointer;"/>
                                <span class="text-muted fs-7 fw-bold font-monospace" id="color_hex_display">
                                    {{ $customer ? $customer->color : '#3b82f6' }}
                                </span>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Range Slider --}}
                    <div class="col-md-3">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Rating <code>type="range"</code></label>
                            <div class="d-flex align-items-center gap-3">
                                <input name="rating" type="range" class="form-range flex-grow-1" min="0" max="100" value="50"
                                       id="rating_range" oninput="document.getElementById('rating_val').textContent=this.value"/>
                                <span class="badge badge-primary" id="rating_val" style="min-width:36px;">50</span>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- Number with Stepper --}}
                    <div class="col-md-3">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Quantity <code>type="number"</code></label>
                            <div class="input-group input-group-solid">
                                <button class="btn btn-icon btn-active-color-primary" type="button"
                                        onclick="stepNumber('qty_input', -1)">
                                    <i class="bi bi-dash-lg fs-3"></i>
                                </button>
                                <input name="quantity" type="number" class="form-control form-control-solid text-center" id="qty_input"
                                       value="1" min="0" max="999"/>
                                <button class="btn btn-icon btn-active-color-primary" type="button"
                                        onclick="stepNumber('qty_input', 1)">
                                    <i class="bi bi-plus-lg fs-3"></i>
                                </button>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>

                    {{-- URL Input --}}
                    <div class="col-md-3">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Website <code>type="url"</code></label>
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><i class="bi bi-globe fs-4"></i></span>
                                <input name="website" type="url" class="form-control form-control-solid" placeholder="https://example.com"/>
                            </div>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════
             SECTION 6: FILE UPLOADS
        ═══════════════════════════════════════════════════════════ --}}
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title"><h2>File Uploads</h2></div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    {{-- Civil ID Image (Rectangle Preview) --}}
                    <div class="col-md-6">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Civil ID Image <code>rectangle preview</code></label>
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                 style="background-image: url('{{ asset('cpanel/media/svg/avatars/blank.svg') }}')">
                                <div class="image-input-wrapper w-200px h-125px"
                                     style="background-image: url('{{ $customer && $customer->civil_id_img ? getImageUrl(\App\Models\Developer\AdvancedCrud::MEDIA_PATH, $customer->civil_id_img) : asset('cpanel/media/svg/avatars/blank.svg') }}'); background-size: cover;"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                       data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="civil_id_img" accept=".png,.jpg,.jpeg,.webp"/>
                                    <input type="hidden" name="civil_id_img_remove"/>
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                      data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                      data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                            <div class="form-text">Upload civil ID scan. Only image files accepted.</div>
                            <div class="_laravel_error text-danger mt-1" data-error="civil_id_img"></div>
                        </div>
                    </div>

                    {{-- General File Upload (Drag & Drop) --}}
                    <div class="col-md-6">
                        <div class="_input_group fv-row mb-7">
                            <label class="fw-bold fs-6 mb-2">Attachment <code>file upload</code></label>
                            <div class="dropzone" id="kt_dropzone_attachment">
                                <div class="dz-message needsclick">
                                    <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                    <div class="ms-4">
                                        <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                        <span class="fs-7 fw-bold text-gray-400">PDF, DOC, XLS — max 5MB</span>
                                    </div>
                                </div>
                            </div>
                            <input name="attachment" type="file" class="form-control form-control-solid mt-3"
                                   accept=".pdf,.doc,.docx,.xls,.xlsx"/>
                            <div class="_laravel_error text-danger mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

<style>
    label code {
        background: #f0f9ff; color: #0284c7; padding: 1px 6px; border-radius: 4px;
        font-size: .7rem; font-weight: 500; margin-left: 4px;
    }
    .required::after { content: " *"; color: #f1416c; }
</style>

<script>
    function togglePassword(btn) {
        var input = btn.closest('.input-group').querySelector('input');
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    function stepNumber(inputId, delta) {
        var input = document.getElementById(inputId);
        var val = parseInt(input.value) || 0;
        var min = parseInt(input.min) || 0;
        var max = parseInt(input.max) || 999;
        input.value = Math.max(min, Math.min(max, val + delta));
    }

    // Color hex display
    document.getElementById('color_input')?.addEventListener('input', function () {
        document.getElementById('color_hex_display').textContent = this.value;
    });

    // Init Flatpickr
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof flatpickr !== 'undefined') {
            flatpickr('.time_picker', { enableTime: true, noCalendar: true, dateFormat: "H:i", time_24hr: true });
            flatpickr('.datetime_picker', { enableTime: true, dateFormat: "Y-m-d H:i", time_24hr: true });
            flatpickr('.date_range_picker', { mode: "range", dateFormat: "Y-m-d" });
        }
    });
</script>
