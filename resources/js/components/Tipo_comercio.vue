<template>
    <!--<div class="contenedor"> -->
    <div class="shadow-container"> 
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Códigos ISAE</h4>
            </div>     
        </div>
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded">                
                <div class="ml-5 mt-1 mb-2">                    
                    <input type="button" value="Nueva Act. económica" v-on:click="cambiarVista('registro')" class="btn btn-primary btn-nuevo">       
                </div>                         
                <div class="float-right mb-0 input-search" >
                    <span>Buscar : </span>
                    <input type="text" id="mySearchText" class="border" @keyup="buscar()">                
                </div>
                <div>
                    <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">ID</th>
                                <th width="10%">Codigo</th>
                                <th width="20%">Denominación</th>
                                <th width="30%">Descripción</th>
                                <th width="10%">Alicuota anual (%)</th>
                                <th width="15%">Minimo tributable</th>
                                <th class="text-center" width="10%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="tipo_comercio in tipos_comercio">
                                <td>{{ tipo_comercio.id }}</td>
                                <td>{{ tipo_comercio.codigo }}</td>
                                <td>{{ tipo_comercio.denominacion }}</td>
                                <td>{{ tipo_comercio.descripcion }}</td>                                
                                <td>{{ tipo_comercio.alicuota_anual }}</td>
                                <td>{{ tipo_comercio.minimo_tributable }}</td>
                                <td class="text-center">
                                    <i class='bx bxs-edit bx-sm mr-4 text-success btn-editar' title="Editar" @click="editarRegistro(tipo_comercio)"></i>
                                    <i class='bx bxs-trash bx-sm text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(tipo_comercio)"></i>
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
                            
                                <label for="email" class="col-md-3 col-form-label-lg">
                                    Codigo de Actividad Comercial
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="codigo" v-model="codigo" class="form-control" placeholder="Código Actividad Comercial" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-code bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca codigo de actividad comercial!
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
                                                               
                                <label for="password" class="col-md-3 col-form-label-lg">
                                    Alicuota anual (%)
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="alicuota_anual" v-model="alicuota_anual" class="form-control" placeholder="Alicuota anual (%)" required>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca porcentaje alicuota!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bxs-tachometer bx-sm' ></i>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="password" class="col-md-3 col-form-label-lg">
                                    Minimo tributable (U.T.)
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="minimo_tributable" v-model="minimo_tributable" class="form-control" placeholder="Minimo Tributable (U.T.)" required>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca minimo tributable!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bxs-layer-minus bx-sm' ></i>
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
                titulo: 'Nueva Actividad comercial',
                tipos_comercio: [],
                boton: 'registro',                
                tabla: '',

                //Vista de registro de contribuyente de actividad económica
                id: 0,
                codigo: '',
                denominacion: '',
                descripcion: '',
                alicuota_anual: '',
                minimo_tributable: ''      
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
                    this.listarTipoComercios();
                }

                /*if(this.vista == "registro") {
                    this.listarRoles();
                } else {
                    this.listarComercios();
                }*/
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarTipoComercios(){
                let me = this;

                var url = '/tipo_comercio';

                axios.get(url).then(function (response) {
                // handle success                      
                var respuesta = response.data;                                    
                me.tipos_comercio = respuesta.tipos_comercio.data;
                me.tablaTipoComercios();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            tablaTipoComercios() {
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
                
                axios.post('/tipo_comercio/registrar', {                                                
                        'codigo': me.codigo,
                        'denominacion': me.denominacion,
                        'descripcion': me.descripcion,
                        'alicuota_anual':me.alicuota_anual,
                        'minimo_tributable':me.minimo_tributable                        
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
                var url = '/tipo_comercio?id='+me.id;

                 axios.get(url).then(function (response) {
                    // handle success                            
                    var respuesta = response.data;                     
                    var tipo_comercio = respuesta.tipos_comercio;                    
                                                
                    me.codigo = tipo_comercio.codigo;
                    me.denominacion = tipo_comercio.denominacion;
                    me.descripcion = tipo_comercio.descripcion;
                    me.alicuota_anual = tipo_comercio.alicuota_anual;
                    me.minimo_tributable = tipo_comercio.minimo_tributable;
                    me.titulo = 'Editar Actividad comercial';
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
                
                axios.put('/tipo_comercio/actualizar', {
                        'id': me.id,                      
                        'codigo': me.codigo,
                        'denominacion': me.denominacion,
                        'descripcion': me.descripcion,
                        'alicuota_anual':me.alicuota_anual,
                        'minimo_tributable':me.minimo_tributable,                        
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
                  title: '¿Estás seguro de eliminar el Objetivo?',
                  text: '',                  
                  showCancelButton: true,
                  confirmButtonText: '<i class="fa fa-check fa-2x"></i>Aceptar',
                  cancelButtonText: '<i class="fa fa-times fa-2x"></i>Cancelar',                 
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                    let me=this;
                        axios.delete('/tipo_comercio/eliminar/'+data.id).then(function (response) {  
                                //console.log( response );                                
                                alerta.fire(
                                    'Eliminado!',
                                    'Registro eliminado.',
                                    'success'
                                );
                                me.tipos_comercio = [];                                
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
                this.tipos_comercio = [];
                this.id = 0;
                this.codigo = 0;
                this.denominacion = '';
                this.descripcion = '';
                this.alicuota_anual = 0;
                this.minimo_tributable = 0;
                this.boton = 'registro';
                this.titulo = 'Agregar Nuevo Usuario';
            },
        },

        mounted() {
            this.listarTipoComercios();
            console.log('Component mounted.')
        }
    }
</script>
