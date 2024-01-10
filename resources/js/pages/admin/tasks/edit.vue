<template>
  <div>
    <admin-breadcrumb />

    <admin-title />

    <task-form />
  </div>
</template>

<script>
import AdminBreadcrumb from '~/components/admin/Breadcrumb'
import AdminTitle from '~/components/admin/Title'
import TaskForm from '~/components/admin/tasks/Form'

export default {
  components: {
    AdminBreadcrumb,
    AdminTitle,
    TaskForm
  },

  layout: 'admin',
  middleware: 'auth'
}
</script>
