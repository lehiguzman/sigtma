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
        $user->name = 'admin';
        $user->username = 'admin';
        $user->status = 1;
        $user->email = 'admin@correo.com';
        $user->sede = 'Barinas';
		$user->password = bcrypt('admin');
        $user->save();

        $user->roles()->attach(Role::where('rol', 'admin')->first());

        $user = new User();
        $user->name = 'gerente';
        $user->username = 'gerente';
        $user->status = 1;
        $user->email = 'gerente@correo.com';
        $user->sede = 'Barinas';
        $user->password = bcrypt('gerente');
        $user->save();

        $user->roles()->attach(Role::where('rol', 'gerente')->first());

        $user = new User();
        $user->name = 'agente';
        $user->username = 'agente';
        $user->status = 1;
        $user->email = 'agente@correo.com';
        $user->sede = 'Barinas';
        $user->password = bcrypt('agente');
        $user->save();

        $user->roles()->attach(Role::where('rol', 'agente')->first());

        $user = new User();
        $user->name = 'usuario';
        $user->username = 'usuario';
        $user->status = 1;
        $user->email = 'usuario@correo.com';
        $user->sede = 'Barinas';
        $user->password = bcrypt('usuario');
        $user->save();

        $user->roles()->attach(Role::where('rol', 'user')->first());
    }
}
