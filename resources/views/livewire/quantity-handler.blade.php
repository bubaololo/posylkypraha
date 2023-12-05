<div>
{{--    <form action="{{ route('cart.update') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <input type="hidden" name="id"--}}
{{--               value="{{ $item->id}}">--}}
{{--        <input type="text" name="quantity"--}}
{{--               value="{{ $item->quantity }}"--}}
{{--               class="w-16 text-center h-6 text-gray-800 outline-none rounded border border-blue-600"/>--}}
{{--        <button--}}
{{--            class="px-4 mt-1 py-1.5 text-sm rounded rounded shadow text-violet-100 bg-violet-500">--}}
{{--            Обновить--}}
{{--        </button>--}}
{{--    </form>--}}
<!-- Quantity -->
    <div class="d-flex cart-item__quantity"  type="text">
        <form wire:submit.prevent="decrement()" class="qty-btn">
            @csrf
            <button class="btn btn-light px-3 ">
                -
            </button>
        </form>
        <div class="form-outline" >
            <div id="form1">{{ $quantity }}</div>
            <label class="form-label mb-0"  for="form1">шт.</label>
        </div>

        <form wire:submit.prevent="increment()" class="qty-btn">
            @csrf
            <button class="btn btn-light px-3 me-2 ">
                +
            </button>
        </form>
    </div>
    <!-- Quantity -->
</div>
