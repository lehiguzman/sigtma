<template>    
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Actividad Económica</h4>
            </div>     
        </div>       
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded">        
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
                                <th class="text-center" width="10%" v-if="rol == 'gerente' || rol == 'supervisor'">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="comercio in comercios">
                                <td>{{ comercio.id }}</td>                                
                                <td>{{ comercio.licencia }}</td>                                
                                <td>{{ comercio.denominacion }}</td>
                                <td>{{ comercio.rif }}</td>
                                <td>{{ comercio.fecha_inscripcion }}</td>
                                <td class="text-center" v-if="rol == 'gerente' || rol == 'supervisor'">
                                    <i class='bx bxs-edit bx-sm mr-2 text-success btn-editar' title="Editar" @click="editarRegistro(comercio)"></i>
                                    <i class='bx bxs-trash bx-sm mr-2 text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(comercio)" ></i> 
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
                <div class="col-md-12 mb-0 text-center bg-light" style="z-index:-1">
                    <h4>{{ titulo }}</h4>
                </div>
                <div class="mt-5" style="z-index:-999">
                    <form class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="rif" class="col-md-3 col-form-label-lg" style="z-index:0">
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

                        <div class="form-row">
                           <div class="col-md-1"></div>                               
                                                               
                                <label for="direccion" class="col-md-3 col-form-label-lg">
                                    Tipo de Contribuyente
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <button type="button" @click="abrirModal()" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>&nbsp;Agregar Tipo
                                    </button>                                                                     
                                </div>                                                              
                            </div> 
                        </div>

                         <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr style="background-color: #E4E0DF;" class="text-center">
                                    <th>Eliminar</th>
                                    <th>Código</th>
                                    <th>Denominación</th>
                                    <th>Alicuota Anual</th>
                                    <th>Minimo Tributable</th>
                                </tr>
                            </thead>
                            <tbody v-if="arrayDetalle.length">
                                <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id" class="text-center">
                                    <td>
                                        <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times fa-2x"></i>
                                        </button>
                                    </td>
                                    <td v-text="detalle.codigo">
                                    </td>
                                    <td v-text="detalle.denominacion">
                                    </td>
                                    <td v-text="detalle.alicuota_anual">                                        
                                    </td>
                                    <td v-text="detalle.minimo_tributable">                                        
                                    </td>                                   
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="5">
                                        No se ha agregado tipo de Actividad Económica
                                    </td>
                                </tr>
                            </tbody>                                    
                        </table>

                        <div class="form-row mt-5">
                            <div class="col-md-3"></div>
                            
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

                    <div class="modal fade" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-primary modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" v-text="tituloModal"></h4>
                                    <button type="button" @click="cerrarModal()" class="close" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                       
                                <div class="modal-body">  
                                    <div class="form-group row">
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-search">
                                            <select class="form-control col-md-3" v-model="criterioP">
                                                <option value="denominacion">Denominación</option>
                                                <option value="codigo">Codigo</option>
                                            </select>
                                            <input type="text" @keyup.enter="listarTipo(buscarP,criterioP);" class="form-control" placeholder="Buscar texto" v-model="buscarP">
                                            <button type="submit"  @click="listarTipo(buscarP,criterioP);" class="text-center bg-secondary bg-light colors-container rounded text-primary d-flex align-items-center justify-content-center ml-3 shadow">
                                                <i class="fa fa-search"></i>&nbsp; Buscar
                                            </button>
                                        </div>
                                    </div>                          
                                    <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr class="bg-info bg-light text-center">                                   
                                            <th>Código</th>
                                            <th>Denominación</th>
                                            <th>Alicuota Anual</th>
                                            <th>Mínimo Tributable</th>                                                                    
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>                               
                                        <tr v-for="tipo in tipos" :key="tipo.id" class="text-center">
                                            <td v-text="tipo.codigo"></td>
                                            <td v-text="tipo.denominacion"></td>
                                            <td v-text="tipo.alicuota_anual"></td>
                                            <td v-text="tipo.minimo_tributable"></td>
                                            <td>    
                                                <button type="button" @click="agregarDetalleModal(tipo)" class="btn btn-info">
                                                    <i class="fa fa-plus fa-2x"> </i> Agregar
                                                </button>
                                            </td>
                                        </tr>                                       
                                    </tbody>
                                </table>                           
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-danger"><i class="fa fa-times fa-2x"></i> Cerrar
                            </button>
                        </div>                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
                                   
                </div>
            </div>
        </template>
        <!--Inicio del modal agregar/actualizar-->             
    </div>
        
</template>

<style scoped>
    /* Se importan los estilos del modulo */
    @import "../../../public/css/usuario.css";

    .modal-content {
            width: 100% !important;
            position: absolute !important;
        }

        .mostrar {
            display: initial !important;
            opacity: 1 !important;
            position: absolute !important;
            background-color: #3c29297a !important;
        }
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

                modal: 0,
                tituloModal: '',
                criterioP: 'codigo',
                buscarP: '',
                tipoAccion: 0,
                arrayDetalle: [],
                rol: 0, 

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

            abrirModal() {
                this.tipos=[];
                this.modal = 1;                                
                this.tituloModal="Seleccione uno o varios tipo de contribuyente";                
            },

            cerrarModal() { 
                this.modal = 0;
                this.tituloModal = "";                
            },

            listarTipo(buscar, criterio){
                let me = this;

                var url = '/tipoComercio/listarTipoComercio?buscar='+ buscar + '&criterio=' + criterio;

                axios.get(url).then(function (response) {
                    // handle success
                    //console.log(response);
                    var respuesta = response.data;
                    me.tipos = respuesta.tipoComercio.data;
                    me.pagination = respuesta.pagination;                
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .finally(function () {
                    // always executed
                  });
            },

            agregarDetalleModal(data=[]) {
                let me = this;

                if(me.encuentra(data['id'])){
                    swal.fire({
                        type: 'error',
                        title: 'Error...',
                        text: 'Tipo de contribuyente ya agregado!'
                    });
                } else {
                    me.arrayDetalle.push({
                        idtipo: data['id'],
                        codigo: data['codigo'],
                        denominacion: data['denominacion'],
                        alicuota_anual: data['alicuota_anual'],
                        minimo_tributable: data['minimo_tributable'],
                    });
                }
            },

            eliminarDetalle(index) {
                let me = this;                
                me.arrayDetalle.splice(index, 1);
            },

            encuentra(id) {
                var sw=0;
                for (var i = 0; i<this.arrayDetalle.length; i++) {
                    if(this.arrayDetalle[i].idtipo == id){
                        sw=true;
                    }
                }
                return sw;
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarComercios(){

                this.listarTipos();

                let me = this;

                var url = '/comercio';

                axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;                                    
                me.comercios = respuesta.comercios;
                me.rol = respuesta.rol.rol;
                console.log("Comercios : ", me.rol); 

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
                console.log("Array de tipo ", me.arrayDetalle);               
                
                axios.post('/comercio/registrar', {
                        'licencia': me.licencia,
                        'denominacion': me.denominacion,
                        'cedula': me.cedula,
                        'fecha_inscripcion': me.fecha_inscripcion,
                        'rif': me.rif,
                        'direccion':me.direccion,
                        'telefono':me.telefono,
                        'tipos': me.arrayDetalle

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
                    me.arrayDetalle = tipoArray;
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
                this.arrayDetalle = [],
                this.tipo = '';
                this.denominacion = '';
                this.fecha_inscripcion = '';                
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
