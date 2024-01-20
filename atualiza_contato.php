<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "variaveis.php"; require "conexao.php"; $id = $_GET['ik']; $aluno = $_GET['aluno']; $turma = $_GET['turma']; $disciplina = $_GET['disciplina'];?>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-sm">
     <div class="text-center">  
      <img src="img/logo.fw.png" width="100" height="100" class="rounded" alt="...">     
      </div><!-- text-center -->
      <?
      $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '$aluno' LIMIT 1");
	  while($res_aluno = mysqli_fetch_array($sql_aluno)){
	 
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			$escola = $res_turma['code_escola'];
			$ano_aluno = $res_turma['code_serie'];
	
	  ?>      
     <p class="h6"><strong class="text-primary">Aluno:</strong> <? echo $res_aluno['nome_aluno']; ?></p>
      <p class="h6"><strong class="text-primary">Ano:</strong> <? echo $res_turma['code_serie']; ?>° ano <strong class="text-primary">Turma:</strong> <? echo $res_turma['tipo_turma']; ?> <strong class="text-primary">Turno:</strong> <? echo $res_turma['turno']; ?></p>
      <? }} ?>


<? if($_GET['acao'] == 'add'){ ?>  
       
<? if($_GET['acao'] == 'add' && $_GET['tipo'] == ''){ ?>  
       
 <? if(isset($_POST['enviar'])){

  $tipo = $_POST['tipo'];
  $titular = $_POST['titular'];
  
$turma = $_GET['turma'];
$ik = $_GET['ik'];
$aluno = $_GET['aluno'];
$disciplina = $_GET['disciplina'];  

	echo "<script language='javascript'>window.location='?aluno=$aluno&tipo=$tipo&titular=$titular&turma=$turma&ik=$ik&aluno=$aluno&disciplina=$disciplina&acao=add';</script>";
 
 }?>
<form action="" method="post" enctype="multipart/form-data" name="form">
  <select name="tipo" style="border:1px solid #000;padding:5px;">
    <option value="">Selecione o tipo de contato</option>
    <option value="email">E-mail</option>
    <option value="telefone">Telefone</option>
  </select>
  <select name="titular" style="border:1px solid #000; padding:5px;">
    <option value="">De quem é esse contato?</option>
    <option value="Pai">Pai</option>
    <option value="Mãe">Mãe</option>
    <option value="Aluno">Aluno</option>
    <option value="Outros">Outros</option>
  </select>
  <input name="enviar" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:100px;" value="Cadastrar"/>  
</form>
<? } ?>
<? } ?>







<? if($_GET['tipo'] == 'email' && $_GET['acao'] == 'add'){ ?> <hr />
	<? if(isset($_POST['enviar'])){
    
    $email = $_POST['email'];
    $obs = $_POST['obs'];
    $titular = $_GET['titular'];
    $aluno = $_GET['aluno'];

	$turma = $_GET['turma'];
	$ik = $_GET['ik'];
	$aluno = $_GET['aluno'];
	$disciplina = $_GET['disciplina'];  
      
      
    $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE contato = '$email' AND aluno = '$aluno'");
    if(mysqli_num_rows($sql_verifica) == ''){
        mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('$aluno', 'Email', '$titular', '$obs', '$email')");
		
		mysqli_query($conexao_bd, "INSERT INTO atualiada_dados (aluno) VALUES ('$aluno')");
		
        echo "<script language='javascript'>window.location='?aluno=$aluno&turma=$turma&ik=$id&aluno=$aluno&disciplina=$disciplina';</script>";
    }else{
        echo "<script language='javascript'>window.alert('Este e-mail já está cadastrado em sistema!');</script>";	
    }
    }?>
    
    <form action="" method="post" enctype="multipart/form-data" name="" target="_self">
      <input class="form-control form-control-lg" name="email" type="email" style="border:1px solid #000; padding:5px; text-align:center; border-radius:3px; " placeholder="Digite o e-mail"/>
      <br />
     <div class="text-center"> 
     <input name="enviar"  class="btn btn-info" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:100px;" value="Cadastrar"/>
     </div><!-- text-center -->
    </form>
 <? } ?>

       
 
 
<? if($_GET['tipo'] == 'telefone' && $_GET['acao'] == 'add'){ ?>

<? if(isset($_POST['enviar'])){

$telefone = $_POST['telefone'];
$obs = $_POST['obs'];
$titular = $_GET['titular'];
$aluno = $_GET['aluno'];


	$turma = $_GET['turma'];
	$ik = $_GET['ik'];
	$aluno = $_GET['aluno'];
	$disciplina = $_GET['disciplina'];  

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE contato = '$telefone' AND aluno = '$aluno'");
if(mysqli_num_rows($sql_verifica) == ''){
	mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('$aluno', 'Telefone', '$titular', '$obs', '$telefone')");
			mysqli_query($conexao_bd, "INSERT INTO atualiada_dados (aluno) VALUES ('$aluno')");

	echo "<script language='javascript'>window.location='?aluno=$aluno&turma=$turma&ik=$id&aluno=$aluno&disciplina=$disciplina';</script>";
}else{
	echo "<script language='javascript'>window.alert('Este telefone já está cadastrado em sistema!');</script>";	
}
}?>
<form action="" method="post" enctype="multipart/form-data" name="" target="_self">
  <input name="telefone" type="text" class="form-control form-control-lg" placeholder="Exemplo: (85) 98422.8226" style="border:1px solid #000; padding:5px; text-align:center; border-radius:3px;"/>
  <br />
     <div class="text-center"> 
     <input name="enviar"  class="btn btn-info" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:100px;" value="Cadastrar"/>
     </div><!-- text-center -->
  
</form>
      
       
       
       
	  <? } // add ?>






      <? if($_GET['acao'] != 'add'){ ?>  
      
     <div class="text-center"> 
       <a href="?turma=<? echo $turma; ?>&ik=<? echo $id; ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $disciplina; ?>&acao=add" class="btn btn-success">Adicionar contato</a> 
     <hr />
      </div><!-- text-center -->   
      
      
      <?
	   $sql_contatos = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE aluno = '$aluno'");
	   if(mysqli_num_rows($sql_contatos) == ''){
		   echo "<div class='alert alert-danger' role='alert'>Você não possui contato cadastrado, pedimos que atualize seus dados!</div>";
	   }else{      
	  ?>
      <table class="table table-bordered">
      <thead class="thead-light">
      <tr>
        <th colspan="4" align="center">CONTATOS</th>
      </tr>
      </thead>
      <tr>
        <td><strong>Tipo</strong></td>
        <td><strong>Titular</strong></td>
        <td><strong>Contato</strong></td>
        <td>&nbsp;</td>
      </tr>
      <? while($res_contato = mysqli_fetch_array($sql_contatos)){ ?>
      <tr>
        <td><? echo $res_contato['tipo']; ?></td>
        <td><? echo $res_contato['autor']; ?></td>
        <td><? echo $res_contato['contato']; ?></td>
        <td><a href="?turma=<? echo $turma; ?>&ik=<? echo $id; ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $disciplina; ?>&acao=excluir&id=<? echo $res_contato['id']; ?>"><img src="img/deleta.png" width="15" height="15" border="0" title="Excluir contato" /></a></td>
      </tr>
      <? } ?>
    </table>
    <? } ?>
    <hr />
       
      <?  if(mysqli_num_rows($sql_contatos) != ''){
		  
		mysqli_query($conexao_bd, "INSERT INTO atualiada_dados (aluno) VALUES ('$aluno')");
		  
	  ?>
      <div class="text-center">
       <a href="index.php?p=2&turma=<? echo $turma; ?>&ik=<? echo $id; ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $disciplina; ?>" class="btn btn-primary">Acessar atividade</a> 
      </div><!-- text-center -->   
      <? } ?>
    
    
    
    <? }// add ?>
    
    </div><!-- col-sm -->
  </div><!--   row -->     
</div><!-- container -->
</body>
</html>

<? if($_GET['acao'] == 'excluir'){

$id = $_GET['id'];
$turma = $_GET['turma'];
$ik = $_GET['ik'];
$aluno = $_GET['aluno'];
$disciplina = $_GET['disciplina'];

mysqli_query($conexao_bd, "DELETE FROM contato_alunos WHERE id = '$id'");

echo "<script language='javascript'>window.location='?turma=$turma&ik=$ik&aluno=$aluno&disciplina=$disciplina';</script>";



}?>