<template>
    <div class="container my-5">
        <h2>Hoteles</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="hotel in this.hoteles" v-bind:key="hotel.id">
                <div class="card">
                    <!-- como el src proviene de una variable se le deben poner dos puntos antes del src -->
                    <img :src="`storage/${hotel.imagen_principal}`" alt="Card del hotel" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold text-uppercase">
                            {{hotel.nombre}}
                        </h3>
                        <p class="card-text">{{hotel.direccion}}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{hotel.apertura}} - {{hotel.cierre}}
                        </p>
                        <a href="" class="btn btn-primary d-block">Ver Lugar</a>
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
            axios.get('/api/categorias/hotel')
                .then((respuesta)=>{
                    if(respuesta && respuesta.data) {
                        // this.hoteles=respuesta.data;
                        this.$store.commit('CARGAR_HOTELES', respuesta.data);
                    }
                });
        }, computed: {
            hoteles(){
                return this.$store.state.hoteles;
            }
        },
    }
</script>
