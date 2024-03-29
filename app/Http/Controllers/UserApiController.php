<?php

namespace App\Http\Controllers;

use App\Events\UserLoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserApiController extends Controller
{
    public function login(Request $req)
    {
        if (!Auth::attempt($req->only('email', 'password'))) {
            //return response()->json([ 'message' => 'Invalid login details', 401 ]);
            return response()->json(['message' => $req["email"] . ',' . $req->password, 401]);
        }

        $user = User::where('email',  $req->email)->firstOrFail();

        //auth()->user()->tokens()->delete();
        /*auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });*/

        $token = $user->createToken('auth_token')->plainTextToken;
        //User from API authenticated, event will be triggered
        $this->user_authenticated();

        return response()->json([
            'user' => $user,
            'token' => $token,
            'loggedin' => 1
        ]);
    }

    public function register(Request $req)
    {
        $user = User::create([
            "name" => $req->name,
            "email" => $req->email,
            "password" => Hash::make($req->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token'  => $token,
            'loggedin' => 1
        ]);
    }
    protected function user_authenticated() {

        $user = Auth::user();
        $user_model = User::find($user->id);

        event(new UserLoginHistory($user_model));
    }
    public function logout(Request $req)
    {
        //Session::flush();
        //Auth::logout();
        //return redirect('login');
        /*$req->user()->currentAccessToken()->delete();
        return 'logged out';*/
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json([
               'message' => 'Logged out successfully!',
               'status_code' => 200
           ], 200);
    }
}
