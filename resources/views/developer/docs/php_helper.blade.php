@extends('layouts.cpanel.docs.app')
@section('title', 'PHP Helpers Documentation')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="bi bi-filetype-php text-primary me-2"></i> PHP Helpers Documentation</h5>
        </div>
        <div class="card-body">

            {{-- ApiHelper --}}
            <div class="doc-section">
                <h2>ApiHelper.php</h2>
                <p class="text-muted">Located at <code>app/Helpers/ApiHelper.php</code> - Standard JSON response helper for all AJAX calls.</p>

                <h5>sendResponse()</h5>
                <p>Returns a standardized JSON response for AJAX requests. Used in every controller action.</p>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Signature
function sendResponse($data, $msg = '', $status = true, $code = 200)

// ─── Usage Examples ─────────────────────────────────────────

// Success response
return sendResponse($item, 'Created successfully');

// Success with rendered view (for modals)
$view = view('module.save', compact('item'))->render();
return sendResponse($view);

// Error response
return sendResponse($e->getMessage(), 'Error', false, 500);

// Response format:
// {
//     "status": true,
//     "msg": "Created successfully",
//     "data": { ... }
// }</code></pre>
                </div>

                <h5 class="mt-4">getRealIpAddr()</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Get the real IP address of the client
$ip = getRealIpAddr();</code></pre>
                </div>
            </div>

            {{-- FilesHelper --}}
            <div class="doc-section">
                <h2>FilesHelper.php</h2>
                <p class="text-muted">Located at <code>app/Helpers/FilesHelper.php</code> - File upload, image handling, and deletion utilities.</p>

                <h5>uploadImage()</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Signature
function uploadImage($file, $path, $prefix = '', $oldFile = null)

// ─── Usage Examples ─────────────────────────────────────────

// Upload new image
if ($request->hasFile('img')) {
    $item->img = uploadImage($request->img, SimpleCrud::MEDIA_PATH);
}

// Upload and delete old image
if ($request->hasFile('img')) {
    $item->img = uploadImage($request->img, SimpleCrud::MEDIA_PATH, '', $item->img);
}

// Upload with prefix
$item->img = uploadImage($request->img, 'public/avatars/', 'avatar_');</code></pre>
                </div>

                <h5 class="mt-4">getImageUrl()</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Signature
function getImageUrl($path, $img)

// ─── Usage in Model Accessor ────────────────────────────────
public function getImgUrlAttribute()
{
    return getImageUrl(self::MEDIA_PATH, $this->img);
}</code></pre>
                </div>

                <h5 class="mt-4">getDefaultImg()</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Returns default placeholder image URL
$default = getDefaultImg();</code></pre>
                </div>

                <h5 class="mt-4">deleteFile()</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Signature
function deleteFile($path, $file)

// Delete a file from storage
deleteFile('public/items/images/', $item->img);</code></pre>
                </div>
            </div>

            {{-- MainHelper --}}
            <div class="doc-section">
                <h2>MainHelper.php</h2>
                <p class="text-muted">Located at <code>app/Helpers/MainHelper.php</code> - General utility functions.</p>

                <h5>dateFormat()</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Signature
function dateFormat($date, $format = 'd M, Y H:i')

// ─── Usage ──────────────────────────────────────────────────
echo dateFormat($item->created_at);           // "09 Mar, 2026 14:30"
echo dateFormat($item->dob, 'd/m/Y');         // "30/01/1990"</code></pre>
                </div>

                <h5 class="mt-4">dateText()</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Returns human-readable date text
echo dateText($item->dob);  // "30 Jan, 1990"</code></pre>
                </div>

                <h5 class="mt-4">generateHashID()</h5>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// Generate a unique hash ID
$hashId = generateHashID(8);  // "a1b2c3d4"</code></pre>
                </div>
            </div>

            {{-- Model Pattern --}}
            <div class="doc-section">
                <h2>Model Pattern</h2>
                <p class="text-muted">Standard model structure used across all projects.</p>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">class SimpleCrud extends Model
{
    use SoftDeletes;

    const MEDIA_PATH = "public/items/images/";

    protected $fillable = [
        'order', 'key', 'name', 'img', 'details',
        'is_active', 'is_featured',
    ];

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
        return '&lt;img src="' . $this->img_url . '" class="w-50px" /&gt;';
    }
}</code></pre>
                </div>
            </div>

            {{-- Controller Pattern --}}
            <div class="doc-section">
                <h2>Controller Pattern</h2>
                <p class="text-muted">Standard controller methods for CRUD operations.</p>
                <div class="code-block">
                    <button class="btn btn-sm btn-light copy-btn"><i class="bi bi-clipboard"></i></button>
<pre><code class="language-php">// ─── Standard Controller Methods ────────────────────────────
// index()       → Display list page
// datatable()   → Server-side DataTable source
// saveView($id) → Return modal view (Simple CRUD)
// create()      → Show create page (Advanced CRUD)
// edit($id)     → Show edit page (Advanced CRUD)
// store()       → Create new record
// update()      → Update existing record
// delete()      → Soft delete a record
// updateStatus()→ Toggle boolean field via AJAX
// multiDelete() → Delete multiple selected records</code></pre>
                </div>
            </div>

        </div>
    </div>
@stop
