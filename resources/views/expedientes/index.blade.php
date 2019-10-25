@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Expedientes
                  {{-- <button class="btn btn-primary"  style="float: right;" id="btnCrearFabricante">Crear Expediente</button> --}}
                  <a class="btn btn-primary"  style="float: right;" href="{{ route('expedientes.create') }}">Crear Expediente</a>
                </div>

                <div class="card-body table-responsive  no-padding">
                    <table id="expedientes_table" class="table table-hover" style="width:100%;">
                      <thead>
                        <tr>
                          <th scope="col" width="5%">id</th>
                          <th width="15%">Nombre completo</th>
                          <th scope="col" width="5%">Sexo</th>
                          <th class="text-center">Fecha nacimiento</th>
                          <th class="text-center">Telefonos</th>
                          <th scope="col">Email</th>
                          <th scope="col">Direccion</th>
                          <th scope="col" width="10%"></th>
                        </tr>
                      </thead>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')

@endsection

@section('styles')
<link rel="stylesheet"  href="{{ asset('libs/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('libs/datatables/Responsive-2.2.2/css/responsive.bootstrap.min.css') }}">
@endsection


@section('scripts') 
<script type="text/javascript" src="{{ asset('libs/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/datatables/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/datatables/Responsive-2.2.2/js/responsive.bootstrap.min.js') }}"></script>
@endsection

@section('scriptscustom')
<script type="text/javascript"> 

var table;
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(document).ready(function () {
  table = $('#expedientes_table').DataTable({
    "responsive":true,
    "language": {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    },
    "bLengthChange": false,
    "lengthMenu": [8],
    "processing": true,
    "serverSide": true,
    "ajax": "{{ route('expedientes.index') }}",
    "fnDrawCallback": function (oSettings) {
      //buttonTable();
    },
    "ordering": false,
    "columns": [{
        "data": "id"
      },
      {
        "data": "nombre"
      },
      {
        "data": "sexo"
      },
      {
        "data": "fecha_nac"
      },
      {
        "data": "telefonos"
      },
      {
        "data": "email"
      },
      {
        "data": "direccion"
      },
      {
        "data": "modificar"
      }
    ]
  });



  console.log('fin');
});

</script>
@endsection