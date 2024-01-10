<template>
  <b-form v-if="!isLoading"
          @submit.prevent="onSubmit"
  >
    <slot :form="localForm" />

    <b-button type="submit" variant="primary" :disabled="isProcessing">
      <b-spinner v-show="isProcessing" small />
      {{ $t('update') }}
    </b-button>

    <b-button variant="light" :to="{ name: routeName }">
      {{ $t('cancel') }}
    </b-button>
  </b-form>
  <Loader v-else />
</template>

<script>
import axios from 'axios'
import Loader from '../Loader'

export default {
  components: { Loader },
  props: {
    endpoint: {
      type: String,
      required: true
    },
    routeName: {
      type: String,
      required: true
    },
    isCreating: {
      type: Boolean,
      default: false
    },
    form: {
      type: Object,
      default: () => ({})
    }
  },

  data () {
    return {
      isLoading: false,
      isProcessing: false,
      localForm: this.form
    }
  },

  async mounted () {
    if (!this.isCreating) {
      this.isLoading = true
      try {
        const { data } = await axios.get(this.endpoint + '/' + this.$route.params.id)

        this.localForm = Object.assign({}, this.localForm, data.data)
      } catch (e) {
        // TODO: Обработать ошибку
      }

      this.isLoading = false
    }
  },

  methods: {
    async onSubmit (event) {
      this.isProcessing = true

      if (!this.isCreating) {
        try {
          await axios.patch(this.endpoint + '/' + this.$route.params.id, this.localForm)

          await this.$router.push({ name: this.routeName })
        } catch (e) {
          // TODO: Обработать ошибку
        }
      } else {
        try {
          await axios.post(this.endpoint, this.localForm)

          await this.$router.push({ name: this.routeName })
        } catch (e) {
          // TODO: Обработать ошибку
        }
      }

      this.isProcessing = false
    }
  }
}
</script>
