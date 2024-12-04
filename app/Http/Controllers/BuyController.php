<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buy::join('products', 'buys.product_id', '=', 'products.id')
        ->join('users', 'buys.user_id', '=', 'users.id')
        ->select('buys.*', 'products.*', 'users.*')
        ->get();
        $products = Product::all();
        $users = User::all();

        return view('buys.index', compact('data', 'products', 'users'));
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
        // Validação dos dados do produto
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'buy_price' => 'required|numeric|min:1',
        ]);

        // Criação do novo produto no banco de dados
        $buy = new Buy();
        $buy->user_id = $validatedData['user_id'];
        $buy->product_id = $validatedData['product_id'];
        $buy->quantity = $validatedData['quantity'] ;
        $buy->buy_price = $validatedData['buy_price'];
        $buy->save();

        // Atualiza o estoque do produto
        $product = Product::find($validatedData['product_id']);
        $product->stock += $validatedData['quantity'];
        $product->save();

        // Redireciona com mensagem de sucesso
        return redirect()->route('buys')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buy $buy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buy $buy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buy $buy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buy $buy)
    {
        //
    }
}
