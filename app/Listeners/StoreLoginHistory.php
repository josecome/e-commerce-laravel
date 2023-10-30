<?php

namespace App\Listeners;

use App\Events\UserLoginHistory;
use App\Mail\UserLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\userLoginHistoryModel;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class StoreLoginHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserLoginHistory  $event
     * @return void
     */
    public function handle(UserLoginHistory $event)
    {
        $lastLoginTime = \Carbon\Carbon::now()->toDateTimeString();
        $userData = $event->user;
        $current_user = User::where('email', $userData->email)->first();

        $input['name'] = $current_user->name;
        $input['email'] = $current_user->email;
        $input['last_login_time'] = $lastLoginTime;
        Mail::to($current_user->email)->send(new UserLogin($current_user));
        return userLoginHistoryModel::create($input);
    }
}
