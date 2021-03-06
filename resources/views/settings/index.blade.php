@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-3">
            @include('settings.sidebar')
        </div>
        <div class="column is-8 is-offset-1">
            <h1 class="title is-3">@lang('index.update account')</h1>
            
            @if(session()->has('success'))
                <notify msg="{{ session('success.msg') }}" color="{{ session('success.color') }}"></notify>
            @endif
            <form method="POST" action="/settings/account" autocomplete="off">
                {{ csrf_field() }}

                <div class="field">
                    <label for="email">@lang('index.email')</label>

                    <div class="control">
                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email')?: $auth->email }}" required>
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
                        <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password">
                    </div>
                    @if ($errors->has('password'))
                        <p class="help is-danger">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label for="password-confirm">@lang('index.password2')</label>

                    <div class="control">
                        <input id="password-confirm" type="password" class="input" name="password_confirmation">
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary">@lang('index.update')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
