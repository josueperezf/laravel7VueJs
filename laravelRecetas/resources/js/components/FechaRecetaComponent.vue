<!-- todo componente de vue debe tener una etiqueta template-->
<template>
    <span> {{formatearFecha}} </span>  
</template>

<script>
    export default {
        props:['fecha'],
        mounted() {
            console.log('el componente esta cargado', this.fecha);
        },   
        computed: {
            formatearFecha() {
                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY');
            }
        },
    }
</script>