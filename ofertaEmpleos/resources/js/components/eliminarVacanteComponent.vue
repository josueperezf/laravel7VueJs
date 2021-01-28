<template>
    <button
        class="text-red-600 hover:text-red-900  mr-5"
        @click="eliminarVacante($event)"
    >Eliminar</button>
</template>
<script>
export default {
    props:[
        'vacanteId'
    ],
    methods: {
        eliminarVacante(e){
            this.$swal.fire({
                title: 'Deseas eliminar esta vacante?',
                text: "Una vez eliminada no se puede recuperar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    axios
                    .delete('/vacantes/'+this.vacanteId)
                    .then((respuesta)=>{
                        e.target.parentNode.parentNode.remove();
                        this.$swal.fire(
                        'Vacante eliminada!',
                        respuesta.data.mensaje,
                        'success'
                        )
                    })
                }
            })
        }
    },
}
</script>
