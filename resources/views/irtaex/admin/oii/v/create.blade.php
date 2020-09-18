@php
$u = new App\Http\Controllers\OmMaterialController;
@endphp

@extends('adminlte::page')

@section('title', 'Qtde Munições')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h4>Painel de controle de Munições: {{ $oii->oii }}</h4>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Principal</a></li>
                    <li class="breadcrumb-item active">Efetivos</li>
                </ol>
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
                                <div class="position-relative p-3 bg-olive" style="height: 100px">
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon bg-olive  disabled">
                                            <b>Manual</b>
                                        </div>
                                    </div>
                                    Vinculação de efetivos com OII <br />
                                    <small>A tabela abaixo mostra os efetivos cadastrados para a categoria de armamento
                                        selecionada. Para vincular com o OII acima descrito basta selecionar ou
                                        desselecionar os boxes da última coluna</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-tools float-left ml-1 mt-2">
                            <a href="{{ url('oiis') }}" type="submit"
                                class="btn bg-olive">{{ __('Voltar') }}</a>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="municao" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Modelo</th>
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

</style>
@stop

@section('js')
    <script>
        $(document).ready(function() {

            load_data();

            function load_data() {

                $('#municao').DataTable({
                    processing: true,
                    serverSide: true,
                    "paging": true,
                    "ordering": false,
                    "info": false,
                    "filter":true,
                    ajax: {
                        url: "{{ route('oiis.vs.create', $oii) }}",
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


            $('#municao').on('click', 'input[type="checkbox"]', function() {  // event do checkbox da última coluna de cada linha

                var chk = $(this).is(":checked"); // checa se o box está selecionado ou não
                alert($(this).parent('td').siblings().first().text());
                alert(chk);
                $.ajax({ // vincula a cetegoria de id no data id com o respectivo OII
                    type: "POST",
                    url: "{{ route('oiis.vs.store', $oii) }}",
                    data: {
                        id: $(this).parent('td').siblings().first().text(), // busca o numero do id na primeira coluna de cada linha
                        chk: $(this).is(":checked"),
                    },

                    success: function(result) {
                        alert(result); // mostra o resultado do return da route especificada na url
                    }
                });

            });

        });

    </script>
@stop
