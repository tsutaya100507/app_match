<template>
  <section class="p-pjlist">
    <h1 v-on:click="getProjects">案件一覧</h1>
    <ul v-for="project in projects" :key="project.id">
      <ProjectCard :project="project" />
    </ul> 
  </section>
</template>

<script>
import axios from 'axios'

import ProjectCard from '../parts/ProjectCard'

export default {
  components: {
    ProjectCard
  },
  data() {
    return {
      projects: []
    }
  },
  methods: {
    getProjects() {
      axios.get('/api/projects')
      .then((res) => {
        console.log(res.data)
        this.projects = res.data
      })
      .catch((error) => {
        alert('データの取得に失敗しました。')
      })
    }
  },
  mounted() {
    this.getProjects()
  }
}
</script>

