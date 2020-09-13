@extends('adminlte::page')


@section('title', 'Efetivo')

@section('content_header')
    <h1>Cadastro de Efetivo</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('efetivos.store') }}" method="post">
                @method('POST')
                {{ csrf_field() }}
                <div class="card card-fefault">
                    <div class="card-header">
                        <h4 class="card-title">Formulário para cadastro de Efetivo de {{ $category->armamento }}</h4>

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
                            <input type="hidden" class="form-control form-control-sm @error('irtaexcategory_id') is-invalid @enderror" name="irtaexcategory_id"   id="irtaexcategory_id"  value="{{ $category->id }}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Círculo</label>
                                    <input type="text" class="form-control form-control-sm @error('circulo') is-invalid @enderror" name="circulo"   id="circulo"  value="{{ old('circulo') }}">
                                    @error('circulo')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            {{-- input textarea--}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pessoal</label>
                                    <textarea rows="3" class="form-control form-control-sm @error('pessoal') is-invalid @enderror" name="pessoal"   id="pessoal"  >{{ old('pessoal') }}</textarea>
                                    @error('pessoal')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
    
                                <div class="form-group">
                                    <label>Posto / Grad</label>
                                    <select class="form-control form-control-sm @error('postograd_id') is-invalid  @enderror" id="postograd_id" name="postograd_id">
                                        <option value="">Selecione...</option>
                                        @foreach ($posto as $posto)
                                        <option value="{{ $posto->id }}"  @if(old('postograd_id')== $posto->id ) selected @endif>{{$posto->siglaPg}}</option>
                                        @endforeach
                                    </select>
                                    @error('postograd_id')
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
                    <a href="{{ route('efetivos.index') }}" type="submit" class="btn btn-success float-right">
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
