<template>
	<table class="table is-bordered is-striped is-narrow is-fullwidth">
		<tr v-for="invoice in invoices">
			<td>{{ invoice.date }}</td>
            <td>{{ invoice.total }}</td>
            <td>
            	<btn :invoice="invoice.id"></btn>
            </td>
		</tr>
		<tr v-if="!invoices.length">
			<td colspan="3">{{ status }}</td>
		</tr>
	</table>
</template>

<script>
	import btn from './InvoiceBtn.vue';
	export default {
		components: {btn},
		data() {
			return {
				status: 'loading...',
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
			}
		}
	}
</script>
