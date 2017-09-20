<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.2/css/bulma.min.css">
    @yield('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <section id="app" class="hero is-black is-fullheight">
        <div class="hero-head">
            <nav class="navbar is-black">
                <div class="navbar-brand">
                    <a class="navbar-item" href="http://bulma.io">
                        <img src="http://bulma.io/images/bulma-logo-white.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
                    </a>
                    <div class="navbar-burger burger" data-target="navMenuColorblack-example">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                @if (Route::has('login'))
                <div id="navMenuColorblack-example" class="navbar-menu">
                    <div class="navbar-end">
                        @auth
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="#">
                              {{ Auth::user()->name }}
                            </a>
                            <div class="navbar-dropdown">
                                @if(auth()->user()->is_admin)
                                    <a class="navbar-item" href="/admin">
                                        admin
                                    </a>
                                    <hr class="navbar-divider">
                                @endif
                                <a class="navbar-item" href="/logout" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="navbar-item">
                            <div class="field is-grouped">
                                <p class="control">
                                    <a class="button is-primary" href="/login">
                                        login
                                    </a>
                                </p>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
                @endif
            </nav>
        </div>

        @yield('content')

        <div class="hero-foot">

        </div>
    </section>

    @yield('script')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
