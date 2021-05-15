<template>
  <div>
    <span class="school-follow ms-sm-5 ms-2"><a style="cursor: pointer;" @click="switchLike()"><i class="far fa-heart fa-2x" v-bind:style="[bool === true ? styleTrue : styleFalse]"></i></a>{{ count }}</span>
    <div class="flash" v-if="show" style="color: red; display: inline-block;">{{ flash }}</div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      //データを保持
      count: '',
      bool: '',
      flash: '',
      show: false,
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
      axios.get('/like/' + this.school.id)
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
        this.flash = response.data.flash;
        this.showFlash();
      })
      .catch(function(error){
        console.log(error);
      });
    },
    showFlash() {
      this.show = true
      setTimeout(() => {
        this.show = false
      }, 3000)
    }
  }
}
</script>