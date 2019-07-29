<template>
  <section>
    <h1>DM一覧</h1>
    <div v-for="room in edited_rooms" :key="room.id">
      <RoomCard :room="room" />
    </div>
  </section>
</template>

<script>
import axios from 'axios'
import RoomCard from '../parts/RoomCard'

export default {
  props: [ 'user', 'rooms', 'edited_rooms'],
  components: {
    RoomCard
  },
  data() {
    return {
      
    }
  }
}
</script>
