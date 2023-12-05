<div class="container px-12 py-8 mx-auto">
    <h3 class="text-2xl font-bold text-purple-700">В наличии</h3>
    <div class="h-1 bg-red-500 w-36"></div>
    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                <section style="background-color: #eee;">
                    <div class="container py-5">
                        @foreach ($products as $product)
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-12 col-xl-10">
                                <div class="card shadow-0 border rounded-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <a href="/product/{{ $product->slug  }}" class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">


                                                    <img src="{{ Storage::url($product->image) }}"
                                                            class="w-100" alt="мухомор сушёный"/>


                                                </a>

                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <h5>{{ $product->name }}</h5>
                                                <div class="d-flex flex-row">
                                                    <div class="text-danger mb-1 me-2">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <span>{{ $product->weight }} г.</span>
                                                </div>
                                                <p class=" mb-4 mb-md-0">
                                                    {{ $product->description }}
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                <div class="d-flex flex-row align-items-center mb-1">
                                                    <h4 class="mb-1 me-1">{{ $product->price }} руб.</h4>
                                                    {{--<span class="text-danger"><s>$20.99</s></span>--}}
                                                </div>
                                                <h6 class="text-success">урожай 2022</h6>
                                                <div class="d-flex flex-wrap align-items-center gap-3 mt-4">
                                                    <form wire:submit.prevent="addToCart({{ $product }})" action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" value="{{ $product->name }}" name="name">
                                                        <input type="hidden" value="{{ $product->price }}" name="price">
                                                        <input type="hidden" value="{{ $product->weight }}" name="weight">
                                                        <input type="hidden" value="{{ $product->image }}" name="image">
                                                        <input type="hidden" value="1" name="quantity">
                                                        <input type="submit" class="btn  btn-primary btn-sm" value="добавить в корзину">
                                                    </form>
                                                    <a href="/product/{{ $product->slug  }}" class="btn btn-outline-primary btn-sm">Подробнее</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>


    </div>
</div>
