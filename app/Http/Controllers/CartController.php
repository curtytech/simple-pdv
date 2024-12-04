<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buy;
use App\Models\Sell;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buy::join('products', 'buys.product_id', '=', 'products.id')
            ->join('users', 'buys.user_id', '=', 'users.id')
            ->where('products.stock', '>', 0) 
            ->select('products.*')
            ->get();

        return view('cart.index', compact('data'));
    }

    public function sendcart(Request $request)
    {

        dump($request);

        // Valida os dados recebidos
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Processa e salva os dados no banco de dados
        foreach ($validated['products'] as $product) {
            Sell::create([
                'user_id' => auth()->id(),
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Carrinho salvo com sucesso!'
        ]);
    }
}
