<template>
	<div class="card border-info mb-3" style="max-width: 20rem;">
  		<div class="card-header">Card Info</div>
  		<div class="card-body text-info">
    		<form @submit.prevent="pay">
    			<div class="form-group">
			    	<label for="card-number">Card Number</label>
			    	<input type="text" class="form-control" id="card-number" placeholder="Card number">
			  	</div>
			  	<div class="row">
				    <div class="col">
				      	<div class="form-group">
					    	<label for="expiration">Expiration</label>
					    	<input type="text" class="form-control" id="expiration" placeholder="Expiration">
					  	</div>
				    </div>
				    <div class="col">
				      	<div class="form-group">
					    	<label for="cvc">CVC</label>
					    	<input type="text" class="form-control" id="cvc" placeholder="CVC">
					  	</div>
				    </div>
			  	</div>
				<button class="btn btn-primary" type="submit">Pay</button>
			</form>
  		</div>
	</div>
</template>

<script>
	axios.defaults.headers.common['X-CSRF-TOKEN'] = '';
	
	export default {
		props: ['user'],
		methods: {
			pay() {
				axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.user.text_token;

				axios.post('http://127.0.0.2:8000/api/subscribe/' + this.user.id, 
					{apiToken: this.user.api_token}
				).then(r => {
					console.log(r.data);
				});
			}
		}
	}
</script>
