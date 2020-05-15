<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $rol = '';
        $users = User::orderBy('ID', 'DESC')->paginate();    
        
        $iduser = $iduser = Auth::user()->id;
        $rol = User::find($iduser)->roles()->first();
        $usuario = User::find($iduser);

        if($request->id) {
            $users = User::find($request->id);    
            $rol = User::find($request->id)->roles()->first();
        }        

        return [ 
            'users' => $users,
            'rol' =>  $rol,
            'usuario' => $usuario,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $user = new User();
        /*$user->nombre = $request->nombre;
        $user->tipo_documento = $request->tipo_documento;
        $user->num_documento = $request->num_documento;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->direccion = $request->direccion;
        $user->usuario = $request->usuario;
        $user->password = bcrypt( $request->password );
        $user->condicion = '1';
        $user->idrol = $request->idrol;
            $exploded = explode(',', $request->imagen);
            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }

            $filename = str_random().'.'.$extension;

            $path = public_path().'/img/usuario/'.$filename;

            file_put_contents($path, $decoded);

            $user->imagen = $filename;*/
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->sede = $request->sede;
        $user->status = $request->status;

        $exploded = explode(',', $request->imagen);
            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }

            $filename = str_random().'.'.$extension;

            $path = public_path().'/img/usuario/'.$filename;

            file_put_contents($path, $decoded);

            $user->imagen = $filename;

        $user->password = bcrypt( $request->password );
        
        $user->save();

        $user->roles()->attach(Role::find($request->rol));        
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);        
        $user->name = $request->name;        
        $user->email = $request->email;
        $user->username = $request->username;
        $user->sede = $request->sede;
        if( $request->password ) {
            $user->password = bcrypt( $request->password );
        }        
        $user->status = $request->status;  

        $currentPhoto = $user->imagen;
        if($request->imagen != $currentPhoto) {

                $exploded = explode(',', $request->imagen);
                $decoded = base64_decode($exploded[1]);

                if(str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
                } else {
                $extension = 'png';
                }
                 $filename = str_random().'.'.$extension;

                $path = public_path().'/img/usuario/'.$filename;

                file_put_contents($path, $decoded);

                //Eliminar imagen anterior del servidor
                $usuarioImagen = public_path("/img/usuario/").$currentPhoto;
                    if (file_exists($usuarioImagen)) {
                        @unlink($usuarioImagen);
                    }

                $user->imagen = $filename;

            }

        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {        
        if(!$request->ajax()) return redirect('/');              

        $user = User::findOrFail($id);   
        $user->delete();
    }
}
