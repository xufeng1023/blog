@extends('layouts.app')

@section('content')
<div>
    <a href="/join">
        <img src="{{ asset('images/Banner3.jpg') }}">
    </a>
</div>
<div class="hero-body">
    <div class="container">
        @foreach($posts->chunk(4) as $chunks)
            <div class="columns">
                @foreach($chunks as $post)
                    @if($post->images->first())
                        <div class="column is-4">
                            <a href="/movie/{{ $post->slug }}">
                                <figure class="image is-16by9">
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
</div>
@endsection
