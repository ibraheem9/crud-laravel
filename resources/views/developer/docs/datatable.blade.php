@extends('layouts.cpanel.docs.app')
@section('title', 'DataTable Guide — Yajra DataTables')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5><i class="bi bi-table text-info me-2"></i> DataTable Guide — Yajra DataTables</h5>
        </div>
        <div class="card-body">
            <div class="info-box">
                <i class="bi bi-info-circle"></i>
                We use <strong>Yajra DataTables</strong> (<code>yajra/laravel-datatables</code>) for server-side processing with jQuery DataTables.
                All data is fetched via AJAX, paginated and filtered on the server.
            </div>
            <p>This guide covers the complete setup from backend (Controller + Route) to frontend (Blade + JavaScript) with all column patterns used in this project.</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- STEP 1: Installation --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-download text-primary me-2"></i> Step 1: Installation</h6>
        </div>
        <div class="card-body">
            <div class="code-block">
                <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-bash">composer require yajra/laravel-datatables-oracle</code></pre>
            </div>
            <p>The package auto-discovers. No manual service provider registration needed in Laravel 12.</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- STEP 2: Controller --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-code-slash text-success me-2"></i> Step 2: Controller — datatable() Method</h6>
        </div>
        <div class="card-body">
            <p>Every CRUD controller has a <code>datatable()</code> method that returns Yajra DataTables JSON response.</p>

            <div class="doc-section">
                <h5>
                    Simple CRUD DataTable
                    <span class="method-badge" style="background:#dbeafe;color:#1d4ed8;">BASIC</span>
                </h5>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">use Yajra\DataTables\Facades\DataTables;

public function datatable()
{
    // 1. Build query — use orderBy for default sorting
    $data = SimpleCrud::query()->orderBy('order');

    return DataTables::of($data)
        // 2. Add computed columns (from model accessors)
        ->addColumn('img_html', function ($row) {
            return $row->img_html;  // Uses getImgHtmlAttribute()
        })
        // 3. Allow HTML rendering in specified columns
        ->rawColumns(['img_html'])
        // 4. Return JSON response
        ->make(true);
}</code></pre>
                </div>
            </div>

            <div class="doc-section">
                <h5>
                    Advanced CRUD DataTable
                    <span class="method-badge" style="background:#f0fdf4;color:#166534;">ADVANCED</span>
                </h5>
                <p>Same pattern but with relationships and more computed columns.</p>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">public function datatable()
{
    $data = AdvancedCrud::query()
        // ->with('category')        // Eager load relationships
        ->orderBy('id', 'desc');

    return DataTables::of($data)
        ->addColumn('img_html', function ($row) {
            return $row->img_html;
        })
        // Add more computed columns as needed
        // ->addColumn('category_name', function ($row) {
        //     return $row->category?->name ?? '—';
        // })
        ->rawColumns(['img_html'])
        ->make(true);
}</code></pre>
                </div>
            </div>

            <div class="warning-box">
                <i class="bi bi-exclamation-triangle"></i>
                <strong>Key Points:</strong><br>
                &bull; <code>DataTables::of($data)</code> accepts an Eloquent Builder, not a Collection<br>
                &bull; <code>addColumn()</code> adds virtual columns not in the database<br>
                &bull; <code>rawColumns()</code> is required for any column containing HTML<br>
                &bull; Model accessors (like <code>img_url</code>) are automatically included in the JSON
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- STEP 3: Route --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-signpost-2 text-warning me-2"></i> Step 3: Route</h6>
        </div>
        <div class="card-body">
            <div class="code-block">
                <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// routes/web.php
Route::prefix('developer')->name('developer.')->group(function () {

    // Simple CRUD routes
    Route::prefix('simpleCrud')->name('simpleCrud.')->group(function () {
        Route::get('/',          [SimpleCrudController::class, 'index'])->name('index');
        Route::get('/datatable', [SimpleCrudController::class, 'datatable'])->name('datatable');
        // ... other routes
    });
});</code></pre>
            </div>
            <div class="info-box">
                <i class="bi bi-info-circle"></i>
                The DataTable AJAX URL must match this route exactly. In JavaScript: <code>baseUrl + '/developer/simpleCrud/datatable'</code>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- STEP 4: Blade HTML --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-filetype-html text-danger me-2"></i> Step 4: Blade HTML</h6>
        </div>
        <div class="card-body">
            <p>The table HTML is minimal — just headers. DataTables JS fills the body via AJAX.</p>
            <div class="code-block">
                <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-markup">{{-- Search input (outside the table) --}}
&lt;input type="text" class="form-control form-control-sm"
       placeholder="Search..." data-table-filter="search" /&gt;

{{-- DataTable --}}
&lt;table id="items_datatable" class="table table-hover mb-0"&gt;
    &lt;thead&gt;
    &lt;tr&gt;
        &lt;th&gt;ID&lt;/th&gt;
        &lt;th&gt;Image&lt;/th&gt;
        &lt;th&gt;Name&lt;/th&gt;
        &lt;th&gt;Details&lt;/th&gt;
        &lt;th&gt;Active&lt;/th&gt;
        &lt;th&gt;Created&lt;/th&gt;
        &lt;th class="text-end"&gt;Actions&lt;/th&gt;
    &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;&lt;/tbody&gt;
&lt;/table&gt;</code></pre>
            </div>

            <div class="success-box">
                <i class="bi bi-check-circle"></i>
                <strong>Convention:</strong> Table ID is always <code>items_datatable</code>. The <code>&lt;thead&gt;</code> columns must match the <code>columns</code> array in JavaScript exactly (same count, same order).
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- STEP 5: JavaScript --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-filetype-js text-warning me-2"></i> Step 5: JavaScript Initialization (Full Example)</h6>
        </div>
        <div class="card-body">
            <p>This is the complete DataTable JS file. Copy and modify for your CRUD.</p>
            <div class="code-block">
                <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-javascript">"use strict";

var dt;  // Global reference to reload from other files

var KTDatatablesServerSide = function () {

    var initDatatable = function () {
        dt = $("#items_datatable").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],       // Default sort: ID descending
            stateSave: false,
            ajax: {
                url: baseUrl + '/developer/simpleCrud/datatable',
            },

            // ─── Column Definitions ─────────────────────────
            columns: [
                { data: 'id',        name: 'id' },
                { data: 'img_html',  name: 'img' },
                { data: 'name',      name: 'name' },
                { data: 'details',   name: 'details' },
                { data: 'is_active', name: 'is_active' },
                { data: 'created_at',name: 'created_at' },
                { data: null },   // Actions column (no data source)
            ],

            // ─── Column Renderers ───────────────────────────
            columnDefs: [

                // ── ID Column: Badge ────────────────────────
                {
                    targets: 0,
                    render: function (data) {
                        return '&lt;span class="badge" style="background:#f1f5f9;' +
                               'color:#334155;"&gt;#' + data + '&lt;/span&gt;';
                    }
                },

                // ── Image Column ────────────────────────────
                {
                    targets: 1,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return '&lt;img src="' + (row.img_url || defaultImage) +
                               '" style="width:40px;height:40px;border-radius:8px;' +
                               'object-fit:cover;" /&gt;';
                    }
                },

                // ── Name Column ─────────────────────────────
                {
                    targets: 2,
                    render: function (data) {
                        return '&lt;span class="fw-semibold"&gt;' + data + '&lt;/span&gt;';
                    }
                },

                // ── Details Column: Truncate ────────────────
                {
                    targets: 3,
                    render: function (data) {
                        if (!data) return '&lt;span class="text-muted"&gt;—&lt;/span&gt;';
                        var decoded = he.decode(data);
                        return decoded.length > 50
                            ? decoded.substring(0, 50) + '...'
                            : decoded;
                    }
                },

                // ── Status Toggle Switch ────────────────────
                {
                    targets: 4,
                    render: function (data, type, row) {
                        return '&lt;div class="form-check form-switch"&gt;' +
                            '&lt;input onclick="updateStatus(\'is_active\', this, ' +
                            row.id + ')" ' + (data ? 'checked' : '') +
                            ' class="form-check-input" type="checkbox"/&gt;' +
                            '&lt;/div&gt;';
                    }
                },

                // ── Date Column ─────────────────────────────
                {
                    targets: 5,
                    render: function (data) {
                        return helperJS.formatDate(data);
                    }
                },

                // ── Actions Dropdown ────────────────────────
                {
                    targets: -1,
                    orderable: false,
                    searchable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return '&lt;div class="dropdown"&gt;' +
                            '&lt;button class="btn btn-sm btn-light" ' +
                            'data-bs-toggle="dropdown"&gt;' +
                            '&lt;i class="bi bi-three-dots-vertical"&gt;&lt;/i&gt;' +
                            '&lt;/button&gt;' +
                            '&lt;ul class="dropdown-menu dropdown-menu-end"&gt;' +
                            '&lt;li&gt;&lt;a class="dropdown-item edit_btn" ' +
                            'data-id="' + row.id + '"&gt;' +
                            '&lt;i class="bi bi-pencil me-2"&gt;&lt;/i&gt;Edit&lt;/a&gt;&lt;/li&gt;' +
                            '&lt;li&gt;&lt;a class="dropdown-item text-danger delete_btn" ' +
                            'data-id="' + row.id + '"&gt;' +
                            '&lt;i class="bi bi-trash me-2"&gt;&lt;/i&gt;Delete&lt;/a&gt;&lt;/li&gt;' +
                            '&lt;/ul&gt;&lt;/div&gt;';
                    }
                },
            ],
        });

        // ─── Re-bind events after each draw ─────────────────
        dt.on('draw', function () {
            handleDeleteRows();
            handleEditRows();
        });
    };

    // ─── External Search (Debounced) ────────────────────────
    var handleSearchDatatable = function () {
        var filterSearch = document.querySelector('[data-table-filter="search"]');
        if (!filterSearch) return;
        var searchTimeout;
        filterSearch.addEventListener('keyup', function (e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function () {
                dt.search(e.target.value).draw();
            }, 500);
        });
    };

    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
        }
    };
}();

// ─── Initialize on DOM ready ────────────────────────────────
$(document).ready(function () {
    KTDatatablesServerSide.init();
});

// ═══════════════════════════════════════════════════════════════
// Status Toggle (called from switch onclick)
// ═══════════════════════════════════════════════════════════════
function updateStatus(column, element, id) {
    $.ajax({
        url: baseUrl + '/developer/simpleCrud/updateStatus',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id,
            column: column,
        },
        success: function (response) {
            if (response.status) {
                toastr.success(response.msg);
            }
        }
    });
}

// ═══════════════════════════════════════════════════════════════
// Delete Handler (bound after each draw)
// ═══════════════════════════════════════════════════════════════
function handleDeleteRows() {
    $(".delete_btn").off('click').on('click', function () {
        var id = $(this).data('id');
        helperConfirm.delete(function () {
            $.ajax({
                url: baseUrl + '/developer/simpleCrud/delete',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.msg);
                        dt.ajax.reload(null, false);
                    }
                }
            });
        });
    });
}

// ═══════════════════════════════════════════════════════════════
// Edit Handler (bound after each draw)
// ═══════════════════════════════════════════════════════════════
function handleEditRows() {
    $(".edit_btn").off('click').on('click', function () {
        var id = $(this).data('id');
        openSaveModal(id);  // Defined in save.js
    });
}</code></pre>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- Column Patterns Reference --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-grid-3x3-gap text-purple me-2"></i> Column Renderer Patterns</h6>
        </div>
        <div class="card-body">
            <p>Copy-paste these <code>columnDefs</code> renderers for common column types.</p>

            <table class="table table-bordered params-table">
                <thead>
                    <tr><th style="width:160px;">Pattern</th><th>Code</th><th style="width:200px;">Notes</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>ID Badge</strong></td>
                        <td><code>'&lt;span class="badge bg-light text-dark"&gt;#' + data + '&lt;/span&gt;'</code></td>
                        <td>Clean ID display</td>
                    </tr>
                    <tr>
                        <td><strong>Image</strong></td>
                        <td><code>'&lt;img src="' + (row.img_url || defaultImage) + '" style="width:40px;height:40px;border-radius:8px;object-fit:cover;" /&gt;'</code></td>
                        <td>Uses model accessor <code>img_url</code>, falls back to <code>defaultImage</code></td>
                    </tr>
                    <tr>
                        <td><strong>Status Switch</strong></td>
                        <td><code>'&lt;div class="form-check form-switch"&gt;&lt;input onclick="updateStatus(\'column\', this, ' + row.id + ')" ' + (data ? 'checked' : '') + ' class="form-check-input" type="checkbox"/&gt;&lt;/div&gt;'</code></td>
                        <td>Inline toggle, calls <code>updateStatus()</code></td>
                    </tr>
                    <tr>
                        <td><strong>Date</strong></td>
                        <td><code>helperJS.formatDate(data)</code></td>
                        <td>Uses I7 helper for consistent formatting</td>
                    </tr>
                    <tr>
                        <td><strong>Truncated Text</strong></td>
                        <td><code>data &amp;&amp; data.length > 50 ? data.substring(0,50) + '...' : (data || '—')</code></td>
                        <td>Prevents long text from breaking layout</td>
                    </tr>
                    <tr>
                        <td><strong>Boolean Badge</strong></td>
                        <td><code>data ? '&lt;span class="badge bg-success"&gt;Yes&lt;/span&gt;' : '&lt;span class="badge bg-secondary"&gt;No&lt;/span&gt;'</code></td>
                        <td>For non-toggleable booleans</td>
                    </tr>
                    <tr>
                        <td><strong>Color Swatch</strong></td>
                        <td><code>'&lt;span style="display:inline-block;width:20px;height:20px;border-radius:4px;background:' + data + '"&gt;&lt;/span&gt;'</code></td>
                        <td>Shows color from hex value</td>
                    </tr>
                    <tr>
                        <td><strong>Checkbox</strong></td>
                        <td><code>'&lt;input type="checkbox" class="checkbox_id form-check-input" value="' + data + '" /&gt;'</code></td>
                        <td>For multi-select / multi-delete</td>
                    </tr>
                    <tr>
                        <td><strong>Actions Dropdown</strong></td>
                        <td>See full example above</td>
                        <td>Edit + Delete in dropdown menu</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- Advanced: Multi-Delete --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-check2-square text-danger me-2"></i> Advanced: Multi-Delete with Checkboxes</h6>
        </div>
        <div class="card-body">
            <p>Used in the Advanced CRUD. Adds a checkbox column and a "Delete Selected" toolbar button.</p>

            <div class="doc-section">
                <h5>Checkbox Column (columnDefs)</h5>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-javascript">// Add as first column in columns array:
{ data: 'id', name: 'id' },  // targets: 0

// In columnDefs:
{
    targets: 0,
    orderable: false,
    searchable: false,
    render: function (data) {
        return '&lt;input type="checkbox" class="checkbox_id form-check-input" ' +
               'value="' + data + '" /&gt;';
    }
}

// Header checkbox (select all):
// &lt;th&gt;&lt;input type="checkbox" id="select_all" class="form-check-input" /&gt;&lt;/th&gt;</code></pre>
                </div>
            </div>

            <div class="doc-section">
                <h5>Select All + Multi-Delete JS</h5>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-javascript">// Select All checkbox
$('#select_all').on('change', function () {
    var checked = $(this).is(':checked');
    $('.checkbox_id').prop('checked', checked);
    toggleDeleteButton();
});

// Individual checkbox change
$(document).on('change', '.checkbox_id', function () {
    toggleDeleteButton();
});

function toggleDeleteButton() {
    var count = $('.checkbox_id:checked').length;
    if (count > 0) {
        $('#multi_delete_btn').show().find('.count').text(count);
    } else {
        $('#multi_delete_btn').hide();
    }
}

// Multi-delete action
$('#multi_delete_btn').on('click', function () {
    var ids = [];
    $('.checkbox_id:checked').each(function () {
        ids.push($(this).val());
    });

    helperConfirm.delete(function () {
        $.ajax({
            url: baseUrl + '/developer/advancedCrud/multiDelete',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                ids: ids,
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.msg);
                    dt.ajax.reload(null, false);
                    $('#select_all').prop('checked', false);
                    toggleDeleteButton();
                }
            }
        });
    });
});</code></pre>
                </div>
            </div>

            <div class="doc-section">
                <h5>Controller: multiDelete()</h5>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">public function multiDelete(Request $request)
{
    try {
        $ids = $request->ids;
        AdvancedCrud::whereIn('id', $ids)->delete();
        return sendResponse('', 'Deleted successfully');
    } catch (\Exception $e) {
        return sendResponse($e->getMessage(), 'Error', false, 500);
    }
}</code></pre>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- Advanced: Reload Pattern --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-arrow-clockwise text-success me-2"></i> Reloading the DataTable</h6>
        </div>
        <div class="card-body">
            <p>After any CRUD operation (create, update, delete), reload the DataTable to reflect changes.</p>
            <div class="code-block">
                <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-javascript">// Reload and stay on current page
dt.ajax.reload(null, false);

// Reload and go back to page 1
dt.ajax.reload();

// Common usage in helperForm success callback:
helperForm.submit('#save_form', function (response) {
    if (response.status) {
        toastr.success(response.msg);
        $('#item_modal').modal('hide');
        dt.ajax.reload(null, false);  // Refresh table
    }
});</code></pre>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- File Structure --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <h6><i class="bi bi-folder2-open text-info me-2"></i> File Structure Convention</h6>
        </div>
        <div class="card-body">
            <p>Each CRUD has its own JS files organized by function:</p>
            <div class="code-block">
                <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-bash">public/modules/developer/js/
├── simple_crud/
│   ├── datatable.js       # DataTable init + search + delete + edit handlers
│   └── save.js            # Modal open + form submit (helperForm)
├── advanced_crud/
│   ├── datatable.js       # DataTable + multi-delete + checkbox logic
│   └── save.js            # Page form submit (helperForm)
└── crud_with_sort/
    ├── datatable.js       # DataTable init
    ├── save.js            # Modal form submit
    └── sort_items.js      # jQuery UI Sortable + AJAX save order</code></pre>
            </div>

            <div class="success-box">
                <i class="bi bi-check-circle"></i>
                <strong>Convention:</strong> JS files are loaded in the Blade view via <code>@@section('script')</code>:
                <br><code>&lt;script src="&#123;&#123; asset('modules/developer/js/simple_crud/datatable.js') &#125;&#125;"&gt;&lt;/script&gt;</code>
            </div>
        </div>
    </div>
@stop
