<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
<style>
body{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	}
body select{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	padding:5px;
	}
body input{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	padding:5px;
	}
</style>
</head>
<body> <? $operador = $_GET['operador']; ?>


<? if(isset($_POST['enviar'])){

$serie = strtoupper($_POST['serie']);
$tipo_turma = strtoupper($_POST['tipo_turma']);
$turno = strtoupper($_POST['turno']);

$code_turma = rand()+date("s")*date("s");

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_escola = '$operador' AND code_serie = '$serie' AND tipo_turma = '$tipo_turma'");
if(mysqli_num_rows($sql_verifica) >= 1){
	echo "<script language='javascript'>window.alert('Turma já cadastrada!');</script>";
}else{

mysqli_query($conexao_bd, "INSERT INTO turmas (code_escola, code_serie, code_turma, tipo_turma, turno) VALUES ('$operador', '$serie', '$code_turma', '$tipo_turma', '$turno')");

echo "<strong>Operação realizada com sucesso!</strong><br><em>Pressione F5.</em>";
die;
 }
}?>


<form action="" method="post">
  <strong>Ano</strong><br />
  <select name="serie" size="1">
    <option value="9">9° ano</option>
    <option value="8">8° ano</option>
    <option value="7">7° ano</option>
    <option value="6">6° ano</option>
    <option value="5">5° ano</option>
    <option value="4">4° ano</option>
    <option value="3">3° ano</option>
    <option value="2">2° ano</option>
    <option value="1">1° ano</option>
  </select><br />
  <strong>tipo de turma</strong><br />
  <select name="tipo_turma" size="1">
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
    <option value="D">D</option>
    <option value="E">E</option>
    <option value="F">F</option>
    <option value="G">G</option>
    <option value="H">H</option>
    <option value="I">I</option>
    <option value="J">J</option>
    <option value="K">K</option>
    <option value="L">L</option>
  </select><br />
  <strong>Turno</strong><br />
  <select name="turno" size="1">
    <option value="MANHÃ">MANHÃ</option>
    <option value="TARDE">TARDE</option>
    <option value="NOITE">NOITE</option>
  </select>
 <br /><br />
  <input name="enviar" type="submit" value="Enviar" />
</form>
</body>
</html>