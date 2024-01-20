<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php";  $turma = $_GET['turma']; $operador = $_GET['operador']; ?>
<style>
body{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	}
body select{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	padding:5px;
	}
body .input{
	font:12px Arial, Helvetica, sans-serif;
	width:287px;
	padding:5px;
	}
body input{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	padding:5px;
	}
</style>
</head>
<body>

<? if(isset($_POST['enviar'])){

echo "<img src='../img/roler.gif' />";

$turma_nova = strtoupper($_POST['turma_nova']);

$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma'");
for($i=1; $i<=mysqli_num_rows($sql_alunos); $i++){

$sql_puxa_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma' AND n_chamada = '$i'");
	while($res_puxa_aluno = mysqli_fetch_array($sql_puxa_aluno)){
		if(mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma_nova' AND n_chamada = '$i' AND code_aluno = '".$res_puxa_aluno['code_aluno']."'")) == ''){
			$code_aluno = $res_puxa_aluno['code_aluno']+1;
		mysqli_query($conexao_bd, "INSERT INTO alunos (usuario, turma, code_aluno, n_chamada, nome_aluno) VALUES ('$operador', '$turma_nova', '$code_aluno', '$i', '".$res_puxa_aluno['nome_aluno']."')");
		}
		
		
	}
}




echo "<strong>Operação realizada com sucesso!</strong><br><em>Pressione F5.</em>";
die;
 }?>


<form action="" method="post">
  <strong>Selecione a turma para transferir alunos</strong><br />
  <select name="turma_nova" size="1">
   <?
    $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE usuario = '$operador' AND code_turma != '$turma'");
	  while($res_turma = mysqli_fetch_array($sql_turma)){
   ?>
    <option value="<? echo $res_turma['code_turma']; ?>">
	   <?
        $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM escolas WHERE code_escola = '".$res_turma['code_escola']."'");
          while($res_escola = mysqli_fetch_array($sql_escola)){
			  echo $res_escola['nome_escola'];
		  }
       ?>
     - 
	<? echo $res_turma['componente']; ?>
     - 
	<? echo $res_turma['code_serie']; ?>°
	<? echo $res_turma['tipo_turma']; ?>  
     - 
	<? echo $res_turma['turno']; ?>    
    </option>
    <? } ?>
  </select><br /><br />

  <input name="enviar" type="submit" value="Transferir alunos" />
</form>
</body>
</html>