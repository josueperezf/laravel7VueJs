const { default: Axios } = require("axios");
const { get } = require("jquery");

document.addEventListener('DOMContentLoaded', () => {
    if(document.querySelector('#dropzone')){
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone("div#dropzone", {
            url: "/imagenes/store",
            dictDefaultMessage:'Sube hasta 10 imagenes',
            maxFiles:10,
            required:true,
            acceptedFiles:".png,.jpg,.jpeg,.gif,.bmp",
            addRemoveLinks:true,
            dictRemoveFile:'Remover Archivo',
            headers:{
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            // init es el metodo que se ejecuta inicialmente, es usado para agregarle valores en el caso de editar establecomiento, o colocar imagenes por default
            init: function() {
                const imagenes = Array.from(document.querySelectorAll('.galeria'));
                if(imagenes.length > 0) {
                    imagenes.forEach((imagen)=> {
                        const imagenPublicada = {};
                        imagenPublicada.size = 1;
                        imagenPublicada.name = imagen.value;
                        imagenPublicada.nombreEnServidor=imagen.value;

                        // para agregarlo ya a dropzone, ejecutamos los siguiente
                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.thumbnail.call(this, imagenPublicada, `/storage/${imagenPublicada.name}`);
                        imagenPublicada.previewElement.classList.add('dz-success');
                        // esta class css es para que aprezca como si se cargo al 100%
                        imagenPublicada.previewElement.classList.add('dz-complete');

                        console.log(imagenPublicada);
                    });
                }
            },
            success: function(file, respuesta){
                //console.log(file);
                console.log(respuesta);
                file.nombreEnServidor=respuesta.archivo;
                console.log(file);
            },
            sending:function(file, xhr, formData){
                // SE USARA INTERVENTION IMAGE PARA EDITAR LAS IMAGENES ANTES DE SUBIRLAS
                // composer require intervention/image
                formData.append('uuid', document.querySelector('#uuid').value);
                file.previewElement.classList.add('dz-success');
                //cuando envias algo al servidor
            },
            removedfile: function(file, respuesta) {
                // ${file.nombreEnServidor.replace('establecimientos/', '')}
                //  el uuid es para validar que la persona que trata de eliminar es quien lo creo
                const parametros = {
                    uuid:   document.querySelector('#uuid').value,
                    imagen: file.nombreEnServidor
                };
                Axios.post(`/imagenes/destroy`,parametros)
                     .then((resp)=>{
                        console.log(resp);
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    })
                     .catch((error)=>{console.log(error)});
            }
        });
    }
});
