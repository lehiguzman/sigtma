<template>
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Declaración Vehiculo</h4>
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
                                <th width="15%">Placa</th>
                                <th width="15%">Propietario</th>
                                <th width="15%">Serial</th>
                                <th width="10%">Cédula Propietario</th> 
                                <th width="10%">Dirección</th>                                
                                <th class="text-center" width="20%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="vehiculo in vehiculos">
                                <td>{{ vehiculo.id }}</td>                                
                                <td>{{ vehiculo.placa }}</td>
                                <td>{{ vehiculo.denominacion }}</td>
                                <td>{{ vehiculo.serial }}</td>                                
                                <td>{{ vehiculo.rif }}</td>
                                <td>{{ vehiculo.direccion }}</td>                  
                                <td class="text-center">
                                    <i class='bx bxs-printer bx-md text-success btn-editar' title="Calcular Declaracion" @click="verDetalle(vehiculo)"></i>
                                    <i class='bx bxs-report bx-md text-primary btn-eliminar' title="Estado de cuenta" @click="imprimirEdoCta(vehiculo)"></i>
                                    <i class='bx bxs-coin-stack bx-md text-success btn-editar' title="Registrar Pago" @click="pagar(vehiculo)"></i>
                                    <i class='bx bx-history bx-md text-success btn-editar' title="Registrar Pago" @click="historico(vehiculo)"></i>
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
                                Placa :
                            </label>                                 
                        </div>
                        <div class="col-md-3 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ placa }}
                            </label>                                  
                        </div>                                                 
                        <div class="col-md-2">
                            <label class="col-form-label-lg">
                                Serial :
                            </label>                                 
                        </div>                                

                        <div class="col-md-2 form-group my-0">
                           <label class="col-form-label-lg">
                                {{ serial }}
                            </label>                                  
                        </div>
                    </div>                    

                    <div class="border-top my-3"></div>

                    <div class="font-weight-bold text-center bg-light">Detalle de impuesto a pagar</div>

                    <div class="border-top my-3"></div>

                    <form v-if="estatus == 'pagado'">                          
                        <div class="form-row col-md-12 d-flex mt-5">
                             <div class="col-md-4 align-content-center">
                                <button type="button" @click="imprimirEdoCta( vehiculo )" name="Imprimir" class="btn btn-success btn-nuevo">
                                    <span class="align-middle">Estado de cuenta</span>
                                </button>    
                             </div>
                             <div class="col-md-4 align-content-center">
                                <button type="button" @click="pagar( vehiculo )" name="Imprimir" class="btn btn-success btn-nuevo">
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
                            <div class="col-md-4">
                               <label><strong>Periodo</strong></label>                               
                            </div>                            
                            <div class="col-md-4">
                               <label><strong>Tipo de Vehiculo</strong></label>                               
                            </div>
                            <div class="col-md-4">
                               <label><strong>Impuesto a pagar</strong></label>                               
                            </div>
                        </div>

                        <div class="form-row text-center mt-3 border-bottom" v-for="periodo in periodos">
                            <div class="col-md-4 form-group">                               
                               <label><strong>{{ periodo.periodo }}</strong></label>
                            </div>                            
                            <div class="col-md-4 form-group">                               
                               <label><strong>{{ tipo_vehiculo }}</strong></label>
                            </div>
                            <div class="col-md-4 form-group">                               
                               <label><strong>{{ periodo.unidad_tributaria * monto_ut }}</strong></label>
                            </div>                            
                        </div>                               
                        
                        <div class="form-row text-center mt-3">
                            <div class="col-md-6"></div>
                            <div class="col-md-3 bg-light">
                                <h5> Total de impuestos : </h5>
                            </div>
                            <div class="col-md-3 bg-light">
                                {{ monto_impuesto.toFixed(2) }}
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

        <template v-else-if="vista=='pagar'">
            <div class="p-3 bg-white rounded">  
                <div class="col-md-12 mb-0 text-center bg-light">
                    <h4>{{ titulo }}</h4>
                </div>
                <div class="card-body mt-5">
                    <form class="needs-validation" novalidate>
                        <div class="form-row">                           
                            <div class="col-md-3 my-0">
                                <label class="col-form-label-lg">
                                    Nombre Propietario :
                                </label>                                 
                            </div>                                

                            <div class="col-md-5 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ declaracion.denominacion }}
                                </label>                                  
                            </div>

                            <div class="col-md-2 form-group my-0">
                               <label class="col-form-label-lg">
                                    Cédula :
                                </label>                                  
                            </div>

                            <div class="col-md-2 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ declaracion.rif }}
                                </label>                                  
                            </div>
                        </div>                        
                        <div class="form-row">                           
                            <div class="col-md-2 my-0">
                                <label class="col-form-label-lg">
                                    Placa:
                                </label>                                 
                            </div>                                

                            <div class="col-md-2 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ declaracion.placa }}
                                </label>                                  
                            </div>

                             <div class="col-md-2 my-0">
                                <label class="col-form-label-lg">
                                    Monto impuesto
                                </label>                                 
                            </div>                                

                            <div class="col-md-2 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ formatoMonto(declaracion.monto_impuesto) }}
                                </label>                                  
                            </div>

                            <div class="col-md-2 my-0">
                                <label class="col-form-label-lg">
                                    Monto Impuesto
                                </label>                                 
                            </div>                                

                            <div class="col-md-2 form-group my-0">
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

                            <div class="col-md-4 form-group">
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

                            <div class="col-md-4">
                                <div class="position-relative has-icon-left">
                                    <datepicker name="fecha_pago" v-model="detalle.fecha_pago" bootstrap-styling format="dd/MM/yyyy" placeholder="Fecha de pago" required>
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
                        </div>                                             
                        </div>
                        <div class="form-row mt-5">                            
                            
                            <div class="col-md-6 d-flex justify-content-center" v-if="boton == 'registro'" >
                                <button type="button" @click="validarFormulario( 'pagar' )" name="registro" class="btn btn-primary btn-registrar">                                       
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
                                    {{ vehiculo.denominacion }}
                                </label>                                  
                            </div>

                            <div class="col-md-1 form-group my-0">
                               <label class="col-form-label-lg">
                                    Placa :
                                </label>                                  
                            </div>

                            <div class="col-md-3 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ vehiculo.placa }}
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

</style>    

<script type="text/javascript">

    import datatable from 'datatables';
    import Datepicker from 'vuejs-datepicker'; 
    import moment from 'moment';              

    export default {
        data() {
            return {
                //Vista de listado de contribuyente de Vehiculo
                vista: 'listado',
                titulo: 'Nueva Declaración',                
                boton: 'registro',
                vehiculos: [],
                periodos: [],             
                tabla: '',

                //Datos de vista de detalle de vehiculo
                vehiculo: [],
                declaracion: [],
                detalles: [],
                estatus: "",
                pagos: [],

                idvehiculo: 0,
                idtipo: 0,
                anio: '',
                denominacion: '',
                rif: '',
                placa: '',
                serial: '',
                tipo_vehiculo: '', 
                monto_ut: 0,               
                monto_impuesto: 0,                
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

        methods: {

            formatoMonto(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },

            cambiarVista( opcion ) {                
                this.vista = opcion;

                if( this.vista == "listado") {
                    this.listarVehiculos();
                }            
            },

///////////////////////////* Listado de contribuyente de actividad económica *//////////////////////////////////////////            

            listarVehiculos() {
                let me = this;

                var url = '/vehiculo';

                axios.get(url).then(function (response) {
                // handle success                     

                var respuesta = response.data;                                    
                me.vehiculos = respuesta.vehiculos.data;

                me.tablaVehiculos();
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

                axios.post('/declaracion_vehiculo/registrar', {
                        'idvehiculo': me.idvehiculo,
                        'periodos': me.periodos,
                        'monto_ut': me.monto_ut,
                        'placa': me.placa,                     
                    }).then(function (response) {                        
                        alerta.fire(
                            'Registro!',
                            'Registro exitoso.',
                            'success'
                        );
                        me.limpiarCampos();
                        me.cambiarVista( "registro" );
                        me.estatus = "pagado";

                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },

            verDetalle( vehiculo ) {
                
                this.vista = "registro";
                this.vehiculo = vehiculo;

                let me = this;               

                var url = '/declaracion_vehiculo/'+vehiculo.id;

                axios.get(url).then(function (response) {
                // handle success                     
                
                var respuesta = response.data;  
                
                me.idvehiculo = respuesta.vehiculo.id;
                me.denominacion = respuesta.vehiculo.denominacion;
                me.placa = respuesta.vehiculo.placa;
                me.serial = respuesta.vehiculo.serial;
                me.rif = respuesta.vehiculo.rif;
                me.idtipo = respuesta.tipo_vehiculo.id;
                me.monto_ut = respuesta.tipo_vehiculo.monto_ut;                
                me.tipo_vehiculo = respuesta.tipo_vehiculo.tipo;
                me.periodos = respuesta.periodos;

                for (var i = 0; i < me.periodos.length; i++) { 
                    me.monto_impuesto = me.monto_impuesto + (me.periodos[i].unidad_tributaria * me.monto_ut);
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

            pagar( vehiculo ) {
                let me = this;
                
                this.vista = "pagar";

                var url = '/impuesto_vehiculo/'+vehiculo.id;

                axios.get(url).then(function (response) {                
                // handle success                                      
                var respuesta = response.data;                
                me.declaracion = respuesta;
                
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
                        'tipo_contribuyente': "vehiculo",
                        'idvehiculo': me.declaracion.idvehiculo,
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

            imprimirEdoCta( vehiculo ) {                

                window.open('http://127.0.0.1:8000/edoCtaVehiculo?idvehiculo=' + vehiculo.id,'_blank');

            },

            historico( vehiculo ) {
                let me = this;
                this.titulo = "Historico de pagos";
                this.vista = "historico";
                    console.log("Vahiculo : ", vehiculo);
                var url = '/historico_vehiculo/'+vehiculo.id;

                axios.get(url).then(function (response) {
                // handle success
                var respuesta = response.data;
                me.vehiculo = respuesta.vehiculo;
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
                this.vehiculos = [];                
                this.boton = 'registro';
                this.titulo = 'Agregar declaracion';
            },
        },

        mounted() {
            console.clear();
            this.listarVehiculos();               
        }
    }
</script>
