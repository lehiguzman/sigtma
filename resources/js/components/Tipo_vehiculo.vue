<template>
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Tipo de Vehiculo</h4>
            </div>     
        </div>        
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded">        
                <div class="ml-5 mb-5">                    
                    <input type="button" value="Nuevo Tipo Vehiculo" v-on:click="cambiarVista('registro')" class="btn btn-primary btn-nuevo">                
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
                                <th width="40%">Tipo</th>
                                <th width="30%">Descripcion</th>
                                <th width="15%">Monto Unidad Tributaria</th>                                
                                <th class="text-center" width="10%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="tipo_vehiculo in tipos_vehiculo">
                                <td>{{ tipo_vehiculo.id }}</td>
                                <td>{{ tipo_vehiculo.tipo }}</td>
                                <td>{{ tipo_vehiculo.descripcion }}</td>
                                <td>{{ tipo_vehiculo.monto_ut }}</td>                                
                                <td class="text-center">
                                    <i class='bx bxs-edit bx-sm mr-4 text-success btn-editar' title="Editar" @click="editarRegistro(tipo_vehiculo)"></i>
                                    <i class='bx bxs-trash bx-sm text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(tipo_vehiculo)"></i>
                                </td>
                            </tr>                            
                        </tbody>                  
                    </table>
                </div>
            </div>                   
        </template>
        <!-- formulario de Nuevo Tipo de Contribuyente Vehiculo -->
        <template v-else-if="vista=='registro'">
            <div class="p-3 bg-white rounded">  
                <div class="col-md-12 mb-0 text-center bg-light">
                    <h4>{{ titulo }}</h4>
                </div>
                <div class="card-body mt-5">
                    <form class="needs-validation" novalidate>                       
                            
                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="tipo" class="col-md-3 col-form-label-lg">
                                    Tipo
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="tipo" v-model="tipo" class="form-control" placeholder="Tipo de Vehiculo" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca tipo de vehiculo!
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
                                    <textarea name="descripcion" v-model="descripcion" class="form-control" placeholder="Descripción" required> {{descripcion}} </textarea>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca descripción!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bx-pen bx-sm'></i>
                                    </div>                                   
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                                
                            
                                <label for="monto_ut" class="col-md-3 col-form-label-lg">
                                    Monto Unidad Tributaria
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="monto_ut" v-model="monto_ut" class="form-control" placeholder="Monto Unidad Tributaria" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-code bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Monto Unidad Tributaria!
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
                titulo: 'Nueva Tipo de Vehiculo',
                tipos_vehiculo: [],
                boton: 'registro',                
                tabla: '',

                //Vista de registro de contribuyente de Vehiculo
                id: 0,
                tipo: '',                
                descripcion: '',
                monto_ut: '',                
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
                    this.listarTipoVehiculos();
                }               
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarTipoVehiculos(){
                let me = this;

                var url = '/tipo_vehiculo';

                axios.get(url).then(function (response) {
                // handle success                      
                var respuesta = response.data;                                    
                me.tipos_vehiculo = respuesta.tipos_vehiculo.data;
                me.tablaTipoVehiculos();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            tablaTipoVehiculos() {
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
                
                axios.post('/tipo_vehiculo/registrar', {                                                
                        'tipo': me.tipo,                        
                        'descripcion': me.descripcion,
                        'monto_ut':me.monto_ut,                        
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
                var url = '/tipo_vehiculo?id='+me.id;

                 axios.get(url).then(function (response) {
                    // handle success                            
                    var respuesta = response.data;                     
                    var tipo_vehiculo = respuesta.tipos_vehiculo;
                                                
                    me.tipo = tipo_vehiculo.tipo;
                    me.descripcion = tipo_vehiculo.descripcion;
                    me.monto_ut = tipo_vehiculo.monto_ut;                    
                    me.titulo = 'Editar Tipo de Vehiculo';
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
                
                axios.put('/tipo_vehiculo/actualizar', {
                        'id': me.id,                      
                        'tipo': me.tipo,                        
                        'descripcion': me.descripcion,
                        'monto_ut':me.monto_ut,                        
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
                  title: '¿Estás seguro de eliminar el Tipo de Vehiculo?',
                  text: '',                  
                  showCancelButton: true,
                  confirmButtonText: '<i class="fa fa-check fa-2x"></i>Aceptar',
                  cancelButtonText: '<i class="fa fa-times fa-2x"></i>Cancelar',                 
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                    let me=this;
                        axios.delete('/tipo_vehiculo/eliminar/'+data.id).then(function (response) {  
                                //console.log( response );                                
                                alerta.fire(
                                    'Eliminado!',
                                    'Registro eliminado.',
                                    'success'
                                );
                                me.tipos_vehiculo = [];                                
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
                this.tipos_vehiculo = [];
                this.id = 0;
                this.tipo = 0;                
                this.descripcion = '';
                this.monto_ut = 0;                
                this.boton = 'registro';
                this.titulo = 'Agregar Nuevo Tipo de Vehiculo';
            },
        },

        mounted() {
            this.listarTipoVehiculos();
            console.log('Component mounted.')
        }
    }
</script>
