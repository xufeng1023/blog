<template>
    <a class="navbar-item" href="/login" @click.prevent="open">{{ text }}</a>
</template>
<script>
	export default {
        data() {
            return {
                text: window.lan.login
            }
        },
		methods: {
			open() {
				Bus.$emit('login');
			}
		}
	}
</script>