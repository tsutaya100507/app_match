<template>
  <section>
    <h1>DM一覧</h1>
    {{user.name}}
    {{edited_rooms}}
  </section>
</template>

<script>
import axios from 'axios'

export default {
  props: [ 'user', 'rooms', 'edited_rooms'],
  data() {
    return {
      
    }
  }
}
</script>
