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
        	</h1>
            @if($auth->subscribed('main'))
                @if($auth->subscription('main')->cancelled())
                    @if($auth->subscription('main')->onGracePeriod())
                        <h3 class="subtitle is-6 has-text-danger">
                            @lang('index.sub will end', ['date' => $auth->ends_at->format('Y-m-d')]) 
                        </h3>
                        <resume :user="{{ auth()->user() }}"></resume>
                        <div class="is-text-5">*@lang('index.resume desc')</div>
                    @endif
                @endif
            @else
                @if($auth->ends_at)
                    <h3 class="subtitle is-6 has-text-danger">
                        @lang('index.sub ended', ['date' => $auth->ends_at->format('Y-m-d')]) 
                    </h3>
                @endif
                <subscribe></subscribe>
            @endif
        </div>
    </div>
</div>
@endsection
