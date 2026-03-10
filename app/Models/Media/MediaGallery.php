<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MediaGallery extends Model
{
    const MEDIA_PATH = 'media/galleries/';

    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(MediaGalleryItem::class, 'gallery_id')->orderBy('sort_order');
    }

    public function getCoverImageUrlAttribute(): string
    {
        return getImageUrl(self::MEDIA_PATH . 'covers/', $this->cover_image);
    }
}
