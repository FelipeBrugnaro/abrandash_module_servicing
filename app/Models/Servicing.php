<?php

namespace Modules\Servicing\app\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'status'
    ];
}
