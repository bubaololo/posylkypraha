@extends('layouts.app')

@section('content')
    {{--<main class="my-8">--}}
    {{--    <div class="container">--}}
    {{--<section class="bg-sand padding-large">--}}
    {{--    <div class="container">--}}
    {{--        @foreach($cartItems as $item)--}}
    {{--            {{ $item['name'] }} <br>--}}
    {{--            {{ $item['price'] }} <br>--}}
    {{--            {{ $item['attributes']['weight'] }} <br>--}}
    {{--            {{ $item['quantity'] }} <br>--}}
    {{--        @endforeach--}}
    {{--        @foreach($deliveryInfo as $string)--}}
    {{--            {{ $string }} <br>--}}

    {{--        @endforeach--}}
    {{--    </div>--}}
    {{--</section>--}}
    {{--    </div>--}}
    {{--</main>--}}


    <div class="container-fluid">

        <div class="container">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="h5 mb-0" style="color:black; margin-top: 100px;"><a href="#" ></a> Заказ №{{ $orderNum  }}</h2>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    {{--<div class="card mb-4">--}}
                    {{--    <div class="card-body">--}}
                    {{--        <div class="mb-3 d-flex justify-content-between">--}}
                    {{--            --}}{{--<div>--}}
                    {{--            --}}{{--    <span class="me-3">22-11-2021</span>--}}
                    {{--            --}}{{--    <span class="me-3">#16123222</span>--}}
                    {{--            --}}{{--    <span class="me-3">Visa -1234</span>--}}
                    {{--            --}}{{--    <span class="badge rounded-pill bg-info">SHIPPING</span>--}}
                    {{--            --}}{{--</div>--}}
                    {{--            <div class="d-flex">--}}
                    {{--                --}}{{--<button class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text"><i class="bi bi-download"></i> <span class="text">Invoice</span></button>--}}
                    {{--                <div class="dropdown">--}}
                    {{--                    <button class="btn btn-link p-0 text-muted" type="button" data-bs-toggle="dropdown">--}}
                    {{--                        <i class="bi bi-three-dots-vertical"></i>--}}
                    {{--                    </button>--}}
                    {{--                    <ul class="dropdown-menu dropdown-menu-end">--}}
                    {{--                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>--}}
                    {{--                        <li><a class="dropdown-item" href="#"><i class="bi bi-printer"></i> Print</a></li>--}}
                    {{--                    </ul>--}}
                    {{--                </div>--}}
                    {{--            </div>--}}
                    {{--        </div>--}}
                    {{--        --}}{{--<table class="table table-borderless">--}}
                    {{--        --}}{{--    <tbody>--}}
                    {{--        --}}{{--    @foreach($packageItems as $item)--}}
                    {{--        --}}{{--        <tr>--}}
                    {{--        --}}{{--            <td>--}}
                    {{--        --}}{{--                <div class="d-flex mb-2">--}}
                    {{--        --}}{{--                    <div class="flex-shrink-0">--}}
                    {{--        --}}{{--                        <img src="{{ Storage::url($item['attributes']['image']) }}" alt="" width="35" class="img-fluid">--}}
                    {{--        --}}{{--                    </div>--}}
                    {{--        --}}{{--                    <div class="flex-lg-grow-1 ms-3">--}}
                    {{--        --}}{{--                        <h6 class="small mb-0"><a href="#" class="text-reset">{{ $item['name'] }}</a></h6>--}}
                    {{--        --}}{{--                        <span class="small">Вес: {{ $item['attributes']['weight'] }}</span>--}}
                    {{--        --}}{{--                    </div>--}}
                    {{--        --}}{{--                </div>--}}
                    {{--        --}}{{--            </td>--}}
                    {{--        --}}{{--            <td>{{ $item['quantity'] }}</td>--}}
                    {{--        --}}{{--            <td class="text-end">{{ $item['price'] }} руб.</td>--}}
                    {{--        --}}{{--        </tr>--}}
                    {{--        --}}{{--    @endforeach--}}
                    {{--        --}}{{--    </tbody>--}}
                    {{--        --}}{{--    <tfoot>--}}
                    {{--        --}}{{--    <tr>--}}
                    {{--        --}}{{--        <td colspan="2">Цена грибов</td>--}}
                    {{--        --}}{{--        <td class="text-end">{{ $subtotal  }} руб.</td>--}}
                    {{--        --}}{{--    </tr>--}}
                    {{--        --}}{{--    <tr>--}}
                    {{--        --}}{{--        <td colspan="2">Цена доставки</td>--}}
                    {{--        --}}{{--        <td class="text-end">{{ $deliveryPrice }} руб.</td>--}}
                    {{--        --}}{{--    </tr>--}}
                    {{--        --}}{{--    --}}{{----}}{{--<tr>--}}
                    {{--        --}}{{--    --}}{{----}}{{--    <td colspan="2">Discount (Code: NEWYEAR)</td>--}}
                    {{--        --}}{{--    --}}{{----}}{{--    <td class="text-danger text-end">-$10.00</td>--}}
                    {{--        --}}{{--    --}}{{----}}{{--</tr>--}}
                    {{--        --}}{{--    <tr class="fw-bold">--}}
                    {{--        --}}{{--        <td colspan="2">ИТОГО</td>--}}
                    {{--        --}}{{--        <td class="text-end">{{ $total }} руб.</td>--}}
                    {{--        --}}{{--    </tr>--}}
                    {{--        --}}{{--    </tfoot>--}}
                    {{--        --}}{{--</table>--}}
                    {{--    </div>--}}
                    {{--</div>--}}
                    <!-- Payment -->
                    {{--<div class="card mb-4">--}}
                    {{--    <div class="card-body">--}}
                    {{--        <div class="row">--}}
                    {{--            <div class="col-lg-6">--}}
                    {{--                <h3 class="h6">Payment Method</h3>--}}
                    {{--                <p>Visa -1234 <br>--}}
                    {{--                    Total: $169,98 <span class="badge bg-success rounded-pill">PAID</span></p>--}}
                    {{--            </div>--}}
                    {{--            <div class="col-lg-6">--}}
                    {{--                <h3 class="h6">Billing address</h3>--}}
                    {{--                <address>--}}
                    {{--                    <strong>John Doe</strong><br>--}}
                    {{--                    1355 Market St, Suite 900<br>--}}
                    {{--                    San Francisco, CA 94103<br>--}}
                    {{--                    <abbr title="Phone">P:</abbr> (123) 456-7890--}}
                    {{--                </address>--}}
                    {{--            </div>--}}
                    {{--        </div>--}}
                    {{--    </div>--}}
                    {{--</div>--}}
                </div>
                {{--<div class="col-lg-4">--}}
                {{--    <!-- Customer Notes -->--}}
                {{--    @if($deliveryInfo['comment'])--}}
                {{--    <div class="card mb-4">--}}
                {{--        <div class="card-body">--}}
                {{--            <h3 class="h6">Комментарий к заказу</h3>--}}
                {{--            <p>{{ $deliveryInfo['comment'] }}</p>--}}
                {{--        </div>--}}
                {{--    </div>--}}
                {{--    @endif--}}
                {{--    <div class="card mb-4">--}}
                {{--        <!-- Shipping information -->--}}
                {{--        <div class="card-body">--}}
                {{--            <h3 class="h6">Информация о доставке</h3>--}}
                {{--            <strong>Тип доставки: {{ $deliveryType }}</strong>--}}
                {{--            --}}{{--<span><a href="#" class="text-decoration-underline" target="_blank">FF1234567890</a> <i class="bi bi-box-arrow-up-right"></i> </span>--}}
                {{--            <hr>--}}
                {{--            <h3 class="h6">Адрес доставки</h3>--}}
                {{--            <address>--}}
                {{--                <strong>{{ $deliveryInfo['surname'] }} {{ $deliveryInfo['name'] }} {{ $deliveryInfo['middle_name'] }}</strong><br>--}}
                {{--                {{ $deliveryInfo['address'] }}<br>--}}
                {{--                квартира {{ $deliveryInfo['apartment'] }}<br>--}}
                {{--                <abbr title="Телефон">Тел:</abbr> {{ $deliveryInfo['telephone'] }}--}}
                {{--            </address>--}}
                {{--        </div>--}}
                {{--    </div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

    <style>
        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: 1rem;
        }
        .text-reset {
            --bs-text-opacity: 1;
            color: inherit!important;
        }
        a {
            color: #5465ff;
            text-decoration: none;
        }
    </style>



@endsection