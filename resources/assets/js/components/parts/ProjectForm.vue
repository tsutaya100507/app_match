<template>
  <form @submit.prevent="submitData" class="c-pjform">
    {{user}}
    <div class="c-pjform__formgroup">
      <label for="title" class="c-pjform__label">タイトル</label>
      <small>発注する案件のタイトルを入力してください。</small>
      <p v-if="errors.has('title')" class="p-pjform__alert">
        {{ errors.first('title') }}
      </p>
      <textarea name="title" id="title" cols="100" rows="2" v-model="formData.title" v-validate="'required'"></textarea>
    </div>
    <div class="c-pjform__formgroup">
      <label for="type" class="c-pjform__label">種別</label>
      <small>レベニューシェアか単発で報酬を支払う案件か選択してください。</small>
      <select name="type" id="type" v-model="formData.type">
        <option value="0">レベニューシェア</option>
        <option value="1">単発案件</option>        
      </select>
    </div>
    <div class="c-pjform__formgroup">
      <label for="price" class="c-pjform__label">報酬額</label>
      <small>レベニューシェアか単発で報酬を支払う案件か選択してください。</small>
      <input type="text" name="lower_price" v-model="formData.price.lower">千円~
      <input type="text" name="upper_price" v-model="formData.price.upper">千円
    </div>
    <div class="c-pjform__formgroup">
      <label for="content" class="c-pjform__label">内容</label>
      <small>発注する案件の内容を入力してください。</small>
      <p v-if="errors.has('title')" class="p-pjform__alert">
        {{ errors.first('title') }}
      </p>
      <textarea name="" id="" rows="20"  v-model="formData.description" v-validate="'required'"></textarea>
    </div>
    <div class="c-pjform__formgroup">
      <button type="button" v-on:click="validateData" class="c-pjform__postbtn">案件投稿</button>
    </div>
  </form>
</template>

<script>
import axios from 'axios'

export default {
  props: [ 'user' ],
  data() {
    return {
      formData: {
        title:   "",
        type:    0,
        price:   {
          lower: 0,
          upper: 0,
        },
        description: "",
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
    submitData: function() {
      console.log(this.formData.title)
      console.log(this.formData.content)
      console.log(this.formData.type)
      console.log(this.user.id)
      const data = {
        title: this.formData.title,
        type:  this.formData.type,
        lower_price: this.formData.price.lower,
        upper_price: this.formData.price.upper,
        description: this.formData.description,
        user_id: this.user.id,
      }
      axios.post('/project/store', data)
        .then((res) => { location.href = "/"  })
        .catch((error) => { alert("投稿が失敗しました。") })
    }
  }
}
</script>
