<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	color: #333;
	font:12px Arial, Helvetica, sans-serif;
	padding:0;
	margin:0;
}
body table{
	text-align:center;
	}
</style>
</head>

<body>
<? require "../../conexao.php"; ?>




<?
$aluno = $_GET['aluno'];
$sql_cpf = mysqli_query($conexao_bd, "SELECT * FROM login_alunos WHERE aluno = '$aluno'");
if(mysqli_num_rows($sql_cpf) <= 0){
 echo "<em>Este aluno não possui acesso ao sistema!</em>";
}else{
?>
<table width="365" border="1">
  <tr>
    <td width="116" bgcolor="#0099CC"><strong>DATA DE CRIA&Ccedil;&Atilde;O</strong></td>
    <td width="209" bgcolor="#0099CC"><strong>LOGIN</strong></td>
    <td width="18" bgcolor="#0099CC">&nbsp;</td>
  </tr>
  <? while($res_cpf = mysqli_fetch_array($sql_cpf)){ ?>
  <tr>
    <td><? echo $res_cpf['data_completa']; ?></td>
    <td><? echo $res_cpf['login']; ?></td>
    <td><a href="?aluno=<? echo $_GET['aluno']; ?>&&p=1&acao=Excluido"><img src="../../img/deleta.png" width="20" height="20" border="0" title="Deletar acesso" /></a>
        </td>
  </tr>
  <? } ?>
</table>
<? } ?>
</body>
</html>

<? if(@$_GET['p'] == '1'){
	
	$aluno = $_GET['aluno'];
	
	 mysqli_query($conexao_bd, "DELETE FROM login_alunos WHERE aluno = '$aluno'");
	 echo "<script language='javascript'>window.location='?aluno=$aluno';</script>";


}?>
