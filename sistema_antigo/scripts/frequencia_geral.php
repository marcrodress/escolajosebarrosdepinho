<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body{padding:0; margin:0; }

body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	text-align:center;
}

</style>
</head>

<body>
<table width="1305" border="0">
  <tr>
    <td colspan="2"><img src="../../img/logo.fw.png" width="98" height="85" /></td>
    <td colspan="37"><h1>E.E.F.DEP. LEORNE BEL&Eacute;M  </h1>
    <h1>Turma: 6&deg; ANO                        Turno: TARDE </h1></td>
    <td width="40">&nbsp;</td>
  </tr>
  <tr>
    <td width="18" rowspan="2" bgcolor="#0099CC"><strong>N&deg;</strong></td>
    <td width="279" rowspan="2" align="left" bgcolor="#0099CC"><strong>NOME DO ALUNO</strong></td>
    <td width="98" rowspan="2" bgcolor="#0099CC"><strong>TELEFONE</strong></td>
    <td width="154" rowspan="2" bgcolor="#0099CC"><strong>LOCALIDADE</strong></td>
    <? for($i=1; $i<=31; $i++){ ?>
    <td colspan="2" bgcolor="#0099CC"><h3><? echo $i; ?></h3></td>
    <? } ?>

  </tr>
  <tr>
  
    <td width="8" bgcolor="#00CC00">M</td>
    <td width="1" bgcolor="#00CC00">C</td>

  </tr>
  
  
  
  <?
	require "../../conexao.php";
	$i = 0;
	$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."'");
	while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
  ?> 
  <tr <? if($i%2 == 0){ ?>bgcolor="#DBE7F2" <? }else{ ?> bgcolor="#FFF3C6" <? } ?>>
    <td><? echo $res_alunos['n_chamada']; ?></td>
    <td><? echo strtoupper($res_alunos['nome_aluno']); ?></td>
    <td><? echo $res_alunos['telefone']; ?></td>
    <td><? echo $res_alunos['localidade']; ?></td>
    <td colspan="2">X</td>
  </tr>
  <? } ?>
</table>
</body>
</html>
