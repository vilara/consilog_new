@extends('adminlte::page')


@section('title', 'Categorias')

@section('content_header')
    <h1>Cadastro de Categorias
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('categories.store') }}" method="post">
                @method('POST')
                {{ csrf_field() }}
                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="card-title">Formulário de Cadastro</h4>

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
                            {{-- input categoria--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <input type="text" class="form-control form-control-sm @error('categoria') is-invalid @enderror" name="categoria"   id="categoria"  value="{{ old('categoria') }}">
                                    @error('categoria')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                             {{-- input armamento--}}
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Armamento</label>
                                    <input type="text" class="form-control form-control-sm @error('armamento') is-invalid @enderror" name="armamento"   id="armamento"  value="{{ old('armamento') }}">
                                    @error('armamento')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                    <a href="{{ route('categories.index') }}" type="submit" class="btn btn-success float-right">
                        {{ __('Cancelar') }} </a>
                </div>
            </form>
        </div>
    </div>
    </div>

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
        $(document).ready(function() {
          
            $('#%%').mask('99999-999');

            

        });
    </script>
@stop
