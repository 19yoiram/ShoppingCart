@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('order.post') }}" method="POST">
            @csrf
            <div class="row" id="cart-products">
                @include('cartProducts')
            </div>
            <div class="text-end">
                <a class="btn btn-warning" href="{{ route('home') }}">Continue Shopping</a>
                <button class="btn btn-success">Order</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $("body").on("change", ".quantity", function(e) {
            var elem = $(this);
            $(this).attr("disabled", true);
            $.ajax({
                type: "POST",
                url: "{{ route('cart.update') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: "update",
                    product_id: elem.parents("tr").attr("data-id"),
                    quantity: elem.val()
                },

                success: function(response) {
                    $("#cart-products").html(response.success);
                    $("#cart-count").text("(" + response.count + ")");
                    console.log(response);
                }
            });
        })


        $("body").on("click", ".remove-from-cart", function(e) {
            var elem = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('cart.update') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: "delete",
                    product_id: elem.parents("tr").attr("data-id"),
                },
                success: function(response) {
                    $("#cart-products").html(response.success);
                    $("#cart-count").text("My Cart(" + response.count + ")");
                    console.log(response);

                },

            });


        })
    </script>
@endsection
