@extends('layouts.app')
@section('title', $product->name)
@section('meta_description', $product->name. " c быстрой доставкой по России и миру, ценa: ".$product->price." рублей" )
@section('content')
    <section class="bg-sand padding-large">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <a href="#" class="product-image"><img src="{{ asset(Storage::url($product->image)) }}"></a>
                </div>

                <div class="col-md-6 pl-5">
                    <div class="product-detail">
                        <h1>{{ $product->name }}</h1>
                        <p>Вес: {{ $product->weight }}</p>
                        <span class="price colored">{{ $product->price }} р.</span>

                        <p>
                            {{ $product->description }}
                        </p>


                        <!-- <button type="submit" name="add-to-cart" value="27545" class="button">Add to cart</button> -->

                                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="id">
                                        <input type="hidden" value="{{ $product->name }}" name="name">
                                        <input type="hidden" value="{{ $product->weight }}" name="weight">
                                        <input type="hidden" value="{{ $product->price }}" name="price">
                                        <input type="hidden" value="{{ $product->image }}"  name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        <button class="btn-accent-arrow gradient" data-product-tile="add-to-cart">купить</button>
                                    </form>


                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('mobile-cart')
@endsection
