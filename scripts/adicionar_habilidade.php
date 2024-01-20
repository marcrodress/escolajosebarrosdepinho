<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? require "../../conexao.php"; $id = $_GET['id'];

if(isset($_POST['atualizar'])){
	
$eixo = $_POST['eixo'];
$habilidade = $_POST['habilidade'];


$eixo_antigo = NULL;

if($id == NULL){
$sql_eixo = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE eixo = '$eixo' AND ano = '".$_GET['ano']."' AND componente = '".$_GET['componente']."'");
 if(mysqli_num_rows($sql_eixo) == ''){
	mysqli_query($conexao_bd, "INSERT INTO habilidades (status, eixo, conteudo, cod_habilidade, habilidade, ano, componente) VALUES ('Ativo', '', '', '$habilidade', '$eixo', '".$_GET['ano']."', '".$_GET['componente']."')");
	 echo "<script language=''>window.alert('Cadastro realizado com sucesso! Pressione F5 para finalizar!');</script>";
 }else{
	 echo "<script language=''>window.alert('Já existe um cadastro com este mesmo titulo nesta turma!');</script>";
 }
}

if($id >= 1){
	
	mysqli_query($conexao_bd, "UPDATE habilidades SET cod_habilidade = '$habilidade', habilidade = '$eixo' WHERE id = '$id'");
	
	 echo "<script language=''>window.alert('Atualização realizada com sucesso! Pressione F5 para finalizar!');window.location='';</script>";


}

	
}?>

<h3 style="font:12px Arial, Helvetica, sans-serif; color:#666;"><strong>Cadastrar/atualizar habilidade</strong></h3>
<? $eixo = NULL;
	$sql_select_eixo = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE id = '$id'");
	 while($res_eixo = mysqli_fetch_array($sql_select_eixo)){
		$cod_habilidades = $res_eixo['cod_habilidade'];
		$habilidades = $res_eixo['habilidade'];
	 }
?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" style="font:12px Arial, Helvetica, sans-serif; width:150px; color:#F00; padding:5px;" name="habilidade" placeholder="Habilidade exe:EF06CI01" value="<? echo $cod_habilidades; ?>" />
 
 <input type="text" placeholder="Classificar como homogênea ou heterogênea a mistura de dois ou mais materiais
(água e sal, água e óleo, água e areia etc.). " style="font:12px Arial, Helvetica, sans-serif; width:250px; color:#F00; padding:5px;" value="<? echo $habilidades; ?>" name="eixo" /> <input type="submit" name="atualizar" style="font:12px Arial, Helvetica, sans-serif; color:#F00; padding:5px;"value="IR" />
</form>
</body>
</html>