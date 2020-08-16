<template>    
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Registro de alumnos</h4>
            </div>     
        </div>       
        <!-- formulario de Nuevo Contribuyente de actividad comercial-->
        <template>
            <div class="p-3 bg-white rounded">  
                <div class="col-md-12 mb-0 text-center bg-light" style="z-index:-1">
                    <h4>Registro</h4>
                </div>
                <div class="mt-5" style="z-index:-999">
                    <form class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="denominacion" class="col-md-3 col-form-label-lg">
                                    Nombre de Alumno
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="nombre" v-model="nombre" class="form-control" placeholder="Nombre de Alumno" required >
                                </div>                                    
                            </div>
                        </div>                           
                        <div class="form-row mt-5">
                            <div class="col-md-3"></div>
                            
                            <div class="col-md-3 d-flex justify-content-center" >                                    
                                <button type="button" name="registro" @click="registrar()" class="btn btn-primary btn-registrar">
                                    <span class="align-middle ml-25">Registrar</span>
                                </button>
                            </div>                                                        
                        </div>                                               
                    </form>                                   
                </div>
            </div>
        </template>
        <!--Inicio del modal agregar/actualizar-->             
    </div>
        
</template>

<style scoped>
    /* Se importan los estilos del modulo */
    @import "../../../public/css/usuario.css";
    
</style>    

<script type="text/javascript">
   
    export default {
        data() {
            return {
               nombre: null,
            }            
        },
    
        methods: {           
            registrar() {

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })                

                let me=this;
                
                
                axios.post('/registrar', {
                        'nombre': me.nombre,
                    }).then(function (response) {   

                        me.nombre = null;
                        console.log("Respuesta : ", response);
                        alerta.fire(
                            'Registro!',
                            'Registro exitoso.',
                            'success'
                        );
                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },
        },       

        mounted() {                        
            console.log('Component mounted.')
        }
    }
</script>
