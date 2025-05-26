@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{__('Cart')}}</div>
                <div class="card-body">
                    <div class="row" id="cart-products">
                       @include('cartProducts')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
 <script>
    $("body").on("change", ".quantity",function(e){
        var elem = $(this);
        $(this).attr("disabled",true);
       $.ajax({
        type: "POST",
        url: "{{route('cart.update')}}",
        data: {
            _token: "{{ csrf_token()}}",
            type: "update",
            product_id: elem.parents("tr").attr("data-id"),
            quantity: elem.val()
        },
        
        success: function (response) {
            $("#cart-products").html(response.success);
           $("#cart-count").text("(" + response.count + ")");
            console.log(response);
        }
       });
    })


     $("body").on("click", ".remove-from-cart", function(e){
        var elem = $(this);
       $.ajax({
        type: "POST",
        url: "{{route('cart.update')}}",
        data: {
            _token: "{{ csrf_token()}}",
            type: "delete",
            product_id: elem.parents("tr").attr("data-id"),
        },
        success: function (response) {
            $("#cart-products").html(response.success);
            $("#cart-count").text("My Cart(" + response.count + ")");
             console.log(response);
          
        },

       });

   
    })
 </script>
@endsection