@php
$u = new App\Http\Controllers\OmMaterialController;
@endphp

@extends('adminlte::page')

@section('title', 'Admin Cmdos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Painel de controle de munições</h1>
            </div>
            <div class="col-sm-6">
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
                        <h3 class="card-title">Controle de munições do {{ $om->siglaOM }}</h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="municao" class="table table-bordered table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Qtde</th>
                                    <th>Validade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($om->materialsTot->groupBy('nee') as $material)

                                @php
                                   // dd($material->where('pivot.validade',$material->min('pivot.validade'))->sum('pivot.qtde'));
                                @endphp
                                    <tr style="text-align: center;">
                                        <td>{{ $material->first()->id }}</td>
                                        <td>{{ $material->first()->nome }}</td>
                                        <td>{{ $material->first()->materialable->modelo }}</td>
                                        <td>{{ $u->SomaMunicaoTotalNeeOM($om, $material->first()->nee) }}</td> {{-- retorna a quantidade de munição por OM por NEE --}}
                                        {{-- <td>{{ $material->sum('pivot.qtde') }}</td> --}}
                                        @if (strtotime($material->min('pivot.validade')) < strtotime($mytime))
                                            <td style="background-color: tomato">
                                            {{ date( 'd/m/Y' , strtotime($material->min('pivot.validade')))}}
                                        <span class="badge badge-info right ml-2">{{ $material->where('pivot.validade',$material->min('pivot.validade'))->sum('pivot.qtde') }}</span></td>
                                        @else
                                        <td>
                                            {{ date( 'd/m/Y' , strtotime($material->min('pivot.validade')))}}
                                        </td>
                                            @endif
                                       {{--  <td>{{  date( 'd/m/Y' ,strtotime($mytime))  }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Qtde</th>
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
            $('#municao').DataTable({
                processing: true,
                serverSide: false,
                // ajax: "{{ route('comandos.index') }}",
                // columns: [
                //     { data: 'id', name: 'id'},
                //     { data: 'nomeCmdo', name: 'nomeCmdo' },
                //     { data: 'siglaCmdo', name: 'siglaCmdo' },
                //     { data: 'omds', name: 'omds' },
                //     { data: 'action', name: 'action'},
                // ],
                // columnDefs: [
                //     {"targets": 4,"orderable": false,"searchable": false},
                // ],
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
