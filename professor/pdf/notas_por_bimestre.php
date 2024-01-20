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
<?

$turma = $_GET['turma'];
$componente = $_GET['componente'];
$operador = $_GET['operador'];
$bimestre = $_GET['bimestre'];
require "../../conexao.php";

$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
while($res_turma = mysqli_fetch_array($sql_turmas)){
?>
<table width="676" border="0">
  <tr>
    <td width="124" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td colspan="2" align="center"><h1 style="font:22px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="129" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <h3 style="font:17px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>RELATÓRIO DE NOTAS BIMESTRAIS</strong></h3>
    <h2 style="font:15px Arial, Helvetica, sans-serif;"><strong>PROFESSOR:</strong> 
      <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   echo strtoupper($res_verifica['nome_escola']);		  
	 }
	?>
    </h2></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>TURMA:</strong> <? echo $res_turma['code_serie']; ?>° ANO - <? echo $res_turma['tipo_turma']; ?></td>
    <td width="269" align="center" bgcolor="#CCCCCC"><strong>TURNO:</strong> <? echo $res_turma['turno']; ?></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>COMPONENTE:</strong> <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '$componente'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   echo $res_verifica['componente'];		  
	 }
	?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="700" border="1">
      <tr>
        <td width="24" align="center"><strong>N&deg;</strong></td>
        <td width="348"><strong>NOME DO ALUNO</strong></td>
        <td width="41" align="center"><strong>1&deg; BIM</strong></td>
        <td width="45" align="center"><strong>2&deg; BIM</strong></td>
        <td width="47" align="center"><strong>3&deg; BIM</strong></td>
        <td width="38" align="center"><strong>4&deg;BIM</strong></td>
        <td width="40" align="center"><strong>MF</strong></td>
        <td width="63" align="center"><strong>SITUA&Ccedil;&Atilde;O</strong></td>
      </tr>
          <? $i = 0;
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  $aluno = 0;
		  ?>
      <tr>
        <td height="20" align="center"><? echo $res_alunos['n_chamada']; ?></td>
      <td><? echo $res_alunos['nome_aluno']; ?></td>
        
          	<?
			
			$media_1bi = 0;
			$media_2bi = 0;
			$media_3bi = 0;
			$media_4bi = 0;
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '1'");
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				  $media_1bi = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
				    if($media_1bi >= 6){
				   }else{
					   $media_1bi = (($media+$res_notas_bimestrais['re'])/2);
				   }
			  }
		
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '2'");
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				  $media_2bi = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
				    if($media_2bi >= 6){
				   }else{
					   $media_2bi = (($media_2bi+$res_notas_bimestrais['re'])/2);
				   }
			  }	
			  
		
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '3'");
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				  $media_3bi = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
				    if($media_3bi >= 6){
				   }else{
					   $media_3bi = (($media_3bi+$res_notas_bimestrais['re'])/2);
				   }
			  }	
			  
		
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '3'");
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				  $media_4bi = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
				    if($media_4bi >= 6){
				   }else{
					   $media_4bi = (($media_4bi+$res_notas_bimestrais['re'])/2);
				   }
			  }		
				  
			?>
        
        <td align="center"><? echo number_format($media_1bi);echo ",0"; ?></td>
        <td align="center"><? echo number_format($media_2bi);echo ",0"; ?></td>
        <td align="center"><? echo number_format($media_3bi);echo ",0"; ?></td>
        <td align="center"><? echo number_format($media_4bi);echo ",0"; ?></td>
        <td align="center"><? echo number_format(($media_1bi+$media_2bi+$media_3bi+$media_4bi)/4);echo ",0"; ?></td>
        <td align="center">APROVADO</td>
        
        
      </tr>
     <? } ?> 
      
    </table>
      <table width="700" border="0">
        <tr>
          <td colspan="2" align="center"><br /></td>
        </tr>
        <tr>
          <td align="center"><p>&nbsp;</p>
            <p>__________________________________________<br />
              PROF&ordf;:
  <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   echo strtoupper($res_verifica['nome_escola']);		  
	 }
	?>
          </p></td>
          <td align="center"><p>&nbsp;</p>
            <p>__________________________________________<br />
          COORDENADOR</p></td>
        </tr>
    </table></td>
  </tr>
</table>
<? } ?>
</body>
</html>