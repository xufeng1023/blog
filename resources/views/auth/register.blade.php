@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-centered">
        <div class="column is-narrow">
            <h1 class="title is-4 has-text-centered">@lang('index.selectplan')</h1>
            <join inline-template>
                <form method="POST" @submit.prevent="onSubmit">
                    <div class="notification is-danger" v-if="errors.plan" v-text="errors.plan"></div>
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
                            <input id="email" type="email" class="input" :class="{'is-danger': errors.email}" name="email" required>
                        </div>
                        <p class="help is-danger" v-if="errors.email" v-text="errors.email[0]"></p>
                    </div>

                    <div class="field">
                        <label for="password">@lang('index.password')</label>
                        <div class="control">
                            <input id="password" type="password" class="input" :class="{'is-danger': errors.password}" name="password" required>
                        </div>
                        <p class="help is-danger" v-if="errors.password" v-text="errors.password[0]"></p>
                    </div>

                    <div class="field">
                        <label for="password-confirm">@lang('index.password2')</label>
                        <div class="control">
                            <input id="password-confirm" name="password_confirmation" type="password" class="input" required>
                        </div>
                    </div>
                    <hr>
                    <div class="notification is-danger" v-if="errors.card" v-text="errors.card"></div>
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
