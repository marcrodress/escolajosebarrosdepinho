<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>

<style>
body{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	text-align:center;
	}
body input{
	font:12px Arial, Helvetica, sans-serif;
	width:250px;
	padding:5px;
	}
body select{
	font:12px Arial, Helvetica, sans-serif;
	width:250px;
	padding:7px;
	}
</style>

</head>
<body> <? $operador = $_GET['operador']; ?>

<? if(isset($_POST['enviar'])){

$nome_livro = $_POST['nome_livro'];
$turma = $_POST['turma'];

$sql_livro = mysqli_query($conexao_bd, "SELECT * FROM controle_livros_extra WHERE nome_livro = '$nome_livro' AND turma = '$turma' AND ano = '$ano'");
if(mysqli_num_rows($sql_livro) >= 1){
	echo "<script language='javascript'>window.alert('Este livro j� est� cadastrado');</script>";
}else{
	$code_livro = rand()*date("d")+date("d");
	
	mysqli_query($conexao_bd, "INSERT INTO controle_livros_extra (operador, code_livro, nome_livro, turma, status, ano) VALUES ('$operador', '$code_livro', '$nome_livro', '$turma', 'Ativo', '$ano')");
	
	echo "
	<em>Livro cadastrado com sucesso!<br><br>
	Pressione F5 para atualizar	
	</em>
	
	";
	
	die;
	
}
}?>

  <br />
<form name="" method="post" action="" enctype="multipart/form-data">
 <strong> Nome do livro/cole��o</strong>
  <input class="input" style="text-align:center;" type='text' name="nome_livro" autofocus /><br />
 <strong> Turma</strong><br />
   <select class="form-control" name="turma">
      <option>Selecione a turma</option>
             <?
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
			 ?>
              <option value="<? echo $res_turmas['code_turma']; ?>"><? echo $res_turmas['code_serie']; ?>� ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; ?></option>
              <? } ?>
            </select>
 <hr />
  <input style="width:60px;" name="enviar" type="submit" value="Enviar" />
</form>

</body>
</html>