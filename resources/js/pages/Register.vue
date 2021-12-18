<template>
  <b-container class="py-5">
    <b-row>
      <b-col cols="12" md="6">
        <h3>Registro</h3>
        <hr />
        <form @submit.prevent="submit">
          <b-form-group label="Nombres">
            <b-form-input v-model="registro.name" trim required></b-form-input>
          </b-form-group>
          <b-form-group label="Correo">
            <b-form-input
              v-model="registro.email"
              type="email"
              trim
              required
            ></b-form-input>
          </b-form-group>
          <b-form-group label="Password">
            <b-form-input
              v-model="registro.password"
              type="password"
              trim
              required
            ></b-form-input>
          </b-form-group>
          <b-form-group label="Confirmar Password">
            <b-form-input
              v-model="registro.password_confirm"
              type="password"
              trim
              required
            ></b-form-input>
          </b-form-group>
          <b-button type="submit" variant="success">Registrar</b-button>
        </form>
      </b-col>

      <b-col cols="12" md="6" class="p-2 p-md-5">
        <h3 class="text-center">Ingresar</h3>
        <hr>
         <b-overlay :show="cargarLogin" rounded="sm">
            <b-card>
            <form @submit.prevent="submitLogin">
                <b-form-group label="Correo">
                <b-form-input
                    v-model="form.email"
                    type="email"
                    trim
                ></b-form-input>
                </b-form-group>
                <b-form-group label="Password">
                <b-form-input
                    v-model="form.password"
                    type="password"
                    trim
                ></b-form-input>
                </b-form-group>
                <b-button type="submit" variant="primary">Ingresar</b-button>
            </form>
            </b-card>
          </b-overlay>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import { mapActions, mapState } from 'vuex';
export default {
  data() {
    return {
      cargarLogin:false,
      registro: {
        name: "",
        email: "",
        password: "",
        password_confirm: "",
      },
      form: {
        email: "",
        password: "",
      },
    };
  },
  computed: {
    ...mapState(["user","reserva"]),
  },
  methods: {
    ...mapActions(["setUser"]),
    async submit() {
      try {
        let { data } = await this.axios.post("/registro", this.registro);
        this.setUser(data);
        /*verificar si ya tiene una reserva, si lo tiene ingresar a reservar*/
        if(this.reserva){
            this.$router.push(`/actividad/${this.reserva.id}`);
        }else{
            this.$router.push('/');
        }
      } catch (error) {
        console.log(error);
        console.log(error.response);
        if (error.response.status == 422) {
          alert(error.response.data.message);
        } else {
          alert(
            "se produjo un error en procesar su información, intente mas tarde."
          );
        }
      }
    },
    async submitLogin() {
      try {
          this.cargarLogin = true;
        let { data } = await this.axios.post("/login", this.form);
        this.setUser(data);
        /*verificar si ya tiene una reserva, si lo tiene ingresar a reservar*/
        this.cargarLogin = false;
         if(this.reserva){
            this.$router.push(`/actividad/${this.reserva.id}`);
        }else{
            this.$router.push('/');
        }
      } catch (error) {
        console.log(error);
        console.log(error.response);
        if (error.response.status == 422) {
          alert(error.response.data.message);
        } else {
          alert(
            "se produjo un error en procesar su información, intente mas tarde."
          );
        }
        this.cargarLogin = false;
      }
    },
  },
  mounted() {
      if(this.user){
          this.$router.push('/');
      }
  },
};
</script>
