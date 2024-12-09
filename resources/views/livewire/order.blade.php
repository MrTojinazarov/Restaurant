<div class="row mt-3">
    @foreach ($foods as $food)
        <div class="col-3">
            <div class="card custom-card">
                <div class="card-image">
                    <img src="{{ asset('storage/' . $food->img) }}" alt="Dish Image" width="160px;" height="160px;" style="border-radius: 50%; margin-top:5px;">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $food->name }}</h5>
                    <p class="card-text">Narxi: {{ $food->price }}</p>
                    <div class="quantity-controls" wire:listen="cartUpdated">    
                        <button class="btn btn-{{ in_array($food->id, array_column(Session::get('cart', []), 'id')) ? 'danger' : 'primary' }}" wire:click="addToCart({{ $food->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4 mb-1" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5ZM3.14 5l.5 2H5V5ZM6 5v2h2V5Zm3 0v2h2V5Zm3 0v2h1.36l.5-2Zm1.11 3H12v2h.61ZM11 8H9v2h2ZM8 8H6v2h2ZM5 8H3.89l.5 2H5Zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div> 
