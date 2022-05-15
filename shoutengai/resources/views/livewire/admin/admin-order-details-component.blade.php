<div>
    <style>
        .badge-main {
            background-color: #7d7d7d !important;
        }

        .badge-success {
            background-color: #4caf50 !important;
        }

        .badge-warning {
            background-color: #ff9800 !important;
        }

        .badge-danger {
            background-color: #f44336 !important;
        }

    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="shop-title" style="display:inline;">Ordered Details</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.orders') }}" class="btn btn-success pull-right">All
                                    Orders</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body" style="padding-bottom: 0px !important;">
                        <table class="table">
                            <tr>
                                <th>Order ID:</th>
                                <td><span class="badge badge-main">ID {{ $order->id }}</span></td>
                                <th>Order Date:</th>
                                <td>{{ $order->created_at }}</td>
                                <th>Status:</th>
                                <td>{!! $order_status !!}</td>
                                @if ($order->status == 'delivered')
                                    <th style="color:#4caf50">Delivery Date:</th>
                                    <td>{{ $order->delivered_date }}</td>
                                @elseif($order->status == 'cancelled')
                                    <th style="color:#f44336">Cancellation Date:</th>
                                    <td>{{ $order->canceled_date }}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="shop-title" style="display:inline;">Ordered Items
                                    <span class="badge badge-main">ID {{ $order->id }}</span>
                                    {!! $order_status !!} {!! $transaction_status !!}
                                    @if ($order->status == 'ordered')
                                        <span class="badge badge-warning">{{ $order->created_at }}</span>
                                    @elseif ($order->status == 'delivered')
                                        <span class="badge badge-success">{{ $order->created_at }}</span>
                                    @elseif ($order->status == 'cancelled')
                                        <span class="badge badge-danger">{{ $order->created_at }}</span>
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="wrap-iten-in-cart">
                            <h3 class="box-title">Products</h3>
                            <ul class="products-cart">
                                @foreach ($order->orderItems as $item)
                                    <li class="pr-cart-item">
                                        <div class="product-image">
                                            <figure><img
                                                    src="{{ asset('assets/images/products') }}/{{ $item->product->image }}"
                                                    alt="{{ $item->product->name }}">
                                            </figure>
                                        </div>
                                        <div class="product-name">
                                            <a class="link-to-product"
                                                href="{{ route('product.details', ['slug' => $item->product->slug]) }}">{{ $item->product->name }}</a>
                                        </div>
                                        <div class="price-field produtc-price">
                                            <p class="price">${{ $item->product->regular_price }}</p>
                                        </div>
                                        <div class="price-field quantity">
                                            <h5>{{ $item->quantity }}</h5>
                                        </div>
                                        <div class="price-field sub-total">
                                            <p class="price">${{ $item->price * $item->quantity }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="summary">
                            <div class="order-summary">
                                <h4 class="title-box">Order Summary</h4>
                                <p class="summary-info"><span class="title">Subtotal</span><b
                                        class="index">${{ $order->subtotal }}</b></p>
                                <p class="summary-info"><span class="title">Tax</span><b
                                        class="index">${{ $order->tax }}</b></p>
                                <p class="summary-info"><span class="title">Shipping</span><b
                                        class="index">Free Shipping</b></p>
                                <p class="summary-info"><span class="title">Total</span><b
                                        class="index">${{ $order->total }}</b></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="shop-title" style="display:inline;">Billing Details</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>First Name</th>
                                <td>{{ $order->firstname }}</td>
                                <th>Last Name</th>
                                <td>{{ $order->lastname }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $order->mobile }}</td>
                                <th>Email</th>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <th>Address Line 1</th>
                                <td>{{ $order->line1 }}</td>
                                <th>Address Line 2</th>
                                <td>{{ $order->line2 }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $order->city }}</td>
                                <th>Province</th>
                                <td>{{ $order->province }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ $order->country }}</td>
                                <th>Zipccode</th>
                                <td>{{ $order->zipcode }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if ($order->is_shipping_different)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="shop-title" style="display:inline;">Shipping Details</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>First Name</th>
                                    <td>{{ $order->shipping->firstname }}</td>
                                    <th>Last Name</th>
                                    <td>{{ $order->shipping->lastname }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $order->shipping->mobile }}</td>
                                    <th>Email</th>
                                    <td>{{ $order->shipping->email }}</td>
                                </tr>
                                <tr>
                                    <th>Address Line 1</th>
                                    <td>{{ $order->shipping->line1 }}</td>
                                    <th>Address Line 2</th>
                                    <td>{{ $order->shipping->line2 }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $order->shipping->city }}</td>
                                    <th>Province</th>
                                    <td>{{ $order->shipping->province }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $order->shipping->country }}</td>
                                    <th>Zipccode</th>
                                    <td>{{ $order->shipping->zipcode }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="shop-title" style="display:inline;">Transaction</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Transaction Method</th>
                                <td>{{ $order->transaction->mode }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{!! $transaction_status !!}</td>
                            </tr>
                            <tr>
                                <th>Transaction Date</th>
                                <td>{{ $order->transaction->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
