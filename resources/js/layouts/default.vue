<template>
  <div class="main-layout h-100 d-flex flex-column">
    <header>
      <navbar />
    </header>

    <main class="content"
          :class="{
            'container': !this.$route.meta.isHome,
            'mt-4': !this.$route.meta.isHome
          }"
    >
      <child />
    </main>

    <footer class="container flex-shrink-0">
      <hr>

      <p>
        2021 © Valikhon 
      </p>
    </footer>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
