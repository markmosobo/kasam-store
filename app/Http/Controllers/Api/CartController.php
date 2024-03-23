<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CartController extends Controller
{

    public function getCart()
    {
        $cart = session()->get('cart', []);

        return response()->json(['cart' => $cart]);
    }


    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Retrieve product details from the database
        $product = Product::find($productId);

        // Get the current cart items from the session
        $cart = Session::has('cart') ? Session::get('cart') : null;

        //$cart = $request->session()->get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$productId])) {
            // Increment the quantity if the product is already in the cart
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Add the product to the cart if it's not already present
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->selling_price,
                'quantity' => $quantity,
            ];
        }

        // Update the cart in the session
        $request->session()->put('cart', $cart);

        return response()->json([
            'message' => 'Product added to cart successfully',
            'cart' => $cart
        ]);
    }



    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Get the current cart items from the session
        $cart = session()->get('cart', []);

        // Check if the product is in the cart
        if (isset($cart[$productId])) {
            // Update the quantity of the product
            $cart[$productId]['quantity'] = $quantity;

            // Update the cart in the session
            session()->put('cart', $cart);

            return response()->json(['message' => 'Cart updated successfully']);
        }

        return response()->json(['message' => 'Product not found in the cart'], 404);
    }


    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');

        // Get the current cart items from the session
        $cart = session()->get('cart', []);

        // Check if the product is in the cart
        if (isset($cart[$productId])) {
            // Remove the product from the cart
            unset($cart[$productId]);

            // Update the cart in the session
            session()->put('cart', $cart);

            return response()->json(['message' => 'Product removed from cart successfully']);
        }

        return response()->json(['message' => 'Product not found in the cart'], 404);
    }

    public function clearAllCart()
    {
        // Clear the entire cart data from the session
        Session::forget('cart');

        return response()->json(['message' => 'Cart cleared successfully']);
    }

    //meant for carts table
    public function store(Request $request)
    {
        $startOfMonth = Carbon::now()->startOfMonth();
            $formattedDate = $startOfMonth->format('M Y');
            $orgDate = now();
            $date = str_replace('-"', '/', $orgDate);
            $newDate = date("YmdHis", strtotime($date));
            $refNo = $newDate;
        // Assuming Data is your model
       foreach ($request->input('data') as $data) {
            $cartItem = Cart::create([
                'product_id' => $data['id'],
                'name' => $data['name'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'ref_no' => $refNo
            ]);
        }

        

        return response()->json([
            'status' => true,
            'message' => "Cart Retrieved successfully!",
            'cartItem' => $cartItem
        ], 200);
    }

    public function searchSimilarData(Request $request)
    {
        // Retrieve the refNo from the request query parameters
        $refNo = $request->input('refNo');

        // Perform the database query to find similar data
        $similarData = Cart::where('ref_no', 'like', '%' . $refNo . '%')->get();

        // Return the results
         return response()->json([
            'status' => true,
            'message' => "Cart Retrieved successfully!",
            'similarData' => $similarData
        ], 200);
    }

    
}
