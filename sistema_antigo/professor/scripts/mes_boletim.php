<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
</head>

<body>
<? if(@$_GET['p'] == ''){ ?>
<? if(isset($_POST['enviar'])){
	
	$componente = $_POST['componente'];
	$aluno = $_GET['aluno'];
	$turma = $_GET['turma'];
	$operador = $_GET['operador'];
	
	echo "<script language='javascript'>window.location='?p=1&aluno=$aluno&turma=$turma&componente=$componente&operador=$operador';</script>";

}?>
<form action="" method="post" enctype="multipart/form-data" name="">
<em><strong style="font:12px Arial, Helvetica, sans-serif;"><strong>Selecione o componente</strong></strong></em><br>
<select style="font:12px Arial, Helvetica, sans-serif; padding:5px;" name="componente" size="1">
<?
$sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas");
while($res = mysqli_fetch_array($sql_disciplinas)){
?>
  <option value="<? echo $res['code']; ?>"><? echo $res['componente']; ?></option>
<? } ?>
</select>
<input style="font:12px Arial, Helvetica, sans-serif; padding:5px;" type="submit" name="enviar" value="Emitir" />
</form>
<? } ?>

<? if(@$_GET['p'] == '1'){ ?>
<form action="boletim_mensal.php?aluno=<? echo $_GET['aluno']; ?>&componente=<? echo $_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>&operador=<? echo $_GET['operador']; ?>" method="post" enctype="multipart/form-data" name="" target="_blank">
<em><strong style="font:12px Arial, Helvetica, sans-serif;"><strong>Selecione o m�s</strong></strong></em><br>
<select style="font:12px Arial, Helvetica, sans-serif; padding:5px;" name="mes" size="1">
  <option value="01">JANEIRO</option>
  <option value="02">FEVEREIRO</option>
  <option value="03">MAR&Ccedil;O</option>
  <option value="04">ABRIL</option>
  <option value="05">MAIO</option>
  <option value="06">JUNHO</option>
  <option value="07">JULHO</option>
  <option value="08">AGOSTO</option>
  <option value="09">SETEMBRO</option>
  <option value="10">OUTRUBRO</option>
  <option value="11">NOVEMBRO</option>
  <option value="12">DEZEMBRO</option>
</select>
<input style="font:12px Arial, Helvetica, sans-serif; padding:5px;" type="submit" name="" value="Emitir" />
</form>
<? } ?>
</body>
</html>