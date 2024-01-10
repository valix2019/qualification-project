<template>
  <div>
    <b-jumbotron>
      <template #header>
        <div class="container">
          Сервис решения задач
        </div>
      </template>

      <template #lead>
        <div class="container">
          <p>
            Здесь вы можете научиться решать задачи, начиная с самых простых и заканчивая сложными математическими задачами.
          </p>
          <p>
            Мы сосредоточимся на самом решении, изредка добавляя теорметические заметки.
          </p>
        </div>
      </template>

      <div class="container">
        <hr class="my-4">

        <p>
          Перед вами учебник по математике, начиная с основ, включающий в себя много задач и основной теории.
        </p>

        <b-button variant="primary" :to="{ name: 'sections' }">
          Посмотреть разделы
        </b-button>
        <b-button variant="success" :to="{ name: 'admin' }">
          {{ $t('admin_panel') }}
        </b-button>
      </div>
    </b-jumbotron>

    <div class="container">
      <b-card-group>
        <b-card title="Приведенные квадратные уравнения">
          <b-card-text>
            Генератор задач типа "Приведенные квадратные уравнения"
          </b-card-text>

          <b-button to="/tasks/1" variant="light">
            Перейти
          </b-button>
        </b-card>

        <b-card title="Не приведенные квадратные уравнения">
          <b-card-text>
            Генератор задач типа "Не приведенные квадратные уравнения"
          </b-card-text>

          <b-button to="/tasks/2" variant="light">
            Перейти
          </b-button>
        </b-card>

        <b-card title="уравнения с раскрытием скобок">
          <b-card-text>
            Генератор задач типа "Уравнения с раскрытием скобок"
          </b-card-text>

          <b-button to="/tasks/3" variant="light">
            Перейти
          </b-button>
        </b-card>
      </b-card-group>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
