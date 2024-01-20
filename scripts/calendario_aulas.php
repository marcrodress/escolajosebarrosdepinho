<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<style type="text/css">
body,td,th {
	color: #000;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
}
body input{
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
	}
body select{
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
	}
</style>
</head>

<body>
<? require "../../conexao.php"; $turma = $_GET['turma']; ?>
<br />
<a style="border:2px solid #000; padding:10px; text-decoration:none; color:#FFF; background:#0C0; font:12px Arial, Helvetica, sans-serif;" href="../index.php?p=anos">Voltar</a>
<br /><br /><br />


<table width="679" border="1">
  <tr>
    <td width="96" bgcolor="#00CCCC"><strong>HOR&Aacute;RIO</strong></td>
    <td width="143" bgcolor="#00CCCC"><strong>SEGUNDA</strong></td>
    <td width="87" bgcolor="#00CCCC"><strong>TER&Ccedil;A</strong></td>
    <td width="115" bgcolor="#00CCCC"><strong>QUARTA</strong></td>
    <td width="77" bgcolor="#00CCCC"><strong>QUINTA</strong></td>
    <td width="121" bgcolor="#00CCCC"><strong>SEXTA</strong></td>
  </tr>
  <tr>
    <td bgcolor="#669933"><strong>1&deg; Hor&aacute;rio</strong></td>
    <td>
    <form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        
        <?
		$segunda_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '1' AND dia = 'SEGUNDA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$segunda_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
       <? }} ?>
        <option value=""></option>
      
      
      
      
      
      
       <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$segunda_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=<? echo $res['code']; ?>&horario=1&dia=SEGUNDA"><? echo $res['componente']; ?></option>
		<? } ?>      
      </select>
    </form>
    </td>
    <td>
	<form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        
        <?
		$terca_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '1' AND dia = 'TERÇA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$terca_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
       <? }} ?>
        <option value=""></option>
      
      
      
      
      
      
       <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$terca_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=<? echo $res['code']; ?>&horario=1&dia=TERÇA"><? echo $res['componente']; ?></option>
		<? } ?>      
      </select>
    </form>
    </td>
    <td>
	<form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        
        <?
		$quarta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '1' AND dia = 'QUARTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quarta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
       <? }} ?>
        <option value=""></option>
      
      
      
      
      
      
       <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quarta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=<? echo $res['code']; ?>&horario=1&dia=QUARTA"><? echo $res['componente']; ?></option>
		<? } ?>      
      </select>
    </form>    
    </td>
    <td>
	<form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        
        <?
		$quinta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '1' AND dia = 'QUINTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quinta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
       <? }} ?>
        <option value=""></option>
      
      
      
      
      
      
       <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quinta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=<? echo $res['code']; ?>&horario=1&dia=QUINTA"><? echo $res['componente']; ?></option>
		<? } ?>      
      </select>
    </form>    
    </td>
    <td>
	<form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        
        <?
		$sexta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '1' AND dia = 'SEXTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$sexta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
       <? }} ?>
        <option value=""></option>
      
      
      
      
      
      
       <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$sexta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=<? echo $res['code']; ?>&horario=1&dia=SEXTA"><? echo $res['componente']; ?></option>
		<? } ?>      
      </select>
    </form>    
    </td>
  </tr>
  <tr>
    <td bgcolor="#FF6633"><strong>2&deg; Hor&aacute;rio</strong></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$segunda_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '2' AND dia = 'SEGUNDA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$segunda_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$segunda_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=2&amp;dia=SEGUNDA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$terca_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '2' AND dia = 'TERÇA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$terca_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$terca_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=2&amp;dia=TER&Ccedil;A"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quarta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '2' AND dia = 'QUARTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quarta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quarta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=2&amp;dia=QUARTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quinta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '2' AND dia = 'QUINTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quinta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quinta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=2&amp;dia=QUINTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$sexta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '2' AND dia = 'SEXTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$sexta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$sexta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=2&amp;dia=SEXTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
  </tr>
  <tr>
    <td bgcolor="#666699"><strong>3&deg; Hor&aacute;rio</strong></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$segunda_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '3' AND dia = 'SEGUNDA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$segunda_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$segunda_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=3&amp;dia=SEGUNDA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$terca_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '3' AND dia = 'TERÇA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$terca_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$terca_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=3&amp;dia=TER&Ccedil;A"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quarta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '3' AND dia = 'QUARTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quarta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quarta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=3&amp;dia=QUARTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quinta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '3' AND dia = 'QUINTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quinta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quinta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=3&amp;dia=QUINTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$sexta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '3' AND dia = 'SEXTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$sexta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$sexta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=3&amp;dia=SEXTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
  </tr>
  <tr>
    <td bgcolor="#666600"><strong>4&deg; Hor&aacute;rio</strong></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$segunda_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '4' AND dia = 'SEGUNDA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$segunda_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$segunda_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=4&amp;dia=SEGUNDA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$terca_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '4' AND dia = 'TERÇA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$terca_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$terca_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=4&amp;dia=TER&Ccedil;A"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quarta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '4' AND dia = 'QUARTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quarta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quarta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=4&amp;dia=QUARTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quinta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '4' AND dia = 'QUINTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quinta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quinta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=4&amp;dia=QUINTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><form name="form" id="form">
      <select style="width:150px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$sexta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '4' AND dia = 'SEXTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$sexta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value=""></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$sexta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=4&amp;dia=SEXTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
  </tr>
</table>
</body>
</html>
<? if(@$_GET['dia'] != ''){ $turma = $_GET['turma']; $componente = $_GET['componente']; $horario = $_GET['horario']; $dia_s = $_GET['dia'];

$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '$horario' AND dia = '$dia_s'");
if(mysqli_num_rows($sql_calendario_semanal) == ''){
	mysqli_query($conexao_bd, "INSERT INTO calendario_semanal (turma, componente, horario, dia) VALUES ('$turma', '$componente', '$horario', '$dia_s')");
	echo "<script language='javascript'>window.location='?turma=$turma';</script>";
}else{
	mysqli_query($conexao_bd, "UPDATE calendario_semanal SET componente = '$componente' WHERE horario = '$horario' AND dia = '$dia_s' AND turma = '$turma'");
	echo "<script language='javascript'>window.location='?turma=$turma';</script>";

}
}?>
