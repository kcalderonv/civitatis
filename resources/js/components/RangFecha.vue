<template>
    <div>
        {{f_inicio}} al <br> {{f_fin}}
    </div>
</template>
<script>
import moment  from 'moment';

export default {
    props:['inicio','fin'],
    computed:{
        f_inicio: function () {
            return moment(this.inicio).format('D/MM/YYYY');
        },

        f_fin: function () {
            return moment(this.fin).format('D/MM/YYYY');
        }
    },
    methods: {
    },
}
</script>
