<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../conexao.php"; ?>
</head>

<body>
      <? if(isset($_POST['enviar_atividade'])){
		  
		$enviar_docs = $_FILES['enviar_docs']['name'];
		$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");
			
		echo "<img src='professor/img/rooler.gif' width='20' height='20'> <em>Carregando imagem, pode demorar um pouco...</em>";		
		
		
		$arquivo = $enviar_docs;
		$arquivo = strrchr($arquivo, '.');

		$enviar_docs = str_replace($enviar_docs, "$code_enviar_docs$arquivo", $enviar_docs);
		
		if($enviar_docs == ''){
			echo "<script language='javascript'>window.alert('Você não anexou a atividade!');</script>";
		}else{
		
		if(file_exists("professor/arquivos/$enviar_docs")){ $a = 1;while(file_exists("professor/arquivos/[$a]$enviar_docs")){$a++;}$enviar_docs = "[".$a."]".$enviar_docs;}
		
		(move_uploaded_file($_FILES['enviar_docs']['tmp_name'], "professor/arquivos/".$enviar_docs));
		
		
		mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET data = '$data_completa', status = 'AGUARDA', arquivo = '$enviar_docs' WHERE code_atividade = '$code_atividade' AND code_aluno = '".$_GET['aluno']."'");
		
		$aluno = $_GET['aluno'];
		$turma = $_GET['turma'];
			


			
			
		
		
		echo "<script language='javascript'>window.alert('Atividade enviada com sucesso!');window.location='mostrar_atividades.php?p=4&ano=$ano_aluno&turma=$turma&componente=$code_componente&mes=$mes&escola=$escola&aluno=$aluno';</script>";
		die;
	  }
	 }?>
     
     
      <?
	  $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$code_atividade' AND code_aluno = '".$_GET['aluno']."'");
	  if(mysqli_num_rows($sql_atividade) == ''){
		mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('', '', '', '".$_GET['aluno']."', '$code_atividade', '')");
		echo "<script language='javascript'>window.location='';</script>";      
	  }

	  ?>
      
      
      <? 
	  
	   $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$code_atividade' AND code_aluno = '".$_GET['aluno']."'");
	   while($res_atividades = mysqli_fetch_array($sql_atividade)){
	   
	   $nota = $res_atividades['nota'];
	   
	   if($res_atividades['status'] == 'AGUARDA'){
		   echo "<div class='alert alert-warning' role='alert'>Sua atividade aguarda correção, por favor, aguarde...</div>";
	   }elseif($res_atividades['status'] == 'CORRIGIDO'){
		   echo "<div class='alert alert-primary' role='alert'>Parabéns! Sua atividade foi corrigida. <strong>NOTA:$nota</strong></div>";
	   }else{
	    
	   if($res_atividades['status'] == 'RECUSADO'){
		   echo "<div class='alert alert-danger' role='alert'>Sua atividade foi recusada, envie novamente!</div>";
	   }
		
	  ?>
      <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <input type="file" name="enviar_docs" class="form-control-file btn btn-warning">
        <input name="enviar_atividade" type="submit" class="btn btn-danger" value="Enviar">
      </div>
    </form>  
    <? }} ?>
</body>
</html>