<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'veiculos';
?>

<div class="">      
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Veiculo</a>
</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>

<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			<form id="form">
			<div class="modal-body">

					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="exampleInputEmail1">Marca</label>
								<input type="text" class="form-control" id="marca" name="marca" placeholder="Marca" required>    
							</div> 	
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Placa</label>
								<input type="text" class="form-control" id="placa" name="placa" placeholder="Placa" >    
							</div> 	
						</div>

					</div>
							
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Ano</label>
								<input type="text" class="form-control" id="ano" name="ano" placeholder="Ano" >    
							</div> 	
						</div>

						<div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Cor</label>
								<input type="text" class="form-control" id="cor" name="cor" placeholder="Cor" >    
							</div> 	
						</div>

                        <div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">km</label>
								<input type="text" class="form-control" id="km" name="km" placeholder="km" >    
							</div> 	
						</div>

						<div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Retorno</label>
								<input type="date" class="form-control" id="data_retorno" name="data_retorno" placeholder="Retorno" >    
							</div> 	
						</div>

						<div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Ultimo Servico</label>
								<input type="text" class="form-control" id="ultimo_servico" name="ultimo_sevico" placeholder="Ultimo Servico" >    
							</div> 	
						</div>

						<div class="col-md-8">
							<div class="form-group">
								<label for="exampleInputEmail1">Alerta</label>
								<input type="text" class="form-control" id="alertado" name="alertado" placeholder="km" >    
							</div> 	
						</div>
						
					</div>
					
						<input type="hidden" name="id" id="id">

					<br>
					<small><div id="mensagem" align="center"></div></small>
				</div>

				<div class="modal-footer">      
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>

			
		</div>
	</div>
</div>

<!-- Modal Dados-->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="marca_dados"></span></h4>
				<button id="btn-fechar-perfil" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			
			<div class="modal-body">

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Placa: </b></span>
						<span id="placa_dados"></span>
					</div>	
								
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
											
					<div class="col-md-12">							
						<span><b>Retorno: </b></span>
						<span id="data_retorno_dados"></span>
					</div>	

					<div class="col-md-12">							
						<span><b>Ultimo Servico: </b></span>
						<span id="ultimo_servico_dados"></span>
					</div>	

					<div class="col-md-12">							
						<span><b>Alerta: </b></span>
						<span id="alertado_dados"></span>
					</div>					

				</div>			

			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>



