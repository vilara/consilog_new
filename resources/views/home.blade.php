@extends('adminlte::page')

@section('title', 'Principal')

@section('content_header')
<div class="container-fluid">
   
</div><!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header text-center"  >
            <h3>Bem-vindo ao Sistema de Consciência Situacional Logística do CMSE</h3>
          </div><!-- /.card-header -->
          <div class="card-body  text-center" >
            <img src="../images/cmse_frontal.jpg" class="img-fluid w-75"  alt="Imagem responsiva">
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
