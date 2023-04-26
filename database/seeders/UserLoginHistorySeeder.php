<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\userLoginHistory;

class UserLoginHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lastLoginTime = \Carbon\Carbon::now()->toDateTimeString();
        userLoginHistory::create([
            'name' => 'JoseCome',
            'email' => 'admin@example.com',
            'last_login_time' => $lastLoginTime,
        ]);
    }
}
