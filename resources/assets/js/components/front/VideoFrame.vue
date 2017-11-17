<template>
	<video 
		id="video-player" 
		class="video-js vjs-big-play-centered sd"
		data-setup="{}" 
		controls  
		autoplay 
	>
    </video>
</template>

<script>
	export default {
		props: ['preview', 'thumbnail', 'slug'],
		data() {
			return {
				video: null,
			}
		},
		mounted() {
			this.video = videojs('video-player', {
				errorDisplay: false
			}, function() {
				this.volume(0.4);
				this.hotkeys({
					seekStep: 10,
					enableVolumeScroll: false
				});
			});

			if(this.preview) this.load();

			this.video.on('ended', () => {
				this.updatePostViews();
			});
		},
		methods: {
			load() {
				axios.get('/video/'+this.preview.slug+'/checkSlug')
				.then( () => {
					this.video.src({
						type: "video/mp4",
						src: '/video/' + this.preview.slug + '?' + Math.random().toString(36).substring(2)
					});
				})
				.catch( e => {
					if(e.response.status === 404) return;
				})
				
				this.video.poster('/storage/' + this.thumbnail.slug);
			},
			updatePostViews() {
				axios.post('/post/'+this.slug+'/updateViews');
			}
		}
	}
</script>
