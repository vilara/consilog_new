@php
$u = new App\Http\Controllers\IrtaexController;
$matomcontrole = new App\Http\Controllers\OmMaterialController;
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
                        <h1 class="card-title">Controle de Munições do {{ $om->siglaOM }}</h1>
                    </div><!-- /.card-header -->
                    @php
                    $i = 0;
                    $collect = collect($oii->groupBy('oii'));
                   // dd($collect->count());
                    @endphp
                    @foreach ($collect as $oii)
                        @php
                       // $i++;
                     //  echo $i; 
                        @endphp
                        <div class="card-body">
                            <div class="border bg-green rounded shadow-sm p-1 mt-2">
                                <h5 claass="card-title">{{ $oii->first()->oii}}</h5>
                            </div>
                            <table id="v" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th class="col-2">Cat</th>
                                        <th class="col-1">Efetivo</th>
                                        <th class="col-3">Mun</th>
                                        <th class="col-2">Tipo</th>
                                        <th class="col-2">Qtde</th>
                                        <th class="col-2">Tot</th>
                                        <th class="col-2">Estoque</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($oii as $item)
                                        {{-- separa cada oii por categorias
                                        --}}

                                        @php
                                        //dd($oii);
                                        echo $i;
                                        $l = collect($item->vs) ;
                                        //dd($l);
                                        $i = 0;
                                        $rr = collect([]) ;
                                        $concatenated = collect([]) ;
                                        @endphp
                                        @foreach ($l as $ll)
                                            @php

                                            $collect = collect([]);
                                            @endphp
                                            {{-- separa cada categoria de oii pelo tipo e
                                            quantidade de municao --}}
                                            <tr>
                                                <td class="col-2" style="widht: center;">
                                                    {{ $item->irtaexcategory->armamento }}</td>
                                                <td class="col-2" style="widht: center;"> {{ $u->SomaEfetivoOii($oii) }}
                                                </td>
                                                <td class="col-3">{{ $ll->material->nome }}</td>
                                                <td class="col-3">{{ $ll->modelo }}</td>
                                                <td class="col-3">{{ $ll->irtaexoiis->first()->pivot->quantidade }}</td>
                                                <td class="col-2" style="widht: center;">
                                                    {{ $ll->irtaexoiis->first()->pivot->quantidade * $u->SomaEfetivoOii($oii) }}
                                                </td>
                                                @php

                                                //echo $s[$ll->material->nee];


                                                $tot[$ll->material->nee] = $ll->irtaexoiis->first()->pivot->quantidade *
                                                $u->SomaEfetivoOii($oii);
                                                $estoque[$ll->material->nee] =
                                                $matomcontrole->SomaMunicaoTotalNee($ll->material->nee);


                                                $s[$ll->material->nee] = $estoque[$ll->material->nee] -
                                                $tot[$ll->material->nee];
                                                // $estoque[$ll->material->nee] = $s[$ll->material->nee];
                                                // $estoque[$ll->material->nee] = $estoque[$ll->material->nee] - $s;



                                                @endphp
                                                <td>{{ $matomcontrole->SomaMunicaoTotalNee($ll->material->nee) }}</td>
                                                {{-- pega o somatorio de municao por om por
                                                nee agrupado --}}
                                            </tr>
                                        @endforeach
                                        @php
                                        $i++;
                                        @endphp
                                    @endforeach
                                    @php
                                    // echo "brasil";
                                    $i++;
                                    @endphp
                                </tbody>
                            </table><!-- /table -->
                        </div><!-- /.card-body -->
                        @php

                       // $i++;
                        @endphp
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
