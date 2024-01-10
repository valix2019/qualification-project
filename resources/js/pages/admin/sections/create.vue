<template>
  <div>
    <admin-breadcrumb />

    <admin-title />

    <section-form :is-creating="true" />
  </div>
</template>

<script>
import AdminBreadcrumb from '~/components/admin/Breadcrumb'
import AdminTitle from '~/components/admin/Title'
import SectionForm from '~/components/admin/sections/Form'

export default {
  components: {
    AdminBreadcrumb,
    AdminTitle,
    SectionForm
  },

  layout: 'admin',
  middleware: 'auth'
}
</script>
