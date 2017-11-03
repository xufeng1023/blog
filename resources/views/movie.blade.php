@extends('layouts.app')

@section('style')
    <link href="https://vjs.zencdn.net/6.2.7/video-js.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
        <div class="columns">
            <div class="column is-two-thirds">
                @if($post->preview) 
                    <video-frame post="{{ $post->slug }}" :preview="{{ $post->preview }}"></video-frame>
                @endif
                <h1 class="title is-3">{{ $post->title }}</h1>
                <h2 class="has-text-7">@lang('index.clips')</h2><hr>
                <div class="columns">
                    @foreach($post->videos as $video)
                        @if($video->thumbnail)
                            <div class="column is-one-quarter">
                                <video-one :video="{{ $video }}"></video-one>
                            </div>
                        @endif
                    @endforeach
                </div><br>
                <h2 class="has-text-7">@lang('index.shots')</h2><hr>
                @foreach($post->images->chunk(4) as $chunks)
                    <div class="columns">
                        @foreach($chunks as $image)
                            <div class="column is-one-quarter">
                                <image-one :image="{{ $image }}"></image-one>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <image-modal inline-template>
            <div class="modal" :class="{'is-active': isActive}" id="viewImageModal">
                <div class="modal-background" @click="isActive = false"></div>
                <div class="modal-content">
                    <p class="image">
                        <img :src="src | FILE" width="100%" v-if="src">
                    </p>
                </div>
                <button class="modal-close is-large" aria-label="close" @click="isActive = false"></button>
            </div>
        </image-modal>
</div>
@endsection

@section('script')
    <script src="https://vjs.zencdn.net/6.2.7/video.js"></script>
    <script src="//cdn.sc.gl/videojs-hotkeys/latest/videojs.hotkeys.min.js"></script>
@endsection
