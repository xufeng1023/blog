<template>
	<article class="message hand" :class="[chozen]" @click="choose" @mouseenter="onEnter" @mouseleave="onLeave">
        <div class="message-header fd-v">
            <div class="flex">
                <sup class="is-size-5">$</sup>
                <span class="is-size-1">{{ planText.price }}<sub class="is-size-5">/{{ planText.unit }}</sub></span>
            </div>
        </div>
        <div class="message-body has-text-centered has-text-grey is-size-6">
            <p>{{ planText.desc }}</p>
            <p>{{ planText.time }}</p>
            <p>{{ planText.cancel }}</p>
            <input type="radio" name="plan" class="is-hidden" :value="planText.id" ref="radio">
        </div>
    </article>
</template>
<script>
	export default {
		props: ['color','plan'],
		data() {
			return {
				chooseText: window.lan.choose,
				planText: window.lan[this.plan],
				chozen: '',
				show: true
			}
		},
		created() {
			Bus.$on('switch', this.change);
		},
		methods: {
			onEnter() {
				this.chozen = this.color;
			},
			onLeave() {
				if(this.show) {
					this.chozen = '';
				}
			},
			choose() {
				this.chozen = this.color;
				this.show = false;
				this.$refs.radio.checked = true;
				Bus.$emit('switch', this.plan);
				Bus.$emit('total', this.planText.label);
			},
			change(plan) {
				if(plan != this.plan) {
					this.chozen = '';
					this.show = true;
					this.$refs.radio.checked = false;
				}
			}
		}
	}
</script>