<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CheckoutService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutController extends Controller
{

    public function index()
    {
        if (Gate::denies('checkout')) {
            return redirect()->route('meals.index');
        }

        /** @var \App\Models\User */
        $authUser = auth()->user();
        return view('pages.checkout')->with('intent', $authUser->createSetupIntent());
    }

    public function store(Request $request)
    {
        $this->authorize('checkout');
        $request->validate([
            'address_id' => "required",
            "paymentMode" => "required|string",
            "nameOnCard" => "required_if:paymentMode,stripe",
            "paymentMethod" => "required_if:paymentMode,stripe"
        ]);
        ['msg' => $msg, 'status' => $status] = (new CheckoutService)->checkout($request->address_id, $request->nameOnCard, $request->paymentMode, $request->paymentMethod);
        return response()->json([
            'msg' => __($msg)
        ], $status);
    }
}