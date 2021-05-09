<template>
  <div>
    <span class="school-follow ms-sm-5 ms-2"><a style="cursor: pointer;" @click="switchFollow()"><i class="far fa-thumbs-up fa-2x" v-bind:style="[bool === true ? styleTrue : styleFalse]"></i></a>{{ count }}</span>
  </div>
</template>
<script>
export default {
  data() {
    return {
      //データを保持
      count: '',
      bool : '',
      styleTrue: {
        color: "green",
      },
      styleFalse: {
        color: "gray"
      }
    }
  },
  props: ['review'],
  mounted() {
      axios.get('/follow/' + this.review.id)
      .then(response => {
        this.bool = response.data.bool;
        this.count = response.data.count;
      })
      .catch(function(error){
        console.log(error);
      });
      console.log(this.count);
  },
  methods: {
    switchFollow() {
      axios.post('/follow', {
        reviewId : this.review.id
      })
      .then(response => {
        this.bool = response.data.bool;
        this.count = response.data.count;
      })
      .catch(function(error){
        console.log(error);
      });
      console.log(this.count);
    }
  }
}
</script>