<template>
	<button class="button is-success" :class="{'is-loading': sending}" @click="resume" v-text="btnText"></button>
</template>

<script>
	export default {
		data() {
			return {
				btnText: window.lan.resume,
				resumeDesc: window.lan.resumeDesc,
				sending: false
			}
		},
		methods: {
			resume() {
				this.sending = true;

				axios.post(api + 'resume/' + auth.id, {apiToken: auth.api_token})
				.then(({data}) => {
					location.assign(data);
				})
				.catch(r => {
					this.sending = false;
				})
			}
		}
	}
</script>
