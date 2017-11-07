<script>
	import price from './Price.vue';
	import card from './Card.vue';
	import submit from './Submit.vue';

	export default {
		data() {
			return {
				color: 'is-danger',
				subtotal: '',
			}
		},
		components: {price, card, submit},
		created() {
			Bus.$on('total', price => {
				this.subtotal = window.lan.total + '<span class="tag is-info">$' + price + '</span>';
			});
		},
		methods: {
			onTop() {
				window.scrollTo(0, -50000);
			},
			endInError(msg) {
				this.onTop();
				Bus.$emit('loading-end');
				Bus.$emit('notify', msg);
			},
			onSubmit(e) {
				Bus.$emit('loading-start');

				let formData = new FormData(e.target);

				if(formData.has('plan') === false) {
					this.endInError(window.lan.chooseAPlan);
					return false;
				}
				
				if(!formData.get('expiration').includes('/')) {
					this.endInError(window.lan.badCardInfo);
					return false;
				}

				if(formData.get('cvc').length !== 3) {
					this.endInError(window.lan.badCardInfo);
					return false;
				}

				if(formData.get('password') != formData.get('password_confirmation')) {
					this.endInError(window.lan.passWrong);
					return false;
				}

				axios.post(api + 'token', formData)
				.then(({data}) => {
					formData.set('payKey', data);

					axios.post('/join', formData)
					.then(({data}) => {
						axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.api_token

						axios.post(api + 'subscribe', formData)
						.then(({data}) => { console.log(data);
							this.color = 'is-success';
							this.endInError(window.lan.paid);
							setTimeout(() => {
								//location.reload();
							}, 2000);
						})
						.catch(({response}) => {
							axios.delete('/oauth/personal-access-tokens/' + response.data);
							axios.delete('/user/delete')
							this.endInError(window.lan.payFailed);
						})
					})
					.catch(({response}) => {
						//axios.delete('/user/delete')
						if(response.data.errors) {
							var msg = window.lan.passWrong;
							if(response.data.errors.email) {
								msg = window.lan.emailWrong;
							}
							this.endInError(msg);
						}
					})
				})
				.catch(({response}) => {
					if(!response) {
						this.endInError(window.lan.badApi);
						return;
					}
					var msg = window.lan.badCardInfo;
					if(response.data.plan) {
						msg = window.lan.chooseAPlan;
					}
					this.endInError(msg);
				})
			}
		}
	}
</script>