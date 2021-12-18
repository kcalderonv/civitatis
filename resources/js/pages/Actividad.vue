<template>
  <b-container class="py-3">
    <b-row>
        <b-col cols="12">

        </b-col>
    </b-row>
  </b-container>
</template>
<script>
export default {
  data() {
      return {
        id:'',
        actividad: ''
      }
  },
  methods:{
      async init() {
          try {
            let id = this.$route.params.id;
            let data = await this.axios.get(`/actividades/${id}`);
            console.log(data);
          } catch (error) {
            console.log(error);
            this.$route.push('/');
          }
      }
  },
  mounted () {
      this.init();

  },
};
</script>
