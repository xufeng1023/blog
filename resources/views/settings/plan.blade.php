@extends('layouts.app')

@section('content')
<div class="container is-fluid">
    <div class="columns">
        <div class="column is-3">
            @include('settings.sidebar')
        </div>
        <div class="column is-8 is-offset-1">
            <h1 class="title is-3">
            	<span>@lang('index.subscription')</span>
            	<span class="tag is-rounded is-info">{{ auth()->user()->plan }}</span>
        	</h1>
            @if(auth()->user()->subscription('main')->cancelled())
                @if(auth()->user()->subscription('main')->onGracePeriod())
                    <h3 class="subtitle is-5 has-text-danger">
                        @lang('index.sub will end', ['date' => auth()->user()->ends_at->format('Y-m-d')]) 
                    </h3>
                    <resume :user="{{ auth()->user() }}"></resume>
                @else
                    <h3 class="subtitle is-5 has-text-danger">
                        @lang('index.sub ended', ['date' => auth()->user()->ends_at->format('Y-m-d')])
                    </h3>
                    <subscribe :user="{{ auth()->user() }}"></subscribe>
                @endif
            @else
                <change-plan :user="{{ auth()->user() }}"></change-plan>
            @endif
            
        </div>
    </div>
</div>
@endsection
