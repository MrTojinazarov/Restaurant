<!DOCTYPE html>
<html lang="en">

<head>
    <title>Taste.it - Free</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="">Taste.<span>it</span></a>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-link.active"><a href="{{route('order.home')}}" wire:navigate class="nav-link">Home</a></li>
                    @foreach ($categories as $category)
                        <li><a href="{{route('category.foods', $category->id)}}" wire:navigate class="nav-link">{{ $category->name }}</a></li>
                    @endforeach
                    <li class="nav-link.active">
                        <a class="badge text-bg-warning mt-2 ms-3" href="{{route('order.cart')}}" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5ZM3.14 5l.5 2H5V5ZM6 5v2h2V5Zm3 0v2h2V5Zm3 0v2h1.36l.5-2Zm1.11 3H12v2h.61ZM11 8H9v2h2ZM8 8H6v2h2ZM5 8H3.89l.5 2H5Zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                        </svg></a>
                    </li>                 
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        {{ $slot }}

    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
