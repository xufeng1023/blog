@extends('layouts.app')

@section('content')
<div class="container is-fluid">
    <div class="columns">
        <div class="column is-3">
            @include('settings.sidebar')
        </div>
        <div class="column is-8 is-offset-1">
            <h1 class="title is-3">
                Update Your Credit Card 
                <span class="tag is-rounded is-primary">{{ auth()->user()->card_last_four }}</span>
            </h1>
            <h3 class="subtitle is-6">Don't worry. Your card information will never directly touch our servers.</h3>
            <update-card :user="{{ auth()->user() }}"></update-card>
        </div>
    </div>
</div>
@endsection
