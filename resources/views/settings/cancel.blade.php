@extends('layouts.app')

@section('content')
<div class="container is-fluid">
    <div class="columns">
        <div class="column is-3">
            @include('settings.sidebar')
        </div>
        <div class="column is-8 is-offset-1">
            <h1 class="title is-3">Cancel Subscription</h1>
            <h3 class="subtitle is-6">Taking a break? All right but don't forget to come back and check out new videos. There's new uploads every day.</h3>
            <cancel :user="{{ auth()->user() }}"></cancel>
        </div>
    </div>
</div>
@endsection
