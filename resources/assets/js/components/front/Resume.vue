<template>
	<div>
		<notify :color="color"></notify>
		<button class="button is-success" :class="{'is-loading': sending}" @click="resume" v-text="btnText"></button>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				btnText: window.lan.resume,
				resumeDesc: window.lan.resumeDesc,
				sending: false,
				color: 'is-success'
			}
		},
		methods: {
			resume() {
				this.sending = true;

				axios.post(api + 'resume')
				.then(({data}) => {
					Bus.$emit('notify', window.lan.resumed);
					setTimeout(() => {
						location.assign(data);
					}, 2000)
				})
				.then(r => {
					this.sending = false;
				})
			}
		}
	}
</script>
