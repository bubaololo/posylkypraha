<div>
    <div>
        <label for="name">Способ доставки</label>
        <fieldset>

            {{--<legend>Выберите один из доступных способов доставки:</legend>--}}
            <div class="delivery__type">
                <div class="delivery-selector" >
                    <input type="radio" class="btn-check" name="deliveryType" wire:model="deliveryType" id="sdek" value="sdek"
                    >
                    <label class="btn btn-outline-success" for="sdek">Сдэк <br>
                        <small>до двери</small>
                        </label>
                    @if($cdekCalculatedDeliveryCost == 'fail')
                        <small  class="text-muted delivery-selector__notify" data-bs-toggle="tooltip" title="Не удалось найти информацию о цене доставки для вашего адреса,
                    указана средняя цена для доставки по России, если реальная стоимость доставки будет существенно превышать эту сумму - мы свяжемся с вами">примерная цена: 800р</small>
                    @elseif(($cdekCalculatedDeliveryCost !== null))
                        <small class="text-muted delivery-selector__notify">цена доставки в ваш город: {{ $cdekCalculatedDeliveryCost }} р.</small>
                    @endif

                </div>

                <div class="delivery-selector" >
                    <input type="radio" class="btn-check" name="deliveryType" wire:model="deliveryType" id="post" value="post">
                    <label class="btn btn-outline-success" for="post">Почта <br>
                        <small>обычная посылка</small>
                    </label>
                    @if($postCalculatedDeliveryCost == 'fail')
                        <small class="text-muted delivery-selector__notify" data-bs-toggle="tooltip" title="Не удалось найти информацию о цене доставки для вашего адреса,
                        указана средняя цена для доставки по России, если реальная стоимость доставки будет существенно превышать эту сумму - мы свяжемся с вами">примерная цена: 350р</small>
                    @elseif(($postCalculatedDeliveryCost !== null))
                        <small class="text-muted delivery-selector__notify">цена доставки в ваш город: {{ $postCalculatedDeliveryCost }} р.</small>
                    @endif
                </div>
            </div>
        </fieldset>
    </div>
</div>
