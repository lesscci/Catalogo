<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function shop()
    {
        if (auth()->check()) {

        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        $cart = $user->carrito;
        dd($cart);
        
        if (!$cart) {
            return response()->json(['message' => 'No se encontró el carrito'], 404);
        }

        $cartProducts = $cart->productos;
        // Tu lógica para mostrar el carrito en la vista de la tienda

        return response()->json($cartProducts);
    }else{
        return response()->json(['message' => 'MAAL'], 401);
        }
    }


    public function cart()
    {
        $user = auth()->user();
        dd($user);
        if ($user) {
            $cart = $user->carrito;
            if ($cart) {
                $cartProducts = $cart->productos;
                // Tu lógica para mostrar el carrito en la vista del carrito
                return response()->json($cartProducts);
            }
        }
        return response()->json(['message' => 'No se encontró el carrito'], 404);
    }

    public function remove(Request $request)
    {
        $cart = Carrito::find(auth()->user()->carrito_id);
        $cart->productos()->detach($request->id);

        return response()->json(['message' => '¡El artículo ha sido eliminado!']);
    }

    public function add(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        $cart = $user->carrito;
        if (!$cart) {
            // Si el usuario no tiene un carrito, puedes crear uno nuevo antes de agregar el producto
            $cart = new Carrito();
            $cart->user_id = $user->id;
            $cart->save();
        }

        $product = Producto::find($request->id);
        if (!$product) {
            return response()->json(['message' => 'No se pudo encontrar el producto'], 404);
        }

        $cart->productos()->attach($product->id, ['cantidad' => $request->quantity]);

        return response()->json(['message' => '¡El artículo ha sido agregado al carrito!']);
    }


    public function update(Request $request)
    {
        $cart = Carrito::find(auth()->user()->carrito_id);
        $cart->productos()->updateExistingPivot($request->id, ['cantidad' => $request->quantity]);

        return response()->json(['message' => '¡El carrito ha sido actualizado!']);
    }

    public function clear()
    {
        $cart = Carrito::find(auth()->user()->carrito_id);
        $cart->productos()->detach();

        return response()->json(['message' => '¡El carrito ha sido vaciado!']);
    }

    public function store(Request $request)
    {
        // Aquí puedes agregar la lógica para almacenar un nuevo producto en el carrito
        // utilizando el id del producto proporcionado en $request->id_producto
        // y la cantidad proporcionada en $request->quantity
        
        // Por ejemplo:
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        $cart = $user->carrito;
        if (!$cart) {
            // Si el usuario no tiene un carrito, puedes crear uno nuevo antes de agregar el producto
            $cart = new Carrito();
            $cart->user_id = $user->id;
            $cart->save();
        }

        $product = Producto::find($request->id_producto);
        if (!$product) {
            return response()->json(['message' => 'No se pudo encontrar el producto'], 404);
        }

        $cart->productos()->attach($product->id, ['cantidad' => $request->quantity]);

        return response()->json(['message' => '¡El artículo ha sido agregado al carrito!']);
    }
}
