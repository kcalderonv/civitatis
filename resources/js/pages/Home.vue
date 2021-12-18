<template>
  <div>
    <!-- corousel -->
    <div class="slider">
      <b-carousel style="text-shadow: 0px 0px 2px #000" indicators>
        <b-carousel-slide
          img-src="https://cdn2.civitatis.com/images/banners/home-07.jpg"
        >
          <h3>LLENA TU VIAJE</h3>
        </b-carousel-slide>
        <b-carousel-slide
          img-src="https://cdn2.civitatis.com/images/banners/home-06.jpg"
        >
          <h3>Excursiones en español por todo el mundo</h3>
        </b-carousel-slide>
        <b-carousel-slide
          img-src="https://cdn2.civitatis.com/images/banners/home-07.jpg"
        >
          <h3>Los mejores actividades en civitatis</h3>
        </b-carousel-slide>
        <b-carousel-slide
          img-src="https://cdn2.civitatis.com/images/banners/home-04.jpg"
        >
          <h3>
            Si os apasionado de las actividades, no esperes mas.
          </h3>
        </b-carousel-slide>
      </b-carousel>
      <div class="busqueda">
        <b-row class="d-flex align-items-center h-100">
          <b-col cols="12" lg="10" xl="9" class="m-auto">
            <b-card class="py-3">
              <b-row>
                <b-col cols="12">
                    <h3 class="text-center">Consulta las actividades en la fecha que eligas</h3>
                </b-col>
                <b-col md="6">
                  <label for="">Fecha de Reserva</label>
                  <b-input type="date" :min="hoy"></b-input>
                </b-col>
                <b-col md="4">
                  <label for="">Personas</label>
                  <b-input
                    type="number"
                    min="1"
                    max="20"
                    placeholder="cantidad de personas"
                  ></b-input>
                </b-col>
                <b-col md="2">
                  <b-button variant="success" type="btn-success" block
                    > <b-icon icon="search"></b-icon> Buscar</b-button
                  >
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-row>
      </div>
    </div>
    <b-container class="py-5">
      <b-row>
        <b-col cols="12">
          <h3 class="text-center">Nuestras Actividades Destacadas</h3>
          <hr />
        </b-col>
        <template v-for="item in filter">
          <b-col
            cols="12"
            md="6"
            lg="4"
            :key="item.id"
            v-if="item.calificacion == 5"
          >
            <b-card class="card-actividad">
              <h5>{{ item.titulo }}</h5>
              <div class="card-descripcion">
                <b-form-rating
                  v-model="item.calificacion"
                  variant="warning"
                  class="mb-1"
                  show-value
                  no-border
                  readonly
                ></b-form-rating>
                <p>
                  Precio por Persona <b> $. {{ item.precio }}</b>
                </p>
              </div>

              <div class="d-flex justify-content-between">
                <router-link class="btn btn-outline-info" :to="`actividad/${item.id}`">  <b-icon icon="door-open"></b-icon> Reservar </router-link>
                <RangFecha
                  :inicio="item.d_inicio"
                  :fin="item.d_fin"
                ></RangFecha>
              </div>
            </b-card>
          </b-col>
        </template>
      </b-row>
    </b-container>
  </div>
</template>
<script>
import moment from "moment";
import RangFecha from "../components/RangFecha";
export default {
  components: { RangFecha },
  data() {
    return {
      hoy: moment().format("YYYY-MM-DD"),
      actividades: [],
      filter: [],
    };
  },
  methods: {
    async init() {
      try {
        let { data } = await this.axios.get("actividades");
        this.filter = data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.init();
  },
};
</script>

<style scoped>
h1 {
  font-weight: 500;
}

.card{
    background: #ffffff95;
}

.card-actividad {
  margin-top: 5px;
  margin-bottom: 5px;
}

.card-actividad h5 {
  height: 50px;
}

.card-actividad .card-descripcion {
  height: 100px;
}

.slider {
  position: relative;
}
.slider img {
    height: 100% !important;
}
.busqueda {
  position: absolute;
  top: 0px;
  width: 100%;
  height: 100%;
}

.btn-success {
  margin-top: 30px;
}
</style>
