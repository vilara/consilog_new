@php
$u = new App\Http\Controllers\OmMaterialController;

$cat = new App\Http\Controllers\IrtaexEfetivoController;
@endphp

@extends('adminlte::page')

@section('title', 'Efetivos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <div class="info-box ">
                    <span class="info-box-icon bg-olive"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                            <h1>Efetivos</h1>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="position-relative p-3 bg-olive" style="height: 100%">
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon bg-olive  disabled">
                                            <b>Manual</b>
                                        </div>
                                    </div>
                                    Lista de fetivos cadastrados <br />
                                    <small>Selecione abaixo o tipo de armamento para ser mostrado a lista de efetivos
                                        cadastrados por categoria. Apoś isso será mostrado os tipos de efetivos cadastrados
                                        no sistema por categoria de armamento. A úlitma coluna (ação) possui o ícone para
                                        edição e
                                        exclusão de cada tipo de efetivo, porém só é habilitada para os administradores do
                                        sistema.</small>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-3 input-dataranger">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4"
                                        name="categoria" id="categoria">
                                        <option></option>
                                        @foreach ($categoria as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->armamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="submit" id="filter" class="btn btn-default btn-sm">Buscar</button>
                                <button type="submit" id="refresh" class="btn btn-default btn-sm">Limpar</button>
                            </div>
                            <div class="col-3">
                                <div class="card-tools"></div>
                            </div>
                        </div>
                        <table id="efetivo" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Id</th>
                                    <th>Círculo</th>
                                    <th>Pessoal</th>
                                    <th>Posto/Grad</th>
                                    <th>Ação</th>

                                </tr>
                            </thead>

                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Círculo</th>
                                    <th>Pessoal</th>
                                    <th>Posto/Grad</th>
                                    <th>Ação</th>
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

            $('#efetivo').hide();

            $(".card-tools").hide();
            $("p").click(function() {


            });

            $('#categoria').select2({
                placeholder: "Selecinone uma categoria",
                allowClear: true
            });

            //load_data();

            function load_data(categoria = '') {

                $('#efetivo').DataTable({
                    processing: true,
                    serverSide: true,
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "filter": false,
                    ajax: {
                        url: "{{ route('efetivos.index') }}",
                        data: {
                            categoria: categoria,
                        },

                    },

                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'circulo',
                            name: 'circulo'
                        },
                        {
                            data: 'pessoal',
                            name: 'pessoal'
                        },
                        {
                            data: 'posto',
                            name: 'posto'
                        },
                        {
                            data: 'action',
                            name: 'action'
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

            $('#filter').click(function() {

                var categoria = $('#categoria').val();

                if (categoria != null) {
                    $('#efetivo').show();


                    var armamento = $('#categoria :selected').text();
                    var out1 = "<h3 class='card-title'>Parâmetros de pesquisa:  " + armamento + "</h3>";
                    $(".card-header").html(out1);

                    $('#efetivo').DataTable().destroy();
                    load_data(categoria);
                    var out = "<a href='efetivo/create/" + categoria +
                        "' type='submit' class='btn btn-success btn-sm'>  Incluir Efetivo de " + armamento +
                        "</a>";
                    $(".card-tools").html(out);
                    $(".card-tools").show();
                    // alert(categoria);
                } else {
                    alert('Selecione uma categoria');
                }
            });

            $('#refresh').click(function() {
                $(".card-header").html("<h3 class='card-title'>Selecione o tipo de armamento abaixo:</h3>");
                $(".card-tools").hide();
                $("#categoria").val([]).change();
                $('#efetivo').DataTable().destroy();
                $('#efetivo').hide();
                //   load_data();
            });



        });

    </script>
@stop
