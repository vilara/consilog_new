@php
   // dd($oms);
@endphp

@extends('adminlte::page')

@section('title', 'Localizações')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Painel de Administração</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Principal</a></li>
                    <li class="breadcrumb-item active">OM</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        @if (session()->get('success'))
                            <h3 class="card-title">{{ session()->get('success') }}</h3>
                        @else
                            <h3 class="card-title">Controle de OM</h3>
                        @endif
                        <div class="card-tools">
                            <a href="{{ route('comandos.create') }}" type="submit" class="btn btn-success">
                                {{ __('Incluir nova localização') }}

                            </a>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="oms" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Sigla da Cmdo</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($oms as $om)
                                <tr style="text-align: center;">
                                    <th>{{ $om->id }}</th>
                                    <th>{{ $om->siglaOM }}</th>
                                    <th>{{ $om->location->latitude }}</th>
                                    <th>{{ $om->location->longitude }}</th>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table><!-- /table -->

                        <div class="map">
                            
                        </div>
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
        $(document).ready(function() {
           
        });

    </script>
@stop
