<script>
	import price from './Price.vue';
	import card from './Card.vue';
	import submit from './Submit.vue';

	export default {
		data() {
			return {
				errors: []
			}
		},
		components: {price, card, submit},
		methods: {
			onTop() {
				window.scrollTo(0, -50000);
			},
			onSubmit(e) {
				Bus.$emit('loading-start');

				this.errors = [];

				let formData = new FormData(e.target);

				if(formData.has('plan') === false) {
					this.onTop();
					Bus.$emit('loading-end');
					return this.errors = {plan: 'Choose a plan!'};
				}

				if(!formData.get('expiration').includes('/')) {
					Bus.$emit('loading-end');
					return this.errors = {card: 'Invalid expiration date!'};
				}

				axios.post(api + 'token', formData)
				.then(({data}) => {
					formData.set('payKey', data);

					axios.post('/join', formData)
					.then(({data}) => {
						formData.set('apiToken', data.api_token);

						axios.post(api + 'subscribe/' + data.id, formData)
						.then(({data}) => {
							location.reload();
						})
						.catch(({response}) => {
							axios.delete('/user/delete')
							this.onTop();
							this.errors = {plan: 'Sorry! Payment failed, please refresh the page and try again.'};
							Bus.$emit('loading-end');
						})
					})
					.catch(({response}) => {
						axios.delete('/user/delete')
						if(response.data.errors) {
							this.errors = response.data.errors;
						} else {
							this.onTop();
							this.errors = {plan: 'Sorry! Payment failed, please refresh the page and try again.'};
						}
						Bus.$emit('loading-end');
					})
				})
				.catch(({response}) => {
					this.errors = response.data
					Bus.$emit('loading-end');
				})
			}
		}
	}
</script>