<template>
	<form @submit.prevent="subscribe">
		<div class="notification is-danger" v-if="errors" v-text="errors"></div>
		<plans></plans>
		<button type="submit" class="button is-success" :class="{'is-loading': sending}">Subscribe</button>
	</form>
</template>

<script>
	import plans from './Plans.vue';

	export default {
		props: ['user'],
		components: {plans},
		data() {
			return {
				sending: false,
				errors: ''
			}
		},
		methods: {
			subscribe(e) {
				this.sending = true;
				let formData = new FormData(e.target)

				if(!formData.get('plan')) {
					this.sending = false;
					return this.errors = 'Choose a plan!';
				}

				formData.set('apiToken', this.user.api_token)
				axios.post(api + 'changePlan/' + this.user.id, formData)
				.then(r => {
					location.reload();
				})
				.catch(r => {
					this.sending = false;
					this.errors = r.response.data;
				})
			}
		}
	}
</script>
