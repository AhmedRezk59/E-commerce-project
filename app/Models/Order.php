<?php

namespace App\Models;

use App\Casts\TimestampsCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'total_price',
        'paid',
        'status'
    ];

    protected $casts = [
        'updated_at' => TimestampsCast::class,
        'created_at' => TimestampsCast::class,
    ];
    
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot(['updated_at', 'created_at']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
