<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "variaveis.php"; require "conexao.php"; $id = $_GET['ik']; $aluno = $_GET['aluno']; $turma = $_GET['turma']; $disciplina = $_GET['disciplina'];

session_start();
$origem = $_SESSION['origem'];
?>
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

  $dose = $_POST['dose'];
  $vacina = $_POST['vacina'];
  
$turma = $_GET['turma'];
$ik = $_GET['ik'];
$aluno = $_GET['aluno'];
$disciplina = $_GET['disciplina'];  

	echo "<script language='javascript'>window.location='?aluno=$aluno&tipo=vacina&dose=$dose&vacina=$vacina&turma=$turma&ik=$ik&aluno=$aluno&disciplina=$disciplina&acao=add&origem=$origem';</script>";
 
 }?>
<form action="" method="post" enctype="multipart/form-data" name="form">
  <select name="dose" size="1" style="border:1px solid #000;padding:5px;">
    <option value="1">1&deg; Dose</option>
    <option value="2">2&deg; Dose</option>
    <option value="3">3&deg; Dose</option>
    <option value="UNICA">Dose &uacute;nica</option>
  </select>
  <select name="vacina" size="1" style="border:1px solid #000; padding:5px;">
    <option value="">Nome da vacina/fabricante</option>
    <option value="Astrazenica">Astrazenica/Fio Cruz</option>
    <option value="Pfizer">Pfizer</option>
    <option value="Coronavac">Coronavac/Butantan</option>
    <option value="Johnson">Johnson</option>
  </select>
  <input name="enviar" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:100px;" value="Cadastrar"/>  
</form>
<? } ?>
<? } ?>







<? if($_GET['tipo'] == 'vacina' && $_GET['acao'] == 'add'){ ?> <hr />
	<? if(isset($_POST['enviar'])){
    
    $dose = $_GET['dose'];
    $data_dose = $_POST['data'];
    $vacina = $_GET['vacina'];
    $aluno = $_GET['aluno'];

	$turma = $_GET['turma'];
	$ik = $_GET['ik'];
	$aluno = $_GET['aluno'];
	$disciplina = $_GET['disciplina'];
	
	$fabricante = 0;
	
	if($vacina == 'Astrazenica'){
		$fabricante = "Fio Cruz";
	}elseif($vacina == 'Pfizer'){
		$fabricante = "Pfizer";
	}elseif($vacina == 'Coronavac'){
		$fabricante = "Butantan";		
	}else{
		$fabricante = "Johnson & Johnson";
	}
      
	  
	  $data_dose = str_replace("-", "/", $data_dose);
	  
	  $dia_dose1 = $data_dose[8];
	  $dia_dose2 = $data_dose[9];
	  
	  $mes_dose1 = $data_dose[5];
	  $mes_dose2 = $data_dose[6];
	  
	  $ano_dose1 = $data_dose[0];
	  $ano_dose2 = $data_dose[1];
	  $ano_dose3 = $data_dose[2];
	  $ano_dose4 = $data_dose[3];
	  
	  $data_dose = "$dia_dose1$dia_dose2/$mes_dose1$mes_dose2/$ano_dose1$ano_dose2$ano_dose3$ano_dose4";
      
    $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE n_dose = '$dose' AND aluno = '$aluno'");
    if(mysqli_num_rows($sql_verifica) == ''){
        mysqli_query($conexao_bd, "INSERT INTO vacinacao_alunos (aluno, tipo_vacina, nome_vacina, fabricante, data_aplicacao, lote, cod, nome_aplicador, local_aplicacao, regional_prof, n_dose, comprovante) VALUES ('$aluno', 'COVID-19', '$vacina', '$fabricante', '$data_dose', '', '', '', '', '', '$dose', '')");
		
		mysqli_query($conexao_bd, "INSERT INTO atualiza_vacina (aluno) VALUES ('$aluno')");
		
        echo "<script language='javascript'>window.location='?aluno=$aluno&turma=$turma&ik=$id&aluno=$aluno&disciplina=$disciplina&origem=$origem';</script>";
    }else{
        echo "<script language='javascript'>window.alert('A primeira dose já foi cadastrada em sistema!');</script>";	
    }
    }?>
    
    <form action="" method="post" enctype="multipart/form-data" name="" target="_self">
      <input type="date" class="form-control form-control-lg" name="data" style="border:1px solid #000; padding:5px; text-align:center; border-radius:3px; " placeholder="Digite a data que tomou a vacina: Exemplo: 05/02/2022"/>
     <div class="text-center">
     <input name="enviar"  class="btn btn-info" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:100px;" value="Cadastrar"/>
     </div><!-- text-center -->
    </form>
 <? } ?>




      <? if($_GET['acao'] != 'add'){ ?>  
      
     <div class="text-center"> 
       <a href="?turma=<? echo $turma; ?>&ik=<? echo $id; ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $disciplina; ?>&acao=add&origem=<? echo $origem; ?>" class="btn btn-success">Adicionar vacina</a> 
     <hr />
      </div><!-- text-center -->   
      
      
      <?
	   $sql_contatos = mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE aluno = '$aluno'");
	   if(mysqli_num_rows($sql_contatos) == ''){
		   echo "<div class='alert alert-danger' role='alert'>Você não possui vacinas cadastrada, pedimos que nos informe a vacinas tomadas!</div>";
	   }else{      
	  ?>
      <table class="table table-bordered">
      <thead class="thead-light">
      <tr>
        <th colspan="5" align="center">CONTATOS</th>
      </tr>
      </thead>
      <tr>
        <td><strong>Dose</strong></td>
        <td><strong>Data</strong></td>
        <td><strong>Fabricante</strong></td>
        <td><strong>Vacina</strong></td>
        <td>&nbsp;</td>
      </tr>
      <? while($res_contato = mysqli_fetch_array($sql_contatos)){ ?>
      <tr>
        <td><? echo $res_contato['n_dose']; ?>°</td>
        <td><? echo $res_contato['data_aplicacao']; ?></td>
        <td><? echo $res_contato['fabricante']; ?></td>
        <td><? echo $res_contato['nome_vacina']; ?></td>
        <td><a href="?turma=<? echo $turma; ?>&ik=<? echo $id; ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $disciplina; ?>&acao=excluir&id=<? echo $res_contato['id']; ?>&origem=<? echo $origem; ?>"><img src="img/deleta.png" width="15" height="15" border="0" title="Excluir contato" /></a></td>
      </tr>
      <? } ?>
    </table>
    <? } ?>
    <hr />
       
      <?  if(mysqli_num_rows($sql_contatos) != ''){
		  
		mysqli_query($conexao_bd, "INSERT INTO atualiza_vacina (aluno) VALUES ('$aluno')");
		  
	  ?>
      <div class="text-center">
       
       <? if($origem == ''){?>
       <a href="index.php?p=2&turma=<? echo $turma; ?>&ik=<? echo $id; ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $disciplina; ?>&origem=<? echo $origem; ?>" class="btn btn-primary">Acessar atividade</a> 
	   <? }else{ ?>
       <a href="app/inicio.php?aluno=<? echo $aluno; ?>" class="btn btn-primary">Acessar atividade</a> 
       <? } ?>
      
      </div><!-- text-center -->      
      <? } ?>

      <?  if(mysqli_num_rows($sql_contatos) == ''){
		  
		mysqli_query($conexao_bd, "INSERT INTO atualiza_vacina (aluno) VALUES ('$aluno')");
		  
	  ?>
      <div class="text-center">
      <? if($origem == ''){?>
       <a href="index.php?p=2&informacao=vacina&turma=<? echo $turma; ?>&ik=<? echo $id; ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $disciplina; ?>&origem=<? echo $origem; ?>" class="btn btn-primary">Ainda não tomei nenhuma dose</a>
       <? }else{ ?>
       <a href="app/inicio.php?aluno=<? echo $aluno; ?>" class="btn btn-primary">Acessar atividade</a> 
       <? } ?>
      </div><!-- text-center -->      
      <? } ?>    
    
    
    <? }// add ?>
    
    </div><!-- col-sm -->
  </div><!--   row -->     
</div><!-- container -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
</script>
</body>
</html>

<? if($_GET['acao'] == 'excluir'){

$id = $_GET['id'];
$turma = $_GET['turma'];
$ik = $_GET['ik'];
$aluno = $_GET['aluno'];
$disciplina = $_GET['disciplina'];

mysqli_query($conexao_bd, "DELETE FROM vacinacao_alunos WHERE id = '$id'");

echo "<script language='javascript'>window.location='?turma=$turma&ik=$ik&aluno=$aluno&disciplina=$disciplina&origem=$origem';</script>";



}?>