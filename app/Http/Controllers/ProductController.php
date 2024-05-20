<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Season;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $seasons = Season::where('status', 1)->get();

        return view('products.create', compact('colors', 'sizes', 'seasons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->all());

        return to_route('products.index')->with('status', __('El producto se ha creado correctamente.'));
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
        $product = Product::find($id);
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $seasons = Season::where('status', 1)->get();

        return view('products.edit',  compact('product', 'colors', 'sizes', 'seasons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return to_route('products.index')->with('status', __('El producto se ha editado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update(['status' => $request->input('status') ? 0 : 1]);
        
        if($request->input('status')){
            return to_route('products.index')->with('status', __('El producto se ha inactivado correctamente..'));
        }else{
            return to_route('products.index')->with('status', __('El producto se ha activado correctamente.'));
        }
    }
}
