<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	color: #000;
}
</style>
</head>

<body>
<? require "../../conexao.php"; ?>

<table width="400" border="1">
  <tr>
    <td colspan="5"><strong>Detalhes da média bimestral</strong></td>
  </tr>
  <tr>
    <td><strong>AT</strong></td>
    <td><strong>AP</strong></td>
    <td><strong>AB</strong></td>
    <td><strong>RE</strong></td>
    <td><strong>MB</strong></td>
  </tr>
  <? 
  $sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '".$_GET['bimestre']."'");
  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
	   $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
		  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
			 $media = ($media+$res_notas_bimestrais['re'])/2;
		 }
	  
  ?>
  <tr>
    <td><? echo number_format($res_notas_bimestrais['at']);echo ",0"; ?></td>
    <td><? echo number_format($res_notas_bimestrais['ap']);echo ",0"; ?></td>
    <td><? echo number_format($res_notas_bimestrais['ab']);echo ",0"; ?></td>
    <td><? echo number_format($res_notas_bimestrais['re']);echo ",0"; ?></td>
    <td><? echo number_format($media);echo ",0"; ?></td>
  </tr>
 <? } ?>
</table>
</body>
</html>