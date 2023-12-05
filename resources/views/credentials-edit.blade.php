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
                                    <li class="breadcrumb-item active" aria-current="page">Данные для доставки</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 ">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Данные для доставки</h4>
                                        </div>
                                        <form enctype="multipart/form-data" method="POST" id="profile-credentials"
                                                action="/credentials/1">
                                            @method('PATCH')
                                            @csrf
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label class="labels">Имя </label><input type="text" required name="name" class="form-control" placeholder="Иван" value="{{ $credentials['name'] }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Фамилия</label><input type="text" required name="surname" class="form-control" value="{{ $credentials['surname'] }}" placeholder="Иванов">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Отчество</label><input type="text" required name="middle_name" class="form-control" value="{{ $credentials['middle_name'] }}" placeholder="Иванович">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Телефон</label><input type="text" name="tel" class="form-control" value="{{ $credentials['tel'] }}" placeholder="890000000">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Whatsapp</label><input type="text" name="whatsapp" class="form-control" value="{{ $credentials['whatsapp'] }}" placeholder="890000000">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="labels">Telegram</label><input type="text" name="telegram" class="form-control" value="{{ $credentials['telegram'] }}" placeholder="@username">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label class="labels">Город, улица, дом</label><input type="text" name="address" required class="form-control" placeholder="Москва, ул. Пушкина, д. Колотушкина" value="{{ $credentials['address'] }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="labels">Квартира</label><input type="text" name="apartment" class="form-control" placeholder="22" value="{{ $credentials['apartment'] }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="labels">Комментарий к адресу</label><input type="text" name="comment" class="form-control" placeholder="любые уточнения" value="{{ $credentials['comment'] }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="labels">Индекс</label><input type="text" name="index" class="form-control" placeholder="000000" value="{{ $credentials['index'] }}">
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
                                            <div class="mt-5 text-center">
                                                <a class="btn btn-secondary profile-button" href="{{ route('profile')  }}" >Отмена</a>
                                                <input class="btn btn-primary profile-button" type="submit" value="Сохранить">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{--<div class="col-md-4">--}}
                                {{--    <div class="p-3 py-5">--}}
                                {{--        <div class="d-flex justify-content-between align-items-center experience">--}}
                                {{--            <span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span>--}}
                                {{--        </div>--}}
                                {{--        <br>--}}
                                {{--        <div class="col-md-12">--}}
                                {{--            <label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value="">--}}
                                {{--        </div>--}}
                                {{--        <br>--}}
                                {{--        <div class="col-md-12">--}}
                                {{--            <label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value="">--}}
                                {{--        </div>--}}
                                {{--    </div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </section>

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

            </div>
        </div>

@endsection
