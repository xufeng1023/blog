<template>
	<figure class="image is-16by9 border-3 hand sd" @click="play" @mouseleave="mouseLeft = true" @mouseover="mouseLeft = false">
		<img :src="video.thumbnail.slug | FILE">
		<div class="playing fc is-overlay" v-if="playing" v-show="mouseLeft">
			<span class="icon has-text-danger">
				<i class="fa fa-youtube-play fa-3x"></i>
			</span>
		</div>
		<span class="tag preview is-danger" v-if="!video.is_free">{{ previewText }}</span>
	</figure>
</template>

<script>
	export default {
		props: ['video'],
		data() {
			return {
				previewText: window.lan.notFree,
				playing: false,
				mouseLeft: true 
			}
		},
		created() {
			Bus.$on('nowPlaying', function(data) {
				this.playing = this.video.slug != data ? true : false
			}.bind(this));
		},
		methods: {
			play() {
				Bus.$emit('play', this.video)
			}
		}
	}
</script>