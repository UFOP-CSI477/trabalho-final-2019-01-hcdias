@extends('adminlte::page')
	@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Teses de mestrado
        <small>pesquisar teses</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Teses de mestrado</a></li>
        <li class="active">Busca</li>
      </ol>
    </section>
    <section class="content">
	    <div class="row">
	        <div class="col-xs-12">
	          	<div class="box box-primary">
		            <div class="box-header">
		              <!-- <h3 class="box-title">Pesquisas Cadastradas</h3> -->
		            </div>
		          	@if(Session::has('success'))
		            	<div class="col-md-6 col-md-offset-3">
			            	<div class="alert alert-success alert-dismissible">
			                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                	<h4><i class="icon fa fa-check"></i> Sucesso</h4>
			                	{{ Session::get('success') }}
			              </div>
			           	</div>
		            @endif
		            <div class="box-body">
		              	<table id="mestrado" class="table table-bordered table-hover">
			              <thead>
			                <tr>
			                  <th>Título</th>
			                  <th class='text-center'>Status</th>
			                  <th class='text-center'>Opções</th>
			                </tr>
			                </thead>
			                <tbody>
								@foreach($mestrados as $mestrado)
									<tr>
										<td>{{ $mestrado->titulo_mestrado }}</td>
										<td class='text-center'>
											<span class="label alert-status-{{$mestrado->status->id}}">{{$mestrado->status->descricao}}</span>
										</td>
										<td class='text-center'>
											<a href="/mestrado/editar-mestrado/{{ $mestrado->id }}" title='Editar'>
			                  					<i class="fa fa-edit"></i>
			                  				</a>
			                  				
			                  				&nbsp;&nbsp;
			                  				<a href="/mestrado/detalhar-mestrado/{{ $mestrado->id }}" title='Visualizar'>
			                  					<i class="fa fa-eye"></i>
			                  				</a>

			                  				&nbsp;&nbsp;
											<a href="/mestrado/delete/{{ $mestrado->id }}" title='Apagar'>
			                  					<i class="fa fa-trash"></i>
			                  				</a>
			                  			</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	@stop
	@section('js')
	<script type="text/javascript">
		jQuery('#mestrado').DataTable({
			'dom': 'frt<"bottom" lp>',
	      	'paging'      : true,
	      	'lengthChange': false,
	      	'searching'   : true,
	      	'ordering'    : true,
	      	'info'        : true,
	      	'autoWidth'   : true,
	      	'columns' : [null,{'width':'10%'},{'width':'20%'}]
	    });
	</script>
	@stop
