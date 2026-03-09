<?php

namespace App\Models\Developer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrudWithSort extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'is_active', 'order', 'name', 'days',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
