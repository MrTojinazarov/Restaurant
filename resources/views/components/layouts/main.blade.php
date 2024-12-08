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
