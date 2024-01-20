<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	color: #000;
	font:12PX Arial, Helvetica, sans-serif;
	text-align:center;
}
body select{
	color: #000;
	font:12PX Arial, Helvetica, sans-serif;
	text-align:center;
	padding:10px;
}
body input{
	color: #000;
	font:12PX Arial, Helvetica, sans-serif;
	text-align:center;
	padding:10px;
}
</style>
</head>

<body>
<table width="451" border="0">
  <tr>
    <td colspan="6" bgcolor="#CCCCCC"><strong>SELECIONE O PER&Iacute;ODO</strong></td>
  </tr>
  <tr>
    <td width="42">
      <select name="select3" size="1" id="select3">
       <? for($i=1; $i<=31; $i++){ ?>
        <option value="<? echo $i; ?>"><? echo $i; ?></option>
       <? } ?>
      </select>
    </td>
    <td width="63">
      <select name="select" size="1" id="select">
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
      </select></td>
    <td width="64">a </td>
    <td width="48">
      <select name="select3" size="1" id="select3">
       <? for($i=1; $i<=31; $i++){ ?>
        <option value="<? echo $i; ?>"><? echo $i; ?></option>
       <? } ?>
      </select>    
    </td>
    <td width="106">
      <select name="select" size="1" id="select">
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
    </td>
    <td width="104"><input type="submit" name="button" id="button" value="Confirmar" /></td>
  </tr>
</table>
</body>
</html>