<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class LimitPurchaseForAgeUnder18
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $req, Closure $next)
    {
        $age = (int) DB::table('view_users')->where('id', Auth::id())->value('age');
        $totalprice = (int) $req->totalprice;
        if ($age < 18 && $totalprice > 10000) {
            return redirect()->route('limit_purchase_for_age_under_18');
        }
        return $next($req);
    }
}
