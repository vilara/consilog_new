@extends('adminlte::page')

@section('title', 'Admin Cmdos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <div class="info-box ">
                    <span class="info-box-icon bg-gray disabled"><i class="fas fa-prescription-bottle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                            <h1>Lista de Munições</h1>
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
                    <div class="card-header ">
                        <div class="col-sm-12">
                            <div class="position-relative p-3   bg-gray disabled" style="height: 100%">
                                <div class="ribbon-wrapper">
                                    <div class="ribbon bg-gray">
                                        <b>Manual</b>
                                    </div>
                                </div>
                                Munições cadastradas no sistema<br />
                                <small>A tabela abaixo mostra as Munições cadastrados no sistema. As informações foram
                                    extraídas do SISCOFIS.</small>
                            </div>
                        </div>

                      

                        {{-- <div class="card-tools float-left ml-2 mt-2">
                            <a href="{{ route('v.create') }}" type="submit" class="btn  bg-gray "> {{ __('Incluir') }}</a>
                        </div> --}}
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="v" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th></th>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Modelo</th>
                                    <th>Calibre</th>
                                    <th>Loc</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr style="text-align: center;">
                                    <th></th>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Modelo</th>
                                    <th>Calibre</th>
                                    <th>Loc</th>
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
    <style>
        td.details-control {
            background: url('images/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('images/details_close.png') no-repeat center center;
        }

    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            /* Formatting function for row details - modify as you need */
            function format(d) {
                // `d` is the original data object for the row
                return '<table cellpadding="6" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' +
                    '<td>Descrição:</td>' +
                    '<td>' + d.descricao + '</td>' +
                    '<td>' + d.nee + '</td>' +
                    '</tr>' +
                    '</table>';
            }
            var table = $('#v').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('v.index') }}",
                columns: [{
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nome',
                        name: 'nome'
                    },
                    {
                        data: 'tipo',
                        name: 'tipo'
                    },
                    {
                        data: 'modelo',
                        name: 'modelo'
                    },
                    
                    {
                        data: 'calibre',
                        name: 'calibre'
                    },

                    {
                        data: 'nee',
                        name: 'nee'
                    }

                    

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

            // Add event listener for opening and closing details
            $('#v tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });


        });

    </script>
@stop
