<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Product;
use App\Models\sale;
use App\Models\sales_details;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sales.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleRequest $request)
    {
        $validatedData = $request->validated();

        $cart = json_decode($request->input('cart'), true);

        $sale = new Sale();
        $sale->fill($validatedData);
        $sale->uuid = Str::uuid()->toString();
        $sale->user_id = auth()->user()->id;
        $sale->save();

        foreach ($cart as $key_product => $product) {

            $productDb = Product::find($key_product);
            $productDb->update(['amount' => ($productDb->amount - $product['quantity'])]);

            foreach ($product['sizes'] as $key_size => $size) {
                foreach ($size as $key_color => $color) {
                    $sale_detail = new sales_details();

                    $value = [
                        'quantity' => $color['total'],
                        'total_price' => $color['total'] * $product['price'],
                        'sale_id' => $sale->id,
                        'product_id' => $key_product,
                        'size_id' => $key_size,
                        'color_id' => $key_color,
                    ];

                    $sale_detail->fill($value);
                    $sale_detail->save();
                }
            }
        }

        session()->forget('cart');

        return to_route('cart.view')->with('status', __('Su pedido se ha realizado con éxito, el valor del domicilio es un valor independiente, para más información puede contactarse al número: 3012036381'));
    }

    /* Listado de las ventas */
    public function list(Request $request)
    {
        $query = Sale::query();

        if ($request->has('uuid')) {
            $query->where('uuid', 'like', '%' . $request->input('uuid') . '%');
        }

        $sales = $query->latest()->paginate();

        return view('sales.list', compact('sales'));
    }

    /* Detalles de una venta */
    public function show($uuid)
    {
        $sale = Sale::where('uuid', $uuid)
            ->with('sales_details')
            ->with('user')
            ->firstOrFail();

        return view('sales.show', compact('sale'));
    }

    /* Confirmar pago de una venta */
    public function confirm(Request $request, $uuid)
    {
        $sale = Sale::where('uuid', $uuid)->firstOrFail();

        $sale->update(['pay' => $request->input('status') ? 0 : 1]);

        if ($request->input('status')) {
            return to_route('sales.show', $sale->uuid)->with('status', __('El pago de la venta se ha desconfirmado.'));
        } else {
            return to_route('sales.show', $sale->uuid)->with('status', __('El pago de la venta se ha confirmado.'));
        }
    }
}
