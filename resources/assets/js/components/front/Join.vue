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
			endInError(msg) {
				window.scrollTo(0, -50000);
				Bus.$emit('loading-end');
				Bus.$emit('notify', msg);
			},
			onSubmit(e) {
				Bus.$emit('loading-start');
				let formData = this.$parent.formToJson(e.target);

				if(!formData.plan) {
					this.endInError(window.lan.chooseAPlan);
					return false;
				}

				if(!formData.email.includes('@')) {
					this.endInError(window.lan.badEmail);
					return false;
				}
				
				if(!formData.expiration.includes('/')) {
					this.endInError(window.lan.badCardInfo);
					return false;
				}

				let cvcLength = formData.cvc.length;
				if(cvcLength !== 3 && cvcLength !== 4) {
					this.endInError(window.lan.badCardInfo);
					return false;
				}

				if(formData.password.length < 6) {
					this.endInError(window.lan.passWrong);
					return false;
				}

				if(formData.password != formData.password_confirmation) {
					this.endInError(window.lan.passWrong);
					return false;
				}

				axios.post('/join', formData)
				.then(({data}) => {					
					axios.defaults.headers.common['Authorization'] = 'Bearer '+data.api_token;
					axios.post(api + 'subscribe', formData)
					.then(({data}) => {
						this.color = 'is-success';
						this.endInError(window.lan.paid);
						setTimeout(() => {
							location.reload();
						}, 2000);
					})
					.catch(({response}) => {
						if(!response) {
							var msg = window.lan.badApi;
						} else {
							if(response.data == 'card') {
								var msg = window.lan.badCardInfo;
							}
							if(response.data == 'plan') {
								var msg = window.lan.chooseAPlan;
							}
							if(response.data == 'pay') {
								var msg = window.lan.payFailed;
							}
						}
						
						this.endInError(msg);
						axios.delete('/user/delete');
					})
				})
				.catch(({response}) => {
					var msg = window.lan.passWrong;
					if(response.data.errors.email) msg = window.lan.emailWrong;
					this.endInError(msg);
				})
			}
		}
	}
</script>