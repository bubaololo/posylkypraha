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
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">Профиль</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    {{--<img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"--}}
                                    {{--        class="rounded-circle img-fluid" style="width: 150px;">--}}
                                    <h5 class="my-3">{{ Auth::user()->name }}</h5>
                                    <p class="text-muted mb-1">{{ Auth::user()->email }}</p>
                                    <p class="text-muted mb-4">Зарегистрирован: {{ Auth::user()->created_at->isoFormat('D-MM-YY') }}</p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a href="password/reset" class="btn btn-outline-warning">Сбросить пароль</a>
                                        {{--<button type="button" class="btn btn-outline-primary ms-1">Message</button>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                        @if(empty($credentials))

                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Данные для доставки</h4>
                                        </div>
                                        <form enctype="multipart/form-data" method="post" id="profile-credentials"
                                                action="/credentials">
                                            @csrf
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label class="labels">Имя</label><input type="text" required name="name" class="form-control" placeholder="Иван" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Фамилия</label><input type="text" required name="surname" class="form-control" value="" placeholder="Иванов">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Отчество</label><input type="text" required name="middle_name" class="form-control" value="" placeholder="Иванович">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Телефон</label><input type="text" name="tel" class="form-control" value="" placeholder="890000000">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Whatsapp</label><input type="text" name="whatsapp" class="form-control" value="" placeholder="890000000">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Telegram</label><input type="text" name="telegram" class="form-control" value="" placeholder="@username">
                                                </div>
                                            </div>

                                            {{--<div class="col-md-12">--}}
                                            {{--    <label class="labels">Город, улица, дом</label><input type="text" name="address" required class="form-control" placeholder="Москва, ул. Пушкина, д. Колотушкина" value="">--}}
                                            {{--</div>--}}
                                            <div class="col-md-12">

                                                <label class="labels">Город, улица, дом</label><input type="text" id="suggest" name="address" class="form-control w-100" value="" placeholder="Введите адрес">

                                                <div class="btn btn-gray mt-3" id="button">Проверить</div>
                                                <p id="notice">Адрес не найден</p>
                                                <div id="map"></div>
                                                <div id="footer">
                                                    <div id="messageHeader"></div>
                                                    <div id="message"></div>
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Квартира</label><input type="text" name="apartment" class="form-control" placeholder="22" value="">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Комментарий к адресу</label><input type="text" name="comment" class="form-control" placeholder="любые уточнения" value="">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Индекс</label><input type="text" name="index" class="form-control" placeholder="000000" value="">
                                            </div>
                                        {{--<div class="col-md-12">--}}
                                        {{--    <label class="labels">State</label><input type="text" class="form-control" placeholder="enter address line 2" value="">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-12">--}}
                                        {{--    <label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value="">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-12">--}}
                                        {{--    <label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value="">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-12">--}}
                                        {{--    <label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value="">--}}
                                        {{--</div>--}}
                                    </div>
                                    {{--<div class="row mt-3">--}}
                                    {{--    <div class="col-md-6">--}}
                                    {{--        <label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value="">--}}
                                    {{--    </div>--}}
                                    {{--    <div class="col-md-6">--}}
                                    {{--        <label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state">--}}
                                    {{--    </div>--}}
                                    {{--</div>--}}
                                    <div class="my-4 text-center">
                                        <input class="btn btn-primary profile-button" type="submit" value="отправить">
                                    </div>
                                    </form>
                                </div>

                            </div>

                    </div>
                </section>
            </div>

            <style>
                body {
                    background: rgb(99, 39, 120)
                }

                .form-control:focus {
                    box-shadow: none;
                    border-color: #BA68C8
                }

                .profile-button {
                    background: rgb(99, 39, 120);
                    box-shadow: none;
                    border: none
                }

                .profile-button:hover {
                    background: #682773
                }

                .profile-button:focus {
                    background: #682773;
                    box-shadow: none
                }

                .profile-button:active {
                    background: #682773;
                    box-shadow: none
                }

                .back:hover {
                    color: #682773;
                    cursor: pointer
                }

                .labels {
                    font-size: 11px
                }

                .add-experience:hover {
                    background: #BA68C8;
                    color: #fff;
                    cursor: pointer;
                    border: solid 1px #BA68C8
                }
            </style>
            @else
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">ФИО</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $credentials->surname }} {{ $credentials->name }} {{ $credentials->middle_name }}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Телефон</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $credentials->tel }}</p>
                                </div>
                            </div>
                            <hr>
                            {{--<div class="row">--}}
                            {{--    <div class="col-sm-3">--}}
                            {{--        <p class="mb-0">Mobile</p>--}}
                            {{--    </div>--}}
                            {{--    <div class="col-sm-9">--}}
                            {{--        <p class="text-muted mb-0">(098) 765-4321</p>--}}
                            {{--    </div>--}}
                            {{--</div>--}}
                            {{--<hr>--}}
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Адрес</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $credentials->address }}</p>
                                </div>
                            </div>
                            <a href="/credentials" class="btn btn-gray mt-3">редактировать</a>

                        </div>

                    </div>
                    @endif

                        <div class="card-body">
                            <h2 class="mb-4"> Заказы
                            </h2>
                            @if(!empty($orders))
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                    <tr>

                                        <th scope="col">Номер</th>
                                        <th scope="col">Cумма</th>
                                        <th scope="col">Трек</th>
                                        <th scope="col">Создан</th>
                                        <th scope="col">Статус</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orders as $order)
                                        <tr scope="row">
                                            <td>
                                                {{ $order['order_num']  }}
                                            </td>
                                            <td class="pl-0">
                                                <div class="d-flex align-items-center">

                                                    {{ $order['total']  }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $order['track']  }}
                                            </td>
                                            <td class="text-nowrap" > {{ $order['created_at']->isoFormat('D MMMM YYYY, HH:mm')  }}</td>
                                            <td class="text-nowrap"  >{{ $order['status']  }}</td>
                                            <td><a href="/order/{{ $order['id']  }}" class="more">Подробнее</a></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            @else
                                Вы ещё не сделали заказ
                            @endif
                        </div>



                    {{--<div class="row">--}}

                    {{--    <div class="col-md-6">--}}
                    {{--        <div class="card mb-4 mb-md-0">--}}
                    {{--            <div class="card-body">--}}
                    {{--                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status--}}
                    {{--                </p>--}}
                    {{--                <p class="mb-1" style="font-size: .77rem;">Web Design</p>--}}
                    {{--                <div class="progress rounded" style="height: 5px;">--}}
                    {{--                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"--}}
                    {{--                            aria-valuemin="0" aria-valuemax="100"></div>--}}
                    {{--                </div>--}}
                    {{--                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>--}}
                    {{--                <div class="progress rounded" style="height: 5px;">--}}
                    {{--                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"--}}
                    {{--                            aria-valuemin="0" aria-valuemax="100"></div>--}}
                    {{--                </div>--}}
                    {{--                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>--}}
                    {{--                <div class="progress rounded" style="height: 5px;">--}}
                    {{--                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"--}}
                    {{--                            aria-valuemin="0" aria-valuemax="100"></div>--}}
                    {{--                </div>--}}
                    {{--                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>--}}
                    {{--                <div class="progress rounded" style="height: 5px;">--}}
                    {{--                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"--}}
                    {{--                            aria-valuemin="0" aria-valuemax="100"></div>--}}
                    {{--                </div>--}}
                    {{--                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>--}}
                    {{--                <div class="progress rounded mb-2" style="height: 5px;">--}}
                    {{--                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"--}}
                    {{--                            aria-valuemin="0" aria-valuemax="100"></div>--}}
                    {{--                </div>--}}
                    {{--            </div>--}}
                    {{--        </div>--}}
                    {{--    </div>--}}
                    {{--</div>--}}
                </div>

        </div>
    </div>






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
    @if( empty($credentials['address']) )
        <script src="https://api-maps.yandex.ru/2.1/?apikey=13c7547f-2a6d-45df-b5d4-e5d0ab448ddc&lang=ru_RU" type="text/javascript"></script>
        <script type="text/javascript">
          // Функция ymaps.ready() будет вызвана, когда
          // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
          ymaps.ready(init);

          function init() {
            // Создание карты.
            var myMap = new ymaps.Map("map", {
              // Координаты центра карты.
              // Порядок по умолчанию: «широта, долгота».
              // Чтобы не определять координаты центра карты вручную,
              // воспользуйтесь инструментом Определение координат.
              center: [55.76, 37.64],
              // Уровень масштабирования. Допустимые значения:
              // от 0 (весь мир) до 19.
              zoom: 7
            });
          }
        </script>
        <script>
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
                } else {
                  showResult(obj);
                }
              }, function(e) {
                console.log(e)
              })

            }

            function showResult(obj) {
              // Удаляем сообщение об ошибке, если найденный адрес совпадает с поисковым запросом.
              $('#suggest').removeClass('input_error');
              $('#notice').css('display', 'none');

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
              showMessage(address);
            }

            function showError(message) {
              $('#notice').text(message);
              $('#suggest').addClass('input_error');
              $('#notice').css('display', 'block');
              // Удаляем карту.
              if (map) {
                map.destroy();
                map = null;
              }
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
              $('#messageHeader').text('Данные получены:');
              $('#message').text(message);
            }
          }
        </script>
    @endif
@endsection
