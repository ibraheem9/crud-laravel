<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class MediaVideo extends Model
{
    const MEDIA_PATH = 'media/videos/';

    protected $fillable = [
        'title',
        'file_name',
        'original_name',
        'thumbnail',
        'mime_type',
        'file_size',
        'duration',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'file_size' => 'integer',
    ];

    public function getFileUrlAttribute(): ?string
    {
        return getFileUrl(self::MEDIA_PATH, $this->file_name);
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return getImageUrl(self::MEDIA_PATH . 'thumbnails/', $this->thumbnail);
        }
        return asset('cpanel/media/svg/files/video.svg');
    }

    public function getFileSizeFormattedAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }
}
