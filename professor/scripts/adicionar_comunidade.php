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
<? require "../../conexao.php"; ?>

<table width="268" border="1">
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong style="font:12px Arial, Helvetica, sans-serif;"><strong>COMUNIDADE</strong></strong></td>
  </tr>
  <?
   $sql_comunidades = mysqli_query($conexao_bd, "SELECT * FROM rotas_escolares");
    while($res_comunidades = mysqli_fetch_array($sql_comunidades)){
  ?>
  <tr>
    <td width="234"><? echo $res_comunidades['rota']; ?></td>
    <td width="18">
    <?
	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar_comunidades WHERE rota = '".$_GET['rota']."' AND comunidade = '".$res_comunidades['code']."'");
	if(mysqli_num_rows($sql_verifica) == 0){    
	?>
    <a href="?k=adicionar&rota=<? echo $_GET['rota']; ?>&comunidade=<? echo $res_comunidades['code']; ?>"><img src="../img/CORRETO.png" title="Adicionar comunidade a rota" width="18" height="18" /></a>
    <?
	}else{
	?>
    <a href="?k=excluir&rota=<? echo $_GET['rota']; ?>&comunidade=<? echo $res_comunidades['code']; ?>"><img src="../img/errado.png" title="Adicionar comunidade a rota" width="18" height="18" /></a>    
    <? } ?>
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

	$rota = $_GET['rota'];
	$comunidade = $_GET['comunidade'];
	
	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar_comunidades WHERE rota = '$rota' AND comunidade = '$comunidade'");
	if(mysqli_num_rows($sql_verifica) >= 1){
		echo "<script language='javascript'>window.alert('Localidade já adicionada a essa rota!');window.location='?rota=$rota';</script>";
	}else{
		$code_tra = rand();
		mysqli_query($conexao_bd, "INSERT INTO rota_escolar_comunidades (code, rota, comunidade) VALUES ('$code_tra', '$rota', '$comunidade')");
		echo "<script language='javascript'>window.location='?rota=$rota';</script>";
	}
	
	

}?>
</body>
</html>