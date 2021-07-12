<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soporte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SoporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $soportes = Soporte::orderBy('id', 'desc')->get();

        return view('soporte.index', compact('soportes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('soporte.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $id = Auth::id();
   
        $soporte = new Soporte;
        $soporte->mensaje = $request->mensaje;
        $soporte->iduser = $id;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
 
            $nombre = time().$file->getClientOriginalName();
        
            $ruta = 'soporte/'.$id .'/'.$nombre;
     
            Storage::disk('public')->put($ruta,  \File::get($file));
            
            $soporte->archivo = $ruta;
        }

        $soporte->save();

        return redirect()->route('home')->with('msj-success', 'tickets enviado exitosamente.');
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
}
