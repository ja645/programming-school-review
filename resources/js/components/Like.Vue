<template>
  <div>
    <span class="school-follow ms-sm-5 ms-2"><a href="#" @click="likeOrUnlike(propUserId)"><i class="far fa-heart fa-2x"></i></a>{{ propSchoolLikes }}{{ propUserId }}</span>
  </div>
</template>

<script>
export default {
  props: {
    propSchoolLikes: {},
    propUserId: {},
  },
  method: {
    likeOrUnlike() {
      axios.post('/api/like', {
        userId : this.propUserId
      })
    }
  }
}
</script>