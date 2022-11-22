<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];

$home = 'ocultar';

//grupo gerenciamento
$usuarios = 'ocultar';
$funcionarios = 'ocultar';
$veiculos = 'ocultar';

//grupo cadastros
$servicos = 'ocultar';
$cargos = 'ocultar';
$cat_servicos = 'ocultar';
$grupos = 'ocultar';
$acessos = 'ocultar';

//os / servico
$ordem_servico = 'ocultar';
$servicos = 'ocultar';

$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$permissao = $res[$i]['permissao'];
		
		$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome = $res2[0]['nome'];
		$chave = $res2[0]['chave'];
		$id = $res2[0]['id'];

		if($chave == 'home'){
			$home = '';
		}

		if($chave == 'usuarios'){
			$usuarios = '';
		}

		if($chave == 'funcionarios'){
			$funcionarios = '';
		}

		if($chave == 'veiculos'){
			$veiculos = '';
		}

		if($chave == 'servicos'){
			$servicos = '';
		}

		if($chave == 'cargos'){
			$cargos = '';
		}

		if($chave == 'cat_servicos'){
			$cat_servicos = '';
		}

		if($chave == 'grupos'){
			$grupos = '';
		}

		if($chave == 'acessos'){
			$acessos = '';
		}

		if($chave == 'ordem_servico'){
			$ordem_servico = '';
		}

		if($chave == 'servicos'){
			$servicos = '';
		}

	}

}

if($home != 'ocultar'){
	$pag_inicial = 'home';
}else if($atendimento == 'Sim'){
	$pag_inicial = 'ordem_servico';
}else{
	$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario' order by id asc limit 1");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){	
			$permissao = $res[0]['permissao'];		
			$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);		
			$pag_inicial = $res2[0]['chave'];		
	}
}

if($servicos == 'ocultar' and $cargos == 'ocultar' and $cat_servicos == 'ocultar' and $grupos == 'ocultar' and $acessos == 'ocultar'){
	$menu_cadastros = 'ocultar';
}else{
	$menu_cadastros = '';
}

if($ordem_servico == 'ocultar' and $servicos == 'ocultar' ){
	$menu_ordem_servico = 'ocultar';
}else{
	$menu_ordem_servico = '';
}

 ?>