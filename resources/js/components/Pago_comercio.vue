<template>
    <div class="contenedor">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="float-left pr-1">
                            <b>Pago Contribuyente -> Actividad económica</b>
                        </h3>
                    </div>
                </div>
            </div>
        </div>        
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded shadow-container">        
                <!-- <div class="ml-5 mb-5">                    
                    <input type="button" value="Nuevo Pago" v-on:click="cambiarVista('registro')" class="btn btn-primary btn-nuevo">                
                </div> -->
                <div class="float-right mb-0 input-search">
                    <span>Buscar : </span>
                    <input type="text" id="mySearchText" class="border" @keyup="buscar()">                
                </div>
                <div>
                    <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">ID</th>
                                <th width="10%">Tipo de Act. Económica</th>
                                <th width="15%">Rif/Cédula</th>   
                                <th width="20%">Denominación</th>                                
                                <th width="25%">Dirección</th>
                                <th width="10%">Teléfono</th>
                                <th class="text-center" width="15%">Registrar Pago</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="comercio in comercios">
                                <td>{{ comercio.id }}</td>
                                <td>
                                    <div v-for="tipo in tipos">
                                        <span v-if="comercio.idtipocontribuyentecomercio == tipo.id">
                                            {{ tipo.denominacion }}        
                                        </span>                                        
                                    </div>                                    
                                </td>
                                <td>{{ comercio.rif }}</td>                                
                                <td>{{ comercio.denominacion }}</td>                                
                                <td>{{ comercio.direccion }}</td>
                                <td>{{ comercio.telefono }}</td>
                                <td class="text-center">
                                    <i class='bx bxs-coin-stack bx-md text-success btn-editar' title="Registrar Pago" @click="registrarPago(comercio)"></i>                                    
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
                            <div class="col-md-3 my-0">
                                <label class="col-form-label-lg">
                                    Nombre o Denominación Comercial :
                                </label>                                 
                            </div>                                

                            <div class="col-md-6 form-group my-0">
                               <label class="col-form-label-lg">
                                    Nombre
                                </label>                                  
                            </div>

                            <div class="col-md-1 form-group my-0">
                               <label class="col-form-label-lg">
                                    Cédula :
                                </label>                                  
                            </div>

                            <div class="col-md-2 form-group my-0">
                               <label class="col-form-label-lg">
                                    1236336363
                                </label>                                  
                            </div>
                        </div>
                        <div class="form-row my-0">                           
                            <div class="col-md-3">
                                <label class="col-form-label-lg">
                                    Direccion :
                                </label>                                 
                            </div>                                

                            <div class="col-md-9 form-group my-0">
                               <label class="col-form-label-lg">
                                    Direccion de prueba
                                </label>                                  
                            </div>
                        </div>
                        <div class="form-row">                           
                            <div class="col-md-3 my-0">
                                <label class="col-form-label-lg">
                                    Teléfono
                                </label>                                 
                            </div>                                

                            <div class="col-md-6 form-group my-0">
                               <label class="col-form-label-lg">
                                    041452522671
                                </label>                                  
                            </div>

                             <div class="col-md-1 my-0">
                                <label class="col-form-label-lg">
                                    Licencia
                                </label>                                 
                            </div>                                

                            <div class="col-md-2 form-group my-0">
                               <label class="col-form-label-lg">
                                    041452522671
                                </label>                                  
                            </div>
                        </div>  

                        <div class="border-top my-3"></div>                      

                        <div class="col-md-10 text-right">
                            <button type="button" @click="agregarDetalle()" class="btn btn-primary btn-lg btn-registrar">
                                <div class="form-control-position has-icon-left">
                                    <i class='bx bx-plus bx-sm'></i>Agregar fila
                                </div>                                
                            </button>
                        </div>

                        <div class="border-top my-3"></div>

                        <div class="font-weight-bold text-center">Registro de detalle de pagos</div>

                        <div class="border-top my-3"></div>

                        <div class="form-row justify-content-between my-2 border-bottom" v-for="(detalle,index) in arrayDetalle" :key="detalle.id">                          
                            <div class="col-md-1">
                                <label><strong>Año</strong></label>
                                <input v-model="detalle.anio" type="number" value="3" class="form-control">
                            </div>                                

                            <div class="col-md-1 form-group">
                               <label><strong>Mes</strong></label>
                               <input v-model="detalle.mes" type="number" value="3" class="form-control">
                            </div>

                            <div class="col-md-2 form-group">
                               <label><strong>Concepto</strong></label>
                               <input v-model="detalle.concepto" type="number" value="3" class="form-control">
                            </div>

                            <div class="col-md-1 form-group">
                               <label><strong>Dias</strong></label>
                               <input v-model="detalle.dia" type="number" value="2" class="form-control">
                            </div>

                            <div class="col-md-2 form-group">
                               <label><strong>Deuda</strong></label>
                               <input type="number" value="2" class="form-control">
                            </div>

                            <div class="col-md-2 form-group">
                               <label><strong>Tasa</strong></label>
                               <input type="number" value="2" class="form-control">
                            </div>

                            <div class="col-md-2 form-group">
                               <label><strong>Intereses</strong></label>
                               <input type="number" value="2" class="form-control">
                            </div>

                            <div class="col-md-1 form-group">                                
                               <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-md mt-lg-4">
                                        <i class='bx bx-trash bx-lg'></i>
                               </button>
                            </div>
                        </div>

                        <div v-if="cantidadFilas == 0" class="bg-info text-center sin-filas">
                            <span> 
                                <strong>No hay registros</strong>
                            </span>
                        </div>                              

                        <div class="form-row mt-5">                            
                            
                            <div class="col-md-6 d-flex justify-content-center" v-if="boton == 'registro'" >
                                <button type="button" @click="validarFormulario( 'registro' )" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Registrar</span>
                                </button>
                            </div>

                            <div class="col-md-6 d-flex justify-content-center" v-if="boton == 'edicion'" >
                                <button type="button" @click="validarFormulario('edicion')" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Actualizar</span>
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
    @import "../../../public/css/switch.css";
</style>    

<script type="text/javascript">

    import datatable from 'datatables';

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
                tipo: '',
                denominacion: '',                
                rif:'',
                direccion: '',
                telefono: '',

                ///Arreglo de pagos
                arrayDetalle: [],
                cantidadFilas: 1,
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
            datatable            
        },

        methods: {
            cambiarVista( opcion ) {                
                this.vista = opcion;                

                //if(this.vista == "registro") {
                    //this.listarTipos();
                //} else {
                    this.listarComercios();
                //}
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
     

////////////////////////* Registro de Pago *////////////////////////////////////////            
            registrarPago( data ) {
                this.vista = "registro";
            },

            agregarDetalle() {
                let me = this;
                //if(me.idproducto==0 || me.cantidad==0 || me.precio==0){                    
                //} else {
                    /*if(me.encuentra(me.idproducto))
                    {
                        console.log("prueba");
                        swal.fire({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese producto ya fue agregado'
                        });
                    } else { */
                        me.arrayDetalle.push({ 
                        anio: me.anio,
                        mes: me.mes,
                        concepto: me.concepto,
                        dia: me.dia
                        });
                        me.anio= '';
                        me.mes = 0;
                        me.concepto = 0;
                        me.dia = 0;
                        me.cantidadFilas = me.arrayDetalle.length;
                    //}
                //}                
            },

            eliminarDetalle(index) {
                let me = this;                
                me.arrayDetalle.splice(index, 1);
                me.cantidadFilas = me.arrayDetalle.length;
            },       
        },       

        mounted() {
            this.listarComercios();            
            this.agregarDetalle();
            console.log('Component mounted.')
        }
    }
</script>
