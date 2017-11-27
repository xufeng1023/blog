@extends('layouts.app')

@section('style')
    <link href="https://vjs.zencdn.net/6.2.7/video-js.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-two-thirds">
            <div class="field videoWrap">
                <video-frame 
                :thumbnail="{{ $post->thumbnail }}" 
                slug="{{ $post->slug }}"
                :preview="{{ $post->preview }}"
                >
                </video-frame>
                @if(!$auth) 
                    <div class="notification insideVideoNotify">@lang('index.need to login')</div>
                @else
                    @cannot('watch', $post)
                        <div class="notification insideVideoNotify">
                            @if(!$auth->plan)
                                @lang('index.need to buy')
                            @else
                                @lang('index.expired')
                            @endif
                        </div>
                    @endcannot
                @endif
            </div>

            @if(!$auth)    
            <div class="field">
                <login class="button is-danger" btn-text="{{ trans('index.login to watch') }}"></login>
            </div>
            @else
                @cannot('watch', $post)
                    <ppv :post="{{ $post }}"></ppv>
                @endcannot
            @endif

            <h1 class="title is-5">{{ $post->title }}</h1>

            <article class="message">
                <div class="message-header">
                    <p>@lang('index.shots')</p>
                </div>
            </article>

            <div class="columns is-mobile is-multiline">
                @foreach($post->images as $image)
                    <div class="column is-one-quarter-mobile is-2-tablet">
                        <image-one :image="{{ $image }}"></image-one>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @can('watch', $post)
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
    @endcan
</div>
@endsection

@section('script')
    <script src="https://vjs.zencdn.net/6.2.7/video.js"></script>
    <script src="//cdn.sc.gl/videojs-hotkeys/latest/videojs.hotkeys.min.js"></script>
@endsection
