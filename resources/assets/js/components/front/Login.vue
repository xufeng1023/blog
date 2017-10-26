
<script>
	export default {
		data() {
			return {
				isActive: false,
				errors: []
			}
		},
		methods: {
			onSubmit(e) {
				let fm = new FormData(e.target);

				axios.post('/login', fm)
				.then(({data}) => {
					location.reload();
				})
				.catch(({response}) => {
					this.errors = response.data.errors
				})
			},
			open() {
				this.errors = [];
				this.$refs.form.reset();
				this.isActive = true;
			}
		}
	}
</script>