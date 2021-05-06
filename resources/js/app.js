require('./bootstrap');
require('alpinejs');
import {createApp} from 'vue/dist/vue.esm-bundler.js';
import MessageComponent from './components/Message.vue';
import RankingComponent from './components/Ranking.vue';

createApp({
  components: {
    MessageComponent
  }
}).mount('#app');

createApp({
  components: {
    RankingComponent
  }
}).mount('#app2');