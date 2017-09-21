<script>
	export default {
		data() {
			return {
				src: '',
				isActive: false
			}
		},
		created() {
			Bus.$on('showImage', src => {
				this.src = src,
				this.isActive = true
			});
		}
	}
</script>
