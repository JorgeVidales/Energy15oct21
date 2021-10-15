@extends('principal')
@section('contenido')

<template v-if="menu==0">
    <!-- <main class="main">
        <h1>Contenido del menú 0</h1>
    </main> -->
    <!-- <example-component></example-component> -->
    <cliente1></cliente1>
    
</template>

<template v-if="menu==1">
    <!-- <h1>Contenido del menú 1</h1> -->
    
        <estacion></estacion>
    
    <!-- <categoria2></categoria2> -->
</template>

<template v-if="menu==2">
    <!-- <main>
         <h1>usuarios</h1>
    </main> -->
    <main class="main">
        <h1>Usuarios</h1>
    </main>
   
    <!-- <usuarios></usuarios> -->
    <!-- <tablavuetify></tablavuetify> -->
    <!-- <atrticulo></atrticulo> -->
</template>

<template v-if="menu==3">
    <main class="main">
         <h1>Reportes</h1>
         <reporte></reporte>
    </main>
    <!-- <cliente></cliente> -->
    <!-- <h1>Contenido del menú 3</h1>
    <reportes></reportes> -->
    <!-- <tablavtf2></tablavtf2> --> 
</template>

<template v-if="menu==4">
    <main class="main">
            <h1>Parametros</h1>
    </main>
    <!-- <proveedor></proveedor> -->
    <!-- <parametros></parametros> -->
    
</template>

<template v-if="menu==5">
    <!-- <h1>Contenido del menú 5</h1> -->
    <maquina></maquina>
</template>

<template v-if="menu==6">
    <!-- <h1>Contenido del menú 6</h1> -->
    <aceite></aceite>
</template>

<template v-if="menu==7">
    <!-- <main class="main">
        <h1>Reporte General</h1>
    </main> -->
    <main class="main">
    <reportegen></reportegen>
    </main>
</template>

<template v-if="menu==8">
    <!-- <main class="main">
        <h1>Reporte General</h1>
    </main> -->
   
    <!-- <h1>Registro</h1> -->
    <registro></registro>
    
</template>

<template v-if="menu==9">
    <!-- <main class="main">
        <h1>Reportes Maqueta</h1>
    </main> -->
   
    <!-- <h1>Registro</h1> -->
    <reportemaqueta></reportemaqueta>
    
</template>
<!-- 
<template v-if="menu==7">
    <h1>Contenido del menú 7</h1>
</template>

<template v-if="menu==8">
    <h1>Contenido del menú 8</h1>
</template>

<template v-if="menu==9">
    <h1>Contenido del menú 9</h1>
</template>

<template v-if="menu==10">
    <h1>Contenido del menú 10</h1>
</template>

<template v-if="menu==11">
    <h1>Contenido del menú 11</h1>
</template>

<template v-if="menu==12">
    <h1>Contenido del menú 12</h1>
</template> -->

@endsection