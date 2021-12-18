<template>
    <div>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <b-navbar-brand to="/">civitatis</b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav v-if="user">
        <b-nav-item to="/reservas">Reservas</b-nav-item>
      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown v-if="user" right>
          <!-- Using 'button-content' slot -->
          <template #button-content>
            <em>{{user.name}}</em>
          </template>
          <b-dropdown-item href="#" @click="salir">Salir</b-dropdown-item>
        </b-nav-item-dropdown>
        <b-navbar-nav v-else>
            <b-nav-item to="/ingresar">Ingresar</b-nav-item>
        </b-navbar-nav>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</div>
</template>
<script>
import {mapActions, mapState} from 'vuex';

export default {
    computed: {
    ...mapState(['user'])
    },
    methods: {
        ...mapActions(["setUser"]),
        salir() {
            this.axios.post('/logout');
            this.setUser(null);
            if(this.$route.path != "/"){
                this.$router.push('/');
            }
        }
    },
}
</script>
