<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<? require "../../conexao.php"; ?>
</head>

<body>
<? if(isset($_POST['excluir'])){
	
mysqli_query($conexao_bd, "DELETE FROM turmas WHERE id = '".$_GET['id']."'");
echo "<strong>Sucesso!</strong><br><br><em>Pressione F5.</em>";
die;
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<p class="h6">Se confirmar a exclusão, não será possível recuperar.</p>
<input type="submit" name="excluir" value="Confirmar" class="btn btn-primary" />
</form>
</body>
</html>