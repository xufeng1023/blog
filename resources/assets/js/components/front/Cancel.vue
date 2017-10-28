<template>
	<button class="button is-danger is-outlined" :class="{'is-loading': sending}" @click="cancel">Cancel</button>
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
			cancel() {
				this.sending = true;

				axios.post(api + 'cancel/' + this.user.id, {apiToken: this.user.api_token})
				.then(r => {
					location.assign('/settings/subscription');
				})
				.catch(r => {
					this.sending = false;
					//console.error(r.response.data);
				})
			}
		}
	}
</script>
