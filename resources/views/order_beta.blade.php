@extends('layouts.app')
@stack('styles')

@section('content')<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">


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
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                {{--<div>--}}
                                {{--    <span class="me-3">22-11-2021</span>--}}
                                {{--    <span class="me-3">#16123222</span>--}}
                                {{--    <span class="me-3">Visa -1234</span>--}}
                                {{--    <span class="badge rounded-pill bg-info">SHIPPING</span>--}}
                                {{--</div>--}}
                                <div class="d-flex">
                                    {{--<button class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text"><i class="bi bi-download"></i> <span class="text">Invoice</span></button>--}}
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 text-muted" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-printer"></i> Print</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex mb-2">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ Storage::url($item['attributes']['image']) }}" alt="" width="35" class="img-fluid">
                                                </div>
                                                <div class="flex-lg-grow-1 ms-3">
                                                    <h6 class="small mb-0"><a href="#" class="text-reset">{{ $item['name'] }}</a></h6>
                                                    <span class="small">Вес: {{ $item['attributes']['weight'] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td class="text-end">{{ $item['price'] }} руб.</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2">Цена грибов</td>
                                    <td class="text-end">{{ $subtotal  }} руб.</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Цена доставки</td>
                                    <td class="text-end">{{ $deliveryPrice }} руб.</td>
                                </tr>
                                {{--<tr>--}}
                                {{--    <td colspan="2">Discount (Code: NEWYEAR)</td>--}}
                                {{--    <td class="text-danger text-end">-$10.00</td>--}}
                                {{--</tr>--}}
                                <tr class="fw-bold">
                                    <td colspan="2">ИТОГО</td>
                                    <td class="text-end">{{ $total }} руб.</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="h6">Payment Method</h3>
                                    <p>Visa -1234 <br>
                                        Total: $169,98 <span class="badge bg-success rounded-pill">PAID</span></p>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Billing address</h3>
                                    <address>
                                        <strong>John Doe</strong><br>
                                        1355 Market St, Suite 900<br>
                                        San Francisco, CA 94103<br>
                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Customer Notes -->
                    @if($deliveryInfo['comment'])
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="h6">Комментарий к заказу</h3>
                            <p>{{ $deliveryInfo['comment'] }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="card mb-4">
                        <!-- Shipping information -->
                        <div class="card-body">
                            <h3 class="h6">Информация о доставке</h3>
                            <strong>Тип доставки: {{ $deliveryType }}</strong>
                            {{--<span><a href="#" class="text-decoration-underline" target="_blank">FF1234567890</a> <i class="bi bi-box-arrow-up-right"></i> </span>--}}
                            <hr>
                            <h3 class="h6">Адрес доставки</h3>
                            <address>
                                <strong>{{ $deliveryInfo['surname'] }} {{ $deliveryInfo['name'] }} {{ $deliveryInfo['middle_name'] }}</strong><br>
                                {{ $deliveryInfo['address'] }}<br>
                                квартира {{ $deliveryInfo['apartment'] }}<br>
                                <abbr title="Телефон">Тел:</abbr> {{ $deliveryInfo['telephone'] }}
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid my-5  d-flex  justify-content-center">
    <div class="card card-1">
        <div class="card-header bg-white">
            <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                <div class="col my-auto"> <h4 class="mb-0">Спасибо за ваш Заказ, <span class="change-color">{{  $deliveryInfo['name']  }}</span> !</h4> </div>
                {{--<div class="col-auto text-center  my-auto pl-0 pt-sm-4"> <img class="img-fluid my-auto align-items-center mb-0 pt-3"  src="{{asset('/images/gnome.avif')}}" > <p class="mb-4 pt-0 Glasses">Glasses For Everyone</p>  </div>--}}
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-between mb-3">
                <div class="col-auto"> <h6 class="color-1 mb-0 change-color">Заказ</h6> </div>
                <div class="col-auto  "> Номер заказа : <strong>{{ $orderNum  }}</strong> </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-2">
                        <div class="card-body">
                            <div class="media">
                                <div class="sq align-self-center "> <img class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" src="{{ Storage::url($item['attributes']['image']) }}" width="135" height="135" /> </div>
                                <div class="media-body my-auto text-right">
                                    <div class="row  my-auto flex-column flex-md-row">
                                        <div class="col my-auto"> <h6 class="mb-0">{{ $item['name'] }}</h6>  </div>
                                        <div class="col-auto my-auto"> <small>Golden Rim </small></div>
                                        <div class="col my-auto"> <small>Вес: {{ $item['attributes']['weight'] }}</small></div>
                                        <div class="col my-auto"> <small>Количество : {{ $item['quantity'] }}</small></div>
                                        <div class="col my-auto"><h6 class="mb-0">&#8377;{{ $item['price'] }} руб.</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-3 ">
                            <div class="row">
                                <div class="col-md-3 mb-3"> <small> Track Order <span><i class=" ml-2 fa fa-refresh"  aria-hidden="true"></i></span></small> </div>
                                <div class="col mt-auto">
                                    <div class="media row justify-content-between ">
                                        <div class="col-auto text-right"><span> <small  class="text-right mr-sm-2"></small> <i class="fa fa-circle active"></i> </span></div>
                                        <div class="flex-col"> <span> <small class="text-right mr-sm-2">Out for delivary</small><i class="fa fa-circle active"></i></span></div>
                                        <div class="col-auto flex-col-auto"><small  class="text-right mr-sm-2">Delivered</small><span> <i  class="fa fa-circle"></i></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="row mt-4">--}}
            {{--    <div class="col">--}}
            {{--        <div class="card card-2">--}}
            {{--            <div class="card-body">--}}
            {{--                <div class="media">--}}
            {{--                    <div class="sq align-self-center "> <img class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" src="https://i.imgur.com/fUWWpRS.jpg" width="135" height="135" /> </div>--}}
            {{--                    <div class="media-body my-auto text-right">--}}
            {{--                        <div class="row  my-auto flex-column flex-md-row">--}}
            {{--                            <div class="col-auto my-auto "> <h6 class="mb-0"> Michel Mark</h6> </div>--}}
            {{--                            <div class="col my-auto  "> <small>Black Rim </small></div>--}}
            {{--                            <div class="col my-auto  "> <small>Size : L</small></div>--}}
            {{--                            <div class="col my-auto  "> <small>Qty : 1</small></div>--}}
            {{--                            <div class="col my-auto ">  <h6 class="mb-0">&#8377;1,235.00</h6>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <hr class="my-3 ">--}}
            {{--                <div class="row ">--}}
            {{--                    <div class="col-md-3 mb-3">  <small> Track Order <span><i class=" ml-2 fa fa-refresh" aria-hidden="true"></i></span></small> </div>--}}
            {{--                    <div class="col mt-auto">--}}
            {{--                        <div class="progress"><div class="progress-bar progress-bar  rounded" style="width: 18%"  role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> </div>--}}
            {{--                        <div class="media row justify-content-between ">--}}
            {{--                            <div class="col-auto text-right"><span> <small  class="text-right mr-sm-2"></small> <i class="fa fa-circle active"></i> </span></div>--}}
            {{--                            <div class="flex-col"> <span> <small class="text-right mr-sm-2">Out for delivary</small><i class="fa fa-circle"></i></span></div>--}}
            {{--                            <div class="col-auto flex-col-auto"><smallclass="text-right mr-sm-2">Delivered</small><span> <i class="fa fa-circle"></i></span></div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            {{--    </div>--}}
            {{--</div>--}}
            <div class="row mt-4">
                <div class="col">
                    <div class="row justify-content-between">
                        <div class="col-auto"><p class="mb-1 text-dark"><b>Order Details</b></p></div>
                        <div class="flex-sm-col text-right col"> <p class="mb-1"><b>Цена грибов</b></p> </div>
                        <div class="flex-sm-col col-auto"> <p class="mb-1">&#8377;{{ $subtotal  }} руб.</p> </div>
                    </div>
                    {{--<div class="row justify-content-between">--}}
                    {{--    <div class="flex-sm-col text-right col"><p class="mb-1"> <b>Discount</b></p> </div>--}}
                    {{--    <div class="flex-sm-col col-auto"><p class="mb-1">&#8377;150</p></div>--}}
                    {{--</div>--}}
                    {{--<div class="row justify-content-between">--}}
                    {{--    <div class="flex-sm-col text-right col"><p class="mb-1"><b>GST 18%</b></p></div>--}}
                    {{--    <div class="flex-sm-col col-auto"><p class="mb-1">843</p></div>--}}
                    {{--</div>--}}
                    <div class="row justify-content-between">
                        <div class="flex-sm-col text-right col"><p class="mb-1"><b>Доставка</b></p></div>
                        <div class="flex-sm-col col-auto"><p class="mb-1">{{ $deliveryPrice }} руб.</p></div>
                    </div>
                </div>
            </div>
            <div class="row invoice ">
                <div class="col"><p class="mb-1"> Invoice Number : 788152</p><p class="mb-1">Invoice Date : 22 Dec,2019</p><p class="mb-1">Recepits Voucher:18KU-62IIK</p></div>
            </div>
        </div>
        <div class="card-footer">
            <div class="jumbotron-fluid">
                <div class="row justify-content-between ">
                    <div class="col-sm-auto col-auto my-auto"><img class="img-fluid my-auto align-self-center " src="{{asset('/images/gnome.avif')}}" width="115" height="115"></div>
                    <div class="col-auto my-auto "><h2 class="mb-0 font-weight-bold">ИТОГО</h2></div>
                    <div class="col-auto my-auto ml-auto"><h1 class="display-3 ">₽ {{ $total }}</h1></div>
                </div>
                <div class="row mb-3 mt-3 mt-md-0">
                    <div class="col-auto border-line"> <small class="text-white">PAN:AA02hDW7E</small></div>
                    <div class="col-auto border-line"> <small class="text-white">CIN:UMMC20PTC </small></div>
                    <div class="col-auto "><small class="text-white">GSTN:268FD07EXX </small> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .container-fluid {
        margin-top: 200px ;
    }

    p {
        font-size: 14px;
        margin-bottom: 7px;

    }

    .small {
        letter-spacing: 0.5px !important;
    }

    .card-1 {
        box-shadow: 2px 2px 10px 0px rgb(190, 108, 170);
    }

    hr {
        background-color: rgba(248, 248, 248, 0.667);
    }


    .bold {
        font-weight: 500;
    }

    .change-color {
        color: var(--secondary-color);
    }

    .card-2 {
        box-shadow: 1px 1px 3px 0px rgb(112, 115, 139);

    }

    .fa-circle.active {
        font-size: 8px;
        color: #AB47BC;
    }

    .fa-circle {
        font-size: 8px;
        color: #aaa;
    }

    .rounded {
        border-radius: 2.25rem !important;
    }


    .progress-bar {
        background-color: #AB47BC !important;
    }


    .progress {
        height: 5px !important;
        margin-bottom: 0;
    }

    .invoice {
        position: relative;
        top: -70px;
    }

    .Glasses {
        position: relative;
        top: -12px !important;
    }

    .card-footer {
        background-color: #AB47BC;
        color: #fff;
    }

    h2 {
        color: rgb(78, 0, 92);
        letter-spacing: 2px !important;
    }

    .display-3 {
        font-weight: 500 !important;
    }

    @media (max-width: 479px) {
        .invoice {
            position: relative;
            top: 7px;
        }

        .border-line {
            border-right: 0px solid rgb(226, 206, 226) !important;
        }

    }

    @media (max-width: 700px) {

        h2 {
            color: rgb(78, 0, 92);
            font-size: 17px;
        }

        .display-3 {
            font-size: 28px;
            font-weight: 500 !important;
        }
    }

    .card-footer small {
        letter-spacing: 7px !important;
        font-size: 12px;
    }

    .border-line {
        border-right: 1px solid rgb(226, 206, 226)
    }
</style>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script>
  $(document).on('load', '#success', function(e) {
    swal(
        'Success',
        'You clicked the <b style="color:green;">Success</b> button!',
        'success'
    )
  });
</script>


@endsection