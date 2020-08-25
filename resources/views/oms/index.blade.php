@php
// echo $oms;    
@endphp

@extends('adminlte::page')

@section('title', 'Admin OM')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Painel de Administração</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Principal</a></li>
          <li class="breadcrumb-item active">Organização Militares</li>
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
        @if(session()->get('success'))
            <h3 class="card-title">{{ session()->get('success') }}</h3>
        @else 
            <h3 class="card-title">Controle de OM</h3>
        @endif
        <div class="card-tools">
          <a href="{{ route('oms.create') }}" type="submit" class="btn btn-success">  {{ __('Incluir nova OM') }}
          
          </a>
      </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <table id="oms" class="table table-bordered table-hover">
              <thead>
              <tr style="text-align: center;">
                <th>ID</th>
                <th>Nome da OM</th>
                <th>Sigla da OM</th>
                <th>G Cmdo</th>
                <th>CODOM</th>
                <th>CODUG</th>
                <th>Tel</th>
                <th>End</th>
                <th>Ação</th>
              </tr>
              </thead>

              <tfoot>
              <tr style="text-align: center;">
                <th>ID</th>
                <th>Nome da OM</th>
                <th>Sigla da OM</th>
                <th>G Cmdo</th>
                <th>CODOM</th>
                <th>CODUG</th>
                <th>Tel</th>
                <th>End</th>
                <th>Ação</th>
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
    	 $('#oms').DataTable({
            processing: true,
            serverSide: false,
            ajax: "{{ route('oms.index') }}",
            columns: [
                { data: 'id', name: 'id'},
                { data: 'nomeOm', name: 'nomeOm' },
                { data: 'siglaOM', name: 'siglaOM' },
                { data: 'gcmdo', name: 'gcmdo' },
                { data: 'codom', name: 'codom' },
                { data: 'codug', name: 'codug' },
                { data: 'telefone', name: 'telefone' },
                { data: 'endereco', name: 'endereco' },
                { data: 'action', name: 'action'},
            ],
            columnDefs: [
                {"targets": 4,"orderable": false,"searchable": false},
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
