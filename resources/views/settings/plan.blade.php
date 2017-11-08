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
                @if(!$auth->plan)
                <span class="tag is-rounded is-info">@lang('index.ppv member')</span>
                @endif
        	</h1>
            <h3 class="subtitle is-6">@lang('index.not subscribed')</h3>
            @if($auth->subscribed('main'))
                @if($auth->subscription('main')->cancelled())
                    @if($auth->subscription('main')->onGracePeriod())
                        <h3 class="subtitle is-6 has-text-danger">
                            @lang('index.sub will end', ['date' => $auth->ends_at]) 
                        </h3>
                        <resume :user="{{ auth()->user() }}"></resume>
                        <div class="is-text-5">*@lang('index.resume desc')</div>
                    @endif
                @endif
            @else
                @if($auth->ends_at)
                    <h3 class="subtitle is-6 has-text-danger">
                        @lang('index.sub ended', ['date' => $auth->ends_at]) 
                    </h3>
                @endif
                <subscribe></subscribe>
            @endif
            <br>
            <div class="is-text-5">
                <strong class="has-text-grey-light">*@lang('index.monthly member')</strong>
                <p class="has-text-grey">@lang('index.monthly desc')</p>
            </div>
            <br>
            <div class="is-text-5">
                <strong class="has-text-grey-light">*@lang('index.ppv member')</strong>
                <p class="has-text-grey">@lang('index.ppv desc')</p>
            </div>
        </div>
    </div>
</div>
@endsection
