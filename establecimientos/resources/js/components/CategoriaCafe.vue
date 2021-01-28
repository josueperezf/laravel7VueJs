<template>
    <div class="container my-5">
        <h2>Cafes</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="cafe in this.cafes" v-bind:key="cafe.id">
                <div class="card">
                    <!-- como el src proviene de una variable se le deben poner dos puntos antes del src -->
                    <img :src="`storage/${cafe.imagen_principal}`" alt="Card del cafe" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold text-uppercase">
                            {{cafe.nombre}}
                        </h3>
                        <p class="card-text">{{cafe.direccion}}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{cafe.apertura}} - {{cafe.cierre}}
                        </p>
                        <router-link :to="{name:'establecimiento', params:{id:cafe.id}}">
                            <a class="btn btn-primary d-block">Ver Lugar</a>
                        </router-link>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            axios.get('/api/categorias/cafe')
                .then((respuesta)=>{
                    if(respuesta && respuesta.data ) {
                        this.$store.commit('CARGAR_CAFES',respuesta.data);
                        //this.cafes=respuesta.data;
                    }
                });
        },
        computed: {
            // el siguiente metodo debe llamarse como esta en el for v-for="cafe in this.cafes"
            cafes(){
                return this.$store.state.cafes;
            }
        },
    }
</script>
