<template>
    <div class="contenedor">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="float-left pr-1">
                            <b>Configuraciones -> Zona</b>
                        </h3>
                    </div>
                </div>
            </div>
        </div>        
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded shadow-container">        
                <div class="ml-5 mb-5">                    
                    <input type="button" value="Nueva Zona" v-on:click="cambiarVista('registro')" class="btn btn-primary btn-nuevo">                
                </div>                         
                <div class="float-right mb-0 input-search">
                    <span>Buscar : </span>
                    <input type="text" id="mySearchText" class="border" @keyup="buscar()">                
                </div>
                <div>
                    <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="10%">ID</th>
                                <th width="40%">nombre</th>
                                <th width="5%">C1</th>
                                <th width="5%">C2</th>
                                <th width="5%">C3</th>
                                <th width="5%">C4</th>
                                <th width="5%">V1</th>
                                <th width="5%">V2</th>
                                <th width="5%">V3</th>
                                <th width="5%">V4</th>                               
                                <th class="text-center" width="10%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="zona in zonas">
                                <td>{{ zona.id }}</td>
                                <td>{{ zona.nombre }}</td>
                                <td>{{ zona.c1 }}</td>
                                <td>{{ zona.c2 }}</td>
                                <td>{{ zona.c3 }}</td>
                                <td>{{ zona.c4 }}</td>
                                <td>{{ zona.v1 }}</td>
                                <td>{{ zona.v2 }}</td>
                                <td>{{ zona.v3 }}</td>
                                <td>{{ zona.v4 }}</td>
                                <td class="text-center">
                                    <i class='bx bxs-edit bx-sm mr-4 text-success btn-editar' title="Editar" @click="editarRegistro(zona)"></i>
                                    <i class='bx bxs-trash bx-sm text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(zona)"></i>
                                </td>
                            </tr>                            
                        </tbody>                  
                    </table>
                </div>
            </div>                   
        </template>
        <!-- formulario de Nueva Zona-->
        <template v-else-if="vista=='registro'">
            <div class="p-5 bg-white rounded shadow-container">  
                 <div class="card-header">                    
                    <h4 class="card-text">{{ titulo }}</h4>
                </div>
                <div class="card-body mt-5">
                    <form class="needs-validation" novalidate>                       
                            
                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="nombre" class="col-md-3 col-form-label-lg">
                                    Nombre de la Zona
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="nombre" v-model="nombre" class="form-control" placeholder="Nombre de la Zona" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca nombre de la zona!
                                    </div>                                                                
                                </div>                                    
                            </div>
                        </div>                       

                        <div class="border-top my-3"></div>

                        <div class="font-weight-bold text-center bg-light">Detalle de tarifa por tipo</div>

                        <div class="border-top my-3"></div>

                        <div class="form-row mt-4">
                            <div class="col-md-1"></div>                                
                            
                                <label for="c1" class="col-md-2 col-form-label-lg">
                                    Valor C1
                                </label>                                

                            <div class="col-md-2 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="c1" v-model="c1" class="form-control" placeholder="Valor C1" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-shape-square bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Valor C1!
                                    </div>                             
                                </div>                                    
                            </div>

                            <div class="col-md-1"></div>                                
                            
                                <label for="v1" class="col-md-2 col-form-label-lg">
                                    Valor V1
                                </label>                                

                            <div class="col-md-2 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="v1" v-model="v1" class="form-control" placeholder="Valor V1" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-shape-square bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Valor v1!
                                    </div>                             
                                </div>                                    
                            </div>                            
                        </div>

                        <div class="form-row mt-4">
                            <div class="col-md-1"></div>                                
                            
                                <label for="c2" class="col-md-2 col-form-label-lg">
                                    Valor C2
                                </label>                                

                            <div class="col-md-2 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="c2" v-model="c2" class="form-control" placeholder="Valor C2" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-shape-square bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Valor C2!
                                    </div>                             
                                </div>                                    
                            </div>

                            <div class="col-md-1"></div>                                
                            
                                <label for="v2" class="col-md-2 col-form-label-lg">
                                    Valor V2
                                </label>                                

                            <div class="col-md-2 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="v2" v-model="v2" class="form-control" placeholder="Valor V2" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-shape-square bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Valor V2!
                                    </div>                             
                                </div>                                    
                            </div>                            
                        </div>

                        <div class="form-row mt-4">                            

                            <div class="col-md-1"></div>                                
                            
                                <label for="c3" class="col-md-2 col-form-label-lg">
                                    Valor C3
                                </label>                                

                            <div class="col-md-2 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="c3" v-model="c3" class="form-control" placeholder="Valor C3" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-shape-square bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Valor C3!
                                    </div>                             
                                </div>                                    
                            </div>

                            <div class="col-md-1"></div>                                
                            
                                <label for="v3" class="col-md-2 col-form-label-lg">
                                    Valor V3
                                </label>                                

                            <div class="col-md-2 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="v3" v-model="v3" class="form-control" placeholder="Valor V3" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-shape-square bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Valor V3!
                                    </div>                             
                                </div>                                    
                            </div>                               
                        </div>

                        <div class="form-row mt-4">
                            <div class="col-md-1"></div>                                
                            
                                <label for="c4" class="col-md-2 col-form-label-lg">
                                    Valor C4
                                </label>                                

                            <div class="col-md-2 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="c4" v-model="c4" class="form-control" placeholder="Valor C4" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-shape-square bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Valor C4!
                                    </div>                             
                                </div>                                    
                            </div>

                            <div class="col-md-1"></div>                                
                            
                                <label for="v4" class="col-md-2 col-form-label-lg">
                                    Valor V4
                                </label>                                

                            <div class="col-md-2 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="v4" v-model="v4" class="form-control" placeholder="Valor V4" required>
                                    <div class="form-control-position">
                                        <i class='bx bx-shape-square bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Valor V4!
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

</style>    

<script type="text/javascript">

    import datatable from 'datatables';    

    export default {
        data() {
            return {
                //Vista de listado de contribuyente de actividad económica
                vista: 'listado',
                titulo: 'Agregar Nueva Zona',
                zonas: [],
                boton: 'registro',                
                tabla: '',

                //Vista de registro de contribuyente de actividad económica
                id: 0,
                nombre: '',                
                c1: '',
                c2: '',
                c3: '',
                c4: '',
                v1: '',
                v2: '',
                v3: '',
                v4: '',        
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
                    this.listarZonas();
                }                
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarZonas(){
                let me = this;

                var url = '/zona';

                axios.get(url).then(function (response) {
                // handle success                      
                var respuesta = response.data;                                    
                me.zonas = respuesta.zonas.data;
                me.tablaZonas();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            tablaZonas() {
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
                
                axios.post('/zona/registrar', {                                                
                        'nombre': me.nombre,                          
                        'c1': me.c1,
                        'c2': me.c2,
                        'c3': me.c3,
                        'c4': me.c4,
                        'v1': me.v1,
                        'v2': me.v2,
                        'v3': me.v3,
                        'v4': me.v4,
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
                var url = '/zona?id='+me.id;

                 axios.get(url).then(function (response) {
                    // handle success                            
                    var respuesta = response.data;                     
                    var zona = respuesta.zonas;                    
                                                
                    me.nombre = zona.nombre;                    
                    me.c1 = zona.c1;
                    me.c2 = zona.c2;
                    me.c3 = zona.c3; 
                    me.c4 = zona.c4;
                    me.v1 = zona.v1;
                    me.v2 = zona.v2;
                    me.v3 = zona.v3;
                    me.v4 = zona.v4;                 
                    me.titulo = 'Editar Zona';
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
                
                axios.put('/zona/actualizar', {
                        'id': me.id,                      
                        'nombre': me.nombre,                        
                        'c1': me.c1,
                        'c2': me.c2,
                        'c3': me.c3,
                        'c4': me.c4,
                        'v1': me.v1,
                        'v2': me.v2,
                        'v3': me.v3,
                        'v4': me.v4,                        
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
                        axios.delete('/zona/eliminar/'+data.id).then(function (response) {  
                                //console.log( response );                                
                                alerta.fire(
                                    'Eliminado!',
                                    'Registro eliminado.',
                                    'success'
                                );
                                me.zonas = [];                                
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
                this.zonas = [];
                this.id = 0;
                this.nombre = '';
                this.c1 = '';
                this.c2 = '';
                this.c3 = '';
                this.c4 = '';
                this.v1 = '';
                this.v2 = '';
                this.v3 = '';
                this.v4 = '';
                this.boton = 'registro';
                this.titulo = 'Agregar Nueva Zona';
            },
        },

        mounted() {
            this.listarZonas();
            console.log('Component mounted.')
        }
    }
</script>
