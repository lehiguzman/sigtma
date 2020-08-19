<template>
	<div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Multiplicaciones</h4>
            </div>     
        </div>
	    <template v-if="mostrar=='ejercicios' ">
	    	<div class="col-md-12 mb-0 text-center bg-light">
                <h2><b>Ejercicios de Matemáticas</b></h2>
            </div>
            <div class="col-md-12 mt-4 text-center bg-light">
                <h2><b>Multiplicaciones</b></h2>
            </div>                       
            <div class="form-row">
                <div class="col-md-1"></div>
                <div class="col-md-2 text-center">
                    Usuarios        
                </div>
                <div class="col-md-3 text-center">
                    <div class="position-relative has-icon-left" >
                        <select class="form-control" v-model="id" value="id" required>
                           <option value="0">Seleccionar Alumno</option>
                           <option v-for="alumno in alumnos" :key="alumno.id" :value="alumno.id" v-text="alumno.nombre"></option>
                        </select>                        
                        <div class="form-control-position">
                            <i class='bx bx-user bx-sm'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2"></div>
                <div class="col-md-8 mt-4 mb-1 text-left bg-light">
                    <h4><i>* Arrastre la opción correcta a la casilla correspondiente</i></h4>
                </div>
            </div>
            <div class="card-body mt-1">
                <form>
                	<div class="form-row" v-for="ejercicio in ejercicios" style="height: 100px;">
                		<div class="col-md-2"></div>
					      <div class="mb-5 col-md-2" v-on:drop="drop" v-on:dragover="allowDrop">
					        <p v-on:dragstart="dragStart" v-on:drag="dragging" draggable="true" :id="ejercicio.tag" class="respuesta">
					          {{ ejercicio.valor1 }} X {{ ejercicio.valor2 }}
					        </p>
					      </div>					    
					    <div class="col-md-2"></div>	
					    <div class="opcion col-md-2" v-on:drop="drop" v-on:dragover="allowDrop" :id="ejercicio.tag"></div>
					    <div class="col-md-1">
					    	<p class="referencia">
					    		{{ ejercicio.respuesta }}
					    	</p>
					    </div>
					</div>					

				    <div class="form-row mt-5">
		                <div class="col-md-2"></div>                            

		                <div class="col-md-8 d-flex justify-content-center">
		                    <i class='bx bx-cancel bx-sm' ></i>
		                    <input type="button" name="enviar" @click="corregir()" class="btn btn-success" value="enviar">
		                </div>

		                <div class="col-md-2"></div>
		            </div>
	           </form>
	        </div>
	   </template>
       <template v-if="mostrar=='resultados' ">
            <div class="col-md-12 mb-0 text-center bg-light">
                <h2><b>Ejercicios de Matemáticas</b></h2>
            </div>
            <div class="col-md-12 mt-4 text-center bg-light">
                <h2><b>Multiplicaciones</b></h2>
            </div>
            <div class="col-md-12 mt-4 text-center bg-light">
                <h4><i>Resultados</i></h4>
            </div>
            <div class="form-row">
                <div class="col-md-1"></div>
                <div class="col-md-2 text-center" style="font-size: 26px; text-align:center;">
                    <b>Alumno : </b>
                </div>
                <div class="col-md-3 text-center">
                    <div class="position-relative has-icon-left" style="font-size: 26px; text-align:center;" >                        
                        <b>{{ nombre }}</b>                                             
                    </div>
                </div>
            </div>
            <div class="card-body mt-5">
                    <div class="form-row">
                        <div class="col-md-1"></div>                       

                        <div class="col-md-2"  style="font-size: 16px; text-align:center;" ></div>

                        <div class="col-md-1 text-center" style="font-size: 16px; text-align:center;" >
                            <b>Multiplo 1</b>
                        </div>

                        <div class="col-sm-1 text-center">
                            <b style="font-size: 16px;"></b>
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 16px; text-align:center;" >
                            <b><b>Multiplo 2</b></b>
                        </div>

                        <div class="col-sm-1 text-center">
                            <b style="font-size: 16px;"></b>
                        </div>

                        <div class="col-md-1" style="font-size: 16px; text-align:center;" >
                            <b><b>Respuesta</b></b>
                        </div>

                        <div class="col-md-3" style="font-size: 16px; text-align:center;" >
                            <b><b>Resultado correcto</b></b>
                        </div>

                    </div>
                <form v-for="resultado in respuestas">
                    
                    <div class="form-row">
                        <div class="col-md-1"></div>                       

                        <div class="col-md-2"  style="font-size: 26px; text-align:center;" >{{ resultado.index }}.- </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center;" >
                            <b>{{ resultado.valor1 }}</b>
                        </div>

                        <div class="col-sm-1 text-center">
                            <b style="font-size: 26px;">X</b>
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center;" >
                            <b><b>{{ resultado.valor2 }}</b></b>
                        </div>

                        <div class="col-sm-1 text-center">
                            <b style="font-size: 26px;">=</b>
                        </div>

                        <div class="col-md-1" style="font-size: 26px; text-align:center;" >
                            <b><b>{{ resultado.respuesta }}</b></b>
                        </div>

                        <div class="col-md-3" style="font-size: 26px; text-align:center;" >
                            <b><b>{{ resultado.result }}</b></b>
                        </div>

                    </div>
                </form>
            </div>
        </template>
    </div>
</template>

<style scoped>
    /* Se importan los estilos del modulo */
    @import "../../../public/css/usuario.css";

    .opcion {    	  
	  width: 150px; 
	  height: 40px;	  
	  border: 3px solid #aaaaaa;
	  text-align: center;
	}

	.respuesta {
		width: 200px; 
	  	height: 40px;	  
	  	background-color: #EEF0F1;	 
	  	text-align: center;
	  	font-size: 24px;
	  	font-weight: 800; 	
	}

	.referencia {
		text-align: center;
	  	font-size: 24px;
	  	font-weight: 800; 	
	}
</style>  

<script type="text/javascript">

    export default { 

        data() {
            return {              	
            	respuestas: [],
            	ejercicios: [],
            	respuestasEjercicios: [],
                mostrar: "ejercicios",
                id: 0,
                nombre: null,
                alumnos: [],
            }            
        },      
        methods: {

            listarAlumnos() {
                let me = this;

                var url = '/alumno';

                axios.get(url).then(function (response) {
                    // handle success                      
                    var respuesta = response.data;                                    

                    console.log("REspuesta : ", respuesta);
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

        	inicializarEjercicio() {
        		for (var i = 0; i <= 3; i++) {        			
        			var valor1 = Math.floor(Math.random() * 10);
        			var valor2 = Math.floor(Math.random() * 10);     
        			var pregunta = valor1 * valor2;       
        			var tag = "valor"+i; 		

        			if( valor1 == 0 && valor2 == 0 ) {
        				//console.log("Error de 0 ");
        				i--;
        			} else {
        				var ejercicio = {
        				valor1: valor1,
        				valor2: valor2, 
        				pregunta: pregunta,
        				respuesta: null,
        				tag: tag 				
	        			}
	        			var resp = valor1 * valor2;
	        			var respuestas = {
	        				respuesta: resp,
	        			}

	        			this.respuestasEjercicios.push( respuestas );                        
	        			this.ejercicios.push( ejercicio );	
        			}        			
        		}

        		//console.log("Respuestas : ", this.respuestasEjercicios);

        		for (var i = 0; i < this.ejercicios.length; i++) {
        			//console.log("Respuesta : ", this.respuestasEjercicios[i].respuesta);
        			var res = Math.floor(Math.random() * this.ejercicios.length);
        			if( this.ejercicios[res].respuesta == null) {
        				//console.log("Indice : ", res);	
        				this.ejercicios[res].respuesta = this.respuestasEjercicios[i].respuesta;
        			} else {
        				//console.log("Indice Repetido : ", res);	
        				i--;
        			}  
        		}
        		//console.log("Ejercicios : ", this.ejercicios);
        	},

        	dragStart:function(event)  {
    			console.log("Evento : ", event.target.id);    			
        		event.dataTransfer.setData("Text", event.target.id);
          	},
          	dragging:function(event) {
            	//document.getElementById("demo").innerHTML = "The p element is being dragged"; 
          	},
         	allowDrop:function(event) {
            	event.preventDefault();
          	},
          	drop:function(event) {	      

                var valor1 = null;
                var valor2 = null;
                var respuesta = null;
            	event.preventDefault();	            
            	var data = event.dataTransfer.getData("Text");	            
				//console.log("ID de tag : ", data);            	
				//console.log("Target id : ", event.target.id);
            	event.target.appendChild(document.getElementById(data));

            	//console.log("ID : ", data);
            	

            	/*var resp = {
            		pregunta: data,
            		respuesta: event.target.id
            	}*/       

                this.ejercicios.forEach( element => {
                    if( element.tag == data ) {
                        //console.log( "Valor 1 : ", element.valor1 );
                        valor1 = element.valor1;                         
                        //console.log( "Valor 2 : ", element.valor2 );
                        valor2 = element.valor2;
                    }

                    if( element.tag == event.target.id ) {
                        //console.log("Resultado : ", element.respuesta);
                        respuesta = element.respuesta;
                    }
                });  
                
                var respuesta = {
                id: this.id,
                valor1: valor1,
                valor2: valor2,
                respuesta: respuesta,
                }

                this.respuestas.push( respuesta );
          },

          corregir() {
            let me = this;
            var longitud = this.respuestas.length;
            const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                }) 

            console.log("longitud de array : ", longitud);
            var index = 0;

            if( this.id == 0 ) {
                alerta.fire(
                        'Error!',
                        'Debe seleccionar un alumno.',
                        'error'
                    );
                return false;
            }

            this.respuestas.forEach( element => {                
                axios.post('/multiplica/registrar', {                                                
                    'idregistro': me.id,
                    'valor1': element.valor1,
                    'valor2': element.valor2,
                    'resultado': element.respuesta,                        
                    }).then(function (response) {     
                        index++; 
                        if( longitud == index) {
                            alerta.fire(
                                'Grandioso!',
                                'Ejercicios finalizados.',
                                'success'
                            );
                        me.mostrarResultados();                        
                    }                        
                }).catch(function (error) {
                // handle error
                console.log(error);
                });
            });
          },

           mostrarResultados() {

                let me=this;                                 
                var url = '/alumno/select/'+me.id;
                var index = 0;

                this.respuestas.forEach( element => {
                    var res = element.valor1 * element.valor2;
                    index++;
                    element.result = res;
                    element.index = index;
                });

                axios.get(url).then(function (response) {
                   
                    console.log("Respuesta : ", response);

                    me.nombre = response.data.nombre;                   

                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .finally(function () {
                    // always executed
                  });

                this.mostrar = "resultados";
            },
	    },
            
        mounted() {  
        this.inicializarEjercicio();
        this.listarAlumnos();
            console.log("Modulo de multiplicaciones");            
        }
            
    }    
</script>