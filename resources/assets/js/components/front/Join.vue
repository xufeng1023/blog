<script>
	import price from './Price.vue';
	import card from './Card.vue';

	export default {
		data() {
			return {
				errors: []
			}
		},
		components: {price, card},
		methods: {
			onTop() {
				window.scrollTo(0, -50000);
			},
			onSubmit(e) {
				this.errors = [];

				let formData = new FormData(e.target);

				if(formData.has('plan') === false) {
					this.onTop();
					return this.errors = {plan: 'Choose a plan!'};
				}

				if(!formData.get('expiration').includes('/')) {
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
							axios.delete('/user/delete/' + response.data)
							this.onTop();
							this.errors = {plan: 'Sorry! Payment failed, please refresh the page and try again.'};
						})
					})
					.catch(({response}) => {
						this.errors = response.data.errors;
					})
				})
				.catch(({response}) => {
					this.errors = response.data
				})
			}
		}
	}
</script>