@extends('layouts.app')

@section('content')
<div class="container is-fluid">
    <div class="columns">
        <div class="column is-3">
            @include('settings.sidebar')
        </div>
        <div class="column is-8 is-offset-1">
            <h1 class="title is-3">
                My Invoices 
            </h1>
            <invoices :user="{{ auth()->user() }}"></invoices>
        </div>
    </div>
</div>
@endsection
