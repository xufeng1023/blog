<template>
	<figure class="image is-16by9 border-3" @click="play">
		<img :src="video.thumbnail.slug | FILE">
		<div class="playing hero is-overlay" v-if="playing">
			<div class="hero-body">
				<span class="is-size-4 has-text-centered container">now playing...</span>
			</div>
		</div>
	</figure>
</template>

<script>
	export default {
		props: ['video'],
		data() {
			return {
				playing: false
			}
		},
		created() {
			Bus.$on('nowPlaying', function(data) {
				this.playing = this.video.slug == data ? true : false
			}.bind(this));
		},
		methods: {
			play() {
				Bus.$emit('play', this.video)
			}
		}
	}
</script>