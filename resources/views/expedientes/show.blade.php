@extends('layouts.app')

@section('menu')
    {{-- @include('expedientes.show.paciente_menuv2') --}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="padding:0px;">
                    @include('expedientes.show.paciente_menu')
                </div>

                <div class="card-body">
                    <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Primer Nombre</label>
                    <input type="text" readonly class="form-control border-input" name="primer_nombre" value="{{$expediente->persona->primer_nombre}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Segundo Nombre</label>
                    <input type="text" readonly class="form-control border-input" name="segundo_nombre" value="{{$expediente->persona->segundo_nombre}}" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Primer Apellido</label>
                    <input type="text" readonly class="form-control border-input" name="primer_apellido" value="{{$expediente->persona->primer_apellido}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Segundo Apellido</label>
                    <input type="text" readonly class="form-control border-input" name="segundo_apellido" value="{{$expediente->persona->segundo_apellido}}">
                </div>
            </div>

        </div>

    

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                        <label>Sexo</label>
                        <input type="text" readonly class="form-control border-input" value="{{$expediente->persona->sexo->nombre_sexo}}" >                
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fecha Nacimiento (Mes-Dia-Año)</label>
                    <input type="text" readonly class="form-control border-input" value="{{$expediente->persona->fecha_nac}}">  
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label>Direccion</label>
                    <input type="text" readonly name="direccion" class="form-control border-input" value="{{$expediente->direccion}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Telefono</label>
                    @php $paciente_telefonos = "" ; @endphp
                    @forelse($expediente->telefonos as $telefono)
                        @php 
                        $paciente_telefonos = $paciente_telefonos." ".$telefono->numero;
                        @endphp
                    @empty
                    @endforelse
                    <input type="tel" readonly name="telefono" pattern="[0-9][,]" class="form-control border-input" value="{{$paciente_telefonos}}">
                    <!-- input type="text" name="telefono" class="form-control border-input" placeholder="Telefono de contacto" --> 
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" readonly name="email" class="form-control border-input" value="{{$expediente->email}}" >
                </div>
            </div>
        </div>

        <div class="row">

        </div>

<br><hr>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Tipo Sanguineo</label>
                <input type="text" readonly name="direccion" class="form-control border-input" value="{{$expediente->tipo_sanguineo->tipo_nombre}}">
            </div>
        </div>
        <div class="col-md-8">
            <label>Alergias</label>
                    <div class="form-group">
                    @php $expediente_alergias = "" ; @endphp
                    @forelse($expediente->alergias as $alergia)
                        @php 
                        $expediente_alergias = $expediente_alergias." ".$alergia->tipo_nombre;
                        @endphp
                    @empty
                    @endforelse
                    <input type="text" readonly class="form-control border-input" name="l_alergias" value="{{$expediente_alergias}}">
                    
                    </div>

        </div>
</div>


        
    <div class="row">
        <div class="col-md-12">
            <label>Observaciones</label>
            <!-- <div class="card"> 
                <div class="card-body">-->
                    @php $expediente_observaciones = "" ; @endphp
                    @forelse($expediente->observaciones as $observacion)
                        @php 
                        $expediente_observaciones = $expediente_observaciones." ".$observacion->observacion;
                        @endphp
                    @empty
                    @endforelse
                    <textarea name="observacion" readonly class="form-control" id="exampleTextarea" rows="3">{{$expediente_observaciones}}</textarea>
            <!--    </div>
             </div> -->
        </div>


    </div>
    <div class="row">

    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
