<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request)
    {
        $pId = $request['id'];
        $cart = session()->get('cart', []);
        if(isset($cart[$pId])) {
            $cart[$pId]['quantity']+=$request['q'];
        } else {
            $cart[$pId] = [
                'name' => $request['name'],
                'quantity' => $request['q'],
                'price' => $request['price']
            ];
        }
        session()->put('cart', $cart);
        return redirect()->route('store')->with('success', 'Item has been added to cart!');
    }

    public function showCheckout()
    {
        return Inertia::render('Store/Checkout', [
            'cart' => session()->get('cart')
        ]);
    }

    public function destroyProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Item removed from cart!');
        }
    }
}
