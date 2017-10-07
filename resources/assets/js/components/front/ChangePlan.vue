<template>
	<form @submit.prevent="change">
		<div class="notification is-danger" v-if="errors" v-text="errors"></div>
		<plans :current="this.user.plan"></plans>
		<submit text="Change"></submit>
	</form>
</template>

<script>
	import plans from './Plans.vue';
	import submit from './Submit.vue';

	export default {
		props: ['user'],
		data() {
			return {
				errors: ''
			}
		},
		components: {plans, submit},
		methods: {
			change(e) {
				Bus.$emit('loading-start');
				this.errors = '';
				let formData = new FormData(e.target);

				if(!formData.get('plan')) {
					this.errors = 'Select a plan!';
					Bus.$emit('loading-end');
				}

				formData.append('apiToken', this.user.api_token);

				axios.post(api + 'changePlan/' + this.user.id, formData)
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