<template>
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Tipo de Inmueble</h4>
            </div>     
        </div>     
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded">        
                <div class="ml-5 mb-5">                    
                    <input type="button" value="Nuevo Tipo de inmueble" v-on:click="cambiarVista('registro')" class="btn btn-primary btn-nuevo">                
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
                                <th width="15%">Numeral</th>
                                <th width="40%">Descripción</th>
                                <th width="30%">Exonerado</th>                                
                                <th class="text-center" width="10%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="tipo_inmueble in tipos_inmueble">
                                <td>{{ tipo_inmueble.id }}</td>
                                <td>{{ tipo_inmueble.numeral }}</td>
                                <td>{{ tipo_inmueble.descripcion }}</td>
                                <td v-if="tipo_inmueble.exonerado == 1">SI</td>
                                <td v-if="tipo_inmueble.exonerado == 0">NO</td>
                                <td class="text-center">
                                    <i class='bx bxs-edit bx-sm mr-4 text-success btn-editar' title="Editar" @click="editarRegistro(tipo_inmueble)"></i>
                                    <i class='bx bxs-trash bx-sm text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(tipo_inmueble)"></i>
                                </td>
                            </tr>                            
                        </tbody>                  
                    </table>
                </div>
            </div>                   
        </template>
        <!-- formulario de Nuevo Tipo de Inmueble-->
        <template v-else-if="vista=='registro'">
            <div class="p-3 bg-white rounded">  
                <div class="col-md-12 mb-0 text-center bg-light">
                    <h4>{{ titulo }}</h4>
                </div>
                <div class="card-body mt-5">
                    <form class="needs-validation" novalidate>                       
                            
                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="numeral" class="col-md-3 col-form-label-lg">
                                    Numeral
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="numeral" v-model="numeral" class="form-control" placeholder="Numeral" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca numeral!
                                    </div>                                                                
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                                
                            
                                <label for="descripcion" class="col-md-3 col-form-label-lg">
                                    Descripción
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="descripcion" v-model="descripcion" class="form-control" placeholder="Descripción" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-book-reader bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca descripción!
                                    </div>
                                                                                                          
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                                
                            
                                <label for="descripcion" class="col-md-3 col-form-label-lg">
                                    ¿Exonerado?
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" v-model="exonerado" value="exonerado" required>
                                       <option value="" selected disabled>Exonerado</option>
                                       <option value="1">SI</option>
                                       <option value="0">NO</option>
                                    </select>
                                    <div class="form-control-position">
                                        <i class='bx bx-question-mark bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Seleccione exoneración!
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
                titulo: 'Nueva Tipo de Inmueble',
                tipos_inmueble: [],
                boton: 'registro',                
                tabla: '',

                //Vista de registro de contribuyente de actividad económica
                id: 0,
                numeral: '',                
                descripcion: '',
                exonerado: ''                
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
                    this.listarTipoInmuebles();
                }                
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarTipoInmuebles(){
                let me = this;

                var url = '/tipo_inmueble';

                axios.get(url).then(function (response) {
                // handle success                      
                var respuesta = response.data;                                    
                me.tipos_inmueble = respuesta.tipos_inmueble.data;
                me.tablaTipoInmuebles();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            tablaTipoInmuebles() {
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
                
                axios.post('/tipo_inmueble/registrar', {                                                
                        'numeral': me.numeral,                        
                        'descripcion': me.descripcion,
                        'exonerado':me.exonerado,                        
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
                var url = '/tipo_inmueble?id='+me.id;

                 axios.get(url).then(function (response) {
                    // handle success                            
                    var respuesta = response.data;                     
                    var tipo_inmueble = respuesta.tipos_inmueble;                    
                                                
                    me.numeral = tipo_inmueble.numeral;                    
                    me.descripcion = tipo_inmueble.descripcion;
                    me.exonerado = tipo_inmueble.exonerado;                    
                    me.titulo = 'Editar Tipo de Inmueble';
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
                
                axios.put('/tipo_inmueble/actualizar', {
                        'id': me.id,                      
                        'numeral': me.numeral,                        
                        'descripcion': me.descripcion,
                        'exonerado': me.exonerado,
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
                  title: '¿Estás seguro de eliminar el Tipo de Inmueble?',
                  text: '',                  
                  showCancelButton: true,
                  confirmButtonText: '<i class="fa fa-check fa-2x"></i>Aceptar',
                  cancelButtonText: '<i class="fa fa-times fa-2x"></i>Cancelar',                 
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                    let me=this;
                        axios.delete('/tipo_inmueble/eliminar/'+data.id).then(function (response) {  
                                //console.log( response );                                
                                alerta.fire(
                                    'Eliminado!',
                                    'Registro eliminado.',
                                    'success'
                                );
                                me.tipos_inmueble = [];                                
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
                this.tipos_inmueble = [];
                this.id = 0;
                this.numeral = '';                
                this.descripcion = '';
                this.exonerado = '';                
                this.boton = 'registro';
                this.titulo = 'Agregar Nuevo Tipo de Inmueble';
            },
        },

        mounted() {
            this.listarTipoInmuebles();
            console.log('Component mounted.')
        }
    }
</script>
