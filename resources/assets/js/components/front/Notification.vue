<template>
	<div class="notification" :class="[color]" v-if="show">
		<button class="delete" @click="show = ''"></button>
 	 	{{ msg }}
	</div>
</template>

<script>
	export default {
		props: ['msg', 'color'],
		data() {
			return {
				show: this.msg
			}
		}
	}
</script>