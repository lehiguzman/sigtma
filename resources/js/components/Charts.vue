<template>	
	<div class="box-container row">
		<!--<div class="bg-white col-md-5 bg-shadow">  
			<div class="mt-5 text-center ml-2">
		        <VueApexCharts id="exa" width="350" height="200" type="bar" :options="options" :series="series"></VueApexCharts>    
		    </div>  	  
		</div>
		<div class="col-md-1">			
		</div>
		<div class="ml-2 bg-white col-md-5 bg-shadow">  
			<div class="mt-5 text-center ml-4">
	      		<VueApexCharts width="350" height="200" type="donut" :options="options2" :series="series2"></VueApexCharts>
	      	</div>		    
		</div>

		<div class="row bg-white mt-4 ml-2 col-11 bg-shadow">  			
			<div class="col-md-12">			
	        	<VueApexCharts width="800" height="200" type="line" :options="options" :series="series"></VueApexCharts>    
	    	</div> 
		</div>-->
		<div class="bg-white col-md-5 bg-shadow">  
			<div id="trimestres"></div>
		</div>
		<div class="bg-white col-md-5 bg-shadow ml-5">  
			<div id="tipoContribuyente"></div>
		</div>
		<div class="row col-md-1"></div>
		<div class="bg-white col-md-6 bg-shadow mt-4">  
			<div id="anual"></div>
		</div>
	</div>	

	
</template>

<style scoped>
    /* Se importan los estilos del modulo */
    @import "../../../public/css/chart.css";
</style>    

<script type="text/javascript">
	import ApexCharts from 'apexcharts'

    export default {
        data() { 
        	return {  
        		//Variables por 
        		//Trimestres       		
        		montoT1: 0,
        		montoT2: 0,
        		montoT3: 0,
        		montoT4: 0,
        		//Por tipo de contribuyente
        		montoInmueble: 0,
        		montoVehiculo: 0,
        		montoComercio: 0,

        		//Mensuales
        		montoM1: 0,
        		montoM2: 0,
        		montoM3: 0,
        		montoM4: 0,
        		montoM5: 0,
        		montoM6: 0,
        		montoM7: 0,
        		montoM8: 0,
        		montoM9: 0,
        		montoM10: 0,
        		montoM11: 0,
        		montoM12: 0,

        		array: [],
        	}        	
    	},

    	components: {
       //     datatable
          ApexCharts            
        },

        computed: {
    		series() {
        		return this.array;
    		}
		},

        methods: {
        	totalPorTrimestre() {        		
        		var url = '/pagados';   
        		let me = this; 

        		var montoTrimestre1 = 0;
        		var montoTrimestre2 = 0;
        		var montoTrimestre3 = 0;
        		var montoTrimestre4 = 0;

        		axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;                                    
                //console.log("Respuesta : ", respuesta.data);
                for (var i = 0; i < respuesta.data.length; i++) {                	
                	//Primer Trimestre
                	if(respuesta.data[i].fecha_pago >= '2020-01-01' && respuesta.data[i].fecha_pago < '2020-04-01') { 
                		montoTrimestre1 = montoTrimestre1 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-04-01' && respuesta.data[i].fecha_pago < '2020-07-01') { 
                		montoTrimestre2 = montoTrimestre2 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-07-01' && respuesta.data[i].fecha_pago < '2020-10-01') { 
                		montoTrimestre3 = montoTrimestre3 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-10-01' && respuesta.data[i].fecha_pago <= '2020-12-31') { 
                		montoTrimestre4 = montoTrimestre4 + respuesta.data[i].monto;	
                	}                	
                }
                
                me.montoT1 = montoTrimestre1.toFixed();
                me.montoT2 = montoTrimestre2.toFixed();
                me.montoT3 = montoTrimestre3.toFixed();
                me.montoT4 = montoTrimestre4.toFixed();
                me.graficoBarra();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });        		
			},

			graficoBarra() {
				
				var arrayData = [this.montoT1, this.montoT2, this.montoT3, this.montoT4];

				var options = {
					chart: {
							type: 'bar',
							width: '350',							
							height: '200',
						},
						series: [{
							name: 'recaudado (Bs.)',
							data: arrayData
						}],
						xaxis: {
							categories: ["ENE-MAR","ABR-JUN","JUL-SEP","OCT-DEC"]
						},
						plotOptions: {
							bar: {
								dataLabels: {
							    position: 'top'
							}
						}
					},
					dataLabels: {
						enabled: true,
						style: {
							colors: ['#333']
						},
						offsetY: -20
					},
					title: {
				    text: "Recaudación trimestral",
				    align: 'left',
				    margin: 10,
				    offsetX: 0,
				    offsetY: 0,
				    floating: false,
					    style: {
					      fontSize:  '14px',
					      fontWeight:  'bold',
					      fontFamily:  'arial',
					      color:  '#263238'
					    },
					}
				}

				var chart = new ApexCharts(document.querySelector("#trimestres"), options);

				chart.render();
			},

			totalPorTipoContribuyente() {
				var url = '/total_contribuyente';   
        		let me = this;    		

        		axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;                                    
                //console.log("Respuesta Inmueble: ", respuesta.pagadosInmueble.data);
                //console.log("Respuesta Vehiculo: ", respuesta.pagadosVehiculo.data);
                //console.log("Respuesta Comercio: ", respuesta.pagadosComercio.data);
                var cantidadPagosInm = respuesta.pagadosInmueble.data.length;
                var cantidadPagosVeh = respuesta.pagadosVehiculo.data.length;
                var cantidadPagosCom = respuesta.pagadosComercio.data.length;

                for (var i = 0; i < cantidadPagosInm; i++) {
                	//console.log("Pago inmueble : ", respuesta.pagadosInmueble.data[i].monto);
                	me.montoInmueble = me.montoInmueble + respuesta.pagadosInmueble.data[i].monto;
                }
                for (var i = 0; i < cantidadPagosVeh; i++) {
                	//console.log("Pago vehiculo : ", respuesta.pagadosVehiculo.data[i].monto);
                	me.montoVehiculo = me.montoVehiculo + respuesta.pagadosVehiculo.data[i].monto;
                }
                for (var i = 0; i < cantidadPagosCom; i++) {
                	//console.log("Pago Comercio : ", respuesta.pagadosComercio.data[i].monto);
                	me.montoComercio = me.montoComercio + respuesta.pagadosComercio.data[i].monto;
                }
               // console.log("Monto trimestral : ", me.montoTrimestre );
               // me.monto = me.montoTrimestre.toFixed();
                me.graficoTorta();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });        	
			},

			graficoTorta() {

				var arrayData = [this.montoComercio, this.montoInmueble, this.montoVehiculo];

				var options = {
					chart: {
							type: 'donut',
							width: '350',							
							height: '200',
						},						
  					series: arrayData, //[44, 55, 13],
  					/*series: [{
							name: 'recaudado (Bs.)',
							data: [100,200,200,400]
						}],*/
  					labels: ['Actividad Comercial', 'Inmueble', 'Vehiculo'],  					
  					title: {
				    text: "Recaudación por Tipo",
				    align: 'left',
				    margin: 10,
				    offsetX: 0,
				    offsetY: 0,
				    floating: false,
					    style: {
					      fontSize:  '14px',
					      fontWeight:  'bold',
					      fontFamily:  'arial',
					      color:  '#263238'
					    },
					}
				};				
					var chart = new ApexCharts(document.querySelector("#tipoContribuyente"), options);

					chart.render();
			},

			totalPorMes() {
				var url = '/pagados';   
        		let me = this;  

        		var montoMensual1 = 0;  		
        		var montoMensual2 = 0; 
        		var montoMensual3 = 0; 
        		var montoMensual4 = 0; 
        		var montoMensual5 = 0; 
        		var montoMensual6 = 0; 
        		var montoMensual7 = 0; 
        		var montoMensual8 = 0; 
        		var montoMensual9 = 0; 
        		var montoMensual10 = 0; 
        		var montoMensual11 = 0; 
        		var montoMensual12 = 0; 

        		axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;                                                    
                for (var i = 0; i < respuesta.data.length; i++) {
                	//console.log(respuesta.data[i].monto);
                	//Primer Trimestre
                	if(respuesta.data[i].fecha_pago >= '2020-01-01' && respuesta.data[i].fecha_pago < '2020-02-01') { 
                		montoMensual1 = montoMensual1 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-02-01' && respuesta.data[i].fecha_pago < '2020-03-01') { 
                		montoMensual2 = montoMensual2 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-03-01' && respuesta.data[i].fecha_pago < '2020-04-01') { 
                		montoMensual3 = montoMensual3 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-04-01' && respuesta.data[i].fecha_pago <= '2020-05-01') { 
                		montoMensual4 = montoMensual4 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-05-01' && respuesta.data[i].fecha_pago < '2020-06-01') { 
                		montoMensual5 = montoMensual5 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-06-01' && respuesta.data[i].fecha_pago < '2020-07-01') { 
                		montoMensual6 = montoMensual6 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-07-01' && respuesta.data[i].fecha_pago < '2020-08-01') { 
                		montoMensual7 = montoMensual7 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-08-01' && respuesta.data[i].fecha_pago <= '2020-09-31') { 
                		montoMensual8 = montoMensual8 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-09-01' && respuesta.data[i].fecha_pago < '2020-10-01') { 
                		montoMensual9 = montoMensual9 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-10-01' && respuesta.data[i].fecha_pago < '2020-11-01') { 
                		montoMensual10 = montoMensual10 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-11-01' && respuesta.data[i].fecha_pago < '2020-12-01') { 
                		montoMensual11 = montoMensual11 + respuesta.data[i].monto;	
                	}

                	if(respuesta.data[i].fecha_pago >= '2020-12-01' && respuesta.data[i].fecha_pago <= '2020-12-31') { 
                		montoMensual12 = montoMensual12 + respuesta.data[i].monto;	
                	}                	
                }
                
                me.montoM1 = montoMensual1.toFixed();
                me.montoM2 = montoMensual2.toFixed();
                me.montoM3 = montoMensual3.toFixed();
                me.montoM4 = montoMensual4.toFixed();
                me.montoM5 = montoMensual5.toFixed();
                me.montoM6 = montoMensual6.toFixed();
                me.montoM7 = montoMensual7.toFixed();
                me.montoM8 = montoMensual8.toFixed();
                me.montoM9 = montoMensual9.toFixed();
                me.montoM10 = montoMensual10.toFixed();
                me.montoM11 = montoMensual11.toFixed();
                me.montoM12 = montoMensual12.toFixed();
                me.graficoLineal();

              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });        			

			},

			graficoLineal() {

				var arrayData = [ this.montoM1, this.montoM2, this.montoM3, this.montoM4, this.montoM5, this.montoM6, this.montoM7, this.montoM8, this.montoM9, this.montoM10, this.montoM11, this.montoM12 ]

				var options = {
					chart: {
							type: 'line',
							width: '750',
							height: '200',
						},						
  					stroke: {
					  curve: 'smooth',					  
					},
					series: [{
							name: 'recaudado (Bs.)',
							data: arrayData,
						}],
					xaxis: {
							categories: ["Enero","Febrero","Marzo",
										"Abril","Mayo","Junio",
										"Julio","Agosto","Septiembre",
										"Octubre","Noviembre","Diciembre"]
						},
					title: {
				    text: "Recaudación Anual",
				    align: 'left',
				    margin: 10,
				    offsetX: 0,
				    offsetY: 0,
				    floating: false,
					    style: {
					      fontSize:  '14px',
					      fontWeight:  'bold',
					      fontFamily:  'arial',
					      color:  '#263238'
					    },
					}

  					
				};				
					var chart = new ApexCharts(document.querySelector("#anual"), options);

					chart.render();
				},
			},

    	mounted() {        	
            console.clear();                      
            this.totalPorTrimestre();
            this.totalPorTipoContribuyente();
            this.totalPorMes();
            //console.log("data");
        }
	}
</script>