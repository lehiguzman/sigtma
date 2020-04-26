<template>
    <div class="contenedor">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="float-left pr-1">
                            <b>Pago Contribuyente -> Vehiculo</b>
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
                                <th width="20%">Propietario</th>
                                <th width="20%">Cédula</th>
                                <th width="10%">Placa</th>
                                <th width="10%">Serial</th>
                                <th width="25%">Dirección</th>                                
                                <th width="10%">Monto impuesto</th>                                
                                <th class="text-center" width="15%">Registrar Pago</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="declaracion in declaraciones">                                
                                <td>{{ declaracion.denominacion }}</td>
                                <td>{{ declaracion.rif }}</td>
                                <td>{{ declaracion.placa }}</td>
                                <td>{{ declaracion.serial }}</td>                                
                                <td>{{ declaracion.direccion }}</td>                                
                                <td>{{ declaracion.monto_impuesto }}</td>
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
            <div class="p-5 bg-white rounded shadow-container">  
                 <div class="card-header">                    
                    <h4 class="card-text">{{ titulo }}</h4>
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
                                    {{ declaracion.monto_impuesto }}
                                </label>                                  
                            </div>

                            <div class="col-md-2 my-0">
                                <label class="col-form-label-lg">
                                    Monto Impuesto
                                </label>                                 
                            </div>                                

                            <div class="col-md-2 form-group my-0">
                               <label class="col-form-label-lg">
                                    {{ declaracion.monto_impuesto }}
                                </label>                                  
                            </div>
                        </div>                          

                        <div class="border-top my-3"></div>

                        <div class="font-weight-bold text-center">Registro de detalle de pagos</div>

                        <div class="border-top my-3"></div>

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
                        <div class="form-row mt-2">
                            <div class="col-md-2">
                                <select class="form-control" v-model="tipoPago" value="tipoPago" required>
                                   <option value="" selected disabled>Tipo de Pago</option>
                                   <option value="1">Cheque</option>
                                   <option value="2">Transferencia</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <input v-model="referencia" type="referencia" value="3" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <input v-model="banco" type="text" value="3" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <div class="position-relative has-icon-left">
                                    <datepicker name="fecha_pago" v-model="fecha_pago" bootstrap-styling format="dd/MM/yyyy" placeholder="Fecha de pago" required>
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
                                <input v-model="monto_pago" type="text" value="3" class="form-control" required>
                            </div>
                        </div>                                             

                        <div class="form-row mt-5">                            
                            
                            <div class="col-md-6 d-flex justify-content-center" v-if="boton == 'registro'" >
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
    import Datepicker from 'vuejs-datepicker';   

    export default {
        data() {
            return {
                //Vista de listado de contribuyente de actividad económica
                vista: 'listado',
                titulo: 'Agregar Nuevo Pago de contribuyente',
                declaraciones: [],
                declaracion: [],
                comercio: [],                
                //tipos: [],
                boton: 'registro',                
                tabla: '',

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
                monto_pago: ''          
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

            listarDeclaraciones(){

                let me = this;

                var url = '/declaracion_vehiculo';

                axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;                                    
                me.declaraciones = respuesta.declaraciones_vehiculo.data;                
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

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                });

                let me = this;       

                if( me.monto_pago != me.declaracion.monto_impuesto ) {
                    alerta.fire(
                            'El monto debe coincidir con monto impuesto!',
                            'Error.',
                            'error'
                        );
                    return false;
                }

                axios.post('/pago/registrar', {
                        'tipo_pago': me.tipoPago,
                        'referencia': me.referencia,
                        'banco': me.banco,
                        'fecha_pago': me.fecha_pago,
                        'monto_pago': me.monto_pago,
                        'tipo_contribuyente': "vehiculo",
                        'idvehiculo': me.declaracion.idvehiculo
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

            verDetalle( declaracion ) {
                let me = this;
                
                this.vista = "registro";

                var url = '/impuesto_vehiculo/'+declaracion.idvehiculo;

                axios.get(url).then(function (response) {                
                // handle success                                      
                var respuesta = response.data;                
                me.declaracion = respuesta;                
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
