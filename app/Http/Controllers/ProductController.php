<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
    
        return view('products.index', compact('data'));
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
            'name' => 'required|string|max:255',
            'sell_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'barcode' => 'nullable|integer',
        ]);

        // Criação do novo produto no banco de dados
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->sell_price = $validatedData['sell_price'];
        $product->barcode = $validatedData['barcode'];
        $product->description = $validatedData['description'] ?? null;
        $product->save();

        // Redireciona com mensagem de sucesso
        return redirect()->route('products')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validação dos dados do produto
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sell_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'barcode' => 'nullable|integer',
        ]);
    
        // Atualização dos dados do produto
        $product->name = $validatedData['name'];
        $product->sell_price = $validatedData['sell_price'];
        $product->barcode = $validatedData['barcode'];
        $product->description = $validatedData['description'] ?? null;
        $product->save();
    
        // Redireciona com mensagem de sucesso
        return redirect()->route('products')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
