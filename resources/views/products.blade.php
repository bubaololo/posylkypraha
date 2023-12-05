@extends('layouts.app')
@section('title', 'Сушёные мухоморы с доствкой по всему миру')
@section('meta_description', 'Мухомор сушёный в вакуумной упаковке')
@section('content')
@livewire('products-table')

@include('mobile-cart')
@endsection

