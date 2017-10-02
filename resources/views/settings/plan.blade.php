@extends('layouts.app')

@section('content')
<div class="container is-fluid">
    <div class="columns">
        <div class="column is-3">
            @include('settings.sidebar')
        </div>
        <div class="column is-8 is-offset-1">
            <h1 class="title is-3">
            	Change Plan
            	<span class="tag is-rounded is-primary">{{ auth()->user()->plan }}</span>
        	</h1>
            <change-plan :user="{{ auth()->user() }}"></change-plan>
        </div>
    </div>
</div>
@endsection
