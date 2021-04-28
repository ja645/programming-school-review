<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1>メッセージ</h1>
        <ul>
          <li v-for="message in messages">{{ message['message'] }}</li>
        </ul>
        <input type="text" v-model="newMessage" @blur="addMessage">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      messages : [],
      newMessage : ''
    }
  },
  mounted() {
   axios.get('/api/reviews').then(response => (this.messages = response.data));
    window.Echo.channel('chat').listen('MessageSent', response => {
      this.messages.push(response.message);
    });
  },
  methods: {
    addMessage() {
      axios.post('/api/reviews/message', {
        message : this.newMessage
      })
      .then(response => this.messages.push(response.data));
      this.newMessage = '';
    }
  }
}
</script>
