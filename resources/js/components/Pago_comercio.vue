<template>
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Pago Actividad Económica</h4>
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
                                <th width="10%">Codigo</th>                                                                
                                <th width="30%">Denominación</th>  
                                <th width="30%">Tipo de declaración</th>                          
                                <th width="20%">Rif</th>
                                <th width="20%">Dirección</th>
                                <th class="text-center" width="20%">Registrar Pago</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center" v-for="declaracion in declaraciones">
                                <td>{{ declaracion.id }}</td>
                                <td>{{ declaracion.denominacion }}</td>                               
                                <td v-if="declaracion.tipo_declaracion == 1">Estimada</td>                                
                                <td v-if="declaracion.tipo_declaracion == 2">Definitiva</td>                                
                                <td>{{ declaracion.rif }}</td>
                                <td>{{ declaracion.direccion }}</td>                                
                                <td class="text-center">
                                    <i class='bx bxs-coin-stack bx-md text-success btn-editar' title="Registrar Pago" @click="verDetalle(declaracion)"></i>
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
                            <div class="col-md-2 my-0">
                                <label class="col-form-label-lg">
                                    Periodo:
                                </label>                                 
                            </div>                                

                            <div class="col-md-2 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ declaracion.periodo }}
                                </label>                                  
                            </div>

                             <div class="col-md-2 my-0">
                                <label class="col-form-label-lg">
                                    Monto Declarado
                                </label>                                 
                            </div>                                

                            <div class="col-md-2 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ formatoMonto(declaracion.monto_declaracion) }}
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
                                <button type="button" @click="validarFormulario( 'registro' )" name="registro" class="btn btn-primary btn-registrar">                                       
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
    </div>
</template>

<style scoped>
    /* Se importan los estilos del modulo */
    @import "../../../public/css/usuario.css";
    
</style>    

<script type="text/javascript">

    import datatable from 'datatables';
    import Datepicker from 'vuejs-datepicker';   

    export default {
        data() {
            return {
                //Vista de listado de contribuyente de actividad económica
                vista: 'listado',
                titulo: 'Nuevo Pago',
                declaraciones: [],
                declaracion: [],                
                periodo: [],                
                boton: 'registro',                
                tabla: '',
                detalles: [],

                //Vista de registro de pago de contribuyente Actividad Ecónomica
                id: 0,
                denominacion: '',
                tipoPago: '',
                referencia: '',
                banco: '',
                rif: '',
                fecha_pago: '',                
                monto_declarado: 0, 
                monto_impuesto: 0,
                monto_pago: 0      
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
            datatable,
            Datepicker       
        },

        methods: {

            formatoMonto(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },

            cambiarVista( opcion ) {                
                this.vista = opcion;                
                this.listarDeclaraciones();                
            },

///////////////////////////* Listado de contribuyente de actividad económica ///////////////////
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
                                console.log("Accion : ", accion);
                                me.agregarRegistro(); 
                            } else { 
                                me.actualizarRegistro(); 
                            }
                        }
                        form.classList.add('was-validated');
                    //}, false);
                });
            },

            listarDeclaraciones(){

                let me = this;

                var url = '/declaracion_comercio';

                axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;     
                console.log("Respuesta : ", respuesta);
                me.declaraciones = respuesta.declaraciones_comercio;                
                if( me.declaraciones.length == 0 ) {
                    me.limpiarCampos();
                    me.tablaDeclaraciones();
                } else {
                    me.tablaDeclaraciones();    
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

            tablaDeclaraciones() {
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
     

////////////////////////* Registro de Pago *////////////////////////////////////////            
            agregarRegistro() {

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

            eliminarFila(index) {
                let me = this;                
                me.detalles.splice(index, 1);

                if( me.detalles.length == 0) {
                    me.boton = "";
                } else {
                    me.boton = "registro";
                }
            },

            verDetalle( declaracion ) {
                let me = this;
                
                this.vista = "registro";
               
                var url = '/declaracion/'+declaracion.idcomercio;

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

            cancelarRegistro() {
                this.limpiarCampos();
                this.cambiarVista("listado");
            },

            limpiarCampos() {                
                this.comercios = [];
                this.id = 0;
                this.referencia = '',
                this.denominacion = '',
                this.tipo_pago = '';
                this.banco = '';
                this.fecha_pago = '';                
                this.boton = 'registro';
                this.titulo = 'Agregar Nuevo Pago';
            },               
        },       

        mounted() {
            this.listarDeclaraciones();                        
            console.log('Component mounted.')
        }
    }
</script>
