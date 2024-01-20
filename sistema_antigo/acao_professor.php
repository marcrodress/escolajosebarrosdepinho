<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
<style type="text/css">
body{padding:0; margin:0;
</style>
</head>

<body>
			  <? 
			  
			  $aluno = 0; if($_GET['code_aluno'] == 0){ $aluno = $_GET['aluno']; }else{ $aluno = $_GET['code_aluno']; }
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '$aluno' AND status = 'CORRIGIDO'");
			   if(mysqli_num_rows($sql_data) <= 0){      
			  ?>
              <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=confirmar&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>">          
              <img src="professor/img/CORRETO.png" width="25" height="25" border="0" title="Confirmar entrega de atividade" /></a>
              <? } ?>
              
 

			   <?
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '$aluno' AND data != '' AND nota > 0");
			   if(mysqli_num_rows($sql_data) >= 1){      
			   ?>              
                <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=excluir&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="20" height="20" border="0" title="Excluir" /></a>
				<? } ?> 
 
 
</body>
</html>


<? if(@$_GET['acao'] == 'confirmar'){

$code_atividade = $_GET['atividade'];

$turma = $_GET['turma'];
$atividade = $_GET['atividade'];
$code_aluno = $_GET['aluno'];

$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$atividade' AND code_aluno = '$code_aluno'");
if(mysqli_num_rows($sql_atividade) == ''){
mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '', '$code_aluno', '$atividade', '10')");
echo "<script language='javascript'>window.location='acao_professor.php?atividade=$atividade&turma=$turma&aluno=$code_aluno';</script>";

}else{
	$data_atvidade = 0;

while($res_pega_data = mysqli_fetch_array($sql_atividade)){
	$data_atvidade = $res_pega_data['data'];
}
if($data_atvidade == NULL){
	$data_atvidade = date("d/m/y");
}



mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET data = '$data_atvidade', status = 'CORRIGIDO', nota = '10' WHERE code_atividade = '$atividade' AND code_aluno = '$code_aluno'");
echo "<script language='javascript'>window.location='acao_professor.php?atividade=$atividade&turma=$turma&aluno=$code_aluno';</script>";

	
}


}?>






<? if(@$_GET['acao'] == 'excluir'){

$code_atividade = $_GET['atividade'];
$code_aluno = $_GET['aluno'];

mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas WHERE code_atividade = '$code_atividade' AND code_aluno = '$code_aluno'");

$turma = $_GET['turma'];
$tipo_envio = $_GET['tipo_envio'];
$atividade = $_GET['atividade'];

echo "<script language='javascript'>window.location='acao_professor.php?atividade=$atividade&turma=$turma&aluno=$code_aluno';</script>";

}?>