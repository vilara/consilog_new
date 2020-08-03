@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Perfil de {{ $user->name }}</h1>
@stop

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h4 class="card-title">Informações obrigatórias</h4>

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
          <div class="col-md-12">
            <div class="form-group">
              <label>E-mail</label>
              <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $user->email }}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Nova senha</label>
              <input type="email" class="form-control" id="exampleInputEmail1" form-control=" @error('password') is-invalid @enderror" name="password"  >

              @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
              <small id="emailHelp" class="form-text text-danger">Preencha somente se desejar alterar a senha!</small>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Repetir nova senha</label>
              <input type="email" class="form-control" id="exampleInputEmail1"   name="password_confirmation"  >
            </div>
          </div>

        </div>
        <!-- /.row -->

      </div>
    </div>

    <div class="card card-info">
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
                <input type="name" class="form-control" id="exampleInputEmail1" value="{{ $user->name }}" disabled="disabled">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <!-- select posto grad-->
              <div class="form-group">
                <label>Select</label>
                <select	class="form-control" id="postograd_id" name="postograd_id">
                  @foreach ($pg as $pg)
                    @if ($user->id == $pg->id )
                  <option value="{{ $pg->id }}" selected="selected">{{$pg->siglaPg}}</option>
                    @else
                  <option value="{{ $pg->id }}">{{$pg->siglaPg}}</option>
                    @endif
                  @endforeach
               </select>
              </div>
            </div>
            <div class="col-md-2">
              {{-- input cpf--}}
              <div class="form-group">
                <label>CPF</label>
                <input type="cpf" class="form-control" id="cpf" form-control=" @error('cpf') is-invalid @enderror" name="cpf"  >
                
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
                <input type="idt" class="form-control" id="idt" form-control=" @error('idt') is-invalid @enderror" name="idt"  >
                
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
                <input type="nome_guerra" class="form-control" id="nome_guerra" value="{{ $user->nome_guerra }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <!-- select om-->
              <div class="form-group">
                <label>Organização Militar {{ $om }}</label>
                <select	class="form-control" id="om" name="om">
                  @foreach ($om as $oms)
                    @if ($user->id == $oms->id )
                  <option value="{{ $oms->id }}" selected="selected">{{$oms->siglaOm}}</option>
                    @else
                  <option value="{{ $oms->id }}">{{$oms->siglaOm}}</option>
                    @endif
                  @endforeach
               </select>
              </div>
            </div>
          </div>  
          <!-- /.row -->

        </div>

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
    <script> console.log('Hi!'); </script>
@stop
