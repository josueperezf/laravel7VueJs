<template>
    <span
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
        :class="estaActivo()"
        @click="cambiarEstado()"
        :key="estadoVacanteData"
    >
        {{ estadoVacante2() }}
    </span>
</template>
<script>
export default {
    props:[
        'estado','vacanteId'
    ],
    data() {
        return {
            estadoVacanteData:null
        }
    },
    mounted() {
        this.estadoVacanteData = Number(this.estado);
    },
    methods: {
        // los metods son para mejoar eventos
        estaActivo(){
            return (this.estadoVacanteData===1)? 'bg-green-100 text-green-800': 'bg-red-100 text-red-800';
        },
        cambiarEstado(){
            this.estadoVacanteData=Number(!this.estadoVacanteData);
            const parametros={
                estado:this.estadoVacanteData
            }
            axios
                .post('/vacantes/'+this.vacanteId, parametros)
                .then((respuesta)=>{
                    console.log(respuesta);
                })
        },
        estadoVacante2(){
            return this.estadoVacanteData ===1? 'ACTIVA': 'INACTIVA';
        }
    },
    computed: {
        // los computed es cuando esta listo el documento se ejecuta, se llama cada vez que hay un cambio en el documento
        /*estadoVacante(){
            console.log('entro a computed');
            return this.estadoVacanteData ===1? 'ACTIVA': 'INACTIVA';
        }*/
    },
}
</script>
