<template>
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Sumas</h4>
            </div>     
        </div>  

        <template v-if="mostrar=='ejercicios'"> 
            <div class="col-md-10 mb-0 text-center bg-light">
                <h2><b>Ejercicios de Matemáticas</b></h2>
            </div>
            <div class="col-md-10 mt-4 text-center bg-light">
                <h2><b>Series númericas</b></h2>
            </div>            
            <div class="form-row mt-5">
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
                        <div class="col-md-2"></div>                        
                        <div class="col-md-1 text-center" v-for="ejercicio in ejercicios" style="margin-left: 10px;">
                            <p v-if="ejercicio.tipo == 'texto'" style="font-size: 24px;">
                                {{ ejercicio.valor }}    
                            </p>
                            <input type="text" name="ejercicio.valor" v-model="ejercicio.res" size="4" v-if="ejercicio.tipo == 'input'" class="text-center" style="font-size: 24px;">
                        </div>
                        <div class="col-md-2" v-if="error1">
                            <p style="color: red;">
                                LLene los campos
                            </p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2"></div>                        
                        <div class="col-md-1 text-center" v-for="ejercicio in ejercicios2" style="margin-left: 10px;">
                            <p v-if="ejercicio.tipo == 'texto'" style="font-size: 24px;">
                                {{ ejercicio.valor }}    
                            </p>
                            <input type="text" name="ejercicio.valor"  v-model="ejercicio.res" size="4" v-if="ejercicio.tipo == 'input'" class="text-center" style="font-size: 24px;">
                        </div>
                        <div class="col-md-2">
                            <p style="color: red;" v-if="error2">
                                LLene los campos
                            </p>
                        </div>
                    </div>   
                    <div class="form-row">
                        <div class="col-md-2"></div>                        
                        <div class="col-md-1 text-center" v-for="ejercicio in ejercicios3" style="margin-left: 10px;">
                            <p v-if="ejercicio.tipo == 'texto'" style="font-size: 24px;">
                                {{ ejercicio.valor }}    
                            </p>
                            <input type="text" name="ejercicio.valor"  v-model="ejercicio.res" size="4" v-if="ejercicio.tipo == 'input'" class="text-center" style="font-size: 24px;">
                        </div>
                        <div class="col-md-2" >
                            <p style="color: red;" v-if="error3">
                                LLene los campos
                            </p>
                        </div>
                    </div>  
                    <div class="form-row">
                        <div class="col-md-2"></div>                        
                        <div class="col-md-1 text-center" v-for="ejercicio in ejercicios4" style="margin-left: 10px;">
                            <p v-if="ejercicio.tipo == 'texto'" style="font-size: 24px;">
                                {{ ejercicio.valor }}    
                            </p>
                            <input type="text" name="ejercicio.valor" v-model="ejercicio.res" size="4" v-if="ejercicio.tipo == 'input'" class="text-center" style="font-size: 24px;">
                        </div>
                        <div class="col-md-2">
                            <p style="color: red;" v-if="error4">
                                LLene los campos
                            </p>
                        </div>
                    </div>   
                    <div class="form-row">
                        <div class="col-md-2"></div>                        
                        <div class="col-md-1 text-center" v-for="ejercicio in ejercicios5" style="margin-left: 10px;">
                            <p v-if="ejercicio.tipo == 'texto'" style="font-size: 24px;">
                                {{ ejercicio.valor }}    
                            </p>
                            <input type="text" name="ejercicio.valor" v-model="ejercicio.res" size="4" v-if="ejercicio.tipo == 'input'" class="text-center" style="font-size: 24px;">
                        </div>
                        <div class="col-md-2">
                            <p style="color: red;" v-if="error5">
                                LLene los campos
                            </p>
                        </div>
                    </div>                     
                    <div class="form-row mt-5">
                        <div class="col-md-2"></div>                            

                        <div class="col-md-6 d-flex justify-content-center">
                            <i class='bx bx-cancel bx-sm' ></i>
                            <input type="button" name="siguiente" @click="corregir()" class="btn btn-success" value="enviar">
                        </div>

                        <div class="col-md-2"></div>
                    </div>
                </form>
            </div>
        </template>
        <template v-if="mostrar=='resultados'">
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
                <div class="form-row bg-light ">
                    <div class="col-md-1"></div>                       

                    <div class="col-md-1"  style="font-size: 16px; text-align:center;"></div>

                    <div class="col-md-5 text-center" style="font-size: 16px; text-align:center;" >
                        <b>Serie</b>
                    </div>                      

                    <div class="col-md-3" style="font-size: 16px; text-align:center;"></div>
                </div> <br>
                <form v-for="resultado in ejerciciosFinal">
                    
                    <div class="form-row">
                        <div class="col-md-1"></div>                       

                        <div class="col-md-1"  style="font-size: 26px; text-align:center;" ></div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center;" >
                            <b>{{ resultado.valor1 }}</b>
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center; color:red;" >
                            <b>{{ resultado.valor2 }}</b>
                        </div>
                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center; color:red;" >
                            <b>{{ resultado.valor2 }}</b>
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center;" >
                            <b>{{ resultado.valor3 }}</b>
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center; color:red;" >
                            <b>{{ resultado.valor4 }}</b>
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center;" >
                            <b>{{ resultado.valor5 }}</b>
                        </div>

                        <div class="col-md-3" style="font-size: 26px; text-align:center;" ></div>

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
                ejerciciosFinal: [],

                id: 0,
                error1: false,  
                error2: false,  
                error3: false,  
                error4: false,  
                error5: false,
                mostrar: "ejercicios",
                nombre: null,
                alumnos: [],
                ejercicios: [],
                ejercicios2: [],
                ejercicios3: [],
                ejercicios4: [],
                ejercicios5: [],
                resultadosMostrar: [],
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

            corregir() {                
                this.error1 = this.corrigeEjercicio( this.ejercicios, 0 );                
                //console.log("Error 1 : ", this.error1);
                this.error2 = this.corrigeEjercicio( this.ejercicios2, 1 );                
                //console.log("Error 2 : ", this.error2);
                this.error3 = this.corrigeEjercicio( this.ejercicios3, 2 );

                this.error4 = this.corrigeEjercicio( this.ejercicios4, 3 );                
                
                this.error5 = this.corrigeEjercicio( this.ejercicios5, 4 );   

                if( !this.error1 && !this.error2 && !this.error3 && !this.error4 && !this.error5 ) {
                    console.log("Valores de Arreglo de ejercicios : ", this.ejerciciosFinal);
                    this.guardarRegistro();
                }
            },

            corrigeEjercicio( ejercicios, pos ) {
                var index = 0;

                ejercicios.forEach( element => {                
                    if( element.res ) {          
                        index++;
                        if( index == 1 ) {
                            this.ejerciciosFinal[pos].resultado1 = element.res;    
                        } else if( index == 2 ) { 
                            this.ejerciciosFinal[pos].resultado2 = element.res;
                        }                        
                    }
                });                 

                if( index < 2 ) {                    
                    return true;
                } else {                     
                    return false;
                }
            },

            inicializarEjercicio() {
                let tipo = null;                
                var valoresUsados = [];
                for (var i = 0; i < 5; i++) {
                    var valor = Math.floor(Math.random() * 10);
                    if( valor == 0 ) { valor = 9; }

                    var encontrado = valoresUsados.find( element => element == valor );
                        
                    if( !encontrado ) {
                        valoresUsados[i] = valor;  
                    } else {
                        i--;
                    }                

                    //console.log("valores usados : ", valoresUsados);
                }

                var index = 0;
                for (var i = 0; i < 5; i++) {
                    if( i % 2 == 0 ) { tipo = 'texto'; } else { tipo = 'input'; }
                    var numero = i * valoresUsados[0];

                    let ejercicio = {
                        tipo: tipo,
                        valor: numero,
                        tag: 1,                   
                    }
                    this.ejercicios.push( ejercicio ); 

                    if( i == 0 ) { var valor1 = numero }
                    if( i == 1 ) { var valor2 = numero }
                    if( i == 2 ) { var valor3 = numero }
                    if( i == 3 ) { var valor4 = numero }
                    if( i == 4 ) { var valor5 = numero; 
                        var elemento = {
                            valor1: valor1,
                            valor2: valor2,
                            valor3: valor3,
                            valor4: valor4,
                            valor5: valor5,                            
                        }
                        this.ejerciciosFinal.push( elemento );
                        //console.log("Resultados : ", this.ejerciciosFinal);
                    }
                }              
                

                for (var i = 0; i < 5; i++) {
                    if( i % 2 == 0 ) { tipo = 'texto'; } else { tipo = 'input'; }
                    var numero = i * valoresUsados[1];                    
                    let ejercicio = {
                        tipo: tipo,
                        valor: numero,
                    }
                    this.ejercicios2.push( ejercicio );   

                    if( i == 0 ) { var valor1 = numero }
                    if( i == 1 ) { var valor2 = numero }
                    if( i == 2 ) { var valor3 = numero }
                    if( i == 3 ) { var valor4 = numero }
                    if( i == 4 ) { var valor5 = numero; 
                        var elemento = {
                            valor1: valor1,
                            valor2: valor2,
                            valor3: valor3,
                            valor4: valor4,
                            valor5: valor5,
                            ejercicio: 2
                        }
                        this.ejerciciosFinal.push( elemento );
                        //console.log("Resultados : ", this.ejerciciosFinal);
                    } 
                }

                for (var i = 0; i < 5; i++) {
                    if( i % 2 == 0 ) { tipo = 'texto'; } else { tipo = 'input'; }
                    var numero = i * valoresUsados[2];

                    let ejercicio = {
                        tipo: tipo,
                        valor: numero,
                    }
                    this.ejercicios3.push( ejercicio );    
                    if( i == 0 ) { var valor1 = numero }
                    if( i == 1 ) { var valor2 = numero }
                    if( i == 2 ) { var valor3 = numero }
                    if( i == 3 ) { var valor4 = numero }
                    if( i == 4 ) { var valor5 = numero; 
                        var elemento = {
                            valor1: valor1,
                            valor2: valor2,
                            valor3: valor3,
                            valor4: valor4,
                            valor5: valor5,
                            ejercicio: 3
                        }
                        this.ejerciciosFinal.push( elemento );
                        //console.log("Resultados : ", this.ejerciciosFinal);
                    }
                }

                for (var i = 0; i < 5; i++) {
                    if( i % 2 == 0 ) { tipo = 'texto'; } else { tipo = 'input'; }
                    var numero = i * valoresUsados[3];

                    let ejercicio = {
                        tipo: tipo,
                        valor: numero,
                    }
                    this.ejercicios4.push( ejercicio );    
                    if( i == 0 ) { var valor1 = numero }
                    if( i == 1 ) { var valor2 = numero }
                    if( i == 2 ) { var valor3 = numero }
                    if( i == 3 ) { var valor4 = numero }
                    if( i == 4 ) { var valor5 = numero; 
                        var elemento = {
                            valor1: valor1,
                            valor2: valor2,
                            valor3: valor3,
                            valor4: valor4,
                            valor5: valor5,
                            ejercicio: 4
                        }
                        this.ejerciciosFinal.push( elemento );
                        //console.log("Resultados : ", this.ejerciciosFinal);
                    }
                }

                for (var i = 0; i < 5; i++) {
                    if( i % 2 == 0 ) { tipo = 'texto'; } else { tipo = 'input'; }
                    var numero = i * valoresUsados[4];

                    let ejercicio = {
                        tipo: tipo,
                        valor: numero,
                    }
                    this.ejercicios5.push( ejercicio );
                    if( i == 0 ) { var valor1 = numero }
                    if( i == 1 ) { var valor2 = numero }
                    if( i == 2 ) { var valor3 = numero }
                    if( i == 3 ) { var valor4 = numero }
                    if( i == 4 ) { var valor5 = numero; 
                        var elemento = {
                            valor1: valor1,
                            valor2: valor2,
                            valor3: valor3,
                            valor4: valor4,
                            valor5: valor5,
                            ejercicio: 5
                        }
                        this.ejerciciosFinal.push( elemento );
                        //console.log("Resultados : ", this.ejerciciosFinal);
                    }    
                }
            },

            guardarRegistro() {

                let me=this;  
                let index = 0;     
                let lonArray = this.ejerciciosFinal.length;

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                });                 
                
                this.ejerciciosFinal.forEach( element => {
                    axios.post('/serie/registrar', {                                                
                        'idregistro': me.id,
                        'valor1': element.valor1,
                        'valor2': element.valor2,
                        'valor3': element.valor3,
                        'valor4': element.valor4,
                        'valor5': element.valor5,
                        'resultado1': element.resultado1,
                        'resultado2': element.resultado2,
                    }).then(function (response) {
                        index++;                   
                        if( lonArray == index ) {
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