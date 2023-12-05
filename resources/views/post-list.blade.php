@extends('layouts.app')
@section('title', 'Статьи о мухоморе')
@section('meta_description', 'Информация о свойствах мухомора и способах его употребления')
@section('content')


    <section class="hero-section jarallax">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Статьи</h1>
                    <div class="breadcrumbs">
                        <span class="item"><a href="{{ route('index') }}">Главная /</a></span>
                        <span class="item">Статьи</span>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="latest-blog" class="scrollspy-section padding-large">
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    <!-- post grid -->
                    <div class="post-grid">
                        <div class="row">
                            @foreach($posts as $post)

                            <div class="col-md-4">

                                <article class="post-item">

                                    @if ( $post['post']->featured_image )
                                    <figure>
                                        <a href="{{ $post['url']  }}" class="image-hvr-effect">
                                            <img src="{{ $post['imagePath'] }}" alt="{{ $post['post']->title }}" class="post-image">
                                        </a>
                                    </figure>
                                    @endif
                                    <div class="post-content">
                                        {{--<div class="meta-date">Mar 30, 2021</div>--}}
                                        <h3 class="post-title"><a href="{{ $post['url']  }}">{{ $post['post']->title }}</a></h3>
                                        <p>{{ $post['post']->description }}</p>
                                    </div>
                                </article>

                            </div>

                            @endforeach
                        </div>
                    </div>
                    <!-- / post grid -->

                </div>

            </div>



        </div>
    </section>
@endsection
