<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
        
        $products = Product::all();
        return view('home',compact('products'));
        
        
    }
   
}
