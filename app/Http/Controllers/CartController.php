<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buy;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Buy::join('products', 'buys.product_id', '=', 'products.id')
        //     ->join('users', 'buys.user_id', '=', 'users.id')
        //     ->select('buys.*', 'products.*', 'users.*')
        //     ->get();

        return view('cart.index', [
            'products' => Buy::with(['product', 'user'])->get(),
        ]);
    }
}
