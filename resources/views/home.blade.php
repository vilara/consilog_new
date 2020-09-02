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
          <div class="card-header"  >
            <p class="card-title" >Bem-vindo ao Sistema de Consciência Situacional do CMSE</p>
          </div><!-- /.card-header -->
          <div class="card-body">
            <p class="text-justify"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A Palavra logística tem a sua origem no verbo francês loger - alojar ou acolher. Foi inicialmente usado para descrever a ciência da movimentação, suprimento e manutenção de forças militares no terreno. Posteriormente, foi usado para descrever a gestão do fluxo de materiais numa organização, desde a matéria-prima até aos produtos acabados.</p> 
            <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Considera-se que a logística nasceu da necessidade dos militares em se abastecer com armamento, munições e rações, enquanto se deslocavam da sua base para as posições avançadas. Na Grécia antiga, império Romano e império Bizantino, os oficiais militares com o título Logistikas eram responsáveis pelos assuntos financeiros e de distribuição de suprimentos.</p>
            <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Neste contexto, o presente sistema tem como objetivo sistematizar a Consciência Situacional Logística do CMSE, provendo o Cmdo, em todos os níveis, de informações ágeis para facilitar a tomada de decisões.</p>
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
