<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width, initial-scale=1.0" />
<link href="css.css" rel="stylesheet" type="text/css" />
<? require "variaveis.php"; require "conexao.php"; $turma = $_GET['turma']; $atividade = $_GET['atividade']; ?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <div class="text-center">  
        <img src="img/logo.fw.png" width="100" height="100" class="rounded" alt="...">
	  </div><!-- text-center --> 
    </div><!-- col-sm -->
  </div><!-- row -->
<? if($_GET['p'] == ''){ ?>
  <div class="row">
    <div class="col-sm">
      <div class="text-center">  
        <p class="h6 text-primary">Selecione a escola</p>
	  </div><!-- text-center -->     
	  <form name="form" id="form">
		   <select class="form-control" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
		     <option value="">Selecione uma escola</option>
             <?
			  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE tipo = 'ESCOLA'");
			 	while($res_escola = mysqli_fetch_array($sql_escola)){
			 ?>
		     <option value="?p=extra&escola=<? echo $res_escola['code']; ?>"><? echo $res_escola['nome_escola']; ?></option>
             <? } ?>
        </select>
      </form>
    </div><!-- col-sm -->
  </div><!-- row -->
<? } ?>  



  
<? if($_GET['p'] == 'extra'){ ?>
  <div class="row">
    <div class="col-sm">
      <div class="text-center">  
        <p class="h6 text-primary">Selecione o ano que você está cursando</p>
	  </div><!-- text-center -->     
	  <form name="form" id="form">
		   <select class="form-control" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
		     <option value="">Selecione sua série</option>
		     <option value="?p=1&ano=1&escola=<? echo $_GET['escola']; ?>">1° Ano</option>
		     <option value="?p=1&ano=2&escola=<? echo $_GET['escola']; ?>">2° Ano</option>
		     <option value="?p=1&ano=3&escola=<? echo $_GET['escola']; ?>">3° Ano</option>
		     <option value="?p=1&ano=4&escola=<? echo $_GET['escola']; ?>">4° Ano</option>
		     <option value="?p=1&ano=5&escola=<? echo $_GET['escola']; ?>">5° Ano</option>
		     <option value="?p=1&ano=6&escola=<? echo $_GET['escola']; ?>">6° Ano</option>
		     <option value="?p=1&ano=7&escola=<? echo $_GET['escola']; ?>">7° Ano</option>
		     <option value="?p=1&ano=8&escola=<? echo $_GET['escola']; ?>">8° Ano</option>
		     <option value="?p=1&ano=9&escola=<? echo $_GET['escola']; ?>">9° Ano</option>
        </select>
      </form>
    </div><!-- col-sm -->
  </div><!-- row -->
<hr />
<? } ?>


<? if($_GET['p'] == '1'){ ?>
    <div class="col-sm">
      <div class="text-center">  
        <p class="h6 text-primary">Selecione a turma</p>
	  </div><!-- text-center -->
	  <form name="form" id="form">
		   <select class="form-control" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
		     <option value="">Selecione sua turma</option>
        	<? 
			 
			 $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_escola = '".$_GET['escola']."' AND code_serie = '".$_GET['ano']."'");
			 while($res_turma = mysqli_fetch_array($sql_turma)){
			?>   
		     <option value="?p=2&ano=<? echo $_GET['ano']; ?>&turma=<? echo $res_turma['code_turma']; ?>&escola=<? echo $_GET['escola']; ?>"><? echo $res_turma['code_serie']; ?>° ANO - <? echo $res_turma['tipo_turma']; ?> - <? echo $res_turma['turno']; ?></option>
        	<? } ?>
        </select>
      </form>
    </div><!-- col-sm -->
  </div><!-- row -->
<? } ?>

<? if($_GET['p'] == '2'){ ?>
    <div class="col-sm">
      <div class="text-center">  
        <p class="h6 text-primary">Selecione o componente curricular</p>
	  </div><!-- text-center -->
	  <form name="form" id="form">
		   <select class="form-control" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
		     <option value="">Selecione</option>
        	<? 
			 
			 $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM disciplinas ");
			 while($res_turma = mysqli_fetch_array($sql_turma)){
			?>   
		     <option value="?p=3&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $res_turma['code']; ?>&escola=<? echo $_GET['escola']; ?>"><? echo $res_turma['componente']; ?></option>
        	<? } ?>
        </select>
      </form>
    </div><!-- col-sm -->
  </div><!-- row -->
<? } ?>


<? if($_GET['p'] == '3'){ ?>
    <div class="col-sm">
      <div class="text-center">  
        <p class="h6 text-primary">Selecione o mês que deseja checar suas atividades</p>
	  </div><!-- text-center -->
	  <form name="form" id="form">
		   <select class="form-control" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
		     <option value="">Selecione</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=01&escola=<? echo $_GET['escola']; ?>">JANEIRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=02&escola=<? echo $_GET['escola']; ?>">FEVEREIRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=03&escola=<? echo $_GET['escola']; ?>">MARÇO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=04&escola=<? echo $_GET['escola']; ?>">ABRIL</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=05&escola=<? echo $_GET['escola']; ?>">MAIO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=06&escola=<? echo $_GET['escola']; ?>">JUNHO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=07&escola=<? echo $_GET['escola']; ?>">JULHO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=08&escola=<? echo $_GET['escola']; ?>">AGOSTO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=09&escola=<? echo $_GET['escola']; ?>">SETEMBRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=10&escola=<? echo $_GET['escola']; ?>">OUTUBRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=11&escola=<? echo $_GET['escola']; ?>">NOVEMBRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=12&escola=<? echo $_GET['escola']; ?>">DEZEMBRO</option>

        </select>
      </form>
    </div><!-- col-sm -->
  </div><!-- row -->
<? } ?>




<? if($_GET['p'] == '4'){ ?>
<p></p>
	  <form style="border:1px solid #03C; border-radius:5px;" name="form" id="form">
		   <select class="form-control" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
		     <option value="">Selecione o componente curricular</option>
        	<? 
			 
			 $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM disciplinas ");
			 while($res_turma = mysqli_fetch_array($sql_turma)){
			?>   
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $res_turma['code']; ?>&mes=<? echo $_GET['mes']; ?>&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>"><? echo $res_turma['componente']; ?></option>
        	<? } ?>

        </select>
      </form>
<hr />

  <div class="row">
    <div class="col-sm">
      <p class="h6"><strong class="text-primary">Professor:</strong> <? 
	   
	   $sql_comp = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE turma = '".$_GET['turma']."' AND disciplina = '".$_GET['componente']."' AND escola = '".$_GET['escola']."'");
	   while($res_comp = mysqli_fetch_array($sql_comp)){
		   $code_professor = $res_comp['professor'];

		   $sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$code_professor'");
		   while($res_professor = mysqli_fetch_array($sql_professor)){
			   echo $res_professor['nome_escola'];
		   }
		   
		   
	   }
	  
	  
	  
	  ?></p>
      <p class="h6"><strong class="text-primary">Turma:</strong> <? 
	 $componente = 0;
	 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['componente']."'");
	  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
		 $componente = $res_disciplinas['componente'];
   	  }
	
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			echo $res_turma['code_serie']; echo "° ANO "; echo $res_turma['tipo_turma']; echo " - "; echo $componente; echo "
			 - TURNO: "; echo $res_turma['turno'];
	    }
	  ?></p>
      <? if(@$_GET['aluno'] != ''){ ?>
      <p class="h6"><strong class="text-primary">Aluno:</strong> 
       <?
		$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$_GET['aluno']."'");
		  while($res_aluno = mysqli_fetch_array($sql_verifica)){
			  echo $aluno = $res_aluno['nome_aluno'];
		  }
	   ?>
      </p>
      
      <hr />
	  <form name="form" id="form">
		   <select class="form-control" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
		     <option value="">Selecione o mês</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=01&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">JANEIRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=02&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">FEVEREIRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=03&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">MARÇO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=04&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">ABRIL</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=05&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">MAIO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=06&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">JUNHO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=07&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">JULHO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=08&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">AGOSTO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=09&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">SETEMBRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=10&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">OUTUBRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=11&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">NOVEMBRO</option>
		     <option value="?p=4&ano=<? echo $_GET['ano']; ?>&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=12&escola=<? echo $_GET['escola']; ?>&aluno=<? echo $_GET['aluno']; ?>">DEZEMBRO</option>

        </select>
      </form>
      <hr />
      
      <? } ?>
    </div><!-- col-sm -->
   <hr />
   
   
   <? if(@$_GET['aluno'] == ''){ ?>
    <div class="col-sm">
    <hr />
         <div class="text-center">
         
               <? if(isset($_POST['verificar'])){
     
				  $nome_aluno = strtoupper($_POST['nome_aluno']);

					$ano = $_GET['ano'];
					$turma = $_GET['turma'];
					$componente = $_GET['componente'];
					$mes = $_GET['mes'];
					$escola = $_GET['escola'];				  
				  
				  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE nome_aluno LIKE '%$nome_aluno%' AND turma = '$turma'");
				  if(mysqli_num_rows($sql_verifica) == ''){
				   echo "<div class='alert alert-danger' role='alert'>Aluno não encontrado, verifique seu nome e digite novamente!</div>";
				  }else{
					  $id = base64_encode($id);
					  $aluno = 0;
					  while($res_aluno = mysqli_fetch_array($sql_verifica)){
						  $aluno = $res_aluno['code_aluno'];
					  }

					echo "<script language='javascript'>window.location='?p=4&ano=$ano&turma=$turma&componente=$componente&mes=$mes&escola=$escola&aluno=$aluno';</script>";      
				}} ?>
         
          <form method="post" action="" enctype="multipart/form-data">
          <p class="h5"><strong>DIGITE SEU NOME COMPLETO</strong></p>
          <div class="input-group mb-3">
          <div class="input-group-prepend">
          </div>
          <input type="text" name="nome_aluno" class="form-control" aria-label="Default" autofocus aria-describedby="inputGroup-sizing-default">
        </div>
          <input type="submit" name="verificar" class="btn btn-primary" value="Avançar" />
         </form>
        </div>
        </div><!-- text-center -->
    </div><!-- col-sm -->
   <? } ?>
   
   
   <? if(@$_GET['aluno'] != ''){ ?>
   
      <?
	   $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE componente = '".$_GET['componente']."' AND turma = '".$_GET['turma']."' AND mes = '".$_GET['mes']."' ORDER BY code_dia_atividade DESC");
	   if(mysqli_num_rows($sql_atividade) == ''){
		   echo "<div class='alert alert-danger' role='alert'>O professor não lançou atividade no mês selecionado!</div>";
	   }else{
	  ?>
   <table class="table table-striped">
      <thead>
        <tr>
          <th width="62" scope="col">Atividade</th>
          <th width="74" scope="col">Status</th>
          <th width="50" scope="col"></th>
        </tr>
      </thead>
      <tbody>
	  <? while($res_atividade = mysqli_fetch_array($sql_atividade)){ ?>
        <tr>
          <td><? echo $res_atividade['dia']; ?>/<? echo $res_atividade['mes']; ?>/<? echo $res_atividade['ano']; ?></td>
          <td>
          <?
		  $sql_busca_atividade = 0;
		  
		  if($res_atividade['tipo_envio'] == 'arquivo'){
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividade['code_atividade']."' AND code_aluno = '".$_GET['aluno']."' AND data != ''");
		  }elseif($res_atividade['tipo_envio'] == 'varios'){
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividade['code_atividade']."' AND code_aluno = '".$_GET['aluno']."' AND data != ''");
		  }else{
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividade['code_atividade']."' AND aluno = '".$_GET['aluno']."'");
		  }
		   
		   
		   if(mysqli_num_rows($sql_busca_atividade) == ''){
           		echo "<img src='professor/img/errado_atividade.png' width='25' height='25' />";
		   }else{
			   
			   $corrigido = 0;
			   
			    while($res = mysqli_fetch_array($sql_busca_atividade)){
					 if($res['status'] == 'CORRIGIDO'){
						 $corrigido = 1;
					}
				}
			    
				if($corrigido == 1){
           			echo "<img src='professor/img/correto_atividade.png' width='25' height='25' />";
				}else{
           			echo "<img src='img/correto_amarelo.png' width='30' height='30' />";					
				}
				
				
		   } ?>          
          </td>
          <td>
          <?  if(mysqli_num_rows($sql_busca_atividade) == ''){ ?>
          <a href="index.php?p=2&turma=<? echo $_GET['turma']; ?>&origem=mostrar_atividades&ik=<? echo base64_encode($res_atividade['id']); ?>&aluno=<? echo $_GET['aluno']; ?>&disciplina=" class="btn btn-danger">Entregar</a>
          <? }else{ 
		  
		  	$corrigido = 0;
			           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividade['code_atividade']."' AND code_aluno = '".$_GET['aluno']."' AND data != ''");

			   
			    while($res = mysqli_fetch_array($sql_busca_atividade)){
					 if($res['status'] == 'CORRIGIDO'){
						 $corrigido = 1;
					}
				}
		  
		  ?>
              <a href="index.php?p=2&turma=<? echo $_GET['turma']; ?>&origem=mostrar_atividades&ik=<? echo base64_encode($res_atividade['id']); ?>&aluno=<? echo $_GET['aluno']; ?>&disciplina=" <? if($corrigido == 1){ ?> class="btn btn-success"> <? }else{  ?> class="btn btn-warning">  <? } ?>Verificar</a>
                  
          <? } ?> 
          </td>
        </tr>
      <? } ?>
      </tbody>
    </table>  	     
    <? } ?>
  </div><!-- row -->
    <div class="p-3 mb-2 bg-info text-white"><em>*Em caso de erro procure seu professor.</em></div>
    
 <? } ?>   
    
<? } ?>
</div><!-- container -->
</body>
</html>