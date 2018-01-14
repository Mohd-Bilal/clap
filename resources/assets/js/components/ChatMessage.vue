<template lang="html">
  <div class="chat-message">


    <li class="other">
      <div class="msg">
          <div class="user">{{ message.user.username }}<span class="range admin">Admin</span></div>
          <p>{{ message.message }}</p>
          
        <time>20:17</time>
      </div>
    </li>
  </div>
</template>

<script>
export default {
    props: ['message']
}
</script>
