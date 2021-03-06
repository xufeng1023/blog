@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-4 is-offset-4">
            <notify msg="{{ session('status') }}" color="is-success"></notify>
            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="field">
                    <label for="email" class="has-text-white">@lang('index.email')</label>

                    <div class="control">
                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <p class="help is-danger">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary">@lang('index.send pass link')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
