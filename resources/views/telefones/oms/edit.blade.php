@extends('adminlte::page')


@section('title', 'Telefone OM')

@section('content_header')
    <h1>Cadastro de Telefone de OM : {{ $om->nomeOm }} </h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('oms.telefones.update', [$om->id, $telefone->id]) }}" method="post">
                @method('PUT')
                {{ csrf_field() }}
                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="card-title">Cadastro</h4>

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
                            {{-- input DDD da OM --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DDD</label>
                                    <input type="ddd"
                                        class="form-control form-control-sm @error('ddd') is-invalid @enderror" name="ddd"
                                        id="ddd"  value="{{ $telefone->ddd }}">
                                    @error('ddd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             {{-- input Nr da OM --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input type="numero"
                                        class="form-control form-control-sm @error('numero') is-invalid @enderror" name="numero"
                                        id="numero" value="{{ $telefone->numero }}">
                                    @error('numero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- input Logradouro --}}
                        <div class="row">
                            <div class="col-md-6">
                                <!-- select tel Tipo-->
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select class="form-control form-control-sm @error('tipo_id') is-invalid  @enderror" id="tipo_id" name="tipo_id">
                                        <option value="">Selecione...</option>
                                        @foreach ($tipoTel as $tipoTel)
                                        <option value="{{ $tipoTel->id }}"  @if($telefone->tipo_id == $tipoTel->id ) selected @endif>{{$tipoTel->telTipo}}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- select Sec -->
                                <div class="form-group">
                                    <label>Seção</label>
                                    <select class="form-control form-control-sm @error('section_id') is-invalid  @enderror" id="section_id" name="section_id">
                                        <option value="">Selecione...</option>
                                        @foreach ($secao as $secao)
                                        <option value="{{ $secao->id }}"  @if($telefone->section_id == $secao->id ) selected @endif>{{$secao->siglaSecao}}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
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
                    <button type="submit" class="btn btn-success">Editar</button>
                    <a href="{{ route('oms.telefones.index', $om->id) }}" type="submit" class="btn btn-success float-right">
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
        $('#ddd').mask('(99)');
		$('#numero').mask('99999-9999');
        });
    </script>
@stop
