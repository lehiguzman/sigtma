<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'EDWIN PERNIA';
        $user->username = 'epernia';
        $user->status = 1;
        $user->email = 'epernia@correo.com';
        $user->sede = 'Samat';
		$user->password = bcrypt('pernia123');
        $user->save();

        $user->roles()->attach(Role::where('rol', 'gerente')->first());

        $user = new User();
        $user->name = 'SUPERVISOR';
        $user->username = 'supervisor';
        $user->status = 1;
        $user->email = 'supervisor@correo.com';
        $user->sede = 'Samat';
        $user->password = bcrypt('supervisor');
        $user->save();

        $user->roles()->attach(Role::where('rol', 'supervisor')->first());

        $user = new User();
        $user->name = 'AGENTE';
        $user->username = 'agente';
        $user->status = 1;
        $user->email = 'agente@correo.com';
        $user->sede = 'Samat';
        $user->password = bcrypt('agente');
        $user->save();

        $user->roles()->attach(Role::where('rol', 'agente')->first());       
    }
}
