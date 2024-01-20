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
    <td bgcolor="#669933"><strong>1&deg; Aula</strong></td>
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
      
      
      
      
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=&horario=1&dia=SEGUNDA"></option>      
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
      
      
      
      
      
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=&horario=1&dia=TERÇA"></option>
      
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
      
      
      
      
      
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=&horario=1&dia=QUARTA"></option>
      
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
      
      
      
      
      
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=&horario=1&dia=QUINTA"></option>
      
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
      
      
        <option value="?turma=<? echo $_GET['turma']; ?>&componente=&horario=1&dia=SEXTA"></option>
      
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
    <td bgcolor="#FF6633"><strong>2&deg; Aula</strong></td>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=2&amp;dia=SEGUNDA"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=2&amp;dia=TER&Ccedil;A"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=2&amp;dia=QUARTA"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=2&amp;dia=QUINTA"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=2&amp;dia=SEXTA"></option>
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
    <td bgcolor="#666699"><strong>3&deg; Aula</strong></td>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=3&amp;dia=SEGUNDA"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=3&amp;dia=TER&Ccedil;A"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=3&amp;dia=QUARTA"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=3&amp;dia=QUINTA"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=3&amp;dia=SEXTA"></option>
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
    <td bgcolor="#ADADAD"><strong>4&deg; Aula</strong></td>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=4&amp;dia=SEGUNDA"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=4&amp;dia=TER&Ccedil;A"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=4&amp;dia=QUARTA"></option>
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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=4&amp;dia=QUINTA"></option>

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
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=4&amp;dia=SEXTA"></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$sexta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=4&amp;dia=SEXTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFCC66">5&deg; Aula</td>
    <td><select style="width:150px;" name="jumpMenu2" size="1" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$segunda_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '5' AND dia = 'SEGUNDA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$segunda_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=5&amp;dia=SEGUNDA">
	  </option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$segunda_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=5&amp;dia=SEGUNDA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><select style="width:150px;" name="jumpMenu6" size="1" id="jumpMenu6" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$terca_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '5' AND dia = 'TERÇA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$terca_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=5&amp;dia=TERÇA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$terca_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=5&amp;dia=TERÇA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><form name="form" id="form2">
      <select style="width:150px;" name="jumpMenu10" size="1" id="jumpMenu10" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quarta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '5' AND dia = 'QUARTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quarta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=5&amp;dia=QUARTA"></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quarta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=5&amp;dia=QUARTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><select style="width:150px;" name="jumpMenu14" size="1" id="jumpMenu14" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$quinta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '5' AND dia = 'QUINTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quinta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=5&amp;dia=QUINTA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quinta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=5&amp;dia=QUINTA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><select style="width:150px;" name="jumpMenu18" size="1" id="jumpMenu18" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$sexta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '5' AND dia = 'SEXTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$sexta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=5&amp;dia=SEXTA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$sexta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=5&amp;dia=SEXTA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td bgcolor="#66CCCC">6&deg; Aula</td>
    <td><select style="width:150px;" name="jumpMenu3" size="1" id="jumpMenu3" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$segunda_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '6' AND dia = 'SEGUNDA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$segunda_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=6&amp;dia=SEGUNDA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$segunda_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=6&amp;dia=SEGUNDA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><select style="width:150px;" name="jumpMenu7" size="1" id="jumpMenu7" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$terca_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '6' AND dia = 'TERÇA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$terca_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=6&amp;dia=TERÇA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$terca_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=6&amp;dia=TERÇA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><form name="form" id="form3">
      <select style="width:150px;" name="jumpMenu11" size="1" id="jumpMenu11" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quarta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '6' AND dia = 'QUARTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quarta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=6&amp;dia=QUARTA"></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quarta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=6&amp;dia=QUARTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><select style="width:150px;" name="jumpMenu15" size="1" id="jumpMenu15" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$quinta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '6' AND dia = 'QUINTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quinta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=6&amp;dia=QUINTA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quinta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=6&amp;dia=QUINTA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><select style="width:150px;" name="jumpMenu19" size="1" id="jumpMenu19" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$sexta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '6' AND dia = 'SEXTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$sexta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=6&amp;dia=SEXTA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$sexta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=6&amp;dia=SEXTA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td bgcolor="#CC9999">7&deg; Aula</td>
    <td><select style="width:150px;" name="jumpMenu4" size="1" id="jumpMenu4" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$segunda_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '7' AND dia = 'SEGUNDA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$segunda_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=7&amp;dia=SEGUNDA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$segunda_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=7&amp;dia=SEGUNDA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><select style="width:150px;" name="jumpMenu8" size="1" id="jumpMenu8" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$terca_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '7' AND dia = 'TERÇA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$terca_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=7&amp;dia=TERÇA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$terca_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=7&amp;dia=TERÇA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><form name="form" id="form4">
      <select style="width:150px;" name="jumpMenu12" size="1" id="jumpMenu12" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quarta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '7' AND dia = 'QUARTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quarta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=7&amp;dia=QUARTA"></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quarta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=7&amp;dia=QUARTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><select style="width:150px;" name="jumpMenu16" size="1" id="jumpMenu16" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$quinta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '7' AND dia = 'QUINTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quinta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=7&amp;dia=QUINTA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quinta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=7&amp;dia=QUINTA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><select style="width:150px;" name="jumpMenu20" size="1" id="jumpMenu20" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$sexta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '7' AND dia = 'SEXTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$sexta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=7&amp;dia=SEXTA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$sexta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=7&amp;dia=SEXTA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
  </tr>
  <tr>
    <td bgcolor="#00FF00">8&deg; Aula</td>
    <td><select style="width:150px;" name="jumpMenu5" size="1" id="jumpMenu5" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$segunda_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '8' AND dia = 'SEGUNDA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$segunda_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=8&amp;dia=SEGUNDA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$segunda_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=8&amp;dia=SEGUNDA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><select style="width:150px;" name="jumpMenu9" size="1" id="jumpMenu9" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$terca_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '8' AND dia = 'TERÇA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$terca_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=8&amp;dia=TERÇA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$terca_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=8&amp;dia=TERÇA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><form name="form" id="form5">
      <select style="width:150px;" name="jumpMenu13" size="1" id="jumpMenu13" onchange="MM_jumpMenu('parent',this,0)">
        <?
		$quarta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '8' AND dia = 'QUARTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quarta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
        <option value=""><? echo $res['componente']; ?></option>
        <? }} ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=8&amp;dia=QUARTA"></option>
        <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quarta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
        <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=8&amp;dia=QUARTA"><? echo $res['componente']; ?></option>
        <? } ?>
      </select>
    </form></td>
    <td><select style="width:150px;" name="jumpMenu17" size="1" id="jumpMenu17" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$quinta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '8' AND dia = 'QUINTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$quinta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=8&amp;dia=QUINTA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$quinta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=8&amp;dia=QUINTA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
    <td><select style="width:150px;" name="jumpMenu21" size="1" id="jumpMenu21" onchange="MM_jumpMenu('parent',this,0)">
      <?
		$sexta_1 = 0;
		$sql_calendario_semanal = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '$turma' AND horario = '8' AND dia = 'SEXTA'");
		 while($res_calendario = mysqli_fetch_array($sql_calendario_semanal)){
			$sexta_1 =$res_calendario['componente'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res = mysqli_fetch_array($sql)){
		?>
      <option value=""><? echo $res['componente']; ?></option>
      <? }} ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=&amp;horario=8&amp;dia=SEXTA"></option>
      <?
		$sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code != '$sexta_1'");
		 while($res = mysqli_fetch_array($sql)){
	   ?>
      <option value="?turma=<? echo $_GET['turma']; ?>&amp;componente=<? echo $res['code']; ?>&amp;horario=8&amp;dia=SEXTA"><? echo $res['componente']; ?></option>
      <? } ?>
    </select></td>
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
