@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-4 is-offset-4">
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="columns">
                    <div class="column">
                        <article class="message is-warning plan">
                            <div class="message-header fd-v">
                                <p>Daily</p>
                                <div class="flex">
                                    <sup class="is-size-5">$</sup>
                                    <span class="is-size-1">1.99</span>
                                </div>
                            </div>
                            <div class="message-body">
                                <div class="fc fd-v">
                                    <p class="is-size-6 has-text-grey has-text-weight-semibold">watch all videos</p>
                                    <p class="is-size-6 has-text-grey has-text-weight-semibold field">billed until cancel</p>
                                    <button class="button is-warning">choose</button>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="column">
                        <article class="message is-danger plan">
                            <div class="message-header fd-v">
                                <p>Monthly</p>
                                <div class="flex">
                                    <sup class="is-size-5">$</sup>
                                    <span class="is-size-1">25.00</span>
                                </div>
                            </div>
                            <div class="message-body">
                                <div class="fc fd-v">
                                    <p class="is-size-6 has-text-grey has-text-weight-semibold">watch all videos</p>
                                    <p class="is-size-6 has-text-grey has-text-weight-semibold field">billed until cancel</p>
                                    <button class="button is-danger">choose</button>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="field">
                    <label for="name">Username</label>

                    <div class="control">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    @if ($errors->has('name'))
                        <p class="help is-danger">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label for="email">E-Mail Address</label>

                    <div class="control">
                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required>
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label for="password">Password</label>

                    <div class="control">
                        <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>
                    </div>
                    @if ($errors->has('password'))
                        <p class="help is-danger">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label for="password-confirm">Confirm Password</label>

                    <div class="control">
                        <input id="password-confirm" name="password_confirmation" type="password" class="input" required>
                    </div>
                </div>
                <hr>
                <card></card>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary">
                            Join
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
