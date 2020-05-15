<template>
	<div class="shadow-container">
		<div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Reporte de trámites</h4>
            </div>     
        </div>

        <template v-if="vista == 'listado'">
        	<div class="p-5 bg-white rounded">
        	<div class="card-body mt-4">
        		<div class="form-row">
        			<div class="col-md-3"></div>
        			<div class="col-md-2 text-center">
        				Usuarios		
        			</div>
        			<div class="col-md-3 text-center" v-if="rol == 'supervisor'">
        				<div class="position-relative has-icon-left" >
	        				<select class="form-control" v-model="usuario" value="usuario" required @change="asignaUsuario($event)">
                               <option value="todos">Todos</option>
	                           <option v-for="usuario in usuarios" :key="usuario.id" :value="usuario.id" v-text="usuario.name"></option>
	                        </select>                                    
	                        <div class="valid-feedback">
	                          <i>¡Correcto!</i>
	                        </div>
	                        <div class="invalid-feedback">
	                          ¡Seleccione Usuario!
	                        </div>
	                        <div class="form-control-position">
	                            <i class='bx bx-user bx-sm'></i>
	                        </div>
	                    </div>
        			</div>
                    <div class="col-md-3 text-center" v-else-if="rol == 'gerente'">
                        <div class="position-relative has-icon-left">
                            <select class="form-control" v-model="usuario" value="usuario" required @change="asignaUsuario($event)">
                               <option value="todos">Todos</option>
                               <option v-for="usuario in usuarios" :key="usuario.id" :value="usuario.id" v-text="usuario.name"></option>
                            </select>                                    
                            <div class="valid-feedback">
                              <i>¡Correcto!</i>
                            </div>
                            <div class="invalid-feedback">
                              ¡Seleccione Usuario!
                            </div>
                            <div class="form-control-position">
                                <i class='bx bx-user bx-sm'></i>
                            </div>
                        </div>
                    </div>  
                    <div class="col-md-3 text-center" v-else>
                        <div class="position-relative">                                                               
                            <h2><b>{{ userPerm.name }}</b></h2>
                        </div>
                    </div>			
        		</div>
        		<div class="form-row mt-5" v-if="usuario">
        			<div class="col-md-3"></div>
        			<div class="col-md-2 text-center">
        				<div class="badge-light badge-pill">
        					Dia de hoy        				
        				</div>		
        			</div>
        			<div class="col-md-1"></div>    			
        			<div class="col-md-2 text-center">
        				<div class="badge-light badge-pill">
        					Periodo
        				</div>        				
        			</div>
        		</div>
        		<div class="form-row mt-2" v-if="usuario">
        			<div class="col-md-3"></div>
        			<div class="col-md-2 text-center">
        				<div class="custom-radio">
        					<input type="radio" name="radio_periodo" id="radio_periodo" checked="true" 
        					v-on:change="esPeriodo = 'no'">
        				</div>		
        			</div>
        			<div class="col-md-1"></div>    			
        			<div class="col-md-2 text-center">
        				<div class="custom-radio">
        					<input type="radio" name="radio_periodo" id="radio_periodo" v-model="radio_periodo" 
        					v-on:change="esPeriodo = 'si'">
        				</div>        				
        			</div>
        		</div>

        		<div class="form-row mt-5" v-if="esPeriodo == 'si' ">
        			<div class="col-md-3"></div>
        			<div class="col-md-2 text-center">
        				<div class="badge-light badge-pill">
        					Desde
        				</div>		
        			</div>
        			<div class="col-md-1"></div>    			
        			<div class="col-md-2 text-center">
        				<div class="badge-light badge-pill">
        					Hasta
        				</div>        				
        			</div>
        		</div> 	
        		<div class="form-row mt-2" v-if="esPeriodo == 'si' ">
        			<div class="col-md-3"></div>
        			<div class="col-md-2 text-center">
        				<div class="position-relative has-icon-left">
	        				<datepicker name="fecha_desde" v-model="fecha_desde" bootstrap-styling format="dd/MM/yyyy" 
                            placeholder="Fecha desde" required>
                            </datepicker>                                         
	                        <div class="valid-feedback">
	                          <i>¡Correcto!</i>
	                        </div>
	                        <div class="invalid-feedback">
	                          ¡Seleccione Fecha!
	                        </div>
	                        <div class="form-control-position">
	                            <i class='bx bx-calendar bx-sm'></i>
	                        </div>
	                    </div>
        			</div>
        			<div class="col-md-1"></div>    			
        			<div class="col-md-2 text-center">
        				<div class="position-relative has-icon-left">
	        				<datepicker name="fecha_hasta" v-model="fecha_hasta" bootstrap-styling format="dd/MM/yyyy" placeholder="Fecha hasta" required>
                            </datepicker>                                         
	                        <div class="valid-feedback">
	                          <i>¡Correcto!</i>
	                        </div>
	                        <div class="invalid-feedback">
	                          ¡Seleccione Fecha!
	                        </div>
	                        <div class="form-control-position">
	                            <i class='bx bx-calendar bx-sm'></i>
	                        </div>
	                    </div>		
        			</div>
        		</div> 		
                <div class="form-row mt-5" v-if="usuario">
                    <div class="col-md-3"></div>                         
                    <div class="col-md-5 text-center">
                        <button type="button" @click="generarReporte('generar')" name="generar" class="btn btn-primary btn-registrar">
                            <span class="align-middle ml-25">Generar reporte</span>
                        </button>
                    </div>                    
                </div>
        	</div>
            <div v-if="resultados > 0">
                <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">                                
                            <th width="30%">Código</th>
                            <th width="30%">Denominación</th>
                            <th width="20%">Fecha</th>
                            <th width="20%">Fecha</th>                             
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="tramite in tramites">  
                            <td>{{ tramite.codigo }}</td>      
                            <td>{{ tramite.denominacion }}</td>
                            <td>{{ tramite.fecha | formatoFecha }}</td>
                            <td>{{ tramite.fecha | formatoHora }}</td>                                                        
                        </tr>                            
                    </tbody>                  
                </table>
                <div class="form-row mt-5" v-if="usuario">
                    <div class="col-md-3"></div>                         
                    <div class="col-md-5 text-center">
                        <button type="button" @click="generarPdf()" name="imprimir" class="btn btn-primary btn-registrar">
                            <span class="align-middle ml-25">Imprimir reporte</span>
                        </button>
                    </div>                    
                </div>
            </div>
            <div v-else-if="!queryResult">
                <div class="col-md-11 mt-5 text-center bg-danger bg-light">
                    <b>
                        <h4><span > No hay resultados </span></h4>
                    </b>
                </div>
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

    //import datatable from 'datatables';
    import Datepicker from 'vuejs-datepicker';
    import moment from 'moment';

    export default {
        data() {
            return {
                //Vista de listado de contribuyente de actividad económica
                vista: 'listado',
                titulo: 'Reporte de Pagos realizados por usuario',
                usuario: 'todos',
                usuarios: [],
                boton: 'listado',                                
                tramites: [], 
                resultados: 0,

                radio_periodo: "",
                esPeriodo: 'no',
                fecha_desde: '',
                fecha_hasta: '',
                user_id: 'todos',
                userPerm: '',
                queryResult: true,
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
       //     datatable
            Datepicker,
            moment        
        },        

        filters: {
            formatoFecha: function(value) {
                if (value) {
                    return moment(String(value)).format('DD-MM-YYYY')
                }
            },

            formatoHora: function(value) {
                if (value) {
                    return moment(String(value)).format('HH:ss')
                }
            },
        },
        

        methods: {
            cambiarVista( opcion ) {                
                this.vista = opcion;                         
            },

////////////////////////* Registro de contribuyente de actividad económica *////////////////////////////////////////

            listarUsuarios(){
                let me = this;

                var url = '/user';

                axios.get(url).then(function (response) {
                // handle success                      
                console.log("Usuaurios : ", response );
                var respuesta = response.data;
                me.usuarios = respuesta.users.data; 
                me.rol = respuesta.rol.rol;
                me.userPerm = respuesta.usuario;  
                if( me.rol == 'agente') {
                    me.user_id = respuesta.usuario.id;
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

            asignaUsuario( e ) {                    
                this.user_id = e.target.value;
            },

            generarPdf() {
                let me = this;

                if(me.esPeriodo == "no") {
                    me.fecha_desde = "";
                    me.fecha_hasta = "";
                }

                window.open('http://127.0.0.1:8000/reporteTramites?user_id=' + me.user_id + '&fecha_desde=' + me.fecha_desde + '&fecha_hasta=' + me.fecha_hasta+ '&accion=imprimir','_blank');
            },

            generarReporte( accion ) {
                let me = this;
                    
                if(me.esPeriodo == "no") {
                    me.fecha_desde = "";
                    me.fecha_hasta = "";
                }
        
                var url = '/reporteTramites?user_id=' + me.user_id + '&fecha_desde=' + me.fecha_desde + '&fecha_hasta=' + me.fecha_hasta+ '&accion=generar';

                console.log("Usuario id : ", me.user_id); 

                    axios.get(url).then(function (response) {
                    // handle success              
                    console.log("Response : ", response );
                    var respuesta = response.data;                    
                    me.resultados = respuesta.length; 
                    if(me.resultados == 0) {
                        me.queryResult = false;
                    }                   
                    me.tramites = respuesta;                    
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
                this.boton = 'registro';
                this.usuario = "";
                this.usuarios = [];              
            },
        },

        mounted() {
        	this.listarUsuarios();
            console.clear();            
        }
    }
</script>