<template>
	<form @submit.prevent="pay">
		<div class="field">
	    	<label for="card-number">Card Number</label>
	    	<div class="control">
                <input id="card-number" type="text" class="input" v-model="number" @keyup="formatNumber" name="name" required>
            </div>
	  	</div>
	  	<div class="columns">
		    <div class="column">
		      	<div class="field">
			    	<label for="expiration">Expiration</label>
			    	<input type="text" class="input" id="expiration" v-model="exp" @keyup="formatExp" placeholder="MM/YY" required>
			  	</div>
		    </div>
		    <div class="column">
		      	<div class="field">
			    	<label for="cvc">CVC</label>
			    	<input type="text" class="input" id="cvc" v-model="cvc" @keyup="formatCvc" required>
			  	</div>
		    </div>
	  	</div>
		<button class="button is-primary" type="submit">Pay</button>
	</form>
</template>

<script>
	axios.defaults.headers.common['X-CSRF-TOKEN'] = '';
	
	export default {
		props: ['user'],
		data() {
			return  {
				number: '',
				exp: '',
				cvc: ''
			}
		},
		methods: {
			formatNumber() {
				this.number = this.number.replace(/\D/g, '').replace(/(\d{4})/g, '$1 ').substr(0, 19);
			},
			formatExp() {
				this.exp = this.exp.replace(/\D/g, '').replace(/(\d{1,2})(\d{2})/, '$1/$2').substr(0, 5);
			},
			formatCvc() {
				this.cvc = this.cvc.replace(/\D/g, '').substr(0, 3);
			},
			pay() {
				axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.user.text_token;

				// axios.post('http://127.0.0.2:8000/api/subscribe/' + this.user.id, 
				// 	{apiToken: this.user.api_token})
				axios.post('http://127.0.0.2:8000/api/cancel')
				.then(r => {
					console.log(r.data);
				});
			}
		}
	}
</script>
