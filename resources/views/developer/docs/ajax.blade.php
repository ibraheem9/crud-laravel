@extends('layouts.cpanel.docs.app')
@section('title', 'AJAX Patterns')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="bi bi-arrow-repeat text-success me-2"></i> AJAX Patterns</h5>
        </div>
        <div class="card-body">

            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                All AJAX calls use jQuery <code>$.ajax()</code> with CSRF token auto-injected via <code>$.ajaxSetup</code>.
                The standard response format is <code>{ status: bool, msg: string, data: any }</code>.
            </div>

            {{-- Store (Create) --}}
            <div class="doc-section">
                <h2>1. Store (Create New Record)</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">function saveItem(form) {
    var form_data = new FormData(form);

    $.ajax({
        url: baseUrl + '/developer/simpleCrud/store',
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        btn: $('#save_btn'),  // Auto block UI
        success: function(result) {
            if (result.status) {
                toastr.success(result.msg);
                dt.ajax.reload();       // Refresh DataTable
                modal.hide();           // Close modal
                helperForm.resetForm('#item_form');
            } else {
                toastr.error(result.msg);
            }
        },
        error: function(jqXHR) {
            if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                helperForm.showValidationErrors(jqXHR.responseJSON.errors, '#item_form');
            } else {
                helperSwal.exception(jqXHR);
            }
        }
    });
}</code></pre>
                </div>
            </div>

            {{-- Update --}}
            <div class="doc-section">
                <h2>2. Update (Edit Existing Record)</h2>
                <p>Same pattern as store, but check <code>item_id</code> to determine URL:</p>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">var isUpdate = $('#item_form input[name="item_id"]').val() != 0;
var url = isUpdate
    ? baseUrl + '/developer/simpleCrud/update'
    : baseUrl + '/developer/simpleCrud/store';

$.ajax({ url: url, type: 'POST', data: form_data, ... });</code></pre>
                </div>
            </div>

            {{-- Delete --}}
            <div class="doc-section">
                <h2>3. Delete (with Confirmation)</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// Using helperConfirm.delete()
helperConfirm.delete(
    id,                                    // Record ID
    'developer/simpleCrud/delete',         // Route (relative to baseUrl)
    function() {                           // Callback after delete
        dt.ajax.reload();
    }
);

// Controller side:
public function delete(Request $request)
{
    $item = SimpleCrud::findOrFail($request->id);
    $item->delete();  // Soft delete
    return sendResponse('', 'Deleted successfully');
}</code></pre>
                </div>
            </div>

            {{-- Status Toggle --}}
            <div class="doc-section">
                <h2>4. Status Toggle (Inline Switch)</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// ─── DataTable Column Render ────────────────────────────────
render: function(data, type, row) {
    return '&lt;div class="form-check form-switch"&gt;' +
        '&lt;input onclick="updateStatus(\'is_active\', this, ' + row.id + ')" ' +
        (data ? 'checked' : '') +
        ' class="form-check-input" type="checkbox"/&gt;' +
        '&lt;/div&gt;';
}

// ─── Toggle Function ────────────────────────────────────────
function updateStatus(column, element, id) {
    $.ajax({
        url: baseUrl + '/developer/simpleCrud/updateStatus',
        type: 'POST',
        data: { id: id, column: column },
        success: function(result) {
            if (result.status) {
                toastr.success(result.msg);
            } else {
                toastr.error(result.msg);
                element.checked = !element.checked;  // Revert on failure
            }
        },
        error: function(error) {
            helperSwal.exception(error);
            element.checked = !element.checked;
        }
    });
}

// ─── Controller ─────────────────────────────────────────────
public function updateStatus(Request $request)
{
    $item = SimpleCrud::findOrFail($request->id);
    $column = $request->column;
    $item->$column = !$item->$column;
    $item->save();
    return sendResponse('', 'Status updated');
}</code></pre>
                </div>
            </div>

            {{-- Multi-Delete --}}
            <div class="doc-section">
                <h2>5. Multi-Delete (Checkbox Selection)</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// ─── Collect selected IDs ───────────────────────────────────
var ids = [];
$('.checkbox_id:checked').each(function() {
    ids.push($(this).val());
});

// ─── Confirm and delete ─────────────────────────────────────
helperConfirm.confirmProcess(
    'Delete ' + ids.length + ' items?',
    'This action cannot be undone.',
    function() {
        $.ajax({
            url: baseUrl + '/developer/advancedCrud/multiDelete',
            type: 'POST',
            data: { ids: ids },
            success: function(result) {
                if (result.status) {
                    toastr.success(result.msg);
                    dt.ajax.reload();
                }
            }
        });
    }
);

// ─── Controller ─────────────────────────────────────────────
public function multiDelete(Request $request)
{
    AdvancedCrud::whereIn('id', $request->ids)->delete();
    return sendResponse('', 'Deleted successfully');
}</code></pre>
                </div>
            </div>

            {{-- Load Modal via AJAX --}}
            <div class="doc-section">
                <h2>6. Load Modal Content via AJAX</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// ─── Open modal with AJAX-loaded content ────────────────────
function openSaveModal(id) {
    id = id || 0;
    $.ajax({
        url: baseUrl + '/developer/simpleCrud/save/' + id,
        type: 'GET',
        success: function(result) {
            if (result.status) {
                $('#modal_content').html(result.data);
                modal.show();
                initSaveForm();
                CpanelApp.init();  // Re-init inputs (masks, pickers, select2)
            }
        }
    });
}

// ─── Controller ─────────────────────────────────────────────
public function saveView($id = 0)
{
    $item = $id ? SimpleCrud::find($id) : null;
    $view = view('developer.simple_crud.save', compact('item'))->render();
    return sendResponse($view);
}</code></pre>
                </div>
            </div>

            {{-- Page-based Save (Advanced) --}}
            <div class="doc-section">
                <h2>7. Page-based Save with Redirect</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// ─── Form with data-after attribute ─────────────────────────
// &lt;form data-after="{{ route('developer.advancedCrud.index') }}"&gt;

function saveCustomer(form) {
    var form_data = new FormData(form);
    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        data: form_data,
        btn: $('#save_btn'),
        success: function(result) {
            if (result.status) {
                toastr.success(result.msg);
                var redirectUrl = $(form).data('after');
                if (redirectUrl) {
                    setTimeout(function() {
                        window.location.href = redirectUrl;
                    }, 1000);
                }
            }
        }
    });
}</code></pre>
                </div>
            </div>

        </div>
    </div>
@stop
