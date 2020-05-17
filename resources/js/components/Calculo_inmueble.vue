<template>
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Declaración Inmueble</h4>
            </div>     
        </div>  
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded">                                               
                <div class="float-right mb-0 input-search">
                    <span>Buscar : </span>
                    <input type="text" id="mySearchText" class="border" @keyup="buscar()">                
                </div>
                <div>
                    <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">ID</th>                                
                                <th width="10%">Propietario</th>   
                                <th width="20%">Codigo Catastral</th>                                
                                <th width="10%">Área de Terreno</th>
                                <th width="10%">Área de Construcción</th>
                                <th width="10%">Cédula Propietario</th>
                                <th width="15%">Dirección</th>
                                <th class="text-center" width="20%">Acción</th>                                  
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
                                    <i class='bx bxs-printer bx-md text-success btn-editar' title="Calcular Declaracion" 
                                        @click="verDetalle(inmueble)"
                                        v-if="inmueble.pagos == 0 && inmueble.calculados == 0"></i>
                                    <i class='bx bxs-report bx-md text-primary btn-eliminar' title="Estado de cuenta" 
                                        @click="imprimirEdoCta(inmueble)"
                                        v-if="inmueble.declaraciones > 0"></i>
                                    <i class='bx bxs-coin-stack bx-md text-success btn-editar' title="Registrar Pago" 
                                        @click="pagar(inmueble)"
                                        v-if="inmueble.calculados > 0"></i>
                                    <i class='bx bx-history bx-md text-success btn-editar' title="Histórico de pagos" 
                                        @click="historico(inmueble)"
                                        v-if="inmueble.pagos > 0"></i>
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
                    <div class="form-row my-0"> 
                        <div class="col-md-3">
                            <label class="col-form-label-lg">
                                Área de Terreno :
                            </label>                                 
                        </div>                                

                        <div class="col-md-3 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ area_terreno }}
                            </label>                                  
                        </div>                                                 
                        <div class="col-md-3">
                            <label class="col-form-label-lg">
                                Area de construccion :
                            </label>                                 
                        </div>                                

                        <div class="col-md-3 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ area_construccion }}
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

                    <form v-if="estatus == 'pagado'">                          
                        <div class="form-row col-md-12 d-flex mt-5">
                             <div class="col-md-4 align-content-center">
                                <button type="button" @click="imprimirEdoCta( inmueble )" name="Imprimir" class="btn btn-success btn-nuevo">
                                    <span class="align-middle">Estado de cuenta</span>
                                </button>    
                             </div>
                             <div class="col-md-4 align-content-center">
                                <button type="button" @click="pagar( inmueble )" name="Imprimir" class="btn btn-success btn-nuevo">
                                    <span class="align-middle">Registrar Pago</span>
                                </button>    
                             </div>
                             <div class="col-md-4 align-content-center">
                                 <button type="button" @click="cancelarRegistro()" name="Imprimir" class="btn btn-danger btn-cancelar">
                                    <span class="align-middle">Salir</span>
                                </button>
                             </div>                             
                        </div>
                    </form>

                    <form class="needs-validation" novalidate v-else>

                        <div class="form-row text-center bg-light border">
                            <div class="col-md-1">
                               <label><strong>Periodo</strong></label>                               
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
                            <div class="col-md-3">
                               <label><strong>Valor Total</strong></label>                               
                            </div>
                            <div class="col-md-4">
                               <label><strong>Impuesto a pagar</strong></label>                               
                            </div>
                        </div>

                        <div class="form-row text-center mt-3 border-bottom" v-for="periodo in periodos">
                            <div class="col-md-1 form-group">                               
                               <label><strong>{{ periodo.periodo }}</strong></label>
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
                            <div class="col-md-3 form-group">                               
                               <label><strong>{{ valor_total.toFixed(2) }}</strong></label>
                            </div>
                            <div class="col-md-4 form-group">                               
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

        <!-- formulario de Nuevo Contribuyente de actividad comercial-->
        <template v-else-if="vista=='pagar'">
            <div class="p-3 bg-white rounded">  
                <div class="col-md-12 mb-0 text-center bg-light">
                    <h4>{{ titulo }}</h4>
                </div>
                <div class="card-body mt-5">
                    <form class="needs-validation" novalidate>
                        <div class="form-row text-center">                           
                            <div class="col-md-3 my-0">
                                <label class="col-form-label-lg">
                                    Nombre o Denominación :
                                </label>                                 
                            </div>                                

                            <div class="col-md-5 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ declaracion.denominacion }}
                                </label>                                  
                            </div>

                            <div class="col-md-1 form-group my-0">
                               <label class="col-form-label-lg">
                                    Rif :
                                </label>                                  
                            </div>

                            <div class="col-md-3 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ declaracion.rif }}
                                </label>                                  
                            </div>
                        </div>                        
                        <div class="form-row text-center">

                            <div class="col-md-3 my-0">
                                <label class="col-form-label-lg">
                                    Monto Impuesto
                                </label>                                 
                            </div>                                

                            <div class="col-md-4 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ formatoMonto(declaracion.monto_impuesto) }}
                                </label>                                  
                            </div>
                        </div>                      

                        <div class="border-top my-3"></div>

                        <div class="font-weight-bold text-center">Registro de detalle de pagos</div>

                        <div class="border-top my-3"></div>

                        <div class="col-md-3 d-flex justify-content-center mb-3">
                            <button type="button" @click="agregarFila()" name="registro" class="btn btn-primary btn-registrar">
                                <span class="align-middle ml-25">
                                    Agregar fila
                                </span>
                            </button>
                        </div>

                        <div class="form-row text-center bg-light border-bottom">                          
                            <div class="col-md-2">
                                <label><strong>Tipo de Pago</strong></label>                                 
                            </div> 

                             <div class="col-md-2 form-group">
                               <label><strong>Número de Referencia</strong></label>                               
                            </div>                               

                            <div class="col-md-2 form-group">
                               <label><strong>Banco</strong></label>                               
                            </div>

                            <div class="col-md-3 form-group">
                               <label><strong>Fecha pago</strong></label>                               
                            </div>              

                            <div class="col-md-2 form-group">
                               <label><strong>Monto</strong></label>                               
                            </div>           
                        </div>

                    <div v-if="detalles.length">                        

                        <div class="form-row mt-2" v-for="(detalle, index) in detalles">
                            <div class="col-md-2">
                                <select class="form-control" v-model="detalle.tipoPago" value="detalle.tipoPago" required>
                                   <option value="" selected disabled>Tipo de Pago</option>
                                   <option value="1">Depósito</option>
                                   <option value="2">Punto de Venta</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <input v-model="detalle.referencia" type="referencia" value="3" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <select class="form-control" v-model="detalle.banco" value="detalle.banco" required>
                                   <option value="" selected disabled>Banco</option>
                                   <option value="Banesco">Banesco</option>
                                   <option value="Mercantil">Mercantil</option>
                                   <option value="Venezuela">Venezuela</option>
                                   <option value="Tesoro">Tesoro</option>
                                   <option value="Fondo Común">Fondo Común</option>
                                   <option value="Bicentenario">Bicentenario</option>
                                </select>                                
                            </div>

                            <div class="col-md-3">
                                <div class="position-relative has-icon-left">
                                    <datepicker name="detalle.fecha_pago" v-model="detalle.fecha_pago" bootstrap-styling format="dd/MM/yyyy" placeholder="Fecha de pago" required>
                                    </datepicker>                                    
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca fecha de pago!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bxs-calendar-star bx-sm' ></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <input v-model="detalle.monto_pago" type="text" value="3" class="form-control" required>
                            </div>

                            <div class="col-md-1">
                                <button type="button" class="btn btn-icon btn-danger rounded-circle" @click="eliminarFila(index)">
                                    <i class="bx bx-x bx-sm"></i>
                                </button>                                
                            </div>
                        </div>                                             
                    </div>
                        <div class="form-row mt-5"> 
                            <div class="col-md-2">                                
                            </div>                            
                            
                            <div class="col-md-3 d-flex justify-content-center" v-if="boton == 'registro'" >
                                <button type="button" @click="validarFormulario( 'pagar' )" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Registrar</span>
                                </button>
                            </div>
                            <div class="col-md-3" v-else-if="boton == 'solvencia'">
                                <button type="button" @click="imprimirSolvencia()" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Solvencia</span>
                                </button>
                            </div>
                            <div class="col-md-3" v-else> </div>

                            <div class="col-md-6 d-flex justify-content-center ">
                                <i class='bx bx-cancel bx-sm' ></i>
                                <input type="button" name="cancelar" @click="cancelarRegistro()" class="btn btn-danger btn-cancelar" value="Cancelar">
                            </div>
                        </div>                                               
                    </form>                    
                </div>
            </div>
        </template>
        <template v-else-if="vista=='historico'">
            <div class="p-3 bg-white rounded">  
                <div class="col-md-12 mb-0 text-center bg-light">
                    <h4>{{ titulo }}</h4>
                </div>
                <div class="card-body mt-5">
                    <form class="needs-validation" novalidate>
                        <div class="form-row text-center">                           
                            <div class="col-md-3 my-0">
                                <label class="col-form-label-lg">
                                    Nombre o Denominación :
                                </label>                                 
                            </div>                                

                            <div class="col-md-5 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ inmueble.denominacion }}
                                </label>                                  
                            </div>

                            <div class="col-md-1 form-group my-0">
                               <label class="col-form-label-lg">
                                    Codigo Catastral :
                                </label>                                  
                            </div>

                            <div class="col-md-3 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ inmueble.codigo_catastral }}
                                </label>                                  
                            </div>
                        </div>                                                             

                        <div class="border-top my-3"></div>

                        <div class="font-weight-bold text-center">Lista de pagos</div>

                        <div class="border-top my-3"></div>                        
                        
                        <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th width="20%">Tipo de pago</th>                           
                                    <th width="20%">Número de referencia</th>
                                    <th width="20%">Fecha</th>                                    
                                    <th width="20%">Banco</th>
                                    <th width="20%">Monto</th>                            
                                   <!-- <th width="20%">Imprimir</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="pago in pagos"> 
                                    <td v-if="pago.tipo_pago == 1">Depósito</td>      
                                    <td v-else>Punto de Venta</td>            
                                    <td>{{ pago.referencia }}</td>      
                                    <td>{{ pago.fecha_pago | formatoFecha }}</td>                                    
                                    <td>{{ pago.banco }}</td>
                                    <td>{{ pago.monto.toFixed(2) }}</td> 
                                   <!-- <td><i class="bx bx-edit bx-md"></i></td> -->
                                </tr>                            
                            </tbody>                  
                        </table>

                    
                        <div class="form-row mt-5">                             
                            <div class="col-md-6 d-flex justify-content-center" v-if="boton == 'registro'" >
                                <button type="button" @click="imprimirHistorico()" name="imprimir" class="btn btn-primary btn-registrar">
                                    <span class="align-middle ml-25">Imprimir</span>
                                </button>
                            </div>
                            <div class="col-md-3" v-else></div>

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
    import Datepicker from 'vuejs-datepicker';   
    import moment from 'moment';     

    export default {
        data() {
            return {
                //Vista de listado de contribuyente de Inmueble
                vista: 'listado',
                titulo: 'Nueva Declaración',                
                boton: 'registro',
                periodos: [],
                inmuebles: [],  
                declaracion: [],              
                tabla: '',

                //Datos de vista de detalle de inmueble
                inmueble: [],
                detalles: [],
                estatus: "",

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
                total: 0,

                pagos: [],
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
            datatable,
            Datepicker,
            moment,
        },

        filters: {
            formatoFecha: function(value) {
                if (value) {
                    return moment(String(value)).format('DD-MM-YYYY')
                }
            },
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

            formatoMonto(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },

            cambiarVista( opcion ) {                
                this.vista = opcion;

                if( this.vista == "listado") {
                    this.listarInmuebles();
                }            
            },

            agregarFila() {
                //console.log("Detalle : ", detalles);
                this.detalles.push({
                        tipoPago: '',
                        referencia: '',
                        banco: '',
                        fecha_pago: '',
                        monto_pago: ''
                    }); 

            },

            eliminarFila(index) {
                let me = this;                
                me.detalles.splice(index, 1);

                if( me.detalles.length == 0) {
                    me.boton = "";
                } else {
                    me.boton = "registro";
                }
            },    

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarInmuebles() {
                let me = this;

                var url = '/inmueble';

                axios.get(url).then(function (response) {
                // handle success                     
                console.log("response : ", response);

                var respuesta = response.data;                                    
                me.inmuebles = respuesta.inmuebles;

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
                                me.pagarRegistro(); 
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
                        'codigo_catastral': me.codigo_catastral,
                    }).then(function (response) {                        
                        alerta.fire(
                            'Registro!',
                            'Registro exitoso.',
                            'success'
                        );
                        me.limpiarCampos();
                        me.estatus = "pagado";                        
                        me.cambiarVista( "registro" );                        

                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },

            verDetalle( inmueble ) {
                
                this.vista = "registro";
                this.inmueble = inmueble;

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

            pagar( inmueble ) {
                let me = this;
                
                this.vista = "pagar";

                var url = '/impuesto_inmueble/'+inmueble.id;

                this.inmueble = inmueble;

                axios.get(url).then(function (response) {                
                // handle success                                      
                var respuesta = response.data;                     
                me.declaracion = respuesta.declaracion;

                me.detalles.push({
                        tipoPago: '',
                        referencia: '',
                        banco: '',
                        fecha_pago: '',
                        monto_pago: ''
                    });                   
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            pagarRegistro() {

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                });

                let me = this;       
                var monto = 0;

                for (var i = 0; i < this.detalles.length; i++) {                    
                    monto = monto + (parseFloat(this.detalles[i].monto_pago));
                }

                if( monto < me.declaracion.monto_impuesto.toFixed(2) ) {
                    alerta.fire(
                            'El monto no puede ser menor a monto impuesto!',
                            'Error.',
                            'error'
                        );
                    return false;
                }

                axios.post('/pago/registrar', {                        
                        'monto_pago': monto,
                        'tipo_contribuyente': "inmueble",
                        'idinmueble': me.declaracion.idinmueble,
                        'detalles': me.detalles,
                    }).then(function (response) {                        
                        alerta.fire(
                            'Registro!',
                            'Registro exitoso.',
                            'success'
                        );
                        me.idpago = response.data;
                        me.limpiarCampos();
                        me.boton = "solvencia";
                        me.cambiarVista( "pagar" );                           
                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },

            imprimirEdoCta( inmueble ) {

                console.log("Inmueble : ", inmueble.id);

                window.open('http://127.0.0.1:8000/edoCtaInmueble?idinmueble=' + inmueble.id,'_blank');

            },

             imprimirHistorico() {                      

                window.open('http://127.0.0.1:8000/historicoInmueble?idinmueble=' + this.inmueble.id,'_blank');

            },

            imprimirSolvencia() {                      
                let me = this;

                window.open('http://127.0.0.1:8000/solvenciaInmueble?idpago=' + me.idpago + '&idinmueble=' + me.inmueble.id,'_blank');

            },

            historico( inmueble ) {
                let me = this;
                this.titulo = "Historico de pagos";
                this.vista = "historico";

                var url = '/historico_inmueble/'+inmueble.id;

                axios.get(url).then(function (response) {
                // handle success
                var respuesta = response.data;
                me.inmueble = respuesta.inmueble;
                me.pagos = respuesta.pagos;
                console.log("Respuesta historica : ", response.data);                             
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            cancelarRegistro() {
                this.limpiarCampos();
                this.cambiarVista("listado");
            },

            limpiarCampos() {                
                this.inmuebles = [];
                this.detalles = [];                                
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
