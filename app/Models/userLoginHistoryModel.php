<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userLoginHistoryModel extends Model
{
    use HasFactory;

    public $table = "user_login_history";
    protected $guarded = [];
}
