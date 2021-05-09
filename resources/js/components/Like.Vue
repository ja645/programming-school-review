<template>
  <div>
    <span class="school-follow ms-sm-5 ms-2"><a href="#" @click="switchLike()"><i class="far fa-heart fa-2x" v-bind:style="[bool === true ? styleTrue : styleFalse]"></i></a>{{ count }}</span>
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
        color: "red",
      },
      styleFalse: {
        color: "gray"
      }
    }
  },
  props: ['school'],
  mounted() {
      axios.get('/like/' . this.school.id)
      .then(response => {
        this.bool = response.data.bool;
        this.count = response.data.count;
      })
      .catch(function(error){
        console.log(error);
      });
  },
  methods: {
    switchLike() {
      axios.post('/like', {
        schoolId : this.school.id
      })
      .then(response => {
        this.bool = response.data.bool;
        this.count = response.data.count;
      })
      .catch(function(error){
        console.log(error);
      });
    }
  }
}
</script>