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
<? if(isset($_POST['button'])){

$eixo = $_POST['eixo'];
$habilidade = $_POST['habilidade'];
$conteudo = $_POST['conteudo'];
$objetivo = $_POST['objetivo'];
$modalidade = $_POST['modalidade'];
$abertura_acolhida = $_POST['abertura_acolhida'];
$abertura_contacao = $_POST['abertura_contacao'];
$abertura_musica = $_POST['abertura_musica'];
$abertura_agenda = $_POST['abertura_agenda'];
$abertura_outros = $_POST['abertura_outros'];
$retomada_correcao = $_POST['retomada_correcao'];
$retomada_aula = $_POST['retomada_aula'];
$retomada_revisao = $_POST['retomada_revisao'];
$abertura_exemplifique = $_POST['abertura_exemplifique'];
$sequencia_slide = $_POST['sequencia_slide'];
$sequencia_exposicao = $_POST['sequencia_exposicao'];
$sequencia_pesquisa = $_POST['sequencia_pesquisa'];
$sequencia_livro = $_POST['sequencia_livro'];
$sequencia_predicao = $_POST['sequencia_predicao'];
$sequencia_leitura = $_POST['sequencia_leitura'];
$sequencia_generos = $_POST['sequencia_generos'];
$sequencia_jogos = $_POST['sequencia_jogos'];
$sequencia_projetos = $_POST['sequencia_projetos'];
$sequencia_redes_socias = $_POST['sequencia_redes_socias'];
$sequencia_outros = $_POST['sequencia_outros'];
$sequencia_exemplifique = $_POST['sequencia_exemplifique'];
$fechamento_oral = $_POST['fechamento_oral'];
$fechamento_livro = $_POST['fechamento_livro'];
$fechamento_pesquisa = $_POST['fechamento_pesquisa'];
$fechamento_exercicio = $_POST['fechamento_exercicio'];
$fechamento_atividade = $_POST['fechamento_atividade'];
$fechamento_plataformas = $_POST['fechamento_plataformas'];
$fechamento_materiais = $_POST['fechamento_materiais'];
$fechamento_casa = $_POST['fechamento_casa'];
$fechamento_exemplifique = $_POST['fechamento_exemplifique'];
$recursos_tablet = $_POST['recursos_tablet'];
$recursos_datashow = $_POST['recursos_datashow'];
$recursos_pnld = $_POST['recursos_pnld'];
$recursos_notebook = $_POST['recursos_notebook'];
$recursos_impressas = $_POST['recursos_impressas'];
$recursos_outros = $_POST['recursos_outros'];
$avaliacao = $_POST['avaliacao'];



$id_aula = base64_decode($_GET['ik']);
$professor = $_GET['professor'];
$turma = $_GET['turma'];
$componente = $_GET['componente'];


if($recursos_mesa == 'SIM'){
	
}




$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula WHERE id_aula = '$id_aula'");
if(mysqli_num_rows($sql_verifica) == ''){
	mysqli_query($conexao_bd, "INSERT INTO plano_de_aula (data, id_aula, status, status_coordenacao, observacao_professor, observacao_coodenacao, professor, turma, eixo, habilidade, conteudo, objetivo, modalidade, retomada_correcao, retomada_aula, retomada_revisao, abertura_mensagem, abertura_objetivo, abertura_exemplifique, sequencia_slide, sequencia_estudo, sequencia_audios, sequencia_exposicao, sequencia_redes, sequencia_pesquisa, sequencia_web, sequencia_livro, sequencia_outros, sequencia_exemplifique, fechamento_atividade, fechamento_pesquisa, fechamento_exercicios, fechamento_atividade_docente, fechamento_exemplifique, recursos_mesa, recursos_tablet, recursos_datashow, recursos_pnld, recursos_notebook, recursos_outros, avaliacao) VALUES ('$data', '$id_aula', 'Ativo', '', '', '', '$professor', '$turma', '$eixo', '$habilidade', '$conteudo', '$objetivo', '$modalidade', '$retomada_correcao', '$retomada_aula', '$retomada_revisao', '$abertura_mensagem', '$abertura_objetivo', '$abertura_exemplifique', '$sequencia_slide', '$sequencia_estudo', '$sequencia_audios', '$sequencia_exposicao', '$sequencia_redes', '$sequencia_pesquisa', '$sequencia_web', '$sequencia_livro', '$sequencia_outros', '$sequencia_exemplifique', '$fechamento_atividade', '$fechamento_pesquisa', '$fechamento_exercicios', '$fechamento_atividade_docente', '$fechamento_exemplifique', '$recursos_mesa', '$recursos_tablet', '$recursos_datashow', '$recursos_pnld', '$recursos_notebook', '$recursos_outros', '$avaliacao')");
	
		mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, CONCLUIU O PLANO DE AULA DA ATIVIDADE $id_aula', '$operador')");

	echo "<script language='javascript'>window.alert('Plano de aula concluído!');window.location='';</script>";
	
}else{
	
	mysqli_query($conexao_bd, "UPDATE plano_de_aula SET eixo = '$eixo', habilidade = '$habilidade', status_coordenacao = 'AGUARDA',  conteudo = '$conteudo', objetivo = '$objetivo', modalidade = '$modalidade', abertura_acolhida = '$abertura_acolhida', abertura_contacao = '$abertura_contacao', abertura_musica = '$abertura_musica', abertura_agenda = '$abertura_agenda', abertura_outros = '$abertura_outros', retomada_correcao = '$retomada_correcao', retomada_aula = '$retomada_aula', retomada_revisao = '$retomada_revisao', abertura_exemplifique = '$abertura_exemplifique', sequencia_slide = '$sequencia_slide', sequencia_exposicao = '$sequencia_exposicao', sequencia_pesquisa = '$sequencia_pesquisa', sequencia_livro = '$sequencia_livro', sequencia_predicao = '$sequencia_predicao', sequencia_leitura = '$sequencia_leitura', sequencia_generos = '$sequencia_generos', sequencia_jogos = '$sequencia_jogos', sequencia_projetos = '$sequencia_projetos', sequencia_redes_socias = '$sequencia_redes_socias', sequencia_outros = '$sequencia_outros', sequencia_exemplifique = '$sequencia_exemplifique', fechamento_oral = '$fechamento_oral', fechamento_livro = '$fechamento_livro', fechamento_pesquisa = '$fechamento_pesquisa', fechamento_exercicio = '$fechamento_exercicio', fechamento_atividade = '$fechamento_atividade', fechamento_plataformas = '$fechamento_plataformas', fechamento_materiais = '$fechamento_materiais', fechamento_casa = '$fechamento_casa', fechamento_exemplifique = '$fechamento_exemplifique', recursos_tablet = '$recursos_tablet', recursos_datashow = '$recursos_datashow', recursos_pnld = '$recursos_pnld', recursos_notebook = '$recursos_notebook', recursos_impressas = '$recursos_impressas', recursos_outros = '$recursos_outros', avaliacao = '$avaliacao'  WHERE id_aula = '$id_aula'");
	
			mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, ATUALIZOU O PLANO DE AULA DA ATIVIDADE $id_aula', '$operador')");

	mysqli_query($conexao_bd, "UPDATE atividades SET objetivo = '$objetivo' WHERE id = '$id_aula'");;

echo "<script language='javascript'>window.alert('Plano de aula atualizado!');window.location='';</script>";

}
}?>



<div class="container">
  <div class="container-fluid">
    <div class="row" style="border:5px solid #069;">
      <div class="col-sm">
    <? echo base64_decode($_GET['ik']);
	 $sql_plano_aula = mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula WHERE id_aula = '".base64_decode($_GET['ik'])."'");
	  while($res_plano_aula = mysqli_fetch_array($sql_plano_aula)){
		  $eixos = $res_plano_aula['eixo'];
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
        <td width="191" rowspan="3"><img src="../img/logo_plano.png" width="285" height="81" />
          <hr />
          <strong>COMPONENTE:</strong> <? echo $res_disciplinas['componente']; ?></td>
        <td colspan="3"><strong>ESCOLA: ESCOLA JOSE MARIA BARROS DE PINHOz</strong>  
        <a href="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>"><img style="float:right;" title="Voltar" src="../img/voltar.png" width="20" height="20" border="0" /> </a>



        <a target="_blank" href="pdf/imprimir_plano_de_aula.php?componente=<? echo $_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>&professor=<? echo $_GET['professor']; ?>&tipo=<? echo $_GET['tipo']; ?>&ik=<? echo $_GET['ik']; ?>"><img style="float:right;" title="Imprimir plano de aula" src="img/impressora2.png" width="20" height="20" border="0" /></a>
        
        
        </td>
      </tr>
      <tr>
        <td width="287"><strong>ANO:</strong> <? echo $res_turma['code_serie']; ?>° ANO</td>
        <td width="241"><strong>TURMA:</strong> <? echo $res_turma['tipo_turma']; ?></td>
        <td width="243"><strong>TURNO:</strong> <? echo $res_turma['turno']; ?></td>
      </tr>
      <tr>
        <td><strong>DATA:</strong> <? echo $res_datas_vencimento['vencimento']; ?></td>
        <td colspan="2"><strong>PROFESSOR:</strong> <? echo $res_professor['nome_escola']; ?></td>
      </tr>
      <? }}}}} ?>
    </table>  
    
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

	<? if($eixos == 'OUTROS' || $eixos == 'ATIVIDADES INTERCLASSE' || $eixos == 'DATAS COMEMORATIVAS'){ ?>
     <input type="text" name="habilidade" value="<? echo $res_plano_aula['habilidade']; ?>" class="form-control"/>
    <? }else{ ?>

    <select name="habilidade" class="form-select" aria-label="Default select example" style="width:590px; float:left; padding:5px; margin:0;">

      <option value="<? echo strtoupper($res_plano_aula['habilidade']); ?>"><?
	  	
   		$sql_nbcc = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE cod_habilidade = '".$res_plano_aula['habilidade']."'");
		   while($res_nbcc = mysqli_fetch_array($sql_nbcc)){
	  
	   		echo strtoupper($res_nbcc['cod_habilidade']); ?> - <? 
			
			$habilidade = strtoupper($res_nbcc['habilidade']);
			
			
			
			str_replace("ç", "C", $habilidade);
			str_replace("ã", "Ã", $habilidade);
			str_replace("é", "É", $habilidade);
			
			echo $habilidade; 
	    
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
              <?  if($eixos == 'OUTROS' || $eixos == 'ATIVIDADES INTERCLASSE' || $eixos == 'DATAS COMEMORATIVAS'){  ?>
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
                  <label for="modalidade"></label>
                AULA PRESENCIAL</td>
              </tr>
            </table>
            <table width="1070" border="1" class="table">
            <thead class="thead-dark">
              <tr>
                <th width="142" bgcolor="#003366" align="center"><h6 style="color:#FFF; text-align:center"><strong>TEMPOS PEDAG&Oacute;GICOS</strong></h6></td>
                <th width="897" align="center" bgcolor="#003366"><h6 style="color:#FFF;"><strong>ENCAMINHAMENTOS METODOLÓGICOS</strong></h6></td>
              </tr>
              <tr>
                <td width="142" align="center" bgcolor="#0099CC">ABERTURA</td>
                <td><input name="abertura_acolhida" type="checkbox" id="abertura_acolhida" value="SIM" <? if($res_plano_aula['abertura_acolhida'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
                  Acolhida <br />
                    <input name="abertura_contacao" type="checkbox" id="abertura_contacao" value="SIM" <? if($res_plano_aula['abertura_contacao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Conta&ccedil;&atilde;o de hist&oacute;ria<br />
<input name="abertura_musica" type="checkbox" id="abertura_musica" value="SIM" <? if($res_plano_aula['abertura_musica'] == 'SIM'){ ?> checked="checked" <? } ?>/>
M&uacute;sica <br />
<input name="abertura_agenda" type="checkbox" id="abertura_agenda" value="SIM" <? if($res_plano_aula['abertura_agenda'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Agenda do dia<br />
 Outros:
 <label for="abertura_outros"></label>
<textarea class="form-control" name="abertura_outros" id="abertura_outros" cols="80" rows="2"><? echo $res_plano_aula['abertura_outros']; ?></textarea></td>
              </tr>
              <tr>
                <td align="center">RETOMADA DO CONTE&Uacute;DO</td>
                <td><p>
                  <input name="retomada_correcao" type="checkbox" id="retomada_correcao" value="SIM" <? if($res_plano_aula['retomada_correcao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  <label for="retomada_correcao"></label>
                  Corre&ccedil;&atilde;o do exerc&iacute;cio da aula anterior<br />
  <input name="retomada_aula" type="checkbox" id="retomada_aula" value="SIM" <? if($res_plano_aula['retomada_aula'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  Retomada da aula anterior<br />
  <input name="retomada_revisao" type="checkbox" id="retomada_revisao" value="SIM" <? if($res_plano_aula['retomada_revisao'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                Revis&atilde;o do conte&uacute;do em estudo</p>
                <p>Outros:
                  <label for="abertura_outros"></label>
                  <textarea class="form-control" name="abertura_exemplifique" id="abertura_exemplifique" cols="80" rows="2"><? echo $res_plano_aula['abertura_exemplifique']; ?></textarea>
                </p></td>
              </tr>
              </thead>
              <tr>
                <td bgcolor="#0099CC" align="center">SEQUÊNCIA<br>
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
                    Leitura dirigida
<br>
                  
                    <input name="sequencia_generos" type="checkbox" id="sequencia_generos" value="SIM" <? if($res_plano_aula['sequencia_generos'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
                    G&ecirc;neros textuais
<br>
                 
                    <input name="sequencia_jogos" type="checkbox" id="sequencia_jogos" value="SIM" <? if($res_plano_aula['sequencia_jogos'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                    Jogos e desafios<br>
                  
                    <input name="sequencia_projetos" type="checkbox" id="sequencia_projetos" value="SIM" <? if($res_plano_aula['sequencia_projetos'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                    Projetos trabalhados

                    <br>
                    <input name="sequencia_redes_socias" type="checkbox" id="sequencia_redes_socias" value="SIM" <? if($res_plano_aula['sequencia_redes_socias'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
                    Uso de redes sociais
<br>
                 
Outros: 
                    <input type="text" name="sequencia_outros" id="sequencia_outros" value="<? echo $res_plano_aula['sequencia_outros']; ?>" />
                    <br>
                    Exemplifique:<br>
                    <textarea class="form-control" name="sequencia_exemplifique" id="sequencia_exemplifique" cols="80" rows="3"><? echo $res_plano_aula['sequencia_exemplifique']; ?></textarea>
                  </p></td>
              </tr>
              <tr>
                <td bgcolor="#0099CC" align="center">FECHAMENTO</td>
                <td>
                  <input name="fechamento_oral" type="checkbox" id="fechamento_oral" value="SIM" <? if($res_plano_aula['fechamento_oral'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
                  Atividade oral
 <br>
                  
                    <input name="fechamento_livro" type="checkbox" id="fechamento_livro" value="SIM" <? if($res_plano_aula['fechamento_livro'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Atividade do Livro did&aacute;tico <br>
                 
                    <input name="fechamento_pesquisa" type="checkbox" id="fechamento_pesquisa" value="SIM" <? if($res_plano_aula['fechamento_pesquisa'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Pesquisa de aprofundamento <br>

                    <input name="fechamento_exercicio" type="checkbox" id="fechamento_exercicio" value="SIM" <? if($res_plano_aula['fechamento_exercicio'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Exerc&iacute;cio de fixa&ccedil;&atilde;o  <br>
<input name="fechamento_atividade" type="checkbox" id="fechamento_atividade" value="SIM" <? if($res_plano_aula['fechamento_atividade'] == 'SIM'){ ?> checked="checked" <? } ?>/>
                  Atividade a partir de objetos digitais criados        pelo docente  <br>
                    <input name="fechamento_plataformas" type="checkbox" id="fechamento_plataformas" value="SIM" <? if($res_plano_aula['fechamento_plataformas'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
                    Plataformas digitais
<br>
                    <input name="fechamento_materiais" type="checkbox" id="fechamento_materiais" value="SIM" <? if($res_plano_aula['fechamento_materiais'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
                    Materiais de apoio
<br>                  
                    <input name="fechamento_casa" type="checkbox" id="fechamento_casa" value="SIM" <? if($res_plano_aula['fechamento_casa'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
                    Atividade casa
<br>
                    Exemplifique:<br>
                    <textarea class="form-control" name="fechamento_exemplifique" id="fechamento_exemplifique" cols="80" rows="3"><? echo $res_plano_aula['fechamento_exemplifique']; ?></textarea>
                </p></td>
              </tr>
              <tr>
                <td bgcolor="#0099CC" align="center">RECURSOS</td>
                <td><p>
                  <input name="recursos_tablet" type="checkbox" id="recursos_tablet" value="SIM" <? if($res_plano_aula['recursos_tablet'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
                    Tablet
                    <input name="recursos_datashow" type="checkbox" id="recursos_datashow" value="SIM" <? if($res_plano_aula['recursos_datashow'] == 'SIM'){ ?> checked="checked" <? } ?>/>
Datashow
<input name="recursos_pnld" type="checkbox" id="recursos_pnld" value="SIM" <? if($res_plano_aula['recursos_pnld'] == 'SIM'){ ?> checked="checked" <? } ?>/>
PNLD
<input name="recursos_notebook" type="checkbox" id="recursos_notebook" value="SIM" <? if($res_plano_aula['recursos_notebook'] == 'SIM'){ ?> checked="checked" <? } ?>/>
              Notebook 
              <input name="recursos_impressas" type="checkbox" id="recursos_impressas" value="SIM" <? if($res_plano_aula['recursos_impressas'] == 'SIM'){ ?> checked="checked" <? } ?>/> 
              Atividades impressas
<br>
<br>
              Outros
              <input type="text" name="recursos_outros" value="<? echo $res_plano_aula['recursos_outros']; ?>" />
            </p></td>
              </tr>
              <tr>
                <td bgcolor="#0099CC" align="center">AVALIA&Ccedil;&Atilde;O</td>
                <td><textarea class="form-control" name="avaliacao" id="avaliacao" cols="80" rows="3"><? echo $res_plano_aula['avaliacao']; ?></textarea></td>
              </tr>                           
              <tr>
                <td colspan="2" align="center"><input class="btn btn-primary" type="submit" name="button" id="button" value="Salvar plano de aula" /></td>
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