<template>
	<table class="table is-bordered is-striped is-narrow is-fullwidth">
		<tr v-for="invoice in invoices">
			<td>{{ invoice.date }}</td>
            <td>{{ invoice.total }}</td>
            <td>
            	<button class="button is-default is-small" :class="{'is-loading': loading}" @click="download(invoice.id)">Download</button>
            </td>
		</tr>
		<tr v-if="!invoices.length">
			<td colspan="3">{{ status }}</td>
		</tr>
	</table>
</template>

<script>
	export default {
		data() {
			return {
				status: 'loading...',
				loading: false,
				invoices: []
			}
		},
		created() {
			this.fetch();
		},
		methods: {
			fetch() {
				axios.get(api + 'invoices')
				.then(r => {
					this.invoices = r.data
					if(!r.data) {
						this.status = window.lan.noInvoice;
					}
				})
				.catch(r => {
					this.status = window.lan.noInvoice;
				})
			},
			download(invoiceId) {
				this.loading = true;
				axios.get(api + 'invoice?invoiceId=' + invoiceId,
				{
				    responseType: 'blob'
				})
				.then( r => { 
					var link = document.createElement('a');
				    link.href = window.URL.createObjectURL(r.data);
				    link.download = invoiceId + ".pdf";
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
