<template>
    <div class="contenedor">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="float-left pr-1">
                            <b>Contribuyente -> Inmueble</b>
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
                                <th width="20%">Propietario</th>   
                                <th width="10%">Codigo Catastral</th>                                
                                <th width="10%">Cédula Propietario</th>
                                <th width="10%">Número de Inscripción</th>
                                <th width="25%">Dirección</th>
                                <th width="10%">Teléfono</th>
                                <th class="text-center" width="10%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="inmueble in inmuebles">
                                <td>{{ inmueble.id }}</td>                                
                                <td>{{ inmueble.denominacion }}</td>
                                <td>{{ inmueble.codigo_catastral }}</td>
                                <td>{{ inmueble.rif }}</td>
                                <td>{{ inmueble.numero_inscripcion }}</td>
                                <td>{{ inmueble.direccion }}</td>
                                <td>{{ inmueble.telefono }}</td>
                                <td class="text-center">
                                    <i class='bx bxs-edit bx-sm mr-2 text-success btn-editar' title="Editar" @click="editarRegistro(inmueble)"></i>
                                    <i class='bx bxs-trash bx-sm mr-2 text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(inmueble)"></i>                                    
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

                                <label for="tipo" class="col-md-3 col-form-label-lg">
                                    Tipo de Inmueble
                                </label> 

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" v-model="tipo" value="tipo" required>
                                       <option value="" selected disabled>Seleccione Tipo de Inmueble</option>
                                       <option v-for="tipo in tipos" :key="tipo.id" :value="tipo.id" v-text="tipo.descripcion"></option>
                                    </select>                                    
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Seleccione Tipo de Inmueble!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm' ></i>
                                    </div>                                    
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>

                                <label for="codigo_catastral" class="col-md-3 col-form-label-lg">
                                    Código Catastral 
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="codigo_catastral" v-model="codigo_catastral" class="form-control" placeholder="Código catastral" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca Código Catastral!
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
                                                               
                                <label for="numero_civico" class="col-md-3 col-form-label-lg">
                                    Número Civico
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="numero_civico" v-model="numero_civico" class="form-control" placeholder="Número civico" required>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Número Civico!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="zona" class="col-md-3 col-form-label-lg">
                                    Zona
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" v-model="zona" value="zona" @change="listarSelectZonas()" required>
                                       <option value="" selected disabled>Seleccione Zona</option>
                                       <option v-for="zona in zonas" :key="zona.id" :value="zona.id" v-text="zona.nombre"></option>
                                    </select>   
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Seleccione una Zona!
                                    </div>                            
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row"  v-if="mostrarSelectZonas">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="zona" class="col-md-3 col-form-label-lg" >
                                    Tipo de Vivienda
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" v-model="tipo_vivienda" value="tipo_vivienda" required>
                                       <option value="" selected disabled>Seleccione Tipo de Vivienda</option>
                                       <option value="c1">C1</option>
                                       <option value="c2">C2</option>
                                       <option value="c3">C3</option>
                                       <option value="c4">C4</option>
                                       <option value="v1">V1</option>
                                       <option value="v2">V2</option>
                                       <option value="v3">V3</option>
                                       <option value="v4">V4</option>
                                    </select>   
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Seleccione una Zona!
                                    </div>                            
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="regimen" class="col-md-3 col-form-label-lg">
                                    Régimen
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" v-model="regimen" value="regimen" @change="listarSelectZonas()" required>
                                       <option value="" selected disabled>Seleccione Regimen</option>
                                       <option v-for="regimen in regimenes" :key="regimen.id" :value="regimen.id" v-text="regimen.regimen"></option>
                                    </select>   
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Seleccione un Régimen!
                                    </div>                            
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="numero_inscripcion" class="col-md-3 col-form-label-lg">
                                    Número de Inscripción
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="numero_inscripcion" v-model="numero_inscripcion" class="form-control" placeholder="Número de Inscripción">                                    
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Número de Inscripción!
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="area_terreno" class="col-md-3 col-form-label-lg">
                                    Área de Terreno
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="area_terreno" v-model="area_terreno" class="form-control" placeholder="Área de Terreno">                                    
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Área de terreno!
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-1"></div>                               
                                                               
                                <label for="area_construccion" class="col-md-3 col-form-label-lg">
                                    Área de Contrucción
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="area_construccion" v-model="area_construccion" class="form-control" placeholder="Área de Construcción">                                    
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca Área de construcción!
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
                inmuebles: [],
                tipos: [],
                zonas: [],
                regimenes: [],
                mostrarSelectZonas: false,
                boton: 'registro',                
                tabla: '',

                //Vista de registro de contribuyente de actividad económica
                id: 0,
                tipo: '',
                denominacion: '',
                codigo_catastral: '',           
                numero_civico: '',                
                zona: '',
                tipo_vivienda: '',
                regimen: '',
                numero_inscripcion: '',
                area_terreno: '',
                area_construccion: '',
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
                    this.listarZonas();
                    this.listarRegimenes();
                } else {
                    this.listarInmuebles();
                }
            },

///////////////////////////* Listado de contribuyente de actividad económica */////////////////////////////////
            listarSelectZonas() {
                this.mostrarSelectZonas = true;
            },  

            listarInmuebles(){                

                let me = this;

                var url = '/inmueble';

                axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;                                    
                me.inmuebles = respuesta.inmuebles.data;
                
                if( me.inmuebles.length == 0 ) {
                    me.limpiarCampos();
                    me.tablaInmuebles();
                } else {
                    me.tablaInmuebles();    
                }
                
                console.log("Numero de registro : ", me.inmuebles.length);
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            tablaInmuebles() {
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

                var url = '/tipo_inmueble';

                axios.get(url).then(function (response) {
                    // handle success                    
                    var respuesta = response.data;                    
                    me.tipos = respuesta.tipos_inmueble.data;     
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

            listarZonas() {
                let me = this;

                var url = '/zona';                

                axios.get(url).then(function (response) {
                    // handle success                    
                    var respuesta = response.data;                    
                    me.zonas = respuesta.zonas.data;     
                    console.log("Zonas : ", me.zonas);                    
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .finally(function () {
                    // always executed
                  });
            },

            listarRegimenes() {
                let me = this;

                var url = '/regimen';                

                axios.get(url).then(function (response) {
                    // handle success                    
                    var respuesta = response.data;                    
                    me.regimenes = respuesta.regimenes.data;     
                    console.log("Regimenes : ", me.regimenes);                    
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
                console.log("Array de tipo ", me.tipoArray);               
                
                axios.post('/inmueble/registrar', {
                        'codigo_catastral': me.codigo_catastral,
                        'denominacion': me.denominacion,
                        'numero_civico': me.numero_civico,
                        'idzona': me.zona,
                        'tipo_vivienda': me.tipo_vivienda,
                        'idregimen': me.regimen,
                        'numero_inscripcion': me.numero_inscripcion,
                        'area_terreno':me.area_terreno,
                        'area_construccion':me.area_construccion,
                        'rif': me.rif,
                        'telefono': me.telefono,
                        'direccion': me.direccion,
                        'tipo': me.tipo

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
                var url = '/inmueble?id='+me.id;

                 axios.get(url).then(function (response) {
                    // handle success                            
                    var respuesta = response.data;                     
                    var inmueble = respuesta.inmuebles;                    
                                                
                    me.tipo = inmueble.idtipocontribuyenteinmueble;
                    me.codigo_catastral = inmueble.codigo_catastral
                    me.denominacion = inmueble.denominacion;                    
                    me.numero_civico = inmueble.numero_civico;
                    me.zona = inmueble.idzona;
                    me.tipo_vivienda = inmueble.tipo_vivienda;
                    me.regimen = inmueble.idregimen;
                    me.numero_inscripcion = inmueble.numero_inscripcion;
                    me.area_terreno = inmueble.area_terreno;
                    me.area_construccion = inmueble.area_construccion;
                    me.rif = inmueble.rif;
                    me.telefono = inmueble.telefono;
                    me.direccion = inmueble.direccion;
                    me.titulo = 'Editar Inmueble';
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
                
                axios.put('/inmueble/actualizar', {
                        'id': me.id,
                        'tipo': me.tipo,    
                        'codigo_catastral': me.codigo_catastral,                        
                        'denominacion': me.denominacion,                        
                        'numero_civico': me.numero_civico,
                        'idzona': me.zona,
                        'tipo_vivienda': me.tipo_vivienda,
                        'idregimen': me.regimen,
                        'numero_inscripcion': me.numero_inscripcion,
                        'area_terreno': me.area_terreno,
                        'area_construccion': me.area_construccion,
                        'rif': me.rif,
                        'direccion':me.direccion,
                        'telefono':me.telefono,
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
                        axios.delete('/inmueble/eliminar/'+data.id).then(function (response) {  
                                //console.log( response );                                
                                alerta.fire(
                                    'Eliminado!',
                                    'Registro eliminado.',
                                    'success'
                                );
                                me.inmuebles = [];                                
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
                this.inmuebles = [];
                this.id = 0;
                this.codigo_catastral = '',
                this.tipo = '';
                this.denominacion = '';
                this.numero_civico = '';
                this.numero_inscripcion='';
                this.area_terreno = '';
                this.area_construccion = '';
                this.rif = '';
                this.cedula = '';
                this.direccion = '';
                this.telefono = '';
                this.boton = 'registro';
                this.titulo = 'Agregar Nuevo Inmueble';
            },
        },

        mounted() {
            this.listarInmuebles();                 
            console.log('Component mounted.')
        }
    }
</script>
