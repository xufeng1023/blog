<template>
	<div class="field">
		<div class="select is-fullwidth">
		  	<select name="plan">
		    	<option>Select a plan</option>
		    	<option v-for="plan in plans" :value="plan.plan_id" :selected="current == plan.plan_id">
			    	{{ plan.name }}
			    </option>
		  	</select>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['current'],
		data() {
			return {
				plans: []
			}
		},
		created() {
			axios.get('/plans')
			.then(({data}) => {
				this.plans = data;
			})
		}
	}
</script>