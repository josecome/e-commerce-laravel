<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\Cart;
use Carbon\Carbon;
use Exception;

class PaymentController extends Controller
{
    public function paypalIndex(Request $request) {
        $userId = Auth::id();
        $amount = DB::table('carts')->where('user_id', '=', $userId
        )->where('purchased', '=', 0
        )->sum('totalprice');
        $amount = number_format( $amount , 0 , '.' , ',' );
        $ids = $request->ids;
        return view('paypal/index', ['amount' => $amount, 'ids' => $ids]);
    }
    public function handlePayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount,
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('confirm_payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentCancel()
    {
        return redirect()
            ->route('home')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
    {
        $userId = Auth::id();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            try {
                $pmnt = new Payment;
                $pmnt->amount = $request->amount;
                $pmnt->user_id = $userId;
                $pmnt->save();
                DB::table('carts')->whereIn(
                    'id',
                    array_map('intval', explode(',', $request->ids))
                )->update([
                    'payment_id' => $pmnt->id,
                    'purchased' => 1
                ]);
            } catch (Exception $e) {
                Storage::disk('local')->put('_' . $userId . '_' . Carbon::today() . '_payment_failed_to_save_in_db.txt', 'User: ' . $userId . ', Amount: ' . $request->amount);
            }
            return redirect()
                ->route('receipt')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('confirm_payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
