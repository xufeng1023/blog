@extends('layouts.app')

@section('banner')
<div>
    <a href="/join">
        <img src="{{ asset('images/Banner3.jpg') }}" width="100%" alt="Join DollyIsland">
    </a>
</div>
@endsection

@section('content')
<div class="container">
    @foreach($posts->chunk(3) as $chunks)
        <div class="columns">
            @foreach($chunks as $post)
                @if($post->thumbnail)
                    <div class="column is-4">
                        <a href="/movie/{{ $post->slug }}">
                            <figure class="image is-16by9">
                                <img src="{{ asset('/storage/'.$post->thumbnail) }}">
                                @if($post->preview)
                                    <span class="tag preview is-success">@lang('index.preview')</span>
                                @endif
                            </figure>
                            <p>{{ $post->title }}</p>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach

    {{ $posts->links('vendor.pagination.bulma') }}
</div>
@endsection
