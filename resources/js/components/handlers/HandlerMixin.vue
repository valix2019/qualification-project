<script>
export default {
  data: () => ({
    answers: {}
  }),

  watch: {
    answers: {
      handler: function (answers) {
        this.$emit('input', answers)
      },
      deep: true
    }
  }
}
</script>
