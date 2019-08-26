<template>
  <div class="c-dmcard">
    <img :src="message.image_path" alt="" class="c-dmcard__image">
    <div class="c-dmcard__text">
      <span class="c-dmcard__user">{{message.name}}</span>
      <span>{{message.created_at}}</span>
      <p class="c-dmcard__message">{{message.body}}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: [ "message" ]
}
</script>
