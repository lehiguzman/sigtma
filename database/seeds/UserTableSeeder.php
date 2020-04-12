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
		$user->password = bcrypt('admin');
        $user->save();

        $user->roles()->attach(Role::where('rol', 'admin')->first());
    }
}
