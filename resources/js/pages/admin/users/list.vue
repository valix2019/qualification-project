<template>
  <div>
    <admin-breadcrumb />

    <admin-title>
      <b-button variant="success" :to="{ name: 'admin.users.create' }">
        <b-icon icon="plus" />
        {{ $t('create') }}
      </b-button>
    </admin-title>

    <admin-table endpoint="/api/admin/users" route-name="admin.users" :fields="fields">
      <template #is_active="data">
        <b-icon v-if="data.value" icon="check-circle" variant="success" />
        <b-icon v-else icon="dash-circle" variant="danger" />
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
        { key: 'name', label: 'Имя', sortable: true },
        { key: 'email', label: 'Email', sortable: true },
        { key: 'created_at', label: 'Дата создания', sortable: true },
        { key: 'updated_at', label: 'Дата обновления', sortable: true },
        { key: 'Actions', label: '', class: 'text-center' }
      ]
    }
  }
}
</script>
