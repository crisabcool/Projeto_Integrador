<?php 

$banco = 'planetransportes';
$usuario = 'root';
$senha = '';
$servidor = 'localhost';

$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/planetransportes/";
}

date_default_timezone_set('America/Sao_Paulo');

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Não conectado ao Banco de Dados! <br><br>' .$e;
}

//VARIAVEIS DO SISTEMA
$nome_sistema = 'Plane Transportes';
$email_sistema = 'cseletrotecnica@gmail.com';
$whatsapp_sistema = '(11) 94076-4746';

$query = $pdo->query("SELECT * from config ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_sistema', telefone_whatsapp = '$whatsapp_sistema', logo = 'logo.png', icone = 'favicon.ico', logo_rel = 'logo_rel.jpg', tipo_rel = 'pdf'");
}else{
	$nome_sistema = $res[0]['nome'];
	$email_sistema = $res[0]['email'];
	$whatsapp_sistema = $res[0]['telefone_whatsapp'];
	$tipo_rel = $res[0]['tipo_rel'];
	$telefone_fixo_sistema = $res[0]['telefone_fixo'];
	$endereco_sistema = $res[0]['endereco'];
	$logo_rel = $res[0]['logo_rel'];
	$logo_sistema = $res[0]['logo'];
	$icone_sistema = $res[0]['icone'];

	$tel_whatsapp = '55'.preg_replace('/[ ()-]+/' , '' , $whatsapp_sistema);
		
}

 ?>