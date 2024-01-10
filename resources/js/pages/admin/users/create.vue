<template>
  <div>
    <admin-breadcrumb />

    <admin-title />

    <user-form :is-creating="true" />
  </div>
</template>

<script>
import AdminBreadcrumb from '~/components/admin/Breadcrumb'
import AdminTitle from '~/components/admin/Title'
import UserForm from '~/components/admin/users/Form'

export default {
  components: {
    AdminBreadcrumb,
    AdminTitle,
    UserForm
  },

  layout: 'admin',
  middleware: 'auth'
}
</script>
