@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Perfil de {{ $user->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('usuarios.store', $user->id) }}" method="post">
                    @method('POST')
                    {{ csrf_field() }}
           {{--  <div class="card card-success"> --}}
             {{--    <div class="card-header">
                    <h4 class="card-title">Informações obrigatórias</h4>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div> --}}

                <!-- /.card-header -->
                {{-- <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nova senha</label>
                                <input type="email" class="form-control form-control-sm" id="exampleInputEmail1"
                                    form-control form-control-sm=" @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <small id="emailHelp" class="form-text text-danger">Preencha somente se desejar alterar a
                                    senha!</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Repetir nova senha</label>
                                <input type="email" class="form-control form-control-sm" id="exampleInputEmail1"
                                    name="password_confirmation">
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->

                </div>
            </div>--}}

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
                                <select class="form-control form-control-sm" id="postograd_id" name="postograd_id">
                                    <option value="">Selecione...</option>
                                    @foreach ($pg as $pg)
                                        @if ($user->id == $pg->id)
                                            <option value="{{ $pg->id }}" selected="selected">{{ $pg->siglaPg }}</option>
                                        @else
                                            <option value="{{ $pg->id }}">{{ $pg->siglaPg }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            {{-- input cpf--}}
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="cpf" class="form-control form-control-sm" id="cpf"
                                    form-control form-control-sm=" @error('cpf') is-invalid @enderror" name="cpf">

                                @error('cpf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <small id="cpfHelp" class="form-text text-danger">Preencha apenas com números!</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            {{-- input idt--}}
                            <div class="form-group">
                                <label>Identidade Militar</label>
                                <input type="idt" class="form-control form-control-sm" id="idt"
                                    form-control form-control-sm=" @error('idt') is-invalid @enderror" name="idt">

                                @error('idt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <small id="idthelp" class="form-text text-danger">Preencha apenas com números!</small>
                            </div>
                        </div>
                        {{-- input nome de guerra --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome de Guerra</label>
                                <input type="nome_guerra" class="form-control form-control-sm" id="nome_guerra"
                                    value="{{ $user->nome_guerra }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <!-- select om -->
                            <div class="form-group">
                                <label>OM</label>
                                <select class="form-control form-control-sm" name="om" id="om">
                                    @foreach ($om as $om)
                                        @if ($user->id == $om->id)
                                            <option value="{{ $om->id }}" selected="selected">{{ $om->siglaOM }}</option>
                                        @else
                                            <option value="{{ $om->id }}">{{ $om->siglaOM }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <!-- select função-->
                            <div class="form-group">
                                <label>Select</label>
                                <select class="form-control form-control-sm">
                                    @foreach ($funcao as $funcao)
                                        @if ($user->id == $funcao->id)
                                            <option value="{{ $funcao->id }}" selected="selected">{{ $funcao->siglaCg }}
                                            </option>
                                        @else
                                            <option value="{{ $funcao->id }}">{{ $funcao->siglaCg }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-md-3">
                            <!-- radio sexo-->
                            <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <div class="border pt-1 pl-3 mb-0 ">
                                    <label class="radio-inline mr-3"><input type="radio" class="form-radio-input"
                                            name="sexo" id="sexo1" value="1" @if ($user->sexo == 1) {{ 'checked="checked"' }} @endif
                                        > Masculino</label>
                                    <label class="radio-inline"><input type="radio" class="form-radio-input" name="sexo"
                                            id="sexo2" value="2" @if ($user->sexo == 2)
                                        {{ 'checked="checked"' }} @endif> Feminino</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <!-- radio sit-->
                            <div class="form-group">
                                <label for="sit">Situação</label>
                                <div class="border pt-1 pl-3 mb-0 ">
                                    <label class="radio-inline mr-3"><input type="radio" class="form-radio-input" name="sit"
                                            id="sit1" value="1" @if ($user->sit == 1)
                                        {{ 'checked="checked"' }} @endif> Ativa</label>
                                    <label class="radio-inline"><input type="radio" class="form-radio-input" name="sit"
                                            id="sit2" value="2" @if ($user->sit == 2)
                                        {{ 'checked="checked"' }} @endif> Reserva</label>
                                </div>
                            </div>
                        </div>

                        @foreach ($user->rolers as $per)
                            <div class="form-group col-md-2">
                                <label for="perfil">Perfil</label> <select class="form-control form-control-sm" id="perfil" name="perfil">
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
