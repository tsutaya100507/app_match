<template>
  <div>
    <a :href="'/dmroom/' + room.id">
      {{room.userName}}
    </a>
  </div>
</template>

<script>
export default {
  props: [ "room" ]
}
</script>
