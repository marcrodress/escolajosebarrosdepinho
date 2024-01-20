<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body table{
	border:0px solid #000;
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
require "../../conexao.php";


	$data_completa = date("d/m/Y H:i:s");
	$data = date("d/m/Y");
	$dia = date("d");
	$d = date("d");
	$mes = date("m");
	$hora = date("H:i:s");
	$apenas_hora = date("H:i:s");
	$m = date("m");
	$ano = date("Y");
	$a = date("Y");
	$ip = $_SERVER['REMOTE_ADDR'];
	

$code_hoje = 0;

$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
	$code_hoje = $res_code_vencimento['codigo'];
}		


$url_atual= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


?>

<div class="container" style="border:0;">
  <div class="container-fluid">
    <div class="row" style="border:0px solid #069; padding:0; margin:0;">
      <div class="col-sm">
    <p>
      <?
	 $sql_plano_aula = mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula_iniciais WHERE id_aula = '".base64_decode($_GET['ik'])."'");
	  while($res_plano_aula = mysqli_fetch_array($sql_plano_aula)){
	
	?>
    </p>
    <table width="1070" class="table" border="0">
    <? 
	
	 $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_plano_aula['turma']."'");
	  while($res_turma = mysqli_fetch_array($sql_turma)){
	
	 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res_plano_aula['turma']."' AND id = '".base64_decode($_GET['ik'])."'");
	  while($res_atividades = mysqli_fetch_array($sql_atividades)){
		  
	 $sql_datas_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_atividades['code_dia_atividade']."'");
	  while($res_datas_vencimento = mysqli_fetch_array($sql_datas_vencimento)){
		  
	 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_atividades['componente']."'");
	  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
		  
	 $sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_atividades['usuario']."'");
	  while($res_professor = mysqli_fetch_array($sql_professor)){
		?>
      <tr>
        <td align="center">
        <img src="../../img/plano_de_aula_iniciais.png" width="300" height="80" />          
        <br />
        <h2 align="center"><strong>SECRETARIA MUNICIPAL DA EDUCA&Ccedil;&Atilde;O</strong></h2>         
        <h2 align="center"><strong>ESCOLA DE ENSINO FUNDAMENTAL DEPUTADO LEORNE BELÉM</strong></h2>
        <h2 align="center"><strong>ROTINA DID&Aacute;TICA &ndash; PAIC&nbsp; 1&ordm; AO 5&ordm; ANO</strong></h2>
        <h2 align="center"><strong>PROFESSO (A): <? 
			$sql_acesso_sistema = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_atividades['usuario']."'");
			   while($res_acesso = mysqli_fetch_array($sql_acesso_sistema)){
				 $sql_acesso_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_acesso['cpf']."'");
			      while($res_colaborador = mysqli_fetch_array($sql_acesso_colaborador)){
					  echo $res_colaborador['nome'];
			     }
			  }
			 
		 ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TURMA: <? echo $res_turma['tipo_turma']; ?></strong></h2>         
        <h3><strong>TURNO: <? echo $res_turma['turno']; ?> </strong>&nbsp;&nbsp;&nbsp;&nbsp;<strong>COMPONENTE  CURRICULAR</strong><strong>: <? echo $res_disciplinas['componente']; ?>&nbsp;&nbsp;&nbsp;&nbsp;DATA: <? echo $res_datas_vencimento['vencimento']; ?></strong></h3></td>
      </tr>
      <? }}}}} ?>
      </table>



      <?
	 $sql_plano_aula = mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula_iniciais WHERE id_aula = '".base64_decode($_GET['ik'])."'");
	  while($res_plano_aula = mysqli_fetch_array($sql_plano_aula)){
	
	?>
<table width="1070" border="1" class="table">
            <thead class="thead-dark">
              <tr>
                <th colspan="3" align="center" bgcolor="#FFFFFF"><h2 style="margin:auto; padding:0;" align="center"><strong>HABILIDADES / DIREITOS DE APRENDIZAGEM</strong></h2>                </tr>
              <tr>
              <th colspan="3" align="center" bgcolor="#FFFFFF"><br /><? 
			  	
				$sql_habilidades = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE cod_habilidade = '".$res_plano_aula['habilidade']."' LIMIT 1");				
				 while($res_habilidades = mysqli_fetch_array($sql_habilidades)){
					 echo $res_habilidades['cod_habilidade']; echo " - "; echo $res_habilidades['habilidade'];
			    }
			  		
			   ?><br />              </tr>
              <tr>
                <th colspan="3" align="center" bgcolor="#FFFFFF"><br /><br />                
              </tr>
              <tr>
                <th colspan="3" align="center" bgcolor="#FFFFFF"> <br /><br />               
              </tr>
              <tr>
                <th colspan="3" align="center" bgcolor="#FFFFFF"><h2 style="margin:auto; padding:0;">OBJETO DO CONHECIMENTO                
                </h2>
              </tr>
              <tr>
                <th colspan="3" align="center" bgcolor="#FFFFFF"><br /><? echo $res_plano_aula['conteudo']; ?><br />                
              </tr>
              <tr>
                <th colspan="3" align="center" bgcolor="#FFFFFF">        <br /><br />        
              </tr>
              <tr>
                <th colspan="3" align="center" bgcolor="#FFFFFF"><h2 style="margin:auto; padding:0;"><strong>OBJETIVOS</strong></h2>
              </tr>
              <tr>
              <th colspan="3" align="center" bgcolor="#FFFFFF"><br /><? echo $res_plano_aula['objetivo']; ?><br />
              </tr>
              <tr>
                <th colspan="3" align="center" bgcolor="#FFFFFF">     <br /><br />           
              </tr>
              <tr>
                <th colspan="2" align="center" bgcolor="#FFFFFF"><h2><strong>TEMPOS DA ROTINA</strong>                
                </h2>
                <th align="center" bgcolor="#FFFFFF"><h2><strong>PROCEDIMENTOS METODOL&Oacute;GICOS</strong>                
                </h2>
              </tr>
              <tr>
                <td width="113" rowspan="3" align="center"><p align="center">ACOLHIDA</p></td>
                <td rowspan="3"><input name="acolhida_oracao" type="checkbox" id="acolhida_oracao" value="SIM" <? if($res_plano_aula['acolhida_oracao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  <label for="acolhida_oracao"></label>
                  Ora&ccedil;&atilde;o<br>
                  <input name="acolhida_contacao_historia" type="checkbox" id="acolhida_contacao_historia" value="SIM" <? if($res_plano_aula['acolhida_contacao_historia'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  Conta&ccedil;&atilde;o de Hist&oacute;ria  por &aacute;udio ou v&iacute;deo<br>
                <input name="acolhida_musicas" type="checkbox" id="acolhida_musicas" value="SIM" <? if($res_plano_aula['acolhida_musicas'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                M&uacute;sicas</td>
                <td><br /><? echo $res_plano_aula['acolhida_procedimentos']; ?><br /></td>
              </tr>
              <tr>
                <td>&nbsp;<br /><br /></td>
              </tr>
              <tr>
                <td>&nbsp;<br /><br /></td>
              </tr>
          </thead>
              <tr>
                <td rowspan="5" align="center" bgcolor="#FFFFFF"><p align="center">LEITURA <br />
                  E <br />
                ORALIDADE</p></td>
                <td width="329" rowspan="5"><p>
                  <input name="leitrua_acervo_paic" type="checkbox" id="leitrua_acervo_paic" value="SIM" <? if($res_plano_aula['leitrua_acervo_paic'] == 'SIM'){ ?> checked="checked" <? } ?>/>                  
                  Acervo PAIC/PNLD <br>
                  <input name="leitrua_predicao_tema" type="checkbox" id="leitrua_predicao_tema" value="SIM" <? if($res_plano_aula['leitrua_predicao_tema'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  Predi&ccedil;&atilde;o do tema (  &Aacute;udio ou v&iacute;deo )
                    <br />
                    <input name="leitrua_contextualizaao_da_leitura" type="checkbox" id="leitrua_contextualizaao_da_leitura" value="SIM" <? if($res_plano_aula['leitrua_contextualizaao_da_leitura'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                    Contextualiza&ccedil;&atilde;o da  Leitura<br />
  <input name="leitrua_acervo_estudo_em_casa" type="checkbox" id="leitrua_acervo_estudo_em_casa" value="SIM" <? if($res_plano_aula['leitrua_acervo_estudo_em_casa'] == 'SIM'){ ?> checked="checked" <? } ?>/>
  Acervo Estudo em Casa
                  <br />
                  <input name="leitrua_leitura_individual" type="checkbox" id="leitrua_leitura_individual" value="SIM" <? if($res_plano_aula['leitrua_leitura_individual'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  Leitura individual  por v&iacute;deo ou &aacute;udio<br />
<input name="leitrua_video_aulas" type="checkbox" id="leitrua_video_aulas" value="SIM" <? if($res_plano_aula['leitrua_video_aulas'] == 'SIM'){ ?> checked="checked" <? } ?>/>
V&iacute;deo Aulas
<br /><input name="leitrua_outros" type="checkbox" id="leitrua_outros" value="SIM" <? if($res_plano_aula['leitrua_outros'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
Outros: <? echo $res_plano_aula['leitrua_outros_descricao']; ?>
                </p>		</td>
                <td width="606"><br /><? echo $res_plano_aula['leitura_procedimentos']; ?><br /></td>
              </tr>
              <tr>
                <td>&nbsp;<br /><br /></td>
              </tr>
              <tr>
                <td>&nbsp;<br /><br /></td>
              </tr>
              <tr>
                <td>&nbsp;<br /><br /></td>
              </tr>
              <tr>
                <td>&nbsp;<br /><br /></td>
              </tr>
              <tr>
                <td rowspan="4" align="center" bgcolor="#FFFFFF">ATIVIDADE DE ESCRITA DO ALUNO (Compreens&atilde;o, vocabul&aacute;rio e desenvolvimento da escrita)</td>
                <td rowspan="4"><p>
                  <input name="atividade_generos" type="checkbox" id="atividade_generos" value="SIM" <? if($res_plano_aula['atividade_generos'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                G&ecirc;neros textuais<br>
                  
                    <input name="atividade_cadernos" type="checkbox" id="atividade_cadernos" value="SIM" <? if($res_plano_aula['atividade_cadernos'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                    Caderno de Atividades  (PAIC)<br>
                 
                    <input name="atividade_atividades" type="checkbox" id="atividade_atividades" value="SIM" <? if($res_plano_aula['atividade_atividades'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                    Atividade do PNLD<br>
                    <input name="atividade_compreensao" type="checkbox" id="atividade_compreensao" value="SIM" <? if($res_plano_aula['atividade_compreensao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  Compreens&atilde;o<br>
                  
                    <input name="atividade_producao" type="checkbox" id="atividade_producao" value="SIM" <? if($res_plano_aula['atividade_producao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                    Produ&ccedil;&atilde;o Textual<br>
                    
                    <input name="atividade_material_online" type="checkbox" id="atividade_material_online" value="SIM" <? if($res_plano_aula['atividade_material_online'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  Material ONLINE<br>
                    <input name="atividade_xerocada" type="checkbox" id="atividade_xerocada" value="SIM" <? if($res_plano_aula['atividade_xerocada'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                    Atividade  xerocada/impressa<br>
                  </p></td>
                <td><br /><? echo $res_plano_aula['atividade_procedimentos']; ?><br /></td>
              </tr>
              <tr>
                <td>&nbsp;<br /><br /></td>
              </tr>
              <tr>
                <td>&nbsp;<br /><br /></td>
              </tr>
              <tr>
                <td>&nbsp;<br /><br /></td>
              </tr>
              <tr>
                <td colspan="3" align="center" bgcolor="#FFFFFF"><strong>RECURSOS</strong></td>
              </tr>
              <tr>
                <td colspan="3" align="center" bgcolor="#FFFFFF">
                <br /><input name="recursos_mesa" type="checkbox" id="recursos_mesa" value="SIM" <? if($res_plano_aula['recursos_mesa'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Mesa digitalizadora 
<input name="recursos_tablet" type="checkbox" id="recursos_tablet" value="SIM" <? if($res_plano_aula['recursos_tablet'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Tablet
<input name="recursos_datashow" type="checkbox" id="recursos_datashow" value="SIM" <? if($res_plano_aula['recursos_datashow'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Datashow
<input name="recursos_pnld" type="checkbox" id="recursos_pnld" value="SIM" <? if($res_plano_aula['recursos_pnld'] == 'SIM'){ ?> checked="checked" <? } ?>/>
PNLD
<input name="recursos_notebook" type="checkbox" id="recursos_notebook" value="SIM" <? if($res_plano_aula['recursos_notebook'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Notebook | 
<label for="recursos_outros"></label>
Outros recursos: <? echo $res_plano_aula['recursos_outros']; ?><br /><br />
</td>
              </tr>
              <tr>
                <td colspan="3" align="center"><h4 style="padding:5px; margin:0;"><strong>AVALIA&Ccedil;&Atilde;O</strong></h4></td>
              </tr>
              <tr>
                <td colspan="3" align="center"><br /><? echo $res_plano_aula['avaliacao']; ?><br /><br /></td>
              </tr>
              <tr>
                <td colspan="3" align="center"><br /><br />&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" align="center"><br /><br />&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><strong>PROFESSOR: 
                  <? 
			$sql_acesso_sistema = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$_GET['professor']."'");
			   while($res_acesso = mysqli_fetch_array($sql_acesso_sistema)){
				 $sql_acesso_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_acesso['cpf']."'");
			      while($res_colaborador = mysqli_fetch_array($sql_acesso_colaborador)){
					  echo $res_colaborador['nome'];
			     }
			  }
			 
		 ?>
                </strong></td>
                <td align="center"><strong>COORDENADOR:</strong></td>
              </tr>
        </table>
	   <? } ?>



      <? } ?>
      </div><!-- col-sm -->
    </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>