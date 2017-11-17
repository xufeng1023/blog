<template>
    <div class="modal" :class="{'is-active': isActive}">
        <div class="modal-background" @click="closeModal"></div>
        <div class="modal-card">
            <section class="modal-card-body">
                <form method="POST" action="/login" @submit.prevent="onSubmit" ref="form">
                    <div class="field">
                        <label for="email" class="has-text-black">{{ emailText }}</label>
                        <div class="control">
                            <input id="email" type="email" class="input" :class="{'is-danger': errors.email}" name="email" value="" placeholder="E-mail" required autofocus>
                        </div>
                        <p class="help is-danger" v-if="errors.email" v-text="errors.email[0]"></p>
                    </div>

                    <div class="field">
                        <label for="password" class="has-text-black">{{ passText }}</label>
                        <div class="control">
                            <input id="password" type="password" class="input" :class="{'is-danger': errors.email}" name="password" required>
                        </div>
                        <p class="help is-danger" v-if="errors.email" v-text="errors.email[0]"></p>
                    </div>

                    <input type="checkbox" name="remember" class="is-hidden" checked>

                    <div class="field">
                        <button type="submit" class="button is-primary is-fullwidth has-text-centered">{{ btnText }}</button>
                    </div>
                    <div class="has-text-centered">
                        <a class="button is-link has-text-grey-light" href="/password/reset">{{ passForgetText }}</a>
                    </div>
                    <div class="has-text-centered">
                        <a class="button is-link has-text-grey-light" href="/join">{{ joinText }}</a>
                    </div>
                </form>
            </section>
        </div>
    </div>
</template>
<script>
	export default {
		data() {
			return {
                emailText: window.lan.email,
                passText: window.lan.password,
                btnText: window.lan.login,
                joinText: window.lan.newUser,
                passForgetText: window.lan.passForget,
				isActive: false,
				errors: [],
                bodyEl: window.document.querySelector('body')
			}
		},
        created() {
            Bus.$on('login', () => {
                this.errors = [];
                this.$refs.form.reset();
                this.isActive = true;
                this.bodyEl.style.position = 'fixed';
            });
        },
		methods: {
            closeModal() {
                this.isActive = false;
                this.bodyEl.style.position = 'inherit';
            },
			onSubmit(e) {
				let fm = this.$parent.formToJson(e.target);

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