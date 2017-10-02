<script>
	import price from './Price.vue';

	export default {
		components: {price},
		methods: {
			onSubmit(e) {
				let formData = new FormData(e.target);
				if(formData.has('plan') === false) {
					alert('choose a plan');
					return;
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
							console.log(response.data)
						})
					})
					.catch(({response}) => {
						console.log(response.data)
					})
				})
				.catch(({response}) => {
					console.log(response.data)
				})
			}
		}
	}
</script>