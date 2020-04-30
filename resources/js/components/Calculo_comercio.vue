 <template>
    <div class="contenedor">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="float-left pr-1">
                            <b>Calcular Declaración -> Actividad económica</b>
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
                                <th width="20%">Licencia</th>   
                                <th width="30%">Denominación</th>                                
                                <th width="10%">Rif</th>
                                <th width="10%">Fecha de Inscripción</th>
                                <th width="15%">Dirección</th>
                                <th class="text-center" width="10%">Acción</th>                                  
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
                        <div class="form-row col-md-12 text-center">
                            <label class="text-info text-center">
                                <h4>Contribuyente cuenta con deuda de Año {{ anio }}, debe ser cancelada.</h4>
                            </label>
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
                               <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                </div> 
                                <div class="invalid-feedback">
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
                            <div class="col-md-6 d-flex justify-content-center" v-if="!registrado">
                                <button type="button" @click="validarFormulario( 'registro' )" name="registro" class="btn btn-primary btn-registrar">                                       
                                    <span class="align-middle ml-25">Registrar</span>
                                </button>
                            </div>

                            <div class="col-md-6 d-flex justify-content-center" v-else>
                                 <button type="button" @click="imprimirEdoCta( comercio )" name="Imprimir" class="btn btn-success btn-nuevo">
                                    <span class="align-middle ml-25">Imprimir</span>
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
                titulo: 'Agregar Nueva Actividad comercial',
                comercios: [],
                boton: 'registro',                
                tabla: '',
                comercioImp: [],
                registrado: false,

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
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
            datatable            
        },

        filters: {
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

                console.log("Codigo a registrar : ", me.codigos)

                axios.post('/declaracion_comercio/registrar', {                        
                        'idcomercio': me.comercio.id,
                        'idperiodo': me.periodo.id, 
                        'tipo_declaracion': me.tipoDeclaracion,
                        'codigos': me.codigos
                    }).then(function (response) {          
                        console.log("response : ", response);
                        alerta.fire(
                            'Registro!',
                            'Registro exitoso.',
                            'success'
                        );
                        me.registrado = true,
                        me.limpiarCampos();
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

            cancelarRegistro() {
                this.limpiarCampos();
                this.cambiarVista("listado");
            },

            limpiarCampos() {                
                this.comercios = [];
                //this.comercio = [];
                this.codigos = [];
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
