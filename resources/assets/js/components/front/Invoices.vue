<template>
	<table class="table is-bordered is-striped is-narrow is-fullwidth">
		<tr v-for="invoice in invoices">
			<td>{{ invoice.date }}</td>
            <td>{{ invoice.total }}</td>
            <td>
            	<button class="button is-default is-small" @click="download(invoice.id)">Download</button>
            </td>
		</tr>
		<tr v-if="!invoices.length">
			<td colspan="3">loading...</td>
		</tr>
	</table>
</template>

<script>
	export default {
		props: ['user'],
		data() {
			return {
				invoices: []
			}
		},
		created() {
			this.fetch();
		},
		methods: {
			fetch() {
				axios.get(api + 'invoices/' + this.user.id + '?apiToken=' + this.user.api_token)
				.then(r => {
					this.invoices = r.data
				})
				.catch(r => {
					
				});
			},
			download(invoiceId) {
				axios.get(api + 'invoice/' + this.user.id + '?invoiceId=' + invoiceId,
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
				.catch(r => {
					
				});
			}
		}
	}
</script>
