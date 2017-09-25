<template>
	<div class="notification is-danger" v-if="msg">
 	 	{{ msg }}
	</div>
</template>

<script>
	export default {
		props: ['msg']
	}
</script>