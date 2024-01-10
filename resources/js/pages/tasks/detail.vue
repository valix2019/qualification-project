<template>
  <div v-if="!isLoading">
    <admin-breadcrumb />

    <admin-title />

    <div v-if="!isHandlerLoading">
      <vue-mathjax :formula="task.description"
                   class="d-block formula"
                   disabled
      />

      <vue-mathjax :formula="handler.formula"
                   class="d-block formula equation"
                   disabled
      />

      <hr>

      <div class="d-flex justify-content-center text-center">
        <b-form @submit.prevent="onSubmit">
          <component :is="taskHandler"
                     @input="handleInput"
          />

          <b-button type="submit" variant="primary" :disabled="isProcessing" class="mt-3">
            <b-spinner v-show="isProcessing" small />
            Отправить решение
          </b-button>
        </b-form>
      </div>
    </div>
    <Loader v-else />
  </div>
  <Loader v-else />
</template>

<script>
import axios from 'axios'
import AdminBreadcrumb from '~/components/admin/Breadcrumb'
import AdminTitle from '~/components/admin/Title'
import Loader from '../../components/Loader'
import Handlers from '~/components/handlers'

export default {
  components: {
    ...Handlers,
    AdminBreadcrumb,
    AdminTitle,
    Loader
  },

  middleware: 'auth',

  data: () => ({
    endpoint: '/api/tasks/',
    isLoading: false,
    isHandlerLoading: false,
    isProcessing: false,
    task: {},
    handler: {},
    answers: {}
  }),

  computed: {
    taskHandler () {
      return Object.keys(this.task).length > 0 ? this.task.task_handler.handler : null
    }
  },

  async mounted () {
    this.isLoading = true

    await this.fetchData()

    this.isLoading = false
  },

  methods: {
    handleInput (answers) {
      this.answers = answers
    },

    async fetchData () {
      this.isHandlerLoading = true

      try {
        const { data } = await axios.get(this.endpoint + this.$route.params.id)
        const bradcrumb = data.data.task.breadcrumb

        this.task = data.data.task
        this.handler = data.data.handler

        console.log('Answers:', this.handler.answers)

        bradcrumb.unshift(
          { name: 'home', link: { name: 'home' }, icon: 'house-fill' },
          { name: 'sections', link: { name: 'sections' } }
        )

        this.$route.meta.breadcrumb = bradcrumb
      } catch (e) {
        // TODO: Обработать ошибку
      }

      this.isHandlerLoading = false
    },

    async onSubmit (event) {
      this.isProcessing = true

      try {
        const { data } = await axios.post(this.endpoint + this.$route.params.id, {
          answers: this.answers
        })

        if (data.data.isCorrect) {
          await this.$bvModal.msgBoxOk(this.$t('correct_and_next') + '', {
            title: this.$t('correct'),
            size: 'md',
            buttonSize: 'md',
            okVariant: 'success',
            okTitle: this.$t('go_on'),
            footerClass: 'p-2',
            hideHeaderClose: false,
            centered: true
          })

          await this.fetchData()
        } else {
          await this.$bvModal.msgBoxOk(this.$t('try_more') + '', {
            title: this.$t('wrong'),
            size: 'md',
            buttonSize: 'md',
            okVariant: 'danger',
            okTitle: this.$t('go_on'),
            footerClass: 'p-2',
            hideHeaderClose: false,
            centered: true
          })
        }
      } catch (e) {
        // TODO: Обработать ошибку
      }

      this.isProcessing = false
    }
  }
}
</script>
