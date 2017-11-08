<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api" content="{{ config('app.api') }}">
    <meta name="auth" content="{{ $auth }}">
    <title>@yield('title'){{ config('app.name', 'Laravel') }} - @lang('index.desc')</title>
    @yield('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <section id="app" class="hero is-black is-fullheight">
        @if($uri && $uri != '/')
            <div class="hero-head">
                <nav class="navbar is-dark">
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
                    <div id="navMenu" class="navbar-menu">
                        <div class="navbar-end">
                            <a class="navbar-item {{ $uri == 'movies'? 'is-active':'' }}" href="/movies">@lang('index.movies')</a>
                            @auth
                                <a class="navbar-item {{ starts_with($uri, 'settings')? 'is-active':'' }}" href="/settings">@lang('index.settings')</a>
                                <a class="navbar-item" href="/logout" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    @lang('index.logout')
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                @if($auth->is_admin)
                                    <a class="navbar-item" href="/admin">admin</a>
                                @endif
                            @else
                                <a class="navbar-item {{ $uri == 'login'? 'is-active':'' }}" href="/login">@lang('index.login')</a>
                                <div class="navbar-item">
                                    <a class="button is-warning is-fullwidth" href="/join">@lang('index.join')</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </nav>
            </div>
        @endif

        @yield('banner')
        
        <div class="hero-body">
            @yield('content')
        </div>
        
        @if($uri != '/')
            <footer class="hero-foot">
                <div class="section is-size-7 has-text-grey-dark">
                    <hr>
                    <P class="">@lang('index.Iswear')</P>
                    <p>© {{ date('Y') }} {{ config('app.name', 'DollyIsland') }}.</p>
                </div>
            </footer>
        @endif
    </section>

    @yield('script')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
