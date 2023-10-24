<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdCategory extends Model
{
    use HasFactory;
    public $table = "prod_categories";
    protected $guarded = [];
}
