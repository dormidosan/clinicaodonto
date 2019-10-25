<?php

namespace App\Http\Controllers;

use App\Expediente;
use App\Sexo;
use App\TipoSanguineo;
use App\Alergia;
use App\Persona;
use App\Observacion;
use App\Telefono;
use Illuminate\Http\Request;

//use Illuminate\Routing\Redirector;

#use return Redirect::route
use Illuminate\Support\Facades\Redirect; 

class ExpedienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {       
            echo $this->indexFuntion($request);
        }else{
            return view('expedientes.index');  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$sexos = Sexo::all();
        $tipo_sanguineos = TipoSanguineo::all(); //where('id','!=',0)->pluck('tipo_nombre','id'); 
        $alergias = Alergia::all(); //where('id','!=',0)->pluck('tipo_nombre','id');
        return view('expedientes.create')
        ->with('alergias',$alergias)
        ->with('tipo_sanguineos',$tipo_sanguineos);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $persona = new Persona($request->all());
        $persona->save();

        $expediente = new Expediente();
        $expediente->persona_id = $persona->id;
        $expediente->tipo_sanguineo_id = $request->tipo_sanguineo;
        $expediente->save();

        if ($request->telefono) {
            $telefono = new Telefono();
            $telefono->expediente_id = $expediente->id;
            $telefono->numero = $request->telefono;
            $telefono->save();
        }        

        if ($request->alergias) {
            $expediente->alergias()->attach($request->alergias);
        }        

        if ($request->observacion) {
            $observacion = new Observacion();
            $observacion->observacion = $request->observacion;
            $observacion->save();
            $expediente->observaciones()->attach($observacion->id);
        }

        //dd($request->all());
        return Redirect::route('expedientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show(Expediente $expediente)
    {
        //
        return view('expedientes.show')->with('expediente',$expediente); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit(Expediente $expediente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expediente $expediente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expediente $expediente)
    {
        //
    }

    public function indexFuntion($request)
    {
           $columns = array( 
                0 =>'id', 
                1 =>'nombre',
                2 =>'telefono',
                3 =>'modificar'
            );

            $totalData = Expediente::count();            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');            
            // if ( empty($request->input('order.0.dir')) ) {
            //     $order = $columns[0];
            //     $dir = "asc";
            // }else{
            //     $order = $columns[$request->input('order.0.column')];
            //     $dir = $request->input('order.0.dir');
            // }
            $order = 'id';
            $dir = "asc";
            
            if(empty($request->input('search.value')))
            {            
                $expedientes = Expediente::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            }
            else {
                $search = $request->input('search.value'); 

                $expedientes =  Expediente::where('id','LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('direccion', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

                $totalFiltered = Expediente::where('id','LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('direccion', 'LIKE',"%{$search}%")
                ->count();
            }

            $data = array();
            if(!empty($expedientes))
            {
                foreach ($expedientes as $expediente)
                {                   
                    $nestedData['id'] = $expediente->id;
                    $nestedData['nombre'] = $expediente->persona->primer_nombre.' '.
                                            $expediente->persona->segundo_nombre.'<br>'.
                                            $expediente->persona->primer_apellido.' '.
                                            $expediente->persona->segundo_apellido;
                    $nestedData['sexo'] = $expediente->persona->sexo->nombre_sexo;
                    $nestedData['fecha_nac'] = $expediente->persona->fecha_nac;

                    $nestedData['telefonos'] = call_user_func(function () use ($expediente) {
                         $telefonos = "" ;
                         $first = 0;
                         foreach ($expediente->telefonos as $telefono) {
                             if ($first == 1) {
                                   $telefonos = $telefonos.'<br>';    
                             }   
                             $telefonos = $telefonos. $telefono->numero;
                             $first = 1;
                         }
                         return  $telefonos;
                     }) ;

                    $nestedData['email'] = $expediente->email;
                    $nestedData['direccion'] = $expediente->direccion;
                    // $nestedData['modificar'] = "<button type='button' name='modificar' class='btn btn-outline-info' data-button='{$expediente->id}'>Expediente</button>";
                    $nestedData['modificar'] = "<a 
                    type='button' 
                    name='modificar' 
                    class='btn btn-outline-info' 
                    href='".route('expedientes.show',$expediente->id)."' >Expediente</a>";
                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),  
                "recordsTotal"    => intval($totalData),  
                "recordsFiltered" => intval($totalFiltered), 
                "data"            => $data   
            );
            return json_encode($json_data);
    }
}
