@extends('adminlte::page')


@section('title', 'OII')

@section('content_header')
    <h1>Cadastro de OII</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('oiis.store') }}" method="post">
                @method('POST')
                {{ csrf_field() }}
                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="card-title">Formulário para cadastro de OII</h4>

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
                            {{-- input --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>OII</label>
                                    <input type="text" class="form-control form-control-sm @error('oii') is-invalid @enderror" name="oii"   id="oii"  value="{{ old('oii') }}">
                                    @error('oii')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            {{-- input textarea--}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tarefa</label>
                                    <textarea rows="3" class="form-control form-control-sm @error('tarefa') is-invalid @enderror" name="tarefa"   id="tarefa"  >{{ old('tarefa') }}</textarea>
                                    @error('tarefa')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                               {{-- input textarea--}}
                               <div class="col-md-3">
                                <div class="form-group">
                                    <label>Condição</label>
                                    <textarea rows="3" class="form-control form-control-sm @error('condicao') is-invalid @enderror" name="condicao"   id="tarefa"  >{{ old('condicao') }}</textarea>
                                    @error('condicao')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                               {{-- input textarea--}}
                               <div class="col-md-3">
                                <div class="form-group">
                                    <label>Padrão Mínimo</label>
                                    <textarea rows="3" class="form-control form-control-sm @error('padraminimo') is-invalid @enderror" name="padraminimo"   id="tarefa"  >{{ old('padraminimo') }}</textarea>
                                    @error('padraminimo')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select class="form-control form-control-sm @error('irtaexcategory_id') is-invalid  @enderror" id="irtaexcategory_id" name="irtaexcategory_id">
                                        <option value="">Selecione...</option>
                                        @foreach ($category as $category)
                                        <option value="{{ $category->id }}"  @if(old('irtaexcategory_id')== $category->id ) selected @endif>{{$category->armamento}}</option>
                                        @endforeach
                                    </select>
                                    @error('irtaexcategory_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                    <a href="{{ route('oiis.index') }}" type="submit" class="btn btn-success float-right">
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
        $(document).ready(function() {
          
            $('#%%').mask('99999-999');

            

        });
    </script>
@stop
