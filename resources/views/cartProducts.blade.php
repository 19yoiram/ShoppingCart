
 @if(session('cart'))
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th width="100px">Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <a href="{{route('home')}}" class="btn btn-info">Back</a>
                @php $total=0; @endphp
                @foreach (session('cart') as $key => $details)
                    @php  $total = $total + ($details['price'] * $details['quantity'] ); @endphp
                    <tr data-id={{ $key }}>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $details['image'] }}" alt="" class="img-responsive" width="100px"
                                    height="100px" style="margin-right:15px;">
                                <h4>{{ $details['name'] }}</h4>
                            </div>
                        </td>
                        <td>Rs.{{ $details['price'] }}</td>
                        <td>
                            <input type="number" name="quantity" class="form-control quantity"
                                value="{{ $details['quantity'] }}" min="1">
                        </td>
                        <td>Rs.{{ $details['price'] * $details['quantity'] }}</td>
                        <td>
                            <button class="btn btn-danger remove-from-cart"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-end">
                        <h3>Total: Rs.{{ $total }}</h3>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endif
