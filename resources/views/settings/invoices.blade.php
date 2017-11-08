@extends('layouts.app')

@section('content')
<div class="container is-fluid">
    <div class="columns">
        <div class="column is-3">
            @include('settings.sidebar')
        </div>
        <div class="column is-8 is-offset-1">
            <h1 class="title is-3">@lang('index.invoices')</h1>
            @if($auth->subscribed('main'))
	        	@if($auth->ends_at)
	            	<h3 class="subtitle is-6 has-text-danger">
	                	@lang('index.sub will end', ['date' => $auth->ends_at]) 
	                </h3>
	        	@else
	            	<h3 class="subtitle is-6">
	            		@lang('index.next bill', ['date' => $auth->next_bill_at]) 
	            	</h3>
	            @endif
            @else
            	@if($auth->ends_at)
            		<h3 class="subtitle is-6 has-text-danger">
	                	@lang('index.sub ended', ['date' => $auth->ends_at]) 
	                </h3>
            	@endif
            @endif
            <invoices></invoices>
        </div>
    </div>
</div>
@endsection
