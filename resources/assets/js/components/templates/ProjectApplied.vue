<template>
  <section class="p-pjapplied">
    <div class="l-sidebar">
      <Sidebar />
    </div>
    <h1>申し込み案件一覧</h1>
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
import Sidebar from '../layouts/Sidebar'

export default {
  components: {
    ProjectCard, Sidebar
  },
  data() {
    return {
      projects: []
    }
  },
  methods: {
    getAppliedProject() {
      console.log(this.user.id)
      const url = "/api/user/applied_projects"
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
    // this.getAppliedProject()
  }
}
</script>

