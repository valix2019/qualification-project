<template>
  <admin-form endpoint="/api/admin/users"
              route-name="admin.users"
              :form="defaultForm"
              :is-creating="isCreating"
  >
    <template #default="{ form }">
      <b-form-group :label="$t('is_active')"
                    label-for="is_active"
      >
        <b-form-checkbox id="is_active"
                         v-model="form.is_active"
                         size="lg"
                         switch
        />
      </b-form-group>
      <b-form-group :label="$t('email')"
                    label-for="email"
      >
        <b-form-input id="email"
                      v-model="form.email"
                      type="email"
                      :placeholder="$t('email')"
                      required
        />
      </b-form-group>
      <b-form-group :label="$t('name')"
                    label-for="name"
      >
        <b-form-input id="name"
                      v-model="form.name"
                      :placeholder="$t('name')"
                      required
        />
      </b-form-group>
      <b-form-group :label="$t('password')"
                    label-for="password"
      >
        <b-form-input id="password"
                      v-model="form.password"
                      type="password"
                      :placeholder="$t('password')"
                      required
        />
      </b-form-group>
      <b-form-group :label="$t('confirm_password')"
                    label-for="password_confirmation"
      >
        <b-form-input id="password_confirmation"
                      v-model="form.password_confirmation"
                      type="password"
                      :placeholder="$t('confirm_password')"
                      required
        />
      </b-form-group>
    </template>
  </admin-form>
</template>

<script>
import AdminForm from '~/components/admin/Form'

export default {
  components: {
    AdminForm
  },

  props: {
    isCreating: {
      type: Boolean,
      default: false
    }
  },

  data: () => ({
    defaultForm: {
      is_active: true
    }
  })
}
</script>
