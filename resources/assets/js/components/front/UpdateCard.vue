<template>
	<form @submit.prevent="update">
		<notify color="is-danger"></notify>
		<card></card>
		<submit :text="btnText"></submit>
	</form>
</template>

<script>
	import card from './Card.vue';
	import submit from './Submit.vue';
	
	export default {
		props: ['user'],
		components: {card, submit},
		data() {
			return {
				btnText: window.lan.update
			}
		},
		methods: {
			update(e) {
				Bus.$emit('loading-start');
				let formData = new FormData(e.target);
				formData.append('apiToken', this.user.api_token);

				axios.post(api + 'updateCard/' + this.user.id, formData)
				.then(r => {
					location.reload();
				})
				.catch(r => {
					Bus.$emit('loading-end');
					Bus.$emit('notify', r.response.data);
				});
			}
		}
	}
</script>
