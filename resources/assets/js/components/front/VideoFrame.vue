<template>
	<div class="field">
		<video 
			id="video-player" 
			class="video-js vjs-big-play-centered sd"
			data-setup="{}" 
			controls  
			autoplay 
		>
	    </video>
	    <notify color="is-danger"></notify>
	</div>
	
</template>

<script>
	export default {
		props: ['preview', 'post'],
		data() {
			return {
				now: null,
				video: null,
			}
		},
		watch: {
			now() {
				this.video.pause();
				this.load();
				this.video.load();
				this.video.play();
			}
		},
		mounted() {
			let self = this;
			this.now = this.preview;
			
			this.video = videojs('video-player', {
				errorDisplay: false
			}, function() {
				this.volume(0.4);
				this.setTimeout(() => {
					self.updatePostViews();
				}, 30000);
				this.hotkeys({
					seekStep: 10,
					enableVolumeScroll: false
				});
			});

			Bus.$on('play', video => {
				this.now = video;
			})
		},
		methods: {
			load() {
				axios.get('/video/'+this.now.slug+'/checkSlug')
				.then( () => {
					this.video.src({
						type: "video/mp4",
						src: '/video/' + this.now.slug + '?' + Math.random().toString(36).substring(2)
					});
				})
				.catch( (e) => {
					if(e.response.status === 404) return;

					Bus.$emit('notify', e.response.data);
					this.video.reset();

					if(this.now.thumbnail) {
						this.video.poster('/storage/' + this.now.thumbnail.slug);
					}
				})
				
				Bus.$emit('nowPlaying', this.now.slug);
			},
			updatePostViews() {
				axios.post('/post/'+this.post+'/updateViews');
			}
		}
	}
</script>
