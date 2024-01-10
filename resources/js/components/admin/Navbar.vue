<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <router-link :to="{ name: 'admin' }" class="navbar-brand">
        {{ $t('admin_panel') }}
      </router-link>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav">
<!--          <li class="nav-item">-->
<!--            <router-link :to="{ name: 'admin.dashboard' }" class="nav-link" active-class="active">-->
<!--              {{ $t('dashboard') }}-->
<!--            </router-link>-->
<!--          </li>-->
          <li class="nav-item">
            <router-link :to="{ name: 'admin.users' }" class="nav-link" active-class="active">
              {{ $t('users') }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'admin.sections' }" class="nav-link" active-class="active">
              {{ $t('sections') }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'admin.tasks' }" class="nav-link" active-class="active">
              {{ $t('tasks') }}
            </router-link>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <locale-dropdown />

          <!-- Authenticated -->
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <router-link :to="{ name: 'home' }" class="dropdown-item pl-3">
                <b-icon-unlock-fill fixed-width />
                {{ $t('public_site') }}
              </router-link>

              <router-link :to="{ name: 'admin.settings.profile' }" class="dropdown-item pl-3">
                <fa icon="cog" fixed-width />
                {{ $t('settings') }}
              </router-link>

              <div class="dropdown-divider" />
              <a href="#" class="dropdown-item pl-3 text-danger" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t('logout') }}
              </a>
            </div>
          </li>
          <!-- Guest -->
          <template v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                {{ $t('register') }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from '../LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
