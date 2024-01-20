<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; $id = base64_decode($_GET['ik']); $operador = $_GET['professor'];  $componente = $_GET['componente'];  $turma = $_GET['turma'];?>
<style type="text/css">
body{
	font:12px Arial, Helvetica, sans-serif;
	} 
</style>
</head>

<body>
<? if(isset($_POST['button'])){

$dia = $_POST['dia'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$turma = $_POST['turma'];

$code_atividade = rand()+date("m");

$objetivo = 0;
$video = 0;
$video2 = 0;
$video3 = 0;
$arq_complementar = 0;
$tipo_envio = 0;
$code_entrega = 0;
$code_entrega2 = 0;



$periodo = 0;
$code_dia_atividade = 0;
$data_formatado = 0;
$code_dia = 0;
$sigla_componente = 0;


$data_maxima = "$dia/$mes/$ano";
$data_formatado = "$ano-$mes-$dia";
$sql_data_entrega = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data_maxima'");
while($res_data = mysqli_fetch_array($sql_data_entrega)){
	$code_entrega = $res_data['codigo']+1;
	$code_dia_atividade = $res_data['codigo'];
}

$code_entrega2 = $code_entrega+1;


$code_atividade_anterior = 0;
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id'");
while($res_verifica = mysqli_fetch_array($sql_verifica)){
	$code_atividade_anterior = $res_verifica['code_atividade'];
	$objetivo = $res_verifica['objetivo'];
	$video = $res_verifica['video'];
	$video2 = $res_verifica['video2'];
	$video3 = $res_verifica['video3'];
	$arq_complementar = $res_verifica['arq_complementar'];
	$tipo_envio = $res_verifica['tipo_envio'];
	$link_externo = $res_verifica['link_externo'];
	$plano = $res_verifica['plano'];
	
	$periodo = $res_verifica['periodo'];
	
	$data_formatado = $res_verifica['data_formatado'];
	$code_dia = $res_verifica['code_dia'];
	
	
	$sigla_componente = $res_verifica['sigla_componente'];
	
}


$sql_arquivos = mysqli_query($conexao_bd, "SELECT * FROM arquivos_atividades WHERE code_atividade = '$code_atividade_anterior'");
if(mysqli_num_rows($sql_arquivos) == ''){
}else{
	while($res_arquivos = mysqli_fetch_array($sql_arquivos)){
		mysqli_query($conexao_bd, "INSERT INTO arquivos_atividades (code_atividade, nome_arquivo, arquivo) VALUES ('$code_atividade', '".$res_arquivos['nome_arquivo']."', '".$res_arquivos['arquivo']."') ");
	}	
}





	mysqli_query($conexao_bd, "INSERT INTO atividades (periodo, code_atividade, code_dia_atividade, dia, mes, ano, data_formatado, code_dia, usuario, trava_recebimento, habilidade, turma, componente, sigla_componente, objetivo, video, video2, video3, arq_complementar, tipo_envio, code_entrega, code_entrega2, plano, link_externo) VALUES ('$periodo', '$code_atividade', '$code_dia_atividade', '$dia', '$mes', '$ano', '$data_formatado', 'NAO', '$operador', 'NAO', '', '$turma', '$componente', '$sigla_componente', '$objetivo', '$video', '$video2', '$video3', '$arq_complementar', '$tipo_envio', '$code_entrega', '$code_entrega2', '$plano', '$link_externo')");


$sql_opcoes = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '$code_atividade_anterior'");
while($res_opcoes = mysqli_fetch_array($sql_opcoes)){
	mysqli_query($conexao_bd, "INSERT INTO questoes_atividades (turma, atividade, id_questao, questao, item_a, item_b, item_c, item_d, correta) VALUES ('$turma', '$code_atividade', '".$res_opcoes['id_questao']."', '".$res_opcoes['questao']."', '".$res_opcoes['item_a']."', '".$res_opcoes['item_b']."', '".$res_opcoes['item_c']."', '".$res_opcoes['item_d']."', '".$res_opcoes['correta']."')");
}




$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '$code_atividade'");
while($res_verifica = mysqli_fetch_array($sql_verifica)){
	$id_atividade = base64_encode($res_verifica['id']);
}
	mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, TRANSFERIU A ATIVIDADE code_atividade_anterior PARA A TURMA $turma, NOVO CÓDIGO DE ATIVIDADE $code_atividade', '$operador')");


echo "
<strong>Transferência realizada com sucesso!</strong>
<br>
<br>

Link da atividade:  http://escolaleornebelem.com/?ik=$id_atividade

<br>
<br>

<em>Pressione F5.</em>
";

die;

}?>




<?
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id'");
while($res_verifica = mysqli_fetch_array($sql_verifica)){
?>
<form action="" method="post" enctype="multipart/form-data">
<table width="300" border="0">
  <tr>
    <td bgcolor="#99CC00"><strong>Data da entrega</strong></td>
  </tr>
  <tr>
    <td><select style="font:12p Arial, Helvetica, sans-serif; text-align:center; width:60px; padding:5px;" name="dia" size="1" id="dia">
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
      <select style="font:12p Arial, Helvetica, sans-serif; text-align:center; width:120px; padding:5px;" name="mes" size="1" id="mes">
        <option value="<? echo $mes = $res_verifica['mes']; ?>">
          <?  
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
		
		 ?>
        </option>
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
      <select style="font:12p Arial, Helvetica, sans-serif; text-align:center; width:70px; padding:5px;" name="ano" size="1" id="ano">
        <option value="2021">2021</option>
    </select></td>
  </tr>
  <tr>
    <td bgcolor="#99CC00"><strong>Selecione a turma que essa atividade vai ser transferida</strong></td>
  </tr>
  <tr>
    <td>
      <select style="font:12p Arial, Helvetica, sans-serif; width:400px; padding:5px;" name="turma" size="1" id="select">
          <? $nome_escola = 0; $componente = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE professor = '$operador' AND turma != '".$_GET['turma']."' AND disciplina = '".$_GET['componente']."'");
		   while($res = mysqli_fetch_array($sql)){
		   
				  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res['turma']."'");
				   while($res_escola = mysqli_fetch_array($sql_escola)){
					   
					   $sql_nome_escola = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res['escola']."'");
				   		while($res_nome_escola = mysqli_fetch_array($sql_nome_escola)){
							$nome_escola = $res_nome_escola['nome_escola'];
						
						
					   $sql_nome_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['disciplina']."'");
				   		while($res_nome_componente = mysqli_fetch_array($sql_nome_componente)){
							$componente = $res_nome_componente['componente'];
						
						
		  ?>
        <option value="<? echo $res['turma']; ?>"><? echo $componente; ?> - <? echo $nome_escola; ?> - <? echo $res_escola['code_serie']; ?>° ano - <? echo $res_escola['tipo_turma']; ?> - <? echo $res_escola['turno']; ?></option>
          <? }}}} ?>
      </select>
    </td>
  </tr>
  <tr>
    <td><hr /><input style="font:12px Arial, Helvetica, sans-serif; padding:5px;" type="submit" name="button" id="button" value="Transferir"></td>
  </tr>
  </table>
</form>
<? } ?>
</body>
</html>