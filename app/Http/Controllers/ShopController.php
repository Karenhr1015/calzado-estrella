<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $temporadaId = Setting::first()->value;
        if ($temporadaId) {
            $query = Product::where('amount', '>', 1)
                ->where('status', 1)
                ->whereHas('seasons', function ($query) use ($temporadaId) {
                    $query->where('seasons.id', $temporadaId);
                });
        } else {
            $query = Product::where('amount', '>', 1)
                ->where('status', 1);
        }
        $banner = false;
        $filtros = [];

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
            $banner = true;
            $filtros['Producto'] = $request->input('name');
        }

        if ($request->has('woman')) {
            $query->where('product_type_id', 3);
            $query->orWhere('product_type_id', 1);
            $banner = true;
            $filtros['Tipo de producto'] = 'Mujer';
        }
        if ($request->has('men')) {
            $query->where('product_type_id', 2);
            $query->orWhere('product_type_id', 1);
            $banner = true;
            $filtros['Tipo de producto'] = 'Hombre';
        }
        if ($request->has('boys')) {
            $query->where('product_type_id', 4);
            $banner = true;
            $filtros['Tipo de producto'] = 'Niños';
        }
        if ($request->has('girls')) {
            $query->where('product_type_id', 5);
            $banner = true;
            $filtros['Tipo de producto'] = 'Niñas';
        }

        $seasons = Season::where('status', 1)->get();

        // $query->

        $products = $query->latest()->paginate();

        return view('shop.index', compact('products', 'user', 'banner', 'seasons', 'filtros'));
    }

    public function view($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.view', compact('product'));
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
        //
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
    public function destroy(string $id)
    {
        //
    }
}
