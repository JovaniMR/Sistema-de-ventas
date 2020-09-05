<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Permission;

class PermissionsController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $permission = new Permission();

        $name = $request->name;
        $slug = $request->slug;

        $permission->name = $name;
        $permission->slug = $slug;

        $permission->save();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $nombre = $request->name;
        $slug = $request->slug;

        $permission->name = $nombre;
        $permission->slug = $slug;

        $permission->update();
        
    }

    public function getBuscaPermisos(Request $request){

      $name = $request->nombre;
      $slug = $request->slug;

      $permissions = DB::select("SELECT * FROM permissions
                                WHERE name LIKE '%$name%'
                                AND slug LIKE '%$slug%'");
      
      return $permissions;
 
    }

    public function getBuscaPermisoById(Request $request){

      $id = $request->id;

      $permission = DB::select("SELECT * FROM permissions
                                WHERE id=$id");
      
      return $permission;
 
    }
}
