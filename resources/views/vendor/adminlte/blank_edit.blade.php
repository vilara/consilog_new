@extends('adminlte::page')


@section('title', '%%')

@section('content_header')
    <h1>%% de {{ $%%->%% }}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('%%', $%%) }}" method="post">
                    @method('PUT')
                    {{ csrf_field() }}
            <input type="hidden" name="%%" value="{{ $%%->id }}">    
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Edição das informações %%</h4>

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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>%%</label>
                                <input type="text" id="%%" class="form-control form-control-sm" name="%%" id="%%" value="{{ $%%->%% }}">
                            </div>
                        </div>
                        @error('%%')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <!-- select posto grad-->
                            <div class="form-group">
                                <label>%%</label>
                                <select class="form-control form-control-sm @error('%%') is-invalid  @enderror" id="%%" %%="%%">
                                    <option value="">Selecione...</option>
                                        @foreach ($%% as $%%)
									        <option value="{{ $%%->id }}"  @if($%% == $%%->id) selected @endif>{{$%%->%%}}</option>
                                        @endforeach
                                </select>
                                @error('%%')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- radio %%-->
                            <div class="form-group">
                                <label for="%%">%%</label>
                                <div class="border pt-1 pl-3 mb-0 ">
                                    <label class="radio-inline mr-3"><input type="radio" class="form-radio-input" name="%%"
                                            id="sit1" value="1" @if($%% == "%") checked @endif> %%</label>
                                    <label class="radio-inline"><input type="radio" class="form-radio-input" name="%%"
                                            id="sit2" value="2" @if($%% == "%") checked @endif> %%</label>
                                </div>
                                @error('%%')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        @foreach ($%%->%% as $per)
                            <div class="form-group col-md-2">
                                <label for="%%">%%</label> <select class="form-control form-control-sm" id="%%" @cannot('update') disabled @endcannot  name="%%">
                                    @foreach ($perfi as $%%)

                                        <option @if($%%->%%[0] == $%%->id ) selected @endif value="{{ $%%->id }}">{{ $%%->%% }}</option>

                                    @endforeach
                                </select>
                            </div>
                        @endforeach

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
