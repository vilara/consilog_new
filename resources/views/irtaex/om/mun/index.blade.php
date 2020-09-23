@php
$matomcontrole = new App\Http\Controllers\OmMaterialController;
$mat = new App\Http\Controllers\MaterialOmTotalController;
@endphp

@extends('adminlte::page')

@section('title', 'IRTAEx')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <div class="info-box ">
                    <span class="info-box-icon bg-warning"><i class="fas fa-file"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                            <h1>Resumo de necessidade de Munições por tipo de tiro de instrução</h1>
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
                            <div class="position-relative p-3 bg-warning" style="height: 100%">
                                <div class="ribbon-wrapper">
                                    <div class="ribbon bg-gray">
                                        <b>Manual</b>
                                    </div>
                                </div>
                                Parâmtros de Pesquisa<br />
                                <small> Selecione abaixo uma OM e um tipo de categoria de tiro e clique em buscar para ser
                                    mostrada a lista de munição
                                    necessária. Após isso, as duas tabelas iniciais mostram o resumo da
                                    munição com seu respectivo saldo cadastrado no SICOFIS, bem como o efetivo cadastrado no
                                    sistema. Logo abaixo é mostrada a tabela detalhada por Objetivo de Instrução.</small>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2 ml-1 input-dataranger">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4" name="om"
                                        id="oms" multiple="multiple">
                                        @foreach ($omg as $omg)
                                            <option value="{{ $omg->id }}">{{ $omg->siglaOM }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4"
                                        name="category" id="category" multiple="multiple">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->armamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @foreach ($oi as $o)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="oii"
                                            value="{{ $o->oii }}" checked>
                                        <label class="form-check-label" for="inlineCheckbox1">{{ $o->oii }}</label>
                                    </div>
                                @endforeach

                            </div>
                            <div class="col-3">
                                <button type="submit" id="filter" class="btn bg-warning btn-sm">Buscar</button>
                                <button type="submit" id="refresh" class="btn bg-warning btn-sm">Limpar</button>
                            </div>
                        </div>
                    </div><!-- /.card-header -->


                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">

                                <table id="resumo" width="100%" class="table table-bordered table-hover ml-2">
                                    <thead>
                                        <tr class=" bg-warning" style="text-align: center;">
                                            <th>Munição</th>
                                            <th>Mun Nec</th>
                                            <th>Estoque</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>

                            <div class="col-5">

                                <table id="efetivo" width="100%" class="table table-bordered table-hover ml-2">
                                    <thead>
                                        <tr class=" bg-warning" style="text-align: center;">
                                            <th></th>
                                            <th>Efetivo</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>

                        </div>
                        <table id="v" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center; visibility:hidden;">
                                    <th>e</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
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
        td.details-control {
            background: url('../../images/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('../../images/details_close.png') no-repeat center center;
        }

        td {
            text-align: center;
            /* center checkbox horizontally */
            vertical-align: middle;
            /* center checkbox vertically */
        }

    </style>
@stop

@section('js')
    <script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script>
    <script>
        $(document).ready(function() {


            $('#oms').select2({
                placeholder: "Selecione uma OM..."
            });

            $('#category').select2({
                placeholder: "Selecione uma categoria..."
            });


            $('#v').hide();
            $('#resumo').hide();
            $('#efetivo').hide();

            function load_data(om = '', category = '', oii = '') {

                var table = $('#resumo').DataTable({
                    processing: true,
                    serverSide: false,
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "filter": false,
                    ajax: {
                        url: "{{ route('resumo_municao_irtaex') }}",
                        data: {
                            om: om,
                            category: category,
                            oii : oii,
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'mun_nec',
                            name: 'mun_nec'
                        },
                        {
                            data: 'estoque',
                            name: 'estoque'
                        },
                    ],
                });

                var table = $('#efetivo').DataTable({
                    processing: true,
                    serverSide: false,
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "filter": false,
                    ajax: {
                        url: "{{ route('resumo_efetivo_irtaex') }}",
                        data: {
                            om: om,
                            category: category,
                            oii : oii,
                        }

                    },

                    columns: [{
                            data: 'oii',
                            name: 'oii'
                        },
                        {
                            data: 'soma',
                            name: 'soma'
                        },


                    ],


                });

                var groupColumn = 1;
                var table = $('#v').DataTable({
                    processing: true,
                    serverSide: false,
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "filter": false,
                    ajax: {
                        url: "{{ route('resumo_irtaex') }}",
                        data: {
                            om: om,
                            category: category,
                            oii : oii,
                        }

                    },

                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'tipo',
                            name: 'tipo'
                        },
                        {
                            data: 'nome',
                            name: 'nome'
                        },
                        {
                            data: 'modelo',
                            name: 'modelo'
                        },
                        {
                            data: 'quantidade',
                            name: 'quantidade'
                        },
                        {
                            data: 'efetivo',
                            name: 'efetivo'
                        },
                        {
                            data: 'mun_nec',
                            name: 'mun_nec'
                        },
                        {
                            data: 'estoque',
                            name: 'estoque'
                        },
                        {
                            data: 'saldo',
                            name: 'saldo'
                        },


                    ],
                    // rowsGroup: [5],

                    "columnDefs": [{
                            "visible": false,
                            "targets": groupColumn
                        },
                        {
                            "visible": false,
                            "targets": 0
                        },
                        {
                            "visible": false,
                            "targets": 7
                        }
                    ],
                    "displayLength": 25,

                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;

                        api.column(groupColumn, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="group  bg-warning" ><td style=" text-align: left;" colspan="7"><h3><b>' +
                                    group +
                                    '</b></h3></td></tr><tr style=" text-align: center;"><th>Nome</th><th>Modelo</th><th>Qtde</th><th>Efetivo</th><th>Mun Nec</th><th>Disponibilidade </th></tr>'
                                );

                                last = group;
                            }
                        });
                    },

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

            }

            $('#filter').click(function() {

                $('#v').DataTable().destroy();
                $('#resumo').DataTable().destroy();
                $('#efetivo').DataTable().destroy();
                $('#v').hide();
                $('#resumo').hide();
                $('#efetivo').hide();
                var om = $('#oms').val();
                var category = $('#category').val();
                var oii = $('input[name="oii"]:checked').toArray().map(function(check) {
                    return $(check).val();
                });

                if (om != '' && category != '' && oii != '') {
                    $('#v').show();
                    $('#resumo').show();
                    $('#efetivo').show();
                    load_data(om, category,oii);
                } else {
                    alert('Selecione uma OM, Categoria e OII');
                }
            });

            $('#refresh').click(function() {
                $("#oms").val([]).change();
                $("#category").val([]).change();
                $('#v').DataTable().destroy();
                $('#resumo').DataTable().destroy();
                $('#efetivo').DataTable().destroy();
                $('#v').hide();
                $('#efetivo').hide();
                $('#resumo').hide();
            });



        });

    </script>
@stop
