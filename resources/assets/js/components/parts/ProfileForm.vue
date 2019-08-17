<template>
  <form @submit.prevent="submitData" class="c-pjform">
    <div class="c-pjform__formgroup">
      <label for="name" class="c-profform__label">ユーザー名</label>
      <p v-if="errors.has('title')" class="p-profform__alert">
        {{ errors.first('title') }}
      </p>
      <input type="text" v-model="formData.name" v-validate="'required'">
      <!-- <textarea name="title" id="title" cols="100" rows="2" v-model="formData.name" v-validate="'required'"></textarea> -->
    </div>
    <div class="c-profform__formgroup">
      <label for="type" class="c-profform__label">メールアドレス</label>
      <input name="email" v-model="formData.email" v-validate="'required'">
    </div>
    <div class="c-profform__formgroup">
      <label for="intro" class="c-profform__label">職歴等</label>
      <p v-if="errors.has('title')" class="p-profform__alert">
        {{ errors.first('title') }}
      </p>
      <textarea name="intro" id="" rows="20" v-model="formData.intro"></textarea>
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
      console.log('its working')
    }
  }
}
</script>
