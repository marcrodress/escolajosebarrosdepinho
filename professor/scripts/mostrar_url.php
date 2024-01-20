<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
<style>
body{
	font:12px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<strong>Data de acesso: </strong>
<? echo $_GET['data_hora']; ?><br /><br /><strong> URL:</strong> 
<? $url_acessada = base64_decode($_GET['url']); echo "$url_acessada"; ?>
</body>
</html>