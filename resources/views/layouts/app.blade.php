<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ env('API_TOKEN') }}">
    <meta name="api" content="{{ env('API') }}">
    <title>{{ config('app.name', 'Laravel') }}-provide adult content</title>
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
                                <div class="navbar-item">
                                    <a href="/settings">settings</a>
                                </div>
                                <div class="navbar-item">
                                    <a href="/logout" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                                @if(auth()->user()->is_admin)
                                    <div class="navbar-item">
                                        <a href="/admin">admin</a>
                                    </div>
                                @endif
                            @else
                                <login></login>

                                <div class="navbar-item">
                                    <a class="button is-warning is-fullwidth" href="/join">Join</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                    @endif
                </nav>
            </div>
        @endif
        
        @yield('content')
        
        @if($uri != '/')
            <footer class="hero-foot">
                <div class="section is-size-7 has-text-grey">
                    <hr>
                    <P class="">By entering this site you swear that you are of legal age in your area to view adult material and that you wish to view such material.</P>
                    <p>© {{ date('Y') }} {{ config('app.name', 'DollyIsland') }}.</p>
                </div>
            </footer>
        @endif
    </section>

    @yield('script')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
