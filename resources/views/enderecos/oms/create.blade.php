@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastro de endereço de OM : {{ $om->cep1 }} </h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('oms.enderecos.store', $om->id) }}" method="post">
                @method('POST')
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
                            {{-- input cep da OM --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CEP da OM</label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('cep') is-invalid @enderror" name="cep"
                                        id="cep1"  value="{{ old('cep') }}">
                                    @error('cep')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- input Logradouro --}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Logradouro</label>
                                    <input type="rua"
                                        class="form-control form-control-sm @error('rua') is-invalid @enderror" name="rua"
                                        id="rua" value="{{ old('rua') }}">
                                    @error('rua')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- input Número --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input type="numeroEndereco"
                                        class="form-control form-control-sm @error('numeroEndereco') is-invalid @enderror"
                                        name="numeroEndereco" id="numeroEndereco" value="{{ old('numeroEndereco') }}">
                                    @error('numeroEndereco')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            {{-- input Complemento --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="complemento"
                                        class="form-control form-control-sm @error('complemento') is-invalid @enderror"
                                        name="complemento" id="complemento" value="{{ old('complemento') }}">
                                    @error('complemento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- input Bairro --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="bairro"
                                        class="form-control form-control-sm @error('bairro') is-invalid @enderror"
                                        name="bairro" id="bairro" value="{{ old('bairro') }}">
                                    @error('bairro')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            {{-- input Cidade --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="cidade"
                                        class="form-control form-control-sm @error('cidade') is-invalid @enderror"
                                        name="cidade" id="cidade" value="{{ old('cidade') }}">
                                    @error('cidade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- input Estado --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input type="estado"
                                        class="form-control form-control-sm @error('estado') is-invalid @enderror"
                                        name="estado" id="estado" value="{{ old('estado') }}">
                                    @error('estado')
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
        $(document).ready(function() {
          
            $('#cep1').mask('99999-999');

            function limpa_formulário_cep1() {
                // Limpa valores do formulário de cep1.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
                $("#numeroEndereco").val("");
                $("#cep1").val("");
                $("#complemento").val("");
            }
            //	limpa_formulário_cep1();
            $("#cep1").blur(function() {

                var cep1 = $(this).val().replace(/\D/g, '');
                if (cep1 != "") {
                    $.getJSON("https://viacep.com.br/ws/" + cep1 + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.uf);
                            $("#cep1").val(cep1);

                        } //end if.
                        else {
                            //cep1 pesquisado não foi encontrado.
                            limpa_formulário_cep1();
                            alert("CEP não encontrado.");
                        }
                    });
                    // alert(cep1);
                }
            });

            // Acesso ao webservice dos correios fim
            // -------------------

        });

    </script>
@stop
