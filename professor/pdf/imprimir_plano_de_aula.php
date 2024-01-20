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

<div class="container">
  <div class="container-fluid">
    <div class="row" style="border:5px solid #069; padding:0; margin:0;">
      <div class="col-sm">
    <? $id = base64_decode($_GET['ik']);
	 $sql_plano_aula = mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula WHERE id_aula = '$id'");
	  while($res_plano_aula = mysqli_fetch_array($sql_plano_aula)){
	
	?>  
    <table width="990" class="table" border="1" style="border:0px;">
    <? 
	$coordenador = 0;
	 $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_plano_aula['turma']."'");
	  while($res_turma = mysqli_fetch_array($sql_turma)){
			$coordenador = $res_turma['coordenador'];
			
	 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res_plano_aula['turma']."' AND id = '".base64_decode($_GET['ik'])."'");
	  while($res_atividades = mysqli_fetch_array($sql_atividades)){
		  
		  $professor = $res_atividades['usuario'];
		  
	 $sql_datas_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_atividades['code_dia_atividade']."'");
	  while($res_datas_vencimento = mysqli_fetch_array($sql_datas_vencimento)){
		  
	 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_atividades['componente']."'");
	  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
		  
	 $sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_atividades['usuario']."'");
	  while($res_professor = mysqli_fetch_array($sql_professor)){
		  
	?>
      <tr>
        <td width="191" rowspan="3"><img src="../../img/logo_plano.png" width="285" height="81" />
          <hr />
          <strong>COMPONENTE:</strong> <? echo $res_disciplinas['componente']; ?></td>
        <td colspan="3"><h2 style="margin:0;"><strong>ESCOLA: ESCOLA DE ENSINO FUNDAMENTAL DEPUTADO LEORNE BEL&Eacute;M</strong></h2></td>
      </tr>
      <tr>
        <td width="287"><strong>ANO:</strong> <? echo $res_turma['code_serie']; ?>° ANO</td>
        <td width="241"><strong>TURMA:</strong> <? echo $res_turma['tipo_turma']; ?></td>
        <td width="243"><strong>TURNO:</strong> <? echo $res_turma['turno']; ?></td>
      </tr>
      <tr>
        <td><strong>DATA:</strong> <? echo $res_datas_vencimento['vencimento']; ?></td>
        <td colspan="2"><strong>PROFESSOR:</strong> <? 
		
		$sql_nome_professor = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_professor['cpf']."'");
		 while($res_professor = mysqli_fetch_array($sql_nome_professor)){
			echo strtoupper($res_professor['nome']); 
		}
		?></td>
      </tr>
      <? }}}}} ?>
    </table>  
	    <table border="1" class="table" style="border:1px solid #CCC; padding:5px; border-radius:5px;">
              <tr>
                <td colspan="2" bgcolor="#006699" style="margin:0; padding:0;"><img src="../../img/eixo.png" width="970" /></td>
              </tr>
              <tr>
                <td colspan="2" style="border:1px solid #CCC; padding:5px; border-radius:5px;">
                <? $eixo = 0;
				  $sql_atividades_eixo = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".base64_decode($_GET['ik'])."'");
				    while($res_atividades_eixo = mysqli_fetch_array($sql_atividades_eixo)){
						echo $eixo = ucfirst($res_atividades_eixo['habilidade']);
				   }
				?>
                </td>
              </tr>
              <tr>
                <td style="margin:0; padding:0;" bgcolor="#006699"><img src="../../img/habilidade.png" /></td>
                <td bgcolor="#006699" style="margin:0; padding:0;"><img src="../../img/conteudo.png" /></td>
              </tr>
              <tr>
                <td style="border:1px solid #CCC; padding:5px; border-radius:5px;">
      <?
	 
		  $sql_nbcc = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE cod_habilidade = '".$res_plano_aula['habilidade']."' LIMIT 1");
		   while($res_nbcc = mysqli_fetch_array($sql_nbcc)){
		?>
      <? echo ucfirst($res_nbcc['cod_habilidade']); ?> - <? echo ucfirst($res_nbcc['habilidade']); ?>
      <? } ?>
                </td>
                <td width="386" style="border:1px solid #CCC; padding:5px; border-radius:5px;"><? echo ucfirst($res_plano_aula['conteudo']); ?>
                </td>
              </tr>
              <tr>
                <td bgcolor="#006699"><h6 style="font:15px Arial, Helvetica, sans-serif; color:#FFF; padding:0;"><strong>OBJETIVO DA AULA</strong></h6></td>
                <td bgcolor="#006699"><h6 style="font:15px Arial, Helvetica, sans-serif; color:#FFF; padding:0;"><strong>MODALIDADE</strong></h6></td>
              </tr>
              <tr>
                <td style="border:1px solid #CCC; padding:5px; border-radius:5px;">  <?
                
						  $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".base64_decode($_GET['ik'])."'");
		   					while($res_atividade = mysqli_fetch_array($sql_atividade)){
			 				  echo ucfirst($res_atividade['objetivo']);
		 			 }
		  
		  
				
				?></td >
                <td style="border:1px solid #CCC; padding:5px; border-radius:5px;">  <input type="radio" name="modalidade" disabled="disabled" value="ONLINE" <? if($res_plano_aula['modalidade'] == 'ONLINE'){ ?> checked="checked" <? } ?> />
AULA ON-LINE
<input type="radio" name="modalidade" disabled="disabled" value="PRESENCIAL" <? if($res_plano_aula['modalidade'] == 'PRESENCIAL'){ ?> checked="checked" <? } ?>/>
                  <label for="modalidade"></label>
                AULA PRESENCIAL</td>
              </tr>
        </table>
            <table border="1" class="table" style="border:1px solid #CCC; padding:5px; margin:0;">
              <tr align="center">
                <td width="111" bgcolor="#003366" style='text-align:center;vertical-align:middle' align="center"><h6 style="color:#FFF;"><strong>TEMPOS PEDAG&Oacute;GICOS</strong></h6></td>
                <td colspan="2" align="center" bgcolor="#003366" style='text-align:center;vertical-align:middle'><h6 style="color:#FFF;"><strong>ENCAMINHAMENTOS METODOLÓGICOS</strong></h6></td>
              </tr>
              <tr>
                <td width="111" style='text-align:center;vertical-align:middle' align="center">ABERTURA</td>
                <td width="353"><input name="abertura_acolhida" type="checkbox" id="abertura_acolhida" value="SIM" <? if($res_plano_aula['abertura_acolhida'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Acolhida <br />
<input name="abertura_contacao" type="checkbox" id="abertura_contacao" value="SIM" <? if($res_plano_aula['abertura_contacao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Conta&ccedil;&atilde;o de hist&oacute;ria<br />
<input name="abertura_musica" type="checkbox" id="abertura_musica" value="SIM" <? if($res_plano_aula['abertura_musica'] == 'SIM'){ ?> checked="checked" <? } ?>/>
M&uacute;sica <br />
<input name="abertura_agenda" type="checkbox" id="abertura_agenda" value="SIM" <? if($res_plano_aula['abertura_agenda'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Agenda do dia</td>
                <td width="510"><? echo $res_plano_aula['abertura_outros']; ?></td>
              </tr>
              <tr>
                <td bgcolor="#0099CC" style='text-align:center;vertical-align:middle' align="center">RETOMADA DO CONTE&Uacute;DO</td>
                <td><input name="retomada_correcao" type="checkbox" id="retomada_correcao" value="SIM" <? if($res_plano_aula['retomada_correcao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  <label for="retomada_correcao"></label>
Corre&ccedil;&atilde;o do exerc&iacute;cio da aula anterior<br />
<input name="retomada_aula" type="checkbox" id="retomada_aula" value="SIM" <? if($res_plano_aula['retomada_aula'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Retomada da aula anterior<br />
<input name="retomada_revisao" type="checkbox" id="retomada_revisao" value="SIM" <? if($res_plano_aula['retomada_revisao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Revis&atilde;o do conte&uacute;do em estudo</td>
                <td><? echo $res_plano_aula['abertura_exemplifique']; ?></td>
              </tr>
              <tr>
                <td bgcolor="#0099CC" style='text-align:center;vertical-align:middle' align="center">SEQU&Ecirc;NCIA<br />
DAS ATIVIDADES</td>
                <td><p>
                  <input name="sequencia_slide" type="checkbox" id="sequencia_slide" value="SIM" <? if($res_plano_aula['sequencia_slide'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Slide abordando o assunto <br />
<input name="sequencia_exposicao" type="checkbox" id="sequencia_exposicao" value="SIM" <? if($res_plano_aula['sequencia_exposicao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Exposi&ccedil;&atilde;o de v&iacute;deos<br />
<input name="sequencia_pesquisa" type="checkbox" id="sequencia_pesquisa" value="SIM" <? if($res_plano_aula['sequencia_pesquisa'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Pesquisa na Internet<br />
<input name="sequencia_livro" type="checkbox" id="sequencia_livro" value="SIM" <? if($res_plano_aula['sequencia_livro'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Livro did&aacute;tico<br />
<input name="sequencia_predicao" type="checkbox" id="sequencia_predicao" value="SIM" <? if($res_plano_aula['sequencia_predicao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Predi&ccedil;&atilde;o de tema <br />
<input name="sequencia_leitura" type="checkbox" id="sequencia_leitura" value="SIM" <? if($res_plano_aula['sequencia_leitura'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Leitura dirigida <br />
<input name="sequencia_generos" type="checkbox" id="sequencia_generos" value="SIM" <? if($res_plano_aula['sequencia_generos'] == 'SIM'){ ?> checked="checked" <? } ?>/>
G&ecirc;neros textuais <br />
<input name="sequencia_jogos" type="checkbox" id="sequencia_jogos" value="SIM" <? if($res_plano_aula['sequencia_jogos'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Jogos e desafios<br />
<input name="sequencia_projetos" type="checkbox" id="sequencia_projetos" value="SIM" <? if($res_plano_aula['sequencia_projetos'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Projetos trabalhados <br />
<input name="sequencia_redes_socias" type="checkbox" id="sequencia_redes_socias" value="SIM" <? if($res_plano_aula['sequencia_redes_socias'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Uso de redes sociais <br>
                     </p><p style="border:1px solid #CCC; padding:10px; margin:0;"><? echo $res_plano_aula['sequencia_outros']; ?></p>
                </p></td>
                <td><? echo $res_plano_aula['sequencia_exemplifique']; ?></td>
              </tr>
              <tr>
                <td bgcolor="#0099CC" style='text-align:center;vertical-align:middle' align="center">FECHAMENTO</td>
                <td colspan="2"><p>
                  <input name="fechamento_oral" type="checkbox" id="fechamento_oral" value="SIM" <? if($res_plano_aula['fechamento_oral'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Atividade oral <br />
<input name="fechamento_livro" type="checkbox" id="fechamento_livro" value="SIM" <? if($res_plano_aula['fechamento_livro'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Atividade do Livro did&aacute;tico <br />
<input name="fechamento_pesquisa" type="checkbox" id="fechamento_pesquisa" value="SIM" <? if($res_plano_aula['fechamento_pesquisa'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Pesquisa de aprofundamento <br />
<input name="fechamento_exercicio" type="checkbox" id="fechamento_exercicio" value="SIM" <? if($res_plano_aula['fechamento_exercicio'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Exerc&iacute;cio de fixa&ccedil;&atilde;o <br />
<input name="fechamento_atividade" type="checkbox" id="fechamento_atividade" value="SIM" <? if($res_plano_aula['fechamento_atividade'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Atividade a partir de objetos digitais criados        pelo docente <br />
<input name="fechamento_plataformas" type="checkbox" id="fechamento_plataformas" value="SIM" <? if($res_plano_aula['fechamento_plataformas'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Plataformas digitais <br />
<input name="fechamento_materiais" type="checkbox" id="fechamento_materiais" value="SIM" <? if($res_plano_aula['fechamento_materiais'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Materiais de apoio <br />
<input name="fechamento_casa" type="checkbox" id="fechamento_casa" value="SIM" <? if($res_plano_aula['fechamento_casa'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Atividade casa <br>
                     <p style="border:1px solid #CCC; padding:10px; margin:0;"><? echo $res_plano_aula['fechamento_exemplifique']; ?></p>
                </p></td>
              </tr>
              <tr>
                <td bgcolor="#0099CC" style='text-align:center;vertical-align:middle' align="center">RECURSOS</td>
                <td colspan="2"><p>
                  <input name="recursos_tablet" type="checkbox" id="recursos_tablet" value="SIM" <? if($res_plano_aula['recursos_tablet'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Tablet
<input name="recursos_datashow" type="checkbox" id="recursos_datashow" value="SIM" <? if($res_plano_aula['recursos_datashow'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Datashow
<input name="recursos_pnld" type="checkbox" id="recursos_pnld" value="SIM" <? if($res_plano_aula['recursos_pnld'] == 'SIM'){ ?> checked="checked" <? } ?>/>
PNLD
<input name="recursos_notebook" type="checkbox" id="recursos_notebook" value="SIM" <? if($res_plano_aula['recursos_notebook'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Notebook
<input name="recursos_impressas" type="checkbox" id="recursos_impressas" value="SIM" <? if($res_plano_aula['recursos_impressas'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Atividades impressas | 
Outros
<input type="text" name="recursos_outros" value="<? echo $res_plano_aula['recursos_outros']; ?>" />
                </p></td>
              </tr>
              <tr>
                <td bgcolor="#0099CC" style='text-align:center;vertical-align:middle' align="center">AVALIA&Ccedil;&Atilde;O</td>
                <td colspan="2"><p style="border:1px solid #CCC; padding:10px; margin:0;"><? echo $res_plano_aula['avaliacao']; ?></p></td>
              </tr>                           
              <tr>
                <td colspan="3" align="center" style="border:0; padding:0; margin:0;">
                <table width="990" border="0" style="border:0; padding:0; margin:0;">
                  <tr>
                    <td align="center">
                    <? $imagem = 0;
						$sql_acesso = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$professor'");
						 while($res_acesso = mysqli_fetch_array($sql_acesso)){
							 $cpf = $res_acesso['cpf'];
							 							 			
                       $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '$cpf'");
							 while($res_coladorares = mysqli_fetch_array($sql_coladorares)){
							
							 $imagem = $res_coladorares['comprovante'];
							
								
						}
					}
							                     	
							$sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '$cpf'");
							 while($res_coladorares = mysqli_fetch_array($sql_coladorares)){
								 
								 $nome = $res_coladorares['nome'];
								 
							 }					
					
					
					?>
                    
                    <?
                     
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					 
					?>
                    <br /><strong>PROFESSOR(A):</strong> <? echo strtoupper($nome); ?></td>
                    <td align="center">
                    <? $imagem = 0;
						$sql_acesso = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$coordenador'");
						 while($res_acesso = mysqli_fetch_array($sql_acesso)){
							 $cpf = $res_acesso['cpf'];
							 							 			
                       $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '$cpf'");
							 while($res_coladorares = mysqli_fetch_array($sql_coladorares)){
							
							 $imagem = $res_coladorares['comprovante'];
							
								
						}
					}
					?>
                    
                    <?
                     
					 if($imagem != 0){
						 echo "<img src='../documentos_colaboradores/$imagem' width='200' height='100' />";
					 }else{
						 echo "________________________________";
					 }
					 
					?>
                    <br />
                    <strong>COORDENADOR(A):</strong> <?
                    	
						$sql_acesso = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$coordenador'");
						 while($res_acesso = mysqli_fetch_array($sql_acesso)){
							
							 $cpf = $res_acesso['cpf'];
							                     	
							$sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '$cpf'");
							 while($res_coladorares = mysqli_fetch_array($sql_coladorares)){
								 
								 echo $nome = strtoupper($res_coladorares['nome']);
								 
							 }
							 
						}
						
					
					?></td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
		</form>
      <? } ?>
      </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>