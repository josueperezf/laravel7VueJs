<template>
    <div class="container my-5">
        <h2 class="text-center mb-5">
            {{establecimiento.nombre}}
        </h2>
        <div class="row align-items-start">
            <div class="col-md-8 order-2">
                <img :src="`../storage/${establecimiento.imagen_principal}`" alt="imagen establecimiento">
                <p class="mt-3">
                    {{establecimiento.descripcion}}
                </p>
                <galeria-imagenes></galeria-imagenes>
            </div>
            <aside class="col-md-4 order-1">
                <div class="p-4 bg-primary">
                    <div>
                        <mapa-ubicacion></mapa-ubicacion>
                    </div>
                    <h2 class="text-center text-white mb-4">Mas Informacion</h2>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">Ubicacion</span>
                        {{establecimiento.direccion}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">Colonia</span>
                        {{establecimiento.colonia}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">Horario</span>
                        {{establecimiento.apertura}} -
                        {{establecimiento.apertura}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">Telefono</span>
                        {{establecimiento.telefono}}
                    </p>
                </div>
            </aside>
        </div>
    </div>
</template>
<script>
import MapaUbicacion from './MapaUbicacion';
import GaleriaImagenes from './GaleriaImagenes';
    export default {
        components:{
            MapaUbicacion,
            GaleriaImagenes
        },
        mounted() {
            console.log(this.$route.params);
            const id=this.$route.params.id;
            axios.get(`/api/establecimientos/${id}`)
                .then((respuesta)=>{
                    if(respuesta && respuesta.data && respuesta.data) {
                        // this.hospitales=respuesta.data;
                        this.$store.commit('CARGAR_ESTABLECIMIENTO',respuesta.data);
                    }
                });
        },
        computed: {
            establecimiento(){
                //return this.$store.state.establecimiento;
                return this.$store.getters.getEstablecimiento;
            }
        },
    }
</script>
