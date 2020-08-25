@php
//$u = App\User::find(8);
 // $comando = App\Comando::where('codomOm', $u->detail->om->codom)->get();
//$u->contains('detail.om.codom', 111)
//$comando->contains('codomOm', 111) $om->contains('comandos.id', 111)
//$om = App\Om::where('id', $u->detail->om->id)->with('comandos')->get();
//$cc = $om[0]->with('comandos')->get();

//$comando = $u->detail->om->comandos;
////dd($comando);
@endphp

@extends('adminlte::page')

@section('title', 'Admin Usuários')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Painel de Administração</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Principal</a></li>
                    <li class="breadcrumb-item active">Usuários</li>
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
                        @if(session()->get('success'))
                        <h3 class="card-title">{{ session()->get('success') }}</h3>
                        @else 
                        <h3 class="card-title">Controle de Usuários</h3>
                        @endif
                    </div><!-- /.card-header -->
                    <div class="card-body">




                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Nome completo</th>
                                    <th>OM</th>
                                    <th>Email</th>
                                    <th>Perfil</th>
                                    <th>Cadastrado</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Nome completo</th>
                                    <th>OM</th>
                                    <th>Email</th>
                                    <th>Perfil</th>
                                    <th>Cadastrado</th>
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
            $('#example2').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('usuarios.index') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'om',
                        name: 'om'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roler',
                        name: 'roler'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                columnDefs: [{
                        "targets": 4,
                        "orderable": false,
                        "searchable": false
                    },
                    // {"targets": 5, "render": $.fn.dataTable.render.moment( 'YYYY' ) },
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
        });

    </script>
@stop
