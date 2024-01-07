<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}" class="antialiased filament js-focus-visible">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta/>
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap" rel="stylesheet">

    @livewireStyles
    @filamentStyles
    @stack('styles')

    <link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}">

    <style>
        * {font-family: 'KoHo', 'Almarai', sans-serif;}
        [x-cloak] {display: none !important;}
    </style>
    <style>
        /*custom styles*/
        .main-logo {
            max-width: 40px;
            display: inline-block;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">

<header x-data="{ open: false }" class="bg-white dark:bg-black px-4">
    <div class="container mx-auto">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a class="italic flex gap-2 group" href="{{ url('/') }}">
                        <img class="main-logo" src="{{ asset('images/oolong_logo.svg') }}" alt="">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex sm:items-center">
                    {{--Navigation Links--}}
                </div>

            </div>
            <div class=" sm:flex sm:items-center sm:ml-6">
                {{--Account menu and other icons--}}
                {{--lang switcher--}}
                <div class="flex justify-center items-center">
                    <div class="relative inline-block text-left" id="language-dropdown">
                        <div>
                            <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="menu-button" aria-expanded="true" aria-haspopup="true" onclick="toggleDropdown()">
                                <span id="selected-lang"></span>
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="dropdown-menu">
                            <div class="py-1" role="none">
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" onclick="switchLang('en')">English</a>
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex=-1" onclick="switchLang('es')">Spanish</a>
                            </div>
                        </div>
                    </div>

                    <script>
                      var currentLang = "{{ app()->getLocale() }}"; // Замените на динамическое значение из Laravel, например,

                      document.addEventListener('DOMContentLoaded', function() {
                      updateLanguageText(currentLang);
                      });

                      function toggleDropdown() {
                        document.getElementById('dropdown-menu').classList.toggle('hidden');
                      }

                      function switchLang(lang) {
                        fetch('/switchLang/' + lang)
                            .then(response => {
                              if (response.ok) {
                                updateLanguageText(lang);
                                window.location.reload();
                              }
                            })
                            .catch(error => console.error('Error:', error));
                      }

                      function updateLanguageText(lang) {
                        let languageText = lang === 'en' ? 'English' : 'Spanish';
                        document.getElementById('selected-lang').innerText = languageText;
                      }
                    </script>
                </div>
                {{--lang switcher--}}

                {{--theme switcher--}}

                {{--<div class="flex justify-center items-center">--}}
                {{--    <div class="relative inline-block text-left" id="theme-dropdown">--}}
                {{--        <div>--}}
                {{--            <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="theme-button" aria-expanded="true" aria-haspopup="true" onclick="toggleThemeDropdown()">--}}
                {{--                <span id="selected-theme">Theme</span>--}}
                {{--                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
                {{--                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>--}}
                {{--                </svg>--}}
                {{--            </button>--}}
                {{--        </div>--}}

                {{--        <div class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="theme-button" tabindex="-1" id="theme-dropdown-menu">--}}
                {{--            <div class="py-1" role="none">--}}
                {{--                <a href="#" class="text-gray-700 block px-4 py-2 text-sm" onclick="switchTheme('light')">Light</a>--}}
                {{--                <a href="#" class="text-gray-700 block px-4 py-2 text-sm" onclick="switchTheme('dark')">Dark</a>--}}
                {{--            </div>--}}
                {{--        </div>--}}
                {{--    </div>--}}
                {{--</div>--}}


                <script>
                  function toggleThemeDropdown() {
                    document.getElementById('theme-dropdown-menu').classList.toggle('hidden');
                  }

                  function switchTheme(theme) {
                    if (theme === 'dark') {
                      document.documentElement.classList.add('dark');
                    } else {
                      document.documentElement.classList.remove('dark');
                    }
                    // Закрыть выпадающее меню после выбора
                    document.getElementById('theme-dropdown-menu').classList.add('hidden');
                  }
                </script>

                {{--theme switcher--}}

            </div>
        </div>
</header>

<header class="bg-gray-100 dark:bg-gray-800">
    <div class="container mx-auto py-2 px-3">
        <div class="flex justify-between items-center">
            <div class="w-full">
                @if(isset($breadcrumbs))
                        <nav class="text-gray-400 font-bold my-1" aria-label="Breadcrumb">
                            <ol class="list-none p-0 inline-flex">
                                {{ $breadcrumbs }}
                            </ol>
                        </nav>
                    @endif
                    @if(isset($header))
                        <div class="italic font-semibold text-xl text-gray-600 dark:text-gray-100">
                            {{ $header }}
                        </div>
                    @endif
                </div>
                <span class="bolt-loading animate-pulse"></span>
            </div>
        </div>
    </header>

<div class="container mx-auto my-6">
    {{ $slot }}
</div>

<footer class="bg-gray-100 dark:bg-gray-800 p-6 text-center font-light">
Oloong.me
</footer>

@stack('scripts')
@livewireScripts
@filamentScripts
@livewire('notifications')

{{--<script>--}}
{{--    const theme = localStorage.getItem('theme')--}}

{{--    if ((theme === 'dark') || (! theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {--}}
{{--        document.documentElement.classList.add('dark')--}}
{{--    }--}}
{{--</script>--}}

</body>
</html>
