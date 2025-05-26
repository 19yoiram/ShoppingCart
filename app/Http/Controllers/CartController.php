<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id, Request $request)
    {
        
        $product = Product::find($id);
        $cart = session('cart', []);
        
        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;

        }else{
             $cart[$id] = [
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'image' => $product->image,
            'description' => $product->description
        ];
        }
       
        session()->put('cart',$cart);
        return back()->with("success",'Product added to the cart.');
        
    }
    
    public function cart(Request $request)
    {
        
            return view('cart'); 
        
    }

    public function cartUpdate(Request $request)
    {
         $cart = session('cart');
        if($request->type == "update"){
        $cart[$request->product_id]["quantity"] = $request->quantity;
        }else{
            unset($cart[$request->product_id]);
            
        }

         session()->put("cart", $cart); 
        return response()->json([
        'success' => view("cartProducts")->render(),
        'count' => count($cart)
    ]);

    }
        
    }

