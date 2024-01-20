<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
<link href="../img/index.png" rel="shortcut icon" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="../jquery.superbox-min.js"></script>
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

<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
<style>
body{
	font:12px Arial, Helvetica, sans-serif;
	}
body td{
	border:1px solid #CCC;
	}
body input{
	border:1px solid #CCC;
	padding:5px;
	color:#900;
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
<? require "../../conexao.php"; $turma = @$_GET['turma']; $operador = @$_GET['operador']; $componente = $_GET['componente']; ?>
<? if(@$_GET['p'] == ''){ ?> <? if(isset($_POST['avancar'])){

$periodo = $_POST['periodo'];

echo "<script language='javascript'>window.location='?p=c&turma=$turma&componente=$componente&operador=$operador&periodo=$periodo';</script>";

}?>
<h1 style="text-align:center;">
<form name="" method="post" action="" enctype="multipart/form-data">
<br /><br /><br />
<strong style="font:16px Arial, Helvetica, sans-serif; border:0px solid #000;"><strong>Informe o período da atividade</strong></strong>
<br /><br />
<select style="border:1px solid #999; padding:10px;" name="periodo" size="1">
  <option value="1">1&deg; BIMESTRE</option>
  <option value="2">2&deg; BIMESTRE</option>
  <option value="3">3&deg; BIMESTRE</option>
  <option value="4">4&deg; BIMESTRE</option>
</select>
<input style="padding:10px;" type="submit" name="avancar" value="Avançar" />
</form>
</h1>
<? } ?>

<? if(@$_GET['p'] == 'c'){ ?>

<? 

$code_atividade = $_GET['code_atividade'];


if($code_atividade == ''){
$code_atividade = rand()+date("m");
$periodo = $_GET['periodo'];

$sigla_componente = 0;
mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$operador', 'CREDITO', '5', 'Postagem de atividade', '$data')");



$sql_busca_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '$componente'");
while($res_componente = mysqli_fetch_array($sql_busca_componente)){
	
	$sigla_componente = strtoupper($res_componente['componente']);
	$sigla_componente = $sigla_componente[0];
}


	mysqli_query($conexao_bd, "INSERT INTO atividades (code_dia, code_dia_atividade, sigla_componente, data_formatado, periodo, code_atividade, dia, mes, ano, usuario, trava_recebimento, habilidade, turma, componente, objetivo, video, video2, video3, arq_complementar, tipo_envio, code_entrega, code_entrega2, plano, link_externo, carga_horaria, tipo_atividade) VALUES ('', '', '$sigla_componente', '', '$periodo', '$code_atividade', '".date("d")."', '".date("m")."', '".date("Y")."', '$operador', 'NAO', '', '$turma', '$componente', '', '', '', '', 'SIM', 'arquivo', '', '', '', '', '2', '$tipo_atividade')");
	
	mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, INICIOU CADASTRO DE ATIVIDADE $code_atividade DA DISCIPLINA $componente', '$operador')");
	
	
echo "<script language='javascript'>window.location='?p=c&code_atividade=$code_atividade&turma=$turma';</script>";
}

?>






<? if(isset($_POST['button'])){

$objetivo = $_POST['objetivo'];
$dia = $_POST['dia'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$trava = $_POST['trava'];
$video = $_POST['video'];
$video2 = $_POST['video2'];
$video3 = $_POST['video3'];
$documento = $_POST['documento'];
$tipo_envio = $_POST['tipo_envio'];
$link_externo = $_POST['link_externo'];
$carga_horaria = $_POST['carga_horaria'];
$tipo_atividade = $_POST['tipo_atividade'];

$habilidade = $_POST['habilidade'];

$code_entrega = 0;
$data_maxima = "$dia/$mes/$ano";
$data_formatado = "$ano-$mes-$dia";

$code_dia_atividade = 0;

$sql_data_entrega = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data_maxima'");
while($res_data = mysqli_fetch_array($sql_data_entrega)){
	$code_entrega = $res_data['codigo']+1;
	$code_dia_atividade = $res_data['codigo'];
}

$code_entrega2 = $code_entrega+1;


if($objetivo == ''){
 echo "<script language='javascript'>window.alert('Você deve informar o objetivo da aula!');</script>";
}elseif($trava == ''){
 echo "<script language='javascript'>window.alert('Informe se você vai travar a atividade!');</script>";
}elseif($documento == ''){
 echo "<script language='javascript'>window.alert('Informe se você vai algum documento extra!');</script>";
}elseif($tipo_envio == ''){
 echo "<script language='javascript'>window.alert('Informe a forma como o aluno vai enviar a atividade!');</script>";
}else{


$code_atividade = $_GET['code_atividade'];

$sql_atividade = mysqli_query($conexao_bd, "UPDATE atividades SET code_dia_atividade = '$code_dia_atividade', data_formatado = '$data_formatado', dia = '$dia', mes = '$mes', ano = '$ano', trava_recebimento = '$trava', habilidade = '$habilidade', objetivo = '$objetivo', video = '$video', video2 = '$video2', video3 = '$video3', arq_complementar = '$documento', tipo_envio = '$tipo_envio', code_entrega = '$code_entrega', code_entrega2 = '$code_entrega2', link_externo = '$link_externo', carga_horaria = '$carga_horaria', tipo_atividade = '$tipo_atividade' WHERE code_atividade = '$code_atividade'");

	mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, INICIOU ALTERAÇÃO DE ATIVIDADE $code_atividade', '$operador')");


	$id_aula = $_POST['id_aula'];
	
	$fase = 0;
	$sql_verifica_anos = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
	 while($res_verifica_anos = mysqli_fetch_array($sql_verifica_anos)){
		 $fase = $res_verifica_anos['fase'];
	}
	
	if($fase == 'ANOS INICIAS'){
		mysqli_query($conexao_bd, "INSERT INTO plano_de_aula_iniciais (data, id_aula, status, status_coordenacao, observacao_professor, observacao_coodenacao, professor, turma, eixo, habilidade, conteudo, objetivo, modalidade, acolhida_oracao, acolhida_contacao_historia, acolhida_musicas, acolhida_procedimentos, leitrua_acervo_paic, leitrua_predicao_tema, leitrua_contextualizaao_da_leitura, leitrua_acervo_estudo_em_casa, leitrua_leitura_individual, leitrua_video_aulas, leitrua_outros, leitrua_outros_descricao, leitura_procedimentos, atividade_generos, atividade_cadernos, atividade_atividades, atividade_compreensao, atividade_producao, atividade_material_online, atividade_xerocada, atividade_procedimentos, recursos_mesa, recursos_tablet, recursos_datashow, recursos_pnld, recursos_notebook, recursos_outros, avaliacao) VALUES ('$data', '$id_aula', 'Ativo', '', '', '', '$professor', '$turma', '$habilidade', '', '', '$objetivo', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')");
	}else{
	$sql_id_aula = mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula WHERE id_aula = '$id_aula'");
	if(mysqli_num_rows($sql_id_aula) == ''){
	$sqlPlanoDeAula = mysqli_query($conexao_bd, "INSERT INTO plano_de_aula (data, id_aula, status, status_coordenacao, observacao_professor, observacao_coodenacao, professor, turma, eixo, habilidade, conteudo, objetivo, modalidade, abertura_acolhida, abertura_contacao, abertura_musica, abertura_agenda, abertura_outros, retomada_correcao, retomada_aula, retomada_revisao, abertura_exemplifique, sequencia_slide, sequencia_exposicao, sequencia_pesquisa, sequencia_livro, sequencia_predicao, sequencia_leitura, sequencia_generos, sequencia_jogos, sequencia_projetos, sequencia_redes_socias, sequencia_outros, sequencia_exemplifique, fechamento_oral, fechamento_livro, fechamento_pesquisa, fechamento_exercicio, fechamento_atividade, fechamento_plataformas, fechamento_materiais, fechamento_casa, fechamento_exemplifique, recursos_tablet, recursos_datashow, recursos_pnld, recursos_notebook, recursos_impressas, recursos_outros, avaliacao) VALUES ('$data', '$id_aula', 'Ativo', '', '', '', '$professor', '$turma', '$habilidade', '$habilidade', '$conteudo', '$objetivo', '$modalidade',  'abertura_acolhida', 'abertura_contacao', 'abertura_musica', 'abertura_agenda', 'abertura_outros', 'retomada_correcao', 'retomada_aula', 'retomada_revisao', 'abertura_exemplifique', 'sequencia_slide', 'sequencia_exposicao', 'sequencia_pesquisa', 'sequencia_livro', 'sequencia_predicao', 'sequencia_leitura', 'sequencia_generos', 'sequencia_jogos', 'sequencia_projetos', 'sequencia_redes_socias', 'sequencia_outros', 'sequencia_exemplifique', 'fechamento_oral', 'fechamento_livro', 'fechamento_pesquisa', 'fechamento_exercicio', 'fechamento_atividade', 'fechamento_plataformas', 'fechamento_materiais', 'fechamento_casa', 'fechamento_exemplifique', 'recursos_tablet', 'recursos_datashow', 'recursos_pnld', 'recursos_notebook', 'recursos_impressas', 'recursos_outros', 'avaliacao')");
	
	 if($sqlPlanoDeAula == ''){
	 	echo "<script>window.alert('Ocorreu um erro a criar o plano de aula, tente novamente!');</script>";
	 }
	
	}
	
	} // verifica fase



if($documento == 'SIM'){
echo "<script language='javascript'>window.location='?p=2&turma=$turma&documento=$documento&tipo_envio=$tipo_envio&code_atividade=$code_atividade';</script>";
}elseif($tipo_envio == 'arquivo' && $documento == 'NAO'){
echo "<script language='javascript'>window.location='?p=final';</script>";
}elseif($tipo_envio == 'multipla' && $documento == 'NAO'){
echo "<script language='javascript'>window.location='?p=3&turma=$turma&documento=$documento&tipo_envio=$tipo_envio&code_atividade=$code_atividade';</script>";
}elseif($tipo_envio == 'varios' && $documento == 'NAO'){
echo "<script language='javascript'>window.location='?p=4&turma=$turma&documento=$documento&tipo_envio=$tipo_envio&code_atividade=$code_atividade';</script>";
}else{
echo "<script language='javascript'>window.location='?p=2&turma=$turma&code_atividade=$code_atividade';</script>";
 }
}
}?>

<?

$code_atividade = $_GET['code_atividade'];
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '$code_atividade'");
while($res_verifica = mysqli_fetch_array($sql_verifica)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="550" border="0"><input type="hidden" name="id_aula" value="<? echo $res_verifica['id']; ?>" />
  <tr>
    <td colspan="4" style="padding:5px;" bgcolor="#99CC00"><strong>OBJETIVO</strong></td>
  </tr>
  <tr>
    <td colspan="4"><label for="objetivo"></label>
    <input name="objetivo" type="text" id="objetivo" value="<? echo $res_verifica['objetivo']; ?>" size="72"></td>
  </tr>
  <tr>
    <td width="264" colspan="2" bgcolor="#99CC00" style="padding:5px;"><strong>DATA DA ENTREGA</strong></td>
    <td width="226" colspan="2" bgcolor="#99CC00" style="padding:5px;"><strong>TRAVA RECEBIMENTO</strong></td>
  </tr>
  <tr>
    <td colspan="2"><label for="video"></label>
      <label for="dia"></label>
      <select name="dia" size="1" id="dia">
        <option value="<? echo $res_verifica['dia']; ?>"><? echo $res_verifica['dia']; ?></option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
      <label for="mes"></label>
      <select name="mes" size="1" id="mes">
        <option value="<? echo $mes = $res_verifica['mes']; ?>"><?  
		if($mes == '01'){
			echo "JANEIRO";
		}elseif($mes == '02'){
			echo "FEVEREIRO";
		}elseif($mes == '03'){
			echo "MARÇO";
		}elseif($mes == '04'){
			echo "ABRIL";
		}elseif($mes == '05'){
			echo "MAIO";
		}elseif($mes == '06'){
			echo "JUNHO";
		}elseif($mes == '07'){
			echo "JULHO";
		}elseif($mes == '08'){
			echo "AGOSTO";
		}elseif($mes == '09'){
			echo "SETEMBRO";
		}elseif($mes == '10'){
			echo "OUTUBRO";
		}elseif($mes == '11'){
			echo "NOVEMBRO";
		}elseif($mes == '12'){
			echo "DEZEMBRO";
		}
		
		 ?></option>
        <option value="01">JANEIRO</option>
        <option value="02">FEVEREIRO</option>
        <option value="03">MAR&Ccedil;O</option>
        <option value="04">ABRIL</option>
        <option value="05">MAIO</option>
        <option value="06">JUNHO</option>
        <option value="07">JULHO</option>
        <option value="08">AGOSTO</option>
        <option value="09">SETEMBRO</option>
        <option value="10">OUTUBRO</option>
        <option value="11">NOVEMBRO</option>
        <option value="12">DEZEMBRO</option>
      </select>
      <label for="ano"></label>
      <select name="ano" size="1" id="ano">
        <option value="2023">2023</option>
      </select></td>
    <td colspan="2">NÃO<input name="trava" type="radio" value="NAO" <? if($res_verifica['trava_recebimento'] == '' || $res_verifica['trava_recebimento'] == 'NAO'){ ?> checked> <? } ?>
      
      SIM<input name="trava" type="radio" value="SIM" <? if($res_verifica['trava_recebimento'] == 'SIM'){ ?> checked> <? } ?>
      
    </td>
  </tr>
  <tr>
    <td colspan="4" style="padding:5px;" bgcolor="#99CC00"><strong>VÍDEO EXPLICATIVO 1</strong></td>
  </tr>
  <tr>
    <td colspan="4"><label for="textfield3"></label>
    <input name="video" type="text" id="textfield3" size="72" value="<? echo $res_verifica['video']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="4" style="padding:5px;" bgcolor="#99CC00"><strong>V&Iacute;DEO EXPLICATIVO 2</strong></td>
  </tr>
  <tr>
    <td colspan="4"><input name="video2" type="text" id="video2" size="72" value="<? echo $res_verifica['video2']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="4" style="padding:5px;" bgcolor="#99CC00"><strong>V&Iacute;DEO EXPLICATIVO 3</strong></td>
  </tr>
  <tr>
    <td colspan="4"><input name="video3" type="text" id="video3" size="72" value="<? echo $res_verifica['video3']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#99CC00"><strong>LINK EXTERNO</strong></td>
  </tr>
  <tr>
    <td colspan="4"><input name="link_externo" type="text" size="72" value="<? echo $res_verifica['link_externo']; ?>" /></td>
  </tr>
  <tr>
    <td style="padding:5px;" align="center" bgcolor="#99CC00"><strong>INCLUIR ARQUIVO?</strong></td>
    <td style="padding:5px;" align="center" bgcolor="#99CC00"><strong>CARGA HOR&Aacute;RIA</strong></td>
    <td style="padding:5px;" align="center" bgcolor="#99CC00"><strong>ENVIO</strong></td>
    <td style="padding:5px;" align="center" bgcolor="#99CC00"><strong>TIPO</strong></td>
  </tr>
  <tr>
    <td align="center">N&Atilde;O<input name="documento" type="radio" id="radio5" value="NAO" <? if($res_verifica['arq_complementar'] == 'NAO'){ ?> checked> <? } ?>
      <label for="radio5"> SIM
        <input name="documento" type="radio" id="radio6" value="SIM" <? if($res_verifica['arq_complementar'] == '' || $res_verifica['arq_complementar'] == 'SIM'){ ?> checked> <? } ?>
    </label></td>
    <td align="center"><label for="carga_horaria"></label>
      <select style="font:12px Arial, Helvetica, sans-serif; padding:8px;" name="carga_horaria" size="1" id="carga_horaria">
       
        <option value="<? echo $res_verifica['carga_horaria']; ?>"><? echo $res_verifica['carga_horaria'] ?> HORA(S)</option>

        <option value=""></option>
    
        <option value="1">1 HORA</option>
        <option value="2">2 HORAS</option>
      </select></td>
    <td>
        <select style="font:12px Arial, Helvetica, sans-serif; padding:8px;" name="tipo_envio" size="1" id="select">
          <option value="<? echo $res_verifica['tipo_envio']; ?>">
		  <? 
		   if($res_verifica['tipo_envio'] == 'arquivo'){ echo "Envio de arquivo";
		   }elseif($res_verifica['tipo_envio'] == 'multipla'){ echo "Multipla escolha";
		   }elseif($res_verifica['tipo_envio'] == 'varios'){ echo "Atividade mista";
		   }
		  ?>
          </option>
          <?  if($res_verifica['tipo_envio'] != 'arquivo'){ ?>
          <option value="arquivo">Envio de arquivo</option>
          <? } ?>
          
          <?  if($res_verifica['tipo_envio'] != 'multipla'){ ?>
	      <option value="multipla">Multipla escolha</option>
          <? } ?>
         
          <?  if($res_verifica['tipo_envio'] != 'varios'){ ?>
          <? } ?>
        </select>
      </td>
    <td><select style="font:12px Arial, Helvetica, sans-serif; padding:8px;" name="tipo_atividade" size="1" id="tipo_envio">
      <option value="<? echo $res_verifica['tipo_atividade']; ?>"><? echo $res_verifica['tipo_atividade']; ?></option>
      <option value="Atividade">Atividade</option>
      <option value="Atividade bimestral">Atividade bimestral</option>
      <option value="Avalia&ccedil;&atilde;o parcial">Avalia&ccedil;&atilde;o parcial</option>
      <option value="Avalia&ccedil;&atilde;o bimestral">Avalia&ccedil;&atilde;o Bimestral</option>
      <option value="Recuperação paralela">Recuperação paralela</option>
      <option value="Recuperação final">Recuperação final</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="4" align="left" bgcolor="#99CC00" style="padding:5px;"><strong>EIXO/UNIDADES TEM&Aacute;TICAS</strong></td>
  </tr>
  <tr>
    <td align="center" style="padding:5px;" colspan="4"><select name="habilidade" style="border:1px solid #999; padding:8px; border-radius:3px; width:535px; text-align:left;">
      <option value="OUTROS">OUTROS</option>
      <option value="ATIVIDADES INTERCLASSE">ATIVIDADES INTERCLASSE</option>
      <option value="DATAS COMEMORATIVAS">DATAS COMEMORATIVAS</option>
      <?
			
		  $componente = 0;
		  $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '".$_GET['code_atividade']."'");
		   while($res_atividade = mysqli_fetch_array($sql_atividade)){
			   $componente = $res_atividade['componente'];
		  }
		  
		  $serie = 0;
		  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
		   while($res_turma = mysqli_fetch_array($sql_turma)){
			   $serie = $res_turma['code_serie'];
		  }
		  
		  $sql_nbcc = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE status = 'Ativo' AND ano = '$serie' AND componente = '$componente' AND eixo != ''");
		   while($res_nbcc = mysqli_fetch_array($sql_nbcc)){
		?>
      <option value="<? echo strtoupper($res_nbcc['eixo']); ?>"><? echo strtoupper($res_nbcc['eixo']); ?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td align="center" style="padding:5px;" colspan="4"><input style="font:12px Arial, Helvetica, sans-serif; padding:10px;" type="submit" name="button" id="button" value="Avan&ccedil;ar" /></td>
  </tr>
</table>
</form>
<? } ?>

<? } ?>


<? if(@$_GET['p'] == '2'){ ?>
<strong>Digite o nome e selecione o arquivo a ser enviado</strong><br />
<? if(isset($_POST['enviar_arvivos'])){

$enviar_docs = $_FILES['enviar_docs']['name'];
$code_atividade = $_GET['code_atividade'];
$nome_arquivo = $_POST['nome_arquivo'];

if($enviar_docs == ''){
echo "<script language='javascript'>window.alert('Por favor, informe o arquivo que será enviado!');</script>";
}else{

$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");
$arquivo = $enviar_docs;
$arquivo = strrchr($arquivo, '.');

$enviar_docs = str_replace($enviar_docs, "$code_enviar_docs$arquivo", $enviar_docs);


if(file_exists("../arquivos/$enviar_docs")){ $a = 1;while(file_exists("../arquivos/[$a]$enviar_docs")){$a++;}$enviar_docs = "[".$a."]".$enviar_docs;}
(move_uploaded_file($_FILES['enviar_docs']['tmp_name'], "../arquivos/".$enviar_docs));

$sql = mysqli_query($conexao_bd, "INSERT INTO arquivos_atividades (code_atividade, nome_arquivo, arquivo) VALUES ('$code_atividade', '$nome_arquivo', '$enviar_docs')");

echo "<script language='javascript'>window.location='';</script>";
}
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<strong>Nome do arquivo:</strong> <input type="text" name="nome_arquivo" size="10" maxlength="50" style="padding:8px;" />
<input name="enviar_docs" type="file" /> <input name="enviar_arvivos" type="submit" value="Enviar" />
</form>
<hr />
<em><strong>Arquivos da atividade</strong></em>
<?
$sql_arquivos = mysqli_query($conexao_bd, "SELECT * FROM arquivos_atividades WHERE code_atividade = '".$_GET['code_atividade']."'");
$conta_arquivos = mysqli_num_rows($sql_arquivos);
if($conta_arquivos == ''){
	echo "<em><br>Não foi enviado arquivo para esta atividade.</em>";
}else{
?>
<ul>
<? while($res_arq = mysqli_fetch_array($sql_arquivos)){ ?>
<li><strong><? echo $res_arq['nome_arquivo']; ?></strong> - <a href="../arquivos/<? echo @$res_arq['arquivo']; ?>"><? echo @$res_arq['arquivo']; ?></a> - <a href="?p=<? echo @$_GET['p']; ?>&turma=<? echo @$_GET['turma']; ?>&documento=<? echo @$_GET['documento']; ?>&tipo_envio=<? echo @$_GET['tipo_envio']; ?>&code_atividade=<? echo @$_GET['code_atividade']; ?>&acao=excluir_ar&id=<? echo @$res_arq['id']; ?>"><img src="../img/deleta.jpg" width="12" height="12" border="0" /></a></li>
<? } ?>
</ul>
<? } ?>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<input style="font:12px Arial, Helvetica, sans-serif; background:#09C; color:#FFF; margin:0 0 0 0; padding:10px;" type="submit" name="voltar" id="button" value="Voltar">
<input style="font:12px Arial, Helvetica, sans-serif; background:#0C0; float:right; margin:0 5px 0 0; color:#FFF; border:2px solid #000; padding:10px;" type="submit" name="avancar" id="button" value="Avançar">
</form>
<? if(isset($_POST['voltar'])){
$turma = $_GET['turma'];
$code_atividade = $_GET['code_atividade'];

echo "<script language='javascript'>window.location='postar_atividade.php?p=&code_atividade=$code_atividade&turma=$turma';</script>";
}?>


<? if(isset($_POST['avancar'])){
	
$turma = $_GET['turma'];
$documento = $_GET['documento'];
$tipo_envio = $_GET['tipo_envio'];
$code_atividade = $_GET['code_atividade'];

if($conta_arquivos <=0){
echo "<script language='javascript'>window.alert('Ainda não foi anexado o arquivo dessa atividade!');</script>";
}else{
if($tipo_envio == 'arquivo'){
echo "<script language='javascript'>window.location='?p=final';</script>";
}elseif($tipo_envio == 'varios'){
echo "<script language='javascript'>window.location='?p=3&turma=$turma&documento=$documento&tipo_envio=$tipo_envio&code_atividade=$code_atividade';</script>";
}else{
echo "<script language='javascript'>window.location='?p=3&turma=$turma&documento=$documento&tipo_envio=$tipo_envio&code_atividade=$code_atividade';</script>";
}
}
}?>




<? } ?>





<? if(@$_GET['p'] == '3'){ ?>
<strong>Informo o total de questões</strong><br />
<? if(isset($_POST['enviar'])){
	
$total = $_POST['total'];

$turma = $_GET['turma'];
$documento = $_GET['documento'];
$tipo_envio = $_GET['tipo_envio'];
$code_atividade = $_GET['code_atividade'];

$p = 0;

if($tipo_envio == 'varios'){
	$p = 5;
}else{
	$p = 4;
}
	
echo "<script language='javascript'>window.location='?p=$p&turma=$turma&documento=$documento&tipo_envio=$tipo_envio&code_atividade=$code_atividade&total=$total&atual=1';</script>";

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input type="number" name="total" /> <input type="submit" name="enviar" value="Enviar" />
</form>
<? } ?>



<? if(@$_GET['p'] == '5'){ $total = $_GET['total']; $atual = $_GET['atual'];  require "questao.php"; } ?>
<? if(@$_GET['p'] == '6'){ $total = $_GET['total']; $atual = $_GET['atual'];  require "tipo_questao.php"; } ?>





<? if(@$_GET['p'] == '4'){ $total = $_GET['total']; $atual = $_GET['atual'];  


$turma = $_GET['turma'];
$documento = $_GET['documento'];
$tipo_envio = $_GET['tipo_envio'];
$code_atividade = $_GET['code_atividade'];

?>
<h1 style="font:15px Arial, Helvetica, sans-serif;"><strong><? echo $atual; ?>° Questão</strong> | <a rel="superbox[iframe][500x600]" style="padding:8px; background:#093; text-decoration:none; border:1px solid #000; color:#FFF;" href="fotos.php?usuario=<? echo $usuario; ?>">Imagens</a>
</h1><hr />
<?
$sql_verifica_questao = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '$code_atividade' AND id_questao = '$atual'");
if($atual > $total){
echo "<script language='javascript'>window.location='?p=final';</script>";
}elseif(mysqli_num_rows($sql_verifica_questao) == ''){
	
	require_once "../../conexao.php";
	$sqlCriaQuestao = mysqli_query($conexao_bd, "INSERT INTO questoes_atividades (turma, atividade, id_questao, questao, item_a, item_b, item_c, item_d, correta) VALUES ('$turma', '$code_atividade', '$atual', '', '', '', '', '', '')");
	
	if($sqlCriaQuestao == ''){
		echo "<script language='javascript'>alert('ocorreu um erro!');</script>";
	}else{
		echo "<script language='javascript'>window.location='';</script>";
	}
}

?>

<? if(isset($_POST['anunciado'])){

$anunciado = $_POST['anunciado'];
$opcao = $_POST['opcao'];
$item_a = $_POST['item_a'];
$item_b = $_POST['item_b'];
$item_c = $_POST['item_c'];
$item_d = $_POST['item_d'];


mysqli_query($conexao_bd, "UPDATE questoes_atividades SET questao = '$anunciado', item_a = '$item_a', item_b = '$item_b', item_c = '$item_c', item_d = '$item_d', correta = '$opcao' WHERE atividade = '$code_atividade' AND id_questao = '$atual'");

if($anunciado == ''){
echo "<script language='javascript'>window.alert('O enunciado da questão não pode ficar em branco!');window.location='';</script>";
}elseif($opcao == ''){
echo "<script language='javascript'>window.alert('Você deve informar a opção correta!');window.location='';</script>";
}elseif($item_a == ''){
echo "<script language='javascript'>window.alert('A alternativa A está em branco!');window.location='';</script>";
}elseif($item_b == ''){
echo "<script language='javascript'>window.alert('A alternativa B está em branco!');window.location='';</script>";
}elseif($item_c == ''){
echo "<script language='javascript'>window.alert('A alternativa C está em branco!');window.location='';</script>";
}elseif($item_d == ''){
echo "<script language='javascript'>window.alert('A alternativa D está em branco!');window.location='';</script>";
}else{

echo "<script language='javascript'>window.location='?p=mostra&turma=$turma&documento=$documento&tipo_envio=$tipo_envio&code_atividade=$code_atividade&total=$total&atual=$atual';</script>";
}
}?>


<?

$sql = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '$code_atividade' AND id_questao = '$atual'");
while($res = mysqli_fetch_array($sql)){
?>
<form action="" method="post">
<table width="375" border="0">
  <tr>
    <td colspan="2"><h3>
      <label for="anunciado"></label>
      <textarea name="anunciado" id="anunciado" cols="60" rows="8"><? echo $res['questao']; ?></textarea>
    </h3></td>
  </tr>
  <tr>
    <td width="51"><p>
      A) 
      <input name="opcao" type="radio" id="radio" value="A" <? if($res['correta'] == 'A'){ ?>checked="checked" <? } ?>/>
    </p></td>
    <td width="317"><label for="item_a"></label>
    <textarea name="item_a" id="item_a" cols="50" rows="5"><? echo $res['item_a']; ?></textarea></td>
  </tr>
  <tr>
    <td>B)
      <input name="opcao" type="radio" id="radio2" value="B" <? if($res['correta'] == 'B'){ ?>checked="checked" <? } ?>/>
    <label for="opcao"></label></td>
    <td><textarea name="item_b" id="item_b" cols="50" rows="5"><? echo $res['item_b']; ?></textarea></td>
  </tr>
  <tr>
    <td>C) 
      <input name="opcao" type="radio" id="radio3" value="C" <? if($res['correta'] == 'C'){ ?>checked="checked" <? } ?>/>
    <label for="opcao"></label></td>
    <td><textarea name="item_c" id="item_c" cols="50" rows="5"><? echo $res['item_c']; ?></textarea></td>
  </tr>
  <tr>
    <td>D) 
      <input name="opcao" type="radio" id="radio4" value="D" v<? if($res['correta'] == 'D'){ ?>checked="checked" <? } ?>/>
    <label for="opcao"></label></td>
    <td><textarea name="item_d" id="item_d" cols="50" rows="5"><? echo $res['item_d']; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="button" id="button" value="Avançar"></td>
  </tr>
</table>
</form>
<? } ?>
<? }// FINAL DO P 4 ?>



<? if(@$_GET['p'] == 'mostra'){ $total = $_GET['total']; $atual = $_GET['atual']; 

$turma = $_GET['turma'];
$documento = $_GET['documento'];
$tipo_envio = $_GET['tipo_envio'];
$code_atividade = $_GET['code_atividade'];

?>

<?
$sql = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '$code_atividade' AND id_questao = '$atual'");
while($res = mysqli_fetch_array($sql)){
?>
<h1 style="font:15px Arial, Helvetica, sans-serif;"><? echo $res['questao']; ?></h1><br />
<table width="395" border="0">
  <tr>
    <td width="43"><p>
      A) 
      <input name="radio" type="radio" disabled="disabled" id="radio" value="radio" <? if($res['correta'] == 'A'){ ?> checked="checked" <? } ?>>
    </p></td>
    <td width="342"><? echo $res['item_a']; ?></td>
  </tr>
  <tr>
    <td>B)
      <input type="radio" name="radio2" id="radio2" disabled="disabled" value="radio2"<? if($res['correta'] == 'B'){ ?> checked="checked" <? } ?>>
    <label for="radio2"></label></td>
    <td><? echo $res['item_b']; ?></td>
  </tr>
  <tr>
    <td>C) 
      <input type="radio" name="radio3" id="radio3" disabled="disabled" value="radio3"<? if($res['correta'] == 'C'){ ?> checked="checked" <? } ?>>
    <label for="radio3"></label></td>
    <td><? echo $res['item_c']; ?></td>
  </tr>
  <tr>
    <td>D) 
      <input type="radio" name="radio4" id="radio4" disabled="disabled" value="radio4" <? if($res['correta'] == 'D'){ ?> checked="checked" <? } ?>>
    <label for="radio4"></label></td>
    <td><? echo $res['item_d']; ?></td>
  </tr>
  <tr>
    <td colspan="2">
    <br />
    <a style="background:#069; padding:10px; text-decoration:none; color:#FFF; border:1px solid #000;" href="?p=4&turma=<? echo $turma; ?>&documento=<? echo $documento; ?>&tipo_envio=<? echo $tipo_envio; ?>&code_atividade=<? echo $code_atividade; ?>&total=<? echo $total; ?>&atual=<? echo $atual+1; ?>">PRÓXIMA QUESTÃO</a>
    <a style="background:#990; padding:10px; text-decoration:none; color:#FFF; border:1px solid #000;" href="?p=4&turma=<? echo $turma; ?>&documento=<? echo $documento; ?>&tipo_envio=<? echo $tipo_envio; ?>&code_atividade=<? echo $code_atividade; ?>&total=<? echo $total; ?>&atual=<? echo $atual; ?>">VOLTAR EDIÇÃO</a>
     <br /> <br />
    </td>
  </tr>
</table>
<? } ?>
<hr />
<? } ?>



<? if(@$_GET['p'] == 'final'){  ?>

<h1 style="font:15px Arial, Helvetica, sans-serif;"><strong>Operação realizada com sucesso!</strong></h1>
<em>Pressione F5 para finalizar a operação.</em>

<? } ?>


</body>
</html>
<? if(@$_GET['acao'] == 'excluir_ar'){

mysqli_query($conexao_bd, "DELETE FROM arquivos_atividades WHERE id = '".$_GET['id']."'");
?>
<script language='javascript'>window.location="?p=<? echo $_GET['p']; ?>&turma=<? echo $_GET['turma']; ?>&documento=<? echo $_GET['documento']; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&code_atividade=<? echo $_GET['code_atividade']; ?>";</script>
<? }?>