<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Купить сибирские мухоморы')</title>
    <meta name="description" content="@yield('meta_description','Мухомор купить | мухомор красный | микродозинг мухомора | сушёные мухоморы')">
    <meta name="keywords" content="@yield('meta_keywords','мухомор купить, красный мухомор, микродозинг мухомора, купить сушёные мухоморы')">
    <link rel="canonical" href="{{url()->current()}}"/>
    <link rel="icon" type="image/x-icon" href="favicon32.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=Montserrat&family=Nunito:wght@400;600&family=Poppins:ital@1&display=swap"
            rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icomoon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet">
    @livewireStyles
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')

<!-- Scripts -->
    {{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}

    {{--    <link rel="stylesheet" href="{{ asset('build/assets/app.525f5899.css') }}">--}}
    {{--    <script src="{{ asset('build/assets/app.340e5d39.js') }}"></script>--}}

</head>
<body>

<header class="header">
    <div class="container">
        <div class="header__inner">

            <a href="{{ route('index') }}" class="main-logo">
                <img src="{{ asset('images/tmpimg/logo.svg') }}" alt="">
            </a>

            <div class="main-menu stellarnav">
                <ul class="menu-list">
                    {{--                                    <li class="menu-item active"><a href="{{ route('index') }}"--}}
                    {{--                                                                    data-effect="Home">Главная</a>--}}
                    {{--                                    </li>--}}
                    {{--<li class="menu-item"><a href="{{ route('products.list') }}" class="nav-link"--}}
                    {{--            data-effect="About">Фасовки</a>--}}
                    {{--</li>--}}

                    {{--                                    <li class="menu-item has-sub">--}}
                    {{--                                        <a href="#pages" class="nav-link" data-effect="Pages">Pages</a>--}}

                    {{--                                        <ul>--}}
                    {{--                                            <li class="active"><a href="{{ route('index') }}">Главная</a></li>--}}
                    {{--                                            <li><a href="about.html">About</a></li>--}}
                    {{--                                            <li><a href="styles.html">Styles</a></li>--}}
                    {{--                                            <li><a href="blog.html">Blog</a></li>--}}
                    {{--                                            <li><a href="single-post.html">Post Single</a></li>--}}
                    {{--                                            <li><a href="{{ route('products.list') }}">Витрина</a></li>--}}
                    {{--                                            <li><a href="single-product.html">Product Single</a></li>--}}
                    {{--                                            <li><a href="contact.html">Contact</a></li>--}}
                    {{--                                            <li><a href="thank-you.html">Thank You</a></li>--}}
                    {{--                                        </ul>--}}

                    {{--                                    </li>--}}
                    {{--                                    <li class="menu-item"><a href="#popular-books" class="nav-link"--}}
                    {{--                                                             data-effect="Shop">Shop</a></li>--}}
                    {{--                                    <li class="menu-item"><a href="#latest-blog" class="nav-link"--}}
                    {{--                                                             data-effect="Articles">Articles</a>--}}
                    {{--                                    </li>--}}
                    {{--<li class="menu-item"><a href="{{ route('posts.list') }}" class="nav-link"--}}
                    {{--            data-effect="Contact">Статьи</a></li>--}}
                    {{--@auth--}}
                    {{--    <li class="menu-item"><a href="{{ route('profile') }}" class="user-account for-buy"><i--}}
                    {{--                    class="icon icon-user"></i><span>Профиль</span></a></li>--}}
                    {{--@endauth--}}
                    {{--<li class="menu-item">--}}
                    {{--    <a href="{{ route('cart.list') }}" class="cart">--}}
                    {{--        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">--}}
                    {{--            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>--}}
                    {{--        </svg>--}}
                    {{--        <span>Корзина: @livewire('cart-counter')</span></a>--}}
                    {{--</li>--}}
{{--                    @guest--}}
{{--                        <li class="menu-item has-sub">--}}
{{--                            <a href="#pages" class="nav-link" data-effect="Pages">Аккаунт</a>--}}

{{--                            <ul>--}}
{{--                                @if (Route::has('register'))--}}

{{--                                    <li><a class="nav-link"--}}
{{--                                                href="{{ route('register') }}">{{ __('Зарегистрироваться') }}</a></li>--}}

{{--                                @endif--}}
{{--                                @if (Route::has('login'))--}}

{{--                                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a></li>--}}

{{--                                @endif--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                    @else--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"--}}
{{--                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                                    aria-expanded="false" v-pre>--}}
{{--                                {{ Auth::user()->name }}--}}
{{--                            </a>--}}

{{--                            <div class="dropdown-menu dropdown-menu-end"--}}
{{--                                    aria-labelledby="navbarDropdown">--}}
{{--                                <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                        onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}

{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
{{--                                        class="d-none">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endguest--}}
{{--                </ul>--}}

{{--                <div class="hamburger">--}}
{{--                    <span class="bar"></span>--}}
{{--                    <span class="bar"></span>--}}
{{--                    <span class="bar"></span>--}}
{{--                </div>--}}

{{--            </div>--}}

        </div>
    </div>
</header>
<!--header-wrap-->
<div class="content-wrapper">
    @yield('content')
</div>
<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4">

                <div class="footer-item">
                    <div class="company-brand">
                        <img src="{{ asset('images/tmpimg/logo.svg') }}" alt="logo" class="footer-logo">
                        <p>Доставка посылок из Чехии </p>
                    </div>
                </div>

            </div>

            <div class="col-md-2">

                <div class="footer-menu">
                    <h5>Контакты</h5>
                    <ul class="footer-menu__list menu-list">
                        <li class="footer-menu__item menu-item">

                            <svg id="Livello_1" class="footer-icon" data-name="Livello 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 240 240">
                                <defs>
                                    <linearGradient id="linear-gradient" x1="120" y1="240" x2="120" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#1d93d2"/>
                                        <stop offset="1" stop-color="#38b0e3"/>
                                    </linearGradient>
                                </defs>
                                <title>Telegram_logo</title>
                                <circle cx="120" cy="120" r="120" fill="url(#linear-gradient)"/>
                                <path d="M81.229,128.772l14.237,39.406s1.78,3.687,3.686,3.687,30.255-29.492,30.255-29.492l31.525-60.89L81.737,118.6Z" fill="#c8daea"/>
                                <path d="M100.106,138.878l-2.733,29.046s-1.144,8.9,7.754,0,17.415-15.763,17.415-15.763" fill="#a9c6d8"/>
                                <path d="M81.486,130.178,52.2,120.636s-3.5-1.42-2.373-4.64c.232-.664.7-1.229,2.1-2.2,6.489-4.523,120.106-45.36,120.106-45.36s3.208-1.081,5.1-.362a2.766,2.766,0,0,1,1.885,2.055,9.357,9.357,0,0,1,.254,2.585c-.009.752-.1,1.449-.169,2.542-.692,11.165-21.4,94.493-21.4,94.493s-1.239,4.876-5.678,5.043A8.13,8.13,0,0,1,146.1,172.5c-8.711-7.493-38.819-27.727-45.472-32.177a1.27,1.27,0,0,1-.546-.9c-.093-.469.417-1.05.417-1.05s52.426-46.6,53.821-51.492c.108-.379-.3-.566-.848-.4-3.482,1.281-63.844,39.4-70.506,43.607A3.21,3.21,0,0,1,81.486,130.178Z"
                                        fill="#fff"/>
                            </svg>

                            <a class="footer-menu__item_telegram" href="https://t.me/sergeybogodelov">Telegram</a>
                        </li>
                        <li class="footer-menu__item menu-item">

                            <svg class="footer-icon footer-icon_whatsapp" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800" width="1200" viewBox="-93.2412 -156.2325 808.0904 937.395">
                                <defs>
                                    <linearGradient x1=".5" y1="0" x2=".5" y2="1" id="a">
                                        <stop stop-color="#20B038" offset="0%"/>
                                        <stop stop-color="#60D66A" offset="100%"/>
                                    </linearGradient>
                                    <linearGradient x1=".5" y1="0" x2=".5" y2="1" id="b">
                                        <stop stop-color="#F9F9F9" offset="0%"/>
                                        <stop stop-color="#FFF" offset="100%"/>
                                    </linearGradient>
                                    <linearGradient xlink:href="#a" id="f" x1="270.265" y1="1.184" x2="270.265" y2="541.56" gradientTransform="scale(.99775 1.00225)"
                                            gradientUnits="userSpaceOnUse"/>
                                    <linearGradient xlink:href="#b" id="g" x1="279.952" y1=".811" x2="279.952" y2="560.571" gradientTransform="scale(.99777 1.00224)"
                                            gradientUnits="userSpaceOnUse"/>
                                    <filter x="-.056" y="-.062" width="1.112" height="1.11" filterUnits="objectBoundingBox" id="c">
                                        <feGaussianBlur stdDeviation="2" in="SourceGraphic"/>
                                    </filter>
                                    <filter x="-.082" y="-.088" width="1.164" height="1.162" filterUnits="objectBoundingBox" id="d">
                                        <feOffset dy="-4" in="SourceAlpha" result="shadowOffsetOuter1"/>
                                        <feGaussianBlur stdDeviation="12.5" in="shadowOffsetOuter1" result="shadowBlurOuter1"/>
                                        <feComposite in="shadowBlurOuter1" in2="SourceAlpha" operator="out" result="shadowBlurOuter1"/>
                                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.21 0" in="shadowBlurOuter1"/>
                                    </filter>
                                    <path d="M576.337 707.516c-.018-49.17 12.795-97.167 37.15-139.475L574 423.48l147.548 38.792c40.652-22.23 86.423-33.944 133.002-33.962h.12c153.395 0 278.265 125.166 278.33 278.98.025 74.548-28.9 144.642-81.446 197.373C999 957.393 929.12 986.447 854.67 986.48c-153.42 0-278.272-125.146-278.333-278.964z"
                                            id="e"/>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="matrix(1 0 0 -1 -542.696 1013.504)" fill="#000" fill-rule="nonzero" filter="url(#c)">
                                        <use filter="url(#d)" xlink:href="#e" width="100%" height="100%"/>
                                        <use fill-opacity=".2" xlink:href="#e" width="100%" height="100%"/>
                                    </g>
                                    <path transform="matrix(1 0 0 -1 41.304 577.504)" fill-rule="nonzero" fill="url(#f)"
                                            d="M2.325 274.421c-.014-47.29 12.342-93.466 35.839-134.166L.077 1.187l142.314 37.316C181.6 17.133 225.745 5.856 270.673 5.84h.12c147.95 0 268.386 120.396 268.447 268.372.03 71.707-27.87 139.132-78.559 189.858-50.68 50.726-118.084 78.676-189.898 78.708-147.968 0-268.398-120.386-268.458-268.358"/>
                                    <path transform="matrix(1 0 0 -1 31.637 586.837)" fill-rule="nonzero" fill="url(#g)"
                                            d="M2.407 283.847c-.018-48.996 12.784-96.824 37.117-138.983L.072.814l147.419 38.654c40.616-22.15 86.346-33.824 132.885-33.841h.12c153.26 0 278.02 124.724 278.085 277.994.026 74.286-28.874 144.132-81.374 196.678-52.507 52.544-122.326 81.494-196.711 81.528-153.285 0-278.028-124.704-278.09-277.98zm87.789-131.724l-5.503 8.74C61.555 197.653 49.34 240.17 49.36 283.828c.049 127.399 103.73 231.044 231.224 231.044 61.74-.025 119.765-24.09 163.409-67.763 43.639-43.67 67.653-101.726 67.635-163.469-.054-127.403-103.739-231.063-231.131-231.063h-.09c-41.482.022-82.162 11.159-117.642 32.214l-8.444 5.004L66.84 66.86z"/>
                                    <path d="M242.63 186.78c-5.205-11.57-10.684-11.803-15.636-12.006-4.05-.173-8.687-.162-13.316-.162-4.632 0-12.161 1.74-18.527 8.693-6.37 6.953-24.322 23.761-24.322 57.947 0 34.19 24.901 67.222 28.372 71.862 3.474 4.634 48.07 77.028 118.694 104.88 58.696 23.146 70.64 18.542 83.38 17.384 12.74-1.158 41.11-16.805 46.9-33.03 5.791-16.223 5.791-30.128 4.054-33.035-1.738-2.896-6.37-4.633-13.319-8.108-6.95-3.475-41.11-20.287-47.48-22.603-6.37-2.316-11.003-3.474-15.635 3.482-4.633 6.95-17.94 22.596-21.996 27.23-4.053 4.643-8.106 5.222-15.056 1.747-6.949-3.485-29.328-10.815-55.876-34.485-20.656-18.416-34.6-41.16-38.656-48.116-4.053-6.95-.433-10.714 3.052-14.178 3.12-3.113 6.95-8.11 10.424-12.168 3.467-4.057 4.626-6.953 6.942-11.586 2.316-4.64 1.158-8.698-.579-12.172-1.737-3.475-15.241-37.838-21.42-51.576"
                                            fill="#FFF"/>
                                </g>
                            </svg>

                            {{--<a class="footer-menu__item_whatsapp" href="whatsapp://send?phone=+79028223572">Whatsapp </a>--}}
                        </li>
                        <li class="footer-menu__item menu-item">

                            <svg class="footer-icon footer-icon_email " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">
<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
    <path d="M 75.546 78.738 H 14.455 C 6.484 78.738 0 72.254 0 64.283 V 25.716 c 0 -7.97 6.485 -14.455 14.455 -14.455 h 61.091 c 7.97 0 14.454 6.485 14.454 14.455 v 38.567 C 90 72.254 83.516 78.738 75.546 78.738 z M 14.455 15.488 c -5.64 0 -10.228 4.588 -10.228 10.228 v 38.567 c 0 5.64 4.588 10.229 10.228 10.229 h 61.091 c 5.64 0 10.228 -4.589 10.228 -10.229 V 25.716 c 0 -5.64 -4.588 -10.228 -10.228 -10.228 H 14.455 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
    <path d="M 11.044 25.917 C 21.848 36.445 32.652 46.972 43.456 57.5 c 2.014 1.962 5.105 -1.122 3.088 -3.088 C 35.74 43.885 24.936 33.357 14.132 22.83 C 12.118 20.867 9.027 23.952 11.044 25.917 L 11.044 25.917 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
    <path d="M 46.544 57.5 c 10.804 -10.527 21.608 -21.055 32.412 -31.582 c 2.016 -1.965 -1.073 -5.051 -3.088 -3.088 C 65.064 33.357 54.26 43.885 43.456 54.412 C 41.44 56.377 44.529 59.463 46.544 57.5 L 46.544 57.5 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
    <path d="M 78.837 64.952 c -7.189 -6.818 -14.379 -13.635 -21.568 -20.453 c -2.039 -1.933 -5.132 1.149 -3.088 3.088 c 7.189 6.818 14.379 13.635 21.568 20.453 C 77.788 69.973 80.881 66.89 78.837 64.952 L 78.837 64.952 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
    <path d="M 14.446 68.039 c 7.189 -6.818 14.379 -13.635 21.568 -20.453 c 2.043 -1.938 -1.048 -5.022 -3.088 -3.088 c -7.189 6.818 -14.379 13.635 -21.568 20.453 C 9.315 66.889 12.406 69.974 14.446 68.039 L 14.446 68.039 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
</g>
</svg>

                            <a class="footer-menu__item_email" href="mailto:bogodelovs@gmail.com">bogodelovs@gmail.com</a>
                        </li>
                        {{--                        <li class="menu-item">--}}
                        {{--                            <a href="#">donate</a>--}}
                        {{--                        </li>--}}
                    </ul>
                </div>

            </div>
            {{--            <div class="col-md-2">--}}

            {{--                <div class="footer-menu">--}}
            {{--                    <h5>Discover</h5>--}}
            {{--                    <ul class="menu-list">--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Home</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Books</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Authors</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Subjects</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Advanced Search</a>--}}
            {{--                        </li>--}}
            {{--                    </ul>--}}
            {{--                </div>--}}

            {{--            </div>--}}
            {{--            <div class="col-md-2">--}}

            {{--                <div class="footer-menu">--}}
            {{--                    <h5>My account</h5>--}}
            {{--                    <ul class="menu-list">--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Sign In</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">View Cart</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">My Wishtlist</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Track My Order</a>--}}
            {{--                        </li>--}}
            {{--                    </ul>--}}
            {{--                </div>--}}

            {{--            </div>--}}
            {{--            <div class="col-md-2">--}}

            {{--                <div class="footer-menu">--}}
            {{--                    <h5>Help</h5>--}}
            {{--                    <ul class="menu-list">--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Help center</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Report a problem</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Suggesting edits</a>--}}
            {{--                        </li>--}}
            {{--                        <li class="menu-item">--}}
            {{--                            <a href="#">Contact us</a>--}}
            {{--                        </li>--}}
            {{--                    </ul>--}}
            {{--                </div>--}}

            {{--            </div>--}}

        </div>
        <!-- / row -->

    </div>
</footer>

<div id="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="copyright">
                    <div class="row">

                        <div class="col-md-6">
                            <p>© {{ date("Y") }} All rights reserved. {{ env('APP_NAME')  }}</p>
                        </div>

                        {{--<div class="col-md-6">--}}
                        {{--    <div class="social-links align-right">--}}
                        {{--        <ul>--}}
                        {{--            <li>--}}
                        {{--                <a href="#"><i class="icon icon-facebook"></i></a>--}}
                        {{--            </li>--}}
                        {{--            <li>--}}
                        {{--                <a href="#"><i class="icon icon-twitter"></i></a>--}}
                        {{--            </li>--}}
                        {{--            <li>--}}
                        {{--                <a href="#"><i class="icon icon-youtube-play"></i></a>--}}
                        {{--            </li>--}}
                        {{--            <li>--}}
                        {{--                <a href="#"><i class="icon icon-behance-square"></i></a>--}}
                        {{--            </li>--}}
                        {{--        </ul>--}}
                        {{--    </div>--}}
                        {{--</div>--}}

                    </div>
                </div><!--grid-->

            </div><!--footer-bottom-content-->
        </div>
    </div>
</div>

@vite(['resources/js/app.js']);
<script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/modernizr.js') }}"></script>
@livewireScripts
@stack('scripts')
<script src="{{ asset('js/script.js') }}"></script>
<script src="//code.jivo.ru/widget/vbhOoVu4P2" async></script>

</body>
</html>
