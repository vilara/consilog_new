@php
  //  dd($oii);
@endphp

@extends('adminlte::page')

@section('title', 'Efetivo OII')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Painel de Administração</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Principal</a></li>
          <li class="breadcrumb-item active">Efetivo OII</li>
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
            <h3 class="card-title">Controle de OII: {{ $oii->id }}</h3>
        @endif
        <div class="card-tools">
          <a href="{{ route('oiis.efetivos.index', $oii->id) }}" type="submit" class="btn btn-success">  {{ __('Voltar') }}
          <a href="{{ route('oiis.efetivos.create', $oii->id) }}" type="submit" class="btn btn-success">  {{ __('Vincular novo efetivo') }}
          
          </a>
      </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <table id="efetivos" class="table table-bordered table-hover">
              <thead>
              <tr style="text-align: center;">
                <th>ID</th>
                <th>Círculo</th>
                <th>Pessoal</th>
                <th>Posto/Grad</th>
                
            </tr>
        </thead>
        
        <tfoot>
            <tr style="text-align: center;">
                <th>ID</th>
                <th>Círculo</th>
                <th>Pessoal</th>
                <th>Posto/Grad</th>
              
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
    	 $('#efetivos').DataTable({
          processing: true,
          serverSide: false,
          ajax: "{{ route('oiis.efetivos.index', $oii->id) }}",
          columns: [
                { data: 'id', name: 'id'},
                { data: 'circulo', name: 'circulo'},
                { data: 'pessoal', name: 'pessoal'},
                { data: 'postograd', name: 'postograd'},
               
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
