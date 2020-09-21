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
                                <small> Selecione abaixo uma OM e clique em buscar para ser mostrada a lista de Munição
                                    necessária por tipo de tiro de instrução.</small>
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
                            <div class="col-3">
                                <button type="submit" id="filter" class="btn bg-warning btn-sm">Buscar</button>
                                <button type="submit" id="refresh" class="btn bg-warning btn-sm">Limpar</button>
                            </div>
                        </div>
                    </div><!-- /.card-header -->


                    <div class="card-body">
                        <table id="v" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Tipo</th>
                                    <th>Nome</th>
                                    <th>Modelo</th>
                                    <th>Quantidade</th>
                                    <th>Efetivo</th>
                                    <th>Mun Nec</th>
                                    {{-- <th>Cat</th> --}}
                                    {{-- <th>Efetivo</th>
                                    <th>Mun</th>
                                    <th>Tipo</th>
                                    <th>Qtde</th>
                                    <th> Nec Mun</th>
                                    <th> Saldo Estoque</th> --}}
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

    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#oms').select2({
                placeholder: "Selecione uma OM..."
            });

            $('#category').select2({
                placeholder: "Selecione uma categoria..."
            });


            $('#v').hide();

            /* Formatting function for row details - modify as you need */


            function load_data(om = '', category = '') {


                var groupColumn = 1;
                var table = $('#v').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: "{{ route('resumo_irtaex') }}",
                        data: {
                            om: om,
                            category: category
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


                    ],
                    "columnDefs": [{
                        "visible": false,
                        "targets": groupColumn
                    }],
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
                                    '<tr class="group  bg-warning"><td colspan="7">' + group +
                                    '</td></tr>'
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
                 $('#v').hide();
                var om = $('#oms').val();
                var category = $('#category').val();
                // alert(category);

                if (om != '' && category != '') {
                    //  alert(category);
                    // $('#municao').DataTable().destroy();
                $('#v').show();
                    load_data(om, category);


                } else {
                    alert('Selecione uma OM e uma Categoria');
                }


                //     $('td.details-control').click(function(){
                //      alert('sdfh');
                //    });


            });

            $('#refresh').click(function() {
               // alert("teste");
                 $("#oms").val([]).change();
                 $("#category").val([]).change();
                 $('#v').DataTable().destroy();
                 $('#v').hide();
                // load_data();
            });



        });

    </script>
@stop
