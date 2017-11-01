@extends('layouts.app')

@section('content')
<div class="container is-fluid">
    <div class="columns">
        <div class="column is-3">
            @include('settings.sidebar')
        </div>
        <div class="column is-8 is-offset-1">
            <h1 class="title is-3">
                <span>@lang('index.update cc')</span>
                <span class="tag is-rounded is-info">{{ auth()->user()->card_last_four }}</span>
            </h1>
            <h3 class="subtitle is-6">@lang('index.cc safe desc')</h3>
            <update-card :user="{{ auth()->user() }}"></update-card>
        </div>
    </div>
</div>
@endsection
