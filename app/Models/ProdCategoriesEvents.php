<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdCategoriesEvents extends Model
{
    use HasFactory;

    public $table = "prod_categories_events";
    protected $guarded = [];
}
