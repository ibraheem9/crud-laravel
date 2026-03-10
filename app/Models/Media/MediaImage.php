<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class MediaImage extends Model
{
    const MEDIA_PATH = 'media/images/';

    protected $fillable = [
        'title',
        'image',
        'thumbnail',
        'alt_text',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        return getImageUrl(self::MEDIA_PATH, $this->image);
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return getImageUrl(self::MEDIA_PATH . 'thumbnails/', $this->thumbnail);
        }
        return $this->image_url;
    }
}
