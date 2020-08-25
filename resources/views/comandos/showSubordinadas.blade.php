@php
//dd($cmdsu);
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
                        @if (session()->get('success'))
                            <h3 class="card-title">{{ session()->get('success') }}</h3>
                        @else
                            <h3 class="card-title">OM subordinadas do(a): {{ $cmdsu->siglaCmdo }}</h3>
                        @endif
                        <div class="card-tools">
                            <a href="{{ route('comandos.index') }}" type="submit" class="btn btn-success">
                                {{ __('Voltar') }}

                            </a>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="subordinadas" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Om</th>

                                </tr>

                            <tbody style="text-align: center;">
                                @foreach ($cmdsu->omdsCmdo as $om)
                                   
                                        <tr>
                                            <td>{{ $om->id }}</th>
                                            <td>{{ $om->nomeOm }}</th>
                                        </tr>
                                @endforeach
                            </tbody>
                            </thead>

                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Om</th>

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
        $(document).ready(function() {
                    $('#subordinadas').DataTable();

    </script>
@stop
