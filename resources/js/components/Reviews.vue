<template>
  <div class="ranking-order d-flex justify-content-end">
    <label for="並べ替え">並べ替え：</label>
    <select class="form-select" aria-label="並べ替え">
      <option selected @click="showRevewList(1)">新しい順</option>
      <option value="1" @click="showReviewList(-1)">古い順</option>
    </select>
  </div>

  <div class="ranking-list">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="created_at" data-bs-toggle="tab" href="#created_at" role="tab" aria-controls="created_at" aria-selected="true">投稿日</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div v-if="toggle" class="tab-pane fade show active" id="created_at" role="tabpanel" aria-labelledby="created_at">
        <a v-bind:href="'/reviews/' +review.id" class="list-group-item list-group-item-action" v-for="review in reviews">{{ review }}</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //データを保持
      reviews : [],
    }
  },
  mounted() {
    axios.post('/api/reviews', {
      'c' : 'total_judg'
    })
    .then(response => this.reviews = response.data);
  },
  methods: {
    showReviewList(columnName) {
      axios.get('/api/rankings')
      .then(response => this.reviews = response.data);
    },
    sortReviewsDescByDate: function () {
      return this.reviews.sort((a, b) => {
        return new Date(b) - new Date(a);
      });
    },
    sortReviewsAscByDate: function () {
      return this.reviews.sort((a, b) => {
        return new Date(a) - new Date(b);
      });
    },
  }
}
</script>