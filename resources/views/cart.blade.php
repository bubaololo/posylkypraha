@extends('layouts.app')
@section('title', 'Корзина')
@section('meta_description', 'Оформить посылку')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}"/>
        <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
        <link href="{{ asset('css/checkout-media.css') }}" rel="stylesheet">
    @endpush
    <main class="my-8">
        <div class="container">

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

            <section class="h-100 h-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center h-100">

                        <div class="col-lg-7">
                            <h5 class="mb-3"><a href="#!" class="text-body"><i
                                            class="fas fa-long-arrow-alt-left me-2"></i>Содержимое посылки</a></h5>
                            <hr>

                            <div class="d-flex flex-column gap-2 mb-4" id="packageItemsContainer">
                                <div>
                                    {{--@livewire('cart-counter')--}}
                                </div>

                            </div>
                            <template  id="package-item-template">
                                <div class="package-item">
                                    <div class="package-item__inner">
                                        <div class="package-item__description">
                                            {{--<label for="enclosureDescription" class="form-label">Disabled input</label>--}}
                                            <input type="text" id="enclosureDescription" class="form-control" placeholder="Описание вложения">
                                        </div>
                                        <div class="package-item__controls-wrap">

                                                <div class="package-item__weight-wrap input-group input-group-sm" style="width: 24ch;">
                                                    <span class="input-group-text">Вес</span>
                                                    <input type="number" min="0" id="weight_kg" class="package-item__weight form-control" placeholder="кг">
                                                    <input type="number" min="0" id="weight_g" class="package-item__weight form-control" placeholder="г">
                                                </div>

                                                <div class="package-item__quantity">

                                                    <div class="btn btn-light px-3 package-item__quantity-btn">
                                                        -
                                                    </div>

                                                    <div class="package-item__quantity-text">
                                                        <strong class="package-item__quantity-digit">1</strong>
                                                        <div class="package-item__quantity-measure">шт.</div>
                                                    </div>

                                                    <div class="btn btn-light px-3 me-2 package-item__quantity-btn">
                                                        +
                                                    </div>

                                                </div>


                                            <div class="package-item__del">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </template>

                            <div class="btn btn-outline-secondary btn-sm " id="add-package-item">+ добавить вложение</div>
                            <hr class="my-4">

                            {{--@livewire('cart-total')--}}
                            <script>
                              document.addEventListener('DOMContentLoaded', function() {
                                const container = document.getElementById('packageItemsContainer');
                                const addBtn = document.getElementById('add-package-item');

                                // Функция для добавления нового элемента вложения
                                function addPackageItem() {
                                  const content = document.getElementById('package-item-template').content;
                                  const clone = document.importNode(content, true);
                                  container.appendChild(clone);
                                  updateRemoveButtons();
                                }

                                // Функция для обновления состояния кнопок удаления
                                function updateRemoveButtons() {
                                  const removeButtons = container.querySelectorAll('.package-item__del');
                                  removeButtons.forEach(button => {
                                    button.removeEventListener('click', removePackageItem);
                                    button.addEventListener('click', removePackageItem);
                                  });

                                  // Если есть только одна карточка, отключить кнопку удаления
                                  if(removeButtons.length === 1) {
                                    removeButtons[0].disabled = true;
                                  } else {
                                    removeButtons.forEach(button => button.disabled = false);
                                  }
                                }

                                // Функция для удаления элемента вложения
                                function removePackageItem(event) {
                                  if(container.querySelectorAll('.package-item__inner').length > 1) {
                                    event.target.closest('.package-item__inner').remove();
                                    updateRemoveButtons();
                                  }
                                }

                                // Обработчик события для кнопки добавления
                                addBtn.addEventListener('click', addPackageItem);

                                // Добавляем первую карточку при загрузке страницы и обновляем кнопки удаления
                                addPackageItem();
                                updateRemoveButtons();
                              });
                            </script>

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
                                            <form enctype="multipart/form-data" method="post" id="quest_form"
                                                    class="quest__slides swiper-wrapper" action="/checkout">
                                            @csrf

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
                                                                {{--<label for="name">Куда отправить ваши грибы</label>--}}
                                                                {{--<p>Город, улица, дом</p>--}}
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
                                                            {{--@livewire('delivery-selector')--}}
                                                        </div>
                                                    </div>
                                                    <div class="quest__slider_buttons_wrapper">
                                                        <div id="address-button" class="quest__next quest__button">Вперёд</div>
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
                                                                Персональные данные
                                                            </div>
                                                            <div class="quest__slide_subtitle">
                                                                Данные необходимые для доставки
                                                            </div>
                                                            <div class="redline"></div>
                                                        </div>
                                                        <div class="quest__slide_forms_wrapper">
                                                            <div class="quest__input-group">
                                                                <label for="name">Имя</label>
                                                                <input type="text" id="name" name="name" class="quest__input"
                                                                        value="@isset($credentials['name']) {{ $credentials['name'] }} @endisset" placeholder="Иван">
                                                            </div>
                                                            <div class="quest__input-group">
                                                                <label for="surname">Фамилия</label>
                                                                <input type="text" id="surname" name="surname" class="quest__input"
                                                                        value="@isset($credentials['surname']) {{ $credentials['surname'] }} @endisset" placeholder="Иванов">

                                                            </div>
                                                            <div class="quest__input-group">
                                                                <label for="middle_name">Отчество</label>
                                                                <input type="text" id="middle_name" name="middle_name"
                                                                        class="quest__input"
                                                                        value="@isset($credentials['middle_name']) {{ $credentials['middle_name'] }} @endisset" placeholder="Иванович">
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
                                                        <div id="credentials-button" class="quest__next quest__button">Далее</div>
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
                                                            @guest
                                                                <div data-tippy="This is a simple tooltip" class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" name="registerCheck" id="registerCheck">
                                                                    <label class="form-check-label" for="registerCheck">
                                                                        Зарегистрироваться
                                                                    </label>
                                                                </div>
                                                            @endguest
                                                            <div class="quest__input-group">
                                                                <label for="email">Email</label>
                                                                <input type="text" id="email" name="email" class="quest__input"
                                                                        value="@isset($credentials['email']){{ $credentials['email'] }}@endisset" placeholder="mail@mail.com">
                                                            </div>
                                                            <div class="quest__input-group quest__input-group_hidden" id="password-group">
                                                                <label for="password">пароль</label>
                                                                <input type="password" id="password" name="password" required class="quest__input">
                                                                <label for="password_confirmation">подтверждение пароля</label>
                                                                <input type="password" id="password_confirmation" name="password_confirmation" required class="quest__input">
                                                            </div>
                                                            <div class="quest__input-group">
                                                                <label for="telegram">Telegram</label>
                                                                <input type="text" id="telegram" name="telegram"
                                                                        class="quest__input"
                                                                        value="@isset($credentials['telegram']) {{ $credentials['telegram'] }} @endisset" placeholder="@username">
                                                            </div>
                                                            <div class="quest__input-group">
                                                                <label for="whatsapp">Whatsapp</label>
                                                                <input type="text" id="whatsapp" name="whatsapp"
                                                                        class="quest__input"
                                                                        value="@isset($credentials['whatsapp']) {{ $credentials['whatsapp'] }} @endisset" placeholder="89000000000">

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="quest__slider_buttons_wrapper">
                                                        <input class="quest__button quest__submit_button" value="Оформить заказ" type="submit">
                                                        <div class="quest__prev quest__button">Назад</div>
                                                    </div>
                                                </div>
                                                <!-- ________SLIDE -->
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
                                            </form>
                                        </div>

                                    </section>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </section>

        </div>

    </main>

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
              const city = obj._getParsedXal().localities[0];
              const street = obj._getParsedXal().thoroughfare;
              const house = obj._getParsedXal().premiseNumber;
              console.log(house)
              const post_index = obj.properties.get('metaDataProperty').GeocoderMetaData.Address.postal_code;
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

        </script>

        <script src="{{ asset('js/checkout.js') }}"></script>
        @if( empty($credentials) )
            <script>
              let inputs = document.querySelectorAll('input[type=text]');
              inputs.forEach((input) => {

                if (input.name) {
                  if (localStorage.getItem(input.name)) {
                    input.value = localStorage.getItem(input.name);
                  }
                }

                input.addEventListener('blur', (input) => {

                  localStorage.setItem(input.target.name, input.target.value);
                })
              })
            </script>
        @endif
        <!-- Laravel Javascript Validation -->
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        {{--        {!! $validator->selector('#quest_form') !!}--}}
        {!! JsValidator::formRequest('App\Http\Requests\StoreCheckout', '#quest_form'); !!}
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


          document.getElementById('address-button').addEventListener('click', () => {
              @if( empty($credentials['address']) )
            let address = form.validate().element('#suggest');

            let addressCondition = address && addressIsValid;
            if (address && !addressIsValid) {
              $('#notice').text('некорректный или неполный адрес');
              $('#suggest').addClass('input_error');
              $('#notice').css('display', 'block');
            }
            checkIfAllFieldsValidated(addressCondition);
              @else
            let delivery = form.validate().element('#sdek');
            checkIfAllFieldsValidated(delivery);
              @endif
          });
          //tooltip
          @guest
          const registerCheck = document.querySelector('.form-check');
          const tooltipContent = 'Рекомендуем зарегистрировать аккаунт, так вы сможете отслеживать заказ в личном кабинете'
          tippy(registerCheck, {
            content: tooltipContent
          });
          const tooltipInstance = tippy(registerCheck);
          tooltipInstance.setContent(tooltipContent);
          @endguest
          document.getElementById('credentials-button').addEventListener('click', () => {

            let name = form.validate().element('#name');
            let surname = form.validate().element('#surname');
            let middle_name = form.validate().element('#middle_name');
            let tel = form.validate().element('#tel');
            let credentialsCondition = name && surname && middle_name && tel;
            checkIfAllFieldsValidated(credentialsCondition);
              @guest
              tooltipInstance.show();

            // Hide the tooltip after 5 seconds
            setTimeout(function() {
              tooltipInstance.hide();
            }, 5000);
              @endguest
          }, 10);
        </script>
        <script>
          // Initialize tippy on all elements with the data-tippy attribute

        </script>
    @endpush
@endsection

