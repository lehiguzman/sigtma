<template>
    <div class="contenedor">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="float-left pr-1">
                            <b>Configuraciones -> Régimen de inmueble</b>
                        </h3>
                    </div>
                </div>
            </div>
        </div>        
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded shadow-container">        
                <div class="ml-5 mb-5">                    
                    <input type="button" value="Nuevo Régimen" v-on:click="cambiarVista('registro')" class="btn btn-primary btn-nuevo">                
                </div>                         
                <div class="float-right mb-0 input-search">
                    <span>Buscar : </span>
                    <input type="text" id="mySearchText" class="border" @keyup="buscar()">                
                </div>
                <div>
                    <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">ID</th>
                                <th width="40%">Régimen</th>
                                <th width="40%">Alicuota</th>                                
                                <th class="text-center" width="15%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="regimen in regimenes">
                                <td>{{ regimen.id }}</td>
                                <td>{{ regimen.regimen }}</td>
                                <td>{{ regimen.alicuota }}</td>                                                              
                                <td class="text-center">
                                    <i class='bx bxs-edit bx-sm mr-4 text-success btn-editar' title="Editar" @click="editarRegistro(regimen)"></i>
                                    <i class='bx bxs-trash bx-sm text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(regimen)"></i>
                                </td>
                            </tr>                            
                        </tbody>                  
                    </table>
                </div>
            </div>                   
        </template>
        <!-- formulario de Nuevo Regimen de inmueble-->
        <template v-else-if="vista=='registro'">
            <div class="p-5 bg-white rounded shadow-container">  
                 <div class="card-header">                    
                    <h4 class="card-text">{{ titulo }}</h4>
                </div>
                <div class="card-body mt-5">
                    <form class="needs-validation" novalidate>                       
                            
                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="regimen" class="col-md-3 col-form-label-lg">
                                    Nombre de Régimen
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="regimen" v-model="regimen" class="form-control" placeholder="Régimen" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca Nombre de Régimen!
                                    </div>                                                                
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                                
                            
                                <label for="alicuota" class="col-md-3 col-form-label-lg">
                                   Valor de Alicuota
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="alicuota" v-model="alicuota" class="form-control" placeholder="Valor de Alicuota" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-code bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Valor de alicuota!
                                    </div>
                                                                                                          
                                </div>                                    
                            </div>
                        </div>                                             

                        <div class="form-row mt-5">
                            <div class="col-md-1"></div>
                            
                            <div class="col-md-3 d-flex justify-content-center" v-if="boton == 'registro'" >                                    
                                <button type="button" @click="validarFormulario( 'registro' )" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Registrar</span>
                                </button>
                            </div>

                            <div class="col-md-3 d-flex justify-content-center" v-if="boton == 'edicion'" >                                    
                                <button type="button" @click="validarFormulario('edicion')" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Actualizar</span>
                                </button>
                            </div>

                            <div class="col-md-3 d-flex justify-content-center">
                                <i class='bx bx-cancel bx-sm' ></i>
                                <input type="button" name="cancelar" @click="cancelarRegistro()" class="btn btn-danger btn-cancelar" value="Cancelar">
                            </div>
                        </div>
                                               
                    </form>                    
                </div>
            </div>
        </template>        
    </div>
</template>

<style scoped>
    /* Se importan los estilos del modulo */
    @import "../../../public/css/usuario.css";
    @import "../../../public/css/switch.css";
</style>    

<script type="text/javascript">

    import datatable from 'datatables';    

    export default {
        data() {
            return {
                //Vista de listado de contribuyente de actividad económica
                vista: 'listado',
                titulo: 'Agregar Nuevo Régimen de Inmueble',
                regimenes: [],
                boton: 'registro',                
                tabla: '',

                //Vista de registro de contribuyente de actividad económica
                id: 0,
                regimen: '',
                alicuota: ''                
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
            datatable            
        },

        methods: {
            cambiarVista( opcion ) {                
                this.vista = opcion;

                if( this.vista == "listado") {
                    this.listarRegimenes();
                }               
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarRegimenes(){
                let me = this;

                var url = '/regimen';

                axios.get(url).then(function (response) {
                // handle success                      
                var respuesta = response.data;                                    
                me.regimenes = respuesta.regimenes.data;
                me.tablaRegimenes();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            tablaRegimenes() {
                $(function() {
                    this.tabla = $('#dataTable').DataTable(
                    {   
                        retrieve: true, 
                        searching: true,
                        ordering:  true,
                        select: true,
                        paging: true,

                        "language": 
                            {                        
                                 "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                            },               
                        "dom": '<"top"li>rt<"bottom"p><"clear">'
                    }); 
                });
            },            

            buscar() {
                $(function() {                    
                    $('#dataTable').dataTable().fnFilter($('#mySearchText').val());
                });
            }, 

////////////////////////* Registro de contribuyente de actividad económica *////////////////////////////////////////
            
            validarFormulario( accion ) {
                let me=this;
            
             var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    //form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                          event.preventDefault();
                          event.stopPropagation();                           
                        } else {
                           if( accion == 'registro' ) { 
                                console.log(accion);
                                me.agregarRegistro(); 
                            } else { 
                                me.actualizarRegistro(); 
                            }
                        }
                        form.classList.add('was-validated');
                    //}, false);
                });
            },

            agregarRegistro() {

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })                

                let me=this;
                
                axios.post('/regimen/registrar', {                                                
                        'regimen': me.regimen,
                        'alicuota': me.alicuota,                        
                    }).then(function (response) {                        
                        alerta.fire(
                            'Registro!',
                            'Registro exitoso.',
                            'success'
                        );
                        me.limpiarCampos();
                        me.cambiarVista( "listado" );                        

                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },

            editarRegistro( data ) {

                let me=this;
                me.id = data.id;                 
                var url = '/regimen?id='+me.id;

                 axios.get(url).then(function (response) {
                    // handle success                            
                    var respuesta = response.data;                     
                    var regimen = respuesta.regimenes;                    
                                                
                    me.regimen = regimen.regimen;
                    me.alicuota = regimen.alicuota;                    
                    me.titulo = 'Editar Régimen de Inmueble';
                    me.boton = "edicion";

                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .finally(function () {
                    // always executed
                  });

                this.vista = "registro";                 
            },

            actualizarRegistro() {                
                
                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })                

                let me=this;
                
                axios.put('/regimen/actualizar', {
                        'id': me.id,                      
                        'regimen': me.regimen,
                        'alicuota': me.alicuota,                        
                    }).then(function (response) {                        
                        alerta.fire(
                            'Actualizado!',
                            'Registro actualizado.',
                            'success'
                        );
                        me.limpiarCampos();
                        me.cambiarVista( "listado" );                        

                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },

            eliminarRegistro( data ) {
                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })

                alerta.fire({
                  title: '¿Estás seguro de eliminar el Régimen?',
                  text: '',                  
                  showCancelButton: true,
                  confirmButtonText: '<i class="fa fa-check fa-2x"></i>Aceptar',
                  cancelButtonText: '<i class="fa fa-times fa-2x"></i>Cancelar',                 
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                    let me=this;
                        axios.delete('/regimen/eliminar/'+data.id).then(function (response) {  
                                //console.log( response );                                
                                alerta.fire(
                                    'Eliminado!',
                                    'Registro eliminado.',
                                    'success'
                                );
                                me.regimenes = [];                                
                                me.cambiarVista("listado");                                
                            }).catch(function (error) {
                            // handle error
                            console.log(error);
                            });                    
                  } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                  ) {                    
                  }
                })
            },

            cancelarRegistro() {
                this.limpiarCampos();
                this.cambiarVista("listado");
            },

            limpiarCampos() {                
                this.regimenes = [];
                this.id = 0;
                this.regimen = 0;
                this.alicuota = '';                
                this.boton = 'registro';
                this.titulo = 'Agregar Nuevo Régimen';
            },
        },

        mounted() {
            this.listarRegimenes();
            console.log('Component mounted.')
        }
    }
</script>
