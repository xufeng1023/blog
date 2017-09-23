<template>
	<video 
		id="video-player" 
		class="video-js vjs-big-play-centered"
		data-setup="{}" 
		controls 
		autoplay 
	>
    </video>
</template>

<script>
	export default {
		props: ['preview'],
		data() {
			return {
				now: null,
				video: null
			}
		},
		watch: {
			now() {
				this.video.pause();
				//this.video.poster('/storage/' + this.now.thumbnail.slug);

				this.load();
				
				this.video.load();
				this.video.play();
			}
		},
		mounted() {
			this.now = this.preview;
			
			this.video = videojs('video-player', {errorDisplay: false});

			Bus.$on('play', video => {
				this.now = video;
			})

			this.video.ready(function() {
				this.hotkeys({
					seekStep: 10,
				});
			});

			this.video.on('ended', () => {
				this.next();
			});

			this.video.on('error', (e) => {
				console.log(e)
				e.stopImmediatePropagation();
		        var error = this.video.error();
		        console.log('error!', error.code, error.type , error.message);
			});
		},
		methods: {
			load() {
				this.video.src({
					type: "video/mp4",
					src: '/video/' + this.now.slug + '?' + Math.random().toString(36).substring(2)
				});

				Bus.$emit('nowPlaying', this.now.slug);
			},
			next() {
				this.now.slug = this.now.slug.replace(/\d+$/, num => { return ++num });
				this.load();
			}
		}
	}
</script>
