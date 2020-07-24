@extends('adminlte::page')

@section('title', 'Admin Usuários')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Painel de Administração</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Principal</a></li>
          <li class="breadcrumb-item active">Usuários</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Controle de Usuários</h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>ID</th>
                <th>Nome completo</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Cadastrado</th>
                <th>Modificado</th>
                <th>Ação</th>
              </tr>
              </thead>

              <tfoot>
              <tr>
                <th>ID</th>
                <th>Nome completo</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Cadastrado</th>
                <th>Modificado</th>
                <th>Ação</th>
              </tr>
              </tr>
              </tfoot>
            </table><!-- /table -->
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col 12-->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

@stop

@section('footer')
<div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0-pre
  </div>
  <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
@stop

@section('css')

@stop

@section('js')
    <script>
     $(document).ready(function () {

    	 $('#example2').DataTable({
    	        processing: true,
    	        serverSide: false,
    	        ajax: "{{ route('usuarios.index') }}",
    	        columns: [
           	        
    	        		{ data: 'id', name: 'id'},
        	            { data: 'name', name: 'name' },
        	            { data: 'email', name: 'email' },
        	            { data: 'roler', name: 'roler' },
        	            { data: 'created_at', name: 'created_at' },
        	            { data: 'updated_at', name : 'updated_at'},
        	            { data: 'action', name: 'action'},
                	    
        	            ],
        	            "columnDefs": [ {
            	            "targets": 5,
            	            "orderable": false,
            	            "searchable": false,
//             	            "render" : $.fn.dataTable.render.moment( 'Do MMM YYYYY' )
            	           
            	          } ],
//         	            "columnDefs": [
//         	            { targets: 5, "width": "16%", render: $.fn.dataTable.render.moment( 'Do MMM YYYYY' ) },
// 						],
//         	            "columnDefs": [ {
//         	            	 "targets": 6,
//             	            "orderable": false,
//             	            "searchable": false,
//             	            "visible": true,
//             	            "render" : function(data, row, type){
            	          
//                 	            return data; 
                	         
//                 	            }
//         	            }
//                 	      ], 

//         	            { data: 'id', name: 'id' },
//         	            { "render" : function(data){
//         	            	@can('update')
//             	            return '<input type="checkbox">1'+data; 
//             	            @elsecan('read')
//             	            return '<input  type="checkbox" disabled>'; 
//             	            @endcan
//             	            }},
        	            
//         	        ],
//         	        "columnDefs": [ {
//         	            "targets": 0,
//         	            "orderable": false,
//         	            "searchable": false,
//         	            "render": function (type, row ) {

//         	            }
//         	          } ],
//         	        columnDefs: [
//             	        {
//         	            targets: 1,
//         	            data: id,
//         	            render: function ( data, type, row ) {
//         	              if(row.id=="0"){
//         	                return '<a class="btn btn-primary" href="'+base_url+'/patient/show/'+data+'">'+user.id+'</a>'+
//         	                       '<a class="btn btn-success respatient" data-id="'+data+'" href="#" >'+user.id+'</a>';
//         	              }else{
//         	                return '<a class="btn btn-primary" href="'+base_url+'/patient/show/'+data+'">'+user.id+'</a>'+
//         	                       '<a class="btn btn-danger delpatient" data-id="'+data+'" href="#" >'+user.id+'</a>';
//         	              }
//         	            }

//         	          },
//         	          { "orderable": false, "targets": [ 4 ] },
//         	          { "bSearchable": false, "aTargets": [ 5 ] },
//         	          { "visible": true,  "targets": [6] }
//         	          ],

       		 language: {
       		        processing:     "Carregando dados...",
       		        search:         "Procurar&nbsp;:",
       		        loadingRecords: "Carregando dados...",
       		        info:           "Mostrando _START_ a _END_ de _TOTAL_ totais de dados",
       		        infoEmpty:      "Mostrando 0 a 0 de 0 totais de dados",
       		        zeroRecords:    "Nenhum resultado encontrado",
       		        emptyTable:     "Nenhum resultado encontrado",
       		        infoFiltered:   "(filtrado de _MAX_ totais de dados)",
       		        paginate: {
       		            first:      "Primeira",
       		            previous:   "Anterior",
       		            next:       "Pr&oacute;xima",
       		            last:       "&Uacuteltima"
       		        },
       		        },
    	    });

     });
    </script>
@stop
