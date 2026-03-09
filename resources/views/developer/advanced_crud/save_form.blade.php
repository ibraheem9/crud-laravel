<form id="customer_form" method="POST"
      action="{{ $customer ? route('developer.advancedCrud.update') : route('developer.advancedCrud.store') }}"
      data-after="{{ route('developer.advancedCrud.index') }}" enctype="multipart/form-data">
    @csrf
    <input value="{{ $customer ? $customer->id : 0 }}" name="customer_id" type="hidden"/>

    {{-- ═══════════════════════════════════════════════════════════
         SECTION 1: TEXT INPUTS
         All text-based input types a developer might need
    ═══════════════════════════════════════════════════════════ --}}
    <div class="form-section mb-4">
        <h6 class="section-title"><i class="bi bi-fonts me-2"></i>Text Inputs</h6>
        <div class="row">
            {{-- Text Input --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label required">Full Name <code>type="text"</code></label>
                    <input value="{{ $customer ? $customer->name : '' }}" name="name" type="text"
                           class="form-control" placeholder="Enter full name"/>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Email Input --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label required">Email <code>type="email"</code></label>
                    <input value="{{ $customer ? $customer->email : '' }}" name="email" type="email"
                           class="form-control email_mask" placeholder="example@domain.com"/>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Password with Toggle --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label {{ $customer ? '' : 'required' }}">Password <code>type="password"</code></label>
                    <div class="input-group">
                        <input class="form-control" type="password" name="password" autocomplete="new-password"
                               placeholder="{{ $customer ? 'Leave empty to keep' : 'Min 8 characters' }}"/>
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(this)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <small class="form-text text-muted">Password with show/hide toggle button.</small>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Phone / Tel --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label">Mobile <code>type="tel"</code></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                        <input value="{{ $customer ? $customer->mobile : '' }}" name="mobile" type="tel"
                               class="form-control" placeholder="05x-xxx-xxxx"/>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Number Input --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label required">Civil ID <code>type="text"</code></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-credit-card-2-front"></i></span>
                        <input value="{{ $customer ? $customer->civil_id : '' }}" name="civil_id" type="text"
                               class="form-control" placeholder="Enter ID number"/>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Input with Prefix Text --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label">Passport No <code>input-group</code></label>
                    <div class="input-group">
                        <span class="input-group-text">PP</span>
                        <input value="{{ $customer ? $customer->passport_no : '' }}" name="passport_no" type="text"
                               class="form-control" placeholder="Enter passport number"/>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Textarea --}}
            <div class="col-md-8">
                <div class="_input_group mb-3">
                    <label class="form-label">Address <code>textarea</code></label>
                    <textarea name="address" class="form-control" rows="3"
                              placeholder="Enter full address...">{{ $customer ? $customer->address : '' }}</textarea>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Text with Helper Text --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label">Profession <code>with helper text</code></label>
                    <input value="{{ $customer ? $customer->profession : '' }}" name="profession" type="text"
                           class="form-control" placeholder="e.g. Software Engineer"/>
                    <small class="form-text text-muted">This is a helper text below the input.</small>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         SECTION 2: SELECT & DROPDOWNS
    ═══════════════════════════════════════════════════════════ --}}
    <div class="form-section mb-4">
        <h6 class="section-title"><i class="bi bi-list-ul me-2"></i>Select & Dropdowns</h6>
        <div class="row">
            {{-- Basic Select --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label required">Type <code>select</code></label>
                    <select name="type" class="form-select">
                        <option value="">-- Select --</option>
                        <option @if($customer && $customer->type == 'customer') selected @endif value="customer">Customer</option>
                        <option @if($customer && $customer->type == 'guardian') selected @endif value="guardian">Guardian</option>
                    </select>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Select2 Single --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label">Country <code>Select2</code></label>
                    <select name="country" class="form-select" data-control="select2"
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
                <div class="_input_group mb-3">
                    <label class="form-label">Skills <code>Select2 multiple</code></label>
                    <select name="skills[]" class="form-select" data-control="select2"
                            data-placeholder="Select skills..." multiple>
                        <option value="php">PHP</option>
                        <option value="laravel">Laravel</option>
                        <option value="javascript">JavaScript</option>
                        <option value="vue">Vue.js</option>
                        <option value="react">React</option>
                        <option value="mysql">MySQL</option>
                        <option value="css">CSS/Tailwind</option>
                    </select>
                    <small class="form-text text-muted">Multi-select with Select2 search.</small>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         SECTION 3: DATE & TIME
    ═══════════════════════════════════════════════════════════ --}}
    <div class="form-section mb-4">
        <h6 class="section-title"><i class="bi bi-calendar3 me-2"></i>Date & Time Pickers</h6>
        <div class="row">
            {{-- Date Picker (Flatpickr) --}}
            <div class="col-md-3">
                <div class="_input_group mb-3">
                    <label class="form-label required">Date of Birth <code>date_picker</code></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                        <input value="{{ $customer ? $customer->dob?->format('Y-m-d') : '' }}" name="dob" type="text"
                               class="form-control date_picker" placeholder="YYYY-MM-DD"/>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Time Picker --}}
            <div class="col-md-3">
                <div class="_input_group mb-3">
                    <label class="form-label">Appointment Time <code>time_picker</code></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-clock"></i></span>
                        <input name="appointment_time" type="text" class="form-control time_picker"
                               placeholder="HH:MM"/>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- DateTime Picker --}}
            <div class="col-md-3">
                <div class="_input_group mb-3">
                    <label class="form-label">Start DateTime <code>datetime_picker</code></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-plus"></i></span>
                        <input name="start_datetime" type="text" class="form-control datetime_picker"
                               placeholder="YYYY-MM-DD HH:MM"/>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Date Range --}}
            <div class="col-md-3">
                <div class="_input_group mb-3">
                    <label class="form-label">Date Range <code>date_range</code></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-range"></i></span>
                        <input name="date_range" type="text" class="form-control date_range_picker"
                               placeholder="From — To"/>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         SECTION 4: TOGGLES, RADIOS & CHECKBOXES
    ═══════════════════════════════════════════════════════════ --}}
    <div class="form-section mb-4">
        <h6 class="section-title"><i class="bi bi-toggle-on me-2"></i>Toggles, Radios & Checkboxes</h6>
        <div class="row">
            {{-- Radio Buttons --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label required">Gender <code>radio</code></label>
                    <div class="d-flex gap-3 mt-1">
                        <div class="form-check">
                            <input @if($customer && $customer->gender == 'male') checked @endif
                                   name="gender" class="form-check-input" type="radio" value="male" id="gender_male"/>
                            <label class="form-check-label" for="gender_male">Male</label>
                        </div>
                        <div class="form-check">
                            <input @if($customer && $customer->gender == 'female') checked @endif
                                   name="gender" class="form-check-input" type="radio" value="female" id="gender_female"/>
                            <label class="form-check-label" for="gender_female">Female</label>
                        </div>
                        <div class="form-check">
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
                <div class="_input_group mb-3">
                    <label class="form-label">Status Switches <code>switch</code></label>
                    <div class="d-flex flex-column gap-2 mt-1">
                        <div class="form-check form-switch">
                            <input name="is_vip" type="hidden" value="0"/>
                            <input @if($customer && $customer->is_vip) checked @endif
                                   name="is_vip" class="form-check-input" type="checkbox" value="1" id="sw_vip"/>
                            <label class="form-check-label" for="sw_vip">VIP Member</label>
                        </div>
                        <div class="form-check form-switch">
                            <input name="banned_at" type="hidden" value="0"/>
                            <input @if($customer && $customer->banned_at) checked @endif
                                   name="banned_at" class="form-check-input" type="checkbox" value="1" id="sw_banned"/>
                            <label class="form-check-label" for="sw_banned">Banned</label>
                        </div>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Checkboxes --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label">Notifications <code>checkbox</code></label>
                    <div class="d-flex flex-column gap-2 mt-1">
                        <div class="form-check">
                            <input name="notify_email" class="form-check-input" type="checkbox" value="1" id="cb_email" checked/>
                            <label class="form-check-label" for="cb_email">Email Notifications</label>
                        </div>
                        <div class="form-check">
                            <input name="notify_sms" class="form-check-input" type="checkbox" value="1" id="cb_sms"/>
                            <label class="form-check-label" for="cb_sms">SMS Notifications</label>
                        </div>
                        <div class="form-check">
                            <input name="notify_push" class="form-check-input" type="checkbox" value="1" id="cb_push"/>
                            <label class="form-check-label" for="cb_push">Push Notifications</label>
                        </div>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         SECTION 5: SPECIAL INPUTS
    ═══════════════════════════════════════════════════════════ --}}
    <div class="form-section mb-4">
        <h6 class="section-title"><i class="bi bi-palette me-2"></i>Special Inputs</h6>
        <div class="row">
            {{-- Color Picker --}}
            <div class="col-md-3">
                <div class="_input_group mb-3">
                    <label class="form-label">Favorite Color <code>type="color"</code></label>
                    <div class="d-flex align-items-center gap-2">
                        <input value="{{ $customer ? $customer->color : '#3b82f6' }}" name="color" type="color"
                               class="form-control form-control-color" id="color_input"
                               style="width:50px;height:40px;border-radius:8px;cursor:pointer;"/>
                        <span class="text-muted" id="color_hex_display" style="font-size:.82rem;font-family:monospace;">
                            {{ $customer ? $customer->color : '#3b82f6' }}
                        </span>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Range Slider --}}
            <div class="col-md-3">
                <div class="_input_group mb-3">
                    <label class="form-label">Rating <code>type="range"</code></label>
                    <div class="d-flex align-items-center gap-2">
                        <input name="rating" type="range" class="form-range flex-grow-1" min="0" max="100" value="50"
                               id="rating_range" oninput="document.getElementById('rating_val').textContent=this.value"/>
                        <span class="badge bg-primary" id="rating_val" style="min-width:36px;">50</span>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Number with Stepper --}}
            <div class="col-md-3">
                <div class="_input_group mb-3">
                    <label class="form-label">Quantity <code>type="number"</code></label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button"
                                onclick="stepNumber('qty_input', -1)">−</button>
                        <input name="quantity" type="number" class="form-control text-center" id="qty_input"
                               value="1" min="0" max="999"/>
                        <button class="btn btn-outline-secondary" type="button"
                                onclick="stepNumber('qty_input', 1)">+</button>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- URL Input --}}
            <div class="col-md-3">
                <div class="_input_group mb-3">
                    <label class="form-label">Website <code>type="url"</code></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-globe"></i></span>
                        <input name="website" type="url" class="form-control" placeholder="https://example.com"/>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         SECTION 6: FILE UPLOADS
    ═══════════════════════════════════════════════════════════ --}}
    <div class="form-section mb-4">
        <h6 class="section-title"><i class="bi bi-cloud-arrow-up me-2"></i>File Uploads</h6>
        <div class="row">
            {{-- Profile Image (Circle Preview) --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label">Profile Image <code>circle preview</code></label>
                    <div class="d-flex align-items-center gap-3">
                        <img id="img_preview" src="{{ $customer ? $customer->img_url : getDefaultImg() }}"
                             class="rounded-circle" style="width:80px;height:80px;object-fit:cover;border:3px solid #f1f5f9;"/>
                        <div class="flex-grow-1">
                            <input name="img" type="file" class="form-control form-control-sm" accept="image/*"
                                   onchange="previewImage(this, 'img_preview')"/>
                            <small class="form-text text-muted">JPG, PNG, max 2MB</small>
                        </div>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- Document Image (Rectangle Preview) --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label">Civil ID Image <code>rectangle preview</code></label>
                    <div class="text-center">
                        <img id="civil_id_img_preview"
                             src="{{ $customer && $customer->civil_id_img ? getImageUrl(\App\Models\Developer\AdvancedCrud::MEDIA_PATH, $customer->civil_id_img) : getDefaultImg() }}"
                             class="rounded mb-2" style="width:200px;height:120px;object-fit:cover;border:3px solid #f1f5f9;"/>
                        <input name="civil_id_img" type="file" class="form-control form-control-sm" accept="image/*"
                               onchange="previewImage(this, 'civil_id_img_preview')"/>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>

            {{-- General File Upload --}}
            <div class="col-md-4">
                <div class="_input_group mb-3">
                    <label class="form-label">Attachment <code>file upload</code></label>
                    <div class="upload-zone" id="drop_zone">
                        <i class="bi bi-cloud-arrow-up fs-3 text-muted"></i>
                        <p class="mb-1 text-muted" style="font-size:.82rem;">Drag & drop or click to upload</p>
                        <input name="attachment" type="file" class="form-control form-control-sm"
                               accept=".pdf,.doc,.docx,.xls,.xlsx"/>
                        <small class="form-text text-muted">PDF, DOC, XLS — max 5MB</small>
                    </div>
                    <div class="_laravel_error text-danger mt-1"></div>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .form-section {
        background: #fafbfc; border: 1px solid #f1f5f9; border-radius: 12px; padding: 20px 24px;
    }
    .section-title {
        font-weight: 700; font-size: .92rem; color: #0f172a; margin-bottom: 16px;
        padding-bottom: 10px; border-bottom: 2px solid #e2e8f0;
    }
    .section-title i { color: var(--primary); }
    .section-title code {
        display: none; /* Hide code hints in production, show in dev */
    }
    label code {
        background: #f0f9ff; color: #0284c7; padding: 1px 6px; border-radius: 4px;
        font-size: .7rem; font-weight: 500; margin-left: 4px;
    }
    .form-label { font-weight: 500; font-size: .82rem; color: #334155; margin-bottom: 4px; }
    .form-label.required::after { content: " *"; color: #ef4444; }
    .upload-zone {
        border: 2px dashed #e2e8f0; border-radius: 10px; padding: 16px; text-align: center;
        transition: border-color .2s; cursor: pointer;
    }
    .upload-zone:hover { border-color: var(--primary); }
    .input-group-text {
        background: #f8fafc; border-color: #e2e8f0; color: #64748b; font-size: .85rem;
    }
</style>

<script>
    function togglePassword(btn) {
        var input = btn.parentElement.querySelector('input');
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function stepNumber(inputId, delta) {
        var input = document.getElementById(inputId);
        var val = parseInt(input.value) || 0;
        var min = parseInt(input.min) || 0;
        var max = parseInt(input.max) || 999;
        var newVal = Math.max(min, Math.min(max, val + delta));
        input.value = newVal;
    }

    // Color hex display
    document.getElementById('color_input')?.addEventListener('input', function() {
        document.getElementById('color_hex_display').textContent = this.value;
    });

    // Init Flatpickr for time, datetime, and date range
    document.addEventListener('DOMContentLoaded', function() {
        // Time picker
        flatpickr('.time_picker', {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        // DateTime picker
        flatpickr('.datetime_picker', {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });

        // Date range picker
        flatpickr('.date_range_picker', {
            mode: "range",
            dateFormat: "Y-m-d",
        });
    });
</script>
