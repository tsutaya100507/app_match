<template>
  <section class="p-dms">
    <div class="l-sidebar">
      <Sidebar />
    </div>
    <div class="p-dms__content">
    <h1>DM一覧</h1>
      <div v-for="room in edited_rooms" :key="room.id">
        <RoomCard :room="room" />
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios'
import RoomCard from '../parts/RoomCard'
import Sidebar from '../layouts/Sidebar'

export default {
  props: [ 'user', 'rooms', 'edited_rooms'],
  components: {
    RoomCard, Sidebar
  },
  data() {
    return {
      
    }
  }
}
</script>
