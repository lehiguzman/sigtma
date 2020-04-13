@extends('home') <!-- extiendo la vista home -->

@section('contenido')
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
	<!--<template v-if="menu==12">
		<pago_inmueble></pago_inmueble>
	</template>
	<template v-if="menu==10">
		<pago_vehiculo></pago_vehiculo>
	</template> -->

	<template v-if="menu==14">
		<periodo></periodo>
	</template>	
	<template v-if="menu==15">
		<zona></zona>
	</template>	
	<template v-if="menu==16">
		<regimen></regimen>
	</template>	
@endsection
