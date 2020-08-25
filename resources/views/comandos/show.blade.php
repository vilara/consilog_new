@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
    <h1>OM:  {{ $comando->nomeCmdo }}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('comandos.store', $comando) }}" method="post">
                    {{ csrf_field() }}
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Edição de informações de Comando</h4>

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
                        {{-- input nome OM --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome da Comando</label>
                                <input type="text" class="form-control form-control-sm @error('nomeCmdo') is-invalid @enderror" name="nomeCmdo" id="name" value="{{ $comando->nomeCmdo }}" disabled>
                                @error('nomeCmdo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                           {{-- input sigla da OM --}}
                           <div class="col-md-6">
                            <div class="form-group">
                                <label>sigla do Comando</label>
                                <input type="text"class="form-control form-control-sm @error('siglaCmdo') is-invalid @enderror" name="siglaCmdo" id="siglaCmdo" value="{{ $comando->siglaCmdo }}"disabled>
                                @error('siglaCmdo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- input codomOm --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>codomOm do Cmdo</label>
                                <input type="text" class="form-control form-control-sm @error('codomOm') is-invalid @enderror" name="codomOm" id="codomOm" value="{{ $comando->codomOm }}"disabled>
                                @error('codomOm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                           {{-- input codugOm --}}
                           <div class="col-md-6">
                            <div class="form-group">
                                <label>codugOm</label>
                                <input type="text" class="form-control form-control-sm @error('codugOm') is-invalid @enderror" name="codugOm" id="codugOm" value="{{ $comando->codugOm }}"disabled>
                                @error('codugOm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <a href="{{ route('comandos.edit',$comando->id) }}" type="submit" class="btn btn-success">  {{ __('Editar') }}   </a>
                    <a href="{{ route('comandos.index') }}" type="submit" class="btn btn-success float-right">  {{ __('Cancelar') }}   </a>
                </div>
            </form>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
    <!-- /.card -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Organizações Militares Diretamente Subordinadas:</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <table id="subordinadas" class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Nome da OM</th>

                            </tr>

                        <tbody style="text-align: center;">
                            @foreach ($comando->omdsCmdo as $om)
                               
                                    <tr>
                                        <td>{{ $om->id }}</th>
                                        <td>{{ $om->nomeOm }}</th>
                                    </tr>
                            @endforeach
                        </tbody>
                        </thead>

                        <tfoot>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Om</th>

                            </tr>
                            </tr>
                        </tfoot>
                    </table><!-- /table -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col 12-->
    </div><!-- /.row -->





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
