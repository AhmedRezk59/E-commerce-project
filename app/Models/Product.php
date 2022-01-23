<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'photo',
        'content',
        'department_id',
        'trademark_id',
        'color_id',
        'size',
        'size_id',
        'price',
        'start_at',
        'end_at',
        'price_offer',
        'start_offer_at',
        'end_offer_at',
        'weight',
        'weight_id',
        'stock',
        'other_data',
    ];

    public function files() :HasMany
    {
        return $this->hasMany('App\Models\File');
    }
    public function department() : BelongsTo
    {
        return $this->belongsTo('App\Models\Department');
    }
    public function trademark() : BelongsTo
    {
        return $this->belongsTo('App\Models\Trademark');
    }
    public function color() : BelongsTo
    {
        return $this->belongsTo('App\Models\Color');
    }
    public function size_type() : BelongsTo
    {
        return $this->belongsTo('App\Models\Size');
    }
    public function weight_type() : BelongsTo
    {
        return $this->belongsTo('App\Models\Weight');
    }
}
