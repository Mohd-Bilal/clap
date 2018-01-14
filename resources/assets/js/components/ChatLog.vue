<template lang="html">
  <ol class="chat">
      <chat-message v-for="message in messages" :message="message"></chat-message>
      <div class="empty" v-show="messages.length === 0">
          Lets Build SOmEtHiNg great!
      </div>
  </ol>
</template>

<script>
export default {
    props: ['messages']
}
</script>

<style lang="css">
.chat-log .chat-message:nth-child(even) {
    background-color: #ccc;
}
</style>
