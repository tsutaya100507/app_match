<template>
  <form @submit.prevent="submitData" class="c-profform">
    <div class="c-profform__formgroup">
      <label for="name" class="c-profform__label">ユーザー名</label>
      <p v-if="errors.has('title')" class="p-profform__alert">
        {{ errors.first('title') }}
      </p>
      <input type="text" v-model="formData.name" v-validate="'required'" class="c-profform__input">
    </div>
    <div class="c-profform__formgroup">
      <label for="type" class="c-profform__label">メールアドレス</label>
      <input name="email" v-model="formData.email" v-validate="'required'" class="c-profform__input">
    </div>
    <div class="c-profform__formgroup">
      <label for="intro" class="c-profform__label">職歴等</label>
      <textarea name="intro" id="" rows="10" v-model="formData.intro"></textarea>
    </div>
    <div class="c-profform__formgroup">
      <button type="button" v-on:click="validateData" class="c-profform__postbtn">案件投稿</button>
    </div>
  </form>
</template>

<script>
export default {
  props: ['user'],
  data() {
    return {
      formData: {
        name: this.user.name,
        email: this.user.email,
        intro: this.user.intro,
      }
    }
  },
  methods: {
    validateData() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.submitData()
        }
      })
    },
    submitData() {
      const url  = '/api/profile'
      const data = {
        id: this.user.id,
        name: this.formData.name,
        email: this.formData.email,
        intro: this.formData.intro
      }
      axios.patch(url, data)
      .then((res)    => { 
        location.href = "/profile" 
        alert('プロフィールを更新しました。')
      })
      .catch((error) => { alert("投稿が失敗しました。") })
    }
  }
}
</script>
