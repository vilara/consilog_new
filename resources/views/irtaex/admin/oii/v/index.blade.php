@php
// dd($oii);
@endphp

@php
// dd($oii);
@endphp

@extends('adminlte::page')

@section('title', 'Munições OII')

@section('content_header')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <div class="info-box ">
                        <span class="info-box-icon bg-olive"><i class="fas fa-chess-bishop"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                <h1>Munições</h1>
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
                        <div class="col-sm-12">
                            <div class="position-relative p-3 bg-olive" style="height: 100%">
                                <div class="ribbon-wrapper">
                                    <div class="ribbon bg-olive  disabled">
                                        <b>Manual</b>
                                    </div>
                                </div>
                                Lista de Munições por OII<br />
                                <small>A tabela abaixo mostra as categorias cadastrados no sistema. Para acrescentar outra
                                    categoria clique no botão abaixo. A úlitma coluna (ação) possui o ícone para edição e
                                    exclusão de cada categoria, porém só é habilitada para os administradores do
                                    sistema.</small>
                            </div>
                        </div>
                        <div class="card-tools float-left ml-2 mt-2">
                            <a href="{{ route('oiis.index') }}" type="submit" class="btn bg-olive">{{ __('Voltar') }} </a>
                            <a href="{{ route('oiis.vs.create', $oii) }}" type="submit"
                                class="btn bg-olive">{{ __('Vincular outras munições') }}</a>
                        </div>
                        <div class="card-tools float-right mr-2 mt-2">
                            <button type="submit" id="atualizar" type="submit"
                                class="btn bg-olive">{{ __('Atualizar quantidades') }} </a>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="oii_municao" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Modelo</th>
                                    <th>Quantidade</th>

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

            //  load_data();

            // function load_data(oii = '') {


            $('#oii_municao').DataTable({
                processing: true,
                serverSide: false,
                "paging": false,
                "ordering": true,
                "info": false,
                "filter": false,
                ajax: "{{ route('oiis.vs.index', $oii) }}",
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

            // inicio dos eventos do botao para atualização das quantidades #atualizar 

            $("#atualizar").click(function() {
                var arr = []; // cria o array que vai armazenar as quantidades de munições 
                var vs = [];  // cria o array que vai armazenar os id das munições 
              
                $('#oii_municao tbody tr').each(function() {
                    // faz um array como todos os valores de cada coluna do efetivo
                    arr.push($(this).children('td').siblings().last().children('input').val());
                    // faz um array como todos os valores de id das munições da primeira coluna da tabela
                    vs.push($(this).children('td').siblings().first().text());
                });
              //  alert(vs);

                $.ajax({
                    type: "POST",
                    url: "{{ route('oiis.vs.store', $oii) }}",
                    data: {
                       arr : arr,
                       vs  : vs,
                    },
                    success: function(result) {
                        alert(result); 
                    }
                });

                //alert(arr);
            });

        });

    </script>
@stop
