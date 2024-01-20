<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<h1 style="font:12px Arial, Helvetica, sans-serif;"><strong>Link para compartilhar <a href="https://web.whatsapp.com/send?text=http://escolaleornebelem.com/?ik=<? echo $_GET['ik']; ?>" target="_blank"><img src="../img/whatsapp.png" width="30" height="30" /></a></strong><br /></h1>


<input type="text" id="texto" style="font:12px Arial, Helvetica, sans-serif;" value="http://escolaleornebelem.com/?ik=<? echo $_GET['ik']; ?>" readonly="readonly" />
<button id="botao">Copiar</button>

<script language="javascript">
document.getElementById("botao").addEventListener("click", function(){

document.getElementById("texto").select();

document.execCommand('copy');

});
</script>
</body>
</html>