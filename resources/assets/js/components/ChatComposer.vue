<template lang="html">
  <div class="typezone">
      <!-- <input type="text" placeholder="Start typing your message..." v-model="messageText" @keyup.enter="sendMessage"> -->
      <textarea name="message" rows="2" v-model="messageText" required autocomplete="off"></textarea>
      <button class="btn btn-primary" @click="sendMessage">Send</button>
  </div>
</template>

<script>
export default {
    data() {
        return {
            messageText: ''
        }
    },
    methods: {
        sendMessage() {
            this.$emit('messagesent', {
                message: this.messageText,
                user: {
                  username: "you" ,
                }
            });
            this.messageText = '';
        }
    }
}
</script>

<style lang="css">
.chat-composer {
    display: flex;
}
textarea {
    width:85%;
}
.chat-composer button {
    border-radius: 3px;
    padding: 15%;
}
</style>
