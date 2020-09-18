@php
// dd($oii);
@endphp

@extends('adminlte::page')

@section('title', 'Efetivo OII')

@section('content_header')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <div class="info-box ">
                        <span class="info-box-icon bg-olive"><i class="fas fa-user-friends"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                <h1>Efetivo por OII {{ $oii->oii }}</h1>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
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
                                Lista de Efetivo do OII {{ $oii->oii }}<br />
                                <small>A tabela abaixo mostra as categorias cadastrados no sistema. Para acrescentar outra
                                    categoria clique no botão abaixo. A úlitma coluna (ação) possui o ícone para edição e
                                    exclusão de cada categoria, porém só é habilitada para os administradores do
                                    sistema.</small>
                            </div>
                        </div>
                        <div class="card-tools float-left ml-2 mt-2">
                            <a href="{{ route('oiis.index') }}" type="submit" class="btn bg-olive"> {{ __('Voltar') }} </a>
                        </div>
                        <div class="card-tools float-right mr-2 mt-2">
                            <a href="{{ route('oiis.efetivos.create', $oii->id) }}" type="submit" class="btn bg-olive">
                                {{ __('Vincular novo efetivo') }}</a>
                        </div>


                        <div class="card-tools">
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
    <style>
        td {
            text-align: center;
            /* center checkbox horizontally */
            vertical-align: middle;
            /* center checkbox vertically */
        }

        input {
            text-align: center;
        }

    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#efetivos').DataTable({
                processing: true,
                serverSide: false,
                "paging": false,
                "ordering": true,
                "info": false,
                "filter": false,
                ajax: "{{ route('oiis.efetivos.index', $oii->id) }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'circulo',
                        name: 'circulo'
                    },
                    {
                        data: 'pessoal',
                        name: 'pessoal'
                    },
                    {
                        data: 'postograd',
                        name: 'postograd'
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
