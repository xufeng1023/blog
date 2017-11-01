<template>
	<div class="navbar-item">
                                    <a class="button is-link is-fullwidth" href="/login" @click.prevent="open">@lang('index.login')</a>

                                    <div class="modal" :class="{'is-active': isActive}">
                                        <div class="modal-background" @click="isActive = false"></div>
                                        <div class="modal-card">
                                            <section class="modal-card-body">
                                                <form method="POST" action="/login" @submit.prevent="onSubmit" ref="form">
                                                    <div class="field">
                                                        <label for="email" class="has-text-black">@lang('index.email')</label>
                                                        <div class="control">
                                                            <input id="email" type="email" class="input" :class="{'is-danger': errors.email}" name="email" value="" placeholder="e-mail" required autofocus>
                                                        </div>
                                                        <p class="help is-danger" v-if="errors.email" v-text="errors.email[0]"></p>
                                                    </div>

                                                    <div class="field">
                                                        <label for="password" class="has-text-black">@lang('index.password')</label>
                                                        <div class="control">
                                                            <input id="password" type="password" class="input" :class="{'is-danger': errors.email}" name="password" required>
                                                        </div>
                                                        <p class="help is-danger" v-if="errors.email" v-text="errors.email[0]"></p>
                                                    </div>

                                                    <input type="checkbox" name="remember" class="is-hidden" checked>

                                                    <div class="field">
                                                        <div class="control">
                                                            <button type="submit" class="button is-primary">
                                                                @lang('index.login')
                                                            </button>

                                                            <a class="button is-link has-text-black" href="/password/reset">
                                                                @lang('index.forget password')?
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
			},
			open() {
				this.errors = [];
				this.$refs.form.reset();
				this.isActive = true;
			}
		}
	}
</script>