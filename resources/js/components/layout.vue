<template>
    <div>
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

export default {
    components:{Footer, Nav}
}
</script>

