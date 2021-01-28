<template>
    <div class="mapa">
        <l-map
            :zoom="zoom"
            :center="center"
            :options="mapOptions"
        >
            <l-tile-layer :url="url" :attribution="attribution" />
            <l-marker
                v-for="establecimiento of establecimientos"
                v-bind:key="establecimiento.id"
                :lat-lng="obtenerCoordenadas(establecimiento)"
                :icon="iconoEstablecimiento(establecimiento)"
                @click="redireccionar(establecimiento.id)"
                >
                <l-tooltip>
                    <div>{{establecimiento.nombre}} - {{establecimiento.categoria.nombre}}</div>
                </l-tooltip>

            </l-marker>
        </l-map>
    </div>
</template>
<script>
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LTooltip, LIcon } from "vue2-leaflet";

export default {
    components:{
        LMap, LTileLayer, LMarker, LTooltip, LIcon
    },
    data() {
        return {
        zoom: 13,
        center: latLng(-32.89014793880882, -71.25600409071683),
        url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        attribution:
            '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        currentZoom: 11.5,
        currentCenter: latLng(-32.89014793880882, -71.25600409071683),
        showParagraph: false,
        mapOptions: {
            zoomSnap: 0.5
        },
        showMap: true,
        lat: "",
        lng: ""
        };
  },
  created() {
      axios.get('/api/establecimientos')
        .then((respuesta)=>{
            if(respuesta && respuesta.data ) {
                this.$store.commit('CARGAR_ESTABLECIMIENTOS', respuesta.data);
            }
        });
  },
  computed: {
      establecimientos(){
        return this.$store.getters.getEstablecimientos;
      }
  },
  methods: {
      obtenerCoordenadas(establecimiento){
          return {lat:establecimiento.latitud, lng:establecimiento.longitud};

      },
      iconoEstablecimiento(establecimiento) {
          const {slug} = establecimiento.categoria;
          return L.icon({
              iconUrl:`images/iconos/${slug}.png`,
              iconSize:[40,50]
          })
          console.log(establecimiento);
      },
      redireccionar(id) {
          this.$router.push({name:'establecimiento', params: {id: id}})
      }
  },
  // watch es como event emitter o algo asi, analiza si esa varible cambio y determina que debe hacer luego del cambio detectado
  watch: {
      "$store.state.categoria":function(slug){
        // console.log('cambio');
        console.log(slug);
        axios.get(`/api/${slug}`)
            .then((respuesta)=>{
                if(respuesta && respuesta.data) {
                    this.$store.commit('CARGAR_ESTABLECIMIENTOS', respuesta.data);
                }
            });
      }
  },
}
</script>
<style  scoped>
    .mapa{
        height: 600px;
        width: 100%;
    }
</style>
