<template>
    <div class="contenedor">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="float-left pr-1">
                            <b>Calcular Declaración -> Inmueble</b>
                        </h3>
                    </div>
                </div>
            </div>
        </div>        
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded shadow-container">                                               
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
                                <th width="20%">Codigo Catastral</th>                                
                                <th width="10%">Área de Terreno</th>
                                <th width="10%">Área de Construcción</th>
                                <th width="10%">Cédula Propietario</th>
                                <th width="20%">Dirección</th>
                                <th class="text-center" width="10%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="inmueble in inmuebles">
                                <td>{{ inmueble.id }}</td>                                
                                <td>{{ inmueble.denominacion }}</td>                                
                                <td>{{ inmueble.codigo_catastral }}</td>
                                <td>{{ inmueble.area_terreno }}</td>
                                <td>{{ inmueble.area_construccion }}</td>
                                <td>{{ inmueble.rif }}</td>
                                <td>{{ inmueble.direccion }}</td>
                                <td class="text-center">
                                    <i class='bx bxs-printer bx-md text-success btn-editar' title="Calcular Declaracion" @click="verDetalle(inmueble)"></i>                                   
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
                <div class="card-body mt-3">                                               
                    <div class="form-row">                           
                        <div class="col-md-3 my-0">
                            <label class="col-form-label-lg">
                                Nombre Propietario :
                            </label>                                 
                        </div>                                

                        <div class="col-md-3 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ denominacion }}
                            </label>                                  
                        </div>

                        <div class="col-md-2 form-group my-0">
                           <label class="col-form-label-lg">
                                Cédula :
                            </label>                                  
                        </div>

                        <div class="col-md-2 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ rif }}
                            </label>                                  
                        </div>
                    </div>
                    <div class="form-row my-0"> 
                        <div class="col-md-3">
                            <label class="col-form-label-lg">
                                Codigo catastral :
                            </label>                                 
                        </div>                                

                        <div class="col-md-3 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ codigo_catastral }}
                            </label>                                  
                        </div>                                                 
                        <div class="col-md-3">
                            <label class="col-form-label-lg">
                                Direccion :
                            </label>                                 
                        </div>                                

                        <div class="col-md-3 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ direccion }}
                            </label>                                  
                        </div>
                    </div>
                    <div class="form-row">                           
                        <div class="col-md-2 my-0">
                            <label class="col-form-label-lg">
                                Zona
                            </label>                                 
                        </div>                                

                        <div class="col-md-2 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ zona }}
                            </label>                                  
                        </div>

                         <div class="col-md-2 my-0">
                            <label class="col-form-label-lg">
                                Tipo de Vivienda
                            </label>                                 
                        </div>                                

                        <div class="col-md-2 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ tipo_vivienda }}
                            </label>                                  
                        </div>

                        <div class="col-md-2 my-0">
                            <label class="col-form-label-lg">
                                Ultimo año declarado
                            </label>                                 
                        </div>                                

                        <div class="col-md-2 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ ultimo }}
                            </label>                                  
                        </div>
                    </div>

                    <div class="border-top my-3"></div>

                    <div class="font-weight-bold text-center bg-light" v-if="periodos">Registro de detalle a pagar</div>
                    <div class="form-row text-center bg-light border my-5" v-else>
                        <div class="col-md-12 form-group my-5">                               
                           <label><strong>No hay Impuestos por calcular</strong></label>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <i class='bx bx-cancel bx-sm'></i>
                            <input type="button" name="cancelar" @click="cancelarRegistro()" class="btn btn-warning" value="Salir">
                        </div>
                    </div>

                    <div class="border-top my-3"></div>

                    <form class="needs-validation" novalidate v-if="periodos">

                        <div class="form-row text-center bg-light border">
                            <div class="col-md-1">
                               <label><strong>Periodo</strong></label>                               
                            </div>
                            <div class="col-md-2">
                               <label><strong>Área Terreno</strong></label>                               
                            </div>
                            <div class="col-md-2">
                               <label><strong>Área construccion</strong></label>                               
                            </div>
                             <div class="col-md-1">
                               <label><strong>Valor Fiscal</strong></label>                               
                            </div>
                             <div class="col-md-1">
                               <label><strong>Alicuota</strong></label>                               
                            </div>
                            <div class="col-md-2">
                               <label><strong>Bs. X Mt2</strong></label>                               
                            </div>
                            <div class="col-md-1">
                               <label><strong>Valor Total</strong></label>                               
                            </div>
                            <div class="col-md-2">
                               <label><strong>Impuesto a pagar</strong></label>                               
                            </div>
                        </div>

                        <div class="form-row text-center mt-3 border-bottom" v-for="periodo in periodos">
                            <div class="col-md-1 form-group">                               
                               <label><strong>{{ periodo.periodo }}</strong></label>
                            </div>
                            <div class="col-md-2 form-group">                               
                               <label><strong>{{ area_terreno }}</strong></label>
                            </div>
                            <div class="col-md-2 form-group">                               
                               <label><strong>{{ area_construccion }}</strong></label>
                            </div>
                             <div class="col-md-1 form-group">                               
                               <label><strong>{{ alicuota }}</strong></label>
                            </div>
                            <div class="col-md-1 form-group">                               
                               <label><strong>{{ valor_fiscal=((periodo.unidad_tributaria * alicuota)/100).toFixed(2) }}</strong></label>
                            </div>
                            <div class="col-md-2 form-group">                               
                               <label><strong>{{ valor_mt }}</strong></label>
                            </div>
                            <div class="col-md-1 form-group">                               
                               <label><strong>{{ valor_total.toFixed(2) }}</strong></label>
                            </div>
                            <div class="col-md-2 form-group">                               
                               <label><strong>{{ periodo.monto_impuesto=(valor_fiscal * valor_total).toFixed(2) }}</strong></label>
                            </div>                            
                        </div>                               
                        
                        <div class="form-row text-center mt-3">
                            <div class="col-md-6"></div>
                            <div class="col-md-3 bg-light">
                                <h5> Total de impuestos : </h5>
                            </div>
                            <div class="col-md-3 bg-light">
                                {{ total=calcularTotal.toFixed(2) }}
                            </div>                                                   
                        </div>                        

                        <div class="form-row mt-5">                            
                            
                            <div class="col-md-6 d-flex justify-content-center">
                                <button type="button" @click="validarFormulario( 'registro' )" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Registrar</span>
                                </button>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center ">
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
                //Vista de listado de contribuyente de Inmueble
                vista: 'listado',
                titulo: 'Agregar Nueva Declaración Inmueble',                
                boton: 'registro',
                periodos: [],
                inmuebles: [],                
                tabla: '',

                //Datos de vista de detalle de inmueble
                inmueble: [],

                idinmueble: 0,
                anio: '',
                denominacion: '',
                rif: '',
                codigo_catastral: '',
                tipo_vivienda: '',
                direccion: '',
                idzona: '',   
                zona: '',
                idregimen: '',

                area_terreno: 0,
                area_construccion: 0, 
                alicuota: 0,
                valor_fiscal: 0,
                valor_mt: 0,                
                valor_total: 0,
                monto_impuesto: 0,
                ultimo: 0,
                total: 0
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
            datatable            
        },

         computed: {
            calcularTotal: function() {
                var resultado = 0;

                for (var i = 0; i < this.periodos.length; i++) {
                    
                    resultado = resultado+(parseFloat(this.periodos[i].monto_impuesto));

                }            
                return resultado;
            }
        },   

        methods: {
            cambiarVista( opcion ) {                
                this.vista = opcion;

                if( this.vista == "listado") {
                    this.listarInmuebles();
                }            
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarInmuebles() {
                let me = this;

                var url = '/inmueble';

                axios.get(url).then(function (response) {
                // handle success                     

                var respuesta = response.data;                                    
                me.inmuebles = respuesta.inmuebles.data;

                me.tablaInmuebles();
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
                });

                let me = this;    

                console.log("Periodos : ", me.periodos);

                axios.post('/declaracion_inmueble/registrar', {                        
                        'idinmueble': me.idinmueble,
                        'periodos': me.periodos,
                        'idzona': me.idzona,
                        'tipo_vivienda': me.tipo_vivienda,
                        'idregimen': me.idregimen,
                        'area_construccion': me.area_construccion,
                        'area_terreno': me.area_terreno,
                        'valor_total': me.valor_total,
                        'monto_impuesto': me.total,
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

            verDetalle( inmueble ) {
                
                this.vista = "registro";

                let me = this;               

                var url = '/declaracion_inmueble/'+inmueble.id;

                axios.get(url).then(function (response) {
                // handle success                     
                
                var respuesta = response.data;  

                console.log("Respuesta : ", respuesta);

                me.idinmueble = respuesta.inmueble.id;                
                me.denominacion = respuesta.inmueble.denominacion;
                me.idzona = respuesta.inmueble.idzona;
                me.zona = respuesta.zona.nombre;
                me.tipo_vivienda = respuesta.inmueble.tipo_vivienda;
                me.rif = respuesta.inmueble.rif;  
                me.codigo_catastral = respuesta.inmueble.codigo_catastral;                  
                me.direccion = respuesta.inmueble.direccion;                  
                me.area_terreno = respuesta.inmueble.area_terreno;  
                me.area_construccion = respuesta.inmueble.area_construccion;
                me.idregimen = respuesta.inmueble.idregimen;    
                me.alicuota = respuesta.regimen.alicuota;                  
                me.valor_fiscal = respuesta.regimen.valor_fiscal;
                me.periodos = respuesta.periodo.data;
                console.log("periodos : ", me.periodos);

                if(me.tipo_vivienda == "c1") { me.valor_mt = respuesta.zona.c1; };   
                if(me.tipo_vivienda == "c2") { me.valor_mt = respuesta.zona.c2; };   
                if(me.tipo_vivienda == "c3") { me.valor_mt = respuesta.zona.c3; };   
                if(me.tipo_vivienda == "c4") { me.valor_mt = respuesta.zona.c4; };   
                if(me.tipo_vivienda == "v1") { me.valor_mt = respuesta.zona.v1; };   
                if(me.tipo_vivienda == "v2") { me.valor_mt = respuesta.zona.v2; };   
                if(me.tipo_vivienda == "v3") { me.valor_mt = respuesta.zona.v3; };   
                if(me.tipo_vivienda == "v4") { me.valor_mt = respuesta.zona.v4; };                

                if( me.area_terreno > me.area_construccion) {
                    me.valor_total = me.valor_mt * me.area_terreno;
                } else {
                    me.valor_total = me.valor_mt * me.area_construccion;
                }

                me.monto_impuesto = me.valor_total * me.valor_fiscal;
                me.ultimo = respuesta.ultimo;
                if( respuesta.ultimo != "N/A") {
                    me.anio++; 
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

            listarCodigos( comercio ) {

              /*  let me=this;

                var url = '/tipos_comercio/'+comercio.id;

                axios.get(url).then(function (response) {
                // handle success                
                
                var respuesta = response;                  
                me.codigos = respuesta.data;                
                me.minimosTributables();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });*/

            },

            cancelarRegistro() {
                this.limpiarCampos();
                this.cambiarVista("listado");
            },

            limpiarCampos() {                
                this.inmuebles = [];
                this.inmueble = [];                
                this.boton = 'registro';
                this.titulo = 'Agregar declaracion';
            },
        },

        mounted() {
            console.clear();
            this.listarInmuebles();               
        }
    }
</script>
