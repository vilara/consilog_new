@php
//$t = $efe[0]->oms->where('id',15);
//dd($t[0]->pivot->efetivo);
 //dd($v);
// dd($oii);
// $om[0]->irtaexefetivo[0]->pivot->efetivo // calcula o efetivo por posto grad

//dd($om[0]->irtaexefetivo[0]->pivot->efetivo);
@endphp

@extends('adminlte::page')

@section('title', 'IRTAEx')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quantitativo de Munições</h1>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Controle de Munições do {{ $om[0]->siglaOM }}</h3>
                    </div><!-- /.card-header -->


                    @foreach ($oii as $oii)

                    <div class="card-body">
                        <h5>{{ $oii->oii }}</h5>
                        <table id="v" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th >Mun</th>
                                    <th >Tipo</th>
                                    <th >Qtde</th>
                                    <th >Efetivo</th>
                                    <th >Tot</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($oii->vs as $v)
                                    <tr style="text-align: center;">
                                        <td>{{ $v->material->nome }}</td>
                                        <td>{{ $v->modelo }}</td>
                                        <td>{{ $v->pivot->quantidade }}</td>
                                         @php
                                             $r = $om[0]->irtaexefetivo[0];
                                         @endphp

                                        <td>{{ $r->pivot->efetivo }}</td>
                                         @php
                                             $tot = $v->pivot->quantidade * $om[0]->irtaexefetivo[0]->pivot->efetivo;
                                         @endphp
                                        <td>{{ $tot }}</td>
                                    </tr>
                                @endforeach

                            </tbody>

                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>Mun</th>
                                    <th >Tipo</th>
                                    <th>Qtde</th>
                                    <th>Efetivo</th>
                                    <th >Tot</th>
                                </tr>
                            </tfoot>
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
