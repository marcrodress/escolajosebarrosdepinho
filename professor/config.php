<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? require "../conexao.php"; ?>
<title>SISTEMA LEORNE BELÉM</title>

</head>

<body>

<?
@session_start();
$operador = $_SESSION['code'];
$nome = $_SESSION['nome'];
$tipo = $_SESSION['tipo'];
if($operador == ''){
	echo "<script language='javascript'>window.location='login.php';</script>";
}else{

 $sql = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
 if(mysqli_num_rows($sql) == ''){
	echo "<script language='javascript'>window.location='login.php';</script>";
 }
 
}



mysqli_query($conexao_bd, "INSERT INTO grava_url (ip, data, data_completa, url, usuario, pagina) VALUES ('$ip', '$data', '$data_completa', '$url_atual', '$operador', '$nome_pagina')");


$sql_atividades_enviadas = mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET data = '$data' WHERE data = '' AND status = 'CORRIGIDO'");
//$sql_atividades_enviadas = mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET data = '' WHERE status = ''");



?>

</body>
</html>
