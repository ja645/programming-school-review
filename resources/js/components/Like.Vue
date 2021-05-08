<template>
  <div>
      <span class="school-follow ms-sm-5 ms-2"><a href="#" @click=""><i class="far fa-heart fa-2x"></i></a>{{ propSchoolLikes }}</span>
    @if($school->is_liked_by_auth_user())
    @else
      <span class="school-follow ms-sm-5 ms-2"><a href="#" @click=""><i class="far fa-heart fa-2x"></i></a>{{ propSchoolLikes }}</span>
    @endif
  </div>
</template>

<script>
export default {
  props: {
    propSchoolLikes: {}
  },
}
</script>