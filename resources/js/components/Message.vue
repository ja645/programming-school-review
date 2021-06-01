<template>
  <div class="col-11 mx-auto reviews-card p-5">
    <p>コメント</p>
    <div class="review-list" style="padding-bottom: 0;">
      <p class="message-list" v-for="message in messages">
        <!-- メッセージの投稿者がレビューの投稿者だった場合は表示を切り替える -->
        <span v-if="message.user.id == review['user_id']" style="font-size: 14px; color: gray;">{{ message.user.user_name }}さん(投稿者）:</span>
        <span v-else style="font-size: 14px; color: gray;">{{ message.user.user_name }}さん:</span>
        <br>{{ message.message }}
      </p>
    </div>
  </div>
  <div class="col-11 mx-auto reviews-card p-5">
    <!-- 現在のユーザーがレビューの投稿者だった場合は表示を切り替える -->
    <p v-if="auth == review['user_id']">質問に回答してみましょう！</p>
    <p v-else>{{ review.user.user_name }}さんに質問してみましょう！</p>
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
  props: {
    review: {
    },
    auth: {
    }
  },
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
