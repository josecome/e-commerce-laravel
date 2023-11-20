<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProdCategory extends Model
{
    use HasFactory;
    public $table = "prod_categories";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function eventprodcategories(): HasMany
    {
        return $this->hasMany(ProdCategoryEvent::class);
    }
    protected $guarded = [];
}
