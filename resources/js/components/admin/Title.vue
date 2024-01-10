<template>
  <h1 class="d-flex align-items-center justify-content-between">
    {{ title }}

    <slot />
  </h1>
</template>

<script>
export default {
  data () {
    return {
      title: ''
    }
  },

  watch: {
    '$route' () {
      this.updateTitle()
    }
  },
  mounted () {
    this.updateTitle()
  },

  metaInfo () {
    return { title: this.title }
  },

  methods: {
    updateTitle () {
      const breadcrumb = this.$route.meta.breadcrumb

      if (breadcrumb) {
        const last = breadcrumb[breadcrumb.length - 1]
        this.title = this.$t(last.name)
      }
    }
  }
}
</script>
