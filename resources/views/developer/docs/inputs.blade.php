@extends('layouts.cpanel.docs.app')
@section('title', 'Input Components')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="bi bi-input-cursor-text text-danger me-2"></i> Input Components Guide</h5>
        </div>
        <div class="card-body">

            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                All input components follow the <code>_input_group</code> pattern with <code>_laravel_error</code> for validation.
                Masks and pickers are auto-initialized by <code>CpanelApp.init()</code> using CSS classes.
            </div>

            {{-- Standard Input Group --}}
            <div class="doc-section">
                <h2>1. Standard Input Group Pattern</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;!-- Required field --&gt;
&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label fw-bold required"&gt;Name&lt;/label&gt;
    &lt;input value="@{{ old_value }}" name="name" type="text"
           class="form-control" placeholder="Enter name"/&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;!-- Optional field --&gt;
&lt;div class="_input_group mb-3"&gt;
    &lt;label class="form-label fw-bold"&gt;Details&lt;/label&gt;
    &lt;textarea name="details" class="form-control" rows="3"&gt;@{{ old_value }}&lt;/textarea&gt;
    &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
            </div>

            {{-- Live Examples --}}
            <div class="doc-section">
                <h2>2. Live Input Examples</h2>
                <form id="demo_form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="_input_group mb-3">
                                <label class="form-label fw-bold">Decimal Mask</label>
                                <input type="text" class="form-control decimal_mask" placeholder="0.00"/>
                                <small class="text-muted">Class: <code>.decimal_mask</code></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="_input_group mb-3">
                                <label class="form-label fw-bold">Integer Mask</label>
                                <input type="text" class="form-control integer_mask" placeholder="0"/>
                                <small class="text-muted">Class: <code>.integer_mask</code></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="_input_group mb-3">
                                <label class="form-label fw-bold">Email Mask</label>
                                <input type="text" class="form-control email_mask" placeholder="user@example.com"/>
                                <small class="text-muted">Class: <code>.email_mask</code></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="_input_group mb-3">
                                <label class="form-label fw-bold">Date Picker</label>
                                <input type="text" class="form-control date_picker" placeholder="2026-01-01"/>
                                <small class="text-muted">Class: <code>.date_picker</code></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="_input_group mb-3">
                                <label class="form-label fw-bold">Time Picker</label>
                                <input type="text" class="form-control time_picker" placeholder="14:30"/>
                                <small class="text-muted">Class: <code>.time_picker</code></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="_input_group mb-3">
                                <label class="form-label fw-bold">DateTime Picker</label>
                                <input type="text" class="form-control datetime_picker" placeholder="2026-01-01 14:30"/>
                                <small class="text-muted">Class: <code>.datetime_picker</code></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="_input_group mb-3">
                                <label class="form-label fw-bold">Date Range Picker</label>
                                <input type="text" class="form-control date_range_picker" placeholder="2026-01-01 to 2026-01-31"/>
                                <small class="text-muted">Class: <code>.date_range_picker</code></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="_input_group mb-3">
                                <label class="form-label fw-bold">Mobile Mask</label>
                                <input type="text" class="form-control mobile_mask" placeholder="999-999-9999"/>
                                <small class="text-muted">Class: <code>.mobile_mask</code></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="_input_group mb-3">
                                <label class="form-label fw-bold">Payment Card Mask</label>
                                <input type="text" class="form-control payment_card_mask" placeholder="0000 0000 0000 0000"/>
                                <small class="text-muted">Class: <code>.payment_card_mask</code></small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Select2 --}}
            <div class="doc-section">
                <h2>3. Select2 Dropdown</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="_input_group mb-3">
                            <label class="form-label fw-bold">Select2 Example</label>
                            <select class="form-select" data-control="select2" data-placeholder="Choose an option">
                                <option></option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;select name="type" class="form-select" data-control="select2" data-placeholder="Select Type"&gt;
    &lt;option&gt;&lt;/option&gt;
    &lt;option value="customer"&gt;Customer&lt;/option&gt;
    &lt;option value="guardian"&gt;Guardian&lt;/option&gt;
&lt;/select&gt;

&lt;!-- Auto-initialized by CpanelApp.init() via data-control="select2" --&gt;</code></pre>
                </div>
            </div>

            {{-- Switch Toggle --}}
            <div class="doc-section">
                <h2>4. Switch Toggle (Boolean)</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="_input_group mb-3">
                            <label class="form-label fw-bold">Active Status</label>
                            <div class="form-check form-switch">
                                <input name="is_active" type="hidden" value="0"/>
                                <input name="is_active" class="form-check-input" type="checkbox" value="1" checked/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;!-- Hidden input ensures "0" is sent when unchecked --&gt;
&lt;div class="form-check form-switch"&gt;
    &lt;input name="is_active" type="hidden" value="0"/&gt;
    &lt;input @@if($item && $item->is_active) checked @@endif
           name="is_active" class="form-check-input" type="checkbox" value="1"/&gt;
&lt;/div&gt;</code></pre>
                </div>
            </div>

            {{-- Radio Buttons --}}
            <div class="doc-section">
                <h2>5. Radio Buttons</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="d-flex gap-3"&gt;
    &lt;div class="form-check"&gt;
        &lt;input @@if($item && $item->gender == 'male') checked @@endif
               name="gender" class="form-check-input" type="radio" value="male" id="gender_male"/&gt;
        &lt;label class="form-check-label" for="gender_male"&gt;Male&lt;/label&gt;
    &lt;/div&gt;
    &lt;div class="form-check"&gt;
        &lt;input @@if($item && $item->gender == 'female') checked @@endif
               name="gender" class="form-check-input" type="radio" value="female" id="gender_female"/&gt;
        &lt;label class="form-check-label" for="gender_female"&gt;Female&lt;/label&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                </div>
            </div>

            {{-- Color Picker --}}
            <div class="doc-section">
                <h2>6. Color Picker</h2>
                <div class="row">
                    <div class="col-md-3">
                        <div class="_input_group mb-3">
                            <label class="form-label fw-bold">Favorite Color</label>
                            <input type="color" class="form-control form-control-color" value="#3b82f6"
                                   style="width: 60px; height: 40px;"/>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;input value="@{{ $item->color ?? '#3b82f6' }}" name="color" type="color"
       class="form-control form-control-color" style="width: 60px; height: 40px;"/&gt;</code></pre>
                </div>
            </div>

            {{-- Image Upload with Preview --}}
            <div class="doc-section">
                <h2>7. Image Upload with Preview</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;div class="text-center"&gt;
    &lt;div class="mb-3"&gt;
        &lt;img id="img_preview" src="@{{ $item ? $item->img_url : getDefaultImg() }}"
             class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;"/&gt;
    &lt;/div&gt;
    &lt;input name="img" type="file" class="form-control" accept="image/*"
           onchange="previewImage(this, 'img_preview')"/&gt;
&lt;/div&gt;

&lt;script&gt;
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
&lt;/script&gt;</code></pre>
                </div>
            </div>

            {{-- Password with Toggle --}}
            <div class="doc-section">
                <h2>8. Password with Toggle Visibility</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="_input_group mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Min 8 characters"/>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">function togglePassword(btn) {
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
            </div>

        </div>
    </div>
@stop
