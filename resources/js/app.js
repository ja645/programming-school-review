require('./bootstrap');
require('alpinejs');
import {createApp} from 'vue/dist/vue.esm-bundler.js';
import MessageComponent from './components/Message.vue';

createApp({
  components: {
    MessageComponent
  }
}).mount('#app');