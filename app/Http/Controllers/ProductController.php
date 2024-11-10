<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index', ['data' => Product::all()]);
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
    public function store(ProductStoreRequest $request)
    {
        $validatedData = $request->validated();

        // if ($request->hasFile('image') && $request->file('image')->isValid()) {
        //     $validatedData['image'] = $request->file('image')->store('products');
        // }

        // dd($validatedData);

        Product::create([
            'name' => $validatedData['name'],
            'sell_price' => $validatedData['sell_price'],
            'barcode' => $validatedData['barcode'],
            'description' => $validatedData['description'] ?? null,
            // 'image' => $validatedData['image'],
        ]);

        return to_route('products')
            ->with('success', 'Produto criado com sucesso!');
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
