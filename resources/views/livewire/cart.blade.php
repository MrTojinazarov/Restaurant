<div class="row mt-4">
    <p style="font-size: 21px;">
        Savatda <span>{{ count($cart) }} ta mahsulot bor</span>
    </p>

    <div class="col-7 product-list ms-2">
        @foreach ($cart as $index => $food)
            <div class="row mb-3">
                <div class="product-item d-flex align-items-center">
                    <div class="col-2">
                        <img src="{{ asset('storage/' . $food['img']) }}" width="100px" alt="{{ $food['name'] }}">
                    </div>

                    <div class="col-3">
                        <h6>{{ $food['name'] }}</h6>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-outline-secondary btn-sm" wire:click="decrement({{ $index }})">−</button>
                        <span class="mx-2">{{ $food['quantity'] }}</span>
                        <button class="btn btn-outline-secondary btn-sm" wire:click="increment({{ $index }})">+</button>
                    </div>

                    <div class="col-2">
                        <p>{{ $food['price'] * $food['quantity'] }} so'm</p>
                    </div>

                    <div class="col-2">
                        <button class="btn btn-danger btn-sm" wire:click="removeProduct({{ $index }})">Yo'q qilish</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="col-4 ms-5">
        <div class="order-summary p-3 border rounded">
            <h4>Buyurtmangiz</h4>
            <p>Mahsulotlar ({{ count($cart) }}): 
                <span>{{ $this->getTotalPrice() }} so'm</span>
            </p>
            <p>Jami: <span>{{ $this->getTotalPrice() }} so'm</span></p>
            <a class="btn btn-danger mt-3" wire:navigate wire:click="canselOrder">O'chirish</a>
            <button class="btn btn-warning mt-3" wire:click="checkout">Buyurtma berish</button>
        </div>
    </div>
</div>
