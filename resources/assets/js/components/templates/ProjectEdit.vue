<template>
  <section>
    <h1>案件編集</h1>
    <ProjectEditForm :project="project" :user="user" />
  </section>
</template>

<script>
import ProjectEditForm from '../parts/ProjectEditForm'

export default {
  props: ['user', 'project'],
  components: {
    ProjectEditForm
  }
}
</script>