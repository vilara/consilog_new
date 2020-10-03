@php
$u = new App\Http\Controllers\OmMaterialController;
@endphp

@extends('adminlte::page')

@section('title', 'Admin Cmdos')

@section('content_header')
    <div class="row mb-2">
        <div class="col-12">
            <div class="info-box ">
                <span class="info-box-icon bg-gray disabled"><i class="fas fa-prescription-bottle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        <h1>Estoque de Munições por OM</h1>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
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
                            <div class="position-relative p-3   bg-gray disabled" style="height: 100%">
                                <div class="ribbon-wrapper">
                                    <div class="ribbon bg-gray">
                                        <b>Manual</b>
                                    </div>
                                </div>
                                Parâmetros de Pesquisa<br />
                                <small> Selecione abaixo uma OM e clique em buscar para ser mostrada a lista de Munição
                                    total da OM extraída do SISCOFIS.</small>
                            </div>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-3 input-dataranger">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="js-example-placeholder-single js-states form-control  form-control-sm select2bs4" id="selection">
                                        <option></option>
                                        <option>G Cmdo</option>
                                        <option>OM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3"  id="om">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4" name="oms"
                                        id="oms" multiple="multiple">
                                        <option>Todas</option>
                                        @foreach ($omg as $omg)
                                            <option value="{{ $omg->id }}">{{ $omg->siglaOM }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="cmdo">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4"
                                        name="gcmdos" id="gcmdos" multiple="multiple">
                                        @foreach ($gcmdos as $gcmdo)
                                            <option value="{{ $gcmdo->id }}">{{ $gcmdo->siglaCmdo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3" id="bottons">
                                <button type="submit" id="filter" class="btn  bg-gray  btn-sm">Buscar</button>
                                <button type="submit" id="refresh" class="btn  bg-gray  btn-sm">Limpar</button>
                            </div>
                        </div>
                        <table id="municao" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Modelo</th>
                                    <th>Estoque</th>
                                    <th>Validade</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Modelo</th>
                                    <th>Estoque</th>
                                    <th>Validade</th>
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

            $('#om').hide();
            $('#cmdo').hide();
            $('#bottons').hide();

            $("#selection").val([]).change();


            $('#oms').select2({
                placeholder: "Selecione uma OM..."
            });

            $(".js-example-placeholder-single").select2({
                placeholder: "Tipo de pesquisa",
                allowClear: true
            });

            $('#gcmdos').select2({
                placeholder: "Selecione um G Cmdo..."
            });


            $('#municao').hide();


            // load_data();

            function load_data(om = '', cmdo = '') {

                $('#municao').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('oms_materials') }}",
                        data: {
                            om: om,
                            cmdo: cmdo
                        }

                    },

                    columns: [{
                            data: 'id',
                            name: 'id'
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
                            data: 'qtde',
                            name: 'qtde'
                        },
                        {
                            data: 'validade',
                            name: 'validade'
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
            }

            $('#selection').change(function() {
                if ($('#selection').val() == "G Cmdo") {
                   $('#cmdo').show();
                   $('#om').hide();
                   $('#bottons').show();
                   $("#oms").val([]).change();

                } else {
                   $('#cmdo').hide();
                   $('#om').show();
                   $('#bottons').show();
                   $("#gcmdos").val([]).change();
                }

            });

            $('#filter').click(function() {
                $('#municao').show();
                var om = $('#oms').val();
                var cmdo = $('#gcmdos').val();

                if($("#om").is(":visible")){
                    if (om != '') {
                    $('#municao').DataTable().destroy();
                    load_data(om, cmdo = '');
                } else {
                    $('#municao').hide();
                    alert('Selecione uma OM');
                }
                }

                if($("#cmdo").is(":visible")){

                    if (cmdo != '') {
                        
                    $('#municao').DataTable().destroy();
                    load_data(om = '', cmdo);
                } else {
                    $('#municao').hide();
                    alert('Selecione um  G Comando');
                }

                }

              
                
            });

            $('#refresh').click(function() {
                $("#oms").val([]).change();
                $("#gcmdos").val([]).change();
                $("#selection").val([]).change();
                $('#municao').DataTable().destroy();
                $('#municao').hide();
                $('#bottons').hide();
                $('#om').hide();
                $('#cmdo').hide();
                // load_data();
            });



        });

    </script>
@stop
