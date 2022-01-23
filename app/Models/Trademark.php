<?php

namespace App\Models;

use App\Casts\TimestampsCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
    ];

    protected $casts = [
        'updated_at' => TimestampsCast::class,
        'created_at' => TimestampsCast::class,
    ];
}
