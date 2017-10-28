<template>
	<form @submit.prevent="onSubmit">
		<div class="field has-addons">
			<div class="control">
				<div class="select">
				  	<select name="plan">
				    	<option v-for="plan in plans" :value="plan.plan_id">
					    	{{ plan.name + ' - ' + plan.price }}
					    </option>
				  	</select>
				</div>
			</div>
			<div class="control">
				<submit text="Subscribe"></submit>
			</div>
		</div>
	</form>
</template>

<script>
	import submit from './Submit.vue';
	export default {
		components: {submit},
		data() {
			return {
				plans: [
					{plan_id: 'Monthly', name: 'Month', price: '$15.00'},
					{plan_id: 'Daily', name: 'Daily', price: '$1.00'}
				]
			}
		},
		methods: {
			onSubmit(e) {
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
		// created() {
		// 	axios.get('/plans')
		// 	.then(({data}) => {
		// 		this.plans = data;
		// 	})
		// }
	}
</script>