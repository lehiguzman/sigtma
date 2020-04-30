<template>
    <div class="contenedor">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="float-left pr-1">
                            <b>Contribuyente -> Actividad económica</b>
                        </h3>
                    </div>
                </div>
            </div>
        </div>        
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded shadow-container">        
                <div class="ml-5 mb-5">                    
                    <input type="button" value="Nueva Contribuyente" v-on:click="cambiarVista('registro')" class="btn btn-primary btn-nuevo">                
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
                                <th width="10%">Licencia</th>   
                                <th width="25%">Denominación</th>                                
                                <th width="10%">Rif</th>
                                <th width="10%">Fecha de Inscripción</th>
                                <th class="text-center" width="10%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="comercio in comercios">
                                <td>{{ comercio.id }}</td>                                
                                <td>{{ comercio.licencia }}</td>                                
                                <td>{{ comercio.denominacion }}</td>
                                <td>{{ comercio.rif }}</td>
                                <td>{{ comercio.fecha_inscripcion }}</td>
                                <td class="text-center">
                                    <i class='bx bxs-edit bx-sm mr-2 text-success btn-editar' title="Editar" @click="editarRegistro(comercio)"></i>
                                    <i class='bx bxs-trash bx-sm mr-2 text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(comercio)"></i>                                    
                                </td>
                            </tr>                            
                        </tbody>                  
                    </table>
                </div>
            </div>                   
        </template>
        <!-- formulario de Nuevo Contribuyente de actividad comercial-->
        <template v-else-if="vista=='registro'">
            <div class="p-5 bg-white rounded shadow-container">  
                 <div class="card-header">                    
                    <h4 class="card-text">{{ titulo }}</h4>
                </div>
                <div class="card-body mt-5">
                    <form class="needs-validation" novalidate>

                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="denominacion" class="col-md-3 col-form-label-lg">
                                    Actividad Económica
                                </label> 

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" v-model="tipoArray" value="tipoArray" multiple required>
                                       <option value="" selected disabled>Seleccione Tipo</option>
                                       <option v-for="tipo in tipos" :key="tipo.id" :value="tipo.id" v-text="tipo.denominacion"></option>
                                    </select>                                    
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Seleccione Tipo de Actividad comercial!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm' ></i>
                                    </div>                                    
                                </div>                                    
                            </div>
                        </div> 

                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="licencia" class="col-md-3 col-form-label-lg">
                                    Licencia
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="licencia" v-model="licencia" class="form-control" placeholder="Licencia" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca licencia!
                                    </div>                                                                
                                </div>                                    
                            </div>
                        </div>          
                            
                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="denominacion" class="col-md-3 col-form-label-lg">
                                    Denominación
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="denominacion" v-model="denominacion" class="form-control" placeholder="Denominación" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca denominación!
                                    </div>                                                                
                                </div>                                    
                            </div>
                        </div>                        

                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="rif" class="col-md-3 col-form-label-lg">
                                    Rif
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="rif" v-model="rif" class="form-control" placeholder="Rif" required>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Rif o Cédula!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="fecha_inscripcion" class="col-md-3 col-form-label-lg">
                                    Fecha inscripción
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <datepicker name="fecha_inscripcion" v-model="fecha_inscripcion" bootstrap-styling format="dd/MM/yyyy" placeholder="Fecha de inscripción" required>
                                    </datepicker>
                                    
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca fecha de inscripción!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bxs-calendar-star bx-sm' ></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="cedula" class="col-md-3 col-form-label-lg">
                                    Cédula
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="cedula" v-model="cedula" class="form-control" placeholder="Cédula de Representante Legal">                                    
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="telefono" class="col-md-3 col-form-label-lg">
                                    Teléfono
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="telefono" v-model="telefono" class="form-control" placeholder="Teléfono">                                    
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="direccion" class="col-md-3 col-form-label-lg">
                                    Dirección
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="direccion" v-model="direccion" class="form-control" placeholder="Dirección">                                    
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
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
    import Datepicker from 'vuejs-datepicker';   

    export default {
        data() {
            return {
                //Vista de listado de contribuyente de actividad económica
                vista: 'listado',
                titulo: 'Agregar Nuevo Contribuyente',
                comercios: [],
                tipos: [],
                boton: 'registro',                
                tabla: '',

                //Vista de registro de contribuyente de actividad económica
                id: 0,
                tipoArray: [],
                licencia: '',
                rif:'',
                denominacion: '',
                fecha_inscripcion: '',                
                cedula: '',
                direccion: '',
                telefono: ''
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
            datatable,
            Datepicker          
        },

        methods: {
            cambiarVista( opcion ) {                
                this.vista = opcion;                

                if(this.vista == "registro") {
                    this.listarTipos();
                } else {
                    this.listarComercios();
                }
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarComercios(){

                this.listarTipos();

                let me = this;

                var url = '/comercio';

                axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;                                    
                me.comercios = respuesta.comercios.data;
                console.log("Comercios : ", me.comercios);
                if( me.comercios.length == 0 ) {
                    me.limpiarCampos();
                    me.tablaComercios();
                } else {
                    me.tablaComercios();    
                }
                
                console.log("Numero de registro : ", me.comercios.length);
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            tablaComercios() {
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

            /*asignaTipo(e)
            {                
                this.tipoArray                  
                               

                 console.log( "Arreglo : ", this.tipoArray );
            },*/

            listarTipos() {
                let me = this;

                var url = '/tipo_comercio';

                axios.get(url).then(function (response) {
                    // handle success                    
                    var respuesta = response.data;                    
                    me.tipos = respuesta.tipos_comercio.data;     
                    console.log("Response : ", me.tipos);                    
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .finally(function () {
                    // always executed
                  });
            },
            
            validarFormulario( accion ) {
                let me=this;
            
             var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    //form.addEventListener('submit', function(event) {
                        console.log("Formulario : ", forms);
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

                console.log("Tipos : ", this.tipoArray);

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })                

                let me=this;
                console.log("Array de tipo ", me.tipoArray);               
                
                axios.post('/comercio/registrar', {
                        'licencia': me.licencia,
                        'denominacion': me.denominacion,
                        'cedula': me.cedula,
                        'fecha_inscripcion': me.fecha_inscripcion,
                        'rif': me.rif,
                        'direccion':me.direccion,
                        'telefono':me.telefono,
                        'tipos': me.tipoArray

                    }).then(function (response) {   

                        console.log("Respuesta : ", response);
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
                var url = '/comercio?id='+me.id;

                 axios.get(url).then(function (response) {
                    // handle success                            
                    var respuesta = response.data;                     
                    var comercio = respuesta.comercios;            
                    var tipoArray = respuesta.tipos;
                    console.log("Comercio data : ", respuesta.tipos); 
                    
                    me.licencia = comercio.licencia;
                    me.denominacion = comercio.denominacion;                    
                    me.fecha_inscripcion = comercio.fecha_inscripcion;
                    me.rif = comercio.rif;
                    me.cedula = comercio.cedula;
                    me.direccion = comercio.direccion;
                    me.telefono = comercio.telefono;
                    me.titulo = 'Editar contribuyente';
                    me.boton = "edicion";
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .finally(function () {
                    // always executed
                  });

                this.cambiarVista("registro");               
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

                console.log("Arreglo de tipos : ", me.tipoArray);
                
                axios.put('/comercio/actualizar', {
                        'id': me.id,                          
                        'licencia': me.licencia,                        
                        'denominacion': me.denominacion,                        
                        'cedula': me.cedula,
                        'fecha_inscripcion': me.fecha_inscripcion,
                        'rif': me.rif,
                        'direccion':me.direccion,
                        'telefono':me.telefono,
                        'tipos': me.tipoArray
                    }).then(function (response) {

                        console.log("Respuesta actualizar :", response);
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
                  title: '¿Estás seguro de eliminar el Objetivo?',
                  text: '',                  
                  showCancelButton: true,
                  confirmButtonText: '<i class="fa fa-check fa-2x"></i>Aceptar',
                  cancelButtonText: '<i class="fa fa-times fa-2x"></i>Cancelar',                 
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                    let me=this;
                        axios.delete('/comercio/eliminar/'+data.id).then(function (response) {  
                                //console.log( response );                                
                                alerta.fire(
                                    'Eliminado!',
                                    'Registro eliminado.',
                                    'success'
                                );
                                me.comercios = [];                                
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
                this.comercios = [];
                this.id = 0;
                this.licencia = '',
                this.tipo = '';
                this.denominacion = '';
                this.fecha_inscripcion;                
                this.rif = '';
                this.cedula = '';
                this.direccion = '';
                this.telefono = '';
                this.boton = 'registro';
                this.titulo = 'Agregar Nuevo Contribuyente';
            },
        },

        mounted() {
            this.listarComercios();                 
            console.log('Component mounted.')
        }
    }
</script>
