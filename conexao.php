
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php

error_reporting(0);
ini_set("display_errors", 0 );

?>


<?
$conexao_bd = mysqli_connect("localhost","ikulyco1_escolaleorne","Rcbv896xw*+-","ikulyco1_escolaleornebelem") or die(mysql_error());
mysqli_query($conexao_bd, "UPDATE acesso_sistema SET status = 'Ativo'");
mysqli_query($conexao_bd, "UPDATE coladorares SET status = 'Ativo'");
mysqli_query($conexao_bd, "UPDATE atividades SET tipo_atividade = 'Atividade bimestral' WHERE tipo_atividade = 'Atividade Bimestral'");


//mysqli_query($conexao_bd, "UPDATE turmas_alunos SET laudado = ''");

//mysqli_query($conexao_bd, "UPDATE atividades SET periodo WHERE code_dia_atividade <= '9320'");

mysqli_query($conexao_bd, "UPDATE turmas_alunos SET status = 'Ativo' WHERE transferido != 'SIM'");

mysqli_query($conexao_bd, "UPDATE atividades SET tipo_atividade = 'Atividade' WHERE tipo_atividade = ''");

	$data_completa = date("d/m/Y H:i:s");
	$data = date("d/m/Y");
	$dia = date("d");
	$d = date("d");
	$mes = date("m");
	$hora = date("H:i:s");
	$apenas_hora = date("H:i:s");
	$m = date("m");
	$ano = date("Y");
	$a = date("Y");
	$ip = $_SERVER['REMOTE_ADDR'];
	

$code_hoje = 0;

//mysqli_query($conexao_bd, "UPDATE turmas_alunos SET status = 'Ativo' WHERE status = 'CANCELADO' AND transferido != 'SIM'");



$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
	$code_hoje = $res_code_vencimento['codigo'];
}		



$hora = date("H");

$turno_frequencia = 0;
if($hora >=7 && $hora<=11){
$turno_frequencia = "MANHA";
}elseif($hora >=13 && $hora<=17){
$turno_frequencia = "TARDE";
}else{
$turno_frequencia = "SEM FREQUÊNCIA ABERTA";
}




$turno_aula = 0;

if($hora >=7 && $hora<8){
$turno_aula = 1;
}elseif($hora >=8 && $hora<9){
$turno_aula = 2;
}elseif($hora >=9 && $hora<10){
$turno_aula = 3;
}elseif($hora >=10 && $hora<11){
$turno_aula = 4;


}elseif($hora >=13 && $hora<14){
$turno_aula = 1;
}elseif($hora >=14 && $hora<15){
$turno_aula = 2;
}elseif($hora >=15 && $hora<16){
$turno_aula = 3;
}elseif($hora >=16 && $hora<17){
$turno_aula = 4;


}else{
$turno_aula = "SEM FREQUÊNCIA ABERTA";
}




$url_atual= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
?>
</head>

<body>
</body>
</html>