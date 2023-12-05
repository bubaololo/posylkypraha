<div class="product-list" >
    <div class="row">
        @foreach ($products as $product)
            <a href="/product/{{ $product->slug }}" class="col-md-3 product__card">
                <figure class="product-style">
                    <div style="background-image: url('{{ Storage::url($product->image) }}');"   alt="купить мухомор" class="product-item"></div>
                    @csrf
                    <input type="hidden" value="{{ $product->name }}" name="name">
                    <input type="hidden" value="{{ $product->id }}" name="id">
                    <figcaption>
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->weight }} грамм</p>
                        <div class="item-price">{{ $product->price }}р.</div>
                    </figcaption>

                    <form wire:submit.prevent.defer="addToCart({{ $product }})" action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $product->name }}" name="name">
                        <input type="hidden" value="{{ $product->price }}" name="price">
                        <input type="hidden" value="{{ $product->weight }}" name="weight">
                        <input type="hidden" value="{{ Storage::url($product->image) }}" name="image">
                        <input type="hidden" value="1" name="quantity">
                        <button class="add-to-cart" data-product-tile="add-to-cart">в корзину</button>
                    </form>
                </figure>
            </a>
        @endforeach
    </div>

</div><!--grid-->
