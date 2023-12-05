@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <section>

                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('profile') }}">Профиль</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Информация о заказе</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="d-flex flex-column justify-content-center align-items-center" id="order-heading">
                        <div class="text-uppercase">
                            <p>Информация о заказе</p>
                        </div>
                        <div class="h4">Заказ оформлен:<br> <b>{{ $order['created_at']->isoFormat('D MMMM YYYY, HH:mm')  }}</b></div>
                        <div class="pt-1 text-center">
                            <p>Заказ № <span class="text-dark">{{ $order['order_num']  }}</span></p>
                            @if($order['track'])
                                <p>Трек № {{ $order['track']  }}</p>
                            @endif
                            <p>Статус: <b class="text-dark"> {{ $order['status'] }}</b></p>
                            <p>Оплачен: <b class="text-dark">@if($order['paid'])
                                        <span style="color: green;">ДА</span>
                                    @else
                                        <span style="color: red;">НЕТ</span>
                                    @endif
                                </b></p>
                        </div>
                    </div>

                    <div class="wrapper bg-white">
                        <div class="table-responsive">
                            <table class="table table-borderless table-spacing">
                                <thead>
                                <tr class="text-uppercase text-muted">
                                    <th scope="col" class="text-sm">#</th>
                                    <th scope="col" class="text-sm">фото</th>
                                    <th scope="col" class="text-sm">наименование</th>
                                    <th scope="col" class="text-sm">вес</th>
                                    <th scope="col" class="text-sm">количество</th>
                                    <th scope="col" class="text-sm">цена</th>
                                    <th scope="col" class="text-right text-sm">сумма</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration  }}</th>
                                        <td><img src="{{ asset('/storage/'.$product['image']) }}" alt="muhomor" width="80" height="auto"></td>
                                        <td>{{ $product['name']  }}</td>
                                        <td class="text-nowrap text-center">{{ $product['weight'] }} г.</td>
                                        <td class="text-nowrap text-center">{{ $product['pivot']['quantity'] }} шт.</td>
                                        <td class="text-nowrap text-center">{{ $product['price'] }} р.</td>
                                        <td class="text-nowrap text-center">{{ $product['price'] * $product['pivot']['quantity'] }} р.</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">Цена товаров:</td>
                                    <td class="text-right"> {{ $order->subtotal }} </td>
                                </tr>
                                <tr>
                                    <td colspan="6">Доставка {{ $order->delivery }}</td>
                                    <td class="text-right"> {{ $order->delivery_cost }} </td>
                                </tr>
                                <tr>
                                    <td colspan="6">ИТОГО</td>
                                    <td class="text-right"> {{ $order->total  }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {{--        @foreach($products as $product)--}}
                        {{--        <div class="d-flex justify-content-start align-items-center list py-1">--}}
                        {{--            <div class="mx-3"> <img src="{{ asset('/storage/'.$product['image']) }}" alt="muhomor" class="rounded-circle" width="80" height="80"> </div>--}}
                        {{--            <div class="order-item">{{ $product['name']  }}</div>--}}
                        {{--            <div class="order-item">{{ $product['weight']  }} г.</div>--}}
                        {{--            <div><b>{{ $product['pivot']['quantity']  }} шт.</b></div>--}}
                        {{--        </div>--}}
                        {{--        @endforeach--}}

                        {{--<div class="pt-2 border-bottom mb-3"></div>--}}
                        {{--<div class="d-flex justify-content-start align-items-center pl-3">--}}
                        {{--    <div class="text-muted">Payment Method</div>--}}
                        {{--    <div class="ml-auto"><img src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-logo-logok-15.png" alt="" width="30" height="30">--}}
                        {{--        <label>Mastercard ******5342</label></div>--}}
                        {{--</div>--}}
                        {{--<div class="d-flex justify-content-start align-items-center py-1 pl-3">--}}
                        {{--    <div class="text-muted">Shipping</div>--}}
                        {{--    <div class="ml-auto"><label>Free</label></div>--}}
                        {{--</div>--}}
                        {{--<div class="d-flex justify-content-start align-items-center pb-4 pl-3 border-bottom">--}}
                        {{--    <div class="text-muted">--}}
                        {{--        <button class="text-white btn">50% Discount</button>--}}
                        {{--    </div>--}}
                        {{--    <div class="ml-auto price"> -$34.94</div>--}}
                        {{--</div>--}}
                        {{--<div class="d-flex justify-content-start align-items-center pl-3 py-3 mb-4 border-bottom">--}}
                        {{--    <div class="text-muted"> Today's Total</div>--}}
                        {{--    <div class="ml-auto h5"> $34.94</div>--}}
                        {{--</div>--}}
                        <div class="row border rounded p-1 my-3">
                            {{--<div class="col-md-6 py-3">--}}
                            {{--    <div class="d-flex flex-column align-items start"><b>Billing Address</b>--}}
                            {{--        <p class="text-justify pt-2">James Thompson, 356 Jonathon Apt.220,</p>--}}
                            {{--        <p class="text-justify">New York</p>--}}
                            {{--    </div>--}}
                            {{--</div>--}}
                            <div class="col-md-6 py-3">
                                <div class="d-flex flex-column align-items start"><b>Адрес доставки</b>
                                    <p class="text-justify pt-2">{{ $credentials->address }}, {{ $credentials->apartment }} </p>
                                    <p class="text-justify">Тел: {{ $credentials->tel }}</p>
                                </div>
                            </div>
                        </div>
                        {{--<div class="pl-3 font-weight-bold">Related Subsriptions</div>--}}
                        {{--<div class="d-sm-flex justify-content-between rounded my-3 subscriptions">--}}
                        {{--    <div><b>#9632</b></div>--}}
                        {{--    <div>December 08, 2020</div>--}}
                        {{--    <div>Status: Processing</div>--}}
                        {{--    <div> Total: <b> $68.8 for 10 items</b></div>--}}
                        {{--</div>--}}
                    </div>
                </section>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        #order-heading {
            background-color: #edf4f7;
            position: relative;
            border-top-left-radius: 25px;
            max-width: 800px;
            padding-top: 20px;
            margin: 30px auto 0px;
            overflow: hidden;
        }

        #order-heading .text-uppercase {
            font-size: 0.9rem;
            color: #777;
            font-weight: 600
        }

        #order-heading .h4 {
            font-weight: 600;
            color: black;
        }

        #order-heading .h4 + div p {
            font-size: 0.8rem;
            color: #777;
        }

        .close {
            padding: 10px 15px;
            background-color: #777;
            border-radius: 50%;
            position: absolute;
            right: -15px;
            top: -20px;
        }

        .wrapper {
            padding: 0px 50px 50px;
            max-width: 800px;
            margin: 0px auto 40px;
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px;
        }

        .list div b {
            font-size: 0.8rem;
        }

        .list .order-item {
            font-weight: 600;
            color: #6db3ec;
        }

        .list:hover {
            background-color: #f4f4f4;
            cursor: pointer;
            border-radius: 5px;
        }

        label {
            margin-bottom: 0;
            padding: 0;
            font-weight: 900;
        }

        button.btn {
            font-size: 0.9rem;
            background-color: #66cdaa;
        }

        button.btn:hover {
            background-color: #5cb99a;
        }

        .price {
            color: #5cb99a;
            font-weight: 700;
        }

        p.text-justify {
            font-size: 0.9rem;
            margin: 0;
        }

        .row {
            margin: 0px;
        }

        .subscriptions {
            border: 1px solid #ddd;
            border-left: 5px solid #ffa500;
            padding: 10px;
        }

        .subscriptions div {
            font-size: 0.9rem;
        }

        @media (max-width: 425px) {
            .wrapper {
                padding: 20px;
            }

            body {
                font-size: 0.85rem;
            }

            .subscriptions div {
                padding-left: 5px;
            }

            img + label {
                font-size: 0.75rem;
            }
        }
    </style>


@endsection
