@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Perfil de {{ $om->id }}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('oms.update', $om) }}" method="post">
                    @method('PUT')
                    {{ csrf_field() }}
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Edição de informações de Organização Militar</h4>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        {{-- input nome OM --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome da OM</label>
                                <input type="text" id="nomeOm" class="form-control form-control-sm" name="nomeOm" id="name" value="{{ $om->nomeOm }}">
                            </div>
                        </div>

                           {{-- input sigla da OM --}}
                           <div class="col-md-6">
                            <div class="form-group">
                                <label>sigla da OM</label>
                                <input type="text" id="siglaOM" class="form-control form-control-sm" name="siglaOM" id="siglaOM" value="{{ $om->siglaOM }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- input codom --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CODOM</label>
                                <input type="text" id="codom" class="form-control form-control-sm" name="codom" id="codom" value="{{ $om->codom }}">
                            </div>
                        </div>

                           {{-- input codug --}}
                           <div class="col-md-6">
                            <div class="form-group">
                                <label>CODUG</label>
                                <input type="text" id="codug" class="form-control form-control-sm" name="codug" id="codug" value="{{ $om->codug }}">
                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <button type="submit" class="btn btn-success float-right">Cancelar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card -->





@stop


@section('footer')
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0-pre
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');

    </script>
@stop
