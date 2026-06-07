<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
public function addToCart(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);
    $qtyToAdd = (int) $request->input('quantity', 1);
    $variation = $request->input('variation');
    $priceInput = $request->input('price');

    // Price fallback logic
    if (!empty($priceInput)) {
        $price = (float) $priceInput;
    } else {
        $price = (float) $product->display_price;
    }

    // Default variation logic: Agar variations mojood hain lekin select nahi hui (e.g. from grid)
    if (empty($variation) && !empty($product->formatted_variations)) {
        $firstVar = $product->formatted_variations[0];
        $variation = $firstVar['weight'];
        $price = (float) $firstVar['price'];
    }

    // Unique key for the cart item based on product ID and variation
    $cartKey = $variation ? $id . '_' . str_replace(' ', '_', $variation) : $id;

    // 1. Duplicate Check: Agar item pehle se cart mein hai
    if(isset($cart[$cartKey])) {
        return response()->json([
            'success' => false,
            'message' => 'This item is already in your cart! Please check your cart.',
            'cart_count' => count($cart)
        ]);
    }

    // 2. Agar item nayi hai, to add karein
    $cart[$cartKey] = [
        "product_id" => $id,
        "name" => $product->name,
        "quantity" => $qtyToAdd,
        "price" => (float) $price,
        "variation" => $variation,
        "image" => $product->image
    ];

    session()->put('cart', $cart);

    return response()->json([
        'success' => true,
        'message' => 'Product added to cart successfully!',
        'cart_count' => count($cart)
    ]);
}

public function index()
{
    $cart = session()->get('cart', []);
    return view('cart', compact('cart'));
}

    // 1. Remove Function
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            return response()->json([
                'success' => true,
                'total' => number_format($this->getCartTotal($cart)),
                'cart_count' => count($cart)
            ]);
        }
    }

    // 2. Update Quantity Function
    public function update(Request $request)
    {
        if($request->id && $request->action) {
            $cart = session()->get('cart');

            if($request->action == 'plus') {
                $cart[$request->id]["quantity"]++;
            } elseif($request->action == 'minus' && $cart[$request->id]["quantity"] > 1) {
                $cart[$request->id]["quantity"]--;
            }

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'quantity' => $cart[$request->id]["quantity"],
                'total' => number_format($this->getCartTotal($cart)),
                'cart_count' => count($cart)
            ]);
        }
    }

    // 3. Update Variation Function
    public function updateVariation(Request $request)
    {
        if($request->id && $request->variation) {
            $cart = session()->get('cart');
            $oldKey = $request->id;
            $newVariationName = $request->variation;

            if(!isset($cart[$oldKey])) {
                return response()->json(['success' => false, 'message' => 'Item not found']);
            }

            $item = $cart[$oldKey];
            $productId = $item['product_id'];
            $product = Product::find($productId);

            if(!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found']);
            }

            // Find the new variation's price
            $newVariation = collect($product->formatted_variations)->firstWhere('weight', $newVariationName);
            if(!$newVariation) {
                return response()->json(['success' => false, 'message' => 'Variation not found']);
            }

            // Create new key
            $newKey = $productId . '_' . str_replace(' ', '_', $newVariationName);

            // If same key, just update price and name (though should be different if variation changed)
            if($oldKey === $newKey) {
                $cart[$oldKey]['variation'] = $newVariationName;
                $cart[$oldKey]['price'] = $newVariation['price'];
            } else {
                // If new key already exists, merge quantities
                if(isset($cart[$newKey])) {
                    $cart[$newKey]['quantity'] += $item['quantity'];
                    unset($cart[$oldKey]);
                } else {
                    // Replace old key with new key
                    $newItem = $item;
                    $newItem['variation'] = $newVariationName;
                    $newItem['price'] = $newVariation['price'];
                    
                    $cart[$newKey] = $newItem;
                    unset($cart[$oldKey]);
                }
            }

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'total' => number_format($this->getCartTotal($cart)),
                'cart_count' => count($cart),
                'redirect' => true // Since keys changed, it's safer to reload or update the DOM heavily
            ]);
        }
    }

    private function getCartTotal($cart)
    {
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

}
