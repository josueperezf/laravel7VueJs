<template>
    <div class="container my-5">
        <h2>Hospitales</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="hospital in this.hospitales" v-bind:key="hospital.id">
                <div class="card">
                    <!-- como el src proviene de una variable se le deben poner dos puntos antes del src -->
                    <img :src="`storage/${hospital.imagen_principal}`" alt="Card del hospital" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold text-uppercase">
                            {{hospital.nombre}}
                        </h3>
                        <p class="card-text">{{hospital.direccion}}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{hospital.apertura}} - {{hospital.cierre}}
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
            axios.get('/api/categorias/hospital')
                .then((respuesta)=>{
                    if(respuesta && respuesta.data) {
                        // this.hospitales=respuesta.data;
                        this.$store.commit('CARGAR_HOSPITALES',respuesta.data);
                    }
                });
        },
        computed: {
            hospitales(){
                return this.$store.state.hospitales;
            }
        },
    }
</script>
