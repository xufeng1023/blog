<template>
	<form @submit.prevent="update">
		<div class="notification is-danger" v-if="errors" v-text="errors"></div>
		<card></card>
		<submit text="Update"></submit>
	</form>
</template>

<script>
	import card from './Card.vue';
	import submit from './Submit.vue';
	
	export default {
		props: ['user'],
		data() {
			return {
				errors: ''
			}
		},
		components: {card, submit},
		methods: {
			update(e) {
				Bus.$emit('loading-start');
				this.errors = '';
				let formData = new FormData(e.target);
				formData.append('apiToken', this.user.api_token);

				axios.post(api + 'updateCard/' + this.user.id, formData)
				.then(r => {
					location.reload();
				})
				.catch(r => {
					Bus.$emit('loading-end');
					this.errors = r.response.data;
				});
			}
		}
	}
</script>
