<template>
	<form @submit.prevent="change">
		<plans :current="this.user.plan"></plans>
		<button type="submit" class="button is-primary">Change</button>
	</form>
</template>

<script>
	import plans from './Plans.vue';
	axios.defaults.headers.common['X-CSRF-TOKEN'] = '';
	export default {
		props: ['user'],
		components: {plans},
		methods: {
			change(e) {
				let formData = new FormData(e.target);
				formData.append('apiToken', this.user.api_token);
				axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.user.text_token;
				axios.post(api + 'changePlan/' + this.user.id, formData)
				.then(r => {
					console.log(r.data);
				})
			}
		}
	}
</script>