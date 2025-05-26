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
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Laravel Cart</a>
            <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle btn btn-info" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false" id="cart-count">
                     My Cart ({{ count(session('cart', [])) }})
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @if (session('cart', []))
                            @foreach (session('cart', []) as $key => $value)
                                <div class="row" style="width: 400px;">
                                    <div class="col-md-4">
                                        <img style="height: 80px; width: 200px;" src="{{ $value['image'] }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <p><strong>{{ $value['name'] }}</strong></p>
                                        Quantity: {{ $value['quantity'] }} <br>
                                        Price: {{ $value['price'] }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center">
                                <a href="{{ route('cart') }}" class="btn btn-info">View All</a>
                            </div>
                        @endif
                    </div>
                      <a class=" btn btn-danger"  href="{{route('account.logout')}}"
                        aria-expanded="false">
                        Logout
                    </a>
                </li>
            </ul>

        </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
  @yield('scripts') 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
