<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
<style type="text/css">
body{
	padding:0; 
	margin:0;
}
</style>
</head>

<body>
<?
$code_atividade = $_GET['atividade'];

$turma = $_GET['turma'];
$atividade = $_GET['atividade'];
$code_aluno = $_GET['aluno'];

$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$atividade' AND code_aluno = '$code_aluno'");

$presenca = NULL;
$status = NULL;

while($res_atividade = mysqli_fetch_array($sql_atividade)){
	$presenca = $res_atividade['presente'];
	$status = $res_atividade['status'];
}

?>



			  <? 
			  
			  $aluno = 0; if($_GET['code_aluno'] == 0){ $aluno = $_GET['aluno']; }else{ $aluno = $_GET['code_aluno']; }
			   
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '$aluno' AND status = 'CORRIGIDO'");
			   if(mysqli_num_rows($sql_data) <= 0){      
			  ?>
              
              <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=confirmar&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>&status=CORRIGIDO&frequencia=SIM">           
              <img src="img/fez_atividade.png" width="25" height="25" border="0" title="Confirmar entrega de atividade" />
			  </a>
            
              <? }else{ ?>
            
              <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=confirmar&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>&status=NAO&frequencia=<? echo $presenca; ?>"><img style="border-radius:5px;" src="img/fez_atividade_excluir.png" width="25" height="25" border="0" title="Excluir entrega da atividade" /></a>
			  <? } ?> 
              
			  &nbsp;&nbsp;&nbsp;&nbsp;
			  <?
  			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '$aluno' AND presente = 'SIM'");
			   if(mysqli_num_rows($sql_data) >= 1){
			  ?>
              <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=confirmar&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>&status=NAO&frequencia=NAO"><img src="img/deleta.png" width="25" height="25" border="0" title="Aplicar falta" /></a>
			  <? }else{ ?>
			  <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=confirmar&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>&status=<? echo $status; ?>&frequencia=SIM"><img style="border-radius:5px;" src="professor/img/CORRETO.png" width="25" height="25" border="0" title="Confirmar presença" /></a>
			  <? } ?>
</body>
</html>


<? if(@$_GET['acao'] == 'confirmar'){

$code_atividade = $_GET['atividade'];

$turma = $_GET['turma'];
$atividade = $_GET['atividade'];
$code_aluno = $_GET['aluno'];

$frequencia = $_GET['frequencia'];
$status = $_GET['status'];

$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$atividade' AND code_aluno = '$code_aluno'");
if(mysqli_num_rows($sql_atividade) == ''){
mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('$data', '$status', '', '$code_aluno', '$atividade', '10', 'SIM')");
echo "<script language='javascript'>window.location='acao_professor.php?atividade=$atividade&turma=$turma&aluno=$code_aluno';</script>";

}else{
	$data_atvidade = 0;

while($res_pega_data = mysqli_fetch_array($sql_atividade)){
	$data_atvidade = $res_pega_data['data'];
}
if($data_atvidade == NULL){
	$data_atvidade = date("d/m/y");
}



mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET status = '$status', nota = '10', presente = '$frequencia' WHERE code_atividade = '$atividade' AND code_aluno = '$code_aluno'");
echo "<script language='javascript'>window.location='acao_professor.php?atividade=$atividade&turma=$turma&aluno=$code_aluno';</script>";

	
}


}?>

