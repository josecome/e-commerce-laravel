<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $dates = ['deleted_at'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public $table = "carts";
    public function eventcarts(): HasMany
    {
        return $this->hasMany(CartEvent::class);
    }
    protected $guarded = [];
}
