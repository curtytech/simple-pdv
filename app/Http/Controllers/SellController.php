<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Sell;
use App\Models\Buy;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sell::join('products', 'sells.product_id', '=', 'products.id')
        ->join('users', 'sells.user_id', '=', 'users.id')
        ->select('sells.*', 'products.name', 'products.sell_price', 'users.name')
        ->get();
        $products = Product::all();
        $users = User::all();

        // $data = DB::select("SELECT u.name as username, p.name as productname, s.quantity as quantity, s.created_at as created_at
        //  FROM sells as s
        // INNER JOIN products as p ON s.product_id = p.id
        // INNER JOIN users as u ON s.user_id = u.id
        // ");


        return view('sells.index', compact('data', 'products', 'users'));    }

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sell $sell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sell $sell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sell $sell)
    {
        //
    }
}
