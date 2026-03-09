@extends('layouts.cpanel.docs.app')
@section('title', 'Layout Guide')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="bi bi-layout-sidebar text-secondary me-2"></i> Layout Guide</h5>
        </div>
        <div class="card-body">

            {{-- Layout Structure --}}
            <div class="doc-section">
                <h2>1. Layout File Structure</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-bash">resources/views/layouts/cpanel/
├── app.blade.php              # Main layout (head, body, scripts)
├── aside/
│   └── aside.blade.php        # Sidebar navigation
├── header/
│   └── header.blade.php       # Top header bar
└── styles/
    └── i7_helpers.blade.php   # I7 JS Helpers (inline script)
└── docs/
    └── app.blade.php          # Documentation layout (extends cpanel/app)</code></pre>
                </div>
            </div>

            {{-- Blade Sections --}}
            <div class="doc-section">
                <h2>2. Available Blade Sections</h2>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Section</th><th>Purpose</th><th>Required</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><code>@@section('title')</code></td><td>Page title (shown in header and browser tab)</td><td>Yes</td></tr>
                        <tr><td><code>@@section('toolbar')</code></td><td>Sub-header with breadcrumb and action buttons</td><td>Optional</td></tr>
                        <tr><td><code>@@section('content')</code></td><td>Main page content</td><td>Yes</td></tr>
                        <tr><td><code>@@section('style')</code></td><td>Additional CSS (injected in head)</td><td>Optional</td></tr>
                        <tr><td><code>@@section('script')</code></td><td>Additional JS (injected before closing body)</td><td>Optional</td></tr>
                    </tbody>
                </table>
            </div>

            {{-- Page Template --}}
            <div class="doc-section">
                <h2>3. Standard Page Template</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-markup">@@extends('layouts.cpanel.app')
@@section('title', 'My Page Title')

@@section('toolbar')
    &lt;div class="bg-white border-bottom px-4 py-3"&gt;
        &lt;div class="container-fluid d-flex align-items-center justify-content-between"&gt;
            &lt;div&gt;
                &lt;h5 class="mb-0"&gt;Page Title&lt;/h5&gt;
                &lt;small class="text-muted"&gt;Description text&lt;/small&gt;
            &lt;/div&gt;
            &lt;div&gt;
                &lt;button class="btn btn-primary btn-sm"&gt;
                    &lt;i class="bi bi-plus-lg me-1"&gt;&lt;/i&gt; Add New
                &lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
@@stop

@@section('content')
    &lt;div class="card"&gt;
        &lt;div class="card-header"&gt;
            &lt;h6 class="card-title mb-0"&gt;Card Title&lt;/h6&gt;
        &lt;/div&gt;
        &lt;div class="card-body"&gt;
            &lt;!-- Content here --&gt;
        &lt;/div&gt;
    &lt;/div&gt;
@@stop

@@section('script')
    &lt;script src="{{ asset('modules/mymodule/js/page.js') }}"&gt;&lt;/script&gt;
@@stop</code></pre>
                </div>
            </div>

            {{-- JS File Organization --}}
            <div class="doc-section">
                <h2>4. JavaScript File Organization</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-bash">public/modules/{module_name}/js/{feature}/
├── datatable.js    # DataTable initialization and column definitions
├── save.js         # Form submission (store/update) logic
└── sort_items.js   # Sort functionality (if applicable)

# Example:
public/modules/developer/js/simple_crud/
├── datatable.js    # KTDatatablesServerSide pattern
└── save.js         # openSaveModal(), saveItem()</code></pre>
                </div>
            </div>

            {{-- Global Variables --}}
            <div class="doc-section">
                <h2>5. Global JavaScript Variables</h2>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Variable</th><th>Type</th><th>Description</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><code>baseUrl</code></td><td>String</td><td>Application base URL (e.g., <code>http://localhost:8000</code>)</td></tr>
                        <tr><td><code>APP_DEBUG</code></td><td>Boolean</td><td>Laravel debug mode status</td></tr>
                        <tr><td><code>defaultImage</code></td><td>String</td><td>Default placeholder image URL</td></tr>
                        <tr><td><code>Lang</code></td><td>Object</td><td>Translation helper with <code>Lang.get('key')</code></td></tr>
                    </tbody>
                </table>
            </div>

            {{-- CRUD Types Comparison --}}
            <div class="doc-section">
                <h2>6. CRUD Types Comparison</h2>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr><th>Feature</th><th>Simple (Modal)</th><th>Advanced (Page)</th><th>With Sort</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Form Location</td><td>Bootstrap Modal</td><td>Separate Page</td><td>Bootstrap Modal</td></tr>
                        <tr><td>Form Loading</td><td>AJAX (saveView)</td><td>Direct Page</td><td>Inline in page</td></tr>
                        <tr><td>After Save</td><td>Close modal + reload DT</td><td>Redirect to list</td><td>Close modal + reload DT</td></tr>
                        <tr><td>Image Upload</td><td>Yes (simple)</td><td>Yes (with preview)</td><td>No</td></tr>
                        <tr><td>Status Toggle</td><td>Yes</td><td>Yes</td><td>No</td></tr>
                        <tr><td>Multi-Delete</td><td>No</td><td>Yes (checkboxes)</td><td>No</td></tr>
                        <tr><td>Drag & Drop Sort</td><td>No</td><td>No</td><td>Yes (jQuery UI)</td></tr>
                        <tr><td>Best For</td><td>Simple entities</td><td>Complex forms</td><td>Ordered lists</td></tr>
                    </tbody>
                </table>
            </div>

            {{-- Route Naming Convention --}}
            <div class="doc-section">
                <h2>7. Route Naming Convention</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Pattern: {prefix}.{feature}.{action}
Route::prefix('developer')->name('developer.')->group(function () {
    Route::prefix('simpleCrud')->name('simpleCrud.')->group(function () {
        Route::get('/', [Controller::class, 'index'])->name('index');
        Route::get('/datatable', [Controller::class, 'datatable'])->name('datatable');
        Route::get('/save/{id?}', [Controller::class, 'saveView'])->name('saveView');
        Route::post('/store', [Controller::class, 'store'])->name('store');
        Route::post('/update', [Controller::class, 'update'])->name('update');
        Route::delete('/delete', [Controller::class, 'delete'])->name('delete');
        Route::post('/updateStatus', [Controller::class, 'updateStatus'])->name('updateStatus');
    });
});</code></pre>
                </div>
            </div>

            {{-- Request Validation --}}
            <div class="doc-section">
                <h2>8. Form Request Validation</h2>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// File: app/Http/Requests/Developer/SaveSimpleCrudRequest.php

class SaveSimpleCrudRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'details' => 'nullable|string',
            'img'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}

// Usage in Controller:
public function store(SaveSimpleCrudRequest $request) { ... }
// Laravel auto-returns 422 with errors JSON on validation failure</code></pre>
                </div>
            </div>

        </div>
    </div>
@stop
