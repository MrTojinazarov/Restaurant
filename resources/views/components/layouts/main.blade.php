<!DOCTYPE html>
<html lang="en">

<head>
    <title>Taste.it - Free</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="">Taste.<span>it</span></a>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-link.active"><a href="" class="nav-link">Home</a></li>
                    @foreach ($categories as $category)
                        <li><a href="" class="nav-link">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        {{ $slot }}

    </div>

    @livewireScripts
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
