<template>
        <div>
            <listado-categorias></listado-categorias>
            <mapa-establecimientos></mapa-establecimientos>
            <categoria-cafe></categoria-cafe>
            <categoria-hospital></categoria-hospital>
            <categoria-hotel></categoria-hotel>
        </div>
</template>

<script>
import CategoriaCafe from './CategoriaCafe';
import MapaEstablecimientos from './MapaEstablecimientos';
import CategoriaHospital from './CategoriaHospital';
import CategoriaHotel from './CategoriaHotel';
import ListadoCategorias from './ListadoCategorias';
    export default {
        components:{
            CategoriaCafe,
            CategoriaHospital,
            CategoriaHotel,
            MapaEstablecimientos,
            ListadoCategorias
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
