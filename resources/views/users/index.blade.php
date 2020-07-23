@extends('adminlte::page')

@section('title', 'Admin Usuários')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Painel de Administração</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Principal</a></li>
          <li class="breadcrumb-item active">Usuários</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Controle de Usuários</h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>ID</th>
                <th>Nome completo</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Cadastrado</th>
                <th>Modificado</th>
              </tr>
              </thead>

              <tfoot>
              <tr>
                <th>ID</th>
                <th>Nome completo</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Cadastrado</th>
                <th>Modificado</th>
              </tr>
              </tr>
              </tfoot>
            </table><!-- /table -->
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col 12-->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

@stop

@section('footer')
<div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0-pre
  </div>
  <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
@stop

@section('css')

@stop

@section('js')
    <script>
     $(document).ready(function () {

    	 $('#example2').DataTable({
    	        processing: true,
    	        serverSide: false,
    	        ajax: "{{ route('usuarios.index') }}",
    	        columns: [
    	            { data: 'id', name: 'id' },
    	            { data: 'name', name: 'name' },
    	            { data: 'email', name: 'email' },
    	            { data: 'roler', name: 'roler' },
    	            { data: 'created_at', name: 'created_at' },
    	            { data: 'updated_at', name: 'updated_at' }
    	        ],

       		 language: {
       		        processing:     "Carregando dados...",
       		        search:         "Procurar&nbsp;:",
       		        loadingRecords: "Carregando dados...",
       		        info:           "Mostrando _START_ a _END_ de _TOTAL_ totais de dados",
       		        infoEmpty:      "Mostrando 0 a 0 de 0 totais de dados",
       		        zeroRecords:    "Nenhum resultado encontrado",
       		        emptyTable:     "Nenhum resultado encontrado",
       		        infoFiltered:   "(filtrado de _MAX_ totais de dados)",
       		        paginate: {
       		            first:      "Primeira",
       		            previous:   "Anterior",
       		            next:       "Pr&oacute;xima",
       		            last:       "&Uacuteltima"
       		        },
       		        },
    	    });

     });
    </script>
@stop
