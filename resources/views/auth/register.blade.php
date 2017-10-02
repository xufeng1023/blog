@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-4 is-offset-4">
            <join inline-template>
                <form method="POST" @submit.prevent="onSubmit">
                    <div class="columns">
                        <div class="column">
                            <price price="1.99" color="is-warning" plan="Daily"></price>
                        </div>
                        <div class="column">
                            <price price="25.00" color="is-danger" plan="Monthly"></price>
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
            </join>
        </div>
    </div>
</div>
@endsection
