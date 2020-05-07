 <template>
    <div class="shadow-container">

        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Declaración Actividad Económica</h4>
            </div>     
        </div>      
        <template v-if="vista=='listado'">    
            <div class="p-5 mt-1 bg-white rounded">                                               
                <div class="float-right mb-0 input-search">
                    <span>Buscar : </span>
                    <input type="text" id="mySearchText" class="border" @keyup="buscar()">                
                </div>
                <div>
                    <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">ID</th>                                
                                <th width="20%">Licencia</th>   
                                <th width="20%">Denominación</th>                                
                                <th width="10%">Rif</th>
                                <th width="10%">Fecha de Inscripción</th>
                                <th width="15%">Dirección</th>
                                <th class="text-center" width="20%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="comercio in comercios">
                                <td>{{ comercio.id }}</td>                                
                                <td>{{ comercio.licencia }}</td>                                
                                <td>{{ comercio.denominacion }}</td>
                                <td>{{ comercio.rif }}</td>
                                <td>{{ comercio.fecha_inscripcion }}</td>
                                <td>{{ comercio.direccion }}</td>
                                <td class="text-center">
                                    <i class='bx bxs-printer bx-md text-success btn-editar' title="Calcular Declaracion" @click="verDetalle(comercio)"></i>
                                    <i class='bx bxs-report bx-md text-primary btn-eliminar' title="Estado de cuenta" @click="imprimirEdoCta(comercio)"></i>
                                    <i class='bx bxs-coin-stack bx-md text-success btn-editar' title="Registrar Pago" @click="pagar(comercio)"></i>
                                    <i class='bx bx-history bx-md text-success btn-editar' title="Registrar Pago" @click="historico(comercio)"></i>
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
                <div class="card-body">                                               
                    <div class="form-row">                           
                        <div class="col-md-3 my-0">
                            <label class="col-form-label-lg">
                                Nombre o Denominación Comercial :
                            </label>                                 
                        </div>                                

                        <div class="col-md-6 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ comercio.denominacion }}
                            </label>                                  
                        </div>

                        <div class="col-md-1 form-group my-0">
                           <label class="col-form-label-lg">
                                Rif :
                            </label>                                  
                        </div>

                        <div class="col-md-2 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ comercio.rif }}
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
                                {{ comercio.direccion }}
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
                                {{ comercio.telefono }}
                            </label>                                  
                        </div>

                         <div class="col-md-1 my-0">
                            <label class="col-form-label-lg">
                                Licencia
                            </label>                                 
                        </div>                                

                        <div class="col-md-2 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ comercio.licencia }}
                            </label>                                  
                        </div>
                    </div>

                    <div class="border-top my-3"></div>

                    <div class="font-weight-bold text-center bg-light">Registro de detalle a pagar</div>

                    <div class="border-top my-3"></div>

                    <form v-if="estado_declaracion == 'deuda'">  
                        <div class="form-row col-md-12 mt-4 justify-content-center">
                            <label class="text-info text-center">
                                <h4>Contribuyente cuenta con deuda de Año {{ anio }}, debe ser cancelada.</h4>
                            </label>
                        </div>
                        <div class="form-row col-md-12 d-flex mt-5" v-if="mostrarBtnImprimir">
                             <div class="col-md-4 align-content-center">
                                <button type="button" @click="imprimirEdoCta( comercio )" name="Imprimir" class="btn btn-success btn-nuevo">
                                    <span class="align-middle">Estado de cuenta</span>
                                </button>    
                             </div>
                             <div class="col-md-4 align-content-center">
                                <button type="button" @click="pagar( comercio )" name="Imprimir" class="btn btn-success btn-nuevo">
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
                       <div class="form-row">
                            <div class="col-md-2"></div>

                                <label for="name" class="col-md-2">
                                    Año a declarar
                                </label>                                

                            <div class="col-md-4 text-center">
                                <div class="position-relative">                                    
                                    <label>
                                    <strong><h3>{{anio}}</h3></strong>
                                    </label>
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-2"></div>

                                <label for="name" class="col-md-2">
                                    Tipo de declaración
                                </label>                                

                            <div class="col-md-4 text-center">
                                <div class="position-relative">                                    
                                    <label v-if="tipoDeclaracion == 1">
                                        <strong><h3>Estimada</h3></strong>
                                    </label>
                                    <label v-if="tipoDeclaracion == 2">
                                        <strong><h3>Definitiva</h3></strong>
                                    </label>
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row text-center bg-light border align-middle">
                            <div class="col-md-1 form-group">
                               <label><strong>Codigo</strong></label>                               
                            </div>
                            <div class="col-md-3 form-group">
                               <label><strong>Actividad Económica</strong></label>                               
                            </div>
                            <div class="col-md-1 form-group">
                               <label><strong>Alicuota Anual</strong></label>                               
                            </div>
                             <div class="col-md-1 form-group">
                               <label><strong>Minimo Tributable</strong></label>                               
                            </div>
                             <div class="col-md-3 form-group">
                               <label><strong>Monto declaración</strong></label>                               
                            </div>
                            <div class="col-md-3 form-group">
                               <label><strong>Monto Impuesto</strong></label>                               
                            </div>
                        </div>

                        <div class="form-row text-center mt-3 border-bottom" v-for="codigo in codigos">
                            <div class="col-md-1 form-group">                               
                               <label><strong>{{ codigo.codigo }}</strong></label>
                            </div>
                            <div class="col-md-3 form-group">                               
                               <label><strong>{{ codigo.denominacion }}</strong></label>
                            </div>
                            <div class="col-md-1 form-group">                               
                               <label><strong>{{ codigo.alicuota_anual }}</strong></label>
                            </div>
                             <div class="col-md-1 form-group">                               
                               <label><strong>{{ codigo.minimo_tributable }}</strong></label>
                            </div>
                            <div class="col-md-3 form-group" v-if="estado_declaracion == 'estimada'">
                                <div v-for="ultimo in ultimoDeclarado" v-if="ultimo.idtipo == codigo.id">
                                    {{ codigo.monto = ultimo.monto_declaracion.toFixed(2) }}
                                </div>                                
                            </div>
                             <div class="col-md-3 form-group" v-else> 
                               <input v-model="codigo.monto" type="number" value="" class="form-control" @keyUp="numero($event)" required>
                               <div class="text-danger" v-if="esCero">
                                      <i>Debe ser mayor a cero</i>
                                </div>                          
                               <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                </div> 
                                <div class="invalid-feedback" v-if="!esCero">
                                      ¡Introduzca Monto!
                                </div>
                            </div>
                            <div class="col-md-3 form-group">                                
                                <label v-if="(codigo.alicuota_anual * codigo.monto)>(unidad_tributaria * codigo.minimo_tributable)">
                                    <strong>
                                        {{ codigo.monto_impuesto=(codigo.alicuota_anual * codigo.monto).toFixed(2) }}
                                    </strong>
                                </label>                                
                                <label v-else>
                                    <strong>
                                        {{ codigo.monto_impuesto=(unidad_tributaria * codigo.minimo_tributable).toFixed(2) }}
                                    </strong>
                                </label>
                            </div>
                        </div>                        
                        
                        
                        <div class="form-row text-center mt-3">
                            <div class="col-md-6"></div>
                            <div class="col-md-3 bg-light">
                                <h5> Total de impuestos : </h5>
                            </div>
                            <div class="col-md-3 bg-light" v-if="calcularTotal < total_minimos">
                                {{ total_minimos.toFixed(2) }}
                            </div>  
                            <div class="col-md-2 bg-light" v-else>
                                <h5> {{ total=calcularTotal.toFixed(2) }} </h5>
                            </div>                         
                        </div>
                        

                        <div class="form-row mt-5"> 
                            <div class="col-md-1" v-if="!mostrarBtnImprimir"></div>                          
                            <div class="col-md-4 d-flex justify-content-center" v-if="mostrarBtnRegistrar">
                                <button type="button" @click="validarFormulario( 'registro' )" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Registrar</span>
                                </button>
                            </div>

                            <div class="col-md-4 d-flex justify-content-center" v-if="mostrarBtnImprimir">
                                 <button type="button" @click="imprimirEdoCta( comercio )" name="Imprimir" class="btn btn-success btn-nuevo">
                                    <span class="align-middle ml-25">Imprimir</span>
                                </button>
                            </div>
                            <div class="col-md-1" v-else></div>
                            <div class="col-md-4 d-flex justify-content-center ">
                                <i class='bx bx-cancel bx-sm' ></i>
                                <input type="button" name="cancelar" @click="cancelarRegistro()" class="btn btn-danger btn-cancelar" value="Cancelar">
                            </div>
                            <div class="col-md-2" v-if="!mostrarBtnImprimir"></div>
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

                             <div class="col-md- my-0">
                                <label class="col-form-label-lg">
                                    Monto Declarado
                                </label>                                 
                            </div>                                

                            <div class="col-md-4 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ formatoMonto(declaracion.monto_declaracion) }}
                                </label>                                  
                            </div>

                            <div class="col-md-2 my-0">
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
                            
                            <div class="col-md-6 d-flex justify-content-center" v-if="boton == 'registro'" >
                                <button type="button" @click="validarFormulario( 'pagar' )" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Registrar</span>
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
                                    {{ comercio.denominacion }}
                                </label>                                  
                            </div>

                            <div class="col-md-1 form-group my-0">
                               <label class="col-form-label-lg">
                                    Rif :
                                </label>                                  
                            </div>

                            <div class="col-md-3 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ comercio.rif }}
                                </label>                                  
                            </div>
                        </div>                                                             

                        <div class="border-top my-3"></div>

                        <div class="font-weight-bold text-center">Lista de pagos</div>

                        <div class="border-top my-3"></div>                        
                        
                        <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">                                
                                    <th width="20%">Número de referencia</th>
                                    <th width="20%">Fecha</th>                                    
                                    <th width="20%">Banco</th>
                                    <th width="20%">Monto</th>                            
                                    <th width="20%">
                                        Imprimir
                                    </th>                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="pago in pagos">                          
                                    <td>{{ pago.referencia }}</td>      
                                    <td>{{ pago.fecha_pago | formatoFecha }}</td>                                    
                                    <td>{{ pago.banco }}</td>
                                    <td>{{ pago.monto.toFixed(2) }}</td> 
                                    <td><i class="bx bx-edit bx-md"></i></td>                                                   
                                </tr>                            
                            </tbody>                  
                        </table>

                    
                        <div class="form-row mt-5">                             
                            <div class="col-md-6 d-flex justify-content-center" v-if="boton == 'registro'" >
                                <button type="button" @click="validarFormulario( 'pagar' )" name="registro" class="btn btn-primary btn-registrar">
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
    @import "../../../public/css/switch.css";
</style>    

<script type="text/javascript">

    import datatable from 'datatables';    
    import Datepicker from 'vuejs-datepicker'; 
    import moment from 'moment';  

    export default {
        data() {
            return {
                //Vista de listado de contribuyente de actividad económica
                vista: 'listado',
                titulo: 'Nueva Declaración',
                comercios: [],
                boton: 'registro',                
                tabla: '',
                comercioImp: [],
                detalles: [],
                mostrarBtnRegistrar: true,
                mostrarBtnImprimir: false,

                //Datos de vista de detalle de comercio
                comercio: [],
                periodo: '',
                anio: '', 
                tipoDeclaracion: '',
                estado_declaracion: '',
                ultimoDeclarado: [],
                codigos: [],
                unidad_tributaria: 0,
                monto: 0,                
                total: 0,
                total_minimos: 0,
                mensaje_deuda: false, 
                esCero: false,    

                //Modulo de pago
                declaracion: [],
                detalles: [],     

                //Historico de pagos
                pagos: [],                   
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
            datatable,
            Datepicker,
            moment
        },

        filters: {
            formatoFecha: function(value) {
                if (value) {
                    return moment(String(value)).format('DD-MM-YYYY')
                }
            },

            numero: function( value ) {
                if(value) {
                    console.log("Valor : ", value);
                }
            }
        },

        computed: {
            calcularTotal: function() {
                var resultado = 0.00;
                var monto = 0;
                var montoTotal= 0;

                for (var i = 0; i < this.codigos.length; i++) {
                    if( !this.codigos[i].monto ) {                        
                        monto = this.unidad_tributaria * this.codigos[i].minimo_tributable;                         
                    } else {
                        monto = this.codigos[i].monto*this.codigos[i].alicuota_anual;
                    }
                    resultado = resultado+(monto);                    
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
                    this.listarComercios();
                }            
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarComercios() {
                let me = this;

                var url = '/comercio';

                axios.get(url).then(function (response) {
                // handle success

                console.log("Response : ", response);

                var respuesta = response.data;                                    
                me.comercios = respuesta.comercios.data;

                me.tablaComercios();
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
            
            validarFormulario( accion ) {
                let me=this;
                let vacio = false;
            
             var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    //form.addEventListener('submit', function(event) { 
                        for (var i = 0; i < me.codigos.length; i++) {
                            if( me.codigos[i].monto == 0) { 
                                vacio = true;
                            }                                              
                        }

                        if (form.checkValidity() === false) {
                          event.preventDefault();
                          event.stopPropagation(); 
                          form.classList.add('was-validated');                          
                        } else if( vacio ) {
                            form.classList.remove('was-validated');                          
                            me.esCero = true;
                        } 
                        else {
                           if( accion == 'registro' ) {                                 
                                console.log("Registro de accion : ", accion);
                                me.agregarRegistro(); 
                            } else if( accion == 'pagar' ) {
                                me.pagarRegistro(); 
                            }
                        }                        
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

                axios.post('/declaracion_comercio/registrar', {                        
                        'idcomercio': me.comercio.id,
                        'idperiodo': me.periodo.id, 
                        'tipo_declaracion': me.tipoDeclaracion,
                        'rif': me.comercio.rif,
                        'codigos': me.codigos
                    }).then(function (response) {          
                        console.log("response : ", response);
                        alerta.fire(
                            'Registro!',
                            'Registro exitoso.',
                            'success'
                        );
                        
                        if( me.tipoDeclaracion == 1) {
                            me.mostrarBtnImprimir = true;                                                                             
                        }                        
                        me.limpiarCampos();
                        me.verDetalle( me.comercio );
                        //me.cambiarVista( "listado" );                        

                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },

            verDetalle( comercio ) {
                
                this.comercio = comercio;
                this.vista = "registro";

                let me = this;

                var url = '/declaracion_comercio/'+comercio.id;

                axios.get(url).then(function (response) {                    
                // handle success
                
                var respuesta = response.data;                                 
                me.anio = respuesta.anio;
                me.periodo = respuesta.periodo;
                me.unidad_tributaria = respuesta.periodo.unidad_tributaria;                
                me.tipoDeclaracion = respuesta.tipoDeclaracion; 
                me.estado_declaracion = respuesta.estado_declaracion;                

                if( me.estado_declaracion == 'estimada' ) {                    
                    me.ultimoDeclarado = respuesta.ultimaDeclaracion;
                }
                if( me.estado_declaracion == 'deuda' ) {
                    me.mensaje_deuda = true;
                    me.mostrarBtnImprimir = true;
                }

                me.listarCodigos( comercio );                
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            pagar( comercio ) {
                let me = this;
                
                this.vista = "pagar";
                this.titulo = 'Agregar Nuevo Pago';
               
                var url = '/declaracion/'+comercio.id;

                axios.get(url).then(function (response) {                
                // handle success                                      
                var respuesta = response.data;                                    
                console.log("Declaracion Respuesta : ", respuesta);
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

                let me = this; 
                var monto = 0;

                 const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                });

                for (var i = 0; i < this.detalles.length; i++) {                    
                    monto = monto + (parseFloat(this.detalles[i].monto_pago));
                }

                if( monto != me.declaracion.monto_impuesto ) {
                    alerta.fire(
                            'El monto debe coincidir con monto impuesto!',
                            'Error.',
                            'error'
                        );
                    return false;
                }

                axios.post('/pago/registrar', {                        
                        'monto_pago': monto,
                        'tipo_contribuyente': "comercio",
                        'idcomercio': me.declaracion.idcomercio,
                        'detalles': me.detalles,
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

            imprimirEdoCta( comercio ) {

                console.log("Comerio : ", comercio.id);

                window.open('http://127.0.0.1:8000/edoCtaComercio?idcomercio=' + comercio.id,'_blank');

            },

            listarCodigos( comercio ) {

                let me=this;

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
              });

            },

            minimosTributables() {

                let me=this;

                for (var i = 0; i < this.codigos.length; i++) {
                    me.monto_minimo = me.codigos[i].minimo_tributable * me.unidad_tributaria; 
                    me.total_minimos = me.total_minimos + me.monto_minimo;                    
                }
            },

            historico( comercio ) {
                let me = this;
                this.titulo = "Historico de pagos";
                this.vista = "historico";

                var url = '/historico_comercio/'+comercio.id;

                axios.get(url).then(function (response) {
                // handle success
                var respuesta = response.data;
                me.comercio = respuesta.comercio;
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
                this.registrado = false;
            },

            limpiarCampos() {                
                this.comercios = [];
                //this.comercio = [];
                this.codigos = [];      
                this.detalles = [];      
                this.unidad_tributaria= 0,
                this.monto = 0,                
                this.total = 0,
                this.total_minimos = 0;  
                this.boton = 'registro';
                this.titulo = 'Agregar declaracion';
            },
        },

        mounted() {
            console.clear();  
            this.listarComercios();               
        }
    }
</script>
