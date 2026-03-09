<?php

namespace App\Models\Developer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class SimpleCrud extends Model
{
    use SoftDeletes;

    const MEDIA_PATH = "public/items/images/";

    protected $fillable = [
        'order', 'key', 'name', 'img', 'details',
        'is_active', 'is_featured', 'need_auth_code', 'need_reference_id',
    ];

    protected $casts = [
        'is_active'         => 'boolean',
        'is_featured'       => 'boolean',
        'need_auth_code'    => 'boolean',
        'need_reference_id' => 'boolean',
    ];

    // ─── Accessors ──────────────────────────────────────────────

    public function getImgUrlAttribute()
    {
        return getImageUrl(self::MEDIA_PATH, $this->img);
    }

    public function getImgHtmlAttribute()
    {
        return '<img src="' . $this->img_url . '" class="w-50px" />';
    }
}
