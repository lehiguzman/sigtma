<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->rol = 'gerente';
        $role->descripcion = 'Gerente/Administrador';        
        $role->save();        

        $role = new Role();
        $role->rol = 'supervisor';
        $role->descripcion = 'Supervisor de Sede';
        $role->save();

        $role = new Role();
        $role->rol = 'agente';
        $role->descripcion = 'Agente Tributario';
        $role->save();
    }
}
