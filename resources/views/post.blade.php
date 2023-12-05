@extends('layouts.app')

@section('content')
@section('title',  $post->title )
@section('meta_description', $post->description)
<!-- Styles -->
<style>


    h1 {
        font-size: 48px;
    }

    blockquote {
        font-style: italic;
    }

    .hero img {
        width: 50%;
    }

    .wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px 3%;
        background-color: #fff;
    }

</style>
<section class="hero-section jarallax">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">Статьи</h1>
                <div class="breadcrumbs">
                    <span class="item"><a href="{{ route('index') }}">Главная /</a></span>
                    <span class="item"><a href="{{ route('posts.list') }}">Статьи /</a></span>
                    <span class="item">{{ $post->title }}</span>
                </div>
            </div>
        </div>
    </div>

</section>

<div class="wrapper">
    <div class="hero">
        @if ( $post->featured_image )
            <img src="{{ $imagePath }}" alt="{{ $post->title }}">
        @endif
    </div>
    <h1>{{ $post->title }}</h1>
    <div class="content">
        {!! $post->content !!}
    </div>
</div>
</section>
@endsection
