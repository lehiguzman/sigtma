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
		<div class="bg-white col-md-10 bg-shadow mt-4">  
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
        		montoTrimestre: 0,
        		monto: 0,
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
        	graficoBarra() {
        		
        		var url = '/pagados';   
        		let me = this;    		

        		axios.get(url).then(function (response) {
                // handle success                                      
                var respuesta = response.data;                                    
                
                for (var i = 0; i < respuesta.data.length; i++) {
                	console.log(respuesta.data[i].monto);
                	me.montoTrimestre = me.montoTrimestre + respuesta.data[i].monto;
                }
                console.log("Monto trimestral : ", me.montoTrimestre );
                me.monto = me.montoTrimestre.toFixed();

                me.array = [89767.23,me.monto,422312.29,52653.76];
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });

        		var options = {
					chart: {
							type: 'bar',
							width: '350',							
							height: '200',
						},
						series: [{
							name: 'recaudado (Bs.)',
							data: this.array
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

			graficoTorta() {
				var options = {
					chart: {
							type: 'donut',
							width: '350',							
							height: '200',
						},						
  					series: [44, 55, 13],
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

				graficoLineal() {
				var options = {
					chart: {
							type: 'line',
							width: '800',
							height: '200',
						},						
  					stroke: {
					  curve: 'smooth',					  
					},
					series: [{
							name: 'recaudado (Bs.)',
							data: [2,3,4,5,6,7,8,9,10,11,12,13]							
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
            this.graficoBarra();
            this.graficoTorta();
            this.graficoLineal();
            console.log("data");
        }
	}
</script>