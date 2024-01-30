<template>
    <!-- Main modal -->
    <div></div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps(['idRepresentante','arrRepresentante','hideModal']);
const emits = defineEmits(['addRepresentante']);

function setValues(){
    if(props.idRepresentante.value != 0){
        txtSelectDocumento.value=props.objRepresentante['tipo_documento']
        txtDocumento.value=props.objRepresentante['documento']
        txtNombre.value=props.objRepresentante['nombre']
        txtSegundoNombre.value=props.objRepresentante['segundo_nombre']
        txtApellido.value=props.objRepresentante['apellido']
        txtSegundoApellido.value=props.objRepresentante['segundo_apellido']
        txtSelectRepresentante.value=props.objRepresentante['representante']
        txtTelefono.value=props.objRepresentante['telefono']
        txtCorreo.value=props.objRepresentante['correo']
    }
}
</script>
