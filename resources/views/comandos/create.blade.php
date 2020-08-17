@extends('adminlte::page')


@section('title', 'G Cmdo')

@section('content_header')
    <h1>Cadastro de G Cmdo</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('comandos.store') }}" method="post">
                    @method('POST')
                    {{ csrf_field() }}
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Cadastro de G Cmdo</h4>

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
                        {{-- input nome do G Cmdo --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome do G Cmdo</label>
                                <input type="nomeCmdo" class="form-control form-control-sm @error('nomeCmdo') is-invalid @enderror" name="nomeCmdo" id="nomeCmdo" value="{{ old('nomeCmdo') }}">
                                @error('nomeCmdo')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                            </div>
                        </div>
                        {{-- input sigla do G Cmdo --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sigla do G Cmdo</label>
                                <input type="siglaCmdo" class="form-control form-control-sm @error('siglaCmdo') is-invalid @enderror" name="siglaCmdo" id="exampleInputEmail1" value="{{ old('siglaCmdo') }}">
                                @error('siglaCmdo')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- input codomOm do G Cmdo --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>codomOm do G Cmdo</label>
                                <input type="codomOm" class="form-control form-control-sm @error('codomOm') is-invalid @enderror" name="codomOm" id="codomOm" value="{{ old('codomOm') }}">
                                @error('codomOm')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                            </div>
                        </div>
                        {{-- input codugOm do G Cmdo --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>codugOm do G Cmdo</label>
                                <input type="codugOm" class="form-control form-control-sm @error('codugOm') is-invalid @enderror" name="codugOm" id="codugOm" value="{{ old('codugOm') }}">
                                @error('codugOm')
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
                    <a href="{{ route('comandos.index') }}" type="submit" class="btn btn-success float-right">  {{ __('Cancelar') }}   </a>
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
