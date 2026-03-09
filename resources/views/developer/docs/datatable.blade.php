@extends('layouts.cpanel.docs.app')
@section('title', 'DataTable Guide')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="bi bi-table text-info me-2"></i> DataTable Guide</h5>
        </div>
        <div class="card-body">

            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                We use <strong>Yajra DataTables</strong> for server-side processing with jQuery DataTables.
            </div>

            {{-- Controller Setup --}}
            <div class="doc-section">
                <h2>1. Controller - datatable() Method</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">public function datatable()
{
    $data = SimpleCrud::query()->orderBy('order');

    return DataTables::of($data)
        ->addColumn('img_html', function ($row) {
            return $row->img_html;  // Model accessor
        })
        ->rawColumns(['img_html'])  // Allow HTML rendering
        ->make(true);
}</code></pre>
                </div>
            </div>

            {{-- Route Setup --}}
            <div class="doc-section">
                <h2>2. Route</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">Route::get('/datatable', [SimpleCrudController::class, 'datatable'])->name('datatable');</code></pre>
                </div>
            </div>

            {{-- Blade HTML --}}
            <div class="doc-section">
                <h2>3. Blade HTML</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">&lt;table id="items_datatable" class="table table-row-bordered table-hover gy-4 gs-4"&gt;
    &lt;thead&gt;
    &lt;tr class="fw-bold text-muted"&gt;
        &lt;th&gt;ID&lt;/th&gt;
        &lt;th&gt;Image&lt;/th&gt;
        &lt;th&gt;Name&lt;/th&gt;
        &lt;th&gt;Active&lt;/th&gt;
        &lt;th&gt;Created&lt;/th&gt;
        &lt;th class="text-end"&gt;Actions&lt;/th&gt;
    &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;&lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                </div>
            </div>

            {{-- JavaScript --}}
            <div class="doc-section">
                <h2>4. JavaScript Initialization</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">"use strict";

var dt;

var KTDatatablesServerSide = function() {
    var initDatatable = function() {
        dt = $("#items_datatable").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: {
                url: baseUrl + '/developer/simpleCrud/datatable',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'img_html', name: 'img' },
                { data: 'name', name: 'name' },
                { data: 'is_active', name: 'is_active' },
                { data: 'created_at', name: 'created_at' },
                { data: null },
            ],
            columnDefs: [
                // ─── ID Column ──────────────────────────────
                {
                    targets: 0,
                    render: function(data) {
                        return '&lt;span class="badge bg-light text-dark"&gt;#' + data + '&lt;/span&gt;';
                    }
                },
                // ─── Image Column ───────────────────────────
                {
                    targets: 1,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '&lt;img src="' + (row.img_url || defaultImage) +
                               '" style="width:40px;height:40px;object-fit:cover;" /&gt;';
                    }
                },
                // ─── Status Toggle ──────────────────────────
                {
                    targets: 3,
                    render: function(data, type, row) {
                        return '&lt;div class="form-check form-switch"&gt;' +
                            '&lt;input onclick="updateStatus(\'is_active\', this, ' + row.id + ')" ' +
                            (data ? 'checked' : '') +
                            ' class="form-check-input" type="checkbox"/&gt;' +
                            '&lt;/div&gt;';
                    }
                },
                // ─── Date Column ────────────────────────────
                {
                    targets: 4,
                    render: function(data) {
                        return helperJS.formatDate(data);
                    }
                },
                // ─── Actions Column ─────────────────────────
                {
                    targets: -1,
                    orderable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return '&lt;div class="dropdown"&gt;' +
                            '&lt;button class="btn btn-sm btn-light" data-bs-toggle="dropdown"&gt;' +
                            'Actions &lt;i class="bi bi-chevron-down"&gt;&lt;/i&gt;&lt;/button&gt;' +
                            '&lt;ul class="dropdown-menu"&gt;' +
                            '&lt;li&gt;&lt;a class="dropdown-item edit_btn" data-id="' + row.id + '"&gt;Edit&lt;/a&gt;&lt;/li&gt;' +
                            '&lt;li&gt;&lt;a class="dropdown-item text-danger delete_btn" data-id="' + row.id + '"&gt;Delete&lt;/a&gt;&lt;/li&gt;' +
                            '&lt;/ul&gt;&lt;/div&gt;';
                    }
                },
            ],
        });

        // Re-bind events after each draw
        dt.on('draw', function() {
            handleDeleteRows();
            handleEditRows();
        });
    };

    return {
        init: function() { initDatatable(); }
    };
}();

$(document).ready(function() {
    KTDatatablesServerSide.init();
});</code></pre>
                </div>
            </div>

            {{-- Search --}}
            <div class="doc-section">
                <h2>5. External Search Input</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-javascript">// HTML: &lt;input data-table-filter="search" /&gt;

var filterSearch = document.querySelector('[data-table-filter="search"]');
var searchTimeout;
filterSearch.addEventListener('keyup', function(e) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(function() {
        dt.search(e.target.value).draw();
    }, 500);  // Debounce 500ms
});</code></pre>
                </div>
            </div>

            {{-- Column Types Reference --}}
            <div class="doc-section">
                <h2>6. Common Column Patterns</h2>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Pattern</th><th>Use Case</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Badge</td><td><code>'&lt;span class="badge bg-light"&gt;#' + data + '&lt;/span&gt;'</code></td></tr>
                        <tr><td>Image</td><td><code>'&lt;img src="' + row.img_url + '" style="width:40px" /&gt;'</code></td></tr>
                        <tr><td>Status Switch</td><td><code>'&lt;input type="checkbox" onclick="updateStatus(...)" /&gt;'</code></td></tr>
                        <tr><td>Date Format</td><td><code>helperJS.formatDate(data)</code></td></tr>
                        <tr><td>Truncate Text</td><td><code>data.length > 50 ? data.substring(0,50) + '...' : data</code></td></tr>
                        <tr><td>Dropdown Actions</td><td>Edit, View, Delete in a dropdown menu</td></tr>
                        <tr><td>Checkbox (Multi-select)</td><td><code>'&lt;input type="checkbox" class="checkbox_id" value="' + data + '" /&gt;'</code></td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@stop
