<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEvents extends Model
{
    use HasFactory;

    public $table = "products_events";
    protected $guarded = [];
}
