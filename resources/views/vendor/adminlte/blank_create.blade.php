@extends('adminlte::page')


@section('title', '%%')

@section('content_header')
    <h1>Cadastro de %%</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('%%', $%%) }}" method="post">
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
                            {{-- input --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>%%</label>
                                    <input type="text" class="form-control form-control-sm @error('%%') is-invalid @enderror" name="%%"   id="%%"  value="{{ old('%%') }}">
                                    @error('%%')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- select posto grad--> 
                        
                        <div class="row">
                            {{-- select --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>%%</label>
                                    <select class="form-control form-control-sm @error('postograd_id') is-invalid  @enderror" id="postograd_id" name="postograd_id">
                                        <option value="">Selecione...</option>
                                        @foreach ($%% as $%%)
                                        <option value="{{ $%%->id }}"  @if(old('%%')== $%%->id ) selected @endif>{{$%%->%%}}</option>
                                        @endforeach
                                    </select>
                                    @error('%%')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <!-- radio -->
                                <div class="form-group">
                                    <label for="%%">%%</label>
                                    <div class="border pt-1 pl-3 mb-0" >
                                        <label class="radio-inline mr-3"><input type="radio" class="form-radio-input"
                                                name="%%" id="%%1" value="1" @if(old('%%') == 1 ) checked @endif> %%</label>
                                        <label class="radio-inline"><input type="radio" class="form-radio-input" name="%%"
                                                id="%%2" value="2" @if(old('%%') == 2 ) checked @endif> %%</label>
                                    </div>
                                    @error('%%')
                                    <span class="invalid-feedback" style="display: block;" role="alert">
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
                    <a href="{{ route('%%') }}" type="submit" class="btn btn-success float-right">
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
