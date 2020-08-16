<template>
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Sumas</h4>
            </div>     
        </div>  

        <template v-if="mostrar=='ejercicios'"> 
            <div class="col-md-12 mb-0 text-center bg-light">
                <h2><b>Ejercicios de Matemáticas</b></h2>
            </div>
            <div class="col-md-12 mt-4 text-center bg-light">
                <h2><b>Sumas básicas</b></h2>
            </div>
            <div class="col-md-12 mt-4 text-center bg-light">
                <h4><i>{{ ejercicio }} de 20</i></h4>
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
            <div class="card-body mt-5">
                <form>
                    <div class="form-row">
                        <div class="col-md-4"></div>
                                                     
                        <!--<div class="col-md-1 text-center">
                            <input type="text" name="valor1" size="2" style="font-size: 30px; text-align:center;" maxlength="2">
                        </div>-->

                        <div class="col-md-1 text-center" style="font-size: 40px;" >
                            <b>{{ valor1 }}</b>
                        </div>

                        <div class="col-md-2 text-center">
                            <div>
                                <button type="button" class="btn btn-success round mt-1" v-if="correcto1">
                                    <h4 class="mt-1"> <i class="bx bx-check bx-sm"></i> </h4>
                                </button>    
                                <button type="button" class="btn btn-success round mt-1" v-if="!error1 && !correcto1" @click="comparar( '1' )">
                                    <h4 class="mt-1"> > </h4>
                                </button>    
                                <button type="button" class="btn btn-danger round mt-1" v-if="error1"><h4 class="mt-1"> X </h4></button>    
                                
                                <button type="button" class="btn btn-success round mt-1" v-if="correcto2">
                                    <h4 class="mt-1"> <i class="bx bx-check bx-sm"></i> </h4>
                                </button> 
                                <button type="button" class="btn btn-success round mt-1" v-if="!error2 && !correcto2" @click="comparar( '2' )">
                                    <h4 class="mt-1"> = </h4>
                                </button>
                                <button type="button" class="btn btn-danger round mt-1" v-if="error2"><h4 class="mt-1"> X </h4></button>  

                                <button type="button" class="btn btn-success round mt-1" v-if="correcto3">
                                    <h4 class="mt-1"> <i class="bx bx-check bx-sm"></i> </h4>
                                </button> 
                                <button type="button" class="btn btn-success round mt-1" v-if="!error3 && !correcto3" @click="comparar( '3' )">
                                    <h4 class="mt-1"> < </h4>
                                </button>
                                <button type="button" class="btn btn-danger round mt-1" v-if="error3"><h4 class="mt-1"> X </h4></button>  
                            </div>                                                       
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 40px; text-align:center;" >
                            <b>{{ valor2 }}</b>
                        </div>
                    </div>
                    <div class="form-row mt-5">
                        <div class="col-md-2"></div>                            

                        <div class="col-md-8 d-flex justify-content-center">
                            <i class='bx bx-cancel bx-sm' ></i>
                            <input type="button" name="siguiente" @click="validarSeleccion()" class="btn btn-success" value="siguiente">
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
                <h2><b>Sumas básicas</b></h2>
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
                            <b>Valor 1</b>
                        </div>

                        <div class="col-sm-3 text-center">
                            <b style="font-size: 16px;">Comparador</b>
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 16px; text-align:center;" >
                            <b><b>Valor 2</b></b>
                        </div>

                        <div class="col-md-3" style="font-size: 16px; text-align:center;" >
                            <b><b>Intentos</b></b>
                        </div>

                    </div>
                <form v-for="resultado in resultadosMostrar">
                    <div class="form-row">
                        <div class="col-md-1"></div>                       

                        <div class="col-md-2"  style="font-size: 26px; text-align:center;" >{{ resultado.ejercicio }}.- </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center;" >
                            <b>{{ resultado.valor1 }}</b>
                        </div>

                        <div class="col-sm-3 text-center">
                            <b style="font-size: 26px;" v-if="resultado.resultado == 1">></b>
                            <b style="font-size: 26px;" v-if="resultado.resultado == 2">=</b>
                            <b style="font-size: 26px;" v-if="resultado.resultado == 3"><</b>
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center;" >
                            <b><b>{{ resultado.valor2 }}</b></b>
                        </div>

                        <div class="col-md-3 text-center" style="font-size: 26px; text-align:center;" >
                            <b><b>{{ resultado.intentos }}</b></b>
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

</style>  

<script type="text/javascript">

    export default { 

        data() {
            return {
                valor1: null,
                valor2: null,
                resultado: null,
                ejercicio: 1,
                id: 0,
                alumnos: [],
                mostrar: "ejercicios",
                resultadosMostrar: [],
                intentos: 0,

                error1: false,
                error2: false,
                error3: false,

                correcto1: false,
                correcto2: false,
                correcto3: false,

                valorCorrecto: 0,
                comparacion: null,
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

            comparar( valor ) {                
                console.log("Valor : ", valor);   

                this.intentos++;

                if( valor == 1 && this.comparacion != 'mayor' ) {
                    this.error1 = true;
                } else if( valor == 1 && this.comparacion == 'mayor' ) { 
                    this.correcto1 = true;
                    this.valorCorrecto = valor;                    
                }

                if( valor == 2 && this.comparacion != 'igual' ) {
                    this.error2 = true;
                } else if( valor == 2 && this.comparacion == 'igual' ) { 
                    this.correcto2 = true;
                    this.valorCorrecto = valor;                    
                }

                if( valor == 3 && this.comparacion != 'menor' ) {
                    this.error3 = true;
                } else if( valor == 3 && this.comparacion == 'menor' ) { 
                    this.correcto3 = true;
                    this.valorCorrecto = valor;                    
                }
            },

            validarSeleccion() {
                if( this.correcto1 || this.correcto2 || this.correcto3 ) {
                    this.guardarRegistro();
                    this.inicializarEjercicio();
                } else {
                    return false;
                }
            },

            guardarRegistro() {

                console.log("Valor Correcto : ", this.valorCorrecto);

                var resultado = {
                    ejercicio: this.ejercicio,
                    valor1: this.valor1,
                    valor2: this.valor2,
                    resultado: this.valorCorrecto,
                    intentos: this.intentos,
                }

                console.log("Resultado : ", resultado);

                this.resultadosMostrar.push( resultado );

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })                

                let me=this;                
                
                axios.post('/comparacion/registrar', {                                                
                        'idregistro': me.id,
                        'valor1': me.valor1,
                        'valor2': me.valor2,
                        'resultado': me.valorCorrecto,
                        'intentos': me.intentos,
                    }).then(function (response) {                        
                        if( me.ejercicio == 2 ) {
                            alerta.fire(
                                    'Grandioso!',
                                    'Ejercicios finalizados.',
                                    'success'
                            );                            
                            me.mostrarResultados();
                        } else {
                            me.ejercicio++;
                            me.intentos = 0;
                            alerta.fire(
                            'Correcto!',
                            'Pasa al siguiente ejercicio!.',
                            'success'
                            );
                            this.inicializarEjercicio();
                        }                        
                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },

            inicializarEjercicio() {
                this.valor1 = Math.floor(Math.random() * 100);
                this.valor2 = Math.floor(Math.random() * 100);
                if( this.valor1 < this.valor2 ) {
                    this.comparacion = 'menor';
                } else if( this.valor1 == this.valor2 ) { 
                    this.comparacion = 'igual';
                } else {
                    this.comparacion = 'mayor';
                }

                this.error1 = false;
                this.error2 = false;
                this.error3 = false;

                this.correcto1 = false;
                this.correcto2 = false;
                this.correcto3 = false;

                console.log("Valor 1 es ", this.comparacion, " que valor 2");
                //this.resultado = this.valor1 + Math.floor(Math.random() * 100);                
            },

            mostrarResultados() {

                let me=this;                                 
                var url = '/alumno/select/'+me.id;
                var index = 0;               

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
            console.log("component mounted");
            this.listarAlumnos();
            this.inicializarEjercicio();
        }
            
    }    
</script>