<template>
  <section>
    <h1>新規投稿</h1>
    <project-form :user="user"/>
  </section>
</template>

<script>
import ProjectForm from '../parts/ProjectForm'

export default {
  props: ['user'],
  components: {
    ProjectForm
  },
}
</script>

