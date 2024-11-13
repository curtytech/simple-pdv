<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', ['data' => Product::all()]);
    }

    public function store(ProductStoreRequest $request)
    {
        $validatedData = $request->validated();
    
    
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }
        
        Product::create([
            'name' => $validatedData['name'],
            'sell_price' => $validatedData['sell_price'],
            'barcode' => $validatedData['barcode'],
            'description' => $validatedData['description'] ?? null,
            'image' => $validatedData['image'] ?? null,
        ]);
    
        return redirect()->route('products')->with('success', 'Produto criado com sucesso!');
    }
    

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $product->update([
            'name' => $validatedData['name'],
            'sell_price' => $validatedData['sell_price'],
            'barcode' => $validatedData['barcode'],
            'description' => $validatedData['description'] ?? null,
        ]);

        return to_route('products')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
