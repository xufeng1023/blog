
window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    token.remove();
}

let apiToken = document.head.querySelector('meta[name="api-token"]');

if (apiToken) {
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + apiToken.content;
    apiToken.remove();
}

let api = document.head.querySelector('meta[name="api"]');

if (api) {
    window.api = api.content + '/api/';
    api.remove();
}

window.Vue = require('vue');

window.Bus = new Vue();

Vue.component('videoOne', require('./components/front/VideoOne.vue'));
Vue.component('videoFrame', require('./components/front/VideoFrame.vue'));
Vue.component('imageOne', require('./components/front/ImageOne.vue'));
Vue.component('imageModal', require('./components/front/ImageModal.vue'));
Vue.component('changePlan', require('./components/front/ChangePlan.vue'));
Vue.component('updateCard', require('./components/front/UpdateCard.vue'));
Vue.component('cancel', require('./components/front/Cancel.vue'));
Vue.component('join', require('./components/front/Join.vue'));
Vue.component('login', require('./components/front/Login.vue'));
Vue.component('notify', require('./components/front/Notification.vue'));
Vue.component('resume', require('./components/front/Resume.vue'));
Vue.component('subscribe', require('./components/front/Subscribe.vue'));
Vue.component('invoices', require('./components/front/Invoices.vue'));

Vue.filter('FILE', (value) => { return '/storage/' + value; });

const app = new Vue({
    el: '#app',
    mounted() {
		this.navBarInit();
	},
	methods: {
		navBarInit() {
			var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

			if ($navbarBurgers.length > 0) {
	    		$navbarBurgers.forEach(function ($el) {
	      			$el.addEventListener('click', function () {
	        			var target = $el.dataset.target;
	        			var $target = document.getElementById(target);

	        			$el.classList.toggle('is-active');
	        			$target.classList.toggle('is-active');
	      			});
	    		});
	  		}
		}
	}
});
