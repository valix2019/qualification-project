<template>
  <div class="main-layout h-100 d-flex flex-column">
    <header>
      <navbar />
    </header>

    <main class="content container mt-4">
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
import Navbar from '~/components/admin/Navbar'

export default {
  name: 'AdminLayout',

  components: {
    Navbar
  }
}
</script>
