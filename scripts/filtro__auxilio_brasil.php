<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	color: #000;
}
body input{
	width:35px;
	padding:5px;
	border:1px solid #000;
	border-radius:3px;
	text-align:center;
}
body select{
	padding:5px;
	border:1px solid #000;
	border-radius:3px;
	text-align:center;
}
</style>
<? require "../../conexao.php"; ?>
</head>

<body>
<? if(@$_GET['p'] == 'turma'){ ?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<form name="form" id="form">
  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value=""></option>
    <?
	 $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas");
	 while($res_turma = mysqli_fetch_array($sql_turmas)){
	?>
    <option value="../?p=infrequencia_relatorio_semanal&inicio=<? echo $_GET['inicio']; ?>&final=<? echo $_GET['final']; ?>&turma=<? echo $res_turma['code_turma']; ?>"><? echo $res_turma['fase']; ?>: <? echo $res_turma['code_serie']; ?>°: <? echo $res_turma['tipo_turma']; ?> - <? echo $res_turma['turno']; ?> - Sala: <? echo $res_turma['sala']; ?></option>
    <? } ?>
  </select>
</form>
<? } ?>





<? if(@$_GET['p'] == ''){ ?>

<? if(isset($_POST['button'])){
	
	$data_inicio = $_POST['data_inicio'];
	$mes_inicio = $_POST['mes_inicio'];
	$dia_final = $_POST['dia_final'];
	$mes_final = $_POST['mes_final'];
	
	$ano = date("Y");
	
	$inicio = "$data_inicio/$mes_inicio/$ano";
	$final = "$dia_final/$mes_final/$ano";
	
	$code_inicio = 0;
	$code_final = 0;
	
	$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$inicio'");
	while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
		$code_inicio = $res_code_vencimento['codigo'];
	}	
	
	$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$final'");
	while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
		$code_final = $res_code_vencimento['codigo'];
	}		
		
	echo "<script language='javascript'>window.location='?inicio=$code_inicio&final=$code_final&turma=&p=turma';</script>";

}?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label for="data_inicio"></label>
  <input name="data_inicio" type="text" id="data_inicio" size="5" /> 
  /
  <input name="mes_inicio" type="text" id="mes_inicio" value="<? echo date("m"); ?>" size="5" />
/
<input name="textfield3" type="text" disabled="disabled" id="textfield3" value="<? echo date("Y"); ?>" size="5" />
&agrave; 
<input name="dia_final" type="text" id="dia_final" size="5" />
/
<input name="mes_final" type="text" id="textfield5" value="<? echo date("m"); ?>" size="5" />
/
<input name="textfield4" type="text" disabled="disabled" id="textfield3" value="<? echo date("Y"); ?>" size="5" /> 
<input type="submit" style="width:60px;" name="button" id="button" value="Enviar" />
</form>
<? } ?>
</body>
</html>