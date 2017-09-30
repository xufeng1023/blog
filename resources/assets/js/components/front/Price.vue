<template>
	<article class="message plan" :class="[color]">
        <div class="message-header fd-v">
            <p>{{ plan }}</p>
            <div class="flex">
                <sup class="is-size-5">$</sup>
                <span class="is-size-1">{{ price }}</span>
            </div>
        </div>
        <div class="message-body">
            <div class="fc fd-v">
                <p class="is-size-6 has-text-grey has-text-weight-semibold">watch all videos</p>
                <p class="is-size-6 has-text-grey has-text-weight-semibold field">billed until cancel</p>
                <button type="button" class="button" :class="[color]" @click="choose">
                    <span class="icon is-small" v-if="chozen">
                        <i class="fa fa-check fa-lg"></i>
                    </span>
                    <span v-if="show">choose</span>
                </button>
                <input type="radio" name="plan" class="is-hidden" :value="plan" ref="radio">
            </div>
        </div>
    </article>
</template>
<script>
	export default {
		props: ['price','color','plan'],
		data() {
			return {
				chozen: false,
				show: true
			}
		},
		created() {
			Bus.$on('switch', this.change);
		},
		methods: {
			choose() {
				this.chozen = true;
				this.show = false;
				this.$refs.radio.checked = true;
				Bus.$emit('switch', this.plan);
			},
			change(plan) {
				if(plan != this.plan) {
					this.chozen = false;
					this.show = true;
					this.$refs.radio.checked = false;
				}
			}
		}
	}
</script>