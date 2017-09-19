@extends('layouts.app')

@section('content')
	<div class="hero-body">
        <div class="container has-text-centered">
          	<h1 class="title">
                Title
          	</h1>
          	<h2 class="subtitle">
                Subtitle
          	</h2>
          	@if(Auth::check())
		        <pay :user="{{ auth()->user() }}"></pay>
		    @else
		        <a href="/login">login</a>
		    @endif
        </div>
    </div>
@endsection
