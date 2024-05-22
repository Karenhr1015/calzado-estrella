<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Stock::query();

        if ($request->has('name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('name') . '%');
            });
        }

        $stocks = $query->latest()->paginate();

        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('status', 1)->get();

        return view('stocks.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockRequest $request)
    {   
        dd($request->all());
        Stock::create($request->all());

        return to_route('stocks.index')->with('status', __('El producto se ha agregado a inventario correctamente.'));
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
        $stock = Stock::find($id);
        $products = Product::where('status', 1)->get();

        return view('stocks.edit', compact('stock', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockRequest $request, string $id)
    {
        $stock = Stock::find($id);
        $stock->update($request->all());
        return to_route('stocks.index')->with('status', __('El producto en el inventario se ha editado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $stock = Stock::find($id);
        $stock->update(['status' => $request->input('status') ? 0 : 1]);

        if ($request->input('status')) {
            return to_route('stocks.index')->with('status', __('El producto en el inventario se ha inactivado correctamente..'));
        } else {
            return to_route('stocks.index')->with('status', __('El producto en el inventario se ha activado correctamente.'));
        }
    }
}
