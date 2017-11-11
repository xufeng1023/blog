<template>
	<figure class="image is-16by9 border-3 hand sd" @click="play" @mouseleave="mouseLeft = true" @mouseover="mouseLeft = false">
		<img :src="video.thumbnail.slug | FILE">
		<div class="playing fc is-overlay" v-if="playing" v-show="mouseLeft">
			<span class="has-text-danger" v-text="playingText"></span>
		</div>
		<span class="tag preview is-danger" v-if="memberOnly">{{ previewText }}</span>
	</figure>
</template>

<script>
	export default {
		props: ['video', 'can'],
		data() {
			return {
				previewText: window.lan.notFree,
				memberOnly: !this.video.is_free && !this.can,
				playingText: window.lan.playing,
				playing: false,
				mouseLeft: true 
			}
		},
		created() {
			Bus.$on('nowPlaying', slug => {
				this.playing = this.video.slug == slug ? true : false
			});
		},
		methods: {
			play() {
				if(!this.video.is_free && !auth) {
					Bus.$emit('notify', window.lan.notLogin);
					return;
				}
				
				if(!this.video.is_free && this.memberOnly) {
					Bus.$emit('notify', window.lan.memberOnly);
					return;
				}

				Bus.$emit('play', this.video)
			}
		}
	}
</script>