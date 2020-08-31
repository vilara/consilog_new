@php

@endphp

@extends('adminlte::page')

@section('title', 'IRTAEx')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quantitativo de Munições para o Prepararo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">IRTAEX</a></li>
                    <li class="breadcrumb-item active">Classe V - Munição</li>
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
                        <h1 class="card-title">Controle de Munições do {{ $om[0]->siglaOM }}</h1>
                    </div><!-- /.card-header -->

                    @php
                    $colecao = collect($oii)->groupBy(function ($item, $key) {
                    return $item->oii;
                    });
                    @endphp

                    @foreach ($colecao as $oii)

                        <div class="card-body">
                            <div class="border bg-green rounded shadow-sm p-1 mt-2">
                                <h5 claass="card-title">{{ $oii[0]->oii }}</h5>
                            </div>
                            <table id="v" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th class="col-2">Cat</th>
                                        <th class="col-3">Mun</th>
                                        <th class="col-2">Tipo</th>
                                        <th class="col-2">Qtde</th>
                                        <th class="col-1">Efetivo</th>
                                        <th class="col-2">Tot</th>
                                        <th class="col-2">Estoque</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($oii as $item)
                                        @foreach ($item->vs as $item1)
                                            <tr>
                                                <td class="col-2" style="widht: center;">
                                                    {{ $item->irtaexcategory->armamento }}</td>
                                                <td class="col-3">{{ $item1->material->nome }}</td>
                                                <td class="col-2">{{ $item1->modelo }}</td>
                                                <td class="col-2" style="text-align: center;">
                                                    {{ $item1->pivot->quantidade }}</td>

                                                @foreach ($oii as $item2)
                                                    @foreach ($item2->irtaexefetivos as $item3)
                                                        @php
                                                        $d = $item3->oms;
                                                        $colecao1 = collect($d)->sum('pivot.efetivo');
                                                        @endphp
                                                    @endforeach
                                                    <td class="col-1" style="text-align: center;">{{ $colecao1 }}</td>
                                                    <td class="col-2" style="text-align: center;">
                                                        {{ $colecao1 * $item1->pivot->quantidade }}</td>
                                                    <td></td>
                                                @endforeach

                                        @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- /table -->
                        </div><!-- /.card-body -->
                    @endforeach
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

            $('#').DataTable({
                processing: true,
                serverSide: false,

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
