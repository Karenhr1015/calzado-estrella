<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        /* Validar la existencia del producto */
        $product = Product::where('amount', '>', 1)->where('id', $productId)->firstOrFail();
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado.'], 404);
        }

        $cart = session()->get('cart', []);

        /* Si el producto ya está en el carrito, incrementar la cantidad */
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            $cart[$productId]['total'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
        } else {
            /* Si el producto no está en el carrito, añadirlo */
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => 1,
                "total" => $product->price,
                "price" => $product->price,
                "photo" => $product->photo
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

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }
}
