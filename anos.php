
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
</head>

<body>

<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm">
        <a style="margin:5px 0 0 0;" href="scripts/cadastrar_turma.php?operador=<? echo $operador; ?>" rel="superbox[iframe][340x370]" class="btn btn-success">Cadastrar turma</a>
        <hr />
        <p class="h4 text-primary">Turmas cadastradas</p>
        <? if(@$_GET['acao'] == 'excluir'){
        
		echo "<div class='p-3 mb-2 bg-info text-white'>Turma excluída com sucesso! Aguarde..</div>";
		
		$turma = $_GET['turma'];
		
		mysqli_query($conexao_bd, "DELETE FROM turmas WHERE code_turma = '$turma'");
		
		?>
		
		  <script type="text/javascript">
              function redirectTime(){
                 window.location = "?p=turmas"
              }
           </script>
           <body onLoad="setTimeout('redirectTime()', 3000)">
		
		
		<? }?>
        <table class="table table-striped" style="border:1px solid #000;">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">S&Eacute;RIE</th>
              <th scope="col" align="center">TURMA</th>
              <th scope="col" align="center">TURNO</th>
              <th scope="col" align="center">SALA</th>
              <th scope="col" align="center">N&deg; ALUNOS</th>
              <th scope="col" align="center">LAUDO</th>
              <th align="center" scope="col">IMPRESSO</th>
              <th scope="col" align="center">TRANSF.</th>
              <th scope="col" align="center">REND.%</th>
              <th scope="col" align="center">OP&Ccedil;&Otilde;ES</th>
              <th scope="col" align="center"><a href="pdf/turmas.php?professor=<? echo $operador; ?>" target="_blank"><img src="../img/impressora.png" alt="" width="25" height="25" border="0" title="Imprimir relatório" /></a></th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0;
		  $k = 0;
		   $conta_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_serie = '1' OR code_serie = '2' OR code_serie = '3' OR code_serie = '4' OR code_serie = '5' OR code_serie = '6' OR code_serie = '7' OR code_serie = '8' OR code_serie = '9'");
			   while($res_turma = mysqli_fetch_array($conta_turma)){
				  $k = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res_turma['code_turma']."' AND status != 'TRANSFERIDO'"))+$k;
			   }
			
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM turmas");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		   
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['code_serie']; ?>° ano</td>
              <td align="center"><? echo $res['tipo_turma']; ?></td>
              <td align="center"><? echo $res['turno']; ?></td>
              <td align="center"><? echo $res['sala']; ?></td>
              <td align="center" ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE status != 'TRANSFERIDO' AND turma = '".$res['code_turma']."'"));?></td>
              <td align="center"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res['code_turma']."' AND especial = 'SIM' AND status = 'Ativo'"));?></td>
              <td align="center"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res['code_turma']."' AND impresso = 'SIM' AND status = 'Ativo'"));?></td>
              <td align="center"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res['code_turma']."' AND transferido = 'SIM' AND status != 'CANCELADO'"));?></td>
              <td align="center"><? /*$total_envios = 0; $conta_alunos = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res['code_turma']."' AND transferido != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res['code_turma']."' AND code_dia_atividade < '$code_hoje'");
			    
				while($res_atividades = mysqli_fetch_array($total_atividades)){
               if($res_atividades['tipo_envio'] == 'arquivo'){
				   $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
				   
				   while($res_enviados = mysqli_fetch_array($enviados)){
					   $verifica_impresso = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res_enviados['code_aluno']."'");
						 while($res_alunos = mysqli_fetch_array($verifica_impresso)){
							 if($res_alunos['transferido'] == 'SIM'){
						}else{
							$conta_alunos++;
						}}
				  }
			   }
			   
               if($res_atividades['tipo_envio'] == 'multipla'){
					$verifica_aluno = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res['code_turma']."' AND impresso != 'SIM' AND transferido != 'SIM'");
					 while($res_alunos = mysqli_fetch_array($verifica_aluno)){ 
						
						$sql_atividade_aluno = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' LIMIT 1");

						if(mysqli_num_rows($sql_atividade_aluno) >= 1){  
							$conta_alunos++;
						}
						 
					}
			   }
				}
				
			   $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   */
			   
			   
			   $percentual_frequencia = number_format(($conta_alunos*100)/$total_alunos,1);
			   
			  ?>                <a rel="superbox[iframe][840x150]" href="pdf/relatorio_frequencia.php?turma=<? echo $res['code_turma']; ?>"><? echo $percentual_frequencia ?>%</a>
              
              
              
              </td>
              <td colspan="2">

                  <a href="scripts/adicionar_aluno.php?turma=<? echo $res['code_turma']; ?>&operador=<? echo $operador; ?>" rel="superbox[iframe][340x390]"><img src="img/adicionar_aluno.png" title="Adicionar novo aluno a esta turma" width="18" height="18" border="0" /></a>              

              
                <a href="excluir/turmas.php?id=<? echo $res['id']; ?>&turma=<? echo $_GET['turma']; ?>&mes=<? echo $_GET['mes']; ?>" rel="superbox[iframe][300x100]"><img src="../img/deleta.png" width="20" height="20" border="0" title="Excluir" /></a>              

                <a rel="superbox[iframe][950x700]" href="scripts/disciplinas.php?turma=<? echo $res['code_turma']; ?>&acao=mostrar_disciplinas&operador=<? echo $operador; ?>"><img src="img/professor.png" width="18" height="18" border="0" title="Lotação de professores" /></a>
                
                <a href="?p=anos&turma=<? echo $res['code_turma']; ?>&acao=mostrar&?operador=<? echo $operador; ?>"> <img src="img/verificar_alunos.jpg" width="18" height="18" border="0" title="Mostrar alunos da turma" /></a>
              
            <a target="_blank" rel="superbox[iframe][600x130]" href="scripts/frequencia_geral.php?turma=<? echo $res['code_turma']; ?>"><img src="../img/frequencia.png" width="18" height="18" border="0" /></a>
            
            <a rel="superbox[iframe][600x130]" href="scripts/mes_descricao.php?turma=<? echo $res['code_turma']; ?>&operador=<? echo $operador ?>"><img src="../img/descritovo.png" width="18" height="18" border="0" title="Resumo de atividades do mês" /></a>
            
            <a rel="superbox[iframe][600x130]" href="scripts/bimestre.php?turma=<? echo $res['code_turma']; ?>&operador=<? echo $operador ?>"><img src="../img/boletim_escolar.png" width="18" height="18" border="0" title="Resumo de notas do bimestre" /></a>
            
            <a rel="superbox[iframe][600x130]" href="scripts/notas_bimestre.php?turma=<? echo $res['code_turma']; ?>&operador=<? echo $operador ?>"><img src="img/notas_finais.png" alt="" width="18" height="18" border="0" title="Resumo de notas" /></a>
            
            
            
            <a rel="superbox[iframe][600x100]" href="scripts/mes_boletim_turma.php?turma=<? echo $res['code_turma']; ?>&operador=<? echo $operador ?>"><img src="img/boletim.png" alt="" width="18" height="18" border="0" title="Emitir boletim da turma" /></a>
         	
            
            <a rel="superbox[iframe][950x350]" href="scripts/calendario_aulas.php?turma=<? echo $res['code_turma']; ?>&operador=<? echo $operador ?>"><img src="../img/calendario_semanal.png" width="20" height="20" border="0" title="Abrir calendário de aulas" /></a>
         
         
         
            <? if(@$_GET['acao'] == 'mostrar' && $_GET['turma'] == $res['code_turma']){ ?>

            <tr>
              <th colspan="13" align="center" bgcolor="#00CCFF" scope="row">HIST&Oacute;RICO DE ALUNOS DESSA TURMA | <a style="text-decoration:none; padding:5px; background:#090; color:#FFF;" title="Voltar as outras turmas" href="?p=anos">Voltar</a> | <a href="pdf/relatorio_alunos.php?turma=<? echo $res['code_turma']; ?>" target="_blank"><img src="../img/descritovo.png" alt="" width="18" height="18" border="0" title="Imprimir lista de alunos" /></a></th>
            </tr>
            <tr>
              <th colspan="13" scope="row">
              <table width="1009" class="table" style="font:13px Arial, Helvetica, sans-serif;">
              <thead class="thead-dark">
                <tr>
                  <th width="19" height="18" align="center" scope="col">N&deg;</th>
                  <th width="342" scope="col">Nome do aluno</th>
                  <th width="231" scope="col">Telefone</th>
                  <th width="55" scope="col">1&deg; BIM.</th>
                  <th width="57" scope="col">2&deg; BIM.</th>
                  <th width="64" scope="col">3&deg; BIM.</th>
                  <th width="60" scope="col">4&deg; BIM.</th>
                  <th width="145" scope="col">OP&Ccedil;&Otilde;ES<a rel="superbox[iframe][600x130]" href="scripts/mes_descricao.php?turma=<? echo $res['code_turma']; ?>&amp;operador=<? echo $operador ?>"></a>
                  
                  </th>
                </tr>
              </thead>
              <tbody>
              <?
			   $sql_turma_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."'");
			   while($res_turma_alunos = mysqli_fetch_array($sql_turma_alunos)){
				   
				$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_turma_alunos['aluno']."'");
			   	while($res_alunos = mysqli_fetch_array($sql_alunos)){
			  ?>
                <tr bgcolor="#FFEADF">
                  <th align="center" scope="row"><? echo $res_turma_alunos['n_chamada']; ?></th>
                  <td><? echo strtoupper($res_alunos['nome_aluno']); ?> 
                     <? if($res_turma_alunos['transferido'] == 'SIM'){ ?> <img src="../img/transferido.png" width="20" height="10" /> <? } ?>
                     <? if($res_turma_alunos['suprido'] == 'SIM'){ ?> <img src="../img/suprido.png" width="20" height="10" /> <? } ?>
                  	 <? if($res_turma_alunos['impresso'] == 'SIM'){ ?> <img src="img/amarelo.png" width="20" height="10" /> <? } ?>
                     <? if($res_turma_alunos['laudado'] == 'SIM'){ ?> <img src="img/roxo.fw.png" width="20" height="10" /> <? } ?>
                  
                     ,
                     <a rel="superbox[iframe][300x100]" href="scripts/associar_aluno_comunidade.php?aluno=<? echo $res_turma_alunos['aluno']; ?>"><img src="../img/onibus.png" width="20" height="20" /></a></td>

                  <td>
                  
				<?
                    $sql = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE aluno = '".$res_turma_alunos['aluno']."' AND tipo = 'Telefone'");
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
                  
                  
                  
                  <a rel="superbox[iframe][390x400]" href="scripts/informar_busca_ativa_atividade_coordenacao.php?atividade=COORD.<? echo $nome; ?>&operador=<? echo $operador; ?>&professor=COORD.<? echo $nome; ?>&aluno=<? echo $res_alunos['code_aluno']; ?>"><img src="../img/busca_ativa_celular.png" title="Informar busca ativa" alt="" width="20" height="20" border="0" /></a>
                  
                  </td>
                  <td align="center"><?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND periodo = '1' AND code_dia_atividade < '$code_hoje'");
				    while($res_atividade = mysqli_fetch_array($sql_atividades)){
						if($res_atividade['code_dia_atividade'] <= $code_hoje){
							$total_atividades++;
							
                  			$enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['code_aluno']."' AND data != '' AND code_atividade = '".$res_atividade['code_atividade']."'");
							
							if(mysqli_num_rows($enviados) >= 1){
								$enviado++;
							}
							
						}
					}
				
                       
				   
				   $percentual_frequencia = ($enviado*100)/$total_atividades;
				   if($percentual_frequencia > 100){
					   echo "100";
				   }else{
                       echo number_format($percentual_frequencia,1);
				   }
				
                  ?>
                    %</td>
                  <td align="center"><?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND periodo = '2' AND code_dia_atividade < '$code_hoje'");
				    while($res_atividade = mysqli_fetch_array($sql_atividades)){
						if($res_atividade['code_dia_atividade'] <= $code_hoje){
							$total_atividades++;
							
                  			$enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['code_aluno']."' AND data != '' AND code_atividade = '".$res_atividade['code_atividade']."'");
							
							if(mysqli_num_rows($enviados) >= 1){
								$enviado++;
							}
							
						}
					}
				
                       
				   
				   $percentual_frequencia = ($enviado*100)/$total_atividades;
				   if($percentual_frequencia > 100){
					   echo "100";
				   }else{
                       echo number_format($percentual_frequencia,1);
				   }
				
                  ?>
%</td>
                  <td align="center">
                    <?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res_alunos['turma']."' AND periodo = '3' AND code_dia_atividade < '$code_hoje'");
				    while($res_atividade = mysqli_fetch_array($sql_atividades)){
						if($res_atividade['code_dia_atividade'] <= $code_hoje){
							$total_atividades++;
						}
					}
				
                       
                   $enviados = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['code_aluno']."' AND data != ''"));
				   
				   $percentual_frequencia = ($enviados*100)/$total_atividades;
				   if($percentual_frequencia > 100){
					   echo "100";
				   }else{
                       echo number_format($percentual_frequencia,1);
				   }
				
                  ?>%</td>
                  <td align="center"><?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res_alunos['turma']."' AND periodo = '4' AND code_dia_atividade < '$code_hoje'");
                   $total_atividades = mysqli_num_rows($sql_atividades);
                 
                   while($res_atividades = mysqli_fetch_array($sql_atividades)){
                       
                       if($res_atividades['tipo_envio'] == 'arquivo'){
                           $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."' AND data != ''");
                           if(mysqli_num_rows($enviados) >= 1){ $enviado++; }
                       }else{
                           $enviados = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['code_aluno']."'");
                           $total_questao = mysqli_num_rows($enviados);
                           if(mysqli_num_rows($enviados) >= 1){ $enviado++; }		   
                       }
                       
                  }
                        echo number_format(($enviado*100)/$total_atividades,1);
                  ?>
%</td>
                  <td>
                                                          
                    <a rel="superbox[iframe][250x100]" href="scripts/mes_boletim.php?aluno=<? echo $res_alunos['code_aluno']; ?>&turma=<? echo $res_alunos['turma']; ?>&operador=<? echo $operador ?>"><img src="img/boletim.png" width="20" height="20" border="0" title="Emitir boletim do aluno" /></a>
                    <a rel="superbox[iframe][750x400]" href="scripts/matricular_turma.php?aluno=<? echo $res_alunos['code_aluno']; ?>"><img src="../img/turma.png" width="30" height="20" border="0" title="Informações da matricula" /></a>
                    
                    <a href="?p=visao_geral_de_alunos&aluno=<? echo $res_alunos['code_aluno']; ?>&turma=<? echo $_GET['turma']; ?>"><img src="../img/relatorio_completo.png" width="20" height="20" border="0" title="Visão geral do aluno" /></a>
                    
                    <a rel="superbox[iframe][350x350]" href="scripts/lancar_atividades_impressas.php?aluno=<? echo $res_alunos['code_aluno']; ?>&turma=<? echo $_GET['turma']; ?>&bimestre=1"><img src="../img/atividade_impressa.png" width="20" height="20" border="0" title="Lançar notas e frequência de atividades impressas" /></a></td>
                </tr>
              <? }} ?>
              </tbody>
            </table>
                          </th>
            </tr>
           <? } ?>
            
            
         <? } ?>
                     <tr>
              <th colspan="12" align="center" scope="col"><strong>Total de alunos matriculados: </strong><? echo $k; ?> alunos</th>
            </tr>

        </table>
        <hr />
        <img src="img/amarelo.png" width="20" height="10" /><strong> Atividade impressa</strong>
        <img src="img/roxo.fw.png" width="20" height="10" /> <strong>Atendimento educacional especializado - AEE   </strong>   
        <img src="../img/transferido.png" width="20" height="10" /><strong>Aluno transferido</strong>        
        <img src="../img/suprido.png" width="20" height="10" /> <strong>Aluno suprido    </strong>    
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
            
            
            <? if(@$_GET['acao'] == 'excluir_aluno'){
              $turma = $_GET['turma'];
			  mysqli_query($conexao_bd, "DELETE FROM alunos WHERE id = '".$_GET['id']."'");
			  
			  echo "<script language='javascript'>window.location='?p=turmas&turma=$turma&acao=mostrar';</script>";
			 
			}?>