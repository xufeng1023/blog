@extends('layouts.app')

@section('banner')
<div>
    <a href="/join">
        <img src="{{ asset('images/Banner-slogon.png') }}" width="100%" alt="Join DollyIsland">
    </a>
</div>
@endsection

@section('content')
<div class="container">
    <div class="columns is-mobile is-multiline">
        @foreach($posts as $post)
            @if($post->thumbnail)
                <div class="column is-one-quarter-tablet is-half-mobile">
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
    {{ $posts->links('vendor.pagination.bulma') }}
</div>
@endsection
