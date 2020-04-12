<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
           
        $roles = Role::orderBy('ID', 'DESC')->paginate();

        return $roles;
    }
}
