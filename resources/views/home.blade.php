@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">          
                <div class="card-header">{{__('Dashboard')}}</div>
                <div class="card-body">

                @session('success')
                    <div class="alert alert-success" >{{$value}}</div>
                @endsession

                    <div class="row">
                 @foreach($products as $key=>$product)
                 <div class="col-md-3">
                    <div class="card">
                        <img width="235px" height="150px" src="{{$product->image}}" alt="" class="cart-img-top p-2">
                        <div class="card-body text-center">
                            <h4>{{$product->name}}</h4>
                            <p>{{$product->description}}</p>
                            <p><strong>Rs.{{$product->price}}</strong></p>
                            <a href="{{route('add.to.cart', $product->id)}}" class="btn btn-warning">Add to Cart</a>
                        </div>
                    </div>
                 </div>
                 @endforeach
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

