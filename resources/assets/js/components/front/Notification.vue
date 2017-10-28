<template>
	<div class="notification" :class="[color]" v-if="show">
 	 	{{ body }}
	</div>
</template>

<script>
	export default {
		props: ['msg', 'color'],

        data() {
            return {
                body: '',
                show: false
            }
        },

        created() {
            if (this.msg) {
                this.flash(this.msg);
            }

            Bus.$on(
                'notify', message => this.flash(message)
            );
        },

        methods: {
            flash(message) {
                this.body = message;
                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
	}
</script>