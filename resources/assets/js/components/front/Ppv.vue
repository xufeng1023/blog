<template>
	<div class="is-pulled-right">
		<button type="button" class="button is-success" @click="isActive = true">{{ btnText }}</button>
		<div class="modal" :class="{'is-active': isActive}">
            <div class="modal-background" @click="isActive = false"></div>
            <div class="modal-card">
                <section class="modal-card-body">
                	<notify2 :color="color"></notify2>
                    <form @submit.prevent="onSubmit">
                    	<table class="table is-fullwidth">
                    		<tr><th>本次需付费</th><td>{{ price }}</td></tr>
                    		<tr><th>卡号四位数</th><td>{{ last4 }}</td></tr>
                    	</table>
                    	<div class="has-text-centered">
	                		<submit text="确认付款"></submit>
	                	</div>
	                </form>
                </section>
            </div>
        </div>
	</div>
</template>

<script>
	import submit from './Submit.vue';
	import notify2 from './Notify2.vue';
	export default {
		props: ['post'],
		components: {submit, notify2},
		data() {
			return {
				btnText: window.lan.ppvBtn,
				last4: auth? auth.card_last_four : '',
				isActive: false,
				color: '',
				price: this.post.sd? '$3.25' : '$1.45'
			}
		},
		methods: {
			onSubmit() {
				Bus.$emit('loading-start');
				axios.post(api + 'ppv/' + this.post.slug)
				.then(r => {
					this.color = 'is-success';
					Bus.$emit('notify2', window.lan.paid);
					axios.post('/ppv/' + this.post.id)
					.then(r => {
						setTimeout(() => {
							location.reload();
						}, 2000)
					})
				})
				.catch(r => {
					this.color = 'is-danger';
					Bus.$emit('notify2', window.lan.payFailed);
				})
				.then(r => {
					Bus.$emit('loading-end');
				})
			}
		}
	}
</script>