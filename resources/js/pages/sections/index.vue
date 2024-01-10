<template>
  <div v-if="!isLoading">
    <admin-breadcrumb />

    <admin-title />

    <div>
      <list :items="items" route-name="sections.detail" />
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
  components: {
    AdminBreadcrumb,
    AdminTitle,
    List,
    Loader
  },

  middleware: 'auth',

  data: () => ({
    isLoading: false,
    items: []
  }),

  async mounted () {
    this.isLoading = true

    try {
      const { data } = await axios.get('/api/sections')

      this.items = data.data
    } catch (e) {
      // TODO: Обработать ошибку
    }

    this.isLoading = false
  }
}
</script>
