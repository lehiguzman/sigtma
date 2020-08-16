<template>
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Sumas</h4>
            </div>     
        </div>  

        <template v-if="mostrar=='ejercicios' "> 
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
                    Alumnos        
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

                        <div class="col-md-1 text-center" style="font-size: 40px; text-align:center;" >
                            <b>{{ valor1 }}</b>
                        </div>

                        <div class="col-sm-1 text-center">
                            <b style="font-size: 40px;">+</b>
                        </div>

                        <div class="col-md-1 text-center">
                            <input type="text" name="valor2" v-model="valor2" size="2" style="font-size: 30px; text-align:center;" maxlength="2" >
                        </div>

                        <div class="col-sm-1 text-center">
                            <b style="font-size: 40px;">=</b>
                        </div>

                        <div class="col-md-1" style="font-size: 40px; text-align:center;" >
                            <b>{{ resultado }}</b>
                        </div>

                    </div>
                    <div class="form-row mt-5">
                            <div class="col-md-2"></div>                            

                            <div class="col-md-8 d-flex justify-content-center">
                                <i class='bx bx-cancel bx-sm' ></i>
                                <input type="button" name="sumar" @click="sumar()" class="btn btn-success" value="sumar">
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
                <form v-for="resultado in resultadosMostrar">
                    <div class="form-row">
                        <div class="col-md-2"></div>                       

                        <div class="col-md-2"  style="font-size: 26px; text-align:center;" >{{ resultado.ejercicio }}.- </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center;" >
                            <b>{{ resultado.valor1 }}</b>
                        </div>

                        <div class="col-sm-1 text-center">
                            <b style="font-size: 26px;">+</b>
                        </div>

                        <div class="col-md-1 text-center" style="font-size: 26px; text-align:center;" >
                            <b><b>{{ resultado.valor2 }}</b></b>
                        </div>

                        <div class="col-sm-1 text-center">
                            <b style="font-size: 26px;">=</b>
                        </div>

                        <div class="col-md-1" style="font-size: 26px; text-align:center;" >
                            <b><b>{{ resultado.resultado }}</b></b>
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
                ejercicio: 0,
                id: 0,
                alumnos: [],
                intentos: 0,
                mostrar: "ejercicios",
                resultadosMostrar: [],
                nombre: null,
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

            sumar() {                
                var res = Number(this.valor1) + Number(this.valor2); 

                console.log("Resultado : ", res);

                const alerta2 = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                }) 

                if( this.id == 0 ) {
                    alerta2.fire(
                            'Error!',
                            'Debe seleccionar un alumno.',
                            'error'
                        );
                    return false;
                }

                if( res == this.resultado ) {
                    console.log("Bien!!!!");
                    this.ejercicio++;
                    this.registrarResultado();
                    this.inicializarEjercicio();
                    this.intentos = 0;
                } else {

                    console.log("Valor 2 ", this.valor2);

                    if( !this.valor2 ) {
                        alerta2.fire(
                            'Error!',
                            'Debe colocar un numero.',
                            'error'
                        );
                    return false;
                    } else {
                        alerta2.fire(
                            'Error!',
                            'El valor esta errado. Intenta de nuevo',
                            'error'
                        );
                    }
                    this.valor2 = null;
                    this.intentos++;
                }
            },

            registrarResultado() {

                console.log("Id de estudiante : ", this.id);
                console.log("Valor 1 : ", this.valor1);
                console.log("Valor 2 : ", this.valor2);
                console.log("Resultado : ", this.resultado);
                console.log("Número de intentos : ", this.intentos);

                var resultado = {
                    ejercicio: this.ejercicio,
                    valor1: this.valor1,
                    valor2: this.valor2,
                    resultado: this.resultado,                    
                }

                this.resultadosMostrar.push( resultado );

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })                

                let me=this;                
                
                axios.post('/suma/registrar', {                                                
                        'idregistro': me.id,
                        'valor1': me.valor1,
                        'valor2': me.valor2,
                        'resultado': me.resultado,
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

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                });

                console.log("Numero de intentos : ", this.ejercicio);               

                this.valor2 = null;
                this.valor1 = Math.floor(Math.random() * 100);
                if( this.valor1 == 0 ) {
                    this.inicializarEjercicio();
                }
                this.resultado = this.valor1 + Math.floor(Math.random() * 100);                
            },

            mostrarResultados() {

                let me=this;                                 
                var url = '/alumno/select/'+me.id;

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