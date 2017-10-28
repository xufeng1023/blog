<template>
	<div class="field has-addons">
		<div class="control">
			<div class="select">
			  	<select name="plan">
			    	<option v-for="plan in plans" :value="plan.plan_id" :selected="current == plan.plan_id">
				    	{{ plan.name + ' - ' + plan.price }}
				    </option>
			  	</select>
			</div>
		</div>
		<div class="control">
			<submit text="Change"></submit>
		</div>
	</div>
</template>

<script>
	import submit from './Submit.vue';
	export default {
		props: ['current'],
		components: {submit},
		data() {
			return {
				plans: [
					{plan_id: 'Monthly', name: 'Month', price: '$15.00'},
					{plan_id: 'Daily', name: 'Daily', price: '$1.00'}
				]
			}
		},
		// created() {
		// 	axios.get('/plans')
		// 	.then(({data}) => {
		// 		this.plans = data;
		// 	})
		// }
	}
</script>