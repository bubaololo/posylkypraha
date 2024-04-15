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
                                <div class="package-item__weight-wrap input-group input-group-sm">
                                    <span class="input-group-text">Вес</span>
                                    <div class="package-item__input-wrap">
                                        <input type="number" min="0" x-model="item.weight_kg" :name="'items[' + index + '][weight_kg]'" class="form-control package-item__weight" placeholder="кг">
                                    </div>
                                    <div class="package-item__input-wrap">
                                        <input type="number" min="0" x-model="item.weight_g" :name="'items[' + index + '][weight_g]'" class="form-control package-item__weight" placeholder="г">
                                    </div>
                                </div>
                                <div class="package-item__quantity">
                                    <button type="button" class="btn btn-light px-3 package-item__quantity-btn" x-on:click="updateQuantity(item, -1)" x-bind:disabled="item.quantity <= 1">-</button>
                                    <div class="package-item__quantity-text">
                                        <strong x-text="item.quantity"></strong> шт.
                                        <!-- Скрытое поле для отправки количества -->
                                        <input type="hidden" x-model="item.quantity" :name="'items[' + index + '][quantity]'" class="form-control">
                                    </div>
                                    <button type="button" class="btn btn-light px-3 me-2 package-item__quantity-btn" x-on:click="updateQuantity(item, 1)">+</button>
                                </div>
                                <div class="package-item__value-wrap">
                                    <span class="input-group-text">Стоимость</span>
                                    <div class="package-item__input-wrap">
                                        <input type="number" min="0"  :name="'items[' + index + '][value]'" class="form-control package-item__value" placeholder="€">
                                    </div>

                                </div>

                                <div class="package-item__del" x-on:click="removeItem(index)" x-show="items.length > 1"></div>
                            </div>
                        </div>
                    </div>
                </template>

                <button type="button" class="btn btn-outline-secondary btn-sm" x-on:click="addItem()" >+ добавить вложение</button>
                <div class="delivery">
                    <label for="name">Способ доставки</label>
                    <fieldset>

                        <div class="delivery__type">
                            <div class="delivery-selector">
                                <input type="radio" class="btn-check" name="deliveryType"  id="ems" value="ems">
                                <label class="btn btn-outline-success" for="ems">EMS <br> <small>ускоренная</small></label>
                                <small class="text-muted delivery-selector__notify"  x-text="emsPrice"></small>
                            </div>

                            <div class="delivery-selector">
                                <input type="radio" class="btn-check" name="deliveryType" x-model="emsPrice" id="post" value="post">
                                <label class="btn btn-outline-success" for="post">Почта <br> <small>обычная посылка</small></label>
                                <small class="text-muted delivery-selector__notify"  x-text="postPrice"></small>
                            </div>

                        </div>
                    </fieldset>
                </div>
            </div>


            <script>
              function packageItemsComponent() {
                return {
                  items: [{ description: '', weight_kg: null, weight_g: null, quantity: 1 }],
                  deliveryType: '',
                  emsPrice: 0,
                  postPrice: 0,
                  emsRates: [
                    { weight: 2000, price: 950 },
                    { weight: 5000, price: 1250 },
                    { weight: 10000, price: 1850 },
                    { weight: 15000, price: 2350 },
                    { weight: 20000, price: 2850 },
                    { weight: 25000, price: 3350 },
                    { weight: 30000, price: 3850 },
                    { weight: Infinity, price: 0 }
                  ],
                  postRates: [
                    { weight: 2000, price: 800 },
                    { weight: 5000, price: 1100 },
                    { weight: 10000, price: 1250 },
                    { weight: 15000, price: 1500 },
                    { weight: 20000, price: 1600 },
                    { weight: Infinity, price: 0 }
                  ],

                  addItem() {
                    this.items.push({ description: '', weight_kg: null, weight_g: null, quantity: 1 });
                    this.calculateDeliveryCost();
                  },

                  removeItem(index) {
                    this.items.splice(index, 1);
                    this.calculateDeliveryCost();
                  },

                  updateQuantity(item, amount) {
                    const newQuantity = item.quantity + amount;
                    item.quantity = newQuantity >= 1 ? newQuantity : 1;
                    this.calculateDeliveryCost();
                  },

                  calculateDeliveryCost() {
                    let totalWeightKg = this.items.reduce((sum, item) => sum + (parseFloat(item.weight_kg) || 0), 0);
                    let totalWeightG = this.items.reduce((sum, item) => sum + (parseFloat(item.weight_g) || 0), 0);
                    let totalWeight = totalWeightKg * 1000 + totalWeightG;

                    this.emsPrice = this.getPriceByWeight(this.emsRates, totalWeight).toFixed(2);
                    this.postPrice = this.getPriceByWeight(this.postRates, totalWeight).toFixed(2);
                    console.log(this.emsPrice, this.postPrice);
                  },

                  getPriceByWeight(rates, weight) {
                    for (let rate of rates) {
                      if (weight <= rate.weight) {
                        return rate.price;
                      }
                    }
                    return 0; // Если не подходит ни одна категория
                  },

                  init() {
                    this.$watch('deliveryType', () => this.calculateDeliveryCost());
                    this.$watch('items', () => this.calculateDeliveryCost(), { deep: true });
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
                                                        value="@isset($credentials['sender_surname']) {{ $credentials['sender_surname'] }} @endisset" placeholder="Smith">

                                            </div>
                                            <div class="quest__input-group">
                                                <label for="sender_name">Имя отправителя</label>
                                                <input type="text" id="sender_name" name="sender_name" class="quest__input"
                                                        value="@isset($credentials['sender_name']) {{ $credentials['sender_name'] }} @endisset" placeholder="John">
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
                                                    <span class="badge badge-info cart-badge">данные взяты из <a href="{{ route('profile') }}">профиля</a> </span>@endisset
                                            </div>

                                        </div>
                                        <div class="quest__slide_forms_wrapper">
                                            <div class="quest__input-group">

                                                <div class="address">
                                                    <div id="header">
                                                        <label for="suggest">Город, улица, дом</label>
                                                        <div class="address-input">
                                                                            <textarea id="suggest"
                                                                                    name="address"
                                                                                    class="w-100"
                                                                                    value="@isset($credentials['address']){{ $credentials['address'] }}@endisset"
                                                                                    placeholder="Введите адрес">@isset($credentials['address']){{ $credentials['address'] }}@endisset</textarea>
                                                            <div class="btn" id="button">
                                                                <img src="{{ asset('/images/icons/refresh.svg')  }}" alt="" class="refresh-icon">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--hidden inputs for adding address parts to formdata--}}
                                                <input type="hidden" id="form_area" name="admin_area">
                                                <input type="hidden" id="form_region" name="region">
                                                <input type="hidden" id="form_city" name="city">
                                                <input type="hidden" id="form_street" name="street">
                                                <input type="hidden" id="form_house" name="house">
                                                <input type="hidden" id="form_premise" name="premise">
                                                <input type="hidden" id="form_postal_code" name="postal_code">

                                            </div>
                                            <p id="notice"></p>
                                            <div id="footer">
                                                <div id="messageHeader"></div>
                                                <div id="message"></div>
                                            </div>
                                            <div class="quest__input-group">
                                                <label for="apartment">Квартира</label>
                                                <input type="text" id="apartment" name="apartment"
                                                        class="quest__input" value="@isset($credentials['apartment']){{ $credentials['apartment'] }}@endisset"
                                                        placeholder="56" inputmode="numeric">
                                            </div>

                                            <div class="quest__input-group">
                                                <label for="street">Комментарий</label>
                                                <input type="text" id="comment" name="comment" class="quest__input"
                                                        value="@isset($credentials['comment']) {{ $credentials['comment'] }} @endisset" placeholder="любые уточнения">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="quest__slider_buttons_wrapper">
                                        <div id="address-button" class="quest__next quest__button">Вперёд</div>
                                        <div class="quest__prev quest__button">Назад</div>
                                    </div>
                                    <div id="map"></div>
                                    <div class="map-mask"></div>
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
                                                <input type="tel" id="tel" name="telephone"
                                                        class="quest__input"
                                                        value="@isset($credentials['tel']){{ $credentials['tel'] }}@endisset" placeholder="89000000000" inputmode="tel">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="quest__slider_buttons_wrapper">
                                        {{--<div id="credentials-button" class="quest__next quest__button">Далее</div>--}}
                                        <input id="receiver-credentials-button" class="quest__button quest__submit_button" value="Оформить заказ" type="submit">
                                        <div class="quest__prev quest__button">Назад</div>
                                    </div>
                                </div>
                                <!-- ________SLIDE -->
                                {{--<div class="swiper-slide">--}}
                                {{--    <div class="quest__slide">--}}
                                {{--        <div class="quest__slide_title_wrapper">--}}
                                {{--            <div class="quest__slide_title">--}}
                                {{--                Регистрация и контакты--}}
                                {{--            </div>--}}
                                {{--            <div class="quest__slide_subtitle">--}}
                                {{--                Предпочтительный способ связи--}}
                                {{--            </div>--}}
                                {{--            <div class="redline"></div>--}}
                                {{--        </div>--}}
                                {{--        <div class="quest__slide_forms_wrapper">--}}
                                {{--            @guest--}}
                                {{--                <div data-tippy="This is a simple tooltip" class="form-check">--}}
                                {{--                    <input class="form-check-input" type="checkbox" value="1" name="registerCheck" id="registerCheck">--}}
                                {{--                    <label class="form-check-label" for="registerCheck">--}}
                                {{--                        Зарегистрироваться--}}
                                {{--                    </label>--}}
                                {{--                </div>--}}
                                {{--            @endguest--}}
                                {{--            <div class="quest__input-group">--}}
                                {{--                <label for="email">Email</label>--}}
                                {{--                <input type="text" id="email" name="email" class="quest__input"--}}
                                {{--                        value="@isset($credentials['email']){{ $credentials['email'] }}@endisset" placeholder="mail@mail.com">--}}
                                {{--            </div>--}}
                                {{--            <div class="quest__input-group quest__input-group_hidden" id="password-group">--}}
                                {{--                <label for="password">пароль</label>--}}
                                {{--                <input type="password" id="password" name="password" required class="quest__input">--}}
                                {{--                <label for="password_confirmation">подтверждение пароля</label>--}}
                                {{--                <input type="password" id="password_confirmation" name="password_confirmation" required class="quest__input">--}}
                                {{--            </div>--}}
                                {{--            <div class="quest__input-group">--}}
                                {{--                <label for="telegram">Telegram</label>--}}
                                {{--                <input type="text" id="telegram" name="telegram"--}}
                                {{--                        class="quest__input"--}}
                                {{--                        value="@isset($credentials['telegram']) {{ $credentials['telegram'] }} @endisset" placeholder="@username">--}}
                                {{--            </div>--}}
                                {{--            <div class="quest__input-group">--}}
                                {{--                <label for="whatsapp">Whatsapp</label>--}}
                                {{--                <input type="text" id="whatsapp" name="whatsapp"--}}
                                {{--                        class="quest__input"--}}
                                {{--                        value="@isset($credentials['whatsapp']) {{ $credentials['whatsapp'] }} @endisset" placeholder="89000000000">--}}

                                {{--            </div>--}}

                                {{--        </div>--}}
                                {{--    </div>--}}
                                {{--    <div class="quest__slider_buttons_wrapper">--}}
                                {{--        <input class="quest__button quest__submit_button" value="Оформить заказ" type="submit">--}}
                                {{--        <div class="quest__prev quest__button">Назад</div>--}}
                                {{--    </div>--}}
                                {{--</div>--}}
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
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=13c7547f-2a6d-45df-b5d4-e5d0ab448ddc&suggest_apikey=8fcb8959-11fc-479a-86ad-9e33372a96e2" type="text/javascript"></script>
        <script>
          let addressIsValid = null;
          ymaps.ready(init);


          function init() {
            // Подключаем поисковые подсказки к полю ввода.
            var suggestView = new ymaps.SuggestView('suggest'),
                map,
                placemark;

            // При клике по кнопке запускаем верификацию введёных данных.

            $('#button').bind('click', function(e) {
              geocode();

            });
              @if( @isset($credentials['address']) )
              geocode();
              @endif
              document.getElementById('suggest').addEventListener('blur', () => {
                geocode();
              })

            let refreshBtn = document.getElementById('button');

            function disableRefreshBtn() {
              refreshBtn.style.display = 'none';
            }

            function enableRefreshBtn() {
              refreshBtn.style.display = 'flex';
            }

            function geocode() {
              // Забираем запрос из поля ввода.
              var request = $('#suggest').val();
              // Геокодируем введённые данные.
              ymaps.geocode(request).then(function(res) {
                var obj = res.geoObjects.get(0),
                    error, hint;
                if (obj) {
                  // Об оценке точности ответа геокодера можно прочитать тут: https://tech.yandex.ru/maps/doc/geocoder/desc/reference/precision-docpage/
                  switch (obj.properties.get('metaDataProperty.GeocoderMetaData.precision')) {
                    case 'exact':
                      break;
                    case 'number':
                    case 'near':
                    case 'range':
                      error = 'Неточный адрес, требуется уточнение';
                      hint = 'Уточните номер дома';
                      break;
                    case 'street':
                      error = 'Неполный адрес, требуется уточнение';
                      hint = 'Уточните номер дома';
                      break;
                    case 'other':
                    default:
                      error = 'Неточный адрес, требуется уточнение';
                      hint = 'Уточните адрес';
                  }
                } else {
                  error = 'Адрес не найден';
                  hint = 'Уточните адрес';

                }

                // Если геокодер возвращает пустой массив или неточный результат, то показываем ошибку.
                if (error) {
                  showError(error);
                  showMessage(hint);
                  addressIsValid = false;
                } else {
                  showResult(obj);
                }
              }, function(e) {
              })

            }

            function showResult(obj) {
              console.log(obj)
              //Извлекаем город из адреса
              // const adressString = obj.getAddressLine();

              addressRetryCount = 0;
              const coord = obj.properties.get('boundedBy')[0];
              // регион
              const region = obj._getParsedXal().administrativeAreas[0];
              console.log('регион: ' + region)
              //район
              const administrativeArea = obj._getParsedXal().administrativeAreas[1];
              console.log('район: ' + administrativeArea)
              // город
              const city = obj._getParsedXal().localities[0];
              console.log('город: ' + city)
              //улица
              const street = obj._getParsedXal().thoroughfare;
              console.log('улица: ' + street)
              //дом
              const premiseNumber = obj._getParsedXal().premiseNumber;
              console.log('улица: ' + premiseNumber)
              // корпус
              const premise = obj._getParsedXal().premise;
              console.log('корпус: ' + premise)

              const postIndex = obj.properties.get('metaDataProperty').GeocoderMetaData.Address.postal_code;
              console.log('индекс: ' + postIndex);

              document.getElementById('form_area').value = administrativeArea;
              document.getElementById('form_region').value = region;
              document.getElementById('form_city').value = city;
              document.getElementById('form_street').value = street;
              document.getElementById('form_house').value = premiseNumber;
              document.getElementById('form_premise').value = premise;
              document.getElementById('form_postal_code').value = postIndex;


              addressIsValid = true;

              // Удаляем сообщение об ошибке, если найденный адрес совпадает с поисковым запросом.
              $('#suggest').removeClass('input_error');
              $('#notice').css('display', 'none');
              disableRefreshBtn();

              var mapContainer = $('#map'),
                  bounds = obj.properties.get('boundedBy'),
                  // Рассчитываем видимую область для текущего положения пользователя.
                  mapState = ymaps.util.bounds.getCenterAndZoom(
                      bounds,
                      [mapContainer.width(), mapContainer.height()]
                  ),
                  // Сохраняем полный адрес для сообщения под картой.
                  address = [obj.getCountry(), obj.getAddressLine()].join(', '),
                  // Сохраняем укороченный адрес для подписи метки.
                  shortAddress = [obj.getThoroughfare(), obj.getPremiseNumber(), obj.getPremise()].join(' ');
              // Убираем контролы с карты.
              mapState.controls = [];
              // Создаём карту.
              createMap(mapState, shortAddress);
              // Выводим сообщение под картой.
              showFullMessage(address);
              // setTimeout(function() {
              //   Livewire.emit('delivery_price_set');
              // }, 1500);

            }

            let addressRetryCount = 0;

            function showError(message) {
              if (addressRetryCount == 0) {
                geocode();
                setTimeout(function() {
                  $('#button').trigger('click');
                }, 1000);
                addressRetryCount = 1;
              }
              addressIsValid = false;
              $('#messageHeader').text('');
              $('#notice').text(message);
              $('#suggest').addClass('input_error');
              $('#notice').css('display', 'block');
              // Удаляем карту.
              if (map) {
                map.destroy();
                map = null;
              }
              enableRefreshBtn();
            }

            function createMap(state, caption) {
              // Если карта еще не была создана, то создадим ее и добавим метку с адресом.
              if (!map) {
                map = new ymaps.Map('map', state);
                placemark = new ymaps.Placemark(
                    map.getCenter(), {
                      iconCaption: caption,
                      balloonContent: caption
                    }, {
                      preset: 'islands#redDotIconWithCaption'
                    });
                map.geoObjects.add(placemark);
                // Если карта есть, то выставляем новый центр карты и меняем данные и позицию метки в соответствии с найденным адресом.
              } else {
                map.setCenter(state.center, state.zoom);
                placemark.geometry.setCoordinates(state.center);
                placemark.properties.set({iconCaption: caption, balloonContent: caption});
              }
            }

            function showMessage(message) {
              $('#message').text(message);
            }

            function showFullMessage(message) {
              $('#messageHeader').text('Данные получены:');
              $('#message').text(message);
            }
          }

          // setTimeout(function() { // задержка для дополнительной проверки
          //   document.querySelectorAll('textarea').forEach(function(textarea) {
          //     if (textarea.value || textarea.textContent) {
          //       geocode()
          //     }
          //   });
          // }, 100); // Задержка в 100 мс
        </script>

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
            let credentialsCondition = sender_name && sender_surname;
            checkIfAllFieldsValidated(credentialsCondition);
          }, 10);
          // ----------------------------------------------------------------------------------------


          // receiver adress slide ----------------------------------------------------------------------
          document.getElementById('address-button').addEventListener('click', () => {
              @if( empty($credentials['address']) )
            let address = form.validate().element('#suggest');
            let apartment = form.validate().element('#apartment');
            let addressCondition = address && addressIsValid && apartment;
            if (address && !addressIsValid) {
              $('#notice').text('некорректный или неполный адрес');
              $('#suggest').addClass('input_error');
              $('#notice').css('display', 'block');
            }
            checkIfAllFieldsValidated(addressCondition);
              @endif
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

