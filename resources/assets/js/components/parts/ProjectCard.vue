<template>
  <li class="c-pjcard">
    <a :href="'/project/' + project.id">
      <h2 class="c-pjcard__title">{{project.title}}</h2>
        </a>
      <p>{{project.description}}</p>
      <div class="c-pjcard__terms">
        <dl class="c-pjcard__note">
          <dt>案件タイプ</dt>
          <dd>{{project.type}}</dd>
        </dl>
        <dl class="c-pjcard__note">
          <dt>投稿者</dt>
          <dd>{{project.name}}</dd>
        </dl>
      </div>
  </li>
</template>

<script>
export default {
  name: 'ProjectCard',
  props: ['project']
}
</script>
