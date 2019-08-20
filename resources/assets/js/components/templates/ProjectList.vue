<template>
  <section class="p-pjlist">
    <h1 v-on:click="getProjects">案件一覧</h1>
    <div class="p-pjlist__filter">
      <input type="radio" name="picked" value=2 v-model="filter" id="all">
      <label for="all">すべて</label>
      <input type="radio" name="picked" value=0 v-model="filter" id="revenue">
      <label for="revenue">レベニューシェア案件</label>
      <input type="radio" name="picked" value=1 v-model="filter" id="reward">
      <label for="reward">単発案件</label>
    </div>
    <ul v-for="project in projects" :key="project.id">
      <ProjectCard :project="project" v-if="sortProjectByType(project.type)"/>
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
      projects: [],
      filter: 2
    }
  },
  computed: {
    filterType: {
      set: function(value) {
        console.log(value,this.filter)
        console.log(this.filter)
      if (this.filter === 2) {
        console.log("こっち")
        return true
      } else if (value === this.filter) {
        console.log("どっち")
        return true
      }
      console.log("aaa")
      return false
    }
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
    },
    sortProjectByType(value) {
      console.log('bbb')
      if (this.filter == 2) {
        return true
      } else if(value == this.filter) {
        return true
      }
      false
    }
  },
  mounted() {
    this.getProjects()
  }
}
</script>

