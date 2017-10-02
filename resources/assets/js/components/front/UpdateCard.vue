<template>
	<form @submit.prevent="update">
		<card></card>
		<button class="button is-primary" type="submit">Update</button>
	</form>
</template>

<script>
	import card from './Card.vue';
	
	export default {
		props: ['user'],
		components: {card},
		methods: {
			update(e) {
				let formData = new FormData(e.target);
				formData.append('apiToken', this.user.api_token);

				axios.post(api + 'updateCard/' + this.user.id, formData)
				.then(r => {
					console.log(r.data);
				})
				.catch(r => {
					console.error(r.response.data);
				});
			}
		}
	}
</script>
