<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width, initial-scale=1.0" />
<link href="css.css" rel="stylesheet" type="text/css" />
<? require "variaveis.php"; require "conexao.php"; $id = base64_decode($_GET['ik']); 

if($id == ''){
	echo "<script language='javascript'>window.location='http://www.escolaleornebelem.com/professor';</script>";
}

$code_atividade = 0;
$professor = 0;
$code_professor = 0;
$login_professor = 0;
$turma_atividade = 0;
$sql = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id'");
while($res = mysqli_fetch_array($sql)){
	$usuario = $res['usuario'];
	$code_professor = $res['usuario'];
	$turma_atividade = $res['turma'];
	$code_atividade = $res['code_atividade'];
	
	 $sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res['usuario']."'");
	 while($res_prof = mysqli_fetch_array($sql_professor)){
		 $professor = $res_prof['cpf'];
		 $login_professor = $res_prof['login'];
		 
	 $sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '$professor'");
	 while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
		 
		 $sql_contato_colaboradores = mysqli_query($conexao_bd, "SELECT * FROM contato_colaboradores WHERE cpf = '$professor' AND telefone != '' LIMIT 1");
		 $professor = $res_colaborador['nome'];
		  while($res_contato = mysqli_fetch_array($sql_contato_colaboradores)){
			  		
					 $contato = $res_contato['telefone'];
                     $contato = str_replace(" ", "", $contato); 
                     $contato = str_replace(".", "", $contato);
                     $contato = str_replace("(", "", $contato); 
                     $contato = str_replace(")", "", $contato);
					 
		 }
		 
	 }
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
     
     
      <img src="img/logo.fw.png" width="100" height="100" class="rounded" alt="...">
      
      <?
      $sql = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id'");
	while($res = mysqli_fetch_array($sql)){
		
		$disciplina = $res['componente'];
		
	 $componente = 0;
	 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['componente']."'");
	  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
		 $componente = $res_disciplinas['componente'];
   	  }?>
  <div class="row">
    <div class="col-sm">
      <p class="p-3 mb-2 bg-primary text-white"><strong>Objetivo:</strong> <? echo $habi = $res['objetivo']; ?></p>
      <p class="h6"><strong class="text-primary">Componente:</strong> <? echo $componente; ?></p>      
      <p class="h6"><strong class="text-primary">Professor:</strong> <? echo $professor; ?> <a href='https://api.whatsapp.com/send/?phone=55<? echo $contato; ?>&text&app_absent=0' target='_blank'><img src="professor/img/whatsapp.png" width="22" height="22" border="0" /></a></p>
      <p class="h6"><strong class="text-primary">Turma:</strong> <?

	
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res['turma']."'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			echo $res_turma['code_serie']; echo "° ANO "; echo $res_turma['tipo_turma']; echo " - "; echo $componente; echo "
			 - TURNO: "; echo $res_turma['turno'];
	    }
	  ?></p>
      <p class="h6"><strong class="text-primary">Data m&aacute;xima de envio:</strong> <? echo $res['dia']; ?>/<? echo $res['mes']; ?>/<? echo $res['ano']; ?></p>
    </div><!-- col-sm -->
  </div><!-- row -->
<hr />
	  
	 <? } ?>
      
      <? if(isset($_POST['verificar'])){
     
	  $nome_aluno = strtoupper($_POST['nome_aluno']);

	  
	  if(strtoupper($nome_aluno) == strtoupper($login_professor)){
		echo "<script language='javascript'>window.location='correcao.php?atividade=$code_atividade&turma=$turma_atividade';</script>";      	  	
	  }
	  
	  if($nome_aluno == ''){
	   echo "<div class='alert alert-danger' role='alert'>Digite pelo menos seu primeiro nome!</div>";
	  }else{
	  
	   $sql = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id'");
	   while($res = mysqli_fetch_array($sql)){
		   $turma = $res['turma'];
	   }
	  
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE nome_aluno LIKE '%$nome_aluno%'");
	  if(mysqli_num_rows($sql_verifica) >= '2'){
	   echo "<div class='alert alert-danger' role='alert'>Foi encontrado mais de 2 alunos com este mesmo nome, para evitar interferência, pedimos que digite seu primeiro e segundo nome, exemplo: Lucas Santiago!</div>";
	  }elseif(mysqli_num_rows($sql_verifica) == ''){
	   echo "<div class='alert alert-danger' role='alert'>Aluno não encontrado, verifique seu nome e digite novamente!</div>";
	  }else{
		  $id = base64_encode($id);
		  $aluno = 0;
		  while($res_aluno = mysqli_fetch_array($sql_verifica)){
			  $aluno = $res_aluno['code_aluno'];
			  
			  $sql_verifica_turma_aluno = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND aluno = '$aluno'");
			  if(mysqli_num_rows($sql_verifica_turma_aluno) <= 0){
				   echo "<div class='alert alert-danger' role='alert'>Aluno não encontrado, verifique seu nome e digite novamente!</div>";		
			  }else{
		$id_atividade = base64_decode($id);
		mysqli_query($conexao_bd, "INSERT INTO visualiza_atividade (ip, data, aluno, atividade, disciplina, professor) VALUES ('$ip', '$data_completa', '$aluno', '$id_atividade', '$componente', '$code_professor')"); 
				
		$sql_vacina = mysqli_query($conexao_bd, "SELECT * FROM atualiza_vacina WHERE aluno = '$aluno'");
		if(mysqli_num_rows($sql_vacina) <= 10){
			echo "<script language='javascript'>window.location='vacinacao_alunos.php?turma=$turma&ik=$id&aluno=$aluno&disciplina=$disciplina';</script>"; 
		}else{
			$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM atualiada_dados WHERE aluno = '$aluno'");
			if(mysqli_num_rows($sql_verifica) == ''){
			echo "<script language='javascript'>window.location='atualiza_contato.php?turma=$turma&ik=$id&aluno=$aluno&disciplina=$disciplina';</script>"; 
			}else{
			echo "<script language='javascript'>window.location='?p=2&turma=$turma&ik=$id&aluno=$aluno&disciplina=$disciplina';</script>";   		
			 }
	    }
	   }
		  }
	  }}} ?>
      <form method="post" action="" enctype="multipart/form-data">
      <p class="h5"><strong>DIGITE SEU NOME OU SEU LOGIN</strong></p>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      </div>
      <input type="text" name="nome_aluno" class="form-control" aria-label="Default" autofocus aria-describedby="inputGroup-sizing-default">
    </div>
      <input type="submit" name="verificar" class="btn btn-primary" value="Avançar" />
     </form>
    </div>
    </div><!-- col-sm -->
  </div><!-- row -->
<? } // pagina 0 ?>










<? if($_GET['p'] == '2'){ ?>



<?
$sql = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id'");
while($res = mysqli_fetch_array($sql)){
?>
  <div class="row">
    <div class="col-sm">
      <p class="p-3 mb-2 bg-primary text-white"><strong>Objetivo:</strong> <? echo $res['objetivo'];  ?></p>
      
      <? if($_GET['onde'] == 'app'){ 
	  	$id_atividade = base64_decode($id);
		$disciplina = 0;
		
		$sql_disciplina = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['disciplina']."'");
		  while($res_disciplina = mysqli_fetch_array($sql_disciplina)){
			  $disciplina = $res_disciplina['componente'];
		 }
		
		
		mysqli_query($conexao_bd, "INSERT INTO visualiza_atividade (ip, data, aluno, atividade, disciplina, professor) VALUES ('$ip', '$data_completa', '".$_GET['aluno']."', '$id', '$disciplina', '$code_professor')"); 
	  
	  ?>
         <a href="app/inicio.php?p=atividade&componente=<? echo $_GET['disciplina']; ?>&mes=<? echo $mes; ?>" style="text-align:right; border:2px solid #000; float:right;" class="btn btn-danger">Voltar ao App</a>
      <? } ?>
      
      <p class="h6"><strong class="text-primary">Componente:</strong> <? 
		 $componente = 0;
		 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['componente']."'");
		  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
			 echo $componente = $res_disciplinas['componente'];
			 $code_componente = $res_disciplinas['code'];
		  }
	  ?></p>
      <p class="h6"><strong class="text-primary">Data m&aacute;xima de envio:</strong> <? echo $res['dia']; ?>/<? echo $res['mes']; ?>/<? echo $res['ano']; ?></p>
    </div><!-- col-sm -->
  </div><!-- row -->
<hr />
  <div class="row">
    <div class="col-sm">
      <?
      $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$_GET['aluno']."' LIMIT 1");
	  while($res_aluno = mysqli_fetch_array($sql_aluno)){
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			
			$escola = $res_turma['code_escola'];
			$ano_aluno = $res_turma['code_serie'];
			
	  ?>
      <p class="h6"><strong class="text-primary">Aluno:</strong> <? echo $res_aluno['nome_aluno']; ?></p>
      <p class="h6"><strong class="text-primary">Professor:</strong>  <? echo $professor; ?> <a href='https://api.whatsapp.com/send/?phone=55<? echo $contato; ?>&text&app_absent=0' target='_blank'><img src="professor/img/whatsapp.png" width="22" height="22" border="0" /></a></p>
      <p class="h6"><strong class="text-primary">Ano:</strong> <? echo $res_turma['code_serie']; ?>° ano <strong class="text-primary">Turma:</strong> <? echo $res_turma['tipo_turma']; ?> <strong class="text-primary">Turno:</strong> <? echo $res_turma['turno']; ?></p>
      <? } ?>
      
    </div><!-- col-sm -->
  </div><!-- row -->
<hr />

<? if($_GET['origem'] == 'mostrar_atividades'){
		mysqli_query($conexao_bd, "INSERT INTO visualiza_atividade (ip, data, aluno, atividade, disciplina, professor) VALUES ('$ip', '$data_completa', '".$_GET['aluno']."', '$id', '".$res['componente']."', '".$res['usuario']."')"); 
}?>


<? if($res['video'] != ''){ ?>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<? 
  $video = $res['video']; $iv = 0; $fim = 0;
  for($i=0; $i<=strlen($video); $i++){
	  if($video[$i] == '=' && $iv == 0){
		  $iv = $i+1;
	  }elseif($video[$i] == '&' && $fim == 0){
		  $fim = $i-1;
	  }
  }
  
  if($fim == 0){
	  $fim = strlen($video);
  }
  
  for($y=$iv; $y<=$fim; $y++){
	  echo $video[$y];
  }

   ?>" allowfullscreen></iframe>
</div>
<? } ?>


<? if($res['video2'] != ''){ ?>
<hr />
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<? 
  $video = $res['video2']; $iv = 0; $fim = 0;
  for($i=0; $i<=strlen($video); $i++){
	  if($video[$i] == '=' && $iv == 0){
		  $iv = $i+1;
	  }elseif($video[$i] == '&' && $fim == 0){
		  $fim = $i-1;
	  }
  }
  
  if($fim == 0){
	  $fim = strlen($video);
  }
  
  for($y=$iv; $y<=$fim; $y++){
	  echo $video[$y];
  }

   ?>" allowfullscreen></iframe>
</div>
<? } ?>


<? if($res['video3'] != ''){ ?>
<hr />
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<? 
  
  $video = $res['video3']; $iv = 0; $fim = 0;
  for($i=0; $i<=strlen($video); $i++){
	  if($video[$i] == '=' && $iv == 0){
		  $iv = $i+1;
	  }elseif($video[$i] == '&' && $fim == 0){
		  $fim = $i-1;
	  }
  }
  
  if($fim == 0){
	  $fim = strlen($video);
  }
  
  for($y=$iv; $y<=$fim; $y++){
	  echo $video[$y];
  }  
  
  ?>" allowfullscreen></iframe>
</div>
<? } ?>
  
  
<? if($res['link_externo'] != ''){ ?>
<hr />
      <a class="btn btn-success" target="_blank" href="<? echo $res['link_externo']; ?>">Acessar prova externa</a><p></p>
<hr />
<? } ?>  
  
  
  
  
  <?
  $sql_arquivos = mysqli_query($conexao_bd, "SELECT * FROM arquivos_atividades WHERE code_atividade = '$code_atividade'");
  if(mysqli_num_rows($sql_arquivos) == ''){
  }else{
  ?>
  <p><br />
  <strong>Material de apoio e atividade</strong></p>
  <ul>
  <? $i=0; while($res_arquviso = mysqli_fetch_array($sql_arquivos)){ $i++;?>
  <? if($_GET['onde'] == 'app'){ ?>
  <li><a href="professor/arquivos/<? echo $res_arquviso['arquivo']; ?>"><? echo $i; ?> - <? if($res_arquviso['nome_arquivo'] == ''){ echo "Baixar material de apoio"; }else{ echo $res_arquviso['nome_arquivo']; }?></a></li>
  <? }else{ ?>
  <li><a target="_blank" href="professor/arquivos/<? echo $res_arquviso['arquivo']; ?>"><? echo $i; ?> - <? if($res_arquviso['nome_arquivo'] == ''){ echo "Baixar material de apoio"; }else{ echo $res_arquviso['nome_arquivo']; }?></a></li>
  <? } ?>
  
  
  
  <? } ?>
  </ul>
  
  <? } ?>
<hr />
  
 
  <div class="row">
    <div class="col-sm">





     <? if($res['tipo_envio'] == 'varios'){ ?>
  	  <p class="h5 text-danger"><strong>Entrega de atividade</strong></p>
       <?
		$total_questoes = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades_varios WHERE code_atividade = '".$res['code_atividade']."'"));
	   ?>
       
       
      <?
      
	   $sql_verifica_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res['code_atividade']."'");
	   if(mysqli_num_rows($sql_verifica_atividade) >=1){
		   echo "<div class='alert alert-success' role='alert'> Atividade enviada com sucesso! </div>";
	   }else{
	  ?>  
      <a class="btn btn-primary" href="atividade_mista.php?p=&turma=<? echo $_GET['turma']; ?>&ik=<? echo $_GET['ik']; ?>&aluno=<? echo $_GET['aluno']; ?>&code_atividade=<? echo $res['code_atividade']; ?>&total=<?  echo $total_questoes; ?>&atual=1">Começar</a><p></p>
      <? } // ?>
     
     
	 
	 <? } // vários ?>





     <? if($res['tipo_envio'] == 'multipla'){ ?>
  	  <p class="h5 text-danger"><strong>Atividade de multipla escolha</strong></p>
	  
      <? $total = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res['code_atividade']."'"));
      
	  $sql_analisa_questao = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res['code_atividade']."' AND aluno = '".$_GET['aluno']."' AND turma = '".$_GET['turma']."'");
	  if(mysqli_num_rows($sql_analisa_questao) >= $total){
	  ?>
      <div class='alert alert-success' role='alert'>Atividade enviada com sucesso. <br /><strong>Sua nota:  
      <?
       
	    $sql_analisa_questao_correta = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res['code_atividade']."' AND aluno = '".$_GET['aluno']."' AND turma = '".$_GET['turma']."' AND correto = 'SIM'");
		$total_acerto = mysqli_num_rows($sql_analisa_questao_correta);
	  	
		echo number_format(((10*$total_acerto)/$total),1);
		
	  ?>      
      </strong></div>
      
	  <? }else{ ?>
      <a class="btn btn-primary" href="?p=3&turma=<? echo $_GET['turma']; ?>&ik=<? echo $_GET['ik']; ?>&aluno=<? echo $_GET['aluno']; ?>&total=<?  echo $total; ?>&atual=1">Começar</a>
     <? }} ?>






     <? if($res['tipo_envio'] == 'arquivo'){ ?>
  	  <p class="h5 text-danger"><strong>Enviar atividade</strong> </p><hr />
      <?
       
	  $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas_extras WHERE code_atividade = '$code_atividade' AND code_aluno = '".$_GET['aluno']."'");
		while($res_atividades = mysqli_fetch_array($sql_atividade)){
	 ?>
     <ul>
     <li style="margin:-10px 0 -15px 0;"><a style="font:11px Arial, Helvetica, sans-serif;" target="_blank" href="professor/arquivos/<? echo $res_atividades['arquivo']; ?>"><? echo $res_atividades['arquivo']; ?></a> - 
     <a href="?p=2&turma=<? echo $_GET['turma']; ?>&ik=<? echo $_GET['ik']; ?>&aluno=<? echo $_GET['aluno']; ?>&disciplina=<? echo $_GET['disciplina']; ?>&imagem=<? echo $res_atividades['arquivo']; ?>&pg=excluir&id=<? echo $res_atividades['id']; ?>"><img src="professor/img/deleta.jpg" width="10" height="10" border="0" /></a></li>
     </ul>
	 <? } ?>
      
      
      
	 
	 <?
	  $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$code_atividade' AND code_aluno = '".$_GET['aluno']."'");
	  if(mysqli_num_rows($sql_atividade) == ''){
		mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('', '', '', '".$_GET['aluno']."', '$code_atividade', '', '')");
		echo "<script language='javascript'>window.location='';</script>";      
	  }

	  ?>
        <div class="embed-responsive embed-responsive-21by9">
          <iframe style="margin:0 0 0 0;" class="embed-responsive-item" src="envio/index.php?aluno=<? echo $_GET['aluno']; ?>&atividade=<? echo $code_atividade; ?>"></iframe>
        </div>

    <? } // verifica o tipo de arquivo ?>
   </div><!-- col-sm -->
  </div><!-- row -->
<? }} ?>


<? }// pagina 2 ?>



  <div class="row">
    <div class="col-sm">
     <? if($_GET['p'] == '3'){ 
	 
	 $turma = $_GET['turma']; 
	 $ik = $_GET['ik']; 
	 $aluno = $_GET['aluno']; 
	 $total = $_GET['total']; 
	 $atual = $_GET['atual']; 
	 
	 if($atual > $total){
		   echo "<script language='javascript'>window.location='?p=2&turma=$turma&ik=$ik&aluno=$aluno';</script>";
	 }else{
	  $sql_questao_a = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE aluno = '$aluno' AND atividade = '$code_atividade' AND questao = '$atual' AND turma = '$turma'");
	   if(mysqli_num_rows($sql_questao_a) >= 1){
		   $atual++;
		   echo "<script language='javascript'>window.location='?p=3&turma=$turma&ik=$ik&aluno=$aluno&total=$total&atual=$atual';</script>";
	   }else{
		   $sql_questao = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '$code_atividade' AND id_questao = '$atual'");
		   while($res_questao = mysqli_fetch_array($sql_questao)){
	 ?>
   <div class="table-responsive">
   
   
   <? if(isset($_POST['avancar'])){
	   
	$opcao = $_POST['opcao'];
	$certo = 0;
	if($opcao == ''){
	 echo "<div class='alert alert-danger' role='alert'>Por favor, escolha um alternativa para avançar</div>";
	}else{
		if($res_questao['correta'] == $opcao){
			$certo = "SIM";
		}else{
			$certo = "NAO";
		}
		
		mysqli_query($conexao_bd, "INSERT INTO questoes_atividades_alunos (data_completa, aluno, atividade, questao	, item, correto, turma) VALUES ('$data_completa', '$aluno', '$code_atividade', '$atual', '$opcao', '$certo', '$turma')");
		

			$sql_verifica_frequencia = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$aluno' AND data = '$data' AND code_atividade = '$code_atividade'");
			if(mysqli_num_rows($sql_verifica_frequencia) == ''){
				mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('$data', 'CORRIGIDO', '', '$aluno', '$code_atividade', '', 'SIM')");
			}else{
				mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET presente = 'SIM', status = 'CORRIGIDO' WHERE data = '$data' AND code_aluno = '$aluno' AND code_atividade = '$code_atividade'");
			}

		
		
		
		   $atual++;
		   echo "<script language='javascript'>window.location='?p=3&turma=$turma&ik=$ik&aluno=$aluno&total=$total&atual=$atual';</script>";   }
   }?>
   
   
   <form name="" method="post" action="" enctype="multipart/form-data">
    <table class="table">
      <thead>
        <tr>
          <th width="25" align="left" scope="col"><p class="h5 text-danger"><strong><? echo $atual; ?>°)</strong></p></th>
          <th width="207" align="left" scope="col"><? echo $res_questao['questao']; ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th width="25"  scope="row" align="left">A) 
            <input name="opcao" type="radio" value="A" /></th>
          <td><? echo $res_questao['item_a']; ?></td>
        </tr>
        <tr>
          <th width="25" scope="row" align="left">B) 
            <input type="radio" name="opcao" id="radio" value="B" />
            <label for="opcao"></label></th>
          <td><? echo $res_questao['item_b']; ?></td>
        </tr>
        <tr>
          <th width="25" scope="row" align="left">C) 
            <input type="radio" name="opcao" id="radio2" value="C" />
            <label for="opcao"></label></th>
          <td><? echo $res_questao['item_c']; ?></td>
        </tr>
        <tr>
          <th width="25" scope="row" align="left">D) 
            <input type="radio" name="opcao" id="radio3" value="D" />
            <label for="opcao"></label></th>
          <td><? echo $res_questao['item_d']; ?></td>
        </tr>
        <tr>
          <th colspan="2" align="left" scope="row"><input type="submit" name="avancar" class="btn btn-primary" value="Avançar" /></th>
          </tr>
        </tbody>
    </table>
    </form>
    </div><!-- table resposiva -->  
   </div><!-- col-sm -->
  </div><!-- row -->	 
	 <? }}}} ?>
     
     
     
</div><!-- container -->
</body>
</html>
<? if($_GET['pg'] == 'excluir'){

$turma = $_GET['turma'];
$ik = $_GET['ik'];
$aluno = $_GET['aluno'];
$disciplina = $_GET['disciplina'];
$id = $_GET['id'];
$imagem = $_GET['imagem'];
$img = "professor/arquivos/$imagem";

mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas_extras WHERE id = '$id'");
$resultado = unlink($img);

echo "<script language='javascript'>window.location='?p=2&turma=$turma&ik=$ik&aluno=$aluno&disciplina=$disciplina';</script>";      

}?>