<template>
	<form @submit.prevent="change">
		<plans :current="this.user.plan"></plans>
		<button type="submit" class="button is-primary">Change</button>
	</form>
</template>

<script>
	import plans from './Plans.vue';

	export default {
		props: ['user'],
		components: {plans}
	}
</script>