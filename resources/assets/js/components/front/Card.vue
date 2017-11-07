<template>
	<div class="field">
		<div class="field">
	    	<label for="card-number" v-text="cardNumber"></label>
	    	<div class="control">
                <input id="card-number" type="text" class="input" v-model="number" @keyup="formatNumber" @keypress="onKeypress" name="number" required>
            </div>
	  	</div>
	  	<div class="columns">
		    <div class="column">
		      	<div class="field">
			    	<label for="expiration" v-text="cardExp"></label>
			    	<div class="control">
				    	<input type="text" class="input" id="expiration" v-model="exp" @keyup="formatExp" @keypress="onKeypress" :placeholder="cardExpPlaceholder" name="expiration" required>
				    	<input type="hidden" name="month" v-model="month">
				    	<input type="hidden" name="year" v-model="year">
				    </div>
			  	</div>
		    </div>
		    <div class="column">
		      	<div class="field">
			    	<label for="cvc" v-text="cardCvc"></label>
			    	<div class="control">
				    	<input type="text" class="input" id="cvc" name="cvc" v-model="cvc" @keyup="formatCvc" @keypress="onKeypress" required>
				    </div>
			  	</div>
		    </div>
	  	</div>
  	</div>
</template>

<script>
	export default {
		data() {
			return  {
				cardNumber: window.lan.card,
				cardExp: window.lan.exp,
				cardExpPlaceholder: window.lan.expPlaceholder,
				cardCvc: window.lan.cvc,
				number: '',
				exp: '',
				month: '',
				year: '',
				cvc: ''
			}
		},
		methods: {
			formatNumber() {
				this.number = this.number.replace(/\D/g, '').substr(0, 16);
			},
			formatExp() {
				this.exp = this.exp.replace(/\D/g, '').replace(/(\d{1,2})(\d{2})/, '$1/$2').substr(0, 5);
				if(this.exp.includes('/')) {
					let mmyy = this.exp.split('/');
					this.month = mmyy[0];
					this.year = mmyy[1];
				}
			},
			formatCvc() {
				this.cvc = this.cvc.replace(/\D/g, '').substr(0, 4);
			},
			onKeypress() {
				if( (event.keyCode < 48 || event.keyCode > 57) ) event.preventDefault(); 
			}
		}
	}
</script>
