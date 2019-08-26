<template>
  <section class="p-dmroom">
  <div class="p-dmroom__partner">{{partnerName}}</div>
  <div v-for="message in messages" :key="message.id">
    <DmCard :message="message" />
  </div>
  <form @submit.prevent="createDm">
    <textarea name="" id="" cols="30" rows="2" v-model="formData.body"></textarea>
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
      partnerName: "",
      formData: {
        body: ""
      },
    }
  },
  methods: {
    getDms() {
      const url = "/api/dms"
      axios.get(url, {
        params: {
          room_id: this.room.id
        }
      })
      .then((res) => {
        this.messages = res.data
      })
    },
    createDm() {
      const url = "/api/dm"
      axios.post(url, {
        body: this.formData.body,
        user_id: this.user.id,
        room_id: this.room.id
      })
      .then((res) => {
        this.messages = res.data
        this.formData.body = ""
      })
    },
    getPartnerName() {
      const url = "/api/dm/get_partner_name"
      axios.get(url, {
        params: {
          user_id: this.user.id,
          room_id: this.room.id
        }
      })
      .then((res) => {
        this.partnerName = res.data
      })
    }
  },
  mounted() {
    this.getPartnerName()
    this.getDms()
  }
}
</script>
