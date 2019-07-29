<template>
  <a :href="'/project/' + project.id">
    <article>
      {{project.id}}
      <span>{{project.title}}</span>
      <span>{{project.type}}</span>
      <p>{{project.description}}</p>
      <p>{{project.name}}</p>
      <hr>
    </article>
  </a>
</template>

<script>
export default {
  name: 'ProjectCard',
  props: ['project']
}
</script>
