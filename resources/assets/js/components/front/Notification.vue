<template>
	<div class="notification" :class="[color]" v-if="msg">
 	 	{{ msg }}
	</div>
</template>

<script>
	export default {
		props: ['msg', 'color'],
	}
</script>