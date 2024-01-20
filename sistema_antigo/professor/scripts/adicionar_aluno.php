<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>

<style>
body{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	text-align:center;
	}
body input{
	font:12px Arial, Helvetica, sans-serif;
	width:250px;
	padding:5px;
	}
</style>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body> <? $turma = $_GET['turma']; $operador = $_GET['operador']; ?>

<? if(isset($_POST['enviar'])){

$n_chamada = $_POST['n_chamada'];
$telefone = $_POST['telefone'];
$telefone2 = $_POST['telefone2'];
$laudo = $_POST['laudo'];
$localidade = $_POST['localidade'];
$impresso = $_POST['impresso'];
$suprido = $_POST['suprido'];
$transferido = $_POST['transferido'];
$nome_aluno = strtoupper($_POST['nome_aluno']);
$aluno = rand()*date("d")+date("d");

if($nome_aluno == ''){
echo "<script language='javascript'>window.alert('Digite o nome do aluno!');window.location='';</script>";
}else{

mysqli_query($conexao_bd, "INSERT INTO alunos (dia, mes, ano, data_completa, usuario, turma, code_aluno, n_chamada, localidade, nome_aluno, telefone, telefone2, especial, impresso, suprido, transferido) VALUES ('$dia', '$mes', '$ano', '$data_completa', '$operador', '$turma', '$aluno', '$n_chamada', '$localidade', '$nome_aluno', '$telefone', '$telefone2', '$laudo', '$impresso', '$suprido', '$transferido')");

echo "<script language='javascript'>window.location='';</script>";
}
}?>

<form action="" method="post">
  <strong>Localidade</strong><br />
<select style="font:12px Arial, Helvetica, sans-serif; padding:5px; width:265px;" name="localidade" size="1">
  <option value="BOLSO">BOLSO</option>
  <option value="ANIL">ANIL</option>
  <option value="SAQUINHO">SAQUINHO</option>
  <option value="ACENDE CANDEIA DE CIMA">ACENDE CANDEIA DE CIMA</option>
  <option value="ACENDE CANDEIA DE BAIXO">ACENDE CANDEIA DE BAIXO</option>
  <option value="FLORES">FLORES</option>
  <option value="AREA VERDADE">AREA VERDADE</option>
  <option value="CATUANA">CATUANA</option>
  <option value="JACARE">JACARE</option>
  <option value="SÃO GONÇALO">SÃO GONÇALO</option>
</select>

<br />

  <strong>Nome do aluno - n° chamada:</strong>
  <?
	$n_chamada = 0;
	$nome_aluno = strtoupper($_POST['nome_aluno']);
	
	$sql_verifica_id = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma' ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql_verifica_id) <= 0){
		$n_chamada = 1;
	}else{
		while($res_chamada = mysqli_fetch_array($sql_verifica_id)){
			$n_chamada = $res_chamada['n_chamada']+1;
		}
	}  
	echo $n_chamada;
  ?>
  <br />
  <input type="hidden" name="n_chamada" value="<? echo $n_chamada; ?>" />

  <input class="input" type='text' name="nome_aluno" autofocus /><br />
 <strong> Telefone do aluno</strong>
  <span id="sprytextfield1">
  <input type="text" name="telefone" />
  <span class="textfieldInvalidFormatMsg"></span></span><br />
 <strong> Telefone 2 do aluno</strong><br />
 <span id="sprytextfield2">
 <input type="text" name="telefone2" />
<span class="textfieldInvalidFormatMsg"></span></span><br />
  <input style="width:20px;" name="transferido" type="checkbox" value="SIM" /> Transferido
  <input style="width:20px;" name="laudo" type="checkbox" value="SIM" /> Laudado<br />
  <input style="width:20px;" name="suprido" type="checkbox" value="SIM" /> Suprido
  <input style="width:20px;"name="impresso" type="checkbox" value="SIM" /> Impresso
<hr />
  
  <input style="width:60px;" name="enviar" type="submit" value="Enviar" />
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {useCharacterMasking:true, isRequired:false, pattern:"(00) 00000.0000"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true, isRequired:false});
</script>
</body>
</html>