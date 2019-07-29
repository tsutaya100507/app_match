<template>
  <section>
  <div v-for="message in messages" :key="message.id">
    <DmCard :message="message" />
  </div>
  <form @submit.prevent="createDm">
    <textarea name="" id="" cols="30" rows="1" v-model="formData.body"></textarea>
    <button type="button" v-on:click="createDm">送信</button>
  </form>
  </section>
</template>

<script>
import axios from 'axios'
import DmCard from '../parts/DmCard'

export default {
  props: [ 'room', 'user' ],
  components: {
    DmCard
  },
  data() {
    return {
      messages: [],
      formData: {
        body: ""
      },
    }
  },
  methods: {
    getDms() {
      console.log("ssss")
      const url = "/api/dms"
      axios.get(url, {
        params: {
          room_id: this.room[0].id
        }
      })
      .then((res) => {
        console.log(res.data)
        this.messages = res.data
      })
    },
    createDm() {
      const url = "/api/dm"
      console.log(this.formData.body)
      axios.post(url, {
        body: this.formData.body,
        user_id: this.user.id,
        room_id: this.room[0].id
      })
      .then((res) => {
        console.log(res.data)
        this.messages = res.data
        this.formData.body = ""
      })
    }
  },
  mounted() {
    console.log("aaaaa")
    this.getDms()
  }
}
</script>
