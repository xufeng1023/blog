@extends('layouts.app')

@section('title')
Error 404 -
@endsection

@section('content')
<div class="container">
      <div class="columns">
          <div class="column is-6 is-offset-3 has-text-centered">
          		<img src="{{ asset('images/logo3.png') }}" width="100" alt="dollyisland">
            	<h1 class="title">@lang('index.404')</h1>
            	<a href="/movies" class="button is-primary">@lang('index.movies')</a>
          </div>
      </div>
</div>
@endsection
