<template>
    <div class="d-inline">
        {{f_fecha}}
    </div>
</template>
<script>
import moment  from 'moment';

export default {
    props:['fecha'],
    computed:{
        f_fecha: function () {
            return moment(this.fecha).format('D/MM/YYYY');
        },

    },
    methods: {
    },
}
</script>
