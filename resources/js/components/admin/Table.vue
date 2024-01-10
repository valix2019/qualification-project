<template>
  <fragment>
    <b-table hover
             bordered
             :items="items"
             :fields="fields"
             :per-page="perPage"
             :current-page="currentPage"
             :empty-text="$t('no_data')"
             :busy="isBusy"
             show-empty
             responsive
    >
      <template
        v-for="slot in Object.keys($scopedSlots)"
        #[toCellName(slot)]="props"
      >
        <slot v-bind="props" :name="slot" />
      </template>

      <template #cell(actions)="data">
        <b-button variant="light"
                  size="sm"
                  :to="{ name: `${routeName}.edit`, params: { id: data.item.id } }"
        >
          <b-icon icon="pencil-square" />
        </b-button>
        <b-button variant="light" size="sm" @click="onRemove(data)">
          <b-icon icon="trash" />
        </b-button>
      </template>

      <template #table-busy>
        <div class="text-center my-2">
          <b-spinner class="align-middle" />
        </div>
      </template>
    </b-table>

    <b-pagination
      v-show="items.length > perPage "
      v-model="currentPage"
      :total-rows="items.length"
      :per-page="perPage"
      :aria-controls="routeName"
      align="center"
    />
  </fragment>
</template>

<script>
import axios from 'axios'

export default {
  props: {
    endpoint: {
      type: String,
      required: true
    },
    routeName: {
      type: String,
      required: true
    },
    fields: {
      type: Array,
      required: true
    },
    perPage: {
      type: Number,
      default: 25
    }
  },

  data () {
    return {
      isBusy: true,
      currentPage: 1,
      items: []
    }
  },

  async mounted () {
    await this.fetchData()
  },

  methods: {
    toCellName (slot) {
      return `cell(${slot})`
    },

    async onRemove ({ item }) {
      const val = await this.$bvModal.msgBoxConfirm(this.$t('confirm_deletion'), {
        title: this.$t('deleting'),
        size: 'sm',
        buttonSize: 'sm',
        okVariant: 'danger',
        okTitle: this.$t('delete'),
        cancelVariant: 'light',
        cancelTitle: this.$t('cancel'),
        footerClass: 'p-2',
        hideHeaderClose: false,
        centered: true
      })

      if (val) {
        try {
          await axios.delete(this.endpoint + '/' + item.id)
        } catch (e) {
          // TODO: Обработать ошибку
        }

        await this.fetchData()
      }
    },

    async fetchData () {
      this.isBusy = true

      try {
        const { data } = await axios.get(this.endpoint)

        this.items = data.data
      } catch (e) {
        // TODO: Обработать ошибку
      }

      this.isBusy = false
    }
  }
}
</script>
