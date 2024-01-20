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
$operador = $_GET['professor'];
require "../../conexao.php";

$code_serie = 0;
$turno = 0;
$tipo_turma = 0;

$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
while($res_turma = mysqli_fetch_array($sql_turmas)){
$code_serie = $res_turma['code_serie'];
$turno = $res_turma['turno'];
$tipo_turma = $res_turma['tipo_turma'];
?>


<?  for($mes_atual=01; $mes_atual<=12; $mes_atual++){  ?>
<table width="676" border="0" style="page-break-before: always;">
  <tr>
    <td width="124" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td colspan="2" align="center"><h1 style="font:18px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="129" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <h2 style="font:15px Arial, Helvetica, sans-serif;"><strong>MÊS:</strong> <?  $mes_atual = $mes_atual;
	
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
    <strong>PROFESSOR(A):</strong>
    <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   
		   $sql_colaboradores = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		    while($res_colaboradores = mysqli_fetch_array($sql_colaboradores)){
				   $nome_professor = $res_colaboradores['nome'];
				   
				   $nome_professor = str_replace("ô", "o", $nome_professor);
				   $nome_professor = str_replace("ã", "a", $nome_professor);
				   $nome_professor = str_replace("á", "a", $nome_professor);
				   $nome_professor = str_replace("é", "e", $nome_professor);
				   $nome_professor = str_replace("ç", "c", $nome_professor);
				   $nome_professor = str_replace("í", "i", $nome_professor);
				   $nome_professor = str_replace("ó", "o", $nome_professor);
				   
				   
				   echo strtoupper($nome_professor);
				   
				   		  
				
			}
		   
	 }
	?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>TURMA:</strong> <? echo $code_serie; ?>° ANO - <? echo $tipo_turma; ?></td>
    <td width="269" align="center" bgcolor="#CCCCCC"><strong>TURNO:</strong> <? echo $turno; ?></td>
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
	  
	  if($mes_atual == 2){
		  $mes_atual = "02";
	  }elseif($mes_atual == 3){
		  $mes_atual = "03";
	  }elseif($mes_atual == 4){
		  $mes_atual = "04";
	  }elseif($mes_atual == 5){
		  $mes_atual = "05";
	  }elseif($mes_atual == 6){
		  $mes_atual = "06";	
	  }elseif($mes_atual == 7){
		  $mes_atual = "07";
	  }elseif($mes_atual == 8){
		  $mes_atual = "08";
	  }elseif($mes_atual == 9){
		  $mes_atual = "09";
	  }elseif($mes_atual == 1){
		  $mes_atual = "01";		  		  		  			  	  		  		  
	  }
	  
	  
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
		
		$atividade = $res_disc['objetivo'];
		
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
		
				   $atividade = str_replace("ô", "o", $atividade);
				   $atividade = str_replace("ã", "a", $atividade);
				   $atividade = str_replace("á", "a", $atividade);
				   $atividade = str_replace("é", "e", $atividade);
				   $atividade = str_replace("ç", "c", $atividade);
				   $atividade = str_replace("í", "i", $atividade);
				   $atividade = str_replace("ó", "o", $atividade);		
		
		echo strtoupper($atividade);
		 ?><br /></td>
      </tr>
     <? } ?> 
      
    </table>
      <table width="700" border="0">
        <tr>
          <td colspan="2" align="center">
          
          
          <br />
          Aulas previstas: <?
		  	  
           
		   $sql_aulas_previstas = mysqli_query($conexao_bd, "SELECT * FROM aulas_previstas WHERE componente = '".$_GET['componente']."' AND turma = '".$_GET['turma']."'");
		  	 while($res_previstas = mysqli_fetch_array($sql_aulas_previstas)){
				 

				 if($mes_atual == '01'){
					 echo $res_previstas['janeiro'];
				 }elseif($mes_atual == '02'){
					 echo $res_previstas['fevereiro'];
				 }elseif($mes_atual == '03'){
					 echo $res_previstas['marco'];
				 }elseif($mes_atual == '04'){
					 echo $res_previstas['abril'];
				 }elseif($mes_atual == '05'){
					 echo $res_previstas['maio'];
				 }elseif($mes_atual == '06'){
					 echo $res_previstas['junho'];
				 }elseif($mes_atual == '07'){
					 echo $res_previstas['julho'];
				 }elseif($mes_atual == '08'){
					 echo $res_previstas['agosto'];
				 }elseif($mes_atual == '09'){
					 echo $res_previstas['setembro'];
				 }elseif($mes_atual == '10'){
					 echo $res_previstas['outubro'];
				 }elseif($mes_atual == '11'){
					 echo $res_previstas['novembro'];
				 }elseif($mes_atual == '12'){
					 echo $res_previstas['dezembro'];
				 }else{
				  	 echo "0";
				 }
				 
			}
		  
		  ?> h/a<br />
          Aula dadas: <? echo $carga_horaria; $carga_horaria=0;  ?> h/a<br />Encerrado em:  <? echo $encerramento;?><hr />
          
          
</td>
        </tr>
        <tr>
          <td align="center"><p>&nbsp;</p>
  <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
		$nome_professor = $res_colaborador['nome'];
		
		$nome_professor = str_replace('ç', 'Ç', $nome_professor); 
		$nome_professor = str_replace('ã', 'Ã', $nome_professor); 
		$nome_professor = str_replace('ã', 'Ã', $nome_professor); 
		$nome_professor = str_replace('ê', 'Ê', $nome_professor); 
		$nome_professor = str_replace('é', 'É', $nome_professor); 
		$nome_professor = str_replace('õ', 'Õ', $nome_professor); 
		$nome_professor = str_replace('á', 'Á', $nome_professor); 
		$nome_professor = str_replace('ú', 'Ú', $nome_professor); 
		$nome_professor = str_replace('í', 'Í', $nome_professor); 
		$nome_professor = str_replace('à', 'À', $nome_professor); 
		$nome_professor = str_replace('ó', 'Ó', $nome_professor); 
		
				   $nome_professor = str_replace("ô", "o", $nome_professor);
				   $nome_professor = str_replace("ã", "a", $nome_professor);
				   $nome_professor = str_replace("á", "a", $nome_professor);
				   $nome_professor = str_replace("é", "e", $nome_professor);
				   $nome_professor = str_replace("ç", "c", $nome_professor);
				   $nome_professor = str_replace("í", "i", $nome_professor);
				   $nome_professor = str_replace("ó", "o", $nome_professor);	
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		}
	  }
	 }
	?>          
          
            <p>     <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?><br />
              PROF&ordf;: <? echo strtoupper($nome_professor); ?>
          </p></td>
          <td align="center"><p>&nbsp;</p>
            <?
	  $sql_verifica_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	   while($res_verifica_turma = mysqli_fetch_array($sql_verifica_turma)){
		   
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_verifica_turma['coordenador']."'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
			$nome_professor = $res_colaborador['nome'];
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		 }
		}
	  }
	 }
	?>
            <p>
              <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?>
              <br />
          COORDENADOR(A)&ordf;: <? echo strtoupper($nome_professor); ?> </p></td>
        </tr>
    </table></td>
  </tr>
</table>



<?

$turma = $_GET['turma'];
$componente = $_GET['componente'];
$operador = $_GET['professor'];
require "../../conexao.php";

$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
while($res_turma = mysqli_fetch_array($sql_turmas)){
?>
<table width="676" border="0" style="page-break-before: always;">
  <tr>
    <td width="124" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td colspan="2" align="center"><h1 style="font:22px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="129" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <h3 style="font:17px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>RELATÓRIO DE FREQU&Ecirc;NCIA MENSAL</strong></h3>
    <h2 style="font:15px Arial, Helvetica, sans-serif;"><strong>M&Ecirc;S:</strong>
      <?  
	
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
    <strong>PROFESSOR(A):</strong> <? $nome_professor = 0;
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		   while($res_verifica = mysqli_fetch_array($sql_verifica)){		  
				   $nome_professor = $res_verifica['nome'];
				   
				   $nome_professor = str_replace("ô", "o", $nome_professor);
				   $nome_professor = str_replace("ã", "a", $nome_professor);
				   $nome_professor = str_replace("á", "a", $nome_professor);
				   $nome_professor = str_replace("é", "e", $nome_professor);
				   $nome_professor = str_replace("ç", "c", $nome_professor);
				   $nome_professor = str_replace("í", "i", $nome_professor);
				   $nome_professor = str_replace("ó", "o", $nome_professor);
				   
				   
				   echo strtoupper($nome_professor);		  
	 }}
	?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>TURMA: </strong><? echo $code_serie; ?>&deg; ANO - <? echo $tipo_turma; ?></td>
    <td width="269" align="center" bgcolor="#CCCCCC"><strong>TURNO:</strong> <? echo $turno; ?></td>
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
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '$mes_atual' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
		?>
        <td width="41" align="center"><strong><? echo $res_1['dia']; ?></strong></td>
        <? } ?>
        <td width="41" align="center"><strong>FALTAS</strong></td>
        
        
        </tr>
          <? $i = 0;
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  $aluno = 0;
		  $sql_nome_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_alunos['aluno']."'");
		  while($res_nome_alunos = mysqli_fetch_array($sql_nome_aluno)){
		  ?>
      <tr>
        <td height="20" align="center"><? echo $res_alunos['n_chamada']; ?></td>
      <td><? echo strtoupper($res_nome_alunos['nome_aluno']); ?></td>
             
         <?
		 $total_faltas = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '$mes_atual' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
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
     <? }} ?> 
      
    </table>
      <table width="700" border="0">
        <tr>
          <td width="322" align="center"><p>
            <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
			$nome_professor = $res_colaborador['nome'];
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		}
	  }
	 }
	?>
          </p>
            <p>
              <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?>
              <br />
          PROF&ordf;: <? echo strtoupper($nome_professor); ?></p></td>
          <td width="364" align="center"><p>
            <?
	  $sql_verifica_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	   while($res_verifica_turma = mysqli_fetch_array($sql_verifica_turma)){
		   
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_verifica_turma['coordenador']."'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
			$nome_professor = $res_colaborador['nome'];
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		 }
		}
	  }
	 }
	?>
            </p>
            <p>
              <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?>
              <br />
          COORDENADOR(A)&ordf;: <? echo strtoupper($nome_professor); ?></p></td>
        </tr>
    </table></td>
  </tr>
</table>
<? }} ?>
<? } ?>


<?

$turma = $_GET['turma'];
$componente = $_GET['componente'];
$operador = $_GET['professor'];
require "../../conexao.php";

$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
while($res_turma = mysqli_fetch_array($sql_turmas)){
?>
<table width="676" border="0" style="page-break-before: always;">
  <tr>
    <td width="124" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td colspan="2" align="center"><h1 style="font:22px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="129" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><h3 style="font:17px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>RELATÓRIO DE FREQU&Ecirc;NCIA ANUAL</strong>  <br />      </h3> 
    <strong>PROFESSOR(A):</strong>
    <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   
		   $sql_colaboradores = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		    while($res_colaboradores = mysqli_fetch_array($sql_colaboradores)){
				   $nome_professor = $res_colaboradores['nome'];
				   
				   $nome_professor = str_replace("&ocirc;", "o", $nome_professor);
				   $nome_professor = str_replace("&atilde;", "a", $nome_professor);
				   $nome_professor = str_replace("&aacute;", "a", $nome_professor);
				   $nome_professor = str_replace("&eacute;", "e", $nome_professor);
				   $nome_professor = str_replace("ç", "c", $nome_professor);
				   $nome_professor = str_replace("&iacute;", "i", $nome_professor);
				   $nome_professor = str_replace("&oacute;", "o", $nome_professor);
				   
				   
				   echo strtoupper($nome_professor);				
			}
		   
	 }
	?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>TURMA:</strong> <? echo $res_turma['code_serie']; ?>° ANO - <? echo $res_turma['tipo_turma']; ?></td>
    <td width="269" align="center" bgcolor="#CCCCCC"><strong>TURNO:</strong> <? echo $res_turma['turno']; ?></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>COMPONENTE:</strong>
      <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '$componente'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   echo $res_verifica['componente'];		  
	 }
	?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="700" border="1">
      <tr>
        <td width="17" align="center"><strong>N&deg;</strong></td>
        <td width="299"><strong>ALUNO</strong></td>
        <td width="23"><strong>JAN</strong></td>
        <td width="21"><strong>FEV</strong></td>
        <td width="26"><strong>MAR</strong></td>
        <td width="24"><strong>ABR</strong></td>
        <td width="21"><strong>MAI</strong></td>
        <td width="23"><strong>JUN</strong></td>
        <td width="25"><strong>AGO</strong></td>
        <td width="22"><strong>SET</strong></td>
        <td width="24"><strong>OUT</strong></td>
        <td width="25"><strong>NOV</strong></td>
        <td width="22"><strong>DEZ</strong></td>
        <td width="38"><strong>TOTAL</strong></td>
      </tr>
      <? $i = 0;
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  $aluno = 0;
		  $sql_nome_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_alunos['aluno']."'");
		  while($res_nome_alunos = mysqli_fetch_array($sql_nome_aluno)){
		  ?>
      <tr>
        <td height="20" align="center"><? echo $res_alunos['n_chamada']; ?></td>
        <td><? echo strtoupper($res_nome_alunos['nome_aluno']); ?></td>
        <td align="center"><?
		 $total_faltas = 0; $janeiro = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '01' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
			
			
		  }
			echo $janeiro = $total_faltas;
		?></td>
        <td align="center"><?
		 $total_faltas = 0; $fevereiro = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '02' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
			
			
		  }
			echo $fevereiro = $total_faltas;
		?></td>
        <td align="center"><?
		 $total_faltas = 0; $marco = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '03' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
			
			
		  }
			echo $marco = $total_faltas;
		?></td>
        <td align="center"><?
		 $total_faltas = 0; $abril = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '04' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
			
			
		  }
			echo $abril = $total_faltas;
		?></td>
        <td align="center"><?
		 $total_faltas = 0; $maio = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '05' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
		  }
			echo $maio = $total_faltas;
		?></td>
        <td align="center"><?
		 $total_faltas = 0; $junho = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '06' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
			
			
		  }
			echo $junho = $total_faltas;
		?></td>
        <td align="center"><?
		 $total_faltas = 0; $agosto = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '08' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
		  }
			echo $agosto = $total_faltas;
		?></td>
        <td align="center"><?
		 $total_faltas = 0; $setembro = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '09' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
		  }
			echo $setembro = $total_faltas;
		?></td>
        <td align="center">
        <?
		 $total_faltas = 0; $outubro = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '10' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }		
		  }
			echo $outubro = $total_faltas; 
		?>
        </td>
        <td align="center"><?
		 $total_faltas = 0; $novembro = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '11' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
			
			
		  }
			echo $novembro = $total_faltas;
		?></td>
        <td align="center"><?
		 $total_faltas = 0; $dezembro = 0;
		 $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '12' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		  while($res_1 = mysqli_fetch_array($sql_1)){
			  
			  $horas = $res_1['carga_horaria'];
			  
			  $sql_envio_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_1['code_atividade']."'");
			  $result = 0;
			  
			  if(mysqli_num_rows($sql_envio_atividade) >= 1){
				$result = 1;
			  }
                        
             if($result == 0){ $total_faltas = $total_faltas+$horas; }
			
			
		  }
			echo $dezembro = $total_faltas;
		?></td>
        <td width="38" align="center"><? echo $janeiro+$fevereiro+$marco+$abril+$maio+$junho+$agosto+$setembro+$outubro+$novembro+$dezembro; ?></td>
      </tr>
      <? }} ?>
    </table>
      <table width="700" border="0">
        <tr>
          <td align="center"><p>
            <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
			$nome_professor = $res_colaborador['nome'];
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		}
	  }
	 }
	?>
          </p>
            <p>
              <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?>
              <br />
          PROF&ordf;: <? echo $nome_professor; ?></p></td>
          <td align="center"><p>
            <?
	  $sql_verifica_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	   while($res_verifica_turma = mysqli_fetch_array($sql_verifica_turma)){
		   
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_verifica_turma['coordenador']."'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
			$nome_professor = $res_colaborador['nome'];
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		 }
		}
	  }
	 }
	?>
          </p>
            <p>
              <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?>
              <br />
          COORDENADOR(A)&ordf;: <? echo strtoupper($nome_professor); ?></p></td>
        </tr>
    </table></td>
  </tr>
</table>
<? } ?>




<?
$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
while($res_turma = mysqli_fetch_array($sql_turmas)){
?>

<? for($bimestre=1; $bimestre<=4; $bimestre++){ ?>
<table width="676" border="0" style="page-break-before: always;">
  <tr>
    <td width="124" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td colspan="2" align="center"><h1 style="font:22px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="129" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <h3 style="font:17px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>RELATÓRIO DE NOTAS BIMESTRAL</strong></h3>
    <h2 style="font:15px Arial, Helvetica, sans-serif;"><strong>BIMESTRE:</strong> <? echo $bimestre; ?>&deg; BIMESTRE</h2> 
    <strong>PROFESSOR(A):</strong> <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   
		   $sql_colaboradores = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		    while($res_colaboradores = mysqli_fetch_array($sql_colaboradores)){
				   $nome_professor = $res_colaboradores['nome'];
				   
				   $nome_professor = str_replace("ô", "o", $nome_professor);
				   $nome_professor = str_replace("ã", "a", $nome_professor);
				   $nome_professor = str_replace("á", "a", $nome_professor);
				   $nome_professor = str_replace("é", "e", $nome_professor);
				   $nome_professor = str_replace("ç", "c", $nome_professor);
				   $nome_professor = str_replace("í", "i", $nome_professor);
				   $nome_professor = str_replace("ó", "o", $nome_professor);
				   
				   
				   echo strtoupper($nome_professor);				
			}
		   
	 }
	?>
    </td>
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
        <td width="41" align="center"><strong>AT</strong></td>
        <td width="45" align="center"><strong>AP</strong></td>
        <td width="47" align="center"><strong>AB</strong></td>
        <td width="38" align="center"><strong>MP</strong></td>
        <td width="40" align="center"><strong>RE</strong></td>
        <td width="63" align="center"><strong>MB</strong></td>
      </tr>
          <? $i = 0; $conta = 0;
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  
		  $sql_nome_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_alunos['aluno']."'");
		  while($res_nome_alunos = mysqli_fetch_array($sql_nome_alunos)){ $i++;
		  $aluno = 0;
		  ?>
      <tr>
        <td height="20" align="center"><? $conta++; echo $conta; ?></td>
      <td><? echo strtoupper($res_nome_alunos['nome_aluno']); ?></td>
        
          	<?
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Atividade'");
			$conta_atividade = mysqli_num_rows($sql_atividades);
			$soma_atividade_realizadas = 0;
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				  $sql_verifica_fez = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['aluno']."' AND nota != ''");
					if(mysqli_num_rows($sql_verifica_fez) >= 1){
						$soma_atividade_realizadas++;
					}

				 }elseif($res_atividades['tipo_envio'] == 'multipla'){
					$sql_verifica_fez = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' LIMIT 1");
					if(mysqli_num_rows($sql_verifica_fez) >= 1){
						$soma_atividade_realizadas++;
					}

				 }elseif($res_atividades['tipo_envio'] == 'varios'){
					 
				 }
				 
				 					
					$media = number_format($soma_atividade_realizadas*10/$conta_atividade);
					

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '$media', '0', '0', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', at = '$media' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }
				 
				 
			}
			
			
			
			
			
			
			
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Avaliação parcial'");
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				 
				  $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['aluno']."' LIMIT 1");
				  
				 	 while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
					  
					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '".$res_atividades_enviadas['nota']."', '0', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ap = '".$res_atividades_enviadas['nota']."' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }
					  
				  }
				  
					 
					 
				 }elseif($res_atividades['tipo_envio'] == 'multipla'){ 
					$media = 0;
					$conta_questao = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					 $conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questao);

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '$media', '0', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ap = '$media' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }




				 }elseif($res_atividades['tipo_envio'] == 'varios'){
					 
				 }
			}
			?>
			
			



			
			
			<?

			

			
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Avaliação bimestral'");
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){		
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				 
				  $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['aluno']."' LIMIT 1");
				  
				 	 while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
					  
					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '".$res_atividades_enviadas['nota']."', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ab = '".$res_atividades_enviadas['nota']."' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }		
					 }
			 
			 
			 
			  	
				
			 }elseif($res_atividades['tipo_envio'] == 'multipla'){
				
					$media = 0;
					 $conta_questaos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					$conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questaos);

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '$media', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ab = '$media' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }			 
			 
				}
			 
			 }
			 
			 
			 
			 
			 
			 
			 

			

			
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Recuperação paralela'");
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){		
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				 
				  $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['aluno']."' LIMIT 1");
				  
				 	 while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
					  
					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){

					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '0', '".$res_atividades_enviadas['nota']."', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', re = '".$res_atividades_enviadas['nota']."' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }		
					 }
			 
			 
			 
			  	
				
			 }elseif($res_atividades['tipo_envio'] == 'multipla'){
				
					$media = 0;
					 $conta_questaos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					$conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questaos);

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '0', '$media', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', re = '$media' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }			 
			 
				}
			 
			 }			 
			 
			 
			 
			 
			 
			 
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '$bimestre'");
			 
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				  
			?>
        <td align="center"><? echo $res_notas_bimestrais['at']; ?>,0</td>
        <td align="center"><? if($res_notas_bimestrais['ap'] == ''){ echo "0"; }else{ echo $res_notas_bimestrais['ap']; } ?>,0</td>
        <td align="center"><? if($res_notas_bimestrais['ab'] == ''){ echo "0"; }else{ echo $res_notas_bimestrais['ab']; } ?>,0</td>
        <td align="center"><? echo $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3); ?>,0</td>
        <td align="center"><? if($res_notas_bimestrais['re'] == '' || $media >= 6){ echo "0"; }else{ echo $res_notas_bimestrais['re']; }?>,0</td>
        <td align="center">             <?
               if($media >= 6){
				   echo "$media";
			   }else{
				   
				   if($res_notas_bimestrais['re'] <= 0){
					echo "$media";
				   }else{
				   echo $media = number_format(($media+$res_notas_bimestrais['re'])/2);
				   }
			   }
			   
			   			   
			   
			   mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET media = '$media' WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '".$_GET['bimestre']."'");
			   
			 ?>,0</td>
        <? } ?>
        
        
        
      </tr>
     <? }} ?> 
      
    </table>
      <table width="700" border="0">
        <tr>
          <td colspan="2" align="center"><br /></td>
        </tr>
        <tr>
          <td align="center"><p>&nbsp;</p>
            <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
			$nome_professor = $res_colaborador['nome'];
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		}
	  }
	 }
	?>
            <p>
              <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?>
              <br />
          PROF&ordf;: <? echo strtoupper($nome_professor); ?> </p></td>
          <td align="center"><p>&nbsp;</p>
            <?
	  $sql_verifica_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	   while($res_verifica_turma = mysqli_fetch_array($sql_verifica_turma)){
		   
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_verifica_turma['coordenador']."'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
			$nome_professor = $res_colaborador['nome'];
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		 }
		}
	  }
	 }
	?>
            <p>
              <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?>
              <br />
          COORDENADOR(A)&ordf;: <? echo strtoupper($nome_professor); ?></p></td>
        </tr>
    </table></td>
  </tr>
</table>
<? } ?>
<? } ?>


<?

$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
while($res_turma = mysqli_fetch_array($sql_turmas)){
?>
<table width="676" border="0" style="page-break-before: always;">
  <tr>
    <td width="124" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td colspan="2" align="center"><h1 style="font:22px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="129" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <h3 style="font:17px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>RELATÓRIO DE NOTAS BIMESTRAIS</strong></h3>
    <strong>PROFESSOR(A): </strong> <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   
		   $sql_colaboradores = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		    while($res_colaboradores = mysqli_fetch_array($sql_colaboradores)){
				   $nome_professor = $res_colaboradores['nome'];
				   
				   $nome_professor = str_replace("ô", "o", $nome_professor);
				   $nome_professor = str_replace("ã", "a", $nome_professor);
				   $nome_professor = str_replace("á", "a", $nome_professor);
				   $nome_professor = str_replace("é", "e", $nome_professor);
				   $nome_professor = str_replace("ç", "c", $nome_professor);
				   $nome_professor = str_replace("í", "i", $nome_professor);
				   $nome_professor = str_replace("ó", "o", $nome_professor);
				   
				   
				   echo strtoupper($nome_professor);				
			}
		   
	 }
	?>
    </td>
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
        <td width="19" align="center"><strong>RF</strong></td>
        <td width="19" align="center"><strong>MF</strong></td>
        <td width="63" align="center"><strong>SITUA&Ccedil;&Atilde;O</strong></td>
      </tr>
          <? $i = 0;
		  $sql_turma_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM'");
		  while($res_turma_alunos = mysqli_fetch_array($sql_turma_alunos)){ $i++;
		  
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_turma_alunos['aluno']."'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  $aluno = 0;
		  ?>
      <tr>
        <td height="20" align="center"><? echo $res_turma_alunos['n_chamada']; ?></td>
      <td><? echo strtoupper($res_alunos['nome_aluno']); ?></td>
          	<?
			$media_1bi = 0;
			$media_2bi = 0;
			$media_3bi = 0;
			$media_4bi = 0;
			$recupercaoFinal = 0;
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '1'");
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					   $media_1bi = $res_notas_bimestrais['media'];
			  }
		
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '2'");
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				    $media_2bi = $res_notas_bimestrais['media'];
			  }	
			  
		
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '3'");
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				    $media_3bi = $res_notas_bimestrais['media'];
			  }	
			  
		
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '4'");
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				  $media_4bi  = $res_notas_bimestrais['media'];
			}
			
			 $sqlRecuperacaoFinal = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '".$_GET['componente']."' AND periodo = '4' AND tipo_atividade = 'Recuperação final'");
			 $conta = mysqli_num_rows($sqlRecuperacaoFinal);
					

			  while($resSqlRecuperacaoFinal = mysqli_fetch_array($sqlRecuperacaoFinal)){
				  
				  $code_atividade = $resSqlRecuperacaoFinal['code_atividade'];

				 
				 $sqlPuxaNota = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$resSqlRecuperacaoFinal['code_atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
				 
				 	 while($resPuxaNota = mysqli_fetch_array($sqlPuxaNota)){
						 $recupercaoFinal = $resPuxaNota['nota']+0;
					}
				 
				 
				 
			}	
			
				  
				  
				  $media_final = ($media_1bi+$media_2bi+$media_3bi+$media_4bi)/4;
				  
				  
				  
			?>
        
        <td align="center"><? echo number_format($media_1bi+0);echo ",0"; ?></td>
        <td align="center"><? echo number_format($media_2bi+0);echo ",0"; ?></td>
        <td align="center"><? echo number_format($media_3bi+0);echo ",0"; ?></td>
        <td align="center"><? echo number_format($media_4bi+0);echo ",0"; ?></td>
        <td align="center"><? if($media_final <24){echo number_format($recupercaoFinal);echo ",0"; }else{ echo "0,0";}?></td>
        <td align="center"><? 
							if($media_final <6){ 
								
								$media_final = ($media_final+$recupercaoFinal)/2;
							}
							echo number_format($media_final);echo ",0"; 
							
							?>
        </td>
        <td align="center"><? if($media_final >= 6){ echo "APROVADO"; }else{ echo "REPROVADO"; }?></td>
      </tr>
     <? }} ?> 
      
    </table>
      <table width="700" border="0">
        <tr>
          <td colspan="2" align="center"><br /></td>
        </tr>
        <tr>
          <td align="center"><p>&nbsp;</p>
            <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
			$nome_professor = $res_colaborador['nome'];
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		}
	  }
	 }
	?>
            <p>
              <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?>
              <br />
          PROF&ordf;: <? echo strtoupper($nome_professor); ?> </p></td>
          <td align="center"><p>&nbsp;</p>
            <?
	  $sql_verifica_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	   while($res_verifica_turma = mysqli_fetch_array($sql_verifica_turma)){
		   
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_verifica_turma['coordenador']."'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
	
		$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			
			$nome_professor = $res_colaborador['nome'];
			
              $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '".$res_verifica['cpf']."'");
				while($res_coladorares = mysqli_fetch_array($sql_coladorares)){	
					$imagem = $res_coladorares['comprovante'];
							 
							 
		 }
		}
	  }
	 }
	?>
            <p>
              <?
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					?>
              <br />
          COORDENADOR(A)&ordf;: <? echo strtoupper($nome_professor); ?></p></td>
        </tr>
    </table></td>
  </tr>
</table>
<? } ?>
</body>
</html>