<template>
  <div class="col-11 mx-auto school-reviews-card p-5">
    <p>コメント</p>
    <div class="review-list">
      <p class="list-group-item" v-for="message in messages">{{ message['message'] }}</p>
    </div>
  </div>
  <div class="col-11 mx-auto school-reviews-card p-5">
    <p>hoge太郎さんに質問してみましょう！</p>
    <div class="review-list">
      <textarea type="text" class="message-text" style="border: solid 2px rgba(#003366, 0.6); padding: 15px 10px; background-color: #fff;border: solid 2px rgba(0, 51, 102, 0.6); outline: none" v-model="newMessage"></textarea>
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
  mounted() {
    //htmlリクエストを送り、レスポンスであるresponse.dataをthis.messageに代入
    axios.get('/reviews').then(response => (this.messages = response.data));

    window.Echo.channel('chat').listen('MessageSent', response => {
      this.messages.push(response.message);
    });
  },
  methods: {
    addMessage() {
      axios.post('/reviews/message', {
        message : this.newMessage
      })
      .then(response => this.messages.push(response.data));
      this.newMessage = '';
    }
  }
}
</script>
