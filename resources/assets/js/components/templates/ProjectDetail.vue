<template>
  <section class="p-pjdetail">
    <h1 class="p-pjdetail__title">{{ project.title }}</h1>
    <dl class="p-pjdetail__note">
      <dt>案件詳細</dt>
      <dd><p class="p-pjdetail__desc">{{ project.description }}</p></dd>
    </dl>
    <div class="p-pjdetail__terms">
      <dl class="p-pjdetail__note">
        <dt>案件タイプ</dt>
        <dd v-if="project.type == 0">レベニューシェア</dd>
        <dd v-else>単発案件</dd>
      </dl>
      <dl class="p-pjdetail__note" v-if="isReward">
        <dt>報酬額</dt>
        <dd>{{project.lower_price}}</dd>
      </dl>
      <dl class="p-pjdetail__note">
        <dt>投稿者</dt>
        <dd>{{project.name}}</dd>
        <div v-if="this.current_user.id != this.project.user_id">
          <a :href="'/dmroom/' + room[0].id" v-if="isRoom">DMページへ</a>
          <button v-on:click="createRoom" v-else>案件投稿者へのDMを送る</button>
        </div>      
      </dl>
    </div>
    <div class="p-pjdetail__btn">
      <div v-if="this.current_user.id != this.project.user_id">
        <span v-if="wasApplied" class="button button--info u-w100 u-fs16" disalbled>申し込み済み</span>
        <button v-on:click="doApply" v-else class="button button--primary u-w100 u-fs16">申し込んでみる</button>
      </div>
      <a :href="createUrl" class="button button--twitter u-w100 u-fs16">twitterでシェア</a>
    </div>
    <section class="p-pjdetail__message__area">
        <h2 class="p-pjdetail__message__title">メッセージ</h2>
        <ul v-for="message in messages" :key="message.id">
          <li>
            <MessageCard :message="message" />
          </li>
        </ul>
        <form action="">
          <textarea name="" id="" cols="30" rows="3" v-model="formData.message"></textarea>
          <button type="button" v-on:click="submitMessage">メッセージを送る</button>
        </form>
    </section>
  </section>
</template>

<script>
import axios from 'axios'
import MessageCard from '../parts/MessageCard'

export default {
  components: {
    MessageCard
  },
  props: ['project', 'current_user', 'room'],
  data() {
    return {
      messages: [],
      wasApplied: false,
      formData: {
        message: ""
      }
    }
  },
  computed: {
    // DMをやりとりするスペースが既にでいているかチェック
    isRoom() {
      if (this.room.length > 0) {
        return true
      } else {
        return false
      }
    },
    // レベニューシェア案件か単発案件かチェック
    isReward() {
      if (this.project.type === 0) {
        return false
      }
      return true
    },
    // twitterシェア用のurlを生成
    createUrl() {
      const text = `${this.project.title}\n${location.href}`
      const encodedTxt = encodeURIComponent(text)
      const url = `https://twitter.com/intent/tweet?text=${encodedTxt}`
      return url
    }
  },
  methods: {
    checkApplied() {
      const url = "/api/application"
      axios.get(url,{
        params: {
          user_id: this.current_user.id,
          project_id: this.project.id},
      })
      .then((res) => {
        if (res.data.length > 0) {
          this.wasApplied = true
        }
      })
    },
    // 案件への申し込み
    doApply() {
      const url = "/api/application/store"
      axios.post(url, {
        user_id: this.current_user.id,
        project_id: this.project.id,
        project_user_id: this.project.user_id
      })
      .then(() => {
        this.wasApplied = true
      })
    },
    // 案件に紐づくパブリックメッセージの取得
    getMessages() {
      const url = `/api/project/${this.project.id}/messages`
      axios.get(url)
        .then((res) => {
          this.messages = res.data
        })
    },
    // パブリックメッセージを投稿
    submitMessage() {
      const url = "/api/message"
      axios.post(url, {
        body: this.formData.message,
        user_id: this.current_user.id,
        project_id: this.project.id
      })
      .then((res) => {
        this.formData.message = ""
        this.messages = res.data
      })
    },
    createRoom() {
      const url = "/api/room/store"
      axios.post(url, {
        send_user_id: this.current_user.id,
        recieve_user_id: this.project.user_id,
      })
      .then((res) => {
        location.href = "/dmroom/" + res.data.id })
    }
  },
  mounted() {
    this.checkApplied()
    this.getMessages()
  }
}
</script>
