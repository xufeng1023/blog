
window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

window.Vue = require('vue');

window.Bus = new Vue();

window.api = 'http://127.0.0.2:8000/api/';
window.noapi = 'http://127.0.0.2:8000/';

Vue.component('videoOne', require('./components/front/VideoOne.vue'));
Vue.component('videoFrame', require('./components/front/VideoFrame.vue'));
Vue.component('imageOne', require('./components/front/ImageOne.vue'));
Vue.component('imageModal', require('./components/front/ImageModal.vue'));
Vue.component('changePlan', require('./components/front/ChangePlan.vue'));
Vue.component('updateCard', require('./components/front/UpdateCard.vue'));
Vue.component('cancel', require('./components/front/Cancel.vue'));
Vue.component('card', require('./components/front/Card.vue'));
Vue.component('join', require('./components/front/Join.vue'));

Vue.filter('FILE', (value) => { return '/storage/' + value; });

const app = new Vue({
    el: '#app'
});
