<template>
    <b-container class="py-5">
        <b-row>
            <b-col cols="12">
                <h1>Mis Reservas</h1>
                <div class="overflow-auto">
                    <b-table
                    id="my-table"
                    striped 
                    :items="items"
                    :per-page="perPage"
                    :current-page="currentPage"
                    ></b-table>
                    <hr>
                    <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="my-table"
                    ></b-pagination>
                    <p class="mt-3">Página actual: {{ currentPage }}</p>
                </div>
            </b-col>

        </b-row>
    </b-container>
</template>
<script>
export default {
    data() {
        return {
            perPage: 10,
            currentPage: 1,
            items: []
        }
    },
    computed: {
      rows() {
        return this.items.length;
      }
    },
    async mounted () {
        let {data} = await this.axios.post('/reservas');
        this.items=data;
    },
}
</script>

