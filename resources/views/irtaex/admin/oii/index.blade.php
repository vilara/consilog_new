@php

@endphp

@extends('adminlte::page')

@section('title', 'OII')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>OII</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"></a></li>
                    <li class="breadcrumb-item active"></li>
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
                        <h3 class="card-title">Lista de OII cadastrados</h3>
                        <div class="card-tools">
                        <a href="{{ route('oiis.create') }}" type="submit" class="btn btn-success">{{ __('Incluir novo OII') }}</a>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="oii" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>OII</th>
                                    <th>Tarefa</th>
                                    <th>Categoria</th>
                                    <th>Ações</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>OII</th>
                                    <th>Tarefa</th>
                                    <th>Categoria</th>
                                    <th>Ações</th>
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
            $('#oii').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('oiis.index') }}",

                columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'oii',
                    name: 'oii'
                },  
                {
                    data: 'tarefa',
                    name: 'tarefa'
                }, 
                {
                    data: 'categoria',
                    name: 'categoria'
                },
                {
                    data: 'action',
                    name: 'action'
                },],

                language: {
                    processing: "Carregando dados...",
                    search: "Procurar&nbsp;:",
                    loadingRecords: "Carregando dados...",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ totais de dados",
                    infoEmpty: "Mostrando 0 a 0 de 0 totais de dados",
                    zeroRecords: "Nenhum resultado encontrado",
                    emptyTable: "Nenhum resultado encontrado",
                    infoFiltered: "(filtrado de _MAX_ totais de dados)",
                    paginate: {
                        first: "Primeira",
                        previous: "Anterior",
                        next: "Pr&oacute;xima",
                        last: "&Uacuteltima"
                    },
                },
            });
        });

    </script>
@stop
