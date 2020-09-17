@php

@endphp

@extends('adminlte::page')

@section('title', 'OII')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <div class="info-box ">
                    <span class="info-box-icon bg-olive"><i class="fas fa-bullseye"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                            <h1>Objetivos Intermediários de Instrução</h1>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
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
                        <div class="col-sm-12">
                            <div class="position-relative p-3 bg-olive" style="height: 100%">
                                <div class="ribbon-wrapper">
                                    <div class="ribbon bg-olive  disabled">
                                        <b>Manual</b>
                                    </div>
                                </div>
                                Lista de OII<br />
                                <small>A tabela abaixo mostra os OII cadastrados no sistema. Para acrescentar outro objetivo
                                    clique no botão abaixo. A úlitma coluna (ação) possui os ícones para edição e
                                    exclusão de cada objetivo, porém só são habilitados para os administradores do
                                    sistema. A coluna efetivo possui um ícone que leva para os tipos de efetivo vinculados por OII,
                                    caso o ícone esteja na cor vermelha significa que não existe nenhum efetivo
                                    vinculado ao objetivo.</small>
                            </div>
                        </div>
                        <div class="card-tools float-left ml-2 mt-2">
                            <a href="{{ route('oiis.create') }}" type="submit"
                                class="btn bg-olive">{{ __('Incluir novo OII') }}</a>
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
                                    <th>Munições</th>
                                    <th>Efetivo</th>
                                    <th>Ações</th>

                                </tr>
                            </thead>
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
                "paging": false,
                "ordering": false,
                "info": false,
                "filter": false,
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
                        data: 'municao',
                        name: 'municao'
                    },
                    {
                        data: 'efetivo',
                        name: 'efetivo'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],

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
