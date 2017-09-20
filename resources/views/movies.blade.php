@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @foreach($posts->chunk(4) as $chunks)
                <div class="row">
                    @foreach($chunks as $post)
                        @if($post->images->first())
                            <div class="col-sm-3">
                                <a href="/movie/{{ $post->slug }}">
                                    <img src="{{ asset('/storage/'.$post->images->first()->slug) }}" width="100%">
                                    {{ $post->title }}
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
