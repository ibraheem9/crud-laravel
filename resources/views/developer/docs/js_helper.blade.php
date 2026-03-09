@extends('layouts.cpanel.docs.app')
@section('title', 'JS Helpers (I7) Documentation')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="bi bi-filetype-js text-warning me-2"></i> I7 JavaScript Helpers Documentation</h5>
        </div>
        <div class="card-body">

            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                All I7 Helpers are loaded globally via <code>layouts/cpanel/styles/i7_helpers.blade.php</code>.
                They are available on every page automatically.
            </div>

            {{-- helperForm --}}
            <div class="doc-section">
                <h2>helperForm</h2>
                <p class="text-muted">Form handling utilities - validation errors, form reset, FormData.</p>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Method</th><th>Description</th><th>Usage</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>showValidationErrors(errors, formSelector)</code></td>
                            <td>Display Laravel validation errors below each input</td>
                            <td><code>helperForm.showValidationErrors(jqXHR.responseJSON.errors, '#myForm')</code></td>
                        </tr>
                        <tr>
                            <td><code>removeValidationErrors()</code></td>
                            <td>Clear all <code>._laravel_error</code> divs</td>
                            <td><code>helperForm.removeValidationErrors()</code></td>
                        </tr>
                        <tr>
                            <td><code>resetForm(formSelector)</code></td>
                            <td>Reset form, clear errors, reset Select2</td>
                            <td><code>helperForm.resetForm('#item_form')</code></td>
                        </tr>
                        <tr>
                            <td><code>preventOnEnter(selector)</code></td>
                            <td>Prevent form submit on Enter key</td>
                            <td><code>helperForm.preventOnEnter('form')</code></td>
                        </tr>
                        <tr>
                            <td><code>getFormData(formSelector)</code></td>
                            <td>Get FormData object from a form</td>
                            <td><code>var fd = helperForm.getFormData('#myForm')</code></td>
                        </tr>
                    </tbody>
                </table>

                <div class="code-block mt-3">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// ─── Validation Error Pattern ───────────────────────────────
// In your AJAX error callback:
error: function(jqXHR) {
    if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
        helperForm.showValidationErrors(jqXHR.responseJSON.errors, '#item_form');
    } else {
        helperSwal.exception(jqXHR);
    }
}

// ─── Required HTML structure for errors ─────────────────────
// &lt;div class="_input_group"&gt;
//     &lt;label&gt;Name&lt;/label&gt;
//     &lt;input name="name" /&gt;
//     &lt;div class="_laravel_error text-danger mt-1"&gt;&lt;/div&gt;
// &lt;/div&gt;</code></pre>
                </div>
            </div>

            {{-- helperSwal --}}
            <div class="doc-section">
                <h2>helperSwal</h2>
                <p class="text-muted">SweetAlert2 wrapper for consistent alert dialogs.</p>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Method</th><th>Description</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><code>helperSwal.success(msg)</code></td><td>Show success alert with auto-close</td></tr>
                        <tr><td><code>helperSwal.error(msg)</code></td><td>Show error alert</td></tr>
                        <tr><td><code>helperSwal.warning(msg)</code></td><td>Show warning alert</td></tr>
                        <tr><td><code>helperSwal.html(html, icon)</code></td><td>Show alert with custom HTML</td></tr>
                        <tr><td><code>helperSwal.exception(error)</code></td><td>Show error from AJAX exception</td></tr>
                    </tbody>
                </table>
            </div>

            {{-- helperConfirm --}}
            <div class="doc-section">
                <h2>helperConfirm</h2>
                <p class="text-muted">Confirmation dialogs with AJAX actions.</p>

                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// ─── Delete with confirmation ───────────────────────────────
helperConfirm.delete(id, 'developer/simpleCrud/delete', function() {
    // Callback after successful delete
    $('#items_datatable').DataTable().ajax.reload();
});

// ─── Custom confirmation ────────────────────────────────────
helperConfirm.confirmProcess(
    'Delete 5 items?',           // title
    'This action cannot be undone.', // text
    function() {                     // confirm callback
        // Do something on confirm
    },
    [],                              // confirm params
    function() {                     // cancel callback (optional)
        // Do something on cancel
    }
);</code></pre>
                </div>
            </div>

            {{-- helperJS --}}
            <div class="doc-section">
                <h2>helperJS</h2>
                <p class="text-muted">General JavaScript utilities.</p>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Method</th><th>Description</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><code>helperJS.consoleLog(msg)</code></td><td>Console log only when APP_DEBUG is true</td></tr>
                        <tr><td><code>helperJS.formatDate(date)</code></td><td>Format date: "9 Mar, 2026 14:30"</td></tr>
                        <tr><td><code>helperJS.formatDateOnly(date)</code></td><td>Format date without time</td></tr>
                        <tr><td><code>helperJS.redirect(url)</code></td><td>Redirect to URL</td></tr>
                        <tr><td><code>helperJS.reloadPage()</code></td><td>Reload current page</td></tr>
                        <tr><td><code>helperJS.getUrlParameter(name)</code></td><td>Get URL query parameter value</td></tr>
                    </tbody>
                </table>
            </div>

            {{-- helperInputs --}}
            <div class="doc-section">
                <h2>helperInputs</h2>
                <p class="text-muted">Input masks and picker initializers. Auto-initialized via <code>CpanelApp.init()</code>.</p>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Method</th><th>CSS Class</th><th>Description</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><code>initDecimalMask()</code></td><td><code>.decimal_mask</code></td><td>Decimal number input (2 digits)</td></tr>
                        <tr><td><code>initIntegerMask()</code></td><td><code>.integer_mask</code></td><td>Integer-only input</td></tr>
                        <tr><td><code>initEmailMask()</code></td><td><code>.email_mask</code></td><td>Email format mask</td></tr>
                        <tr><td><code>initDateMask()</code></td><td><code>.date_mask</code></td><td>Date mask (yyyy-mm-dd)</td></tr>
                        <tr><td><code>initMobileMask()</code></td><td><code>.mobile_mask</code></td><td>Phone format (999-999-9999)</td></tr>
                        <tr><td><code>initDatePicker()</code></td><td><code>.date_picker</code></td><td>Flatpickr date picker</td></tr>
                        <tr><td><code>initTimePicker()</code></td><td><code>.time_picker</code></td><td>Flatpickr time picker (24h)</td></tr>
                        <tr><td><code>initDateTimePicker()</code></td><td><code>.datetime_picker</code></td><td>Flatpickr date + time picker</td></tr>
                        <tr><td><code>initDateRangePicker()</code></td><td><code>.date_range_picker</code></td><td>Flatpickr date range</td></tr>
                        <tr><td><code>initPaymentCardMask()</code></td><td><code>.payment_card_mask</code></td><td>Credit card format</td></tr>
                    </tbody>
                </table>
            </div>

            {{-- helperUI --}}
            <div class="doc-section">
                <h2>helperUI</h2>
                <p class="text-muted">UI utilities for blocking/unblocking elements.</p>

                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// Block a section while loading
helperUI.blockUI('#my_card');

// Unblock after loading
helperUI.unblockUI('#my_card');</code></pre>
                </div>
            </div>

            {{-- Block UI / AJAX Setup --}}
            <div class="doc-section">
                <h2>Block UI (Button Loading State)</h2>
                <p class="text-muted">Automatic button loading state during AJAX calls.</p>

                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// Pass btn option in AJAX call to auto-disable and show spinner
$.ajax({
    url: url,
    type: 'POST',
    data: form_data,
    btn: $('#save_btn'),  // ← This enables auto block UI
    success: function(result) { ... }
});

// The button will:
// 1. Be disabled during the request
// 2. Show "Please wait..." with a spinner
// 3. Restore original text after completion</code></pre>
                </div>
            </div>

        </div>
    </div>
@stop
