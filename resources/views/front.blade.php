@extends('layouts.app')

@section('content')
<div class="container">
      <div class="columns">
          <div class="column is-6 is-offset-3 has-text-centered">
            	<h1 class="title">
                  <img src="{{ asset('images/logo3.png') }}" width="100" alt="dollyisland">
            	</h1>
            	<h2 class="subtitle">@lang('index.mustbe18')</h2>
              <div>
                  <a href="/movies" class="button is-primary">@lang('index.Im18')</a>
              </div>
          </div>
      </div>
</div>
@endsection
