<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

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
<? require "../../conexao.php"; ?>

<? if(isset($_POST['enviar'])){

$nome_livro = $_POST['nome_livro'];
$turma = $_POST['turma'];
$devolver = $_POST['devolver'];

$sql_livro = mysqli_query($conexao_bd, "SELECT * FROM controle_recursos WHERE nome_livro = '$nome_livro' AND turma = '$turma' AND ano = '$ano'");
if(mysqli_num_rows($sql_livro) >= 1){
	echo "<script language='javascript'>window.alert('Este livro já está cadastrado');</script>";
}else{
	$code_livro = rand()*date("d")+date("d");
	
	mysqli_query($conexao_bd, "INSERT INTO controle_recursos (operador, code_livro, nome_livro, turma, status, ano, devolver) VALUES ('$operador', '$code_livro', '$nome_livro', '$turma', 'Ativo', '$ano', '$devolver')");
	
	echo "
	<em>Recurso cadastrado com sucesso!<br><br>
	Pressione F5 para atualizar	
	</em>
	
	";
	
	die;
	
}
}?>

  <br />
<form name="" method="post" action="" enctype="multipart/form-data">
 <strong> Nome do recurso</strong>
  <input class="input" style="text-align:center;" type='text' name="nome_livro" autofocus /><br />
 <strong> Necessário devolução?</strong><br />
 <select name="devolver" size="1" id="devolver">
   <option value="SIM">SIM</option>
   <option value="NAO">NAO</option>
 </select><br />
 <strong> Turma</strong><br />
   <select class="form-control" name="turma">
      <option>Selecione a turma</option>
             <?
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
			 ?>
              <option value="<? echo $res_turmas['code_turma']; ?>"><? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; ?></option>
              <? } ?>
  </select>
 <hr />
  <input style="width:60px;" name="enviar" type="submit" value="Enviar" />
</form>

</body>
</html>