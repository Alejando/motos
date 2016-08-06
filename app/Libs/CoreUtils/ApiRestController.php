<?php

namespace GlimGlam\Libs\CoreUtils;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use GlimGlam\Http\Controllers\Controller;

class ApiRestController extends Controller {    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $campos = Input::get("campos");
        $paginacion = Input::get("paginacion");
        if($paginacion == "false") {
            $refMethod = new \ReflectionMethod(static::$model, 'getAll'); 
            return $refMethod->invokeArgs(null, [$campos]);
        } 
        $refMethod = new \ReflectionMethod(static::$model, 'paginacion');        
        return $refMethod->invokeArgs(null, [\Config::get('app.entidadesPorPagina'), $campos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        throw new Exception("Formulario no implementado");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {       
        $refClass = new \ReflectionClass(static::$model);
        /* @var $obj ModelBase */
        $obj = $refClass->newInstance();
        $obj->fill(Input::all());
        $obj->save();
        return ['succes' => true, 'model'=> $obj];
    }

    public function relation ($id, $relation) {        
        $refMetehod = new \ReflectionMethod(static::$model, 'relation');
        $res = $refMetehod->invokeArgs(null, [$id, $relation]);        
        return $res;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {        
        
        $refMetehod = new \ReflectionMethod(static::$model, 'getById');
        $obj = $refMetehod->invoke(null, [
            $id
        ]);
        if($obj === null) {
            abort(404);
        }        
        return $obj;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       throw new Exception("Formulario no implementado");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $refMethod = new \ReflectionMethod(static::$model, 'getById');
        $obj  = $refMethod->invokeArgs(null, [$id]);                
        if($obj === null) {
            abort(404);
        }
        $obj->fill(Input::all());
        $obj->save();
        return ['succes' => true, 'model'=> $obj];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $refMethod = new \ReflectionMethod(static::$model, 'destroy');
        $refMethod->invoke(null, [$id]);
        $nDestroy = \siosp\models\Perfil::destroy($id);        
        return ['succes' => true, 'removeIntes'=> $nDestroy];
    }
    
    public function getAllForDataTables() {
        $refMeth= new \ReflectionMethod(static::$model, 'getAllForDataTables');
        return $refMeth->invokeArgs(null, []);
    }
}
