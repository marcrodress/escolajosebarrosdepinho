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
    <h3 style="font:17px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>RELATÓRIO DE FREQU&Ecirc;NCIA MENSAL</strong></h3>
    <h2 style="font:15px Arial, Helvetica, sans-serif;"><strong>M&Ecirc;S:</strong>
      <?  $mes_atual = $_GET['mes'];
	
	 if($mes_atual == '01'){
		 echo "JANEIRO";
	 }elseif($mes_atual == '02'){
		 echo "FEVEREIRO";
	 }elseif($mes_atual == '03'){
		 echo "MAR&Ccedil;O";
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
	
	?>
    </h2> 
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
        <td width="24" align="center"><strong>N&deg;</strong></td>
        <td width="348"><strong>NOME DO ALUNO</strong></td>
        <?
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '".$_GET['mes']."' AND componente = '".$_GET['componente']."' AND turma = '".$_GET['turma']."' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
		?>
        <td width="41" align="center"><strong><? echo $res_1['dia']; ?></strong></td>
        <? } ?>
        <td width="41" align="center"><strong>FALTAS</strong></td>
        
        
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
		 $total_faltas = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '".$_GET['mes']."' AND componente = '".$_GET['componente']."' AND turma = '".$_GET['turma']."' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['code_aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
			  
			  
		?>
        <td width="41" align="center">
        
            <? if($result == 1 && $horas == 2){  ?>
            <img src="../img/frequencia.png" width="7" height="7" />
        	<img src="../img/frequencia.png" width="7" height="7" />
            <? } ?>

            <? if($result == 1 && $horas == 1){ ?>
        	<img src="../img/frequencia.png" width="7" height="7" />
            <? } ?> 
            
            
            <? if($result == 0 && $horas == 1){ $total_faltas = $total_faltas+1; ?>
        	<img src="../img/infrequencia.png" width="7" height="7" />
            <? } ?>
                        
            <? if($result == 0 && $horas == 2){ $total_faltas = $total_faltas+2;?>
            <img src="../img/infrequencia.png" width="7" height="7" />
        	<img src="../img/infrequencia.png" width="7" height="7" />
            <? } ?>            
            
            
        </td>
        <? } ?>

        <td width="41" align="center"><? echo $total_faltas; ?></td>
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