<template>
    <a href="/login" @click.prevent="open">{{ btnText }}</a>
</template>
<script>
	export default {
		props: ['btnText'],
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