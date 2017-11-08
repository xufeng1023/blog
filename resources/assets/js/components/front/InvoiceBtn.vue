<template>
	<button class="button is-default is-small" :class="{'is-loading': loading}" @click="download">Download</button>
</template>

<script>
	export default {
		props: ['invoice'],
		data() {
			return {
				loading: false
			}
		},
		methods: {
			download() {
				this.loading = true;
				axios.get(api + 'invoice?invoiceId=' + this.invoice,
				{
				    responseType: 'blob'
				})
				.then( r => { 
					var link = document.createElement('a');
				    link.href = window.URL.createObjectURL(r.data);
				    link.download = this.invoice + ".pdf";
				    link.click();
				    link.remove();
				})
				.then(r => {
					this.loading = false;
				});
			}
		}
	}	
</script>