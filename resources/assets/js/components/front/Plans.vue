<template>
	<div class="columns">
        <div class="column is-6 is-offset-3">
            
        </div>
    </div>
</template>

<script>
	export default {
		data() {
			return {
				plans: []
			}
		},
		created() {
			axios.get('/plans')
			.then( ({data}) => { console.log(data);
				this.plans = data;
			})
		}
	}
</script>