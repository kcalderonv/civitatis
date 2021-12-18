<template>
  <b-container class="py-5 bg-container" fluid>
    <b-row>
      <b-col cols="12" md="6" class="m-auto">
        <b-card>
            <div class="text-center">
                <b-icon icon="check2-circle" variant="success" font-scale="6"></b-icon>
                <h4 class="text-center">Reserva exitosa</h4>
            </div>
            <hr>
            N° Reserva: {{resp.id}} <br>
            N° Personas: {{resp.num_personas}} <br>
            Precio: {{resp.precio}} <br>
            Total: {{resp.total}} <br>
            Fecha Actividad: <Fecha :fecha="resp.fecha_actividad"></Fecha> <br>
            <hr>
            <small>Recuerde presentar su codigo el dia de actividad</small>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import Fecha from "../components/Fecha.vue";
export default {
components: { Fecha },
  data() {
    return {
      resp: null,
    };
  },
  mounted() {
    this.resp = this.$route.params;
  },
};
</script>
<style scoped>
.bg-container{
    background-image: url('https://cdn2.civitatis.com/images/banners/home-07.jpg');
}
</style>
