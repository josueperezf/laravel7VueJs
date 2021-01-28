<!-- todo componente de vue debe tener una etiqueta template-->
<template>
    <div>
        <span
            class="like-btn"
            @click="likeReceta"
            :class="{ 'like-active': isActive }"
            ></span>
        <p>{{cantidadLike}} les  gusto esta receta</p>
    </div>
</template>
<!-- data()  permite tener valores y le da un comportamiento reactivo a sus variables-->
<script>
    export default {
        props:['receta_id','like','likes'],
        mounted() {
            console.log(this.likes);
        },
        data() {
            return {
                isActive: this.like,
                totalLikes: this.likes,
            }
        },
        methods: {
            likeReceta(){
                // let likeActual=this.like;
                axios.post('/recetas/'+this.receta_id)
                    .then((respuesta)=>{
                        console.log(respuesta);
                        if(respuesta.data.attached.length > 0) {
                            this.$data.totalLikes++;
                        } else {
                            this.$data.totalLikes--;
                        }
                        this.isActive = !this.isActive;
                    })
                    .catch((error)=> {
                            if(error.response.status===401) {
                                window.location = '/register';
                            }
                        })
            }
        },
        computed: {
            cantidadLike(){
                return this.totalLikes;
            }
        },
    }
</script>