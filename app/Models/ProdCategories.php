<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdCategories extends Model
{
    use HasFactory;
    public $table = "prod_categories";
    protected $guarded = [];
}
