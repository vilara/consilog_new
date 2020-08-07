@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Perfil de {{ $user->name }}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('details.store', $user->id) }}" method="post">
                    @method('POST')
                    {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">    
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Informaçẽs complementares para acesso ao sistema</h4>

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
                        {{-- input name --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome completo</label>
                                <input type="name" class="form-control form-control-sm" id="exampleInputEmail1" value="{{ $user->name }}"
                                    disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <!-- select posto grad-->
                            <div class="form-group">
                                <label>Posto / Grad</label>
                                <select class="form-control form-control-sm @error('postograd_id') is-invalid @elseif('') @else is-valid @enderror" id="postograd_id" name="postograd_id">
                                    <option value="">Selecione...</option>
                                    @foreach ($pg as $pg)
									<option value="{{ $pg->id }}"  @if(old('postograd_id')== $pg->id ) selected @endif>{{$pg->siglaPg}}</option>
                                    @endforeach
                                </select>
                                @error('postograd_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            {{-- input cpf--}}
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="cpf" class="form-control form-control-sm @error('cpf') is-invalid @else is-valid @enderror" id="cpf" value="{{ old('cpf') }}" name="cpf"  >
                                @error('cpf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            {{-- input idt--}}
                            <div class="form-group">
                                <label>Identidade Militar</label>
                                <input type="text" value="{{ old('idt') }}" class="form-control form-control-sm @error('idt') is-invalid @else is-valid @enderror " id="idt" name="idt">

                                @error('idt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- input nome de guerra --}}
                            <div class="form-group">
                                <label>Nome de Guerra</label>
                                <input type="text" class="form-control form-control-sm @error('nome_guerra') is-invalid @else is-valid @enderror" id="nome_guerra" name="nome_guerra" value="{{ old('nome_guerra') }}">
                                @error('nome_guerra')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <!-- select om -->
                            <div class="form-group">
                                <label>OM</label>
                                <select class="form-control form-control-sm @error('om_id') is-invalid @else is-valid @enderror" name="om_id" id="om_id">
                                    <option value="">Selecione...</option>
                                    @foreach ($om as $om)
									<option value="{{ $om->id }}"  @if(old('om_id')== $om->id ) selected @endif>{{$om->siglaOM}}</option>
                                    @endforeach
                                </select>
                                @error('om_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <!-- select função-->
                            <div class="form-group">
                                <label>Função</label>
                                <select class="form-control form-control-sm" name="funcao_id">
                                    <option value="">Selecione...</option>
                                    @foreach ($funcao as $funcao)
									<option value="{{ $funcao->id }}"  @if(old('funcao_id')== $funcao->id ) selected @endif>{{$funcao->siglaCg}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-md-3">
                            <!-- radio sexo-->
                            <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <div class="border pt-1 pl-3 mb-0" >
                                    <label class="radio-inline mr-3"><input type="radio" class="form-radio-input"
                                            name="sexo" id="sexo1" value="1" @if(old('sexo') == 1 ) checked @endif> Masculino</label>
                                    <label class="radio-inline"><input type="radio" class="form-radio-input" name="sexo"
                                            id="sexo2" value="2" @if(old('sexo') == 2 ) checked @endif> Feminino</label>
                                </div>
                                @error('sexo')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-md-3">
                            <!-- radio sit-->
                            <div class="form-group">
                                <label for="sit">Situação</label>
                                <div class="border pt-1 pl-3 mb-0 ">
                                    <label class="radio-inline mr-3"><input type="radio" class="form-radio-input" name="sit"
                                            id="sit1" value="1" @if(old('sit') == 1 ) checked @endif> Ativa</label>
                                    <label class="radio-inline"><input type="radio" class="form-radio-input" name="sit"
                                            id="sit2" value="2" @if(old('sit') == 2 ) checked @endif> Reserva</label>
                                </div>
                                @error('sit')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @foreach ($user->rolers as $per)
                            <div class="form-group col-md-2">
                                <label for="perfil">Perfil</label> <select class="form-control form-control-sm" id="perfil" disabled name="perfil">
                                    @foreach ($perfi as $perfil)

                                        <option value="{{ $perfil->id }}">{{ $perfil->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
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
