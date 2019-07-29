<template>
  <span>
    {{message.body}}
    {{message.name}}
  </span>
</template>

<script>
export default {
  name: 'MessageCard',
  props: ['message']
}
</script>
