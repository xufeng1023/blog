<template>
	<form @submit.prevent="change">
		<notify color="is-danger"></notify>
		<plans current="monthly"></plans>
	</form>
</template>

<script>
	import plans from './Plans.vue';
	

	export default {
		components: {plans},
		methods: {
			change(e) {
				Bus.$emit('loading-start');
				let formData = this.$parent.formToJson(e.target);

				if(!formData.plan) {
					Bus.$emit('notify', 'Select a plan.');
					Bus.$emit('loading-end');
					return;
				}

				axios.post(api + 'changePlan', formData)
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
