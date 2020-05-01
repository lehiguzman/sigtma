<template>	

	<div class="contenedor row">
		<div class="bg-white shadow-container col-md-5">  
			<div class="mt-5 text-center ml-5">
		        <VueApexCharts width="500" height="300" type="bar" :options="options" :series="series"></VueApexCharts>    
		    </div>  	  
		</div>
		<div class="col-md-1">			
		</div>
		<div class="ml-2 bg-white shadow-container col-md-5">  
			<div class="mt-5 text-center ml-2">
	      		<VueApexCharts width="500" height="300" type="donut" :options="options2" :series="series2"></VueApexCharts>
	      	</div>		    
		</div>

		<div class="row bg-white shadow-container mt-4 ml-2 col-11">  			
			<div class="col-md-12">			
	        	<VueApexCharts width="800" height="300" type="line" :options="options" :series="series"></VueApexCharts>    
	    	</div> 
		</div>
	</div>	

	
</template>

<script type="text/javascript">
	import VueApexCharts from 'vue-apexcharts'	

    export default {
        data() { 
        	return {
		      options: {
		        chart: {
		          id: 'vuechart-example'
		        },
		        xaxis: {
		          categories: [1991, 1992, 1993, 1994]
		        }
		      },
		      series: [{
		        name: 'series-1',
		        data: [30, 40, 45, 50]
		      }],

		      	options2: {},
      			series2: [44, 55, 41, 17, 15]
		    }
    	},

    	components: {
       //     datatable
          VueApexCharts            
        },

    	mounted() {        	
            console.clear();            
            console.log("data");
        }
	}
</script>