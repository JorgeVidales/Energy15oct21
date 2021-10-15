<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Estacion;
use App\Models\Aceite;
use App\Models\Maquinas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // LLENADO DE LOS USUARIOS
        $user = new User();

        $user->name = 'Jorge V.';
        $user->email = 'jorgev_328@hotmail.com';
        $user->password = bcrypt('11111111');

        $user->cliente = '{}';
        $user->estaciones = '[]';

        $user->clientesimple = '{}';
        $user->estacionessimple = '[]';

        $perfilSimple = $user->usuarioTipo = '{"perfil":"Administrador","id":"1"}';
        $resultado = json_decode($perfilSimple);

        $user->usuarioTiposimple = $resultado->perfil;
        $user->condicion = '1';

        $user->save();

        $user2 = new User();

        $user2->name = 'Prueba 2';
        $user2->email = 'prueba2@hotmail.com';
        $user2->password = bcrypt('11111111');

        $user2->cliente = '{}';
        $user2->estaciones = '[]';

        $user2->clientesimple = '{}';
        $user2->estacionessimple = '[]';

        $perfilSimple2 = $user2->usuarioTipo = '{"perfil":"Cliente","id":"2"}';
        $resultado2 = json_decode($perfilSimple2);

        $user2->usuarioTiposimple = $resultado2->perfil;
        $user2->condicion = '1';

        $user2->save();

        // LLENADO DE LOS CLIENTES
        $cliente = new Cliente();
        $cliente->compania = 'TRANSCANADA';
        $cliente->condicion = '1';
        $cliente->save();

        $cliente2 = new Cliente();
        $cliente2->compania = 'MAYEKAWA';
        $cliente2->condicion = '1';
        $cliente2->save();

        $cliente3 = new Cliente();
        $cliente3->compania = 'EDA (ENERGIA DE APIZACO)';
        $cliente3->condicion = '1';
        $cliente3->save();

        // LLENADO DE LAS ESTACIONES
        $estaciones1 = new Estacion();
        $estaciones1->idCompania = '1';
        $estaciones1->estacion = 'NARANJOS';
        $estaciones1->condicion = '1';
        $estaciones1->save();

        $estaciones2 = new Estacion();
        $estaciones2->idCompania = '1';
        $estaciones2->estacion = 'TAMAZUNCHALE';
        $estaciones2->condicion = '1';
        $estaciones2->save();

        $estaciones3 = new Estacion();
        $estaciones3->idCompania = '1';
        $estaciones3->estacion = 'EL ENCINO';
        $estaciones3->condicion = '1';
        $estaciones3->save();

        $estaciones4 = new Estacion();
        $estaciones4->idCompania = '1';
        $estaciones4->estacion = 'EL ORO';
        $estaciones4->condicion = '1';
        $estaciones4->save();

        $estaciones5 = new Estacion();
        $estaciones5->idCompania = '1';
        $estaciones5->estacion = 'TUXPAN';
        $estaciones5->condicion = '1';
        $estaciones5->save();

        $estaciones6 = new Estacion();
        $estaciones6->idCompania = '2';
        $estaciones6->estacion = 'MERIDA';
        $estaciones6->condicion = '1';
        $estaciones6->save();

        $estaciones7 = new Estacion();
        $estaciones7->idCompania = '3';
        $estaciones7->estacion = 'APIZACO';
        $estaciones7->condicion = '1';
        $estaciones7->save();

        // LLENADO DE ACEITES

        $aceites = new Aceite();
        $aceites->tipoAceite = 'Lubricacion';
        $aceites->marca = 'Mobil';
        $aceites->modelo = 'DTE832';
        $aceites->save();

        $aceites = new Aceite();
        $aceites->tipoAceite = 'Lubricacion';
        $aceites->marca = 'Atlas Copco';
        $aceites->modelo = 'ROTO EXTEND 46';
        $aceites->save();

        $aceites = new Aceite();
        $aceites->tipoAceite = 'Lubricacion';
        $aceites->marca = 'Mobil';
        $aceites->modelo = 'Pegasus 805';
        $aceites->save();

        $aceites = new Aceite();
        $aceites->tipoAceite = 'Lubricacion';
        $aceites->marca = 'Mexlub';
        $aceites->modelo = 'Transformadores M';
        $aceites->save();

        // LLENADO DE MAQUINAS

        $maquina = new Maquinas();
        $maquina->tipo = 'Turbina';
        $maquina->marca = 'Solar';
        $maquina->modelo = 'Mars 100';
        $maquina->tag = 'TMZCL-HG-MMT-224';
        $maquina->volaceite = 5000;
        $maquina->idAceite = 1;
        $maquina->save();

        $maquina2 = new Maquinas();
        $maquina2->tipo = 'Compresor';
        $maquina2->marca = 'Atlas Copco';
        $maquina2->modelo = 'Desconocido';
        $maquina2->tag = 'IA-PKC-Y271';
        $maquina2->volaceite = 1200;
        $maquina2->idAceite = 2;
        $maquina2->save();

        $maquina3 = new Maquinas();
        $maquina3->tipo = 'Generador';
        $maquina3->marca = 'Cummins';
        $maquina3->modelo = 'QSK60G';
        $maquina3->tag = 'P01';
        $maquina3->volaceite = 100;
        $maquina3->idAceite = 3;
        $maquina3->save();

    }
}
