@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <form id="crear_expediente" name="crear_expediente" class="crear_expediente" method="post" action="{{ route('expedientes.store') }}" autocomplete="on">
      {{ csrf_field() }}
      <div class="row justify-content-center">
         <div class="col-md-10">
            <div class="card">
               <div class="card-header">Datos personales</div>

               <div class="card-body">

                  @include('expedientes.create.layout1')
                  {{-- <hr><br>   --}}
                  {{-- @include('expedientes.create.layout2') --}}

                  <div class="row justify-content-center">                  
                     <div class="col-md-2 col-md-offset-5">
                        <div class="text-center">
                           <button type="submit" class="btn btn-info btn-fill btn-wd">Crear Expediente</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      
   </form>
</div>
@endsection

@section('styles')
<link rel="stylesheet"  href="{{ asset('libs/select2/css/select2.min.css') }}"/>

@endsection

@section('scripts') 
<script type="text/javascript" src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
@endsection

@section('scriptscustom')
<script type="text/javascript">
$(document).ready(function() {
    $('.select2custom').select2();
    console.log('entro2');
});

</script>

@endsection