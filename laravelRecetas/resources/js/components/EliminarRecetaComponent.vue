<!-- todo componente de vue debe tener una etiqueta template-->
<template>
    <button
        type="submit"
        class="btn btn-danger w-100 d-block mb-2"
        @click="eliminarReceta"
        >Eliminar</button>
</template>

<script>
    export default {
        props:['recetaId'],
        mounted() {
            console.log('el componente eliminar receta esta cargado', this.recetaId);
        },   
        computed: {
            formatearFecha() {
                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY');
            }
        },
        methods: {
            eliminarReceta() {
                console.log('quieres eliminar al id: '+ this.recetaId);
                /*
                -----instalacion de vue-sweetalert2---
                https://www.npmjs.com/package/vue-sweetalert2
                npm install -S vue-sweetalert2
                lo uso el eliminar receta para hacer confirm
                en el archivo app.js se debe agregar esto 
                import VueSweetalert2 from 'vue-sweetalert2';
                Vue.use(VueSweetalert2);
                */
                /*
                this.$swal({
                    'title':'Probar alert',
                    'text':'Funciona Bien!',
                    'icon': 'success'
                });*/
                // documentacion
                this.$swal.fire({
                    title: 'Deseas eliminar esta receta?',
                    text: "Una vez eliminada no se puede recuperar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                    }).then((result) => {
                    if (result.value) {
                        const params = {
                            id: this.recetaId
                        };

                        axios.post(`/recetas/${this.recetaId}`,{params, _method: 'delete'})
                            .then((respuesta)=> {
                                this.$swal.fire({
                                    title: 'Receta Eliminada',
                                    text: 'Se elimino la receta',
                                    icon: 'success',
                                })
                                // eliminar receta el DOM
                                // this.$el es el elemento actual que esta usando vue, en este caso es el button de eliminar
                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);

                            })
                            .catch((error)=> {
                                console.log(error);
                            })
                        
                    }
                    })
            }
        },
    }
</script>
