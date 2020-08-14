@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>OM:  {{ $om->nomeOm }}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('oms.store', $om) }}" method="post">
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
                                <input type="text" class="form-control form-control-sm @error('nomeOm') is-invalid @enderror" name="nomeOm" id="name" value="{{ $om->nomeOm }}" disabled>
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
                                <label>sigla da OM</label>
                                <input type="text"class="form-control form-control-sm @error('siglaOM') is-invalid @enderror" name="siglaOM" id="siglaOM" value="{{ $om->siglaOM }}"disabled>
                                @error('siglaOM')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- input codom --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CODOM</label>
                                <input type="text" class="form-control form-control-sm @error('codom') is-invalid @enderror" name="codom" id="codom" value="{{ $om->codom }}"disabled>
                                @error('codom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                           {{-- input codug --}}
                           <div class="col-md-6">
                            <div class="form-group">
                                <label>CODUG</label>
                                <input type="text" class="form-control form-control-sm @error('codug') is-invalid @enderror" name="codug" id="codug" value="{{ $om->codug }}"disabled>
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
                    <a href="{{ route('oms.edit',$om->id) }}" type="submit" class="btn btn-success">  {{ __('Editar') }}   </a>
                    <a href="{{  url('/oms/subordinacao/create/'.$om->id) }}" class="btn btn-success">Inserir subordinação </a>
                    <a href="{{ route('oms.index') }}" type="submit" class="btn btn-success float-right">  {{ __('Cancelar') }}   </a>
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
