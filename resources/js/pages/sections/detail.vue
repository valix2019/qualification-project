<template>
  <div v-if="!isLoading">
    <admin-breadcrumb />

    <admin-title />

    <div>
      <div v-if="section.description"
           v-html="section.description"
           class="mb-2"
      />

      <template v-if="section.children.length">
        <list :items="section.children" route-name="sections.detail" />
      </template>

      <template v-if="section.tasks.length">
        <h4>{{ $t('tasks') }}</h4>

        <list :items="section.tasks" route-name="tasks.detail" />
      </template>
    </div>
  </div>
  <Loader v-else />
</template>

<script>
import axios from 'axios'
import AdminBreadcrumb from '~/components/admin/Breadcrumb'
import AdminTitle from '~/components/admin/Title'
import List from '~/components/textbook/List'
import Loader from '../../components/Loader'

export default {
  middleware: 'auth',

  components: {
    AdminBreadcrumb,
    AdminTitle,
    List,
    Loader
  },

  data: () => ({
    isLoading: false,
    section: {
      children: [],
      tasks: []
    }
  }),

  watch: {
    '$route.params.id': {
      async handler (id) {
        await this.fetchData()
      },
      immediate: true
    }
  },

  methods: {
    async fetchData () {
      this.isLoading = true

      try {
        const { data } = await axios.get('/api/sections/' + this.$route.params.id)
        const bradcrumb = data.data.breadcrumb

        this.section = data.data

        bradcrumb.unshift(
          { name: 'home', link: { name: 'home' }, icon: 'house-fill' },
          { name: 'sections', link: { name: 'sections' } }
        )

        this.$route.meta.breadcrumb = bradcrumb
      } catch (e) {
        // TODO: Обработать ошибку
      }

      this.isLoading = false
    }
  }
}
</script>
