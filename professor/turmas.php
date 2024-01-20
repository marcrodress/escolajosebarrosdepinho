<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Language" content="pt-br, en, fr, it">
<style>
#container_tuod{
	background:#FFF;
}
</style>
<? 
mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$operador', 'CREDITO', '5', 'Acesso ao turmas', '$data')");
?>
</head>

<body>

<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm">

        <p class="h4 text-primary">Minhas turmas</p>
        
              
        <table class="table table-striped" style="font:12px Arial, Helvetica, sans-serif;">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Sala</th>
              <th scope="col">Componente</th>
              <th scope="col">Série</th>
              <th scope="col">Turma</th>
              <th scope="col">Turno</th>
              <th scope="col">N° alunos</th>
              <th scope="col">Laudo</th>
              <th scope="col">Impresso</th>
              <th scope="col">Rend%.</th>
              <th scope="col">Opções</th>
              <th scope="col"><a href="pdf/turmas_professor.php?professor=<? echo $operador; ?>" target="_blank"><img src="img/impressora.jfif" alt="" width="23" height="23" border="0" title="Imprimir relatório" /></a></th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0; $nome_escola = 0; $componente = 0; $operador;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE professor = '$operador'");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		   
				  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res['turma']."'");
				   while($res_escola = mysqli_fetch_array($sql_escola)){
					   
					   $sql_nome_escola = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res['escola']."'");
				   		while($res_nome_escola = mysqli_fetch_array($sql_nome_escola)){
							$nome_escola = $res_nome_escola['nome_escola'];
						}
						
					   $sql_nome_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['disciplina']."'");
				   		while($res_nome_componente = mysqli_fetch_array($sql_nome_componente)){
							$componente = $res_nome_componente['componente'];
						}
						
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res_escola['sala']; ?></td>
              <td><? echo $componente; ?></td>
              <td><? echo $res_escola['code_serie']; ?>° ano</td>
              <td><? echo $res_escola['tipo_turma']; ?></td>
              <td><? echo $res_escola['turno']; ?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE transferido != 'SIM' AND turma = '".$res['turma']."'"));?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res['turma']."' AND laudado = 'SIM' AND transferido != 'SIM'"));?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res['turma']."' AND impresso = 'SIM' AND transferido != 'SIM'"));?></td>
              <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res_escola['turma']."' AND transferido != 'SIM' AND laudado != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res_escola['turma']."' AND componente = '".$res['disciplina']."' AND code_dia_atividade < '$code_hoje'");
			    
				while($res_atividades = mysqli_fetch_array($total_atividades)){
               if($res_atividades['tipo_envio'] == 'arquivo'){
				   $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
				   
				   while($res_enviados = mysqli_fetch_array($enviados)){
					   $verifica_impresso = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res_enviados['code_aluno']."' AND transferido != 'SIM'");
						 while($res_alunos = mysqli_fetch_array($verifica_impresso)){
							 if($res_alunos['impresso'] == 'SIM' || $res_alunos['transferido'] == 'SIM'){
						}else{
							$conta_alunos++;
						}}
				  }
			   }
			   
               if($res_atividades['tipo_envio'] == 'multipla'){
					$verifica_aluno = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND impresso != 'SIM' AND transferido != 'SIM'");
					 while($res_alunos = mysqli_fetch_array($verifica_aluno)){ 
						
						$sql_atividade_aluno = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' LIMIT 1");

						if(mysqli_num_rows($sql_atividade_aluno) >= 1){  
							$conta_alunos++;
						}
						 
					}
			   }
				}
				
			   
			   $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   
			   $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			   
			  ?>
              <? echo $percentual_frequencia ?>%</td>
              <td colspan="2">
                
                <a href="?p=turmas&turma=<? echo $res['turma']; ?>&componente=<? echo $res['disciplina']; ?>&acao=mostrar&?operador=<? echo $operador; ?>"> <img src="img/verificar_alunos.jpg" width="25" height="25" border="0" title="Verificar alunos" /></a>
                
                <a rel="superbox[iframe][500x130]" href="scripts/bimestre.php?p=1&aluno=&turma=<? echo $res['turma']; ?>&componente=<? echo $res['disciplina']; ?>&operador=<? echo $operador; ?>"><img src="../img/boletim_escolar.png" width="25" height="25" border="0" title="Lançar notas bimestrais" /></a>
                
                 <a rel="superbox[iframe][500x400]" href="scripts/ano_descricao.php?turma=<? echo $res['turma']; ?>&operador=<? echo $operador ?>"><img src="../img/lista_atividades.png" width="20" height="20" border="0" title="Imprimir relatório de atividades do ano" /></a>

                
                
              <a href="?p=mostrar_atividades_turma&turma=<? echo $res['turma']; ?>&componente=<? echo $res['disciplina']; ?>&mes=<? echo date("m"); ?>"><img src="img/atividades.png" width="25" height="25" border="0" title="Verificar atividades" /></a></td>
            </tr>
            <? if(@$_GET['acao'] == 'mostrar' && $_GET['turma'] == $res['turma'] && $res['disciplina'] == $_GET['componente']){ ?>

            
            <tr>
              <th colspan="12" align="center" bgcolor="#00CCFF" scope="row">HIST&Oacute;RICO DE ALUNOS DESSA TURMA</th>
            </tr>
            <tr>
              <th colspan="12" scope="row">
              <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th align="center" scope="col">N&deg;</th>
                  <th scope="col">Nome do aluno</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">1&deg; Bimestre</th>
                  <th scope="col">2&deg; Bimestre</th>
                  <th scope="col">3&deg; Bimestre</th>
                  <th scope="col">4&deg; Bimestre</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>
              <?
			  
		   $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma'");
		   while($res_turmas = mysqli_fetch_array($sql_turmas)){			  
			  
			   $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_turmas['aluno']."'");
			   while($res_alunos = mysqli_fetch_array($sql_alunos)){
			  ?>
                <tr>
                  <th align="center" scope="row"><? echo $res_turmas['n_chamada']; ?></th>
                  <td><? echo strtoupper($res_alunos['nome_aluno']); ?>
					<? if($res_turmas['transferido'] == 'SIM'){ ?>
                    <img src="../img/transferido.png" width="20" height="10" />
                    <? } ?>
                    <? if($res_turmas['suprido'] == 'SIM'){ ?>
                    <img src="../img/suprido.png" width="20" height="10" />
                    <? } ?>
                    <? if($res_turmas['impresso'] == 'SIM'){ ?>
                    <img src="img/amarelo.png" width="20" height="10" />
                    <? } ?>
                  <? if($res_turmas['laudado'] == 'SIM'){ ?> <img src="img/roxo.fw.png" width="10" height="10" title="<?
					$sql_aee = mysqli_query($conexao_bd, "SELECT * FROM aee_descricao WHERE aluno = '".$res_turmas['aluno']."'");
						while($res_aee = mysqli_fetch_array($sql_aee)){
							echo "CID: "; echo $res_aee['cid']; echo " - "; echo $res_aee['descricao'];
							echo " - Relato: "; echo $res_aee['observacao'];
					   }
				  ?>" /> <? } ?>
                    </td>
                  <td>
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
                  
                  
                  
                  <a rel="superbox[iframe][390x400]" href="scripts/informar_busca_ativa_atividade_coordenacao.php?atividade=COORD.<? echo $nome; ?>&operador=<? echo $operador; ?>&professor=COORD.<? echo $nome; ?>&aluno=<? echo $res_alunos['code_aluno']; ?>"><img src="../img/busca_ativa_celular.png" title="Informar busca ativa" alt="" width="20" height="20" border="0" /></a>                  
                  
                  </td>
                  <td align="center"><?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND periodo = '1' AND code_dia_atividade < '$code_hoje'");
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
				
                  ?>
%</td>
                  <td align="center"><?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res_alunos['turma']."' AND componente = '".$_GET['componente']."'");
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
                  <td align="center"><?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res_alunos['turma']."' AND componente = '".$_GET['componente']."'");
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
                  <td align="center">&nbsp;</td>
                  <td>
                    
                    <a rel="superbox[iframe][200x100]" href="scripts/mes_boletim.php?aluno=<? echo $res_alunos['code_aluno']; ?>&turma=<? echo $res_alunos['turma']; ?>&componente=<? echo $res['disciplina']; ?>&p=1&operador=<? echo $operador ?>"><img src="img/boletim.png" width="20" height="20" border="0" title="Emitir boletim do aluno" /></a></td>
                </tr>
              <? }} ?>
              </tbody>
            </table>
                          </th>
            </tr>
           <? } ?>
            
            
         <? }} ?>
        </table>
        
        
        
        <hr />
        <img src="img/amarelo.png" width="20" height="10" /> Atividade impressa
        <img src="img/roxo.fw.png" width="20" height="10" /> Atividade online
        
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