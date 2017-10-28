<template>
	<form @submit.prevent="change">
		<notify color="is-danger"></notify>
		<plans :current="this.user.plan"></plans>
	</form>
</template>

<script>
	import plans from './Plans.vue';
	

	export default {
		props: ['user'],
		components: {plans},
		methods: {
			change(e) {
				Bus.$emit('loading-start');
				let formData = new FormData(e.target);

				if(!formData.get('plan')) {
					Bus.$emit('notify', 'Select a plan.');
					Bus.$emit('loading-end');
					return;
				}

				formData.append('apiToken', this.user.api_token);

				axios.post(api + 'changePlan/' + this.user.id, formData)
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
