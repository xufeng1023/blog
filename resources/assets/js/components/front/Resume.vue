<template>
	<button class="button is-success" :class="{'is-loading': sending}" @click="resume">Resume My Subscription</button>
</template>

<script>
	export default {
		props: ['user'],
		data() {
			return {
				sending: false
			}
		},
		methods: {
			resume() {
				this.sending = true;

				axios.post(api + 'resume/' + this.user.id, {apiToken: this.user.api_token})
				.then(r => {
					location.reload();
				})
				.catch(r => {
					this.sending = false;
					console.error(r.response.data);
				})
			}
		}
	}
</script>
