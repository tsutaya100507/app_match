<template>
  <form @submit.prevent="submitData" class="c-profform">
    <div class="c-profform__formgroup">
      <input type="file" @change="fileSelected" mulitple="multiple">
    </div>
    {{formData.image}}
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
        image: '',
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
    fileSelected(event) {
      console.log(event)
      this.formData.image = event.target.files[0]
    },
    submitData() {
      const url  = '/api/profile'
      
      // 画像ファイルを含めてサーバーに送信するデータを定義
      const params = new FormData();
      params.append('file',this.formData.image)
      params.append('id', this.user.id)
      params.append('name', this.formData.name)
      params.append('email', this.formData.email)
      params.append('intro', this.formData.intro)
      
      const config = { headers: { 'Content-Type': 'multipart/form-data' } };
      axios.post(url, params, config)
      .then((res)    => { 
        location.href = "/profile" 
        alert('プロフィールを更新しました。')
      })
      .catch((error) => { alert("投稿が失敗しました。") })
    }
  }
}
</script>
