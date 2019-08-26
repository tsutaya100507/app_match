<template>
  <section class="p-pjposted">
    <div class="l-sidebar">
      <Sidebar />
    </div>
    <div class="p-pjposted__wrapper">
      <h1 class="p-pjposted__title">投稿案件一覧</h1>
      <ul v-for="project in projects" :key="project.id">
        <li>
          <ProjectCard :project="project">
            <div slot="editLink">
              <a :href="'/project/' + project.id + '/edit'" class="button button--primary">編集</a>
            </div>
          </ProjectCard>
        </li>
      </ul>
    </div>
  </section>
</template>

<script>
import axios from 'axios'
import ProjectCard from '../parts/ProjectCard'
import Sidebar from '../layouts/Sidebar'

export default {
  props: [ 'user' ],
  components: {
    ProjectCard, Sidebar
  },
  data() {
    return {
      projects: []
    }
  },
  methods: {
    getPostedProject() {
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
