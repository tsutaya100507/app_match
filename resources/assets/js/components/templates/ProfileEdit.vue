<template>
  <section>
    <h1>プロフィール編集</h1>
    <ProfileForm :user="user" />
  </section>
</template>

<script>
import ProfileForm from '../parts/ProfileForm'

export default {
  props: ['user'],
  components: {
    ProfileForm
  },
}
</script>
