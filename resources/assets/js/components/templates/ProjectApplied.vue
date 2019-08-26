<template>
  <section class="p-pjapplied">
    <div class="l-sidebar">
      <Sidebar />
    </div>
    <div class="p-pjapplied__wrapper">
    <h1>申し込み案件一覧</h1>
      <ul v-for="project in projects" :key="project.id">
        <li>
          <ProjectCard :project="project">
            <dl class="c-pjcard__note" slot="apply">
              <dt>申込日時</dt>
              <dd>{{project.created_at}}</dd>
            </dl>
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
  props: ['user'],
  components: {
    ProjectCard, Sidebar
  },
  data() {
    return {
      projects: []
    }
  },
  methods: {
    getAppliedProjects() {
      console.log(this.user.id)
      const url = "/api/applications"
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
    this.getAppliedProjects()
  }
}
</script>

