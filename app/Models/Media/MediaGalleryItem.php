<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaGalleryItem extends Model
{
    const MEDIA_PATH = 'media/galleries/items/';

    protected $fillable = [
        'gallery_id',
        'image',
        'caption',
        'sort_order',
    ];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(MediaGallery::class, 'gallery_id');
    }

    public function getImageUrlAttribute(): string
    {
        return getImageUrl(self::MEDIA_PATH, $this->image);
    }
}
