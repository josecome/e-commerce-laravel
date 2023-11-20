<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    public $table = "products";
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
    public function eventproducts(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    protected $guarded = [];
}
