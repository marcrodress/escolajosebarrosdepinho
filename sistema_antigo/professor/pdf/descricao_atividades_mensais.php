<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="pt-br">
<meta http-equiv="Content-Language" content="pt-br, en, fr, it">
<html lang="pt-br">

<style type="text/css">
body table{
	border:2px solid #000;
	}
body,td,th {
	color: #000;
	font:12px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<?

$turma = $_GET['turma'];
$componente = $_GET['componente'];
$operador = $_GET['operador'];
$mes_atual = $_GET['mes'];
require "../../conexao.php";

$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
while($res_turma = mysqli_fetch_array($sql_turmas)){
?>
<table width="676" border="0">
  <tr>
    <td width="124" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td colspan="2" align="center"><h1 style="font:18px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="129" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <h2 style="font:15px Arial, Helvetica, sans-serif;"><strong>MÊS:</strong> <?  $mes_atual = $_GET['mes'];
	
	 if($mes_atual == '01'){
		 echo "JANEIRO";
	 }elseif($mes_atual == '02'){
		 echo "FEVEREIRO";
	 }elseif($mes_atual == '03'){
		 echo "MARÇO";
	 }elseif($mes_atual == '04'){
		 echo "ABRIL";
	 }elseif($mes_atual == '05'){
		 echo "MAIO";
	 }elseif($mes_atual == '06'){
		 echo "JUNHO";
	 }elseif($mes_atual == '07'){
		 echo "JULHO";
	 }elseif($mes_atual == '08'){
		 echo "AGOSTO";
	 }elseif($mes_atual == '09'){
		 echo "SETEMBRO";
	 }elseif($mes_atual == '10'){
		 echo "OUTUBRO";
	 }elseif($mes_atual == '11'){
		 echo "NOVEMBRO";
	 }else{
		 echo "DEZEMBRO";
	 }	
	
	?></h2> 
    <strong>PROFESSOR:</strong> <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   echo strtoupper($res_verifica['nome_escola']);		  
	 }
	?></td>
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
        <td width="114" align="center"><strong>DATA</strong></td>
        <td width="568"><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
      </tr>
      <? $carga_horaria = 0; $encerramento = 0;
	   $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE componente = '$componente' AND turma = '$turma' AND mes = '$mes_atual' ORDER BY code_dia_atividade ASC");
	   while($res_disc = mysqli_fetch_array($sql_disciplinas)){ $carga_horaria = $res_disc['carga_horaria']+$carga_horaria;
	   
	   $dia_m = $res_disc['dia'];
	   $mes_m = $res_disc['mes'];
	   $ano_m = $res_disc['ano'];
	   
	   $encerramento = "$dia_m/$mes_m/$ano_m";
	  ?>
      <tr>
        <td height="40" align="center"><? echo $res_disc['dia']; ?>/<? echo $res_disc['mes']; ?>/<? echo $res_disc['ano']; ?> - <? echo $res_disc['carga_horaria']; ?> h<? if($res_disc['carga_horaria'] == '2'){ ?><? } ?><br /></td>
        <td><? 
		
		$atividade = strtoupper($res_disc['objetivo']);
		
		$atividade = str_replace('ç', 'Ç', $atividade); 
		$atividade = str_replace('ã', 'Ã', $atividade); 
		$atividade = str_replace('ã', 'Ã', $atividade); 
		$atividade = str_replace('ê', 'Ê', $atividade); 
		$atividade = str_replace('é', 'É', $atividade); 
		$atividade = str_replace('õ', 'Õ', $atividade); 
		$atividade = str_replace('á', 'Á', $atividade); 
		$atividade = str_replace('ú', 'Ú', $atividade); 
		$atividade = str_replace('í', 'Í', $atividade); 
		$atividade = str_replace('à', 'À', $atividade); 
		$atividade = str_replace('ó', 'Ó', $atividade); 
		
		echo $atividade;
		 ?><br /></td>
      </tr>
     <? } ?> 
      
    </table>
      <table width="700" border="0">
        <tr>
          <td colspan="2" align="center"><br />Aulas previstas: <?
           
		   $sql_aulas_previstas = mysqli_query($conexao_bd, "SELECT * FROM aulas_previstas WHERE mes = '$mes_m' AND componente = '".$_GET['componente']."'");
		  	 while($res_previstas = mysqli_fetch_array($sql_aulas_previstas)){
				 echo $res_previstas['dadas'];
			}
		  
		  ?> hrs/a<br />Aula dadas: <? echo $carga_horaria; ?> hrs/a<br />Encerrado em:  <? echo $encerramento; ?><hr />
</td>
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