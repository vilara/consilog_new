
@extends('adminlte::page')

@section('title', 'IRTAEx')

@section('content_header')

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
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-3 mt-2 ml-1 input-dataranger">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="js-example-placeholder-single js-states form-control form-control-sm "
                                        id="selection">
                                        <option></option>
                                        <option>G Cmdo</option>
                                        <option>OM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="om">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4" name="om"
                                        id="oms" multiple="multiple">
                                        @foreach ($omg as $omg)
                                            <option value="{{ $omg->id }}">{{ $omg->siglaOM }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="cmdo">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4"
                                        name="gcmdos" id="gcmdos" multiple="multiple">
                                        @foreach ($gcmdos as $gcmdo)
                                            <option value="{{ $gcmdo->id }}">{{ $gcmdo->siglaCmdo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" id="categoria">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4"
                                        name="category" id="category" multiple="multiple">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->armamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="oiis">
                                @foreach ($oi as $o)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="oii"
                                            value="{{ $o->oii }}" checked>
                                        <label class="form-check-label" for="inlineCheckbox1">{{ $o->oii }}</label>
                                    </div>
                                @endforeach

                            </div>
                            <div class="col-md-2" id="efe">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ef" name="ef" checked>
                                    <input class="form-control form-control-sm" type="text" id="calc" name="calc" width="5"
                                        placeholder="qual efetivo?">
                                    <label class="form-check-label" id="label" for="ef">Efetivo previsto</label>
                                </div>
                            </div>
                            <div class="col-3" id="bottons">
                                <button type="submit" id="filter" class="btn bg-warning btn-sm">Executar</button>
                                <button type="submit" id="refresh" class="btn bg-warning btn-sm">Limpar</button>
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
    <style>

    </style>
@stop

@section('js')
    <script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script>
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

            $('#gcmdos').select2({
                placeholder: "Selecione um G Cmdo..."
            });

            // $('#mun').select2({
            //     placeholder: "Selecione uma munição..."
            // });

            $('#category').select2({
                placeholder: "Selecione uma categoria..."
            });


            $('#efetivo').hide();
            $('#calc').hide();

            // esconde os selects de OM e GCmdos para poder ser selecionado o tipo de seleção

            $('#om').hide();
            $('#cmdo').hide();
            $('#categoria').hide();
            $('#oiis').hide();
            $('#efe').hide();
            $('#bottons').hide();
            $('#myChart').hide();

            // limpa o select de escolha do tipo de filtro
            $("#selection").val([]).change();

            // Ação para mudar o tipo de escolha e OM para G Cmdo e vice-versa
            $('#selection').change(function() {
                if ($('#selection').val() == "G Cmdo") {
                    $("#gcmdos").val([]).change();
                    $("#category").val([]).change();
                    $('#cmdo').show();
                    $('#om').hide();
                    $('#bottons').show();
                    $('#efe').show();
                    $('#categoria').show();
                    $('#oiis').show();
                } else {
                    $("#oms").val([]).change();
                    $("#category").val([]).change();
                    $('#cmdo').hide();
                    $('#om').show();
                    $('#bottons').show();
                    $('#efe').show();
                    $('#categoria').show();
                    $('#oiis').show();
                    $("#gcmdos").val([]).change();
                }
            });

            $('#filter').click(function() {

                $('#efetivo').hide();
                var om = $('#oms').val();
                var category = $('#category').val();
                var oii = $('input[name="oii"]:checked').toArray().map(function(check) {
                    return $(check).val();
                });
                var efetivo = $('#calc').val();

                if (om != '' && category != '' && oii != '') {
                    if ($('#calc').is(':visible') && efetivo == '') {
                        alert('Preencha o efetivo ou clique na checkbox à esquerda!');
                    } else {

                        $('#efetivo').show();
                        $('#myChart').show();
                        load_ajax(om, cmdo = '', category, oii, efetivo)
                    }
                } else {
                    alert('Selecione uma OM, Categoria e OII');
                }
            });

            $('#refresh').click(function() {
                // limpa o select de escolha do tipo de filtro
                $("#selection").val([]).change();
                $('#myChart').hide();


                // Ação para mudar o tipo de escolha e OM para G Cmdo e vice-versa
                $('#selection').change(function() {
                    if ($('#selection').val() == "G Cmdo") {
                        $('#cmdo').show();
                        $('#om').hide();
                        $('#bottons').show();
                        $("#oms").val([]).change();

                    } else {
                        $('#cmdo').hide();
                        $('#om').show();
                        $('#mu').show();
                        $('#bottons').show();
                        $("#gcmdos").val([]).change();
                    }

                });
                $("#calc").val(['']);
                $('#efetivo').hide();
            });

            $('input[name="ef"]').on('click', function() { // event do checkbox da última coluna de cada linha

                var chk = $(this).is(":checked"); // checa se o box está selecionado ou não

                if (chk == false) {

                    $('#label').hide();
                    $('#calc').show();

                } else {
                    $('#label').show();
                    $('#calc').hide();
                    $("#calc").val(['']);

                }

            });
            // inicio das ações do gráfico
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


            function load_ajax(om = '', cmdo = '', category = '', oii = '', efetivo = '') {
                $.ajax({ // vincula a cetegoria de id no data id com o respectivo OII
                    type: "POST",
                    url: "{{ route('resumo_municao_irtaex_chart') }}",
                    dataType: "json",
                    data: {
                        om: om,
                        cmdo: cmdo,
                        category: category,
                        oii: oii,
                        efetivo: efetivo
                    },
                    success: function(result) {

                        var labels = [];
                        $.each(result[0][0], function(index, value) {
                            labels.push(index);

                        });

                        var mun = Object.values(result[0][0]); // transforma num array de values o objeto result
                        var mun1 = Object.values(mun)[0]; // transforma num array de values o primeito item do array mun
                        var mun2 = Object.keys(mun1); // transforma num array de keys ou seja as muniçẽs do objeto mun1


                        myChart.data.datasets = [];
                        var label = '';

                        for (var ii = 0; ii < mun2.length; ii++) {
                            myChart.data.datasets.push({
                                label: mun2[ii], // tipos de munição 
                                backgroundColor: gera_cor(),
                                data: result[0][1][ii],
                                fill: true,
                            });
                        }
                        myChart.data.labels = labels;
                        myChart.update();
                    }
                });

            }

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
