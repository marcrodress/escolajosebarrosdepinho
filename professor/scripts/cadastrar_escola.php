<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
</head>
<body>
<? $escola = $_GET['escola']; $operador = $_GET['operador']; ?>
<? if($escola == ''){
 
 $code_escola = rand()*date("d");	
 mysqli_query($conexao_bd, "INSERT INTO escolas (usuario, code_escola, nome_escola) VALUES ('$operador', '$code_escola', '')");
 echo "<script language='javascript'>window.location='?escola=$code_escola';</script>";

}?>
<? if($escola >= 1){ 
$sql = mysqli_query($conexao_bd, "SELECT * FROM escolas WHERE code_escola = '$escola'");
 while($res = mysqli_fetch_array($sql)){
?>
<? if(isset($_POST['enviar'])){

$nome = strtoupper($_POST['nome']);

mysqli_query($conexao_bd, "UPDATE escolas SET nome_escola = '$nome' WHERE code_escola = '$escola'");

echo "<strong>Operação realizada com sucesso!</strong><br><em>Pressione F5.</em>";
die;
}?>
<form action="" method="post">
  <input name="nome" value="<? echo $res['nome_escola']; ?>" type="text" />
  <input name="enviar" type="submit" value="Enviar" />
</form>
<? }}?>
</body>
</html>