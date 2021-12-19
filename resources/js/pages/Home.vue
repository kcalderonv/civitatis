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
          <h3>Si os apasionado de las actividades, no esperes mas.</h3>
        </b-carousel-slide>
      </b-carousel>
      <div class="busqueda">
        <b-row class="d-flex align-items-center h-100 w-100">
          <b-col cols="12" lg="10" xl="9" class="m-auto">
            <b-overlay :show="cargar" rounded="sm">
              <b-card class="py-3 card-2">
                <form @submit.prevent="search">
                  <b-row>
                    <b-col cols="12">
                      <h3 class="text-center">
                        Consulta las actividades en la fecha que eligas
                      </h3>
                    </b-col>
                    <b-col md="6">
                      <label for="">Fecha de Reserva</label>
                      <b-input
                        v-model="form.fecha_actividad"
                        type="date"
                        :min="hoy"
                        required
                      ></b-input>
                    </b-col>
                    <b-col md="4">
                      <label for="">Personas</label>
                      <b-input
                        v-model="form.num_personas"
                        type="number"
                        min="1"
                        max="20"
                        placeholder="cantidad de personas"
                        required
                      ></b-input>
                    </b-col>
                    <b-col md="2">
                      <b-button variant="success" type="btn-success" block>
                        <b-icon icon="search"></b-icon> Buscar</b-button
                      >
                    </b-col>
                  </b-row>
                </form>
              </b-card>
              <template #overlay>
                <div class="text-center">
                  <b-icon
                    icon="stopwatch"
                    font-scale="3"
                    animation="cylon"
                  ></b-icon>
                  <p id="cancel-label">Buscando actividades...</p>
                </div>
              </template>
            </b-overlay>
          </b-col>
        </b-row>
      </div>
    </div>
    <section class="w-100 bg-2">
      <b-container class="py-5">
        <b-row>
          <b-col cols="12">
            <h3 class="text-center">
              Actividades disponibles en la fecha de selección
            </h3>
            <hr />
          </b-col>
          <b-col cols="12" v-if="busqueda.length > 0">
            <b-row>
              <template v-for="(item, index) in busqueda">
                <b-col
                  cols="12"
                  md="4"
                  xl="3"
                  :key="item.id"
                  v-if="rowsCard(index)"
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
                      <b-button
                        type="button"
                        variant="outline-info"
                        @click="reservar(item.id)"
                      >
                        <b-icon icon="door-open"></b-icon> Reservar
                      </b-button>
                      <RangFecha
                        :inicio="item.d_inicio"
                        :fin="item.d_fin"
                      ></RangFecha>
                    </div>
                  </b-card>
                </b-col>
              </template>
            </b-row>
            <b-pagination
              v-model="currentPage"
              :total-rows="rows"
              :per-page="perPage"
            ></b-pagination>
          </b-col>
          <h5 class="text-center" v-if="men_busqueda">
            Lo Sentimos no tenemos actividades para la fecha seleccionada.
          </h5>
        </b-row>
      </b-container>
    </section>

    <b-container class="py-5">
      <b-row>
        <b-col cols="12">
          <h3 class="text-center">Nuestras Actividades Destacadas</h3>
          <hr />
        </b-col>
        <template v-for="item in filter">
          <b-col
            cols="12"
            md="4"
            xl="3"
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
                <router-link
                  class="btn btn-outline-info"
                  :to="`actividad/${item.id}`"
                >
                  <b-icon icon="door-open"></b-icon> Reservar
                </router-link>
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
import { mapActions } from "vuex";
export default {
  components: { RangFecha },
  data() {
    return {
      cargar: false,
      men_busqueda: false,
      hoy: moment().format("YYYY-MM-DD"),
      actividades: [],
      busqueda: [],
      filter: [],
      form: {
        fecha_actividad: "",
        num_personas: 1,
      },
      currentPage: 1,
      perPage: 12,
    };
  },
  computed: {
    rows() {
      return this.busqueda.length;
    },
  },
  methods: {
    ...mapActions(["setReserva"]),
    rowsCard(index) {
      console.log(index, this.perPage);
      let next = this.perPage * this.currentPage;
      let prev = this.perPage * (this.currentPage - 1);
      console.log(next, prev);
      let data = index >= prev && index < next ? 1 : 0;
      return data;
    },
    async search() {
      this.men_busqueda = false;
      this.cargar = true;
      let { data } = await this.axios.post("/search", this.form);
      this.busqueda = data;
      if (data.length == 0) {
        this.men_busqueda = true;
      }
      this.cargar = false;
    },
    reservar(id) {
      let payload = {
        id: id,
        fecha_actividad: this.form.fecha_actividad,
        num_personas: this.form.num_personas,
      };
      this.setReserva(payload);
      this.$router.push(`/actividad/${id}`);
    },
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

.card-2 {
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
