<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? require "../../conexao.php"; $id = $_GET['id'];

if(isset($_POST['atualizar'])){
	
$eixo = $_POST['eixo'];


$eixo_antigo = NULL;

if($id == NULL){
$sql_eixo = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE eixo = '$eixo' AND ano = '".$_GET['ano']."' AND componente = '".$_GET['componente']."'");
 if(mysqli_num_rows($sql_eixo) == ''){
	mysqli_query($conexao_bd, "INSERT INTO habilidades (status, eixo, ano, componente, conteudo, cod_habilidade, habilidade) VALUES ('Ativo', '$eixo', '".$_GET['ano']."', '".$_GET['componente']."', '', '', '')");
	 echo "<script language=''>window.alert('Cadastro realizado com sucesso! Pressione F5 para finalizar!');</script>";
 }else{
	 echo "<script language=''>window.alert('Já existe um cadastro com este mesmo titulo nesta turma!');</script>";
 }
}

if($id >= 1){
	
	$sql_select_eixo = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE id = '$id'");
	 while($res_eixo = mysqli_fetch_array($sql_select_eixo)){
		 $eixo_antigo = $res_eixo['eixo'];
	}
	
	mysqli_query($conexao_bd, "UPDATE habilidades SET eixo = '$eixo' WHERE id = '$id'");
	mysqli_query($conexao_bd, "UPDATE atividades SET habilidade = '$eixo' WHERE habilidade = '$eixo_antigo'");
	mysqli_query($conexao_bd, "UPDATE plano_de_aula SET eixo = '$eixo' WHERE eixo = '$eixo_antigo'");
	
	 echo "<script language=''>window.alert('Atualização realizada com sucesso! Pressione F5 para finalizar!');window.location='';</script>";


}

	
}?>

<h3 style="font:12px Arial, Helvetica, sans-serif; color:#666;"><strong>Cadastrar nova unidade temática/eixo</strong></h3>
<? $eixo = NULL;
	$sql_select_eixo = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE id = '$id'");
	 while($res_eixo = mysqli_fetch_array($sql_select_eixo)){
		$eixo = $res_eixo['eixo'];
	 }
?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" style="font:12px Arial, Helvetica, sans-serif; width:250px; color:#F00; padding:5px;" value="<? echo $eixo; ?>" name="eixo" /> <input type="submit" name="atualizar" style="font:12px Arial, Helvetica, sans-serif; color:#F00; padding:5px;"value="IR" />
</form>
</body>
</html>