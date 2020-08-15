<?php

namespace App\Http\Controllers\administracion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\File;

class FilesController extends Controller
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
        $file = new File();

        $photo = $request->photo;

        //Construimos el nombre y la ruta de la imagen
        $chars = Str::random(5);
        $serverName = $photo->getClientOriginalName();
        $filename = $chars.'_'.$serverName;
 
        Storage::putFileAs('public/users',$photo,$filename);

        //Guardamos los datos
        $file->path = asset('storage/users/'.$filename);
        $file->filename = $filename;
        $file->created_by = 1;
        $file->updated_by = 1;
        $file->save();

        return $filename;
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

    public function buscaFoto(Request $request){
        
        $filename = $request->photo;


        $result = DB::select("SELECT * FROM files WHERE filename='$filename'");

        return $result;
    }
}
