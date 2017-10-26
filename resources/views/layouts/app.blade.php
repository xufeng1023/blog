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
                    @if (Route::has('login'))
                    <div id="navMenu" class="navbar-menu">
                        <div class="navbar-end">
                            <a class="navbar-item" href="/movies">Movies</a>
                            @auth
                                <a class="navbar-item" href="/settings">settings</a>
                                <a class="navbar-item" href="/logout" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                @if(auth()->user()->is_admin)
                                    <a class="navbar-item" href="/admin">admin</a>
                                @endif
                            @else
                                <login inline-template>
                                    <a class="navbar-item" href="/login" @click.prevent="open">login</a>

        <div class="modal" :class="{'is-active': isActive}">
            <div class="modal-background" @click="isActive = false"></div>
            <div class="modal-card">
                <section class="modal-card-body">
                    <form method="POST" action="/login" @submit.prevent="onSubmit" ref="form">
                        <div class="field">
                            <label for="email" class="has-text-black">E-Mail Address</label>
                            <div class="control">
                                <input id="email" type="email" class="input" :class="{'is-danger': errors.email}" name="email" value="" required autofocus>
                            </div>
                            <p class="help is-danger" v-if="errors.email" v-text="errors.email[0]">
                                
                            </p>
                        </div>

                        <div class="field">
                            <label for="password" class="has-text-black">Password</label>
                            <div class="control">
                                <input id="password" type="password" class="input" :class="{'is-danger': errors.email}" name="password" required>
                            </div>
                            <p class="help is-danger" v-if="errors.email" v-text="errors.email[0]">
                                
                            </p>
                        </div>

                        <div class="field">
                            <div class="control">
                                <label class="checkbox has-text-black">
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    Login
                                </button>

                                <a class="button is-link has-text-black" href="/password/reset">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
                                </login>

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
