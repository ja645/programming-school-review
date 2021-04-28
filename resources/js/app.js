require('./bootstrap');
require('alpinejs');

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import MessageComponent from './components/Message.vue';

createApp({
  components: {
    MessageComponent
  }
}).mount('#app');

// window.createApp = createApp;

// window.MessageComponent = require('./components/Message.vue').default;
// Vue.component('message-list', require('./components/Message.vue').default);

// const app = new Vue({
//   el: '#app',
//   components: {
//     Message
//   }
// });