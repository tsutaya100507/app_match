<template>
  <form @submit.prevent="submitData" class="c-pjform">
    
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
        <option v-for="option in formData.typeOptions" v-bind:value="option.value" :key="option.value">
        {{ option.text }}
        </option>
      </select>
    </div>
    
    <div class="c-pjform__formgroup" v-if="isReward">
      <label for="price" class="c-pjform__label">報酬額</label>
      <small>想定する報酬額の範囲を入力してください。</small>
      <p v-if="errors.has('lower_price')" class="p-pjform__alert">
        {{ errors.first('lower_price') }}
      </p>
      <input type="text" name="lower_price" id="lower_price" v-model="formData.price.lower" v-validate="'min_value:1'">千円~
      <input type="text" name="upper_price" id="lower_price" v-model="formData.price.upper" v-validate="'min_value:1'">千円
    </div>
    
    <div class="c-pjform__formgroup">
      <label for="content" class="c-pjform__label">内容</label>
      <small>発注する案件の内容を入力してください。</small>
      <p v-if="errors.has('description')" class="p-pjform__alert">
        {{ errors.first('description') }}
      </p>
      <textarea name="description" id="description" rows="20"  v-model="formData.description" v-validate="'required'"></textarea>
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
        typeOptions: [
          {text: "レベニューシェア", value: 0},
          {text: "単発案件", value: 1}
        ],
        price:   {
          lower: 0,
          upper: 0,
        },
        description: "",
      }
    }
  },
  computed: {
    isReward() {
      if (this.formData.type == 1) {
        return true
      }
      return false
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
        .then((res) => {
          alert('投稿が完了しました。')
          location.href = "/"
        })
        .catch((error) => { alert("投稿が失敗しました。") })
    }
  }
}
</script>
