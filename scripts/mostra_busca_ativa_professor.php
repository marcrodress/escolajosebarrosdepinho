<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<style type="text/css">
body,td,th {
	color: #000;
	font:10px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<?
require "../../conexao.php";
$sql_busca = mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '".$_GET['componente']."'");
if(mysqli_num_rows($sql_busca) == ''){
	echo "<p class='text-primary'>Ainda não foi realizado busca ativa para esse professor!</p>";
}else{
?>
<h6 class="text-success"><strong>Componente:</strong>
<?
		$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['componente']."'");
		 while($res_professor = mysqli_fetch_array($sql_professor)){
			 echo $res_professor['componente'];
		}
?>
</h6>
<table class="table table-striped" style="text-align:center;" width="800" border="1">
  <tr>
    <td><strong>IP</strong></td>
    <td><strong>Data</strong></td>
    <td><strong>Atividade</strong></td>
    <td><strong>Professor</strong></td>
    <td><strong>Forma de contato</strong></td>
    <td><strong>Anexo</strong></td>
    <td><strong>Feedback</strong></td>
  </tr>
  <? while($res_busca = mysqli_fetch_array($sql_busca)){ ?>
  <tr>
    <td><? echo $res_busca['ip']; ?></td>
    <td><? echo $res_busca['data_hora']; ?></td>
    <td><?
		$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".$res_busca['atividade']."'");
		 while($res_professor = mysqli_fetch_array($sql_professor)){
			 echo $res_professor['dia'];
			 echo "/";
			 echo $res_professor['mes'];
			 echo "/";
			 echo $res_professor['ano'];
		}
	?></td>
    <td><?
		$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_busca['professor']."'");
		 while($res_professor = mysqli_fetch_array($sql_professor)){
			 echo $res_professor['nome_escola'];
		}
	?></td>
    <td><? echo $res_busca['forma_contato']; ?></td>
    <td><? if($res_busca['anexos'] != '' && $res_busca['anexos'] != '[1]'){ ?> <a target="_blank" href="../arquivos/<? echo $res_busca['anexos']; ?>">Verificar</a> <? } ?></td>
    <td><? echo $res_busca['feedback']; ?></td>
  </tr>
  <? } ?>
</table>
<? } ?>
</body>
</html>