<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width, initial-scale=1.0" />
<link href="css.css" rel="stylesheet" type="text/css" />
<? require "variaveis.php"; require "conexao.php"; $turma = $_GET['turma']; $atividade = $_GET['atividade']; ?>
</head>

<body>
<div class="container">
  <?
      $sql = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '$atividade'");
	while($res = mysqli_fetch_array($sql)){
  ?>
  <div class="row">
    <div class="col-sm">
      <p class="p-3 mb-2 bg-primary text-white"><strong>Objetivo:</strong> <? echo $habi = $res['objetivo']; ?></p>
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




  <div class="row">
    <div class="col-sm">
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="62" scope="col">Aluno</th>
          <th width="74" scope="col">Atividade</th>
          <th width="50" scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
      <?
     
	   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma'");
	   while($res_turma = mysqli_fetch_array($sql_turma)){
		   
		  $telefone = $res_turma['telefone'];
		  
		  	 $telefone = str_replace(" ", "", $telefone); 
			 $telefone = str_replace(".", "", $telefone);
			 $telefone = str_replace("(", "", $telefone); 
			 $telefone = str_replace(")", "", $telefone);		   
		   
	  ?>
        <tr>
          <td><? echo $res_turma['nome_aluno']; ?> <a href="https://api.whatsapp.com/send/?phone=55<? echo $telefone ?>&text&app_absent=0"><img src="professor/img/whatsapp.png" width="20" height="15" border="0" /></a></td>
          <td>
          <?
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas_extras WHERE code_atividade = '$atividade' AND code_aluno = '".$res_turma['code_aluno']."'");
		   if(mysqli_num_rows($sql_busca_atividade) == ''){
		   }else{
			   while($res_atividade = mysqli_fetch_array($sql_busca_atividade)){
				   if($res_atividade['data'] == ''){
					   echo "<img src='professor/img/olho_vizua.png' width='15' height='15'>";
				   }else{
					   if($res_atividade['arquivo'] != ''){
		  ?>
          <a target="_blank" href="professor/arquivos/<? echo $res_atividade['arquivo']; ?>"><img src='img/baixar.png' width='15' height='15' border="0" title="Verificar atividade"></a>
          <? }}}} ?>
          </td>
          <td>
        	<div class="embed-responsive embed-responsive-1by1">
              <iframe class="embed-responsive-item" src="acao_professor.php?atividade=<? echo $_GET['atividade']; ?>&code_aluno=<? echo $res_turma['code_aluno']; ?>&turma=<? echo $_GET['turma']; ?>"></iframe>
            </div>
          </td>
        </tr>
      <? } ?> 
      </tbody>
    </table>  	 
    </div><!-- col-sm -->
  </div><!-- row -->
</div><!-- container -->
</body>
</html>