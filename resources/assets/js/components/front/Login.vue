<template>
	<div>
		<a class="button is-primary" href="/login" @click.prevent="isActive = true">login</a>

		<div class="modal" :class="{'is-active': isActive}">
	  		<div class="modal-background" @click="isActive = false"></div>
	  		<div class="modal-card">
			    <header class="modal-card-head">
			      	<p class="modal-card-title">Log In</p>
			      	<button class="delete" aria-label="close" @click="isActive = false"></button>
			    </header>
			    <section class="modal-card-body">
			      	<form method="POST" action="/login" @submit.prevent="onSubmit">
		                <div class="field">
		                    <label for="email" class="has-text-black">E-Mail Address</label>
		                    <div class="control">
		                        <input id="email" type="email" class="input" :class="{'is-danger': errors.email}" name="email" value="" required autofocus>
		                    </div>
		                    <p class="help is-danger" v-if="errors.email">
	                            {{ errors.email[0] }}
	                        </p>
		                </div>

		                <div class="field">
		                    <label for="password" class="has-text-black">Password</label>
		                    <div class="control">
		                        <input id="password" type="password" class="input" :class="{'is-danger': errors.email}" name="password" required>
		                    </div>
		                    <p class="help is-danger" v-if="errors.email">
	                            {{ errors.email[0] }}
	                        </p>
		                </div>

		                <div class="field">
		                    <div class="control">
		                        <label class="checkbox has-text-black">
		                            <input type="checkbox" name="remember"> Remember Me
		                        </label>
		                    </div>
		                </div>

		                <div class="field">
		                    <div class="control">
		                        <button type="submit" class="button is-primary">
		                            Login
		                        </button>

		                        <a class="button is-link has-text-black" href="/password/reset">
		                            Forgot Your Password?
		                        </a>
		                    </div>
		                </div>
		            </form>
			    </section>
	  		</div>
		</div>
	</div>
</template>

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
			}
		}
	}
</script>