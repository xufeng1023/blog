@extends('layouts.app')

@section('content')
<div class="container is-fluid">
    <div class="columns">
        <div class="column is-3">
            @include('settings.sidebar')
        </div>
        <div class="column is-8 is-offset-1">
            <h1 class="title is-3 is-spaced">@lang('index.cancel sub')</h1>
            <h3 class="subtitle is-6">@lang('index.cancel desc')</h3>
            <cancel></cancel>
        </div>
    </div>
</div>
@endsection
