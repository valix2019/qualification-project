<template>
  <b-breadcrumb v-if="breadcrumb && breadcrumb.length"
                class="px-0 bg-white"
  >
    <b-breadcrumb-item v-for="(item, idx) in breadcrumb"
                       :key="idx"
                       :active="!!!item.link"
                       :to="routeTo(idx)"
    >
      <b-icon v-if="!!item.icon"
              :icon="item.icon"
              scale="1.25"
              shift-v="1.25"
              aria-hidden="true"
      />
      {{ $t(item.name) }}
    </b-breadcrumb-item>
  </b-breadcrumb>
</template>

<script>
export default {
  data () {
    return {
      breadcrumb: []
    }
  },

  watch: {
    '$route' () {
      this.updateBreadcrumb()
    }
  },

  mounted () {
    this.updateBreadcrumb()
  },

  methods: {
    routeTo (idx) {
      const link = this.breadcrumb[idx].link
      if (link) return link
      return null
    },
    updateBreadcrumb () {
      this.breadcrumb = this.$route.meta.breadcrumb
    }
  }
}
</script>
