<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php

error_reporting(0);
ini_set("display_errors", 0 );

?>


<?
$conexao_bd = mysqli_connect("localhost","ikulyco1_escolaleorne","Rcbv896xw*+-","ikulyco1_escolaleorne") or die(mysql_error());


	$data_completa = date("d/m/Y H:i:s");
	$data = date("d/m/Y");
	$dia = date("d");
	$d = date("d");
	$mes = date("m");
	$hora = date("H:i:s");
	$apenas_hora = date("H");
	$m = date("m");
	$ano = date("Y");
	$a = date("Y");
	$ip = $_SERVER['REMOTE_ADDR'];
	

$code_hoje = 0;

$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
	$code_hoje = $res_code_vencimento['codigo'];
}		
	

$url_atual= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	

?>
</head>

<body>
</body>
</html>