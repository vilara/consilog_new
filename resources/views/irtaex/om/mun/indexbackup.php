@php
$u = new App\Http\Controllers\IrtaexController;
$matomcontrole = new App\Http\Controllers\OmMaterialController;
$mat = new App\Http\Controllers\MaterialOmTotalController;
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
                @foreach ($oii->groupBy('oii') as $oii)
                <div class="card-body">
                    <div class="border bg-green rounded shadow-sm p-1 mt-2">
                        <h5 claass="card-title">{{ $oii->first()->oii }}</h5>
                    </div>
                    <table id="v" class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Cat</th>
                                <th>Efetivo</th>
                                <th>Mun</th>
                                <th>Tipo</th>
                                <th>Qtde</th>
                                <th> Nec Mun</th>
                                <th> Saldo Estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                                    @foreach ($oii as $item){{--
                                        separa cada oii por categorias --}}
                                        @foreach ($item->vs as $ll)
                                            {{-- separa cada categoria de oii pelo tipo de
                                            munição --}}
                                            @if ($u->SomaEfetivoOiiOm($oii, $om) > 0 && $ll->irtaexoiis->first()->pivot->quantidade > 0)
                                                {{-- só inclui as categorias que tem efetivo
                                                cadastrado e munição com quantidade cadastrada
                                                --}}
                                                <tr>
                                                    <td style="text-align: center;">{{ $item->irtaexcategory->armamento }}
                                                    </td>{{-- busca o armamento da categoria
                                                    na tabela irtaexcategories --}}
                                                    <td style="text-align: center;">{{ $u->SomaEfetivoOiiOm($oii, $om) }}
                                                    </td>{{-- soma o efetivo total da OM por
                                                    OII na tabela irtaexefetivo_om --}}
                                                    <td>{{ $ll->material->nome }}</td>{{--
                                                    descreve o nome da munição buscando na tabela materials
                                                    --}}
                                                    <td style="text-align: center;">{{ $ll->modelo }}</td>
                                                    {{-- descreve o modelo da munição buscando
                                                    na tabela v --}}
                                                    <td style="text-align: center;">
                                                        {{ $ll->irtaexoiis->first()->pivot->quantidade }}</td>
                                                    {{-- busca a quantidade total por tipo de
                                                    munição necessária por OII --}}
                                                    <td style="text-align: center;">
                                                        {{ $ll->irtaexoiis->first()->pivot->quantidade * $u->SomaEfetivoOiiOm($oii, $om) }}
                                                    </td>{{-- multiplica o efetivo total pela
                                                    quantidade de munição necessária por OII
                                                    --}}
                                                    @php
                                                    $tot[$ll->material->nee] = $ll->irtaexoiis->first()->pivot->quantidade *
                                                    $u->SomaEfetivoOii($oii);/* apenas seta a variável para ser empregada
                                                    abaixo */
                                                    //$per = ($mat->index($ll->material) * 100) / $tot[$ll->material->nee];
                                                    $mat->retiradaStore($tot[$ll->material->nee],$matomcontrole->SomaMunicaoTotalNee($ll->material->nee),$ll->material);
                                                    /* chama o metodo retiradaStore() do objeto da classe
                                                    MaterialOmTotalController para debitar a necessidade da municao do
                                                    estoque geral */
                                                    $per = $mat->index($ll->material) + $tot[$ll->material->nee];
                                                    $perr = number_format($per * 100 / $tot[$ll->material->nee], 0, '',
                                                    '')." %";
                                                    if ($perr < 0) {$perr='0 %' ;} @endphp <td @if ($mat->index($ll->material) > 0) style="text-align:
                                                    center; background-color: rgba(96, 238, 103, 0.26);" @else
                                                        style="text-align: center; background-color: rgba(238, 96, 96,
                                                        0.26);" @endif
                                            >{{ $mat->index($ll->material) }}<span class="badge badge-info right ml-2">
                                            @if ($mat->index($ll->material) > 0)100% @else
                                                    {{ $perr }}@endif
                                            </span></td>
                                            </td>{{-- busca o saldo atualizado da munição por
                                            tipo --}}
                                            </tr>
                                        @endif
                                    @endforeach
                    @endforeach
                    </tbody>
                    </table><!-- /table -->
                </div><!-- /.card-body -->
                @endforeach
                @php
                $mat->destroyaall();
                @endphp
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