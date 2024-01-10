<template>
  <ul class="list-group numbered mb-2">
    <li v-for="item in items"
        :key="item.id"
        class="list-group-item pl-5"
    >
      <router-link :to="{ name: routeName, params: { id: item.id } }">
        {{ item.title }}
      </router-link>
    </li>
  </ul>
</template>

<script>
export default {
  name: 'List',

  props: {
    items: {
      required: true,
      type: Array
    },
    routeName: {
      required: true,
      type: String
    }
  }
}
</script>

<style lang="scss" scoped>
.numbered {
  counter-reset: c;

  li:before {
    content: counter(c) ".";
    counter-increment: c;
    position: absolute;
    left: 20px;
    color: #959595;
  }
}
</style>
