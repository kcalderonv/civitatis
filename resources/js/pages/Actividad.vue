<template>
  <b-container class="py-5">
    <b-row>
      <b-col cols="12">
        <h3 class="text-center">{{ actividad.titulo }}</h3>
        <hr />
      </b-col>
      <b-col cols="12" md="6">
        <p>{{ actividad.descripcion }}</p>
        <p>
          Precio por Persona: <b>${{ actividad.precio }}</b>
        </p>

        <p class="d-inline">
          Fecha de disponibilidad:
          <Fecha :fecha="actividad.d_inicio"></Fecha> al
          <Fecha :fecha="actividad.d_fin"></Fecha>
        </p>
        <hr />
        <h4>Actividades</h4>
        <ul>
          <li v-for="item in actividad.subactividad" :key="item.id">
            {{ item.actividades }}
          </li>
        </ul>
        <hr />
      </b-col>
      <b-col cols="12" md="6" class="p-md-5 p-2">
          <b-overlay
            :show="cargar"
            spinner-variant="primary"
            spinner-type="grow"
            spinner-small
            rounded="sm"
          >
        <b-card>
            <form @submit.prevent="submit">
              <h3 class="text-center">Reservar</h3>
              <b-form-group label="Fecha">
                <b-input
                  v-model="form.fecha_actividad"
                  type="date"
                  :min="inicio_valido"
                  :max="actividad.d_fin"
                  required
                ></b-input>
              </b-form-group>
              <b-form-group label="Personas">
                <b-input
                  type="number"
                  min="1"
                  max="20"
                  placeholder="cantidad de personas"
                  v-model="form.num_personas"
                  required
                ></b-input>
              </b-form-group>
              <p>
                Precio por Persona: <b>${{ actividad.precio }}</b>
              </p>
              <h4>
                Total: <b>${{ form.total }}</b>
              </h4>
              <hr />
              <b-button v-if="user" type="submit" variant="info"
                >Comprar</b-button
              >
              <b-button
                to="/ingresar"
                v-else
                type="button"
                variant="secondary"
                @click="registrar"
                >Registrate</b-button
              >
            </form>
        </b-card>
        </b-overlay>
      </b-col>
      <b-col cols="12">
        <router-link to="/"> Volver </router-link>
        <hr />
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import moment from "moment";
import Fecha from "../components/Fecha.vue";
import { mapActions, mapState } from "vuex";
export default {
  components: { Fecha },
  data() {
    return {
      id: "",
      actividad: "",
      cargar:false,
      form: {
        actividad_id: 0,
        num_personas: 1,
        precio: 0,
        total: 0,
        fecha_actividad: "",
      },
    };
  },
  watch: {
    "form.num_personas": function () {
      this.form.total = this.form.num_personas * this.form.precio;
    },
  },
  computed: {
    ...mapState(["user", "reserva"]),
    inicio_valido() {
      /*evitar que el usuario seleccione una fecha anterior de hoy apesar que esta en el rango de fecha de la actividad*/
      let fecha = moment().format("YYYY-MM-DD");
      let d_inicio = this.actividad.d_inicio;
      if (fecha < d_inicio) {
        fecha = d_inicio;
      }
      return fecha;
    },
  },
  methods: {
    ...mapActions(["setReserva"]),
    async init() {
      try {
        let id = this.$route.params.id;
        let { data } = await this.axios.get(`/actividades/${id}`);
        if (!data) {
          /* volver al inicio si no  hay data */
          this.$router.push("/");
        }
        this.actividad = data;
        this.form.actividad_id = data.id;
        this.form.precio = data.precio;
        this.form.total = data.precio;
      } catch (error) {
        console.log(error);
        /* volver al inicio si presenta algun error */
        this.$router.push("/");
      }
    },
    registrar() {
      let payload = {
        id: this.form.actividad_id,
        fecha_actividad: this.form.fecha_actividad,
        num_personas: this.form.num_personas,
      };
      this.setReserva(payload);
      this.$router.push("/ingresar");
    },
    async submit() {
        try {
            this.cargar=true;
            let {data} = await this.axios.post('/reservar', this.form);
            this.$router.push({name:'Reservado', params: data});
            this.cargar=false;
        } catch (error) {
        this.cargar=false;
            console.log(error);
            if (error.response.status == 422) {
            alert(error.response.data.message);
            } else {
                alert(
                    "se produjo un error en procesar su información, intente mas tarde."
                );
            }
        }

    },
  },
  mounted() {
    this.init();
    if (this.reserva) {
      this.form.actividad_id = this.reserva.id;
      this.form.fecha_actividad = this.reserva.fecha_actividad;
      this.form.num_personas = this.reserva.num_personas;
    }
    this.form.total = this.form.num_personas * this.form.precio;
  },
};
</script>
