<template>
	<figure class="image is-1by1" @click="play">
		<img :src="video.thumbnail.slug | FILE">
	</figure>
</template>

<script>
	export default {
		props: ['video'],
		methods: {
			play() {
				Bus.$emit('play', this.video)
			}
		}
	}
</script>