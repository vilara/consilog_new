@php
$u = new App\Http\Controllers\OmMaterialController;
@endphp

@extends('adminlte::page')

@section('title', 'Efetivos')

@section('content_header')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <div class="info-box ">
                    <span class="info-box-icon bg-olive"><i class="fas fa-user-friends"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                            <h1>Tipos de fetivos cadastrados do OII: {{ $oii->oii }}</h1>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
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
                                <div class="position-relative p-3 bg-olive" style="height: 100px">
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon bg-olive  disabled">
                                            <b>Manual</b>
                                        </div>
                                    </div>
                                    Vinculação de efetivos OII {{ $oii->oii }} <br />
                                    <small>A tabela abaixo mostra os efetivos cadastrados para a categoria de armamento
                                        selecionada. Para vincular com o OII acima descrito basta selecionar ou
                                        desselecionar os boxes da última coluna</small>
                                </div>
                            </div>
                        </div>
                    <div class="card-tools float-left ml-2 mt-2">
                        <a href="{{ url('oiis') }}" type="submit" class="btn bg-olive">  {{ __('Voltar') }} </a>
                    </div>


                    </div><!-- /.card-header -->
                    <div class="card-body">
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
    td {
      text-align: center; /* center checkbox horizontally */
      vertical-align: middle; /* center checkbox vertically */
    }
    input{
        text-align: center;
    }
    
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {

            load_data();

            function load_data() {

                $('#efetivo').DataTable({
                    processing: true,
                    serverSide: true,
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "filter":false,
                    ajax: {
                        url: "{{ route('oiis.efetivos.create', $oii) }}",
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


            $('#efetivo').on('click', 'input[type="checkbox"]', function() {  // event do checkbox da última coluna de cada linha

                var chk = $(this).is(":checked"); // checa se o box está selecionado ou não

                $.ajax({ // vincula a cetegoria de id no data id com o respectivo OII
                    type: "POST",
                    url: "{{ route('oiis.efetivos.store', $oii) }}",
                    data: {
                        id: $(this).parent('td').siblings().first().text(), // busca o numero do id na primeira coluna de cada linha
                        chk: $(this).is(":checked"),
                    },

                    success: function(result) {
                       // alert(result); // mostra o resultado do return da route especificada na url
                    }
                });

            });

        });

    </script>
@stop
