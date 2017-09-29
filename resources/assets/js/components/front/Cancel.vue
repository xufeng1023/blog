<template>
	<button class="button is-danger is-outlined" :class="{'is-loading': sending}" @click="cancel">Cancel</button>
</template>

<script>
	axios.defaults.headers.common['X-CSRF-TOKEN'] = '';
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
				axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.user.text_token;

				axios.post(api + 'cancel/' + this.user.id, {apiToken: this.user.api_token})
				.then(r => {
					console.log(r.data);
				})
				.catch(r => {
					console.error(r.response.data);
				})
				.then(() => {
					this.sending = false;
				});
			}
		}
	}
</script>
