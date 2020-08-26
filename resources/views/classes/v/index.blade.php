@extends('adminlte::page')

@section('title', 'Admin Cmdos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de Munições</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Principal</a></li>
                    <li class="breadcrumb-item active">Classe V - Munição</li>
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
                        @if (session()->get('success'))
                            <h3 class="card-title">{{ session()->get('success') }}</h3>
                        @else
                            <h3 class="card-title">Controle de OM</h3>
                        @endif
                        <div class="card-tools">
                            <a href="{{ route('v.create') }}" type="submit" class="btn btn-success"> {{ __('Incluir') }}

                            </a>
                        </div>
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
            /* Formatting function for row details - modify as you need */
            function format(d) {
                // `d` is the original data object for the row
                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' +
                    '<td>Descrição:</td>' +
                    '<td>' + d.descricao + '</td>' +
                    '</tr>' +
                    '</table>';
            }
            $('#v').DataTable({
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

                ],
                // columnDefs: [{
                //     "targets": 4,
                //     "orderable": false,
                //     "searchable": false
                // }, ],
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
