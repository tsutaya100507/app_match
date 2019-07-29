<template>
  <section>
    <h1>投稿案件一覧</h1>
    <ul v-for="project in projects" :key="project.id">
      <li>
        <ProjectCard :project="project" />
      </li>
    </ul>
  </section>
</template>

<script>
import axios from 'axios'
import ProjectCard from '../parts/ProjectCard'

export default {
  props: [ 'user' ],
  components: {
    ProjectCard
  },
  data() {
    return {
      projects: []
    }
  },
  methods: {
    getPostedProject() {
      console.log(this.user.id)
      const url = "/api/user/projects"
      axios.get(url, {
        params: {
          user_id: this.user.id
        }
      })
      .then((res) => {
        this.projects = res.data
      })
    }
  },
  mounted() {
    this.getPostedProject()
  }
}
</script>
