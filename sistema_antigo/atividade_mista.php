<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width, initial-scale=1.0" />
<link href="css.css" rel="stylesheet" type="text/css" />
<? require "variaveis.php"; require "conexao.php"; $id = base64_decode($_GET['ik']); 

if($id == ''){
	echo "<script language='javascript'>window.location='http://www.ikuly.com/ATIVIDADES/professor/';</script>";
}

$code_atividade = 0;
$professor = 0;
$code_professor = 0;
$login_professor = 0;
$code_componente = 0;
$turma_atividade = 0;
$sql = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id'");
while($res = mysqli_fetch_array($sql)){
	$usuario = $res['usuario'];
	$code_professor = $res['usuario'];
	$code_componente = $res['componente'];
	$turma_atividade = $res['turma'];
	$code_atividade = $res['code_atividade'];
	
 $sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res['usuario']."'");
 while($res_prof = mysqli_fetch_array($sql_professor)){
	 $professor = $res_prof['nome_escola'];
	 $login_professor = $res_prof['login'];
 }
 
 	
}

?>
<style type="text/css">
div{
	 font:15px Arial, Helvetica, sans-serif;
	 text-align:justify;
	 }
</style>
</head>

<body>
<div class="container">
<? if($_GET['p'] == ''){ ?>
  <div class="row">
    <div class="col-sm">
     <div class="text-center">  
      <?
      $sql = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id'");
	while($res = mysqli_fetch_array($sql)){
?>
  <div class="row">
    <div class="col-sm">
      <p class="p-3 mb-2 bg-primary text-white"><strong>Objetivo:</strong> <? echo $habi = $res['objetivo']; ?></p>
      <p class="h6"><strong class="text-primary">Professor:</strong> <? echo $professor; ?></p>
      <p class="h6"><strong class="text-primary">Turma:</strong> <? 
	 $componente = 0;
	 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['componente']."'");
	  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
		 $componente = $res_disciplinas['componente'];
   	  }
	
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res['turma']."'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			echo $res_turma['code_serie']; echo "° ANO "; echo $res_turma['tipo_turma']; echo " - "; echo $componente; echo "
			 - TURNO: "; echo $res_turma['turno'];
	    }
	  ?></p>
      <p class="h6"><strong class="text-primary">Data m&aacute;xima de envio:</strong> <? echo $res['dia']; ?>/<? echo $res['mes']; ?>/<? echo $res['ano']; ?></p>
    </div><!-- col-sm -->
  </div><!-- row -->
  <? } ?>
<hr />
  <div class="row">
    <div class="col-sm">
      <?
      $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$_GET['aluno']."' LIMIT 1");
	  while($res_aluno = mysqli_fetch_array($sql_aluno)){
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_aluno['turma']."'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			
			$escola = $res_turma['code_escola'];
			$ano_aluno = $res_turma['code_serie'];
			
	  ?>
      <p class="h6"><strong class="text-primary">Aluno:</strong> <? echo $res_aluno['nome_aluno']; ?></p>
      <p class="h6"><strong class="text-primary">Professor:</strong>  <? echo $professor; ?></p>
      <p class="h6"><strong class="text-primary">Ano:</strong> <? echo $res_turma['code_serie']; ?>° ano <strong class="text-primary">Turma:</strong> <? echo $res_turma['tipo_turma']; ?> <strong class="text-primary">Turno:</strong> <? echo $res_turma['turno']; ?></p>
      <? } ?>
      
    </div><!-- col-sm -->
  </div><!-- row -->
<hr><? } ?>


  <div class="row">
    <div class="col-sm"><strong><? echo $_GET['atual']; ?>°) questão</strong> 
     <? $tipo_envio = 0;
	  $sql_questao = mysqli_query($conexao_bd, "SELECT * FROM atividades_varios WHERE code_atividade = '".$_GET['code_atividade']."' AND questao = '".$_GET['atual']."'");
	  while($res_questao = mysqli_fetch_array($sql_questao)){
		  echo $res_questao['texto'];
		  $tipo_envio = $res_questao['tipo_resposta'];
	  $resposta = 0;
	  $sql_verifica_resposta = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas_mista WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$_GET['code_atividade']."' AND questao = '".$_GET['atual']."'");
	  while($res_resposta = mysqli_fetch_array($sql_verifica_resposta)){
		  $resposta = $res_resposta['resposta'];
	  }
	  
	 ?>
     <hr />
     <form name="" method="post" action="" enctype="multipart/form-data">
     <input type="hidden" name="tipo_envio" value="<? echo $tipo_envio; ?>" />
      <? if($tipo_envio == 'Text'){ ?>
       <textarea class="form-control" name="resposta" rows="3"><? echo $resposta; ?></textarea>
      <? } ?>

      <? if($tipo_envio == 'Frase'){ ?>
       <input class="form-control" name="resposta" type="text" value="<? echo $resposta; ?>" placeholder="Digite aqui sua resposta">
      <? } ?>

      <? if($tipo_envio == 'Multipla'){ ?>
        <table width="300" border="0">
          <tr>
            <td width="20"><input type="radio" name="resposta" <? if($resposta == 'A'){ ?>checked="checked"<? } ?> value="A" /></td>
            <td width="270"><? echo $res_questao['opcao1']; ?></td>
          </tr>
          <tr>
            <td><input name="resposta" type="radio" <? if($resposta == 'B'){ ?>checked="checked"<? } ?> value="B" ></td>
            <td><? echo $res_questao['opcao1']; ?></td>
          </tr>
          <tr>
            <td><input type="radio" name="resposta" <? if($resposta == 'C'){ ?>checked="checked"<? } ?> value="C"></td>
            <td><? echo $res_questao['opcao1']; ?></td>
          </tr>
          <tr>
            <td><input type="radio" name="resposta" <? if($resposta == 'D'){ ?>checked="checked"<? } ?> value="D"></td>
            <td><? echo $res_questao['opcao1']; ?></td>
          </tr>
        </table>
      <? } ?>
      <input type="submit" name="verificar" class="btn btn-primary" value="Confirmar" />
     </form>
     <? } ?>
     
     
     <? if(isset($_POST['verificar'])){
      
	  $resposta = $_POST['resposta'];
	  $tipo_envio = $_POST['tipo_envio'];
	  
	  $sql_enviar = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas_mista WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$_GET['code_atividade']."' AND questao = '".$_GET['atual']."'");
	  if(mysqli_num_rows($sql_enviar) == ''){
		  mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas_mista (data, status, resposta, code_aluno, code_atividade, tipo_envio, questao) VALUES ('$data_completa', 'ATIVO', '$resposta', '".$_GET['aluno']."', '".$_GET['code_atividade']."', '$tipo_envio', '".$_GET['atual']."')");
	  }else{
		  mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas_mista WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$_GET['code_atividade']."' AND questao = '".$_GET['atual']."'");
		  
		  mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas_mista (data, status, resposta, code_aluno, code_atividade, tipo_envio, questao) VALUES ('$data_completa', 'ATIVO', '$resposta', '".$_GET['aluno']."', '".$_GET['code_atividade']."', '$tipo_envio', '".$_GET['atual']."')");		  
	  }
	  
	  
	  $turma = $_GET['turma'];
	  $ik = $_GET['ik'];
	  $aluno = $_GET['aluno'];
	  $code_atividade = $_GET['code_atividade'];
	  $total = $_GET['total'];
	  $atual = $_GET['atual']+1;
	  
	  
	  if($atual > $total){
			  $code_serie = 0;
			  $code_escola = 0;
			  $sql_dados_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
			   while($res_dados_alunos = mysqli_fetch_array($sql_dados_alunos)){
				   $code_serie = $res_dados_alunos['code_serie'];
				   $code_escola = $res_dados_alunos['code_escola'];
			   }
			  
			 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$aluno' AND code_atividade = '$code_atividade'");
			 if(mysqli_num_rows($sql_verifica) == ''){
			  mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data_completa', 'AGUARDA', 'CONCLUIDO', '$aluno', '$code_atividade', '')");
			 }
		  
	  echo "<script language='javascript'>window.alert('Atividade concluída com sucesso!');window.location='mostrar_atividades.php?p=4&ano=$code_serie&turma=$turma&componente=$code_componente&mes=$mes&escola=$code_escola&aluno=$aluno';</script>";
	  }else{
	  echo "<script language='javascript'>window.location='?p=&turma=$turma&ik=$ik&aluno=$aluno&code_atividade=$code_atividade&total=$total&atual=$atual';</script>";
	  }
			 
	 }?>
     
    </div><!-- col-sm -->
  </div><!-- row -->

<? } // p ?>
</div><!-- container -->
</body>
</html>