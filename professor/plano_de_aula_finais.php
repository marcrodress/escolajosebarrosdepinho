<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="jquery.superbox.css" type="text/css" media="all" />
<link href="../img/index.png" rel="shortcut icon" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informações. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>
<style>
#container_tuod{
	background:#FFF;
}
</style>
</head>

<body>
<div class="container">
  <div class="container-fluid">
    <div class="row" style="border:5px solid #069;">
      <div class="col-sm">
    <?
	 $sql_plano_aula = mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula_iniciais WHERE id_aula = '".base64_decode($_GET['ik'])."'");
	  while($res_plano_aula = mysqli_fetch_array($sql_plano_aula)){
	?>  
    
    <table width="990" class="table" border="1">
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
        <td width="191" rowspan="3"><img src="../img/plano_de_aula_iniciais.png" width="277" height="79" />
          <hr />
          <strong>COMPONENTE:</strong> <? echo $res_disciplinas['componente']; ?></td>
        <td colspan="3"><strong>ESCOLA: ESCOLA DE ENSINO FUNDAMENTAL DEPUTADO LEORNE BEL&Eacute;M</strong>  
        <a href="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>"><img style="float:right;" title="Voltar" src="../img/voltar.png" width="20" height="20" border="0" /> </a>



        <a target="_blank" href="pdf/imprimir_plano_de_aula_iniciais.php?componente=<? echo $_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>&professor=<? echo $_GET['professor']; ?>&tipo=<? echo $_GET['tipo']; ?>&ik=<? echo $_GET['ik']; ?>"><img style="float:right;" title="Imprimir plano de aula" src="img/impressora2.png" width="20" height="20" border="0" /></a>
        
        
        </td>
      </tr>
      <tr>
        <td width="287"><strong>ANO:</strong> <? echo $res_turma['code_serie']; ?>° ANO</td>
        <td width="241"><strong>TURMA:</strong> <? echo $res_turma['tipo_turma']; ?></td>
        <td width="243"><strong>TURNO:</strong> <? echo $res_turma['turno']; ?></td>
      </tr>
      <tr>
        <td><strong>DATA:</strong> <? echo $res_datas_vencimento['vencimento']; ?></td>
        <td colspan="2"><strong>PROFESSOR:</strong> <? 
			$sql_acesso_sistema = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_atividades['usuario']."'");
			   while($res_acesso = mysqli_fetch_array($sql_acesso_sistema)){
				 $sql_acesso_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_acesso['cpf']."'");
			      while($res_colaborador = mysqli_fetch_array($sql_acesso_colaborador)){
					  echo $res_colaborador['nome'];
			     }
			  }
			 
		 ?></td>
      </tr>
      <? }}}}} ?>
    </table>
    
     <? echo $_GET['ik']; ?>
    
	<form name="" method="post" enctype="multipart/form-data" action="">	
   		 <table width="1070" border="1" style="border:1px solid #CCC; padding:5px; border-radius:5px;">
              <tr>
                <td colspan="2" bgcolor="#006699"><img src="../img/eixo.png" width="1040" height="40" /></td>
              </tr>
              <tr>
                <td colspan="2">
               
                <input type="text" disabled="disabled" value="<? $eixo = 0;
				  $sql_atividades_eixo = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".base64_decode($_GET['ik'])."'");
				    while($res_atividades_eixo = mysqli_fetch_array($sql_atividades_eixo)){
						echo $eixo = $res_atividades_eixo['habilidade'];
				   }
				?>" class="form-control form-control-lg">
                
                <input type="hidden" name="eixo" value="<? echo $eixo; ?>" />
                </td>
              </tr>
              <tr>
                <td width="658" bgcolor="#006699"><img src="../img/habilidade.png" width="236" height="40" /></td>
                <td bgcolor="#006699"><img src="../img/conteudo.png" width="400" height="40" /></td>
              </tr>
              <tr>
                <td>
    <? if($eixo == 'OUTROS' || $eixo == 'ATIVIDADES INTERCLASSE' || $eixo == 'DATAS COMEMORATIVAS'){ ?>
        <input type="text" name="habilidade" value="<? echo $res_plano_aula['habilidade']; ?>" class="form-control"/>
     <? }else{ ?>
	<select name="habilidade" class="form-select" aria-label="Default select example" style="width:590px; float:left; padding:5px; margin:0;">
      <option value="<? echo strtoupper($res_plano_aula['habilidade']); ?>"><?
   		$sql_nbcc = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE cod_habilidade = '".$res_plano_aula['habilidade']."'");
		   while($res_nbcc = mysqli_fetch_array($sql_nbcc)){
	   		echo strtoupper($res_nbcc['cod_habilidade']); ?> - <? echo strtoupper($res_nbcc['habilidade']); 
		   }
	   ?></option>






      <?
		  $componente = 0;
		  $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".base64_decode($_GET['ik'])."'");
		   while($res_atividade = mysqli_fetch_array($sql_atividade)){
			   $componente = $res_atividade['componente'];
		  }
		  
		  $serie = 0;
		  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
		   while($res_turma = mysqli_fetch_array($sql_turma)){
			   $serie = $res_turma['code_serie'];
		  }
		  
		  $sql_nbcc = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE ano = '$serie' AND componente = '$componente' AND cod_habilidade != '".$res_plano_aula['habilidade']."' AND cod_habilidade != ''");
		   while($res_nbcc = mysqli_fetch_array($sql_nbcc)){
		?>
      <option value="<? echo strtoupper($res_nbcc['cod_habilidade']); ?>"><? echo strtoupper($res_nbcc['cod_habilidade']); ?> - <? echo strtoupper($res_nbcc['habilidade']); ?></option>
      <? } ?>
    </select>

     <? } ?>
    
    
    
                </td>
                <td width="400">
    <? if($eixo == 'OUTROS' || $eixo == 'ATIVIDADES INTERCLASSE' || $eixo == 'DATAS COMEMORATIVAS'){ ?>
     <input type="text" name="conteudo" value="<? echo $res_plano_aula['conteudo']; ?>" class="form-control"/>
    <? }else{ ?>
                
              <select name="conteudo" class="form-select form-select-sm" style="float:left; padding:5px; margin:0;">
     			<option value="<? echo strtoupper($res_plano_aula['conteudo']); ?>"><? echo strtoupper($res_plano_aula['conteudo']); ?></option>
                    <?
			
		  $componente = 0;
		  $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".base64_decode($_GET['ik'])."'");
		   while($res_atividade = mysqli_fetch_array($sql_atividade)){
			   $componente = $res_atividade['componente'];
		  }
		  
		  $serie = 0;
		  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
		   while($res_turma = mysqli_fetch_array($sql_turma)){
			   $serie = $res_turma['code_serie'];
		  }
		  
		  $sql_nbcc = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE ano = '$serie' AND componente = '$componente' AND conteudo != '".$res_plano_aula['conteudo']."'");
		   while($res_nbcc = mysqli_fetch_array($sql_nbcc)){
		?>
                    <option value="<? echo strtoupper($res_nbcc['conteudo']); ?>"><? echo strtoupper($res_nbcc['conteudo']); ?></option>
                    <? } ?>
                </select>
        <? } ?>
       
                
                </td>
              </tr>
              <tr>
                <td bgcolor="#006699"><img src="../img/objetivo.png" width="500" height="40" /></td>
                <td bgcolor="#006699"><img src="../img/modalidade.png" width="400" height="40" /></td>
              </tr>
              <tr>
                <td>  <input name="objetivo" type="text" class="form-control" value="<?
                
						  $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".base64_decode($_GET['ik'])."'");
		   					while($res_atividade = mysqli_fetch_array($sql_atividade)){
			 				  echo $res_atividade['objetivo'];
		 			 }
		  
		  
				
				?>"></td>
                <td>  <input type="radio" name="modalidade" id="radio" value="ONLINE" <? if($res_plano_aula['modalidade'] == 'ONLINE'){ ?> checked="checked" <? } ?> />
AULA ON-LINE
<input type="radio" name="modalidade" id="radio2" value="PRESENCIAL" <? if($res_plano_aula['modalidade'] == 'PRESENCIAL'){ ?> checked="checked" <? } ?>/>
                AULA PRESENCIAL</td>
              </tr>
            </table>
            <table width="1070" border="1" class="table">
            <thead class="thead-dark">
              <tr>
                <th colspan="2" align="center" bgcolor="#003366"><p align="center"><strong>TEMPOS DA ROTINA</strong></p>
                <th bgcolor="#003366" align="center"><p align="center"><strong>PROCEDIMENTOS METODOL&Oacute;GICOS</strong></p>
                </tr>
              <tr>
                <td width="113" align="center"><p align="center">ACOLHIDA</p></td>
                <td><input name="acolhida_oracao" type="checkbox" id="acolhida_oracao" value="SIM" <? if($res_plano_aula['acolhida_oracao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  <label for="acolhida_oracao"></label>
                  Ora&ccedil;&atilde;o<br>
                  <input name="acolhida_contacao_historia" type="checkbox" id="acolhida_contacao_historia" value="SIM" <? if($res_plano_aula['acolhida_contacao_historia'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  Conta&ccedil;&atilde;o de Hist&oacute;ria  por &aacute;udio ou v&iacute;deo<br>
                <input name="acolhida_musicas" type="checkbox" id="acolhida_musicas" value="SIM" <? if($res_plano_aula['acolhida_musicas'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                M&uacute;sicas</td>
                <td><textarea class="form-control" name="acolhida_procedimentos" id="acolhida_procedimentos" cols="80" rows="3"><? echo $res_plano_aula['acolhida_procedimentos']; ?></textarea></td>
              </tr>
              </thead>
              <tr>
                <td bgcolor="#0099CC" align="center"><p align="center">LEITURA <br />
                  E <br />
                ORALIDADE</p></td>
                <td width="329"><p>
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
Outros 
<label for="leitrua_outros_descricao"></label>
<input type="text" name="leitrua_outros_descricao" id="leitrua_outros_descricao" value="<? echo $res_plano_aula['leitrua_outros_descricao']; ?>" />
                </p>		</td>
                <td width="606"><textarea class="form-control" style="height:188px;" name="leitura_procedimentos" id="leitura_procedimentos" cols="80" rows="3"><? echo $res_plano_aula['leitura_procedimentos']; ?></textarea></td>
              </tr>
              <tr>
                <td bgcolor="#0099CC" align="center">ATIVIDADE DE ESCRITA DO ALUNO (Compreens&atilde;o, vocabul&aacute;rio e desenvolvimento da escrita)</td>
                <td><p>
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
                <td><textarea class="form-control" style="height:180px;" name="atividade_procedimentos" id="atividade_procedimentos" cols="80" rows="3"><? echo $res_plano_aula['atividade_procedimentos']; ?></textarea></td>
              </tr>
              <tr>
                <td colspan="3" align="center" bgcolor="#0099CC"><strong>RECURSOS</strong></td>
              </tr>
              <tr>
                <td colspan="3" align="center" bgcolor="#FFFFFF"><input name="recursos_mesa" type="checkbox" id="recursos_mesa" value="SIM" <? if($res_plano_aula['recursos_mesa'] == 'SIM'){ ?> checked="checked" <? } ?>/>
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
Outros recursos
<input type="text" name="recursos_outros" id="recursos_outros" value="<? echo $res_plano_aula['recursos_outros']; ?>" /></td>
              </tr>
              <tr>
                <td colspan="3" align="center">AVALIA&Ccedil;&Atilde;O</td>
              </tr>
              <tr>
                <td colspan="3" align="center"><textarea class="form-control" name="avaliacao" cols="80" rows="3"><? echo $res_plano_aula['avaliacao']; ?></textarea></td>
              </tr>
              <tr>
                <td colspan="3" align="center"><input class="btn btn-primary" type="submit" name="button" id="button" value="Salvar plano de aula" /></td>
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
<? if(isset($_POST['button'])){
	
$habilidade = $_POST['habilidade'];
$conteudo = $_POST['conteudo'];
$objetivo = $_POST['objetivo'];
$modalidade = $_POST['modalidade'];
$acolhida_oracao = $_POST['acolhida_oracao'];
$acolhida_contacao_historia = $_POST['acolhida_contacao_historia'];
$acolhida_musicas = $_POST['acolhida_musicas'];
$acolhida_procedimentos = $_POST['acolhida_procedimentos'];

$leitrua_acervo_paic = $_POST['leitrua_acervo_paic'];
$leitrua_predicao_tema = $_POST['leitrua_predicao_tema'];
$leitrua_contextualizaao_da_leitura = $_POST['leitrua_contextualizaao_da_leitura'];
$leitrua_acervo_estudo_em_casa = $_POST['leitrua_acervo_estudo_em_casa'];
$leitrua_leitura_individual = $_POST['leitrua_leitura_individual'];
$leitrua_video_aulas = $_POST['leitrua_video_aulas'];
$leitrua_outros = $_POST['leitrua_outros'];
$leitrua_outros_descricao = $_POST['leitrua_outros_descricao'];
$leitura_procedimentos = $_POST['leitura_procedimentos'];

$atividade_generos = $_POST['atividade_generos'];
$atividade_cadernos = $_POST['atividade_cadernos'];
$atividade_atividades = $_POST['atividade_atividades'];
$atividade_compreensao = $_POST['atividade_compreensao'];
$atividade_producao = $_POST['atividade_producao'];
$atividade_material_online = $_POST['atividade_material_online'];
$atividade_xerocada = $_POST['atividade_xerocada'];
$atividade_procedimentos = $_POST['atividade_procedimentos'];

$recursos_mesa = $_POST['recursos_mesa'];
$recursos_tablet = $_POST['recursos_tablet'];
$recursos_datashow = $_POST['recursos_datashow'];
$recursos_pnld = $_POST['recursos_pnld'];
$recursos_notebook = $_POST['recursos_notebook'];
$recursos_outros = $_POST['recursos_outros'];

$avaliacao = $_POST['avaliacao'];

$id_aula = base64_decode($_GET['ik']);


$sql_update = mysqli_query($conexao_bd, "UPDATE plano_de_aula_iniciais SET habilidade = '$habilidade', status_coordenacao = 'AGUARDA', conteudo = '$conteudo', objetivo = '$objetivo', modalidade = '$modalidade', acolhida_oracao = '$acolhida_oracao', acolhida_contacao_historia = '$acolhida_contacao_historia', acolhida_musicas = '$acolhida_musicas', acolhida_procedimentos = '$acolhida_procedimentos', leitrua_acervo_paic = '$leitrua_acervo_paic', leitrua_predicao_tema = '$leitrua_predicao_tema', leitrua_contextualizaao_da_leitura = '$leitrua_contextualizaao_da_leitura', leitrua_acervo_estudo_em_casa = '$leitrua_acervo_estudo_em_casa', leitrua_leitura_individual = '$leitrua_leitura_individual', leitrua_video_aulas = '$leitrua_video_aulas', leitrua_outros = '$leitrua_outros', leitrua_outros_descricao = '$leitrua_outros_descricao', leitura_procedimentos = '$leitura_procedimentos', atividade_generos = '$atividade_generos', atividade_cadernos = '$atividade_cadernos', atividade_atividades = '$atividade_atividades', atividade_compreensao = '$atividade_compreensao', atividade_producao = '$atividade_producao', atividade_material_online = '$atividade_material_online', atividade_xerocada = '$atividade_xerocada', atividade_procedimentos = '$atividade_procedimentos', recursos_mesa = '$recursos_mesa', recursos_tablet = '$recursos_tablet', recursos_datashow = '$recursos_datashow', recursos_pnld = '$recursos_pnld', recursos_notebook = '$recursos_notebook', recursos_outros = '$recursos_outros', avaliacao = '$avaliacao' WHERE id_aula = '$id_aula'");

echo "<script language='javascript'>window.alert('Plano salvo com sucesso!');window.location='';</script>";


}?>