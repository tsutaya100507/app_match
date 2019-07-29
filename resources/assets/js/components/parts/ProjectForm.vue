<template>
  <form @submit.prevent="submitData">
    <div>
      <label for="title">タイトル</label>
      <small>発注する案件のタイトルを入力してください。</small>
      <input type="text" v-model="formData.title">
      {{formData.title}}
    </div>
    <div>
      <label for="">種別</label>
      <small>レベニューシェアか単発で報酬を支払う案件か選択してください。</small>
      <select name="type" id="" v-model="formData.type">
        <option value="0">レベニューシェア</option>
        <option value="1">単発案件</option>        
      </select>
    </div>
    <div>
      <label for="price">報酬額</label>
      <small>レベニューシェアか単発で報酬を支払う案件か選択してください。</small>
      <input type="text" name="lower_price" v-model="formData.price.lower">千円~
      <input type="text" name="upper_price" v-model="formData.price.upper">千円
    </div>
    <div>
      <label for="content">内容</label>
      <small>発注する案件の内容を入力してください。</small>
      <textarea name="" id="" cols="30" rows="10"  v-model="formData.description"></textarea>
    </div>
    <div>
      <button type="button" v-on:click="submitData">案件投稿</button>
    </div>
  </form>
</template>

<script>
import axios from 'axios'

export default {
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
    submitData: function() {
      console.log(this.formData.title)
            console.log(this.formData.content)
                  console.log(this.formData.type)
      const data = {
        title: this.formData.title,
        type:  this.formData.type,
        lower_price: this.formData.price.lower,
        upper_price: this.formData.price.upper,
        description: this.formData.description,
        user_id: 1,
      }
      axios.post('/project/store', data)
        .then((res) => { location.href = "/"  })
        .catch((error) => { alert("投稿が失敗しました。") })
    }
  }
}
</script>
