<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        // dd($request);
        /* Validar la existencia del producto */
        $product = Product::where('amount', '>', 1)->where('id', $productId)->firstOrFail();
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado.'], 404);
        }

        if(!$request->input('size')){
            return response()->json(['success' => false, 'message' => 'Selecciona una talla.'], 404);
        }

        if(!$request->input('color')){
            return response()->json(['success' => false, 'message' => 'Selecciona un color.'], 404);
        }

        $cart = session()->get('cart', []);

        /* Valor de la talla escogida */
        $size_id = $request->input('size');
        $size_value = Size::find($size_id);

        /* Valor del color escogido */
        $color_id = $request->input('color');
        $color_value = Color::find($color_id);

        /* Si el producto ya está en el carrito, incrementar la cantidad */
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;


            if (isset($cart[$productId]['sizes'][$size_id][$color_id])) {
                $cart[$productId]['sizes'][$size_id][$color_id]["total"]++;
            } else {
                $cart[$productId]['sizes'][$size_id][$color_id] = [
                    "name" => $size_value->value,
                    "total" => 1,
                    "color" => $color_value->color
                ];
            }

            $cart[$productId]['total'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
        } else {
            $role_id = auth()->user()->role_id;
            if($role_id == 3){
                $price = $product->wholesale_price;
            }else{
                $price = $product->price;
            }
            /* Si el producto no está en el carrito, añadirlo */
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => 1,
                "total" => $price,
                "price" => $price,
                "photo" => $product->photo,
                "sizes" => [
                    $size_id => [
                        $color_id => [
                            "name" => $size_value->value,
                            "total" => 1,
                            "color" => $color_value->color
                        ]
                    ]
                ],
            ];
        }

        /* Guardar el carrito en la sesión */
        session()->put('cart', $cart);

        /* Calcular totales generales del carrito */
        $cart_total = array_sum(array_column($cart, 'quantity'));
        $cart_total_cost = array_sum(array_column($cart, 'total'));
        session()->put('cart_total', $cart_total);
        session()->put('cart_total_cost', $cart_total_cost);

        return response()->json(['success' => true, 'cartCount' => $cart_total, 'cartTotal' => $cart_total, 'cartTotalCost' => $cart_total_cost]);
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        /* session()->put('cart_total', $cart_total - $cart->quantity);
        session()->put('cart_total_cost', $cart_total_cost->total); */

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('status', 'Producto eliminado del carrito.');
    }
}
