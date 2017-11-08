<template>
	<button class="button is-danger is-outlined" :class="{'is-loading': sending}" @click="cancel">{{ btnText }}</button>
</template>

<script>
	export default {
		data() {
			return {
				btnText: window.lan.cancel,
				sending: false
			}
		},
		methods: {
			cancel() {
				this.sending = true;

				axios.post(api + 'cancel')
				.then(r => {
					location.assign('/settings/subscription');
				})
				.catch(r => {
					this.sending = false;
				})
			}
		}
	}
</script>
