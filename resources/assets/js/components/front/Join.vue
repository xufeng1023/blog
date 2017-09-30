<script>
	import price from './Price.vue';

	export default {
		components: {price},
		methods: {
			onSubmit(e) {
				let formData = new FormData(e.target);

				axios.post('/user/instance', formData)
				.then(({data}) => {
					axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.text_token;

					axios.post(api + 'token', formData)
					.then(({data}) => {
						console.log(data)
					})
				})
				.catch(({response}) => {
					console.log(response)
				})
			}
		}
	}
</script>