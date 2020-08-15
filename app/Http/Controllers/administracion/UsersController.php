<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $user->firstname = $request->firstname;
        $user->secondname = $request->secondname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->created_by = 1;
        $user->updated_by = 1;
        $user->file_id = $request->idFile;
       
        $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBuscaUsuario(Request $request){
       
      
        $nombre = $request->nombre;
        $usuario = $request->usuario;
        $correo = $request->correo;
        $estado = $request->estado;

        $usuarios = DB::select("SELECT concat(u.firstname,' ',u.secondname ) AS name, u.email, u.username, u.state, f.path
                               FROM users u
                               INNER JOIN files f ON u.file_id = f.id 
                               WHERE u.firstname LIKE '%$nombre%' 
                               AND u.email LIKE '%$correo%'
                               AND u.username LIKE '%$usuario%'
                               AND u.state LIKE '%$estado%' ");

        return $usuarios;
    }


}
