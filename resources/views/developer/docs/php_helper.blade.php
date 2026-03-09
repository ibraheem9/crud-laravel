@extends('layouts.cpanel.docs.app')
@section('title', 'PHP Helpers Documentation')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5><i class="bi bi-filetype-php text-primary me-2"></i> PHP Helpers Documentation</h5>
        </div>
        <div class="card-body">
            <div class="info-box">
                <i class="bi bi-info-circle"></i>
                All PHP helpers are located in <code>app/Helpers/</code> and are auto-loaded via <code>composer.json</code> autoload files.
                They are available globally across the entire application without any imports.
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- ApiHelper --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-braces text-success me-2"></i> ApiHelper.php</h6>
        </div>
        <div class="card-body">
            <p>Located at <code>app/Helpers/ApiHelper.php</code> — Provides standardized JSON response format for all AJAX endpoints.</p>

            {{-- sendResponse --}}
            <div class="doc-section">
                <h5>
                    sendResponse()
                    <span class="method-badge" style="background:#dbeafe;color:#1d4ed8;">CORE</span>
                </h5>
                <p>Returns a standardized JSON response. <strong>Every AJAX controller action must use this.</strong></p>

                <table class="table table-bordered params-table">
                    <thead><tr><th>Parameter</th><th>Type</th><th>Default</th><th>Description</th></tr></thead>
                    <tbody>
                        <tr>
                            <td><code>$data</code></td>
                            <td><span class="type-badge" style="background:#dbeafe;color:#1d4ed8;">mixed</span></td>
                            <td>—</td>
                            <td>The response data (model, rendered view HTML, error message, etc.)</td>
                        </tr>
                        <tr>
                            <td><code>$msg</code></td>
                            <td><span class="type-badge" style="background:#f0fdf4;color:#166534;">string</span></td>
                            <td><code>''</code></td>
                            <td>Success/error message shown via toastr</td>
                        </tr>
                        <tr>
                            <td><code>$status</code></td>
                            <td><span class="type-badge" style="background:#fef9c3;color:#854d0e;">bool</span></td>
                            <td><code>true</code></td>
                            <td>Whether the operation succeeded</td>
                        </tr>
                        <tr>
                            <td><code>$code</code></td>
                            <td><span class="type-badge" style="background:#fce7f3;color:#9d174d;">int</span></td>
                            <td><code>200</code></td>
                            <td>HTTP status code</td>
                        </tr>
                    </tbody>
                </table>

                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// ─── Function Signature ─────────────────────────────────────
function sendResponse($data, $msg = '', $status = true, $code = 200)

// ─── Response Format ────────────────────────────────────────
// {
//     "status": true,
//     "msg": "Created successfully",
//     "data": { ... }
// }

// ─── Usage: Success with model data ─────────────────────────
return sendResponse($item, 'Created successfully');

// ─── Usage: Success with rendered view (for modals) ─────────
$view = view('developer.simple_crud.save', compact('item'))->render();
return sendResponse($view);

// ─── Usage: Error response ──────────────────────────────────
return sendResponse($e->getMessage(), 'Error', false, 500);

// ─── Usage: Empty success (delete, status toggle) ───────────
return sendResponse('', 'Deleted successfully');</code></pre>
                </div>

                <div class="success-box">
                    <i class="bi bi-check-circle"></i>
                    <strong>Pattern:</strong> The JS <code>helperForm</code> automatically reads <code>status</code>, shows <code>msg</code> via toastr, and processes <code>data</code>.
                </div>
            </div>

            {{-- getRealIpAddr --}}
            <div class="doc-section">
                <h5>getRealIpAddr()</h5>
                <p>Gets the real client IP address, handling proxies and load balancers.</p>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">$ip = getRealIpAddr();
// Returns: "192.168.1.100"</code></pre>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- FilesHelper --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-image text-warning me-2"></i> FilesHelper.php</h6>
        </div>
        <div class="card-body">
            <p>Located at <code>app/Helpers/FilesHelper.php</code> — Complete file and image management system.</p>

            <div class="info-box">
                <i class="bi bi-info-circle"></i>
                <strong>Storage Convention:</strong> All files are stored in Laravel's <code>storage/app/public/</code> directory.
                You must run <code>php artisan storage:link</code> to make them publicly accessible.
                Each model defines its own <code>MEDIA_PATH</code> constant (e.g., <code>"public/items/images/"</code>).
            </div>

            {{-- uploadImage --}}
            <div class="doc-section">
                <h5>
                    uploadImage()
                    <span class="method-badge" style="background:#fef3c7;color:#92400e;">IMPORTANT</span>
                </h5>
                <p>Uploads an image file to the specified storage path. Automatically generates a unique filename and optionally deletes the old image.</p>

                <table class="table table-bordered params-table">
                    <thead><tr><th>Parameter</th><th>Type</th><th>Default</th><th>Description</th></tr></thead>
                    <tbody>
                        <tr>
                            <td><code>$image</code></td>
                            <td><span class="type-badge" style="background:#dbeafe;color:#1d4ed8;">UploadedFile</span></td>
                            <td>—</td>
                            <td>The image file from <code>$request->img</code></td>
                        </tr>
                        <tr>
                            <td><code>$path</code></td>
                            <td><span class="type-badge" style="background:#f0fdf4;color:#166534;">string</span></td>
                            <td>—</td>
                            <td>Storage path — use the model's <code>MEDIA_PATH</code> constant</td>
                        </tr>
                        <tr>
                            <td><code>$width</code></td>
                            <td><span class="type-badge" style="background:#f0fdf4;color:#166534;">string</span></td>
                            <td><code>''</code></td>
                            <td>Optional width for resizing (requires Intervention Image)</td>
                        </tr>
                        <tr>
                            <td><code>$oldImage</code></td>
                            <td><span class="type-badge" style="background:#f0fdf4;color:#166534;">string</span></td>
                            <td><code>''</code></td>
                            <td>Old image filename to delete (pass <code>$item->img</code> on update)</td>
                        </tr>
                    </tbody>
                </table>

                <h6 class="mt-3 mb-2" style="font-weight:600;font-size:.88rem;">How It Works (Step by Step):</h6>
                <div class="flow-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h6>Delete Old Image (if provided)</h6>
                        <p>If <code>$oldImage</code> is not empty, it calls <code>deleteFile()</code> to remove the old file from storage.</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h6>Generate Unique Filename</h6>
                        <p>Creates a unique name using <code>uniqid(rand())</code> + original extension. Example: <code>14829374621.jpg</code></p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h6>Store File</h6>
                        <p>Uses Laravel's <code>storeAs()</code> to save the file to the specified path in storage.</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h6>Return Filename</h6>
                        <p>Returns only the filename (e.g., <code>"14829374621.jpg"</code>), which is stored in the database column.</p>
                    </div>
                </div>

                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// ─── Function Signature ─────────────────────────────────────
function uploadImage($image, $path, $width = '', $oldImage = '')

// ═══════════════════════════════════════════════════════════════
// EXAMPLE 1: Upload new image (Store action)
// ═══════════════════════════════════════════════════════════════
public function store(SaveSimpleCrudRequest $request)
{
    $item = new SimpleCrud();
    $item->name = $request->name;

    // Upload image if provided
    if ($request->hasFile('img')) {
        $item->img = uploadImage($request->img, SimpleCrud::MEDIA_PATH);
    }

    $item->save();
    return sendResponse($item, 'Created successfully');
}

// ═══════════════════════════════════════════════════════════════
// EXAMPLE 2: Upload and replace old image (Update action)
// ═══════════════════════════════════════════════════════════════
public function update(SaveSimpleCrudRequest $request)
{
    $item = SimpleCrud::findOrFail($request->item_id);
    $item->name = $request->name;

    // Upload new image and delete the old one
    if ($request->hasFile('img')) {
        $item->img = uploadImage(
            $request->img,              // New image file
            SimpleCrud::MEDIA_PATH,     // Storage path: "public/items/images/"
            '',                         // Width (empty = no resize)
            $item->img                  // Old image filename to delete
        );
    }

    $item->save();
    return sendResponse($item, 'Updated successfully');
}

// ═══════════════════════════════════════════════════════════════
// EXAMPLE 3: Multiple images in Advanced CRUD
// ═══════════════════════════════════════════════════════════════
// Profile image
if ($request->hasFile('img')) {
    $customer->img = uploadImage($request->img, AdvancedCrud::MEDIA_PATH, '', $customer->img);
}

// Civil ID image (separate field, same path)
if ($request->hasFile('civil_id_img')) {
    $customer->civil_id_img = uploadImage($request->civil_id_img, AdvancedCrud::MEDIA_PATH, '', $customer->civil_id_img);
}</code></pre>
                </div>

                <div class="warning-box">
                    <i class="bi bi-exclamation-triangle"></i>
                    <strong>Important:</strong> The <code>$path</code> parameter must match the model's <code>MEDIA_PATH</code> constant.
                    Always use <code>ModelName::MEDIA_PATH</code> instead of hardcoding strings.
                </div>
            </div>

            {{-- uploadFile --}}
            <div class="doc-section">
                <h5>uploadFile()</h5>
                <p>Generic file upload (PDFs, documents, etc.). Similar to <code>uploadImage()</code> but without resize support.</p>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// Signature
function uploadFile($file, $path, $oldFile = '')

// Upload a PDF document
if ($request->hasFile('document')) {
    $item->document = uploadFile($request->document, 'public/documents/', $item->document);
}</code></pre>
                </div>
            </div>

            {{-- uploadMultipleFiles --}}
            <div class="doc-section">
                <h5>uploadMultipleFiles()</h5>
                <p>Upload multiple files at once. Returns an array of filenames.</p>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// Signature
function uploadMultipleFiles($files, $path)

// Upload multiple gallery images
if ($request->hasFile('gallery')) {
    $filenames = uploadMultipleFiles($request->gallery, 'public/gallery/');
    // $filenames = ["14829374621.jpg", "14829374622.png", ...]
}</code></pre>
                </div>
            </div>

            {{-- getImageUrl --}}
            <div class="doc-section">
                <h5>
                    getImageUrl()
                    <span class="method-badge" style="background:#dbeafe;color:#1d4ed8;">ACCESSOR</span>
                </h5>
                <p>Returns the full public URL for an image. If the image doesn't exist, returns a default placeholder. <strong>Always used in model accessors.</strong></p>

                <table class="table table-bordered params-table">
                    <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                    <tbody>
                        <tr>
                            <td><code>$media_path</code></td>
                            <td><span class="type-badge" style="background:#f0fdf4;color:#166534;">string</span></td>
                            <td>The model's <code>MEDIA_PATH</code> constant</td>
                        </tr>
                        <tr>
                            <td><code>$img_name</code></td>
                            <td><span class="type-badge" style="background:#f0fdf4;color:#166534;">string</span></td>
                            <td>The image filename stored in the database</td>
                        </tr>
                    </tbody>
                </table>

                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// ─── Function Signature ─────────────────────────────────────
function getImageUrl($media_path, $img_name)

// ─── Usage in Model (STANDARD PATTERN) ──────────────────────
class SimpleCrud extends Model
{
    const MEDIA_PATH = "public/items/images/";

    // Returns full URL: "http://localhost/storage/items/images/14829374621.jpg"
    // Or default placeholder if image doesn't exist
    public function getImgUrlAttribute()
    {
        return getImageUrl(self::MEDIA_PATH, $this->img);
    }

    // Returns HTML img tag for DataTable display
    public function getImgHtmlAttribute()
    {
        return '&lt;img src="' . $this->img_url . '" class="w-50px" /&gt;';
    }
}

// ─── Usage in Blade ─────────────────────────────────────────
&lt;img src="@{{ $item->img_url }}" alt="@{{ $item->name }}" /&gt;

// ─── Usage in DataTable (JS) ────────────────────────────────
// Access via: row.img_url (auto-appended by accessor)</code></pre>
                </div>
            </div>

            {{-- deleteFile --}}
            <div class="doc-section">
                <h5>deleteFile()</h5>
                <p>Deletes a file from Laravel storage. Safe to call even if file doesn't exist.</p>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// Signature
function deleteFile($path)

// Delete a specific file
deleteFile('public/items/images/' . $item->img);

// Note: uploadImage() calls this automatically when $oldImage is provided
// You typically only call this manually when deleting a record</code></pre>
                </div>
            </div>

            {{-- getDefaultImg --}}
            <div class="doc-section">
                <h5>getDefaultImg()</h5>
                <p>Returns the URL to the default placeholder image. Used in JavaScript as <code>defaultImage</code> global variable.</p>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// Returns: "/cpanel/media/avatars/blank.png"
$default = getDefaultImg();

// In layout (set as JS global):
// var defaultImage = @json(getDefaultImg());

// In DataTable JS:
// src="' + (row.img_url || defaultImage) + '"</code></pre>
                </div>
            </div>

            {{-- storageFileCopy --}}
            <div class="doc-section">
                <h5>storageFileCopy()</h5>
                <p>Copies a file within storage with a new unique name. Useful for duplicating records.</p>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// Signature
function storageFileCopy($old_name, $old_path, $new_path)

// Duplicate an item's image
$newImageName = storageFileCopy($item->img, SimpleCrud::MEDIA_PATH, SimpleCrud::MEDIA_PATH);
$newItem->img = $newImageName;</code></pre>
                </div>
            </div>

            {{-- Complete Flow Diagram --}}
            <div class="doc-section">
                <h5>
                    Complete Image Upload Flow
                    <span class="method-badge" style="background:#f0fdf4;color:#166534;">OVERVIEW</span>
                </h5>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// ═══════════════════════════════════════════════════════════════
// COMPLETE FLOW: From Form to Database to Display
// ═══════════════════════════════════════════════════════════════

// STEP 1: Model — Define MEDIA_PATH and accessors
class SimpleCrud extends Model
{
    const MEDIA_PATH = "public/items/images/";

    public function getImgUrlAttribute()
    {
        return getImageUrl(self::MEDIA_PATH, $this->img);
    }
}

// STEP 2: Blade Form — File input with preview
// &lt;input type="file" name="img" accept="image/*" /&gt;

// STEP 3: Controller — Upload on store/update
if ($request->hasFile('img')) {
    $item->img = uploadImage($request->img, SimpleCrud::MEDIA_PATH, '', $item->img);
}
$item->save();

// STEP 4: Database stores only filename
// img = "14829374621.jpg"

// STEP 5: Display — Use accessor
// Blade:  @{{ $item->img_url }}
// JS:     row.img_url (from DataTable JSON)

// STEP 6: File location on disk
// storage/app/public/items/images/14829374621.jpg
// Accessible via: /storage/items/images/14829374621.jpg</code></pre>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- MainHelper --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-tools text-info me-2"></i> MainHelper.php</h6>
        </div>
        <div class="card-body">
            <p>Located at <code>app/Helpers/MainHelper.php</code> — General utility functions.</p>

            <div class="doc-section">
                <h5>dateFormat()</h5>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// Signature
function dateFormat($date, $format = 'd M, Y H:i')

// Usage
echo dateFormat($record->created_at);           // "09 Mar, 2026 14:30"
echo dateFormat($record->dob, 'd/m/Y');         // "30/01/1990"
echo dateFormat($record->dob, 'Y-m-d');         // "1990-01-30"</code></pre>
                </div>
            </div>

            <div class="doc-section">
                <h5>dateText()</h5>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// Returns human-readable date
echo dateText($record->dob);  // "30 Jan, 1990"</code></pre>
                </div>
            </div>

            <div class="doc-section">
                <h5>generateHashID()</h5>
                <div class="code-block">
                    <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">// Generate a unique hash ID
$hashId = generateHashID(8);   // "a1b2c3d4"
$hashId = generateHashID(12);  // "a1b2c3d4e5f6"</code></pre>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- Model Pattern --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-diagram-3 text-purple me-2"></i> Standard Model Pattern</h6>
        </div>
        <div class="card-body">
            <p>Every model follows this exact structure. Copy this as your starting template.</p>
            <div class="code-block">
                <button class="btn btn-sm copy-btn"><i class="bi bi-clipboard me-1"></i> Copy</button>
<pre><code class="language-php">&lt;?php

namespace App\Models\Developer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SimpleCrud extends Model
{
    use SoftDeletes;

    // ─── Media Path (used by FilesHelper) ───────────────────
    const MEDIA_PATH = "public/items/images/";

    // ─── Fillable Fields ────────────────────────────────────
    protected $fillable = [
        'order', 'key', 'name', 'img', 'details',
        'is_active', 'is_featured',
    ];

    // ─── Casts ──────────────────────────────────────────────
    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
    ];

    // ─── Accessors ──────────────────────────────────────────
    public function getImgUrlAttribute()
    {
        return getImageUrl(self::MEDIA_PATH, $this->img);
    }

    public function getImgHtmlAttribute()
    {
        return '&lt;img src="' . $this->img_url . '" class="w-50px rounded" /&gt;';
    }
}</code></pre>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════ --}}
    {{-- Controller Pattern --}}
    {{-- ═══════════════════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <h6><i class="bi bi-code-slash text-danger me-2"></i> Standard Controller Methods</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered params-table">
                <thead><tr><th>Method</th><th>Type</th><th>Description</th></tr></thead>
                <tbody>
                    <tr>
                        <td><code>index()</code></td>
                        <td><span class="type-badge" style="background:#dbeafe;color:#1d4ed8;">GET</span></td>
                        <td>Display the list page with DataTable</td>
                    </tr>
                    <tr>
                        <td><code>datatable()</code></td>
                        <td><span class="type-badge" style="background:#dbeafe;color:#1d4ed8;">GET</span></td>
                        <td>Yajra DataTable server-side data source</td>
                    </tr>
                    <tr>
                        <td><code>saveView($id)</code></td>
                        <td><span class="type-badge" style="background:#dbeafe;color:#1d4ed8;">GET</span></td>
                        <td>Return modal view via AJAX (Simple CRUD only)</td>
                    </tr>
                    <tr>
                        <td><code>create()</code></td>
                        <td><span class="type-badge" style="background:#dbeafe;color:#1d4ed8;">GET</span></td>
                        <td>Show create page (Advanced CRUD only)</td>
                    </tr>
                    <tr>
                        <td><code>edit($id)</code></td>
                        <td><span class="type-badge" style="background:#dbeafe;color:#1d4ed8;">GET</span></td>
                        <td>Show edit page (Advanced CRUD only)</td>
                    </tr>
                    <tr>
                        <td><code>store()</code></td>
                        <td><span class="type-badge" style="background:#f0fdf4;color:#166534;">POST</span></td>
                        <td>Create new record via AJAX</td>
                    </tr>
                    <tr>
                        <td><code>update()</code></td>
                        <td><span class="type-badge" style="background:#fef3c7;color:#92400e;">POST</span></td>
                        <td>Update existing record via AJAX</td>
                    </tr>
                    <tr>
                        <td><code>delete()</code></td>
                        <td><span class="type-badge" style="background:#fce7f3;color:#9d174d;">POST</span></td>
                        <td>Soft delete a record via AJAX</td>
                    </tr>
                    <tr>
                        <td><code>updateStatus()</code></td>
                        <td><span class="type-badge" style="background:#fef3c7;color:#92400e;">POST</span></td>
                        <td>Toggle boolean field (is_active, is_featured, etc.)</td>
                    </tr>
                    <tr>
                        <td><code>multiDelete()</code></td>
                        <td><span class="type-badge" style="background:#fce7f3;color:#9d174d;">POST</span></td>
                        <td>Delete multiple selected records (Advanced CRUD)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
