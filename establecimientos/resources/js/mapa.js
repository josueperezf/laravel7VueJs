// import https://github.com/smeijer/leaflet-geosearch
import { OpenStreetMapProvider } from 'leaflet-geosearch';
// setup
const provider = new OpenStreetMapProvider();

// https://leafletjs.com/
if(document.querySelector('#mapa') ) {
    document.addEventListener('DOMContentLoaded', () => {
        const lat = document.querySelector('#latitud').value ==='' ? -32.89014793880882: document.querySelector('#latitud').value;
        const lng = document.querySelector('#longitud').value ==='' ? -71.25600409071683: document.querySelector('#longitud').value;
        const mapa = L.map('mapa').setView([lat, lng], 16);
        const debounceES6 = (callback, wait, immediate=false) => {
            let timeout = null
            return (...args) => {
              const callNow = immediate && !timeout
              const next = () => callback(...args)
              clearTimeout(timeout)
              timeout = setTimeout(next, wait)
              if (callNow) { next() }
            }
        };
        // eliminar pines o market previos, markers es como una capa arriba, se usa para eliminar los pines previos para que al crear el nuevo pin no confundamos el nuestro con uno ya existente
        let markers = new L.FeatureGroup().addTo(mapa);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng],{
            draggable:true,
            autoPan:true
        }).addTo(mapa);
        // agregar el pin de mi direccion a la capa, esto lo hago para crear como un grupo de marcas y poder ocultarlas todas si gusto
        markers.addLayer(marker);
        // plugin geocodeservice
        const geocodeService= L.esri.Geocoding.geocodeService();
        // input para buscar
        const inputBuscadorDirecciones = document.querySelector('#formBuscador');
        inputBuscadorDirecciones.addEventListener('input',debounceES6(buscarDireccion, 1000, true));
        // Detectar movimiento del marker
        reubucarPin(marker);

        function reubucarPin(marker) {
            marker.on('moveend', function(e) {
                const marca = e.target;
                const posicion = marca.getLatLng();
                // centrar automaticamente
                mapa.panTo(new L.LatLng(posicion.lat, posicion.lng));
                //https://leafletjs.com/plugins.html    plugin a usar Esri Leaflet Geocoder
                // https://github.com/Esri/esri-leaflet-geocoder
                //Reverse Geocoding
                geocodeService.reverse().latlng(posicion,16).run(function(error, resultado){
                    // console.log(error);
                    // console.log(resultado);
                    marker.bindPopup(resultado.address.LongLabel+' Josue');
                    marker.openPopup();
                    //llenar los campos del formulario
                    llenarInputs(resultado);
                });

            });
        }
        function buscarDireccion() {
            const texto = document.querySelector('#formBuscador').value;
            const geocodeService= L.esri.Geocoding.geocodeService();
            // console.log(texto);
            if(texto.length > 1){
                provider.search({ query: texto + ' Quillota ' })
                    .then((resultado)=>{
                        console.log(resultado.length);
                        if(resultado && resultado.length>0) {
                            // limpiar pines previos, pines son las marcas de otras direcciones
                            markers.clearLayers();
                            geocodeService.reverse().latlng(resultado[0].bounds[0],16).run(function(error, result){
                                // llenar los inputs
                                llenarInputs(result);
                                //centrar el mapa
                                mapa.setView(result.latlng, 16);
                                //agregar el pin
                                marker = new L.marker(result.latlng,{
                                    draggable:true,
                                    autoPan:true
                                }).addTo(mapa);

                                // asignar al contenedor de markers el pin creado
                                markers.addLayer(marker);
                                //mover el pin
                                reubucarPin(marker);
                                // marker.bindPopup(result.address.LongLabel+' Josue');
                                //marker.openPopup();
                                // console.log(result);
                            });

                            // console.log(resultado[0].bounds[0]);
                        }
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
            }
            //
        }
        function llenarInputs(resultado){
            // console.log(resultado);
            document.querySelector('#direccion').value=resultado.address.Address || '';
            document.querySelector('#colonia').value=resultado.address.City || '';
            document.querySelector('#latitud').value=resultado.latlng.lat || '';
            document.querySelector('#longitud').value=resultado.latlng.lng || '';
        }

        function debounceES5(func, wait, immediate) {
            var timeout;
            return function () {
                var context = this, args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        };

    });
    /*
    function buscarDireccion(e){
        // para buscar se usa el plugin https://github.com/smeijer/leaflet-geosearch
        // npm install --save leaflet-geosearch
        const texto = e.target.value;
        console.log('entroooo');
        debounceES6(llamar, 1000, true);
    }*/

}

