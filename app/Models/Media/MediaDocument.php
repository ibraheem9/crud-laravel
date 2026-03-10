<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class MediaDocument extends Model
{
    const MEDIA_PATH = 'media/documents/';

    protected $fillable = [
        'title',
        'file_name',
        'original_name',
        'type',
        'mime_type',
        'file_size',
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

    /**
     * Determine document type from MIME type.
     */
    public static function detectType(string $mimeType): string
    {
        return match (true) {
            str_contains($mimeType, 'pdf') => 'pdf',
            str_contains($mimeType, 'word') || str_contains($mimeType, 'msword') => 'word',
            str_contains($mimeType, 'excel') || str_contains($mimeType, 'spreadsheet') => 'excel',
            str_contains($mimeType, 'powerpoint') || str_contains($mimeType, 'presentation') => 'powerpoint',
            default => 'other',
        };
    }
}
