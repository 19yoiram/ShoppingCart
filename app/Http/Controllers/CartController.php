<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id, Request $request)
    {

        $product = Product::find($id);
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image,
                'description' => $product->description
            ];
        }

        session()->put('cart', $cart);
        return back()->with("success", 'Product added to the cart.');
    }

    public function cart(Request $request)
    {

        return view('cart');
    }

    public function cartUpdate(Request $request)
    {
        $cart = session('cart');
        if ($request->type == "update") {
            $cart[$request->product_id]["quantity"] = $request->quantity;
        } else {
            unset($cart[$request->product_id]);
        }

        session()->put("cart", $cart);
        return response()->json([
            'success' => view("cartProducts")->render(),
            'count' => count($cart)
        ]);
    }

    public function order(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::user()->id
        ]);
        $amount = 0;
        foreach (session("cart") as $key => $value) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $key,
                'quantity' => $value["quantity"],
                'price' => $value["price"],
            ]);
            $amount = $amount + ($value["quantity"] * $value["price"]);
        }
        $order->amount = $amount;
        $order->save();
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $successURL = route('order.success') . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $order->id;

        $response = $stripe->checkout->sessions->create([
            'success_url' => $successURL,
            'customer_email' => Auth::user()->email,
            'line_items' => [
                [
                    'price_data' => [
                        "product_data" => [
                            "name" => "Shping"
                        ],
                        "unit_amount" => 100 * $amount,
                        "currency" => "USD"
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
        ]);
        return redirect($response['url']);
        // session()->forget('cart');
        // return redirect()->back()->with('success', 'Order created successfully!');
    }


    public function orderSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $session = $stripe->checkout->sessions->retrieve($request->session_id);

        if ($session->status == "complete") {
            $order = Order::find($request->order_id);
            $order->status = 1;
            $order->stripe_id = $session->id;
            $order->save();
            Mail::to($order->user->email)->send(new OrderConfirmation($order));
            session()->forget('cart');
            return redirect()->route("home")->with("success", 'Order placed successfully!');
        }
        $order = Order::find($request->order_id);
        $order->status = 2;
        $order->save();
        dd("Failed.");
    }
    public function orderShow(Request $request)
    {

        $orders = Order::with(['orderDetails.product', 'user'])->get();
        $totalAmount = $orders->sum('amount');
        return view("order", compact('orders', 'totalAmount'));
    }

    public function orderDestroy(Order $order)
    {

        return redirect()->route(route: 'order')
            ->with('success', 'Order deleted successfully.');
    }
}
