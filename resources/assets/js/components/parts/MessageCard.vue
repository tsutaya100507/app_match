<template>
  <div class="c-msgcard">
    <p class="c-msgcard__body">{{message.body}}</p>
    <div>投稿者：{{message.name}}</div>
  </div>
</template>

<script>
export default {
  name: 'MessageCard',
  props: ['message']
}
</script>
