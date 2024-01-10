<template>
  <admin-form endpoint="/api/admin/sections"
              route-name="admin.sections"
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
      <b-form-group :label="'Порядок'"
                    label-for="order"
      >
        <b-form-input id="order"
                      v-model="form.order"
                      type="number"
        />
      </b-form-group>
      <b-form-group :label="'Родитель'"
                    label-for="parent_id"
      >
        <b-form-select
          id="parent_id"
          v-model="form.parent_id"
          :options="options"
        >
          <template #first>
            <b-form-select-option :value="null">
              -- Корень --
            </b-form-select-option>
          </template>
        </b-form-select>
      </b-form-group>
      <b-form-group :label="'Заголовок'"
                    label-for="title"
      >
        <b-form-input id="title"
                      v-model="form.title"
                      :placeholder="'Заголовок'"
                      required
        />
      </b-form-group>
      <b-form-group :label="'Описание'"
                    label-for="description"
      >
        <b-form-textarea id="description"
                         v-model="form.description"
                         :placeholder="'Описание'"
        />
      </b-form-group>
    </template>
  </admin-form>
</template>

<script>
import AdminForm from '~/components/admin/Form'
import axios from 'axios'

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
      is_active: true,
      order: 500,
      parent_id: null
    },
    options: []
  }),

  async mounted () {
    try {
      const { data } = await axios.get('/api/admin/sections/tree', {
        params: {
          except: this.$route.params.id
        }
      })

      this.options = data.data
    } catch (e) {
      // TODO: Обработать ошибку
    }
  }
}
</script>
