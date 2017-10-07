<template>
	<button type="submit" class="button is-success is-fullwidth" 
			:class="{'is-loading': loading}"
			v-text="text"
	></button>
</template>

<script>
	export default {
		props: ['text'],
		data() {
			return {
				loading: false
			}
		},
		created() {
			Bus.$on('loading-start', () => { this.loading = true });
			Bus.$on('loading-end', () => { this.loading = false });
		}
	}
</script>