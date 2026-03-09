<?php

namespace App\Models\Developer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvancedCrud extends Model
{
    use SoftDeletes;

    const MEDIA_PATH = "public/customers/profile/";

    protected $fillable = [
        'type', 'name', 'email', 'mobile', 'civil_id', 'img', 'civil_id_img',
        'gender', 'dob', 'password', 'color', 'banned_at', 'passport_no',
        'address', 'profession', 'is_vip',
    ];

    protected $casts = [
        'is_vip'    => 'boolean',
        'banned_at' => 'datetime',
        'dob'       => 'date',
    ];

    protected $hidden = ['password'];

    // ─── Accessors ──────────────────────────────────────────────

    public function getImgUrlAttribute()
    {
        return getImageUrl(self::MEDIA_PATH, $this->img);
    }

    public function getImgHtmlAttribute()
    {
        return '<img src="' . $this->img_url . '" class="w-50px rounded-circle" />';
    }
}
