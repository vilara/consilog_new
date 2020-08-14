@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Cmdo: {{ $comando->nomeCmdo }}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('comandos.update', $comando) }}" method="post">
                    @method('PUT')
                    {{ csrf_field() }}
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Edição de informações de G Comando</h4>

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
                        {{-- input nome Comando --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome do Comando</label>
                                <input type="text" class="form-control form-control-sm @error('nomeCmdo') is-invalid @enderror" name="nomeCmdo" id="name" value="{{ $comando->nomeCmdo }}">
                                @error('nomeCmdo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                           {{-- input sigla do Cmdo--}}
                           <div class="col-md-6">
                            <div class="form-group">
                                <label>sigla do Cmdo</label>
                                <input type="text"class="form-control form-control-sm @error('siglaCmdo') is-invalid @enderror" name="siglaCmdo" id="siglaCmdo" value="{{ $comando->siglaCmdo }}">
                                @error('siglaCmdo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- input codomOm --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>codom Cmdo</label>
                                <input type="text" class="form-control form-control-sm @error('codomOm') is-invalid @enderror" name="codomOm" id="codomOm" value="{{ $comando->codomOm }}">
                                @error('codomOm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                           {{-- input codugOm --}}
                           <div class="col-md-6">
                            <div class="form-group">
                                <label>codug Cmdo</label>
                                <input type="text" class="form-control form-control-sm @error('codugOm') is-invalid @enderror" name="codugOm" id="codugOm" value="{{ $comando->codugOm }}">
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
