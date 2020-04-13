<template>
    <div class="contenedor">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="float-left pr-1">
                            <b>Calcular Declaración -> Vehiculo</b>
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
                                <th width="15%">Placa</th>
                                <th width="20%">Propietario</th>
                                <th width="20%">Serial</th>
                                <th width="10%">Cédula Propietario</th> 
                                <th width="10%">Dirección</th>                                
                                <th class="text-center" width="10%">Acción</th>                                  
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

                    <div class="font-weight-bold text-center bg-light">Registro de detalle a pagar</div>

                    <div class="border-top my-3"></div>

                    <form class="needs-validation" novalidate>

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
                //Vista de listado de contribuyente de Vehiculo
                vista: 'listado',
                titulo: 'Agregar Nueva Declaración Vehiculo',                
                boton: 'registro',
                vehiculos: [],
                periodos: [],             
                tabla: '',

                //Datos de vista de detalle de vehiculo
                vehiculo: [],

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
            datatable            
        },        

        methods: {
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

                axios.post('/declaracion_vehiculo/registrar', {
                        'idvehiculo': me.idvehiculo,
                        'periodos': me.periodos,
                        'monto_ut': me.monto_ut                     
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

            verDetalle( vehiculo ) {
                
                this.vista = "registro";

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

            cancelarRegistro() {
                this.limpiarCampos();
                this.cambiarVista("listado");
            },

            limpiarCampos() {                
                this.vehiculos = [];
                this.vehiculo = [];                
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
