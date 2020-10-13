@php
$u = new App\Http\Controllers\OmMaterialController;
//dd($mun->first());
@endphp

@extends('adminlte::page')

@section('title', 'Admin Cmdos')

@section('content_header')

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
                                Gráficos de estoque de Munições<br />
                                <small> Selecione abaixo uma OM e clique em buscar para ser mostrada a lista de Munição
                                    total da OM extraída do SISCOFIS.</small>
                            </div>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-3 input-dataranger">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="js-example-placeholder-single js-states form-control form-control-sm "
                                        id="selection">
                                        <option></option>
                                        <option>G Cmdo</option>
                                        <option>OM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="om">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4" name="oms"
                                        id="oms" multiple="multiple">
                                        @foreach ($omg as $omg)
                                            <option value="{{ $omg->id }}">{{ $omg->siglaOM }}</option>
                                        @endforeach
                                    </select>
                                    <input type="checkbox" id="checkbox">Select All
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

                            <div class="col-md-3" id="mu">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4" name="mun"
                                        id="mun" multiple="multiple">
                                        @foreach ($mun as $mu)
                                            <option value="{{ $mu->first()->id }}">
                                                {{ $mu->first()->tipo . ' ' . $mu->first()->calibre . ' ' . $mu->first()->modelo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3" id="bottons">
                                <button type="submit" id="filter" class="btn  bg-gray  btn-sm">Buscar</button>
                                <button type="submit" id="refresh" class="btn  bg-gray  btn-sm">Limpar</button>
                            </div>
                        </div>

                        <div style="width: 100%" class="row border">
                            <canvas id="myChart" width="400" height="200"></canvas>
                        </div>
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

            // Start do plugin select 2 para os selects de OM e G Cmdos

            $(".js-example-placeholder-single").select2({ // select do tipo de escolha de filtro OM ou g Cmdo
                placeholder: "Tipo de pesquisa",
                allowClear: true
            });

            $('#oms').select2({
                placeholder: "Selecione uma OM..."
            });
             // seleção de todos os itens da select oms
            $("#checkbox").click(function() {
                if ($("#checkbox").is(':checked')) {
                    $("#oms > option").prop("selected", "selected"); // Select All Options
                    $("#oms").trigger("change"); // Trigger change to select 2
                } else {
                    $("#oms > option").removeAttr("selected");
                    $("#oms").trigger("change"); // Trigger change to select 2
                }
            });

            $('#gcmdos').select2({
                placeholder: "Selecione um G Cmdo..."
            });

            $('#mun').select2({
                placeholder: "Selecione uma munição..."
            });


            // esconde os selects de OM e GCmdos para poder ser selecionado o tipo de seleção

            $('#om').hide();
            $('#cmdo').hide();
            $('#mu').hide();
            $('#bottons').hide();
            $('#myChart').hide();

            // limpa o select de escolha do tipo de filtro
            $("#selection").val([]).change();

            // Ação para mudar o tipo de escolha e OM para G Cmdo e vice-versa
            $('#selection').change(function() {
                if ($('#selection').val() == "G Cmdo") {
                    $('#cmdo').show();
                    $('#om').hide();
                    $('#bottons').show();
                    $('#mu').show();
                    $("#oms").val([]).change();

                } else {
                    $('#cmdo').hide();
                    $('#om').show();
                    $('#mu').show();
                    $('#bottons').show();
                    $("#gcmdos").val([]).change();
                }

            });

            // gera uma cor aleatória em hexadecimal
            function gera_cor() {
                var hexadecimais = '0123456789ABCDEF';
                var cor = '#';
                // Pega um número aleatório no array acima
                for (var i = 0; i < 6; i++) {
                    //E concatena à variável cor
                    cor += hexadecimais[Math.floor(Math.random() * 16)];
                }
                return cor;
            }


           function load_ajax(om = '',cmdo = '',mun =''){
                $.ajax({ // vincula a cetegoria de id no data id com o respectivo OII
                            type: "POST",
                            url: "{{ route('oms_materials_total') }}",
                            dataType: "json",
                            data: {
                                om: om,
                                mun: mun,
                                cmdo: cmdo
                            },
                            success: function(result) {

                               
                                myChart.data.datasets = [];
                                var labels = [];
                                var label = '';
                                var datas = result[0][2];


                                for (var i = 0; i < result[0].length; i++) {

                                    if (i == 0) {
                                        $.each(result[0][0], function(index, value) {
                                            labels.push(value.tipo + ' ' + value
                                                .calibre + ' ' + value
                                                .modelo);

                                        });
                                    }
                                    if (i == 1) {

                                        for (var ii = 0; ii < result[0][1].length; ii++) {

                                            myChart.data.datasets.push({
                                                label: result[0][1][ii],
                                                backgroundColor: gera_cor(),
                                                data: datas[ii],
                                                fill: false,
                                            });

                                            //  console.log(result[0][1][ii]);
                                        }
                                    }

                                }

                                myChart.data.labels = labels;


                                myChart.update();


                            }
                        });

            }

            // Ações para o click do botão filtrar
            $('#filter').on("click", function() {

                var om = $('#oms').val();
                var cmdo = $('#gcmdos').val();
                var mun = $('#mun').val();
                if ($("#om").is(":visible")) {
                    $('#myChart').show();
                    if (om != '' && mun != '') {
                        load_ajax(om,cmdo = '',mun);
                    } else {
                        alert('Selecione uma OM e um tipo de munição');
                    }
                }
                if ($("#cmdo").is(":visible")) {

                    if (cmdo != ''&& mun != '') {
                        $('#myChart').show();
                        load_ajax(om = '',cmdo,mun);
                    } else {
                        alert('Selecione um  G Comando e um tipo de munição');
                    }
                }
            });

            // Ações para o botão refresh

            $('#refresh').click(function() {

                $('#checkbox').prop("checked", false);
                $("#oms").val([]).change();
                $("#gcmdos").val([]).change();
                $("#selection").val([]).change();
                $("#mun").val([]).change();
                $('#bottons').hide();
                $('#myChart').hide();
                $('#mu').hide();
                $('#om').hide();
                $('#cmdo').hide();
            });


            // Início da função para ativar o gráfico Mychart com framework Chart.js

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },

                }
            });







        });

    </script>
@stop
