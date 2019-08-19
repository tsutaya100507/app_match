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
        <dl class="c-pjcard__note" v-if="isReward">
          <dt>報酬</dt>
          <dd>{{project.lower_price}}千円 ~ {{project.upper_price}}千円</dd>
        </dl>
        <dl class="c-pjcard__note">
          <dt>投稿者</dt>
          <dd>{{project.name}}</dd>
        </dl>
        <slot name="apply"></slot>
        <slot name="message"></slot>
      </div>
      <slot name="editLink"></slot>
  </li>
</template>

<script>
export default {
  name: 'ProjectCard',
  props: ['project'],
  computed: {
    isReward() {
      if (this.project.type === 1) {
        return true
      }
      return false
    }
  }
}
</script>
