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
	    <notification :msg="msg" color="is-danger"></notification>
	</div>
	
</template>

<script>
	import notification from './Notification.vue';

	export default {
		props: ['preview', 'post'],
		components: {notification},
		data() {
			return {
				now: null,
				video: null,
				msg: ''
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

			this.video.on('ended', () => {
				this.next();
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

					this.msg = '';
				})
				.catch( (e) => {
					if(e.response.status === 404) return;

					this.msg = e.response.data;
					this.video.reset();

					if(this.now.thumbnail) {
						this.video.poster('/storage/' + this.now.thumbnail.slug);
					}
				})
				
				Bus.$emit('nowPlaying', this.now.slug);
			},
			next() {
				this.now.slug = this.now.slug.replace(/\d+$/, num => { return ++num });
				this.load();
			},
			updatePostViews() {
				axios.post('/post/'+this.post+'/updateViews');
			}
		}
	}
</script>
