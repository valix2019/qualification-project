<template>
  <div>
    <admin-breadcrumb />

    <admin-title>
      <b-button variant="success" :to="{ name: 'admin.tasks.create' }">
        <b-icon icon="plus" />
        {{ $t('create') }}
      </b-button>
    </admin-title>

    <admin-table endpoint="/api/admin/tasks" route-name="admin.tasks" :fields="fields">
      <template #is_active="data">
        <b-icon v-if="data.value" icon="check-circle" variant="success" />
        <b-icon v-else icon="dash-circle" variant="danger" />
      </template>

      <template #section="data">
        <router-link :to="{ name: `admin.sections.edit`, params: { id: data.value.id } }">
          {{ data.value.title }}
        </router-link>
      </template>
    </admin-table>
  </div>
</template>

<script>
import AdminBreadcrumb from '~/components/admin/Breadcrumb'
import AdminTitle from '~/components/admin/Title'
import AdminTable from '~/components/admin/Table'

export default {
  components: {
    AdminBreadcrumb,
    AdminTitle,
    AdminTable
  },

  layout: 'admin',
  middleware: 'auth',

  data () {
    return {
      fields: [
        { key: 'is_active', label: 'Активность', sortable: true, class: 'text-center' },
        { key: 'title', label: 'Заголовок', sortable: true },
        { key: 'section', label: 'Раздел', sortable: true },
        { key: 'order', label: 'Порядок', sortable: true },
        { key: 'Actions', label: '', class: 'text-center' }
      ]
    }
  }
}
</script>
