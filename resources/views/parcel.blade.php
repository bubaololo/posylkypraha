{{--Поля:--}}
{{--Имя фамилия отправителя--}}
{{--Имя фамилия получателя--}}
{{--Индекс--}}
{{--Область--}}
{{--Район (необязательно)--}}
{{--Город--}}
{{--Улица--}}
{{--Дом--}}
{{--Корпус--}}
{{--Квартира--}}
{{--Телефон--}}
{{--Вес кг--}}
{{--Вес грамма (по умолчанию ноль)--}}
{{--Номер вложения (думаю там просто должны выпадать поля. Условно, если я отправляю книгу, то поле одно, если книгу, плюс шоколадку, то нажимаю плюс, заполняю еще одно поле) в каждом вложении проставляю кол-во одного наименования, общий вес  данного вложения в килограммах и граммах, а так же стоимость, а система потом формирует из этого список: 1,2,3,4,5 итд--}}
@extends('layouts.app')
@section('title', 'Корзина')
@section('meta_description', 'Оформить посылку')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}"/>
        <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
        <link href="{{ asset('css/checkout-media.css') }}" rel="stylesheet">
    @endpush

    @if ($message = Session::get('success'))
        <div class="p-4 mb-3 bg-green-400 rounded">
            <p class="text-green-800">{{ $message }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form class="parcel-form container" enctype="multipart/form-data" method="post" id="quest_form"
            action="/checkout">
        @csrf

        <div class="col-lg-7">
            <h5 class="mb-3"><a href="#!" class="text-body">
                    <i class="fas fa-long-arrow-alt-left me-2"></i>Содержимое посылки</a></h5>
            <hr>

            <div class="d-flex flex-column gap-2 mb-4" x-data="packageItemsComponent()" id="packageItemsWrapper">
                <template x-for="(item, index) in items" :key="index">
                    <div class="package-item">
                        <div class="package-item__inner">
                            <div class="package-item__description">
                                <input type="text" required x-model="item.description" :name="'items[' + index + '][description]'" class="form-control" placeholder="Описание вложения">
                            </div>
                            <div class="package-item__controls-wrap">

                                <div class="package-item__quantity">
                                    <button type="button" class="btn btn-light px-3 package-item__quantity-btn" x-on:click="updateQuantity(item, -1)" x-bind:disabled="item.quantity <= 1">-</button>
                                    <div class="package-item__quantity-text">
                                        <strong x-text="item.quantity"></strong> шт.
                                        <!-- Скрытое поле для отправки количества -->
                                        <input type="hidden" x-model="item.quantity" :name="'items[' + index + '][quantity]'" class="form-control">
                                    </div>
                                    <button type="button" class="btn btn-light px-3 me-2 package-item__quantity-btn" x-on:click="updateQuantity(item, 1)">+</button>
                                </div>

                                <div class="package-item__weight-wrap input-group input-group-sm">
                                    <span class="input-group-text">Вес</span>
                                    <div class="package-item__input-wrap">
                                        <input type="number" min="0" x-model="item.weight_kg" :name="'items[' + index + '][weight_kg]'" class="form-control package-item__weight" placeholder="кг">
                                    </div>
                                    <div class="package-item__input-wrap">
                                        <input type="number" min="0" x-model="item.weight_g" :name="'items[' + index + '][weight_g]'" class="form-control package-item__weight" placeholder="г">
                                    </div>
                                </div>

                                <div class="package-item__value-wrap">
                                    <span class="input-group-text">Стоимость</span>
                                    <div class="package-item__input-wrap">
                                        <input type="number" min="0" :name="'items[' + index + '][value]'" class="form-control package-item__value" placeholder="€">
                                    </div>

                                </div>

                                <div class="package-item__del" x-on:click="removeItem(index)" x-show="items.length > 1"></div>
                            </div>
                        </div>
                    </div>
                </template>
                <input type="hidden" name="calculatedDeliveryCost" x-bind:value="selectedDeliveryCost">
                <button type="button" class="btn btn-outline-secondary btn-sm" x-on:click="addItem()">+ добавить вложение</button>
                <div class="delivery">
                    <div class="delivery__title" >Способ доставки:</div>

                    <input type="hidden" name="deliveryType" x-bind:value="deliveryType">

                    <div class="delivery__type">
                        <div class="delivery-selector">
                            <input type="radio" id="ems" class="btn-check" x-model="deliveryType" value="ems">
                            <label class="btn btn-outline-success" for="ems">EMS <br> <small>ускоренная</small></label>
                            <div class="delivery-selector__price-wrap">
                                <small x-text="emsPrice"></small> <span>CZK</span>
                            </div>

                        </div>
                        <div class="delivery-selector">
                            <input type="radio" id="post" class="btn-check" x-model="deliveryType" value="post">
                            <label class="btn btn-outline-success" for="post">Почта <br> <small>обычная посылка</small></label>
                            <div class="delivery-selector__price-wrap">
                            <small x-text="postPrice"></small> <span>CZK</span>
                            </div>
                        </div>
                        {{--<div x-text="`You chose ${deliveryType}`"></div>--}}
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="customDelivery" value="true" id="customDelivery" x-model="customDelivery">
                        <label class="form-check-label" for="customDelivery">Выезд курьера на адрес (+200)</label>
                    </div>

                    <div class="delivery-stats">
                        <div class="delivery-stats__item" x-show="deliveryType">Стоимость доставки: <span x-text="selectedDeliveryCost - (customDelivery ? 400 : 200)"></span> CZK</div>
                        <div class="delivery-stats__item" x-show="deliveryType">Стоимость услуги: <span x-text="customDelivery ? 400 : 200"></span> CZK</div>
                        <div class="delivery-stats__item" x-show="deliveryType">Общая сумма: <span x-text="totalPrice"></span> CZK</div>
                        <div x-show="!deliveryType">Выберите способ доставки для отображения цен</div>
                    </div>
                </div>
            </div>

            <script>
              function packageItemsComponent() {
                return {
                  items: [{description: '', weight_kg: null, weight_g: null, quantity: 1}],
                  deliveryType: '',
                  emsPrice: 0,
                  postPrice: 0,
                  selectedDeliveryCost: 0,
                  customDelivery: false,
                  totalPrice: 0,
                  emsRates: [
                    {weight: 2000, price: 950},
                    {weight: 5000, price: 1250},
                    {weight: 10000, price: 1850},
                    {weight: 15000, price: 2350},
                    {weight: 20000, price: 2850},
                    {weight: 25000, price: 3350},
                    {weight: 30000, price: 3850},
                    {weight: Infinity, price: 0}
                  ],
                  postRates: [
                    {weight: 2000, price: 800},
                    {weight: 5000, price: 1100},
                    {weight: 10000, price: 1250},
                    {weight: 15000, price: 1500},
                    {weight: 20000, price: 1600},
                    {weight: Infinity, price: 0}
                  ],

                  addItem: function () {
                    this.items.push({description: '', weight_kg: null, weight_g: null, quantity: 1});
                    this.calculateDeliveryCost();
                  },

                  removeItem: function (index) {
                    this.items.splice(index, 1);
                    this.calculateDeliveryCost();
                  },

                  updateQuantity: function (item, amount) {
                    const newQuantity = item.quantity + amount;
                    item.quantity = newQuantity >= 1 ? newQuantity : 1;
                    this.calculateDeliveryCost();
                  },

                  calculateDeliveryCost: function () {
                    let totalWeightKg = this.items.reduce((sum, item) => sum + (parseFloat(item.weight_kg) || 0), 0);
                    let totalWeightG = this.items.reduce((sum, item) => sum + (parseFloat(item.weight_g) || 0), 0);
                    let totalWeight = totalWeightKg * 1000 + totalWeightG;

                    this.emsPrice = this.getPriceByWeight(this.emsRates, totalWeight);
                    this.postPrice = this.getPriceByWeight(this.postRates, totalWeight);

                    this.updateSelectedDeliveryCost();
                  },

                  updateSelectedDeliveryCost: function () {
                    let additionalServiceCharge = this.customDelivery ? 400 : 200;
                    if (this.deliveryType === 'ems') {
                      this.selectedDeliveryCost = this.emsPrice + additionalServiceCharge;
                    } else if (this.deliveryType === 'post') {
                      this.selectedDeliveryCost = this.postPrice + additionalServiceCharge;
                    } else {
                      this.selectedDeliveryCost = 0; // Сброс, если тип доставки не выбран
                    }
                    this.totalPrice = this.selectedDeliveryCost;
                    console.log('Total Price Updated:', this.totalPrice);
                  },

                  getPriceByWeight: function (rates, weight) {
                    for (let rate of rates) {
                      if (weight <= rate.weight) {
                        return rate.price;
                      }
                    }
                    return 0; // Если не подходит ни одна категория
                  },

                  init: function () {
                    this.$watch('deliveryType', () => this.calculateDeliveryCost());
                    this.$watch('customDelivery', () => this.updateSelectedDeliveryCost());
                    this.$watch('items', () => this.calculateDeliveryCost(), {deep: true});
                    this.calculateDeliveryCost(); // Вызываем изначально для начального расчета
                  }
                };
              }
            </script>

            <hr class="my-4">

            {{--@livewire('cart-total')--}}

        </div>

        <div class="col-lg-5">
            <section class="checkout__slider">
                <div class="quest">
                    <section class="quest__slider">
                        {{--<div class="success">--}}
                        {{--    <img src="img/quest_success.svg" alt="icon" class="quest__success">--}}
                        {{--    <div class="sucess_text">--}}
                        {{--        Ваш заказ оформлен!--}}
                        {{--    </div>--}}
                        {{--</div>--}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="quest__slider_bar">

                            <div class="quest__slider_bar_wrapper">
                            </div>

                        </div>

                        <div class="quest__slider_wrapper mySwiper">

                            <div class="quest__slides swiper-wrapper">
                                <!-- ________SLIDE -->
                                <div class="swiper-slide">
                                    <div class="quest__slide credentials-slide">
                                        <div class="quest__slide_title_wrapper">
                                            <div class="quest__slide_title">
                                                Отправитель
                                            </div>
                                            <div class="quest__slide_subtitle">
                                                имя и фамилия отправителя
                                            </div>
                                            <div class="redline"></div>
                                        </div>
                                        <div class="quest__slide_forms_wrapper">
                                            <div class="quest__input-group">
                                                <label for="sender_surname">Фамилия отправителя</label>
                                                <input type="text" id="sender_surname" name="sender_surname" class="quest__input"
                                                        value="@isset($credentials['sender_surname']) {{ $credentials['sender_surname'] }} @endisset" placeholder="Иванов">

                                            </div>
                                            <div class="quest__input-group">
                                                <label for="sender_name">Имя отправителя</label>
                                                <input type="text" id="sender_name" name="sender_name" class="quest__input"
                                                        value="@isset($credentials['sender_name']) {{ $credentials['sender_name'] }} @endisset" placeholder="Иван">
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="sender_city">Город</label>
                                                <input type="text" id="sender_city" name="sender_city" class="quest__input"
                                                        value="@isset($credentials['sender_city']) {{ $credentials['sender_city'] }} @endisset" placeholder="Praha">
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="sender_address">Адрес</label>
                                                <input type="text" id="sender_address" name="sender_address" class="quest__input"
                                                        value="@isset($credentials['sender_address']) {{ $credentials['sender_address'] }} @endisset" placeholder="Улица, дом">
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="sender_postal_code">Почтовый индекс</label>
                                                <input type="text" id="sender_postal_code" name="sender_postal_code" class="quest__input"
                                                        value="@isset($credentials['sender_postal_code']) {{ $credentials['sender_postal_code'] }} @endisset" placeholder="00000">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="quest__slider_buttons_wrapper">
                                        <div id="sender-credentials-button" class="quest__next quest__button">Далее</div>
                                    </div>
                                </div>
                                <!-- ________SLIDE -->
                                <!-- ________SLIDE -->
                                <div id="adress-slide" class="swiper-slide address-slide">
                                    <div class="quest__input-group">
                                        <div class="quest__slide_title_wrapper">
                                            <div class="quest__slide_title">
                                                Адрес получателя
                                                @isset($credentials)
                                                    <span class="badge badge-info cart-badge">данные взяты из <a href="{{ route('profile') }}">профиля</a> </span>
                                                @endisset
                                            </div>

                                        </div>
                                        <div class="quest__slide_forms_wrapper">
                                            <div class="quest__input-group">

                                                {{--<div class="address">--}}
                                                {{--    <div id="header">--}}
                                                {{--        <label for="suggest">Город, улица, дом</label>--}}
                                                {{--        <div class="address-input">--}}
                                                {{--                            <textarea id="suggest"--}}
                                                {{--                                    name="address"--}}
                                                {{--                                    class="w-100"--}}
                                                {{--                                    value="@isset($credentials['address']){{ $credentials['address'] }}@endisset"--}}
                                                {{--                                    placeholder="Введите адрес">@isset($credentials['address'])--}}
                                                {{--                                    {{ $credentials['address'] }}--}}
                                                {{--                                @endisset</textarea>--}}
                                                {{--            <div class="btn" id="button">--}}
                                                {{--                <img src="{{ asset('/images/icons/refresh.svg')  }}" alt="" class="refresh-icon">--}}
                                                {{--            </div>--}}
                                                {{--        </div>--}}
                                                {{--    </div>--}}
                                                {{--</div>--}}
                                                {{--hidden inputs for adding address parts to formdata--}}
                                                {{--<input type="hidden" id="form_region" name="region">--}}
                                                {{--<input type="hidden" id="form_area" name="admin_area">--}}
                                                {{--<input type="hidden" id="form_city" name="city">--}}
                                                {{--<input type="hidden" id="form_street" name="street">--}}
                                                {{--<input type="hidden" id="form_house" name="house">--}}
                                                {{--<input type="hidden" id="form_premise" name="premise">--}}
                                                {{--<input type="hidden" id="form_postal_code" name="postal_code">--}}

                                            </div>

                                            <div class="quest__input-group">
                                                <label for="form_region">Регион</label>
                                                <input type="text" id="form_region" name="region"
                                                        class="quest__input" value="@isset($credentials['region']){{ $credentials['region'] }}@endisset"
                                                        placeholder="Новосибирская область" >
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="form_area">Район</label>
                                                <input type="text" id="form_area" name="admin_area"
                                                        class="quest__input" value="@isset($credentials['admin_area']){{ $credentials['admin_area'] }}@endisset"
                                                        placeholder="Ленинский район" >
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="form_city">Город</label>
                                                <input type="text" id="form_city" name="city"
                                                        class="quest__input" value="@isset($credentials['city']){{ $credentials['city'] }}@endisset"
                                                        placeholder="Новосибирск" >
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="form_street">Улица</label>
                                                <input type="text" id="form_street" name="street"
                                                        class="quest__input" value="@isset($credentials['street']){{ $credentials['street'] }}@endisset"
                                                        placeholder="улица Ленина" >
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="form_house">Дом</label>
                                                <input type="text" id="form_house" name="house"
                                                        class="quest__input" value="@isset($credentials['house']){{ $credentials['house'] }}@endisset"
                                                        placeholder="12Б" >
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="form_premise">Корпус</label>
                                                <input type="text" id="form_premise" name="premise"
                                                        class="quest__input" value="@isset($credentials['premise']){{ $credentials['premise'] }}@endisset"
                                                        placeholder="3">
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="apartment">Квартира</label>
                                                <input type="text" id="apartment" name="apartment"
                                                        class="quest__input" value="@isset($credentials['apartment']){{ $credentials['apartment'] }}@endisset"
                                                        placeholder="56" inputmode="numeric">
                                            </div>
                                            <div class="quest__input-group">

                                                <label for="form_postal_code">Почтовый индекс</label>
                                                <input type="text" id="form_postal_code" name="postal_code"
                                                        class="quest__input" value="@isset($credentials['postal_code']){{ $credentials['postal_code'] }}@endisset"
                                                        placeholder="000000" inputmode="numeric">
                                            </div>



                                        </div>
                                    </div>
                                    <div class="quest__slider_buttons_wrapper">
                                        <div id="address-button" class="quest__next quest__button">Вперёд</div>
                                        <div class="quest__prev quest__button">Назад</div>
                                    </div>

                                </div>
                                <!-- ________SLIDE -->
                                {{--<div class="swiper-slide">--}}
                                {{--    <div class="quest__slide">--}}
                                {{--        <div class="quest__slide_title_wrapper">--}}
                                {{--            <div class="quest__slide_title">--}}
                                {{--                Оформить заказ--}}
                                {{--            </div>--}}
                                {{--        </div>--}}

                                {{--        @livewire('delivery-selector')--}}



                                {{--    </div>--}}
                                {{--    <div class="quest__slider_buttons_wrapper">--}}
                                {{--        <div class="quest__next quest__button">Вперёд</div>--}}
                                {{--        <div class="quest__prev quest__button">Назад</div>--}}
                                {{--    </div>--}}
                                {{--</div>--}}
                                <!-- ________SLIDE -->
                                <div class="swiper-slide">
                                    <div class="quest__slide credentials-slide">
                                        <div class="quest__slide_title_wrapper">
                                            <div class="quest__slide_title">
                                                Получатель
                                            </div>
                                            <div class="quest__slide_subtitle">
                                                Данные получателя посылки
                                            </div>
                                            <div class="redline"></div>
                                        </div>
                                        <div class="quest__slide_forms_wrapper">
                                            <div class="quest__input-group">
                                                <label for="surname">Фамилия</label>
                                                <input type="text" id="recipient_surname" name="recipient_surname" class="quest__input"
                                                        value="@isset($credentials['recipient_surname']) {{ $credentials['recipient_surname'] }} @endisset" placeholder="Иванов">

                                            </div>
                                            <div class="quest__input-group">
                                                <label for="name">Имя</label>
                                                <input type="text" id="recipient_name" name="recipient_name" class="quest__input"
                                                        value="@isset($credentials['recipient_name']) {{ $credentials['recipient_name'] }} @endisset" placeholder="Иван">
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="tel">Телефон</label>
                                                <script src="https://unpkg.com/imask"></script>
                                                <input type="tel" id="tel" name="telephone"
                                                        class="quest__input"
                                                        value="@isset($credentials['tel']){{ $credentials['tel'] }}@endisset" placeholder="+7 (___) ___-__-__" inputmode="tel">
                                                <script>
                                                  document.addEventListener('DOMContentLoaded', function() {
                                                    var phoneInput = document.getElementById('tel');
                                                    var maskOptions = {
                                                      mask: '+{7} (000) 000-00-00'
                                                    };
                                                    var mask = IMask(phoneInput, maskOptions);
                                                  });
                                                </script>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="quest__slider_buttons_wrapper">
                                        <div id="receiver-credentials-button" class="quest__next quest__button">Далее</div>
                                        {{--<input id="receiver-credentials-button" class="quest__button quest__submit_button" value="Оформить заказ" type="submit">--}}
                                        <div class="quest__prev quest__button">Назад</div>
                                    </div>
                                </div>
                                <!-- ________SLIDE -->
                                <div class="swiper-slide">
                                    <div class="quest__slide">
                                        <div class="quest__slide_title_wrapper">
                                            <div class="quest__slide_title">
                                                Регистрация и контакты
                                            </div>
                                            <div class="quest__slide_subtitle">
                                                Предпочтительный способ связи
                                            </div>
                                            <div class="redline"></div>
                                        </div>
                                        <div class="quest__slide_forms_wrapper">
{{--                                            @guest--}}
{{--                                                <div data-tippy="This is a simple tooltip" class="form-check">--}}
{{--                                                    <input class="form-check-input" type="checkbox" value="1" name="registerCheck" id="registerCheck">--}}
{{--                                                    <label class="form-check-label" for="registerCheck">--}}
{{--                                                        Зарегистрироваться--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                            @endguest--}}
                                            <div class="quest__input-group">
                                                <label for="email">Email*</label>
                                                <input type="text" id="email" name="email" class="quest__input"
                                                        value="@isset($credentials['email']){{ $credentials['email'] }}@endisset" placeholder="mail@mail.com">
                                            </div>
                                            <div  class="form-check">
                                                <input class="form-check-input" type="checkbox" required value="1" name="gdpr_check" id="gdpr_check">
                                                <label class="form-check-label" for="gdpr_check">
                                                    Согласен с <a href="{{ route('gdpr') }}" target="_blank">GDPR</a> и <a href="{{ route('conditions') }}">условиями перевозки</a>
                                                </label>
                                            </div>
                                            {{--<div class="quest__input-group quest__input-group_hidden" id="password-group">--}}
                                            {{--    <label for="password">пароль</label>--}}
                                            {{--    <input type="password" id="password" name="password" required class="quest__input">--}}
                                            {{--    <label for="password_confirmation">подтверждение пароля</label>--}}
                                            {{--    <input type="password" id="password_confirmation" name="password_confirmation" required class="quest__input">--}}
                                            {{--</div>--}}
                                            {{--<div class="quest__input-group">--}}
                                            {{--    <label for="telegram">Telegram</label>--}}
                                            {{--    <input type="text" id="telegram" name="telegram"--}}
                                            {{--            class="quest__input"--}}
                                            {{--            value="@isset($credentials['telegram']) {{ $credentials['telegram'] }} @endisset" placeholder="@username">--}}
                                            {{--</div>--}}
                                            {{--<div class="quest__input-group">--}}
                                            {{--    <label for="whatsapp">Whatsapp</label>--}}
                                            {{--    <input type="text" id="whatsapp" name="whatsapp"--}}
                                            {{--            class="quest__input"--}}
                                            {{--            value="@isset($credentials['whatsapp']) {{ $credentials['whatsapp'] }} @endisset" placeholder="89000000000">--}}

                                            {{--</div>--}}

                                        </div>
                                    </div>
                                    <div class="quest__slider_buttons_wrapper">
                                        <input class="quest__button quest__submit_button" value="Оформить заказ" type="submit">
                                        <div class="quest__prev quest__button">Назад</div>
                                    </div>
                                </div>
                                {{--<!-- ________SLIDE -->--}}
                                {{--<div class="swiper-slide">--}}
                                {{--    <div class="quest__slide">--}}
                                {{--        <div class="quest__slide_title_wrapper">--}}
                                {{--            <div class="quest__slide_title">--}}
                                {{--                Оплата--}}
                                {{--            </div>--}}
                                {{--            <div class="redline"></div>--}}
                                {{--        </div>--}}
                                {{--        <div class="quest__slide_forms_wrapper">--}}

                                {{--            <div class="quest__input-group">--}}
                                {{--                <label for="name">Способ оплаты</label>--}}
                                {{--                <fieldset>--}}
                                {{--                    <legend>Выберите один из доступных способов оплаты:</legend>--}}

                                {{--                    <div>--}}
                                {{--                        <input type="radio" id="p2p" name="pay" value="p2p"--}}
                                {{--                                checked>--}}
                                {{--                        <label for="p2p">перевод с карты на карту</label>--}}
                                {{--                    </div>--}}

                                {{--                    <div>--}}
                                {{--                        <input type="radio" id="qiwi" name="pay" value="qiwi">--}}
                                {{--                        <label for="qiwi">qiwi</label>--}}
                                {{--                    </div>--}}

                                {{--                    <div>--}}
                                {{--                        <input type="radio" id="visa" name="pay" value="visa">--}}
                                {{--                        <label for="visa">Visa</label>--}}
                                {{--                    </div>--}}
                                {{--                </fieldset>--}}
                                {{--            </div>--}}

                                {{--        </div>--}}
                                {{--    </div>--}}
                                {{--    <div class="quest__slider_buttons_wrapper">--}}
                                {{--        <input class="quest__button quest__submit_button" type="submit">--}}
                                {{--        <div class="quest__prev quest__button">Назад</div>--}}
                                {{--    </div>--}}
                                {{--</div>--}}

                            </div>
                        </div>

                    </section>
                </div>
            </section>
        </div>

    </form>



    @push('scripts')
        <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>


        <script src="{{ asset('js/checkout.js') }}"></script>
        @if( empty($credentials) )
            <script>
              //fill inputs with values from localstorage
              let inputs = document.querySelectorAll('input');
              inputs.forEach((input) => {

                if (input.name) {
                  if (localStorage.getItem(input.name)) {
                    input.value = localStorage.getItem(input.name);
                  }
                }
                //save entered values to localstorage, to prevent loss
                input.addEventListener('blur', (input) => {

                  localStorage.setItem(input.target.name, input.target.value);
                })
              })
            </script>

        @endif
        <!-- Laravel Javascript Validation -->
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        {{--        {!! $validator->selector('#quest_form') !!}--}}
        {!! JsValidator::formRequest('App\Http\Requests\ParcelCheckout', '#quest_form'); !!}

        <script>
          //intermediate validation
          const form = $("#quest_form");

          function checkIfAllFieldsValidated(condition) {
            if (condition) {
              swiper.allowSlideNext = true
              swiper.slideNext()
              swiper.allowSlideNext = false
            } else {
              swiper.allowSlideNext = false
            }
          }

          // sender name slide ----------------------------------------------------------------------
          document.getElementById('sender-credentials-button').addEventListener('click', () => {

            let sender_name = form.validate().element('#sender_name');
            let sender_surname = form.validate().element('#sender_surname');
            let sender_city = form.validate().element('#sender_city');
            let sender_address = form.validate().element('#sender_address');
            let sender_postal_code = form.validate().element('#sender_postal_code');
            let credentialsCondition = sender_name && sender_surname && sender_city && sender_address && sender_postal_code;
            checkIfAllFieldsValidated(credentialsCondition);
          }, 10);
          // ----------------------------------------------------------------------------------------


          // receiver adress slide ----------------------------------------------------------------------
          document.getElementById('address-button').addEventListener('click', () => {
              {{--<input type="hidden" id="form_region" name="region">--}}
              {{--<input type="hidden" id="form_area" name="admin_area">--}}
              {{--<input type="hidden" id="form_city" name="city">--}}
              {{--<input type="hidden" id="form_street" name="street">--}}
              {{--<input type="hidden" id="form_house" name="house">--}}
              {{--<input type="hidden" id="form_premise" name="premise">--}}
              {{--<input type="hidden" id="form_postal_code" name="postal_code">--}}
            let apartment = form.validate().element('#apartment');
            let region = form.validate().element('#form_region');
            let area = form.validate().element('#form_area');
            let city = form.validate().element('#form_city');
            let street = form.validate().element('#form_street');
            let premise = form.validate().element('#form_premise');
            let house = form.validate().element('#form_house');
            let postal_code = form.validate().element('#form_postal_code');
            let addressCondition = region && area && city && street && house && apartment && postal_code;

            checkIfAllFieldsValidated(addressCondition);

          });
          // ----------------------------------------------------------------------------------------

          // receiver credentials ----------------------------------------------------------------------
          document.getElementById('receiver-credentials-button').addEventListener('click', () => {

            let recipient_name = form.validate().element('#recipient_name');
            let recipient_surname = form.validate().element('#recipient_surname');
            let tel = form.validate().element('#tel');
            let credentialsCondition = recipient_name && recipient_surname && tel;
            checkIfAllFieldsValidated(credentialsCondition);
              @guest
              tooltipInstance.show();

            // Hide the tooltip after 5 seconds
            setTimeout(function() {
              tooltipInstance.hide();
            }, 5000);
              @endguest
          }, 10);
          // ----------------------------------------------------------------------------------------


          //tooltip
          @guest
          const registerCheck = document.querySelector('.form-check');
          const tooltipContent = 'Рекомендуем зарегистрировать аккаунт, так вы сможете отслеживать заказ в личном кабинете'
          if (registerCheck) {
            tippy(registerCheck, {
              content: tooltipContent
            });
            const tooltipInstance = tippy(registerCheck);
            tooltipInstance.setContent(tooltipContent);
          }
            @endguest
        </script>

    @endpush
@endsection

