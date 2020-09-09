@extends('adminlte::page')


@section('title', 'Categoria')

@section('content_header')
    <h1>Edição de Categoria</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('categories.update', $category) }}" method="post">
                    @method('PUT')
                    {{ csrf_field() }}
            <input type="hidden" name="categoria" value="{{ $category->id }}">    
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Edição das informações de categoria</h4>

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
                        {{-- input de categoria--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Categoria</label>
                                <input type="text" id="categoria" class="form-control form-control-sm" name="categoria" id="categoria" value="{{ $category->categoria }}">
                            </div>
                        </div>
                        @error('categoria')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                        {{-- input de armamento--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Armamento</label>
                                <input type="text" id="armamento" class="form-control form-control-sm" name="armamento" id="armamento" value="{{ $category->armamento }}">
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
