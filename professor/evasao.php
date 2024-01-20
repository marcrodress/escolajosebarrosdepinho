<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
body table{
	font:13px Arial, Helvetica, sans-serif;
	}
#container_tuod{
	background:#FFF;
}
</style>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm">
        <br />
        <p class="h4 text-primary"><strong>Alunos com alto risco de evasão escolar <img src="../img/evasao.png" width="40" height="40" /></strong></p>
          <form name="form" id="form">
            <select class="form-control" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
              <option>Selecione a turma</option>
             <?
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
			 ?>
              <option value="?p=infrequencia&turma=<? echo $res_turmas['code_turma']; ?>"><? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; ?></option>
              <? } ?>
            </select>
          </form>        
        <hr />
		
        <?
         
		 $turma = $_GET['turma'];
		 $sql_alunos_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM' AND laudado != 'SIM' AND impresso != 'SIM'");
		 $conta_atividades = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND code_dia_atividade < $code_hoje"));
		?>
        <table class="table table-striped table-bordered" border="0">
        <thead class="thead-light">
            <tr>
              <th colspan="12" scope="col" align="center"><h5 style="padding:0; margin:0;" align="center"><strong>CONTROLE DE LIVROS DID&Aacute;TICOS: 
			  
			  
			  <? 
			  $turma = $_GET['turma'];
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
              ?>
              			  
			  <? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; } ?>
              
              </strong> 
              <a target="_blank" href="pdf/imprimir_relatorio_livro_didatico.php?turma=<? echo $turma; ?>"><img align="right" src="../img/impressora.png" alt="" width="25" height="25" title="Imprimir relatório" style="padding:0; margin:0;" /></a></h5></th>
            </tr>
          </thead>        
          <tr>
            <td><strong>N°</strong></td>
            <td><strong>NOME</strong></td>
            <td><strong>PORTUGUÊS</strong></td>
            <td><strong>MATEMÁTICA</strong></td>
            <td><strong>HISTÓRIA</strong></td>
            <td><strong>GEOGRAFIA</strong></td>
            <td><strong>CIÊNCIAS</strong></td>
            <td><strong>INGÊS</strong></td>
            <td><strong>ED. FÍSICA</strong></td>
            <td><strong>RELIGIÃO</strong></td>
            <td><strong>ARTES</strong></td>
            <td><strong>CONTATO</strong></td>
          </tr>
          <? 
		   while($res_turmas = mysqli_fetch_array($sql_alunos_turma)){
	 	    $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_turmas['aluno']."'");
		     while($res_alunos = mysqli_fetch_array($sql_alunos)){
				 $total_enviados = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != ''"));
				 
				 $percentual = ($total_enviados*100)/$conta_atividades;
			if($percentual < 25){
		  ?>
          <tr style="font:11px Arial, Helvetica, sans-serif;">
            <td align="center"><strong><? echo $res_turmas['n_chamada']; ?></strong></td>
            <td><a href="?p=visao_geral_de_alunos&aluno=<? echo $res_turmas['aluno']; ?>&turma=<? echo $turma; ?>"><? echo strtoupper($res_alunos['nome_aluno']);?></a></td>
            <td align="center">
         <?
             
			 $sql_conta_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '96514' AND code_dia_atividade < $code_hoje");
			$conta_atividade_enviadas = 0;
			
			 $conta_atividade = mysqli_num_rows($sql_conta_atividades);
			
			  while($res_atividades = mysqli_fetch_array($sql_conta_atividades)){
				  
				  $verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != '' AND code_atividade = '".$res_atividades['code_atividade']."'");

				  if(mysqli_num_rows($verifica_envio) >= 1){
					  $conta_atividade_enviadas++;
				  }
				 
			 }
			 
			 echo $percentual = number_format(($conta_atividade_enviadas*100)/$conta_atividade);

			?>%
            </td>
            <td align="center"><?
             
			 $sql_conta_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '96461' AND code_dia_atividade < $code_hoje");
			$conta_atividade_enviadas = 0;
			
			 $conta_atividade = mysqli_num_rows($sql_conta_atividades);
			
			  while($res_atividades = mysqli_fetch_array($sql_conta_atividades)){
				  
				  $verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != '' AND code_atividade = '".$res_atividades['code_atividade']."'");

				  if(mysqli_num_rows($verifica_envio) >= 1){
					  $conta_atividade_enviadas++;
				  }
				 
			 }
			 
			 echo $percentual = number_format(($conta_atividade_enviadas*100)/$conta_atividade);

			?>
            % </td>
            <td align="center"><?
             
			 $sql_conta_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '99981' AND code_dia_atividade < $code_hoje");
			$conta_atividade_enviadas = 0;
			
			 $conta_atividade = mysqli_num_rows($sql_conta_atividades);
			
			  while($res_atividades = mysqli_fetch_array($sql_conta_atividades)){
				  
				  $verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != '' AND code_atividade = '".$res_atividades['code_atividade']."'");

				  if(mysqli_num_rows($verifica_envio) >= 1){
					  $conta_atividade_enviadas++;
				  }
				 
			 }
			 
			 echo $percentual = number_format(($conta_atividade_enviadas*100)/$conta_atividade);

			?>
            % </td>
            <td align="center"><?
             
			 $sql_conta_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '390341' AND code_dia_atividade < $code_hoje");
			$conta_atividade_enviadas = 0;
			
			 $conta_atividade = mysqli_num_rows($sql_conta_atividades);
			
			  while($res_atividades = mysqli_fetch_array($sql_conta_atividades)){
				  
				  $verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != '' AND code_atividade = '".$res_atividades['code_atividade']."'");

				  if(mysqli_num_rows($verifica_envio) >= 1){
					  $conta_atividade_enviadas++;
				  }
				 
			 }
			 
			 echo $percentual = number_format(($conta_atividade_enviadas*100)/$conta_atividade);

			?>
            % </td>
            <td align="center"><?
             
			 $sql_conta_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '95616' AND code_dia_atividade < $code_hoje");
			$conta_atividade_enviadas = 0;
			
			 $conta_atividade = mysqli_num_rows($sql_conta_atividades);
			
			  while($res_atividades = mysqli_fetch_array($sql_conta_atividades)){
				  
				  $verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != '' AND code_atividade = '".$res_atividades['code_atividade']."'");

				  if(mysqli_num_rows($verifica_envio) >= 1){
					  $conta_atividade_enviadas++;
				  }
				 
			 }
			 
			 echo $percentual = number_format(($conta_atividade_enviadas*100)/$conta_atividade);

			?>
            % </td>
            <td align="center"><?
             
			 $sql_conta_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '639811' AND code_dia_atividade < $code_hoje");
			$conta_atividade_enviadas = 0;
			
			 $conta_atividade = mysqli_num_rows($sql_conta_atividades);
			
			  while($res_atividades = mysqli_fetch_array($sql_conta_atividades)){
				  
				  $verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != '' AND code_atividade = '".$res_atividades['code_atividade']."'");

				  if(mysqli_num_rows($verifica_envio) >= 1){
					  $conta_atividade_enviadas++;
				  }
				 
			 }
			 
			 echo $percentual = number_format(($conta_atividade_enviadas*100)/$conta_atividade);

			?>
            % </td>
            <td align="center"><?
             
			 $sql_conta_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '9621345' AND code_dia_atividade < $code_hoje");
			$conta_atividade_enviadas = 0;
			
			 $conta_atividade = mysqli_num_rows($sql_conta_atividades);
			
			  while($res_atividades = mysqli_fetch_array($sql_conta_atividades)){
				  
				  $verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != '' AND code_atividade = '".$res_atividades['code_atividade']."'");

				  if(mysqli_num_rows($verifica_envio) >= 1){
					  $conta_atividade_enviadas++;
				  }
				 
			 }
			 
			 echo $percentual = number_format(($conta_atividade_enviadas*100)/$conta_atividade);

			?>
            % </td>
            <td align="center"><?
             
			 $sql_conta_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '74235' AND code_dia_atividade < $code_hoje");
			$conta_atividade_enviadas = 0;
			
			 $conta_atividade = mysqli_num_rows($sql_conta_atividades);
			
			  while($res_atividades = mysqli_fetch_array($sql_conta_atividades)){
				  
				  $verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != '' AND code_atividade = '".$res_atividades['code_atividade']."'");

				  if(mysqli_num_rows($verifica_envio) >= 1){
					  $conta_atividade_enviadas++;
				  }
				 
			 }
			 
			 echo $percentual = number_format(($conta_atividade_enviadas*100)/$conta_atividade);

			?>
            % </td>
            <td align="center"><?
             
			 $sql_conta_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '36244' AND code_dia_atividade < $code_hoje");
			$conta_atividade_enviadas = 0;
			
			 $conta_atividade = mysqli_num_rows($sql_conta_atividades);
			
			  while($res_atividades = mysqli_fetch_array($sql_conta_atividades)){
				  
				  $verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turmas['aluno']."' AND data != '' AND code_atividade = '".$res_atividades['code_atividade']."'");

				  if(mysqli_num_rows($verifica_envio) >= 1){
					  $conta_atividade_enviadas++;
				  }
				 
			 }
			 
			 echo $percentual = number_format(($conta_atividade_enviadas*100)/$conta_atividade);

			?>
            % </td>
            <td style="font:10px Arial, Helvetica, sans-serif">
            <a rel="superbox[iframe][400x250]" href="scripts/contato_alunos.php?aluno=<? echo $res_turmas['aluno']; ?>"><img src="../img/editar_contato.png" width="10" height="10" border="0" title="Editar informações de contato" /></a>
             <?
				$sql = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE aluno = '".$res_turmas['aluno']."' AND tipo = 'Telefone'");
				 while($res = mysqli_fetch_array($sql)){
					 $contato = $res['contato'];
					 
				 $contato = str_replace(" ", "", $contato); 
				 $contato = str_replace(".", "", $contato);
				 $contato = str_replace("(", "", $contato); 
				 $contato = str_replace(")", "", $contato);
				 					 
					 echo "<a href='https://api.whatsapp.com/send/?phone=55$contato&text&app_absent=0' target='_blank'>$contato</a>";
					 
					 echo " / ";
				}
			?> 
			  
 <a rel="superbox[iframe][390x400]" href="scripts/informar_busca_ativa_atividade_coordenacao.php?atividade=COORD.<? echo $nome; ?>&operador=<? echo $operador; ?>&professor=COORD.<? echo $nome; ?>&aluno=<? echo $res_turmas['aluno']; ?>"><img src="../img/busca_ativa_celular.png" title="Informar busca ativa" alt="" width="10" height="10" border="0" /></a>
            </td>
          </tr>
          <? }}} ?>
        </table>

        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
