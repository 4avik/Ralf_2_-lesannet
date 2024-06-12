<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pId = $request['id'];
        $product = Product::findOrFail($pId);
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        dd($request);
    }
}
