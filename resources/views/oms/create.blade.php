@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastro de OM</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('oms.store') }}" method="post">
                    @method('POST')
                    {{ csrf_field() }}
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Cadastro de OM</h4>

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
                        {{-- input nome da OM --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome da OM</label>
                                <input type="nomeOm" class="form-control form-control-sm @error('nomeOm') is-invalid @enderror" name="nomeOm" id="nomeOm" value="{{ old('nomeOm') }}">
                                @error('nomeOm')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                            </div>
                        </div>
                        {{-- input sigla da OM --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sigla da OM</label>
                                <input type="siglaOM" class="form-control form-control-sm @error('siglaOM') is-invalid @enderror" name="siglaOM" id="exampleInputEmail1" value="{{ old('siglaOM') }}">
                                @error('siglaOM')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- input codom da OM --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Codom da OM</label>
                                <input type="codom" class="form-control form-control-sm @error('codom') is-invalid @enderror" name="codom" id="codom" value="{{ old('codom') }}">
                                @error('codom')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                            </div>
                        </div>
                        {{-- input codug da OM --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Codug da OM</label>
                                <input type="codug" class="form-control form-control-sm @error('codug') is-invalid @enderror" name="codug" id="codug" value="{{ old('codug') }}">
                                @error('codug')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror                        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
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
