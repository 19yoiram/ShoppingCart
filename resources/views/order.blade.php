<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="card mt-5">
        <div class="card-header">
            <h4>Order List</h4>
        </div>
        <div class="card-body">

            @session('success')
                <div class="alert alert-success">{{ $value }}</div>
            @endsession

            {{-- <a href="{{route('export')}}" class="btn btn-success btn-sm mb-3">Export</a>  --}}
            <table class="table table-striped table-borded">
                <thead>
                    <tr>
                        <th scope="col" width=50px>Order Id</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Product </th>
                        <th scope="col">Quantity </th>
                        <th scope="col">Price </th>
                        {{-- <th scope="col" width=250px>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $detail->product->name ?? 'Product Deleted' }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ $detail->quantity * $detail->price }}</td>{{-- <td><img style="width: 150px;" src="{{ asset('uploads/images/' . $product->image) }}"alt=""></td> --}}
                                <td>
                                    {{-- <form action="{{ route('order.destroy',$detail->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"> <i class="fa fa-trash">
                                            </i>Delete</button>


                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-end"><strong>Total Amount:</strong></td>
                        <td><strong>Rs. {{ $totalAmount }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
