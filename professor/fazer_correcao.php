
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
#container_tuod{
	background:#FFF;
}
</style>
</head>

<body>
<div class="container_tuod"> <? $turma = $_GET['turma']; $atividade = $_GET['atividade']; ?>
    <div class="container">
      <div class="row">
        <div class="col-sm">
		<a style="margin:5px 0 0 0;" href="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>" class="btn btn-info">Voltar</a>
        <?
		$id_atividade = 0; $verifica_plano = 0; $code_dia_atividade = 0;
		 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '".$_GET['atividade']."'");
		  while($res_atividade = mysqli_fetch_array($sql_atividades)){
				
				$id_atividade = $res_atividade['id'];
				$code_dia_atividade = $res_atividade['code_dia_atividade'];
				
				   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_atividade['turma']."'");
	         		while($res_turma = mysqli_fetch_array($sql_turma)){
						
					  if($res_turma['fase'] == 'ANOS INICIAS'){
						$verifica_plano = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula_iniciais WHERE id_aula = '$id_atividade' AND modalidade = 'ONLINE'"));
					  }else{
						$verifica_plano = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula WHERE id_aula = '$id_atividade' AND modalidade = 'ONLINE'"));
						}
			  
		?>
        <p class="h5 text-primary"><strong>Resumo de atividades</strong></p>
        <div class="alert alert-primary" role="alert"><strong>Objetivo:</strong> <? echo $res_atividade['objetivo'] ?>
        </div>
        <strong>SÉRIE:</strong> <? echo $res_turma['code_serie'] ?>° ANO - <strong>TURMA:</strong> <? echo $res_turma['tipo_turma'] ?><strong> - TURNO:</strong> <? echo $res_turma['turno'] ?><strong> - COMPONENTE:</strong> <? echo $res_turma['componente'] ?>
        </div>
        <? }} ?>
        
        <? if($_GET['acao'] == 'frequencia_a_todos'){
		  echo "<div class='alert alert-dark' role='alert'><img src='../img/carregando1.gif' width='20' height='20' />Processando...</div>";

			$turma = $_GET['turma'];
			$atividade = $_GET['atividade'];
			
			$frequencia = $_GET['frequencia'];
			$status = $_GET['status'];
			
			 $sql_alunos_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE status != 'TRANSFERIDO' AND turma = '".$_GET['turma']."'");
			  while($res_alunos = mysqli_fetch_array($sql_alunos_turma)){
								
				$sql_verifica_turma = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '$atividade'");
				if(mysqli_num_rows($sql_verifica_turma) == ''){
					mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('$data', '', '', '".$res_alunos['aluno']."', '$atividade', '', 'SIM')");

				}else{

					mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET presente = 'SIM' WHERE code_atividade = '$atividade' AND code_aluno = '".$res_alunos['aluno']."'");

					$aluno = $res_alunos['aluno'];
				}
				
			 }
			
			
			echo "<script language='javascript'>window.location='?p=fazer_correcao&turma=$turma&atividade=$atividade';</script>";
		
		}?>
        
        <? if($_GET['acao'] == 'frequencia_excluir'){
		  echo "<div class='alert alert-dark' role='alert'><img src='../img/carregando1.gif' width='20' height='20' />Processando...</div>";

			$turma = $_GET['turma'];
			$atividade = $_GET['atividade'];
			
			$frequencia = $_GET['frequencia'];
			$status = $_GET['status'];
					
			 $sql_alunos_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE status != 'TRANSFERIDO' AND turma = '".$_GET['turma']."'");
			  while($res_alunos = mysqli_fetch_array($sql_alunos_turma)){
								
								$aluno = $res_alunos['aluno'];
								
				$sql_verifica_turma = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '$atividade'");
				if(mysqli_num_rows($sql_verifica_turma) == ''){
					mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('$data', '', '', '".$res_alunos['aluno']."', '$atividade', '', 'NAO')");
			
				}else{

					mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET presente = 'NAO', status = '' WHERE code_atividade = '$atividade' AND code_aluno = '$aluno'");

					
				}
				
			 }
			
			echo "<script language='javascript'>window.location='?p=fazer_correcao&turma=$turma&atividade=$atividade';</script>";
		
		}?>
        
        <table border="2" class="table table-striped table-hover table-bordered" style="border:1px solid #000;">
           <thead class="thead-dark">
            <tr>
              <th scope="col">STATUS</th>
              <th width="19" scope="col">N°</th>
              <th width="238" scope="col">NOME</th>
              <th width="149" scope="col">ENTREGA</th>
              <th width="81" scope="col">NOTA</th>
              <th width="130" scope="col">TRABALHO</th>
              
              <? if($verifica_plano <= 0){ ?>
              <th width="174" align="center" scope="col">FREQUENCIA 
              <a href="?p=fazer_correcao&amp;acao=frequencia_a_todos&amp;turma=<? echo $_GET['turma']; ?>&amp;tipo_envio=<? echo $_GET['tipo_envio']; ?>&amp;componente=<? echo $_GET['componente']; ?>&amp;mes=<? echo $_GET['mes']; ?>&amp;atividade=<? echo $_GET['atividade']; ?>" onclick="return confirm('Tem certeza que deseja aplicar frequ&ecirc;ncia a todos os alunos nesta atividade?');"><img src="img/corretos.png" width="25" height="25" border="0" title="Aplicar frequ&ecirc;ncia a todos os alunos" /></a>
              
              <a href="?p=fazer_correcao&amp;acao=frequencia_excluir&amp;turma=<? echo $_GET['turma']; ?>&amp;tipo_envio=<? echo $_GET['tipo_envio']; ?>&amp;componente=<? echo $_GET['componente']; ?>&amp;mes=<? echo $_GET['mes']; ?>&amp;atividade=<? echo $_GET['atividade']; ?>" onclick="return confirm('Todas as frequ&ecirc;ncias e atividades enviadas ser&atilde;o exclu&iacute;das. Deseja continuar?');"><img src="img/errado.png" alt="" width="25" height="25" border="0" title="Apagar a frequ&ecirc;ncia a todos os alunos" /></a>
              </th>
              <? } ?>
              
              
              <th align="center" width="144" scope="col">
                
                <a href="?p=fazer_correcao&amp;turma=<? echo $_GET['turma']; ?>&acao=confirmar_enttrega_atividade_tudo&status=CORRIGIDO&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes'] ?>"><img style="border:1px solid #FFF; border-radius:5px;" src="../img/fez_atividade_branco.png" alt="" width="20" height="20" border="0" title="Confirmar entrega de atividade" /></a>
                
                <a href="?p=fazer_correcao&acao=frequencia&turma=<? echo $_GET['turma']; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>&componente=<? echo $_GET['componente']; ?>&atividade=<? echo $_GET['atividade']; ?>" onclick="return confirm('Tem certeza que deseja aplicar frequência a todos os alunos nesta atividade?');"></a>
                
                <a onclick="return confirmafcao();" href="?p=fazer_correcao&amp;turma=<? echo $_GET['turma']; ?>&acao=excluir_tudo&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&componente=<? echo $_GET['componente']; ?>&atividade=<? echo $_GET['atividade']; ?>&mes=<? echo $_GET['mes']; ?>"><img style="border:1px solid #FFF; border-radius:5px;" src="../img/fez_atividade_excluir.png" alt="" width="20" height="20" border="0" title="Excluir todas as atividades" /></a>
                
                <a href="?p=fazer_correcao&acao=frequencia_excluir&turma=<? echo $_GET['turma']; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&componente=<? echo $_GET['componente']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>&atividade=<? echo $_GET['atividade']; ?>" onclick="return confirmafcao('Deseja excluir as atividades de todos os alunos. Deseja continuar?');"></a>
             
                
                
              <a target="_blank" href="pdf/relatorio_enviado.php?turma=<? echo $_GET['turma'] ?>&componente=<? echo $_GET['componente']; ?>&atividade=<? echo $_GET['atividade'] ?>"><img src="../img/impressora.png" width="25" height="25" border="0" /></a></th>
             </tr>
          </thead>
          
          <tbody>
          <? $i = 0;
	   $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM'");
	   while($res_turmas = mysqli_fetch_array($sql_turmas)){
		        
	    $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_turmas['aluno']."'");
	     while($res_alunos = mysqli_fetch_array($sql_turma)){
		  
		  
		  $i++;
		  $aluno = 0;
		  $aluno = $res_turmas['aluno'];
		  $telefone = $res_alunos['telefone'];
		  
		  	 $telefone = str_replace(" ", "", $telefone); 
			 $telefone = str_replace(".", "", $telefone);
			 $telefone = str_replace("(", "", $telefone); 
			 $telefone = str_replace(")", "", $telefone);
		  
		  ?>
            <tr>
            
              <?
			  
			   $sql_verifica_duplicidade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['code_aluno']."' AND code_atividade = '".$_GET['atividade']."'");
			   if(mysqli_num_rows($sql_verifica_duplicidade) >= 2){
				    while($res = mysqli_fetch_array($sql_verifica_duplicidade)){
						mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas WHERE id = '".$res['id']."'");
						break;
				   }
			   }
			   
			   
			  
			  
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."' AND data != '' AND status = 'CORRIGIDO' OR arquivo != ''");
			  ?>
              <th width="95" align="center" scope="row" <? $status_envio = 0; if(mysqli_num_rows($sql_data) == ''){ ?> bgcolor="#F7C6B9" <? } ?>><? 
			   if(mysqli_num_rows($sql_data) == ''){
			   	echo "<strong style='font:12px Arial;' class='text-danger'><strong>NÃO ENTREGUE</strong></strong>";
			   }else{
				$status_envio = "ENTREGUE";
				echo "<strong style='font:12px Arial;'><strong>ENTREGUE</strong></strong>";
			   }
			   ?>
               </th>
              <th><strong style='font:12px Arial;'><strong><? echo $res_turmas['n_chamada']; ?></strong></strong></th>
              <td id="#<? echo $res_alunos['code_aluno']; ?>"><p style="font:12px Arial, Helvetica, sans-serif;" id="#<? echo $res_alunos['code_aluno']; ?>"></a><strong>
              
              <?
               
			   $sql_verificar_atestado = mysqli_query($conexao_bd, "SELECT * FROM atestado_dias WHERE aluno = '".$res_alunos['code_aluno']."' AND code_dia = '$code_dia_atividade'");
			   if(mysqli_num_rows($sql_verificar_atestado) >=1){ echo "<strong style='color:#F90;'>"; }?>
			  
			    <? echo strtoupper($res_alunos['nome_aluno']); ?>
              
              <? if(mysqli_num_rows($sql_verificar_atestado) >=1){ echo "</strong>"; }?>
              
              </strong>
                  <? if($res_turmas['transferido'] == 'SIM'){ ?> <img src="../img/transferido.png" width="10" height="10" /> <? } ?>
                  <? if($res_turmas['suprido'] == 'SIM'){ ?> <img src="../img/suprido.png" width="10" height="10" /> <? } ?>
        		  <? if($res_turmas['impresso'] == 'SIM'){ ?> <img src="img/amarelo.png" width="10" height="10" /> <? } ?>
                  <? if($res_turmas['laudado'] == 'SIM'){ ?> <img src="img/roxo.fw.png" width="10" height="10" title="<?
					$sql_aee = mysqli_query($conexao_bd, "SELECT * FROM aee_descricao WHERE aluno = '".$res_alunos['code_aluno']."'");
						while($res_aee = mysqli_fetch_array($sql_aee)){
							echo "CID: "; echo $res_aee['cid']; echo " - "; echo $res_aee['descricao'];
							echo " - Relato: "; echo $res_aee['observacao'];
					   }
				  ?>" /> <? } ?>
                                                                 
                 
              </p>
              </td>
              <td><?
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
			   while($res_data = mysqli_fetch_array($sql_data)){
				   if($res_data['data'] == ''){
			  ?>

              
				   <img src='img/olho_vizua.png' title='<?
                     
					 $sql_visualiza = mysqli_query($conexao_bd, "SELECT * FROM visualiza_atividade WHERE atividade = '$id_atividade' AND aluno = '".$res_alunos['code_aluno']."'");
					  while($res_visualiza = mysqli_fetch_array($sql_visualiza)){
						  echo $res_visualiza['data'];
						  echo "<-->";
					  }
				     
				   ?>' width='15' height='15'>
			  <?
				   }else{
				   echo $res_data['data'];
				   }
				   
			   }
			  ?>
                      <a rel="superbox[iframe][390x400]" href="scripts/informar_busca_ativa_atividade.php?atividade=<? echo $id_atividade; ?>&operador=<? echo $operador; ?>&professor=<? echo $usuario; ?>&componente=<? echo $_GET['componente']; ?>&aluno=<? echo $aluno; ?>"><img src="../img/busca_ativa_celular.png" width="20" height="20" border="0" title="Informar busca ativa" /></a>
              </td>
              <td>
			  <?
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
			   while($res_data = mysqli_fetch_array($sql_data)){              
			  ?>              
              <form name="" method="post" action="" enctype="multipart/form-data">
              <input style="border:1px solid #CCC; width:50px; text-align:center; border-radius:5px;"type="number" id="nota" name="nota" min="0" max="10" step="0.1" pattern="\d+(\.\d{1})?" value="<? echo $res_data['nota']; ?>" title="Use um formato válido (ex: 8.5)" required>
              <input type="hidden" name="turma" value="<? echo $_GET['turma']; ?>" />
              <input type="hidden" name="tipo_envio" value="<? echo $_GET['tipo_envio']; ?>" />
              <input type="hidden" name="atividade" value="<? echo $_GET['atividade']; ?>" />
              <input type="hidden" name="code_aluno" value="<? echo $res_alunos['code_aluno']; ?>" />
              </form>
              <? } ?>
              </td>
              <td align="center">
			  <?
			  $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas_extras WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
			  while($res_data = mysqli_fetch_array($sql_data)){
				  $arquivo = $res_data['arquivo'];
				  if($arquivo != ''){
				  echo "<a target='_blank' href='arquivos/$arquivo'><img src='../img/baixar.png' width='15' height='15'></a> ";
				  }
			  }
			  ?>
              
                            
              </td>
              <? if($verifica_plano <= 0){ ?>
              <td align="center">
              <? 
			  $presenca = NULL;
			  $status_atividade = NULL;
              $sql_presenca = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '$aluno' AND presente = 'SIM'");
			    while($res_atividade = mysqli_fetch_array($sql_presenca)){
				  $presenca = $res_atividade['presente'];
				  $status_atividade = $res_atividade['status'];
				} 
			  if(mysqli_num_rows($sql_presenca) <= 0){
			  ?>
              <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=presenca_sala&aluno=<? echo $aluno; ?>&atividade=<? echo $_GET['atividade']; ?>&status=<? echo $status_atividade; ?>&frequencia=SIM"><img src="img/corretos.png" width="20" height="20" border="0" title="Informar que o aluno está frequênte" /></a>
              <? }else{ ?>
              <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=presenca_sala&aluno=<? echo $aluno; ?>&atividade=<? echo $_GET['atividade']; ?>&status=NAO&frequencia=NAO"><img src="img/errado_atividade.png" width="20" height="20" border="0" title="Informar que o aluno está faltou" /></a>
              <? } ?>
              </td>
              <? } ?>
              <td >
              

			   <?
			  $presenca = NULL;
			  $status_atividade = NULL;
              $sql_presenca = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '$aluno' AND status = 'CORRIGIDO'");
			    while($res_atividade = mysqli_fetch_array($sql_presenca)){
				  $presenca = $res_atividade['presente'];
				  $status_atividade = $res_atividade['status'];
				}
			  
			  if(mysqli_num_rows($sql_presenca) >= 1){   
			   ?>              
                <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=excluir_atividade&aluno=<? echo $aluno; ?>&atividade=<? echo $_GET['atividade']; ?>&status=<? echo $_GET['status']; ?>&frequencia=<? echo $presenca; ?>&mes=<? echo $_GET['mes']; ?>&arquivo=<? echo $res_atividade['arquivo']; ?>"><img src="../img/fez_atividade_excluir.png" width="20" height="20" border="0" title="Excluir" /></a>
              
			  <? }else{ ?>
              
              <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=confirmar_entrega&aluno=<? echo $aluno; ?>&atividade=<? echo $_GET['atividade']; ?>&status=CORRIGIDO&frequencia=SIM&mes=<? echo $_GET['mes']; ?>">          
              <img src="../img/fez_atividade.png" width="20" height="20" border="0" title="Confirmar entrega de atividade" /></a>
              <? } ?>
              


              
              
              <? 
			  
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
			   while($res_data = mysqli_fetch_array($sql_data)){			  
			  
			  if($res_data['arquivo'] == ''){ ?>
              <a rel="superbox[iframe][400x150]" href="scripts/enviar_atividade.php?atividade=<? echo $_GET['atividade']; ?>&aluno=<? echo $aluno; ?>"><img src="img/upload.png" width="25" height="25" border="0" /></a>
              <? }} ?>
           
           <?
			$sql_contato = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE aluno = '$aluno' AND contato != '' LIMIT 1");
		     while($res_contato = mysqli_fetch_array($sql_contato)){
				 
				 $telefone = $res_contato['contato'];
				 $telefone = str_replace(" ", "", $telefone); 
				 $telefone = str_replace(".", "", $telefone);
				 $telefone = str_replace("(", "", $telefone); 
				 $telefone = str_replace(")", "", $telefone);	
				 
			}
		   ?>
              
           <a href="https://api.whatsapp.com/send/?phone=55<? echo $telefone ?>&text&app_absent=0" target="_blank"><img src="img/whatsapp.png" width="25" height="20" title="Entrar em contato com o aluno" border="0" /></a>
           
           
             </td>
            </tr>
          <? }} ?>
          </tbody>
		</table>   
        
             
      </div><!-- col-sm -->
                <hr />
        <img src="img/amarelo.png" width="20" height="10" /><strong> Atividade impressa</strong>
        <img src="img/roxo.fw.png" width="20" height="10" /> <strong>Atendimento educacional especializado - AEE   </strong>   
        <img src="../img/transferido.png" width="20" height="10" /><strong>Aluno transferido</strong>        
        <img src="../img/suprido.png" width="20" height="10" /> <strong>Aluno suprido    </strong>  
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>


<? if(isset($_POST['nota'])){

$code_aluno = @$_POST['code_aluno'];
$nota = @$_POST['nota'];

$nota = str_replace(',','.', $nota);


if($nota >= 0 && $nota <= 10){
	
	mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$operador', 'CREDITO', '5', 'ALTERAÇÃO DE NOTA', '$data')");

mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET nota = '$nota', status = 'CORRIGIDO' WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '$code_aluno'");
echo "<script language='javascript'>window.alert('Informação registrada com sucesso!');window.location='';</script>";
 }else{
echo "<script language='javascript'>window.alert('A nota da atividade deve está no intervalo de 0 a 10!');</script>"; 
 }

	mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, CORRIGIU AS INSFORMAÇÕES DE NOTA DA $code_atividade DA ALUNA $code_aluno', '$operador')");
 
 
}?>


<? if($_GET['acao'] == 'confirmar_enttrega_atividade_tudo'){

$turma = $_GET['turma'];
$atividade = $_GET['atividade'];
$mes_atividade = $_GET['mes'];
$componente = $_GET['componente'];


$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM'");
 while($res_alunos = mysqli_fetch_array($sql_alunos)){
	 
	 $sql_verifica_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '$atividade'");
	 if(mysqli_num_rows($sql_verifica_atividade) <= 0){
		 mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('$data', 'CORRIGIDO', '', '".$res_alunos['aluno']."', '$atividade', '10', 'SIM')");
	 }else{
		 mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET nota = '10', status = 'CORRIGIDO', data = '$data', presente = 'SIM' WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '$atividade' AND code_aluno = '".$res_alunos['aluno']."'");
	}
}


echo "<script language='javascript'>window.alert('Operação realizada com sucesso!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=arquivo&componente=$componente&mes=$mes_atividade&atividade=$atividade';</script>";


}?>





<? if($_GET['acao'] == 'excluir_tudo'){

$turma = $_GET['turma'];
$atividade = $_GET['atividade'];
$mes_atividade = $_GET['mes'];
$componente = $_GET['componente'];


$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM'");
 while($res_alunos = mysqli_fetch_array($sql_alunos)){
	 
	 mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '$atividade'");
	 mysqli_query($conexao_bd, "DELETE FROM  atividades_enviadas_extras WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '$atividade'");

}


echo "<script language='javascript'>window.alert('Operação realizada com sucesso!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=arquivo&componente=$componente&mes=$mes_atividade&atividade=$atividade';</script>";


}?>






<? if($_GET['acao'] == 'confirmar_entrega'){

$turma = $_GET['turma'];
$atividade = $_GET['atividade'];
$mes_atividade = $_GET['mes'];
$componente = $_GET['componente'];
$aluno = $_GET['aluno'];
	 
	 $sql_verifica_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$aluno' AND code_atividade = '$atividade'");
	 if(mysqli_num_rows($sql_verifica_atividade) <= 0){
		 mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('$data', 'CORRIGIDO', '', '$aluno', '$atividade', '10', 'SIM')");
	 }else{
		 mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET nota = '10', status = 'CORRIGIDO', data = '$data', presente = 'SIM' WHERE code_aluno = '$aluno' AND code_atividade = '$atividade'");
	}
	 
echo "<script language='javascript'>window.alert('Operação realizada com sucesso!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=arquivo&componente=$componente&mes=$mes_atividade&atividade=$atividade';</script>";


}?>





<? if($_GET['acao'] == 'excluir_atividade'){

$turma = $_GET['turma'];
$atividade = $_GET['atividade'];
$mes_atividade = $_GET['mes'];
$componente = $_GET['componente'];
$aluno = $_GET['aluno'];
	 
	 mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas WHERE code_aluno = '$aluno' AND code_atividade = '$atividade'");
	 mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas_extras WHERE code_aluno = '$aluno' AND code_atividade = '$atividade'");

	 
echo "<script language='javascript'>window.alert('Operação realizada com sucesso!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=arquivo&componente=$componente&mes=$mes_atividade&atividade=$atividade';</script>";


}?>




<? if($_GET['acao'] == 'presenca_sala'){

$turma = $_GET['turma'];
$atividade = $_GET['atividade'];
$mes_atividade = $_GET['mes'];
$componente = $_GET['componente'];
$aluno = $_GET['aluno'];
$status = $_GET['status'];
$frequencia = $_GET['frequencia'];

$sql = mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET nota = '', status = '', data = '$data', presente = '$status', presente = '$frequencia' WHERE code_aluno = '$aluno' AND code_atividade = '$atividade'");


if($sql == ''){
echo "<script language='javascript'>window.alert('Ocorreu um erro!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=arquivo&componente=$componente&mes=$mes_atividade&atividade=$atividade';</script>";

}else{
echo "<script language='javascript'>window.alert('Operação realizada com sucesso!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=arquivo&componente=$componente&mes=$mes_atividade&atividade=$atividade';</script>";
}
}?>

