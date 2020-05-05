<template>
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Vehiculos</h4>
            </div>     
        </div>        
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded">        
                <div class="ml-5 mb-5">                    
                    <input type="button" value="Nuevo Contribuyente" v-on:click="cambiarVista('registro')" class="btn btn-primary btn-nuevo">                
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
                                <th width="10%">Placa</th>
                                <th width="10%">Serial</th>
                                <th width="20%">Nombre Propietario</th>
                                <th width="10%">Cédula Propietario</th>
                                <th width="25%">Dirección</th>
                                <th width="10%">Teléfono</th>
                                <th class="text-center" width="10%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="vehiculo in vehiculos">
                                <td>{{ vehiculo.id }}</td>                                                                
                                <td>{{ vehiculo.placa }}</td>
                                <td>{{ vehiculo.serial }}</td>
                                <td>{{ vehiculo.denominacion }}</td>
                                <td>{{ vehiculo.rif }}</td>
                                <td>{{ vehiculo.direccion }}</td>
                                <td>{{ vehiculo.telefono }}</td>
                                <td class="text-center">
                                    <i class='bx bxs-edit bx-sm mr-2 text-success btn-editar' title="Editar" @click="editarRegistro(vehiculo)"></i>
                                    <i class='bx bxs-trash bx-sm mr-2 text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(vehiculo)"></i>
                                    <i class='bx bxs-report bx-sm mr-2 text-primary btn-eliminar' title="Estado de cuenta" @click="imprimirEdoCta(vehiculo)"></i>
                                </td>
                            </tr>                            
                        </tbody>                  
                    </table>
                </div>
            </div>                   
        </template>
        <!-- formulario de Nuevo Contribuyente de actividad comercial-->
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
                                    Tipo de Vehiculo
                                </label> 

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" v-model="tipo" value="tipo" required>
                                       <option value="" selected disabled>Seleccione Tipo de Vehiculo</option>
                                       <option v-for="tipo in tipos" :key="tipo.id" :value="tipo.id" v-text="tipo.tipo"></option>
                                    </select>                                    
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Seleccione Tipo de Vehiculo!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm' ></i>
                                    </div>                                    
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="placa" class="col-md-3 col-form-label-lg">
                                    Placa 
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="placa" v-model="placa" class="form-control" placeholder="Placa" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca Placa!
                                    </div>                                                                
                                </div>                                    
                            </div>
                        </div>  

                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="serial" class="col-md-3 col-form-label-lg">
                                    Serial de Vehiculo
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="serial" v-model="serial" class="form-control" placeholder="Serial de Vehiculo" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca Serial de Vehiculo!
                                    </div>                                                                
                                </div>                                    
                            </div>
                        </div>  

                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="denominacion" class="col-md-3 col-form-label-lg">
                                    Nombre de Propietario
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="denominacion" v-model="denominacion" class="form-control" placeholder="Nombre de Propietario" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca Nombre de Propietario!
                                    </div>                                                                
                                </div>                                    
                            </div>
                        </div>   

                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="rif" class="col-md-3 col-form-label-lg">
                                    Cédula de Propietario
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="rif" v-model="rif" class="form-control" placeholder="Cédula de Propietario" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca Cédula de Propietario!
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
                vehiculos: [],
                tipos: [],
                boton: 'registro',                
                tabla: '',

                //Vista de registro de contribuyente Vehiculo
                id: 0,
                tipo: '',
                denominacion: '',
                placa: '',           
                modelo: '',                
                serial: '',                
                rif:'',                
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
                    this.listarVehiculos();
                }
            },

//////////////////////////* Listado de contribuyente de actividad económica */////////////////////////////////              

            listarVehiculos(){                

                let me = this;

                var url = '/vehiculo';

                axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;                                    
                me.vehiculos = respuesta.vehiculos.data;
                
                if( me.vehiculos.length == 0 ) {
                    me.limpiarCampos();
                    me.tablaVehiculos();
                } else {
                    me.tablaVehiculos();    
                }                
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            tablaVehiculos() {
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

                var url = '/tipo_vehiculo';

                axios.get(url).then(function (response) {
                    // handle success                    
                    var respuesta = response.data;                    
                    me.tipos = respuesta.tipos_vehiculo.data;     
                    console.log("Vehiculos : ", me.tipos);                    
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

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })                

                let me=this;                               
                
                axios.post('/vehiculo/registrar', {
                        'placa': me.placa,
                        'denominacion': me.denominacion,
                        'modelo': me.modelo,
                        'serial': me.serial,                        
                        'rif': me.rif,
                        'telefono': me.telefono,
                        'direccion': me.direccion,
                        'tipo': me.tipo
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
                var url = '/vehiculo?id='+me.id;

                 axios.get(url).then(function (response) {
                    // handle success                            
                    var respuesta = response.data;                     
                    var vehiculo = respuesta.vehiculos;

                    me.tipo = vehiculo.idtipocontribuyentevehiculo;
                    me.placa = vehiculo.placa;
                    me.denominacion = vehiculo.denominacion;                    
                    me.modelo = vehiculo.modelo;
                    me.serial = vehiculo.serial;                    
                    me.rif = vehiculo.rif;
                    me.telefono = vehiculo.telefono;
                    me.direccion = vehiculo.direccion;
                    me.titulo = 'Editar Vehiculo';
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
                
                axios.put('/vehiculo/actualizar', {
                        'id': me.id,
                        'placa': me.placa,
                        'denominacion': me.denominacion,
                        'modelo': me.modelo,
                        'serial': me.serial,                        
                        'rif': me.rif,
                        'telefono': me.telefono,
                        'direccion': me.direccion,
                        'tipo': me.tipo
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
                  title: '¿Estás seguro de eliminar el Vehiculo?',
                  text: '',                  
                  showCancelButton: true,
                  confirmButtonText: '<i class="fa fa-check fa-2x"></i>Aceptar',
                  cancelButtonText: '<i class="fa fa-times fa-2x"></i>Cancelar',                 
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                    let me=this;
                        axios.delete('/vehiculo/eliminar/'+data.id).then(function (response) {  
                                //console.log( response );                                
                                alerta.fire(
                                    'Eliminado!',
                                    'Registro eliminado.',
                                    'success'
                                );
                                me.vehiculos = [];                                
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

            imprimirEdoCta( vehiculo ) {                

                window.open('http://127.0.0.1:8000/edoCtaVehiculo?idvehiculo=' + vehiculo.id,'_blank');

            },

            cancelarRegistro() {
                this.limpiarCampos();
                this.cambiarVista("listado");
            },

            limpiarCampos() {                
                this.vehiculos = [];
                this.id = 0;
                this.codigo_catastral = '',
                this.tipo = '';
                this.denominacion = '';
                this.placa = '';
                this.serial='';
                this.modelo = '';               
                this.rif = '';                
                this.direccion = '';
                this.telefono = '';
                this.boton = 'registro';
                this.titulo = 'Agregar Nuevo Vehiculo';
            },
        },

        mounted() {
            this.listarVehiculos();                 
            console.log('Component mounted.')
        }
    }
</script>
