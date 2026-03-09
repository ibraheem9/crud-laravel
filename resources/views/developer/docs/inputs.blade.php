@extends('layouts.cpanel.docs.app')
@section('title', 'Input Components')

@section('content')
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="card-title mb-0"><i class="bi bi-input-cursor-text text-primary me-2"></i> Input Components Reference</h5>
            <p class="text-muted mb-0 mt-1" style="font-size:.84rem;">Every input type used in the CRUD forms — live Bootstrap 5 examples with copy-paste Blade code.</p>
        </div>
        <div class="card-body pt-4">

            {{-- ╔══════════════════════════════════════════════════════════════╗
                 ║  QUICK REFERENCE TABLE                                      ║
                 ╚══════════════════════════════════════════════════════════════╝ --}}
            <div class="doc-section">
                <h2><i class="bi bi-bookmark me-2 text-primary"></i>Quick Reference</h2>
                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    All inputs follow the <code>_input_group</code> + <code>_laravel_error</code> pattern.
                    The <code>helperForm</code> JS helper automatically collects errors from Laravel validation
                    and displays them inside <code>._laravel_error</code> divs.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered params-table mb-0">
                        <thead>
                            <tr>
                                <th style="width:30%;">Input Type</th>
                                <th style="width:25%;">CSS Class / Attribute</th>
                                <th style="width:20%;">Library</th>
                                <th style="width:25%;">Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><code>text</code>, <code>email</code>, <code>tel</code>, <code>url</code></td><td>Bootstrap <code>.form-control</code></td><td>Bootstrap 5</td><td>Text Inputs</td></tr>
                            <tr><td><code>password</code> with toggle</td><td><code>.input-group</code> + button</td><td>Bootstrap 5</td><td>Text Inputs</td></tr>
                            <tr><td><code>textarea</code></td><td><code>.form-control</code> + <code>rows</code></td><td>Bootstrap 5</td><td>Text Inputs</td></tr>
                            <tr><td>Input with icon prefix</td><td><code>.input-group-text</code></td><td>Bootstrap 5</td><td>Text Inputs</td></tr>
                            <tr><td>Input with text prefix</td><td><code>.input-group-text</code></td><td>Bootstrap 5</td><td>Text Inputs</td></tr>
                            <tr><td>Basic <code>select</code></td><td><code>.form-select</code></td><td>Bootstrap 5</td><td>Select & Dropdowns</td></tr>
                            <tr><td>Select2 single</td><td><code>data-control="select2"</code></td><td>Select2</td><td>Select & Dropdowns</td></tr>
                            <tr><td>Select2 multiple</td><td><code>data-control="select2"</code> + <code>multiple</code></td><td>Select2</td><td>Select & Dropdowns</td></tr>
                            <tr><td>Date picker</td><td><code>.date_picker</code></td><td>Flatpickr</td><td>Date & Time</td></tr>
                            <tr><td>Time picker</td><td><code>.time_picker</code></td><td>Flatpickr</td><td>Date & Time</td></tr>
                            <tr><td>DateTime picker</td><td><code>.datetime_picker</code></td><td>Flatpickr</td><td>Date & Time</td></tr>
                            <tr><td>Date range picker</td><td><code>.date_range_picker</code></td><td>Flatpickr</td><td>Date & Time</td></tr>
                            <tr><td>Radio buttons</td><td><code>.form-check</code> + <code>type="radio"</code></td><td>Bootstrap 5</td><td>Toggles & Checks</td></tr>
                            <tr><td>Switch toggle</td><td><code>.form-switch</code> + hidden input</td><td>Bootstrap 5</td><td>Toggles & Checks</td></tr>
                            <tr><td>Checkboxes</td><td><code>.form-check</code> + <code>type="checkbox"</code></td><td>Bootstrap 5</td><td>Toggles & Checks</td></tr>
                            <tr><td>Color picker</td><td><code>.form-control-color</code></td><td>Bootstrap 5</td><td>Special Inputs</td></tr>
                            <tr><td>Range slider</td><td><code>.form-range</code></td><td>Bootstrap 5</td><td>Special Inputs</td></tr>
                            <tr><td>Number stepper (+/−)</td><td><code>.input-group</code> + buttons</td><td>Bootstrap 5</td><td>Special Inputs</td></tr>
                            <tr><td>Image upload (circle)</td><td><code>onchange="previewImage()"</code></td><td>Vanilla JS</td><td>File Uploads</td></tr>
                            <tr><td>Image upload (rectangle)</td><td><code>onchange="previewImage()"</code></td><td>Vanilla JS</td><td>File Uploads</td></tr>
                            <tr><td>Drag & drop file</td><td><code>.upload-zone</code></td><td>CSS + Bootstrap</td><td>File Uploads</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ╔══════════════════════════════════════════════════════════════╗
                 ║  BASE PATTERN                                               ║
                 ╚══════════════════════════════════════════════════════════════╝ --}}
            <div class="doc-section">
                <h2><i class="bi bi-code-slash me-2 text-primary"></i>Base Pattern — _input_group</h2>
                <p>Every input in the CRUD follows this exact pattern. The <code>_input_group</code> wrapper allows <code>helperForm</code> to match validation errors by <code>name</code> attribute and inject them into <code>_laravel_error</code>.</p>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Field Label <span class="text-danger">*</span></label>
                                <input name="demo" type="text" class="form-control" placeholder="Enter value..."/>
                                <div class="_laravel_error text-danger mt-1" style="font-size:.8rem;">This is where validation errors appear</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;!-- Base pattern for ALL inputs --&gt;
&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label required"&gt;Field Label&lt;/label&gt;
    &lt;input value="@{{ $item ? $item-&gt;field : '' }}" name="field" type="text"
           class="form-control" placeholder="Enter value..."/&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;!-- CSS for required asterisk --&gt;
&lt;style&gt;
    .form-label.required::after { content: " *"; color: #ef4444; }
&lt;/style&gt;</code></pre>
                </div>

                <div class="warning-box">
                    <i class="bi bi-exclamation-triangle"></i>
                    <strong>Important:</strong> The <code>name</code> attribute on the input MUST match the validation rule key in your <code>FormRequest</code>.
                    For example, <code>name="email"</code> matches <code>'email' => 'required|email'</code>.
                </div>
            </div>

            {{-- ╔══════════════════════════════════════════════════════════════╗
                 ║  SECTION 1: TEXT INPUTS                                     ║
                 ╚══════════════════════════════════════════════════════════════╝ --}}
            <div class="doc-section">
                <h2><i class="bi bi-fonts me-2 text-primary"></i>1. Text Inputs</h2>

                {{-- 1a: Basic Text --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-primary text-white">1a</span> Basic Text Input</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter full name"/>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label required"&gt;Full Name&lt;/label&gt;
    &lt;input value="@{{ $item ? $item-&gt;name : '' }}" name="name" type="text"
           class="form-control" placeholder="Enter full name"/&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 1b: Email --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-primary text-white">1b</span> Email Input</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control email_mask" placeholder="example@domain.com"/>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label required"&gt;Email&lt;/label&gt;
    &lt;input value="@{{ $item-&gt;email ?? '' }}" name="email" type="email"
           class="form-control email_mask" placeholder="example@domain.com"/&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;!-- The class "email_mask" is auto-initialized by helperInputs --&gt;</code></pre>
                </div>

                {{-- 1c: Password with Toggle --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-primary text-white">1c</span> Password with Toggle Visibility</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input class="form-control" type="password" id="demo_pw" placeholder="Min 8 characters"/>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePwDemo(this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted">Click the eye icon to toggle visibility.</small>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;!-- Blade --&gt;
&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label @{{ $item ? '' : 'required' }}"&gt;Password&lt;/label&gt;
    &lt;div class="input-group"&gt;
        &lt;input class="form-control" type="password" name="password"
               autocomplete="new-password"
               placeholder="@{{ $item ? 'Leave empty to keep' : 'Min 8 characters' }}"/&gt;
        &lt;button class="btn btn-outline-secondary" type="button"
                onclick="togglePassword(this)"&gt;
            &lt;i class="bi bi-eye"&gt;&lt;/i&gt;
        &lt;/button&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// JavaScript — toggle password visibility
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
}</code></pre>
                </div>

                {{-- 1d: Phone / Tel with Icon --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-primary text-white">1d</span> Phone / Tel with Icon Prefix</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Mobile</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                    <input type="tel" class="form-control" placeholder="05x-xxx-xxxx"/>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Mobile&lt;/label&gt;
    &lt;div class="input-group"&gt;
        &lt;span class="input-group-text"&gt;&lt;i class="bi bi-phone"&gt;&lt;/i&gt;&lt;/span&gt;
        &lt;input value="@{{ $item-&gt;mobile ?? '' }}" name="mobile" type="tel"
               class="form-control" placeholder="05x-xxx-xxxx"/&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 1e: Input with Text Prefix --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-primary text-white">1e</span> Input with Text Prefix</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Passport No</label>
                                <div class="input-group">
                                    <span class="input-group-text">PP</span>
                                    <input type="text" class="form-control" placeholder="Enter passport number"/>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Passport No&lt;/label&gt;
    &lt;div class="input-group"&gt;
        &lt;span class="input-group-text"&gt;PP&lt;/span&gt;
        &lt;input value="@{{ $item-&gt;passport_no ?? '' }}" name="passport_no" type="text"
               class="form-control" placeholder="Enter passport number"/&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 1f: Textarea --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-primary text-white">1f</span> Textarea</h5>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Address</label>
                                <textarea class="form-control" rows="3" placeholder="Enter full address..."></textarea>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Address&lt;/label&gt;
    &lt;textarea name="address" class="form-control" rows="3"
              placeholder="Enter full address..."&gt;@{{ $item-&gt;address ?? '' }}&lt;/textarea&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 1g: Input with Helper Text --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-primary text-white">1g</span> Input with Helper Text</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Profession</label>
                                <input type="text" class="form-control" placeholder="e.g. Software Engineer"/>
                                <small class="form-text text-muted">This is a helper text below the input.</small>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Profession&lt;/label&gt;
    &lt;input value="@{{ $item-&gt;profession ?? '' }}" name="profession" type="text"
           class="form-control" placeholder="e.g. Software Engineer"/&gt;
    &lt;small class="form-text text-muted"&gt;This is a helper text below the input.&lt;/small&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 1h: URL with Globe Icon --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-primary text-white">1h</span> URL Input with Globe Icon</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Website</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                    <input type="url" class="form-control" placeholder="https://example.com"/>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Website&lt;/label&gt;
    &lt;div class="input-group"&gt;
        &lt;span class="input-group-text"&gt;&lt;i class="bi bi-globe"&gt;&lt;/i&gt;&lt;/span&gt;
        &lt;input value="@{{ $item-&gt;website ?? '' }}" name="website" type="url"
               class="form-control" placeholder="https://example.com"/&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
            </div>

            {{-- ╔══════════════════════════════════════════════════════════════╗
                 ║  SECTION 2: SELECT & DROPDOWNS                              ║
                 ╚══════════════════════════════════════════════════════════════╝ --}}
            <div class="doc-section">
                <h2><i class="bi bi-list-ul me-2 text-primary"></i>2. Select & Dropdowns</h2>

                {{-- 2a: Basic Select --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-success text-white">2a</span> Basic Select (Bootstrap)</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                                <select class="form-select">
                                    <option value="">-- Select --</option>
                                    <option value="customer">Customer</option>
                                    <option value="guardian">Guardian</option>
                                </select>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label required"&gt;Type&lt;/label&gt;
    &lt;select name="type" class="form-select"&gt;
        &lt;option value=""&gt;-- Select --&lt;/option&gt;
        &lt;option @@if($item && $item-&gt;type == 'customer') selected @@endif
                value="customer"&gt;Customer&lt;/option&gt;
        &lt;option @@if($item && $item-&gt;type == 'guardian') selected @@endif
                value="guardian"&gt;Guardian&lt;/option&gt;
    &lt;/select&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 2b: Select2 Single --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-success text-white">2b</span> Select2 — Single (Searchable)</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Country</label>
                                <select class="form-select" data-control="select2" data-placeholder="Search country..." id="doc_country_select">
                                    <option value=""></option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="QA">Qatar</option>
                                    <option value="JO">Jordan</option>
                                    <option value="EG">Egypt</option>
                                    <option value="US">United States</option>
                                    <option value="GB">United Kingdom</option>
                                </select>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Country&lt;/label&gt;
    &lt;select name="country" class="form-select" data-control="select2"
            data-placeholder="Search country..."&gt;
        &lt;option value=""&gt;&lt;/option&gt;
        &lt;option value="AE"&gt;United Arab Emirates&lt;/option&gt;
        &lt;option value="SA"&gt;Saudi Arabia&lt;/option&gt;
        &lt;!-- more options --&gt;
    &lt;/select&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;!-- Auto-initialized by helperInputs via data-control="select2" --&gt;</code></pre>
                </div>
                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    <strong>How it works:</strong> The <code>helperInputs</code> JS helper auto-initializes any <code>&lt;select&gt;</code> with
                    <code>data-control="select2"</code>. No manual JS initialization needed.
                </div>

                {{-- 2c: Select2 Multiple --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-success text-white">2c</span> Select2 — Multiple</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Skills</label>
                                <select class="form-select" data-control="select2" data-placeholder="Select skills..." multiple id="doc_skills_select">
                                    <option value="php">PHP</option>
                                    <option value="laravel">Laravel</option>
                                    <option value="javascript">JavaScript</option>
                                    <option value="vue">Vue.js</option>
                                    <option value="react">React</option>
                                    <option value="mysql">MySQL</option>
                                </select>
                                <small class="form-text text-muted">Multi-select with search.</small>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Skills&lt;/label&gt;
    &lt;select name="skills[]" class="form-select" data-control="select2"
            data-placeholder="Select skills..." multiple&gt;
        &lt;option value="php"&gt;PHP&lt;/option&gt;
        &lt;option value="laravel"&gt;Laravel&lt;/option&gt;
        &lt;option value="javascript"&gt;JavaScript&lt;/option&gt;
    &lt;/select&gt;
    &lt;small class="form-text text-muted"&gt;Multi-select with search.&lt;/small&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;!-- Note: use name="skills[]" (with brackets) for multiple values --&gt;</code></pre>
                </div>
            </div>

            {{-- ╔══════════════════════════════════════════════════════════════╗
                 ║  SECTION 3: DATE & TIME PICKERS                             ║
                 ╚══════════════════════════════════════════════════════════════╝ --}}
            <div class="doc-section">
                <h2><i class="bi bi-calendar3 me-2 text-primary"></i>3. Date & Time Pickers</h2>
                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    All date/time pickers use <strong>Flatpickr</strong>. Just add the CSS class and they are auto-initialized by <code>helperInputs</code>.
                </div>

                {{-- 3a: Date Picker --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-warning text-dark">3a</span> Date Picker</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Date of Birth <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                    <input type="text" class="form-control date_picker" placeholder="YYYY-MM-DD"/>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label required"&gt;Date of Birth&lt;/label&gt;
    &lt;div class="input-group"&gt;
        &lt;span class="input-group-text"&gt;&lt;i class="bi bi-calendar-event"&gt;&lt;/i&gt;&lt;/span&gt;
        &lt;input value="@{{ $item-&gt;dob?-&gt;format('Y-m-d') ?? '' }}" name="dob" type="text"
               class="form-control date_picker" placeholder="YYYY-MM-DD"/&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;!-- Class "date_picker" → Flatpickr auto-init with dateFormat: "Y-m-d" --&gt;</code></pre>
                </div>

                {{-- 3b: Time Picker --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-warning text-dark">3b</span> Time Picker</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Appointment Time</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                    <input type="text" class="form-control time_picker" placeholder="HH:MM"/>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Appointment Time&lt;/label&gt;
    &lt;div class="input-group"&gt;
        &lt;span class="input-group-text"&gt;&lt;i class="bi bi-clock"&gt;&lt;/i&gt;&lt;/span&gt;
        &lt;input value="@{{ $item-&gt;time ?? '' }}" name="appointment_time" type="text"
               class="form-control time_picker" placeholder="HH:MM"/&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;!-- Class "time_picker" → Flatpickr: enableTime, noCalendar, dateFormat: "H:i" --&gt;</code></pre>
                </div>

                {{-- 3c: DateTime Picker --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-warning text-dark">3c</span> DateTime Picker</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Start DateTime</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-plus"></i></span>
                                    <input type="text" class="form-control datetime_picker" placeholder="YYYY-MM-DD HH:MM"/>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Start DateTime&lt;/label&gt;
    &lt;div class="input-group"&gt;
        &lt;span class="input-group-text"&gt;&lt;i class="bi bi-calendar-plus"&gt;&lt;/i&gt;&lt;/span&gt;
        &lt;input value="@{{ $item-&gt;start_at ?? '' }}" name="start_datetime" type="text"
               class="form-control datetime_picker" placeholder="YYYY-MM-DD HH:MM"/&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;!-- Class "datetime_picker" → Flatpickr: enableTime, dateFormat: "Y-m-d H:i" --&gt;</code></pre>
                </div>

                {{-- 3d: Date Range Picker --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-warning text-dark">3d</span> Date Range Picker</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Date Range</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-range"></i></span>
                                    <input type="text" class="form-control date_range_picker" placeholder="From — To"/>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Date Range&lt;/label&gt;
    &lt;div class="input-group"&gt;
        &lt;span class="input-group-text"&gt;&lt;i class="bi bi-calendar-range"&gt;&lt;/i&gt;&lt;/span&gt;
        &lt;input name="date_range" type="text"
               class="form-control date_range_picker" placeholder="From — To"/&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;!-- Class "date_range_picker" → Flatpickr: mode: "range", dateFormat: "Y-m-d" --&gt;</code></pre>
                </div>

                {{-- Flatpickr Init Reference --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-dark text-white">JS</span> Flatpickr Initialization Reference</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// These are auto-initialized by helperInputs, but here's the manual config:

// Date picker (class: .date_picker)
flatpickr('.date_picker', { dateFormat: "Y-m-d" });

// Time picker (class: .time_picker)
flatpickr('.time_picker', {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
});

// DateTime picker (class: .datetime_picker)
flatpickr('.datetime_picker', {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    time_24hr: true
});

// Date Range picker (class: .date_range_picker)
flatpickr('.date_range_picker', {
    mode: "range",
    dateFormat: "Y-m-d"
});</code></pre>
                </div>
            </div>

            {{-- ╔══════════════════════════════════════════════════════════════╗
                 ║  SECTION 4: TOGGLES, RADIOS & CHECKBOXES                   ║
                 ╚══════════════════════════════════════════════════════════════╝ --}}
            <div class="doc-section">
                <h2><i class="bi bi-toggle-on me-2 text-primary"></i>4. Toggles, Radios & Checkboxes</h2>

                {{-- 4a: Radio Buttons --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-info text-white">4a</span> Radio Buttons</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                                <div class="d-flex gap-3 mt-1">
                                    <div class="form-check">
                                        <input name="demo_gender" class="form-check-input" type="radio" value="male" id="doc_gender_m" checked/>
                                        <label class="form-check-label" for="doc_gender_m">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="demo_gender" class="form-check-input" type="radio" value="female" id="doc_gender_f"/>
                                        <label class="form-check-label" for="doc_gender_f">Female</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="demo_gender" class="form-check-input" type="radio" value="other" id="doc_gender_o"/>
                                        <label class="form-check-label" for="doc_gender_o">Other</label>
                                    </div>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label required"&gt;Gender&lt;/label&gt;
    &lt;div class="d-flex gap-3 mt-1"&gt;
        &lt;div class="form-check"&gt;
            &lt;input @@if($item && $item-&gt;gender == 'male') checked @@endif
                   name="gender" class="form-check-input" type="radio"
                   value="male" id="gender_male"/&gt;
            &lt;label class="form-check-label" for="gender_male"&gt;Male&lt;/label&gt;
        &lt;/div&gt;
        &lt;div class="form-check"&gt;
            &lt;input @@if($item && $item-&gt;gender == 'female') checked @@endif
                   name="gender" class="form-check-input" type="radio"
                   value="female" id="gender_female"/&gt;
            &lt;label class="form-check-label" for="gender_female"&gt;Female&lt;/label&gt;
        &lt;/div&gt;
        &lt;div class="form-check"&gt;
            &lt;input @@if($item && $item-&gt;gender == 'other') checked @@endif
                   name="gender" class="form-check-input" type="radio"
                   value="other" id="gender_other"/&gt;
            &lt;label class="form-check-label" for="gender_other"&gt;Other&lt;/label&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 4b: Switch Toggle --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-info text-white">4b</span> Switch Toggle (Boolean)</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Status Switches</label>
                                <div class="d-flex flex-column gap-2 mt-1">
                                    <div class="form-check form-switch">
                                        <input type="hidden" value="0"/>
                                        <input class="form-check-input" type="checkbox" value="1" id="doc_sw_vip" checked/>
                                        <label class="form-check-label" for="doc_sw_vip">VIP Member</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input type="hidden" value="0"/>
                                        <input class="form-check-input" type="checkbox" value="1" id="doc_sw_banned"/>
                                        <label class="form-check-label" for="doc_sw_banned">Banned</label>
                                    </div>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;!-- IMPORTANT: The hidden input trick ensures "0" is sent when unchecked --&gt;
&lt;div class="form-check form-switch"&gt;
    &lt;input name="is_vip" type="hidden" value="0"/&gt;
    &lt;input @@if($item && $item-&gt;is_vip) checked @@endif
           name="is_vip" class="form-check-input" type="checkbox"
           value="1" id="sw_vip"/&gt;
    &lt;label class="form-check-label" for="sw_vip"&gt;VIP Member&lt;/label&gt;
&lt;/div&gt;</code></pre>
                </div>
                <div class="warning-box">
                    <i class="bi bi-exclamation-triangle"></i>
                    <strong>Hidden input trick:</strong> Without the <code>&lt;input type="hidden" value="0"&gt;</code>,
                    unchecked checkboxes send <strong>nothing</strong> to the server. The hidden input ensures
                    <code>0</code> is always sent, and the checkbox overrides it to <code>1</code> when checked.
                    Both inputs must share the same <code>name</code>.
                </div>

                {{-- 4c: Checkboxes --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-info text-white">4c</span> Checkboxes (Multiple Options)</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Notifications</label>
                                <div class="d-flex flex-column gap-2 mt-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="doc_cb_email" checked/>
                                        <label class="form-check-label" for="doc_cb_email">Email Notifications</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="doc_cb_sms"/>
                                        <label class="form-check-label" for="doc_cb_sms">SMS Notifications</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="doc_cb_push"/>
                                        <label class="form-check-label" for="doc_cb_push">Push Notifications</label>
                                    </div>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Notifications&lt;/label&gt;
    &lt;div class="d-flex flex-column gap-2 mt-1"&gt;
        &lt;div class="form-check"&gt;
            &lt;input @@if($item && $item-&gt;notify_email) checked @@endif
                   name="notify_email" class="form-check-input" type="checkbox"
                   value="1" id="cb_email"/&gt;
            &lt;label class="form-check-label" for="cb_email"&gt;Email Notifications&lt;/label&gt;
        &lt;/div&gt;
        &lt;div class="form-check"&gt;
            &lt;input @@if($item && $item-&gt;notify_sms) checked @@endif
                   name="notify_sms" class="form-check-input" type="checkbox"
                   value="1" id="cb_sms"/&gt;
            &lt;label class="form-check-label" for="cb_sms"&gt;SMS Notifications&lt;/label&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
            </div>

            {{-- ╔══════════════════════════════════════════════════════════════╗
                 ║  SECTION 5: SPECIAL INPUTS                                  ║
                 ╚══════════════════════════════════════════════════════════════╝ --}}
            <div class="doc-section">
                <h2><i class="bi bi-palette me-2 text-primary"></i>5. Special Inputs</h2>

                {{-- 5a: Color Picker --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-danger text-white">5a</span> Color Picker</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Favorite Color</label>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="color" class="form-control form-control-color" value="#3b82f6"
                                           id="doc_color" style="width:50px;height:40px;border-radius:8px;cursor:pointer;"/>
                                    <span class="text-muted" id="doc_color_hex" style="font-size:.82rem;font-family:monospace;">#3b82f6</span>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Favorite Color&lt;/label&gt;
    &lt;div class="d-flex align-items-center gap-2"&gt;
        &lt;input value="@{{ $item-&gt;color ?? '#3b82f6' }}" name="color" type="color"
               class="form-control form-control-color" id="color_input"
               style="width:50px;height:40px;border-radius:8px;cursor:pointer;"/&gt;
        &lt;span class="text-muted" id="color_hex_display"
              style="font-size:.82rem;font-family:monospace;"&gt;
            @{{ $item-&gt;color ?? '#3b82f6' }}
        &lt;/span&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// Update hex display when color changes
document.getElementById('color_input')?.addEventListener('input', function() {
    document.getElementById('color_hex_display').textContent = this.value;
});</code></pre>
                </div>

                {{-- 5b: Range Slider --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-danger text-white">5b</span> Range Slider with Badge</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Rating</label>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="range" class="form-range flex-grow-1" min="0" max="100" value="50"
                                           id="doc_range" oninput="document.getElementById('doc_range_val').textContent=this.value"/>
                                    <span class="badge bg-primary" id="doc_range_val" style="min-width:36px;">50</span>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Rating&lt;/label&gt;
    &lt;div class="d-flex align-items-center gap-2"&gt;
        &lt;input name="rating" type="range" class="form-range flex-grow-1"
               min="0" max="100" value="50" id="rating_range"
               oninput="document.getElementById('rating_val').textContent=this.value"/&gt;
        &lt;span class="badge bg-primary" id="rating_val" style="min-width:36px;"&gt;50&lt;/span&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 5c: Number Stepper --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-danger text-white">5c</span> Number Stepper (+/−)</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Quantity</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button"
                                            onclick="docStepNumber('doc_qty', -1)">−</button>
                                    <input type="number" class="form-control text-center" id="doc_qty"
                                           value="1" min="0" max="999"/>
                                    <button class="btn btn-outline-secondary" type="button"
                                            onclick="docStepNumber('doc_qty', 1)">+</button>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Quantity&lt;/label&gt;
    &lt;div class="input-group"&gt;
        &lt;button class="btn btn-outline-secondary" type="button"
                onclick="stepNumber('qty_input', -1)"&gt;−&lt;/button&gt;
        &lt;input name="quantity" type="number" class="form-control text-center"
               id="qty_input" value="1" min="0" max="999"/&gt;
        &lt;button class="btn btn-outline-secondary" type="button"
                onclick="stepNumber('qty_input', 1)"&gt;+&lt;/button&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// Number stepper function
function stepNumber(inputId, delta) {
    var input = document.getElementById(inputId);
    var val = parseInt(input.value) || 0;
    var min = parseInt(input.min) || 0;
    var max = parseInt(input.max) || 999;
    var newVal = Math.max(min, Math.min(max, val + delta));
    input.value = newVal;
}</code></pre>
                </div>
            </div>

            {{-- ╔══════════════════════════════════════════════════════════════╗
                 ║  SECTION 6: FILE UPLOADS                                    ║
                 ╚══════════════════════════════════════════════════════════════╝ --}}
            <div class="doc-section">
                <h2><i class="bi bi-cloud-arrow-up me-2 text-primary"></i>6. File Uploads</h2>

                {{-- 6a: Circle Image Preview --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-secondary text-white">6a</span> Profile Image — Circle Preview</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Profile Image</label>
                                <div class="d-flex align-items-center gap-3">
                                    <img id="doc_img_circle" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80'%3E%3Crect fill='%23f1f5f9' width='80' height='80' rx='40'/%3E%3Ctext x='50%25' y='55%25' text-anchor='middle' fill='%2394a3b8' font-size='28'%3E%3F%3C/text%3E%3C/svg%3E"
                                         class="rounded-circle" style="width:80px;height:80px;object-fit:cover;border:3px solid #f1f5f9;"/>
                                    <div class="flex-grow-1">
                                        <input type="file" class="form-control form-control-sm" accept="image/*"
                                               onchange="docPreviewImage(this, 'doc_img_circle')"/>
                                        <small class="form-text text-muted">JPG, PNG, max 2MB</small>
                                    </div>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Profile Image&lt;/label&gt;
    &lt;div class="d-flex align-items-center gap-3"&gt;
        &lt;img id="img_preview"
             src="@{{ $item ? $item-&gt;img_url : getDefaultImg() }}"
             class="rounded-circle"
             style="width:80px;height:80px;object-fit:cover;border:3px solid #f1f5f9;"/&gt;
        &lt;div class="flex-grow-1"&gt;
            &lt;input name="img" type="file" class="form-control form-control-sm"
                   accept="image/*" onchange="previewImage(this, 'img_preview')"/&gt;
            &lt;small class="form-text text-muted"&gt;JPG, PNG, max 2MB&lt;/small&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 6b: Rectangle Image Preview --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-secondary text-white">6b</span> Document Image — Rectangle Preview</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Civil ID Image</label>
                                <div class="text-center">
                                    <img id="doc_img_rect" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='120'%3E%3Crect fill='%23f1f5f9' width='200' height='120' rx='8'/%3E%3Ctext x='50%25' y='55%25' text-anchor='middle' fill='%2394a3b8' font-size='14'%3ENo Image%3C/text%3E%3C/svg%3E"
                                         class="rounded mb-2" style="width:200px;height:120px;object-fit:cover;border:3px solid #f1f5f9;"/>
                                    <input type="file" class="form-control form-control-sm" accept="image/*"
                                           onchange="docPreviewImage(this, 'doc_img_rect')"/>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Civil ID Image&lt;/label&gt;
    &lt;div class="text-center"&gt;
        &lt;img id="civil_id_img_preview"
             src="@{{ $item && $item-&gt;civil_id_img ? getImageUrl(Model::MEDIA_PATH, $item-&gt;civil_id_img) : getDefaultImg() }}"
             class="rounded mb-2"
             style="width:200px;height:120px;object-fit:cover;border:3px solid #f1f5f9;"/&gt;
        &lt;input name="civil_id_img" type="file" class="form-control form-control-sm"
               accept="image/*" onchange="previewImage(this, 'civil_id_img_preview')"/&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>

                {{-- 6c: Drag & Drop File Upload --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-secondary text-white">6c</span> Drag & Drop File Upload Zone</h5>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-0">
                                <label class="form-label fw-semibold">Attachment</label>
                                <div class="doc-upload-zone">
                                    <i class="bi bi-cloud-arrow-up fs-3 text-muted"></i>
                                    <p class="mb-1 text-muted" style="font-size:.82rem;">Drag & drop or click to upload</p>
                                    <input type="file" class="form-control form-control-sm" accept=".pdf,.doc,.docx,.xls,.xlsx"/>
                                    <small class="form-text text-muted">PDF, DOC, XLS — max 5MB</small>
                                </div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label"&gt;Attachment&lt;/label&gt;
    &lt;div class="upload-zone" id="drop_zone"&gt;
        &lt;i class="bi bi-cloud-arrow-up fs-3 text-muted"&gt;&lt;/i&gt;
        &lt;p class="mb-1 text-muted" style="font-size:.82rem;"&gt;Drag &amp; drop or click to upload&lt;/p&gt;
        &lt;input name="attachment" type="file" class="form-control form-control-sm"
               accept=".pdf,.doc,.docx,.xls,.xlsx"/&gt;
        &lt;small class="form-text text-muted"&gt;PDF, DOC, XLS — max 5MB&lt;/small&gt;
    &lt;/div&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-css">/* Upload zone styling */
.upload-zone {
    border: 2px dashed #e2e8f0;
    border-radius: 10px;
    padding: 16px;
    text-align: center;
    transition: border-color .2s;
    cursor: pointer;
}
.upload-zone:hover { border-color: var(--primary); }</code></pre>
                </div>

                {{-- previewImage function --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-dark text-white">JS</span> Image Preview Function</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// Preview image before upload — used by both circle and rectangle previews
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Usage in Blade:
// onchange="previewImage(this, 'img_preview')"</code></pre>
                </div>

                {{-- Controller side --}}
                <h5 class="mt-4 mb-3"><span class="method-badge bg-dark text-white">PHP</span> Controller — Handling File Upload</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// In your Controller store/update method:
use App\Helpers\FilesHelper;

// Upload image with auto-delete of old file
$item->img = FilesHelper::uploadImage(
    $request,              // Request object
    'img',                 // Input name
    Model::MEDIA_PATH,     // Storage path (e.g. 'customers')
    $item->img             // Old filename (null for new)
);

// Upload file (non-image)
$item->attachment = FilesHelper::uploadFile(
    $request, 'attachment', 'attachments', $item->attachment
);

$item->save();</code></pre>
                </div>
            </div>

            {{-- ╔══════════════════════════════════════════════════════════════╗
                 ║  INPUT MASKS REFERENCE                                      ║
                 ╚══════════════════════════════════════════════════════════════╝ --}}
            <div class="doc-section">
                <h2><i class="bi bi-hash me-2 text-primary"></i>7. Input Masks (helperInputs)</h2>
                <p>These CSS classes are auto-initialized by <code>helperInputs</code>. Just add the class to any <code>&lt;input&gt;</code>.</p>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-2">
                                <label class="form-label fw-semibold" style="font-size:.8rem;">Decimal Mask <code>.decimal_mask</code></label>
                                <input type="text" class="form-control form-control-sm decimal_mask" placeholder="0.00"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-2">
                                <label class="form-label fw-semibold" style="font-size:.8rem;">Integer Mask <code>.integer_mask</code></label>
                                <input type="text" class="form-control form-control-sm integer_mask" placeholder="0"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-2">
                                <label class="form-label fw-semibold" style="font-size:.8rem;">Mobile Mask <code>.mobile_mask</code></label>
                                <input type="text" class="form-control form-control-sm mobile_mask" placeholder="999-999-9999"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-2">
                                <label class="form-label fw-semibold" style="font-size:.8rem;">Email Mask <code>.email_mask</code></label>
                                <input type="text" class="form-control form-control-sm email_mask" placeholder="user@example.com"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-2">
                                <label class="form-label fw-semibold" style="font-size:.8rem;">Payment Card <code>.payment_card_mask</code></label>
                                <input type="text" class="form-control form-control-sm payment_card_mask" placeholder="0000 0000 0000 0000"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-white">
                            <div class="_input_group mb-2">
                                <label class="form-label fw-semibold" style="font-size:.8rem;">Date Mask <code>.date_mask</code></label>
                                <input type="text" class="form-control form-control-sm date_mask" placeholder="DD/MM/YYYY"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered params-table mb-0">
                        <thead>
                            <tr>
                                <th>CSS Class</th>
                                <th>Format</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><code>.decimal_mask</code></td><td><code>0.00</code></td><td>Allows decimal numbers only</td></tr>
                            <tr><td><code>.integer_mask</code></td><td><code>0</code></td><td>Allows integers only (no decimals)</td></tr>
                            <tr><td><code>.mobile_mask</code></td><td><code>999-999-9999</code></td><td>Phone number format</td></tr>
                            <tr><td><code>.email_mask</code></td><td><code>user@domain.com</code></td><td>Email format validation</td></tr>
                            <tr><td><code>.payment_card_mask</code></td><td><code>0000 0000 0000 0000</code></td><td>Credit card number format</td></tr>
                            <tr><td><code>.date_mask</code></td><td><code>DD/MM/YYYY</code></td><td>Date format mask</td></tr>
                            <tr><td><code>.date_picker</code></td><td><code>YYYY-MM-DD</code></td><td>Flatpickr date picker</td></tr>
                            <tr><td><code>.time_picker</code></td><td><code>HH:MM</code></td><td>Flatpickr time picker (24h)</td></tr>
                            <tr><td><code>.datetime_picker</code></td><td><code>YYYY-MM-DD HH:MM</code></td><td>Flatpickr datetime picker</td></tr>
                            <tr><td><code>.date_range_picker</code></td><td><code>YYYY-MM-DD to YYYY-MM-DD</code></td><td>Flatpickr date range</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@stop

@section('doc_style')
<style>
    .doc-upload-zone {
        border: 2px dashed #e2e8f0; border-radius: 10px; padding: 16px; text-align: center;
        transition: border-color .2s; cursor: pointer;
    }
    .doc-upload-zone:hover { border-color: var(--primary); }
    .input-group-text {
        background: #f8fafc; border-color: #e2e8f0; color: #64748b; font-size: .85rem;
    }
    label code {
        background: #f0f9ff; color: #0284c7; padding: 1px 6px; border-radius: 4px;
        font-size: .7rem; font-weight: 500; margin-left: 4px;
    }
</style>
@stop

@section('doc_script')
<script>
    // Password toggle demo
    function togglePwDemo(btn) {
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

    // Image preview demo
    function docPreviewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Number stepper demo
    function docStepNumber(inputId, delta) {
        var input = document.getElementById(inputId);
        var val = parseInt(input.value) || 0;
        var min = parseInt(input.min) || 0;
        var max = parseInt(input.max) || 999;
        input.value = Math.max(min, Math.min(max, val + delta));
    }

    // Color hex display demo
    document.getElementById('doc_color')?.addEventListener('input', function() {
        document.getElementById('doc_color_hex').textContent = this.value;
    });

    // Init Flatpickr for doc demos
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof flatpickr !== 'undefined') {
            document.querySelectorAll('.doc-section .time_picker').forEach(function(el) {
                flatpickr(el, { enableTime: true, noCalendar: true, dateFormat: "H:i", time_24hr: true });
            });
            document.querySelectorAll('.doc-section .datetime_picker').forEach(function(el) {
                flatpickr(el, { enableTime: true, dateFormat: "Y-m-d H:i", time_24hr: true });
            });
            document.querySelectorAll('.doc-section .date_range_picker').forEach(function(el) {
                flatpickr(el, { mode: "range", dateFormat: "Y-m-d" });
            });
        }
    });
</script>
@stop
