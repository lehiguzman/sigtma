@extends('home') <!-- extiendo la vista home -->

@section('contenido')

	<template v-if="menu==0">
		<registro></registro>
	</template>
	<template v-if="menu==1">
		<usuario></usuario>
	</template>	

	<template v-if="menu==2">
		<tipo_comercio></tipo_comercio>
	</template>
	<template v-if="menu==3">
		<tipo_inmueble></tipo_inmueble>
	</template>
	<template v-if="menu==4">
		<tipo_vehiculo></tipo_vehiculo>
	</template>

	<template v-if="menu==5">
		<comercio></comercio>
	</template>
	<template v-if="menu==6">
		<inmueble></inmueble>
	</template>
	<template v-if="menu==7">
		<vehiculo></vehiculo>
	</template>

	<template v-if="menu==8">
		<calculo_comercio></calculo_comercio>
	</template>
	<template v-if="menu==9">
		<calculo_inmueble></calculo_inmueble>
	</template>
	<template v-if="menu==10">
		<calculo_vehiculo></calculo_vehiculo>
	</template>

	<template v-if="menu==11">
		<pago_comercio></pago_comercio>
	</template>
	<template v-if="menu==12">
		<pago_inmueble></pago_inmueble>
	</template> 
	<template v-if="menu==13">
		<pago_vehiculo></pago_vehiculo>
	</template>

	<template v-if="menu==14">
		<periodo></periodo>
	</template>	
	<template v-if="menu==15">
		<zona></zona>
	</template>	
	<template v-if="menu==16">
		<regimen></regimen>
	</template>	

	<!-- Reportes -->
	<template v-if="menu==17">
		<reporte_usuarios></reporte_usuarios>
	</template>
	<template v-if="menu==18">
		<bitacora></bitacora>
	</template>
	<template v-if="menu==19">
		<reporte_tramites></reporte_tramites>
	</template>

	<template v-if="menu==20">
		<sumas></sumas>
	</template>
	<template v-if="menu==21">
		<restas></restas>
	</template>
	<template v-if="menu==22">
		<multiplica></multiplica>
	</template>
	<template v-if="menu==23">
		<comparacion></comparacion>
	</template>
	<template v-if="menu==24">
		<serie></serie>
	</template>
	<template v-if="menu==25">
		<registro></registro>
	</template>
	<template v-if="menu==26">
		<resultado></resultado>
	</template>

@endsection
