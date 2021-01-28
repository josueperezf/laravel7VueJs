<template>
    <ul class="flex flex-wrap justify-center" >
        <li
            class="border border-gray-500 px-10 py-3 mb-3 rounded mr-4" 
            v-for="(habilidad, i) of this.habilidades"
            :class="verificarClaseActiva(habilidad)"
            v-bind:key="i"
            v-on:click="activar($event)"
         >{{habilidad}}</li>
    </ul>
</template>

<script>
    export default {
        props:['habilidades', 'old_habilidades'],
        created(){
            if(this.old_habilidades) {
                const habilidadesArray = this.old_habilidades.split(',');
                habilidadesArray.forEach(habilidad => {
                     this.habilidadesSeleccionadas.add(habilidad);
                     this.verificarClaseActiva(habilidad);
                });
            }
        },
        mounted() {
            //console.log(this.old_habilidades);
            document.querySelector("#inputHabilidades").value=this.old_habilidades;
        },
        data() {
            return {
                habilidadesSeleccionadas : new Set()
            }
        },
        methods: {
            activar(e){
                console.log(e.target.textContent);
                if(e.target.classList.contains('bg-teal-400')){
                    e.target.classList.remove('bg-teal-400');
                    //eliminar de hablidades
                    this.habilidadesSeleccionadas.delete(e.target.textContent);
                }else {
                    e.target.classList.add('bg-teal-400');
                    this.habilidadesSeleccionadas.add(e.target.textContent);
                }
                // const stringHabilidades = [...this.habilidadesSeleccionadas];
                const stringHabilidades = Array.from(this.habilidadesSeleccionadas);
                document.querySelector('#inputHabilidades').value=stringHabilidades;
            },
            verificarClaseActiva(habilidad){
                return (this.habilidadesSeleccionadas.has(habilidad))? 'bg-teal-400' : ''
            }
        },
    }
</script>
