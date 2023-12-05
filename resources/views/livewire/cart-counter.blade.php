@if ($cart_count == 0)
    <span class="cart__text" >пусто</span>
@elseif ($cart_count == 1)
    <span> <strong class="cart-accent">{{ $cart_count }}</strong> <span class="cart__text"> товар</span></span>
@elseif  ($cart_count > 1 && $cart_count < 5)
    <span><strong class="cart-accent" >{{ $cart_count }}</strong> <span class="cart__text"> товара</span></span>
@else
    <span><strong class="cart-accent" >{{ $cart_count }}</strong><span class="cart__text"> товаров</span></span>
@endif



