<template>
	<a href="javascript:;" data-toggle="modal" data-target="#viewImageModal" @click="show">
		<figure class="image is-1by1">
	        <img :src="this.image.slug | FILE">
	    </figure>
    </a>
</template>

<script>
	export default {
		props: ['image'],
		methods: {
			show() {
				Bus.$emit('showImage', this.image.slug);
			}
		}
	}
</script>