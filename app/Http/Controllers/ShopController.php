<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
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
        $query = Product::where('amount', '>', 1)->where('status', 1);
        $isWoman = false;

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('woman')) {
            $query->where('product_type_id', 3);
            $isWoman = true;
        }
        if ($request->has('men')) {
            $query->where('product_type_id', 2);
            $isWoman = true;
        }
        if ($request->has('boys')) {
            $query->where('product_type_id', 4);
            $isWoman = true;
        }
        if ($request->has('girls')) {
            $query->where('product_type_id', 5);
            $isWoman = true;
        }

        $seasons = Season::where('status', 1)->get();

        $products = $query->latest()->paginate();

        return view('shop.index', compact('products', 'user', 'isWoman', 'seasons'));
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
