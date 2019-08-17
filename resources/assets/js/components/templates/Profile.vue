<template>
  <section class="p-mypage">
    <div class="l-sidebar">
      <Sidebar />
    </div>
    <div class="p-mypage__wrapper">
      <h1>マイページ</h1>
      <dl>
        <dt>ユーザー名</dt>
        <dd>{{user.name}}</dd>
        <dt>メールアドレス</dt>
        <dd>{{user.email}}</dd>
        <dt>職歴等</dt>
        <dd>{{user.intro}}</dd>
      </dl>
      <a href="/profile/edit" class="button button--primary">プロフィールを編集する</a>
    </div>
  </section>
</template>


<script>
import axios from 'axios'
import Sidebar from '../layouts/Sidebar'

export default {
  props: ["user"],
  components: {
    Sidebar
  }
}
</script>
