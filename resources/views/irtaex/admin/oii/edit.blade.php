@extends('adminlte::page')


@section('title', 'OII')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-12">
            <div class="info-box ">
                <span class="info-box-icon bg-olive"><i class="fas fa-bullseye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        <h1>Edição de OII</h1>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('oiis.update', $oii) }}" method="post">
                @method('PUT')
                {{ csrf_field() }}
                <input type="hidden" name="categoria" value="{{ $oii->id }}">
                <div class="card card-success">
                    <div class="card-header bg-olive">
                        <h4 class="card-title">Edição das informações de OII</h4>

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
                            {{-- input textarea--}}
                            <div class="col-md-3">
                                {{-- input de categoria--}}
                                <div class="form-group">
                                    <label>OII</label>
                                    <input type="text" id="oii" class="form-control form-control-sm" name="oii" id="oii"
                                        value="{{ $oii->oii }}">
                                    @error('oii')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tarefa</label>
                                    <textarea rows="3"
                                        class="form-control form-control-sm @error('tarefa') is-invalid @enderror"
                                        name="tarefa" id="tarefa">{{ $oii->tarefa }}</textarea>
                                    @error('tarefa')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Condição</label>
                                    <textarea rows="3"
                                        class="form-control form-control-sm @error('condicao') is-invalid @enderror"
                                        name="condicao" id="condicao">{{ $oii->condicao }}</textarea>
                                    @error('condicao')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Padrão Mínimo</label>
                                    <textarea rows="3"
                                        class="form-control form-control-sm @error('padraminimo') is-invalid @enderror"
                                        name="padraminimo" id="padraminimo">{{ $oii->padraminimo }}</textarea>
                                    @error('padraminimo')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-2">
                                <label for="irtaexcategory_id">Categoria</label>
                                 <select class="form-control form-control-sm" id="irtaexcategory_id"  name="irtaexcategory_id">
                                    @foreach ($category as $category)

                                        <option @if($category->id == $oii->irtaexcategory_id ) selected @endif value="{{ $category->id }}">{{ $category->armamento }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="card-footer">
                            <button type="submit" class="btn bg-olive">Atualizar</button>
                            <button type="submit" class="btn bg-olive float-right">Cancelar</button>
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
