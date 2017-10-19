<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ env('API_TOKEN') }}">
    <meta name="api" content="{{ env('API') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @yield('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <section id="app" class="hero is-black is-fullheight">
        @if($uri != '/')
            <div class="hero-head">
                <nav class="navbar is-black">
                    <div class="navbar-brand">
                        <a class="navbar-item" href="/">
                            <img src="{{ asset('images/logo3.png') }}" width="100" alt="dollyisland">
                        </a>
                        <div class="navbar-burger burger" data-target="navMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    @if (Route::has('login'))
                    <div id="navMenu" class="navbar-menu">
                        <div class="navbar-end">
                            <div class="navbar-item">
                                <a href="/movies">Movies</a>
                            </div>
                            @auth
                            <div class="navbar-item has-dropdown is-hoverable">
                                <a class="navbar-link" href="javascript:;">
                                  {{ Auth::user()->name }}
                                </a>
                                <div class="navbar-dropdown">
                                    @if(auth()->user()->is_admin)
                                        <a class="navbar-item" href="/admin">
                                            admin
                                        </a>
                                        <hr class="navbar-divider">
                                    @endif
                                    <a class="navbar-item" href="/settings">
                                        settings
                                    </a>
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
                                        <a class="button is-warning" href="/join">Join</a>
                                    </p>
                                    <p class="control">
                                        <login></login>
                                    </p>
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
                    @endif
                </nav>
            </div>
        @endif
        
        @yield('content')
        
        <div class="hero-foot">

        </div>
    </section>

    @yield('script')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
