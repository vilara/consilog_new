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
              </tr>
              </thead>

              <tfoot>
              <tr>
                <th>ID</th>
                <th>Nome completo</th>
                <th>Email</th>
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

    console.log('Hi!');

     });
    </script>
@stop
