<template>
  <section class="p-pubmessages">
    <div class="l-sidebar">
      <Sidebar />
    </div>
        <div class="p-pjapplied__wrapper">
      {{projects}}
    <h1>メッセージした案件一覧</h1>
      <ul v-for="project in projects" :key="project.id">
        <li>
          <ProjectCard :project="project">
            <dl class="c-pjcard__note" slot="message">
              <dt>最新メッセージ</dt>
              <dd>{{project.message}} by {{project.user_name}}</dd>
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
    getMessagedProjects() {
      console.log(this.user.id)
      const url = "/api/project/messaged"
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
    this.getMessagedProjects()
  }
}
</script>
