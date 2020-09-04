<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Roles_permission;
use Illuminate\Support\Facades\DB;
class RolesController extends Controller
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
        //Guarda en la tabla rol

        $rol = new Role();

        $rol->name = $request->name;
        $rol->slug = $request->slug;

        $rol->save();

        //Obtiene el id del Rol 

        $rol = DB::select("SELECT id FROM roles WHERE name= '$request->name'");
        $rolId = $rol[0]->id;

        //Guarda en la tabla pivote (roles_permissions)

        $listPermission = $request->listPermissions;
        
           foreach($listPermission as $permission){

                if($permission['checked'] == true){

                    $idPermission = $permission['id'];
                    
                    DB::insert("INSERT INTO roles_permissions 
                                (roles_id, permissions_id) 
                                VALUES ($rolId,$idPermission)");
                      
                }
           }
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
        $rol = Role::findOrFail($id);

        $rol->name = $request->name;
        $rol->slug = $request->slug;

        $rol->update();
    }

    public function getBuscaRoles(Request $request){
       
      
        $nombre = $request->nombre;
        $slug = $request->slug;

        $roles = DB::select("SELECT * FROM roles 
                               WHERE name LIKE '%$nombre%' 
                               AND slug LIKE '%$slug%'
                               ORDER BY id DESC");

        return $roles;
    }

    public function getRolByid(Request $request){

        $id = $request->id;

        $rol = DB::select("SELECT * FROM roles WHERE id=$id");

        return $rol;
    }

    public function getListarPermisosByRol(){

        $permissions = DB::select("SELECT * FROM permissions");

        return $permissions;
    }

    public function getPermisosByRol(Request $request){

        $id = $request->id;

        $permissions = DB::select("SELECT p.*, CASE IFNULL (rp.roles_id,'') WHEN '' THEN 0 ELSE 1 END checked 
        FROM permissions p 
        LEFT OUTER JOIN roles_permissions rp ON rp.permissions_id= p.id 
        AND rp.roles_id = $id");                        

        return $permissions;
    }

    public function getRolAndPermissions(Request $request){

        $id = $request->id;

        $permissions = DB::select("SELECT p.*
                                   FROM permissions p 
                                   INNER JOIN roles_permissions rp ON rp.permissions_id= p.id 
                                   WHERE rp.roles_id = $id");                        

        return $permissions;
    }



}
