@extends('layouts.app')

@section('content')
<div class="container">
    <div class="has-text-centered section">
        <p class="title is-1">Title 1</p>
        <p class="subtitle is-3">Subtitle 3</p>
    </div>
    @foreach($posts->chunk(4) as $chunks)
        <div class="columns">
            <div class="column is-2"></div>
            @foreach($chunks as $post)
                @if($post->images->first())
                    <div class="column is-2">
                        <a href="/movie/{{ $post->slug }}">
                            <figure class="image is-1by1">
                                <img src="{{ asset('/storage/'.$post->images->first()->slug) }}">
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
