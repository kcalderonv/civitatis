<template>
    <div class="main">
        <!-- cabecera -->
        <Nav></Nav>
        <!-- cuerpo -->
        <main>
            <router-view></router-view>
        </main>
        <!-- Footer -->
        <Footer></Footer>
    </div>
</template>
<script>
import Footer from './Footer';
import Nav from './Nav';
import {mapActions, mapState} from 'vuex';

export default {
    components:{Footer, Nav},
    computed: {
    ...mapState(['user'])
    },
    methods: {
        ...mapActions(['setUser']),
    },
    mounted () {
        this.axios.get('/user').then((result) => {
            let user = result.data;
            this.setUser(user);
        }).catch((err) => {
            console.log(err);
        });
    },
}
</script>
<style scoped>

main {
    min-height: calc(100vh - 110px);
}

</style>

