@extends('layouts.app')

@section('content')
<div class="container">
      <div class="columns">
          <div class="column is-6 is-offset-3 has-text-centered">
            	<h1 class="title">
                  <img src="{{ asset('images/logo3.png') }}" width="100" alt="dollyisland">
            	</h1>
            	<h2 class="subtitle">
                  You have reached an adult only area. If you are under 18 or age of legal majority in the jurisdiction in which you reside or access this website, whichever is older, you must leave immediately.
            	</h2>
              <div>
                  <a href="/movies" class="button is-primary">I'm older than 18.</a>
              </div>
          </div>
      </div>
</div>
@endsection
