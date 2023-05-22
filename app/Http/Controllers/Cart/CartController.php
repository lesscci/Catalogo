<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $cartItem = Cart::where('user_id', '1')
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // If the item already exists in the cart, update the quantity
            $cartItem->unidades += $quantity;
            $cartItem->save();
        } else {
            // Create a new cart item
            $cartItem = new Cart([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'unidades' => $quantity,
            ]);
            $cartItem->save();
        }

        return response()->json(['message' => 'Product added to cart'], 200);
    }

    public function removeFromCart(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('id', $cartItemId)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart'], 200);
    }
}
