<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body table{
	border:2px solid #000;
	padding:0;
	margin:0;
	}
body,td,th {
	color: #000;
	padding:0;
	margin:0;
	font:12px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<? require "../../conexao.php"; ?>

<table width="676" border="0">
  <tr>
    <td width="124" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td width="269" align="center"><h1 style="font:22px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="129" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td align="center">
    <h3 style="font:17px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>LISTA DE ALUNOS POR COMUNIDADE</strong></h3>
    <h2 style="font:15px Arial, Helvetica, sans-serif;">
 		 <strong> <? $conta_alunos = 0;
           $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM rotas_escolares WHERE code = '".$_GET['localidade']."'");
		   while($res = mysqli_fetch_array($sql_verifica)){
			   echo $res['rota'];
		   }
		  ?></strong>
    </h2></td>
  </tr>
  <tr>
    <td colspan="3"><table width="700" border="1">
      <tr>
        <td width="15" align="center">&nbsp;</td>
        <td width="332" align="center"><strong>NOME</strong></td>
        <td width="133"><strong>ROTA</strong></td>
        <td width="59"><strong>ANO</strong></td>
        <td width="54" align="center"><strong>TURMA</strong></td>
        <td width="65" align="center"><strong>TURNO</strong></td>
      </tr>

	  <?  
	    $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE localidade = '".$_GET['localidade']."' AND transporte_escolar = 'SIM'");
	    while($res_alunos = mysqli_fetch_array($sql_alunos)){ $conta_alunos++;
	  ?>
      <tr>
          <td height="20" align="left"><? echo $conta_alunos++; $conta_alunos--; ?></td>
          <td align="left"><? echo $res_alunos['nome_aluno']; ?></td>
          <td>
		  <?
            $sql_rota = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar_comunidades WHERE comunidade = '".$_GET['localidade']."'");
             while($res_rota = mysqli_fetch_array($sql_rota)){
				$sql_rotas = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar WHERE code = '".$res_rota['rota']."'");
				 while($res_rotas = mysqli_fetch_array($sql_rotas)){
					 echo $res_rotas['rota'];
			 }
			}
          ?>          
          </td>
		  <?
            $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res_alunos['code_aluno']."'");
            while($res_turma = mysqli_fetch_array($sql_turma)){
				$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_turma['turma']."'");
				 while($res_turmas = mysqli_fetch_array($sql_turmas)){
          ?>
          <td width="59" align="center"><? echo $res_turmas['code_serie']; ?>° ano</td>
          <td width="54" align="center"><? echo $res_turmas['tipo_turma']; ?></td>
          <td width="65" align="center"><? echo $res_turmas['turno']; ?></td>
          <? }} ?>
      </tr>
      <? } ?>
      
    </table>
    </td>
  </tr>
</table>
</body>
</html>