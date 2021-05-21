<template>
  <div class="col-11 mx-auto reviews-card p-5">
    <p>コメント</p>
    <div class="review-list">
      <p class="list-group-item" v-for="message in messages">{{ message['message'] }}</p>
    </div>
  </div>
  <div class="col-11 mx-auto reviews-card p-5">
    <p>{{ review.user.user_name }}さんに質問してみましょう！</p>
    <div class="review-list">
      <textarea type="text" style="width: 100%; height: 48px; font-size: 24px; border: solid 2px #FF5192; padding: 15px 10px; background-color: #fff; outline: none" v-model="newMessage"></textarea>
      <button type="button" class="btn btn-success message-send" @click="addMessage">送信</button>
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
    axios.get('/message').then(response => (this.messages = response.data));

    window.Echo.channel('chat').listen('MessageSent', response => {
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
      console.log(this.review.id);
      this.newMessage = '';
    }
  }
}
</script>
