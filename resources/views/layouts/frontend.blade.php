<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Learn by Repeat</title>

    <!-- Base CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Page CSSes -->
    @yield('styles')

    <script src="https://kit.fontawesome.com/58c0a2f6e5.js" crossorigin="anonymous"></script>
</head>

<body>

<header>
    <div class="navbar navbar-expand-md navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
                <i class="fas fa-graduation-cap mr-1"></i> <strong>Learn by Repeat</strong>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse w-100 flex-md-column" id="navbarCollapse">
                <ul class="navbar-nav ml-auto small mb-2 mb-md-0">
                    <li class="nav-item {{ Route::is('home') ? 'active':'' }}">
                        <a class="nav-link py-1" href="{{ route('home') }}">Dashboard</a>
                    </li>
                    <li class="nav-item {{ Route::is('decks') ? 'active':'' }}">
                        <a class="nav-link py-1" href="{{ route('decks') }}">Decks</a>
                    </li>
                    <li class="nav-item {{ Route::is('decks::createForm') ? 'active':'' }}">
                        <a class="nav-link py-1" href="{{ route('decks::createForm') }}">Create Deck</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<main role="main">
    <div class="py-5 bg-light">
        <div class="@yield('container', 'container')">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    <div class="js-modal-block"></div>
</main>

<footer class="text-muted">
    <div class="container"></div>
</footer>

<!-- Base JS -->
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<!-- Page JSes -->
@yield('scripts')
</body>
</html>
