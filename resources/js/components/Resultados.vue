<template>
	<div class="shadow-container">
		<div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Reporte de Resultados</h4>
            </div>     
        </div>

        <template>
        	<div class="p-5 bg-white rounded">
        	<div class="card-body mt-4">
        		<div class="form-row">        			
        			<div class="col-md-2 text-center">
        				<b>Alumnos	</b>
        			</div>
        			<div class="col-md-3 text-center">
        				<div class="position-relative has-icon-left" >
	        				<select class="form-control" v-model="alumno" value="alumno">
                               <option value="">Seleccione..</option>
	                           <option v-for="alumno in alumnos" :key="alumno.id" :value="alumno.id" v-text="alumno.nombre"></option>
	                        </select>	                        
	                        <div class="form-control-position">
	                            <i class='bx bx-user bx-sm'></i>
	                        </div>
	                    </div>
        			</div>        		
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-center">
                        <b>Ejercicio </b>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="position-relative has-icon-left" >
                            <select class="form-control" v-model="ejercicio" value="ejercicio">
                               <option value="">Seleccione..</option>
                               <option value="1">Suma</option>
                               <option value="2">Resta</option>
                               <option value="3">Multiplicación</option>
                               <option value="4">Comparación</option>
                               <option value="5">Series Numéricas</option>
                            </select>                           
                            <div class="form-control-position">
                                <i class='bx bx-list-ol bx-sm'></i>
                            </div>
                        </div>
                    </div>                              
                </div>        		        		
                <div class="form-row mt-5">
                    <div class="col-md-3"></div>                         
                    <div class="col-md-5 text-center">
                        <button type="button" @click="generarReporte('generar')" name="generar" class="btn btn-primary btn-registrar">
                            <span class="align-middle ml-25">Generar reporte</span>
                        </button>
                    </div>                    
                </div>
        	</div>
            <div v-if="resultados > 0 && ejercicio != 5">
                <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center bg-success">                                
                            <th width="20%">Valor 1</th>
                            <th width="10%"></th>
                            <th width="20%">Valor 2</th>
                            <th width="10%" v-if="ejercicio != 4"></th>
                            <th width="20%" v-if="ejercicio != 4">resultado</th> 
                            <th width="20%" v-if="ejercicio == 3">Respuesta correcta</th>
                            <th width="20%" v-else>intentos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="suma in sumas">  
                            <td>{{ suma.valor1}}</td>    
                            
                            <td v-if="ejercicio == 1">+</td>    
                            <td v-if="ejercicio == 2">-</td>    
                            <td v-if="ejercicio == 3">X</td>

                            <td v-if="ejercicio == 4 && suma.resultado == 1">></td>
                            <td v-if="ejercicio == 4 && suma.resultado == 2">=</td>
                            <td v-if="ejercicio == 4 && suma.resultado == 3"><</td>

                            <td>{{ suma.valor2 }}</td>
                            <td v-if="ejercicio != 4">=</td>    
                            <td v-if="ejercicio != 4">{{ suma.resultado }}</td>
                            <td v-if="ejercicio == 3">{{ suma.valor1 * suma.valor2 }}</td>
                            <td v-else>{{ suma.intentos }}</td>
                        </tr>                            
                    </tbody>                  
                </table>                
            </div>
            <div v-else-if="resultados > 0 && ejercicio == 5">
                <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center bg-success">                                
                            <th width="15%">Valor 1</th>
                            <th width="15%">Valor 2</th>
                            <th width="15%">Valor 3</th>
                            <th width="15%">Valor 4</th>
                            <th width="15%">Valor 5</th>                             
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="suma in sumas">  
                            <td>{{ suma.valor1 }}</td>
                            <td v-if="suma.valor2 == suma.resultado1" style="color: blue;">{{ suma.resultado1 }}</td>
                            <td v-if="suma.valor2 != suma.resultado1" style="color: red;">{{ suma.resultado1 }}</td>
                            <td>{{ suma.valor3 }}</td>
                            <td v-if="suma.valor4 == suma.resultado2" style="color: blue;">{{ suma.resultado1 }}</td>
                            <td v-if="suma.valor4 != suma.resultado2" style="color: red;">{{ suma.resultado1 }}</td>
                            <td>{{ suma.valor5 }}</td>
                        </tr>                            
                    </tbody>                  
                </table>                
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
                alumnos: [],  
                alumno: "",    
                ejercicio: "",         
                resultados: 0,  
                queryResult: false,

                mostrarSuma: false,
                sumas: []
            }            
        },

        methods: {
            cambiarVista( opcion ) {                
                this.vista = opcion;                         
            },

////////////////////////* Registro de contribuyente de actividad económica *////////////////////////////////////////

            listarAlumnos(){
                let me = this;

                var url = '/alumno';

                axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;
                me.alumnos = respuesta.data;
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            generarReporte() {
                console.log("id de alumno : ", this.alumno);
                console.log("id de ejercicio : ", this.ejercicio);

                let me = this;                
                var url = "reporte/"+this.alumno+"/"+this.ejercicio;

                axios.get(url).then(function (response) {
                    // handle success                   
                    var respuesta = response.data;                    
                    me.sumas = respuesta;
                    me.resultados = respuesta.length;                    
                    
                    me.mostrarSuma= true;
                    me.queryResult= true;                             
                    
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
        	this.listarAlumnos();
            console.clear();            
        }
    }
</script>