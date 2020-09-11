@php
$u = new App\Http\Controllers\OmMaterialController;
@endphp

@extends('adminlte::page')

@section('title', 'Admin Cmdos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Painel de controle de munições geral</h1>
            </div>
            <div class="col-sm-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Principal</a></li>
                    <li class="breadcrumb-item active">Munições</li>
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
                        <h3 class="card-title">Parâmetros de pesquisa: </h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-3 input-dataranger">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select style="width: 100%;" class="form-control form-control-sm select2bs4" name="om" id="oms" multiple="multiple">
                                    @foreach ($omg as $omg)
                                        <option value="{{ $omg->id }}">{{ $omg->siglaOM }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="submit" id="filter" class="btn btn-default btn-sm">Buscar</button>
                                <button type="submit" id="refresh" class="btn btn-default btn-sm">Limpar</button>
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

            $('#oms').select2({placeholder: "Selecione uma OM..."});

            load_data();
            
            function load_data(om = ''){
                
                $('#municao').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url : "{{ route('oms_materials') }}",
                        data : {om : om}
                        
                    },
                    
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'nome', name: 'nome'},
                        { data: 'modelo', name: 'modelo'},
                        { data: 'qtde', name: 'qtde'},
                        { data: 'validade', name: 'validade'},
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
            
            $('#filter').click(function(){
               
                var om = $('#oms').val();
                //alert(om);
                if(om != ''){
                    $('#municao').DataTable().destroy();
                    load_data(om);
                }else{
                    alert('Selecione uma OM');
                }
            });

            $('#refresh').click(function(){
                $("#oms").val([]).change();
                $('#municao').DataTable().destroy();
                load_data();
            });
            


        });

    </script>
@stop
