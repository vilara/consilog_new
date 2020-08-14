@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastro de subordinação de OM</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" action="{{ url('/oms/subordinacao/store') }}" method="post">
                @csrf @method('POST')
                <input type="hidden" class="form-control" name="id" value="{{ $om->id }}">
                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="card-title">Cadastro de Subordinação</h4>

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
                                    <input type="nomeOm"
                                        class="form-control form-control-sm @error('nomeOm') is-invalid @enderror"
                                        name="nomeOm" id="nomeOm" value="{{ $om->nomeOm }}" disabled>
                                    @error('nomeOm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- input sigla da OM --}}
                            <div class="col-md-6">
                                <!-- select om -->
                                <div class="form-group">
                                    <label>G Cmdo</label>
                                    <select class="form-control form-control-sm @error('cmdo') is-invalid @enderror"
                                        name="cmdo" id="cmdo">
                                        <option value="">Selecione...</option>
                                        @foreach ($cmdo as $cmdo)
                                            <option value="{{ $cmdo->id }}" @if (old('cmdo') == $cmdo->id) selected
                                        @endif>{{ $cmdo->siglaCmdo }}</option>
                                        @endforeach
                                    </select>
                                    @error('cmdo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- input codom da OM --}}

                            <div class="col-md-2">
                                <!-- radio omds-->
                                <div class="form-group">
                                    <label for="omds">OMDS</label>
                                    <div class="border pt-1 pl-3 mb-0">
                                        <label class="radio-inline mr-3"><input type="radio" class="form-radio-input"
                                                name="omds" id="omds1" value="1" @if (old('omds') == 1) checked @endif> Sim</label>
                                        <label class="radio-inline"><input type="radio" class="form-radio-input" name="omds"
                                                id="omds2" value="2" @if (old('omds') == 2)
                                            checked @endif> Não</label>
                                    </div>
                                    @error('omds')
                                    <span class="invalid-feedback" style="display: block;" role="alert">
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
                        <a href="{{ route('oms.index') }}" type="submit" class="btn btn-success float-right">
                            {{ __('Cancelar') }} </a>
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
