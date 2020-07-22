@extends('adminlte::page')

@section('title', 'Principal')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Consilog</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Principal</li>
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
            <h3 class="card-title">Bem-vindo ao Sistema de Consciência Situacional do CMSE</h3>
          </div><!-- /.card-header -->
          <div class="card-body">
              Teste
          </div><!-- /.card-Body -->
        </div>
      </div>
    </div>
</div>
@stop

@section('footer')
<div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0-pre
  </div>
  <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
