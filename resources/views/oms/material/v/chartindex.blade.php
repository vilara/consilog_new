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
                        <h1>Gráfico de Estoque de Munições por OM</h1>
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
                                Parâmtros de Pesquisa<br />
                                <small> Selecione abaixo uma OM e clique em buscar para ser mostrada a lista de Munição
                                    total da OM extraída do SISCOFIS.</small>
                            </div>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-3 input-dataranger">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="js-example-placeholder-single js-states form-control" id="selection">
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

                        <div style="width: 50%" class="row border">
                            <canvas id="myChart" width="400" height="400"></canvas>
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

            $('#gcmdos').select2({
                placeholder: "Selecione um G Cmdo..."
            });

            // esconde os selects de OM e GCmdos para poder ser selecionado o tipo de seleção

            $('#om').hide();
            $('#cmdo').hide();
            $('#bottons').hide();

            // limpa o select de escolha do tipo de filtro
            $("#selection").val([]).change();

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
                    $('#bottons').show();
                    $("#gcmdos").val([]).change();
                }

            });

            // Ações para o click do botão filtrar
            $('#filter').click(function() {
                var om = $('#oms').val();
                var cmdo = $('#gcmdos').val();
                if ($("#om").is(":visible")) {
                    if (om != '') {
                        $.ajax({ // vincula a cetegoria de id no data id com o respectivo OII
                            type: "POST",
                            url: "{{ route('oms_materials_total') }}",
                            dataType: "json",
                            success: function(result) {

                                var idarray = [];
                                var nomearry = [];

                                $.each(result, function(index, value) {
                                    idarray.push(value.id);
                                    nomearry.push(value.nomeOm);
                                });

                                load_chart(idarray,nomearry);

                                // alert(result[0].nomeOm);

                                // alert(result); // mostra o resultado do return da route especificada na url
                            }
                        });

                        load_chart(om, cmdo = '');
                    } else {
                        alert('Selecione uma OM');
                    }
                }
                if ($("#cmdo").is(":visible")) {

                    if (cmdo != '') {
                        load_chart(om = '', cmdo);
                    } else {
                        $('#municao').hide();
                        alert('Selecione um  G Comando');
                    }
                }
            });

            // Ações para o botão refresh

            $('#refresh').click(function() {
                $("#oms").val([]).change();
                $("#gcmdos").val([]).change();
                $("#selection").val([]).change();
                $('#bottons').hide();
                $('#om').hide();
                $('#cmdo').hide();
            });


            // Início da função para ativar o gráfico Mychart com framework Chart.js
            function load_chart(id,nome) {

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: nome,
                        datasets: [{
                            label: '# of Votes',
                            data: id,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',

                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',

                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }





        });

    </script>
@stop
