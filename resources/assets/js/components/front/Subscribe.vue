<template>
	<form @submit.prevent="onSubmit">
		<notify :color="color"></notify>
		<div class="field has-addons">
			<div class="control">
				<div class="select">
				  	<select name="plan">
				    	<option v-for="plan in plans" :value="plan.id">
					    	{{ plan.unit + ' - ' + plan.label }}
					    </option>
				  	</select>
				</div>
			</div>
			<div class="control">
				<submit :text="btnText"></submit>
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
				btnText: window.lan.subscribe,
				plans: [window.lan.monthly],
				color: '',
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

				axios.post(api + 'subscribe', formData)
				.then(({data}) => {
					this.color = 'is-success';
					Bus.$emit('loading-end');
					Bus.$emit('notify', window.lan.paid);
					setTimeout(() => {
						location.assign(data);
					}, 3000);
					
				})
				.catch(r => {
					this.color = 'is-danger';
					Bus.$emit('loading-end');
					Bus.$emit('notify', window.lan.payFailed);
				});
			}
		}
	}
</script>