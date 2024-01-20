<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	font:11px Arial, Helvetica, sans-serif;
	color:#000;
}
</style>
</head>

<body>
<? require "../../conexao.php"; $aluno = $_GET['aluno']; ?>

<? if(isset($_POST['trat'])){
	
	$transporte = $_POST['transporte'];
	
	mysqli_query($conexao_bd, "UPDATE alunos SET transporte_escolar = '$transporte' WHERE code_aluno = '$aluno'");
	
	echo "<script language='javascript'>window.location='';</script>";

}?>

<?

$transporte = 0;
$sql_transporte = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '$aluno'");
 while($res_transporte = mysqli_fetch_array($sql_transporte)){
	 $transporte = $res_transporte['transporte_escolar'];
}



?>

<table width="310" border="1">
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong style="font:12px Arial, Helvetica, sans-serif;"><strong>PRECISA DE TRANSPORTE
         <form name="" method="post" action="" enctype="multipart/form-data">
          <input name="transporte" type="radio" value="SIM" <? if($transporte == 'SIM'){ ?>checked="checked" <? } ?>/>
          SIM
          <input name="transporte" type="radio" value="NAO" <? if($transporte == 'NAO'){ ?>checked="checked" <? } ?> />
          N&Atilde;O
          <input type="submit" name="trat" value="" style="width:0; height:0;" />
      </form>
    </strong></strong></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#A3A3A3"><strong style="font:12px Arial, Helvetica, sans-serif;"><strong>COMUNIDADE</strong></strong></td>
  </tr>
  <?
   $sql_comunidades = mysqli_query($conexao_bd, "SELECT * FROM rotas_escolares");
    while($res_comunidades = mysqli_fetch_array($sql_comunidades)){
  ?>
  <tr>
    <td width="263"><? echo $res_comunidades['rota']; ?></td>
    <td width="31">
    <?
	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '$aluno' AND localidade = '".$res_comunidades['code']."'");
	if(mysqli_num_rows($sql_verifica) == 0){    
	?>
    <a href="?k=adicionar&aluno=<? echo $aluno; ?>&comunidade=<? echo $res_comunidades['code']; ?>"><img src="../img/CORRETO.png" width="18" height="18" border="0" title="Adicionar comunidade a rota" /></a>
    <? }?>
    </td>
  </tr>
  <? } ?>
</table>
<? if($_GET['k'] == 'excluir'){
	$rota = $_GET['rota'];
	$comunidade = $_GET['comunidade'];	
 mysqli_query($conexao_bd, "DELETE FROM rota_escolar_comunidades WHERE rota = '$rota' AND comunidade = '$comunidade'");
		echo "<script language='javascript'>window.location='?rota=$rota';</script>";

}?>






<? if($_GET['k'] == 'adicionar'){

	$comunidade = $_GET['comunidade'];
	
	mysqli_query($conexao_bd, "UPDATE alunos SET localidade = '$comunidade' WHERE code_aluno = '$aluno'");
	
	echo "<script language='javascript'>window.location='?aluno=$aluno';</script>";
	

}?>
</body>
</html>