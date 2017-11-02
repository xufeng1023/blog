@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-4 is-offset-4">
            <notify msg="{{ session('status') }}" color="is-success"></notify>

            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="field">
                    <label for="email" class="has-text-white">@lang('index.email')</label>

                    <div class="control">
                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <p class="help is-danger">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <label for="password" class="has-text-white">@lang('index.password')</label>

                    <div class="control">
                        <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <p class="help is-danger">@lang('index.pass wrong')</p>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <label for="password-confirm" class="has-text-white">@lang('index.password2')</label>
                    <div class="control">
                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary">@lang('index.reset pass')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
