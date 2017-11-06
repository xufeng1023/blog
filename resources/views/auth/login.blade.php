@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-4 is-offset-4">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="field">
                    <label for="email">@lang('index.email')</label>

                    <div class="control">
                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label for="password">@lang('index.password')</label>

                    <div class="control">
                        <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                <input type="checkbox" name="remember" class="is-hidden" checked>
                
                <div class="field">
                    <button type="submit" class="button is-primary is-fullwidth">
                        @lang('index.login')
                    </button>
                </div>

                <div class="has-text-centered">
                    <a class="button is-link" href="{{ route('password.request') }}">
                        @lang('index.forget password')?
                    </a>
                </div>
                <div class="has-text-centered">
                    <a class="button is-link" href="/join">@lang('index.new user')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
