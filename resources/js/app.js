require('./bootstrap');
require('alpinejs');
import { create } from 'lodash';
import {createApp} from 'vue/dist/vue.esm-bundler.js';
import MessageComponent from './components/Message.vue';
import RankingComponent from './components/Ranking.vue';
import ReviewsComponent from './components/Reviews.vue';
import LikeComponent from './components/Like.vue';

createApp({
  components: {
    MessageComponent
  }
}).mount('#app');

createApp({
  components: {
    RankingComponent
  }
}).mount('#rankings');

createApp({
  components: {
    ReviewsComponent
  }
}).mount('#reviews');

createApp({
  components: {
    LikeComponent
  }
}).mount('#like');