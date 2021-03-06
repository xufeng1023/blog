@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-centered">
        <div class="column is-narrow">
            <h1 class="title is-5 has-text-centered">@lang('index.welcome')</h1>
            <h2 class="subtitle is-5 has-text-centered">@lang('index.selectplan')</h2>
            <join inline-template>
                <form method="POST" autocomplete="off" @submit.prevent="onSubmit">
                    <notify :color="color"></notify>
                    <div class="columns is-mobile">
                        <div class="column">
                            <price color="is-primary" plan="ppv"></price>
                        </div>
                        <div class="column">
                            <price color="is-primary" plan="monthly"></price>
                        </div>
                    </div>
                    <div class="field">
                        <label for="email">@lang('index.email')</label>
                        <div class="control">
                            <input id="email" type="email" class="input" name="email" required>
                        </div>
                    </div>

                    <div class="field">
                        <label for="password">@lang('index.password')</label>
                        <div class="control">
                            <input id="password" type="password" class="input" name="password" required>
                        </div>
                    </div>

                    <div class="field">
                        <label for="password-confirm">@lang('index.password2')</label>
                        <div class="control">
                            <input id="password-confirm" name="password_confirmation" type="password" class="input" required>
                        </div>
                    </div>
                    <hr>
                    <div class="field">
                        <small class="has-text-grey">*@lang('index.cc safe desc')</small>
                    </div>
                    <div class="field">
                        <label v-html="subtotal"></label>
                    </div>
                    <card></card>
                    <div class="field">
                        <div class="control">
                            <submit text="{{ __('index.join') }}" class="is-fullwidth"></submit>
                        </div>
                    </div>
                </form>
            </join>
        </div>
    </div>
</div>
@endsection
