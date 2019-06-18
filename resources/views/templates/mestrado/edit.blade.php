@extends('adminlte::page')
	@section('content')
	<!-- Content Header (Page header) -->
	<?php //dd($errors);?>
    <section class="content-header">
      <h1>
        Teses de mestrado
        <small>editar tese</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Teses de mestrado</a></li>
        <li class="active">Editar</li>
      </ol>
    </section>
    <section class="content">
    	<form method="post" action="{{ route('atualizar_mestrado',['id'=>$mestrado->id])}}">
	    {{ csrf_field() }}
	    	<div class="row">
		        <div class="col-md-12">
			      	<div class="box box-primary">
			            <div class="box-header">
			              <h3 class="box-title">Docentes e discentes engajados</h3>
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
			            <!-- /.box-header -->
	              		<div class="box-body">
	              			<div class="row">
	              				<div class="col-md-4">
	              					<label>Professor orientador</label>
		              				<div class="form-group has-feedback {{ $errors->has('orientador') ? 'has-error' : '' }}">
			              				<select id="orientador" name="orientador" class="form-control select2" 
			              				 data-placeholder="Selecione um professor" 
			              				 >
			              					<option></option>
			              					@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('aluno'))
			              						@foreach($professores as $professor)
			                        				@if($professor->id == $mestrado->orientador_mestrado_id)
			                        					<option value="{{ $professor->id }}" selected="selected">{{ $professor->name }}</option>
			                        				@else
			                        					<option value="{{ $professor->id }}">{{ $professor->name }}</option>
			                        				@endif
			                        			@endforeach
			              					@else
			              						@foreach($professores as $professor)
			                        				@if($professor->id == $mestrado->orientador_mestrado_id)
			                        					<option value="{{ $professor->id }}" selected="selected">{{ $professor->name }}</option>
			                        				@endif
			                        			@endforeach
			              					@endif
		                        		</select>
		                        		@if ($errors->has('orientador'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('orientador') }}</strong>
					                        </span>
					                    @endif
		              				</div>
		              			</div>
		              			<div class="col-md-4">
		              				<div class="form-group">
			              				<label>Professor coorientador</label>
			              				<select id="coorientador" name="coorientador" class="form-control select2" 
			              				data-placeholder="Selecione um professor" >
			              					<option></option>
			              					@foreach($professores as $professor)
			                        			@if($professor->id == $mestrado->coorientador_mestrado_id)
			                        				<option value="{{ $professor->id }}" selected="selected">{{ $professor->name }}</option>
			                        			@else
			                        				<option value="{{ $professor->id }}">{{ $professor->name }}</option>
			                        			@endif
			                        		@endforeach
			              				</select>
		              				</div>
		              			</div>
		              			<div class="col-md-4">
		              				<div class="form-group has-feedback {{ $errors->has('discente') ? 'has-error' : '' }}">
			              				<label>Alunos envolvidos</label>
			              				<select id="discente" name="discente" class="form-control select2" 
			              				 data-placeholder="">
			              				 <option></option>
			              				 @if(Auth::user()->hasRole('admin'))
			                        		@foreach($alunos as $aluno)
			                        			@if($mestrado->aluno_mestrado_id == $aluno->id)
			                        				<option selected="selected" value="{{$aluno->id}}">{{ $aluno->name }}</option>
			                        			@else
			                        			<option value="{{$aluno->id}}">{{ $aluno->name }}</option>
			                        			@endif
			                        		@endforeach
			                        	@else
			                        		@foreach($alunos as $aluno)
			                        			@if($aluno->id == $mestrado->aluno_mestrado_id)
			                        			<option selected="selected" value="{{$aluno->id}}">{{ $aluno->name }}</option>
			                        			@endif
			                        		@endforeach
			                        	@endif
		                        		</select>
		                        		@if ($errors->has('discentes'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('discentes') }}</strong>
					                        </span>
					                    @endif
		              				</div>
		              			</div>
	              			</div>
	              		</div>
					</div>
				</div>
			</div>
			<div class="row">
		        <div class="col-md-6">
		          	<div class="box">
			            <div class="box-header">
			              <h3 class="box-title">Dados sobre a tese</h3> 
			            </div>
			            <!-- /.box-header -->
	              		<div class="box-body">
	              			<div class="row">
	              				<div class="col-md-12">
	              					<label for="titulo_mestrado">Título</label>
	              					<div class="form-group has-feedback {{ $errors->has('titulo_mestrado') ? 'has-error' : '' }}">
		              					<input type="text" class="form-control" name="titulo_mestrado" id="titulo_mestrado" placeholder="" value="{{$mestrado->titulo_mestrado}}">
										@if ($errors->has('titulo_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('titulo_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	              				</div>
	          					
	          					<div class="col-md-6">
	          						<label>Semestre de início</label>
	          						<div class="form-group has-feedback {{ $errors->has('semestre_inicio_mestrado') ? 'has-error' : '' }}">
		          						<select class="form-control" id="semestre_inicio_mestrado" name="semestre_inicio_mestrado">
		          							<option value="">Selecione</option>
		          							<?php
		          								for ($semester = 1; $semester < 3; $semester++){
		          									if ($semester == $mestrado->semestre_inicio_mestrado){
		          										echo "<option value='" . $semester . "' selected = 'selected'>" . $semester . "º semestre</option>";
		          									}else{
		          										echo "<option value='" . $semester . "'>" . $semester . "º semestre</option>";
		          									}
		          								}
		          							?>
		          						</select>
		          						@if ($errors->has('semestre_inicio_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('semestre_inicio_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	          					</div>
	          					<div class="col-md-6">
	          						<label>Ano de início</label>
	          						<div class="form-group has-feedback {{ $errors->has('ano_inicio_mestrado') ? 'has-error' : '' }}">
		          						<select class="form-control" id="ano_inicio_mestrado" name="ano_inicio_mestrado">
		          							<option value="">Selecione</option>
		          							<?php
		          								for ($year = 2010; $year < 2022; $year++){
		          									if ($year == $mestrado->ano_inicio_mestrado){
		          										echo "<option value='" . $year . "' selected = 'selected'>" . $year . "</option>";
		          									}else{
		          										echo "<option value='" . $year . "'>" . $year . "</option>";
		          									}
		          								}
		          							?>
		          						</select>
		          						@if ($errors->has('ano_inicio_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('ano_inicio_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	          					</div>
	          					<div class="col-md-6">
	          						<label>Abordagem</label>
	          						<div class="form-group has-feedback {{ $errors->has('abordagem_mestrado') ? 'has-error' : '' }}">
		          						<select class="form-control" id="abordagem_mestrado" name="abordagem_mestrado">
		          							<option value="">Selecione</option>
		          							@foreach($abordagem as $item)
		          								@if($item->id == $mestrado->abordagem_mestrado_id)
		          									<option value="{{$item->id}}" selected="selected">{{$item->descricao}}</option>
		          								@else
		          									<option value="{{$item->id}}">{{$item->descricao}}</option>
		          								@endif
		          							@endforeach
		          						</select>
		          						@if ($errors->has('abordagem_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('abordagem_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	          					</div>

	          					<div class="col-md-6">
	          						<label>Area</label>
	          						<div class="form-group has-feedback {{ $errors->has('area_mestrado') ? 'has-error' : '' }}">
		          						<select class="form-control" id="area_mestrado" name="area_mestrado">
		          							<option value="">Selecione</option>
		          							@foreach($area as $item)
		          								@if($item->id == $mestrado->area_mestrado_id)
		          									<option value="{{$item->id}}" selected="selected">{{$item->descricao}}</option>
		          								@else
		          									<option value="{{$item->id}}">{{$item->descricao}}</option>
		          								@endif
		          							@endforeach
		          						</select>
		          						@if ($errors->has('area_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('area_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	          					</div>

	          					<div class="col-md-6">
	          						<label>Natureza</label>
	          						<div class="form-group has-feedback {{ $errors->has('natureza_mestrado') ? 'has-error' : '' }}">
		          						<select class="form-control" id="natureza_mestrado" name="natureza_mestrado">
		          							<option value="">Selecione</option>
		          							@foreach($natureza as $item)
		          								@if($item->id == $mestrado->natureza_mestrado_id)
		          									<option value="{{$item->id}}" selected="selected">{{$item->descricao}}</option>
		          								@else
		          									<option value="{{$item->id}}">{{$item->descricao}}</option>
		          								@endif
		          							@endforeach
		          						</select>
		          						@if ($errors->has('natureza_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('natureza_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	          					</div>
	          					<div class="col-md-6">
	          						<label>Objetivo</label>
	          						<div class="form-group has-feedback {{ $errors->has('objetivo_mestrado') ? 'has-error' : '' }}">
		          						<select class="form-control" id="objetivo_mestrado" name="objetivo_mestrado">
		          							<option value="">Selecione</option>
		          							@foreach($objetivo as $item)
		          								@if($item->id == $mestrado->objetivo_mestrado_id)
		          									<option value="{{$item->id}}" selected="selected">{{$item->descricao}}</option>
		          								@else
		          									<option value="{{$item->id}}">{{$item->descricao}}</option>
		          								@endif
		          							@endforeach
		          						</select>
		          						@if ($errors->has('objetivo_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('objetivo_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	          					</div>
	          					<div class="col-md-6">
	          						<label>Procedimento</label>
	          						<div class="form-group has-feedback {{ $errors->has('procedimento_mestrado') ? 'has-error' : '' }}">
		          						<select class="form-control" id="procedimento_mestrado" name="procedimento_mestrado">
		          							<option value="">Selecione</option>
		          							@foreach($procedimento as $item)
		          								@if($item->id == $mestrado->procedimentos_mestrado_id)
		          									<option value="{{$item->id}}" selected="selected">{{$item->descricao}}</option>
		          								@else
		          									<option value="{{$item->id}}">{{$item->descricao}}</option>
		          								@endif
		          							@endforeach
		          						</select>
		          						@if ($errors->has('procedimento_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('procedimento_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	          					</div>
	          					<div class="col-md-6">
	          						<label>Sub-área</label>
	          						<div class="form-group has-feedback {{ $errors->has('subarea_mestrado') ? 'has-error' : '' }}">
		          						<select class="form-control" id="subarea_mestrado" name="subarea_mestrado">
		          							<option value="">Selecione</option>
		          								@foreach($subarea as $item)
			          								@if($item->id == $mestrado->sub_area_mestrado_id)
			          									<option value="{{$item->id}}" selected="selected">{{$item->descricao}}</option>
			          								@else
		          										<option value="{{$item->id}}">{{$item->descricao}}</option>
		          									@endif
		          								@endforeach
		          						</select>
		          						@if ($errors->has('subarea_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('subarea_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	          					</div>
	          					<div class="col-md-6">
	          						<label>Link Sisbin</label>
	          						<div class="form-group has-feedback {{ $errors->has('sisbin_mestrado') ? 'has-error' : '' }}">
		          						<input type='text' class="form-control" id="sisbin_mestrado" name="sisbin_mestrado" value="{{$mestrado->sisbin_mestrado}}">
		          							
		          						@if ($errors->has('sisbin_mestrado'))
					                        <span class="help-block">
					                            <strong>{{ $errors->first('sisbin_mestrado') }}</strong>
					                        </span>
					                    @endif
	          						</div>
	          					</div>

	          					<div class="col-md-12">
	          						<div class="form-group">
			                  		<label>Resumo do projeto</label>
			                  		<textarea class="form-control" id="resumo_mestrado" name="resumo_mestrado" rows="5" placeholder=""><?php
		              						echo $mestrado->resumo_mestrado;
										?>
			                  		</textarea>
			                	</div>
	          					</div>
			                </div>
	              		</div>
	              	</div>
	            </div>
	            <div class="col-md-6">
		          	<div class="box">
			            <div class="box-header">
			              <h3 class="box-title">Status do projeto</h3>
			            </div>
			            <div class="box-body">
				         	<div class="form-group">
				         	<?php
				         		$array = [
				         			1 => "Projeto em fase de concepção",
				         			2 => "Projeto em fase de desenvolvimento",
				         			3 => "Projeto em fase de geração de resultados",
				         			4 => "Projeto em fase de publicação",
				         			5 => "Projeto publicado",
				         			6 => "Projeto cancelado",
				         		];

		          				for ($status = 1; $status < 7; $status++){
		          					if ($status == $mestrado->status_mestrado){
		          						echo "<div class='radio'>
												<label>
									  				<input type='radio' name='status_mestrado' id='optionsRadios" . $status . "' value='" . $status . "' checked='checked'>" . $array[$status] . "
												</label>
											</div>";
		          					}else{
		          						echo "<div class='radio'>
												<label>
									  				<input type='radio' name='status_mestrado' id='optionsRadios" . $status . "' value='" . $status . "'>" . $array[$status] . "
												</label>
											</div>";
		          					}
		          				}
				         	?>
	                		</div>
	                		<div class="form-group">
	                			<div class="checkbox">
				                    <label>
				                      <input type="checkbox">
				                      Ocultar em consultas realizadas por usuários não cadastrados
				                    </label>
				                  </div>
	                		</div>
	                		<div class="row" style='margin-top: 65px'>
	                			<div class="form-group">
		                			<div class="col-md-12">
						       			<div class="text-center">
						          			<button type="submit" class="btn btn-block btn-primary btn-lg">Confirmar cadastro</button>
							        	</div>
						       		</div>
	                			</div>	
	                		</div>
	                	</div>
            		</div>
	        	</div>
		</form>
	</section>
	@stop
	@section('js')
	<script type="text/javascript">
		$('.select2').select2({
			width:'100%'
		});
    	//iCheck for checkbox and radio inputs
	    $('input[type="checkbox"], input[type="radio"]').iCheck({
	      checkboxClass: 'icheckbox_square-blue',
	      radioClass   : 'iradio_square-blue',
	      increaseArea: '20%' 
	    })
	    
	</script>
	@stop
