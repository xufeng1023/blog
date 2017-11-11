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
                                    <div class="preview">
                                        @if($post->sd)
                                            <span class="tag is-info">@lang('index.sd')</span>
                                        @endif
                                        @if($post->preview->is_free && (!$auth || !$auth->is_member))
                                            <span class="tag is-success">@lang('index.preview')</span>
                                        @endif
                                    </div>
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
