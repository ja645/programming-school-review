<template>
  <div class="col-11 mx-auto reviews-card p-5">
    <p>コメント</p>
    <div class="review-list">
      <p class="list-group-item" style="height: 40px; font-size: 18px; border: solid 2px #FF5192; padding: 5px 10px;" v-for="message in messages">{{ message['message'] }}</p>
    </div>
  </div>
  <div class="col-11 mx-auto reviews-card p-5">
    <p>{{ review.user.user_name }}さんに質問してみましょう！</p>
    <div class="review-list message-form">
      <textarea type="text" style="width: 100%; height: 40px; font-size: 18px; border: solid 2px #FF5192; padding: 10px 10px; background-color: #fff; outline: none" v-model="newMessage"></textarea>
      <button type="button" class="btn btn-success message-send" @click="addMessage"><i class="fas fa-2x fa-paper-plane"></i></button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //データを保持
      messages : [],
      newMessage : ''
    }
  },
  props: ['review'],
  mounted() {
    //htmlリクエストを送り、レスポンスであるresponse.dataをthis.messageに代入
    axios.get('/message/' + this.review.id).then(response => (this.messages = response.data));

    window.Echo.private('chat.' + this.review.id).listen('MessageSent', response => {
      this.messages.push(response.message);
    });
  },
  methods: {
    addMessage() {
      axios.post('/message/send', {
        reviewId : this.review.id,
        message : this.newMessage
      })
      .then(response => this.messages.push(response.data));
      this.newMessage = '';
    }
  }
}
</script>
