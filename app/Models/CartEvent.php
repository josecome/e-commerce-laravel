<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartEvent extends Model
{
    use HasFactory;

    public $table = "cart_event";
    protected $guarded = [];
}
