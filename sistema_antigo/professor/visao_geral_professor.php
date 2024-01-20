<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
#container_tuod{
	background:#FFF;
}
</style>
</head>

<body>

<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <p class="h4 text-black">Visão geral de professor</p>
        </div><!-- col-sm -->
      </div><!-- row -->
      
      <hr />
      
      <? $turma = 0;
		$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$_GET['code']."'");
	     while($res_professor = mysqli_fetch_array($sql_professor)){ 
	  ?>
      <div class="row">
        <div class="col-1">
          <img style="border:3px solid #000; border-radius:10px;" src="http://mod1.ecommerce10.com.br/images/semimagem.png" width="100" height="100" />
        </div>
        <div class="col">
          <h2 style="margin:-10px 0 0 10px;"><strong><? echo strtoupper($res_professor['nome_escola']); ?></strong></h2>

          <h5 style="margin:0 0 0 10px; color:#0C0;" class="text-primary"><strong style="color:#F00; font:20px Arial, Helvetica, sans-serif;"><strong>Score: <?
          	$creditos = 0;
			$debitos = 0;
			$sql_score = mysqli_query($conexao_bd, "SELECT * FROM score WHERE professor = '".$_GET['code']."'");
			 while($res_score = mysqli_fetch_array($sql_score)){
				 if($res_score['tipo'] == 'DEBITO'){
					 $debitos = $debitos+$res_score['pontuacao'];
				 }else{
					 $creditos = $creditos+$res_score['pontuacao'];
				}
			}
		  	
			$score = $creditos-$debitos;
			
			if($score <= 100){
				echo "100";
			}else{
				echo $score;
			}
			
		  ?></strong></strong><br /></h5>
          <h5 style="margin:0 0 0 10px;" class="text-primary">Pendencias geradas: 
		   <? 
			$sql_pendencias = mysqli_query($conexao_bd, "SELECT * FROM pendencia_professores WHERE professor = '".$_GET['code']."'");
			$conta_pendencias = mysqli_num_rows($sql_pendencias);
		  	echo $conta_pendencias;
		   ?>   
           Resolvidas:
		   <? 
			$sql_pendencias_resolvidas = mysqli_query($conexao_bd, "SELECT * FROM pendencia_professores WHERE professor = '".$_GET['code']."' AND status = 'RESOLVIDO'");
			$conta_pendencias_resolvidas = mysqli_num_rows($sql_pendencias_resolvidas);
		  	echo $conta_pendencias_resolvidas;
		   ?>            
            - <strong><? echo number_format($conta_pendencias_resolvidas*100/$conta_pendencias); ?>%</strong></h5>
          <h5 style="margin:0 0 0 10px;" class="text-primary">Turmas na escola: <? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE professor = '".$_GET['code']."'")); ?></h5>
        </div>
      </div><!-- row -->
      <? } ?>
      <hr />
  
  
      <div class="row">
        <div class="col-sm">
          <p class="h5 text-black"><strong style="color:#F00;"><strong>Disciplinas</strong></strong></p>
        </div><!-- col-sm -->
        
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">COD.</th>
              <th scope="col">Componente</th>
              <th scope="col">Série</th>
              <th scope="col">Turma</th>
              <th scope="col">Turno</th>
              <th scope="col">N° alunos</th>
              <th scope="col">Laudo</th>
              <th scope="col">Impresso</th>
              <th scope="col">Pendencias</th>
              <th scope="col">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0; $nome_escola = 0; $componente = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE professor = '".$_GET['code']."'");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		   
				  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res['turma']."'");
				   while($res_escola = mysqli_fetch_array($sql_escola)){
						
					   $sql_nome_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['disciplina']."'");
				   		while($res_nome_componente = mysqli_fetch_array($sql_nome_componente)){
							$componente = $res_nome_componente['componente'];
						}
						
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['turma']; ?></td>
              <td><? echo $componente; ?></td>
              <td><? echo $res_escola['code_serie']; ?>° ano</td>
              <td><? echo $res_escola['tipo_turma']; ?></td>
              <td><? echo $res_escola['turno']; ?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['turma']."'"));?></td>
              <td >&nbsp;</td>
              <td >&nbsp;</td>
              <td>&nbsp;</td>
              <td><a rel="superbox[iframe][200x100]" href="scripts/mes_atividades.php?componente=<? echo $res['disciplina']; ?>&operador=<? echo $_GET['code']; ?>&turma=<? echo $res['turma']; ?>"><img src="../img/ACESSOS.png" width="20" height="20" border="0" title="Verificar atividades do professor" /></a></td>
            </tr>
            <? if(@$_GET['acao'] == 'mostrar' && $_GET['turma'] == $res['turma']){ ?>
           <? } ?>
            
            
         <? }} ?>
        </table>
        
      </div><!-- row -->
  
  
  <hr />
      <div class="row">
        <div class="col-sm">
          <p class="h5 text-black"><strong style="color:#F00;"><strong>Últimas buscas ativas</strong></strong></p>
          
          <a rel="superbox[iframe][500x150]" href="filtrar_professor.php?professor=<? echo $_GET['code']; ?>"><img style="float:right; margin:-50px 0 20px 0;" src="../img/filtrar.png" title="Aplicar filtros" width="50" height="48" /></a>
          
        </div><!-- col-sm -->
        
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Data.</th>
              <th scope="col">IP</th>
              <th scope="col">Aluno</th>
              <th scope="col">Turma</th>
              <th scope="col">Componente</th>
              <th scope="col">Atividade</th>
              <th scope="col">Forma de contato</th>
              <th scope="col">Anexo</th>
              <th scope="col">Feedback</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0; $nome_escola = 0; $componente = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE professor = '".$_GET['code']."' ORDER BY id DESC");
		 
		   while($res = mysqli_fetch_array($sql)){ $i++;
		   
		   	  $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res['aluno']."'");
				 while($res_aluno = mysqli_fetch_array($sql_aluno)){ 
					 
				  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_aluno['turma']."'");
				   while($res_escola = mysqli_fetch_array($sql_escola)){ 
						
					   $sql_nome_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['componente']."' OR componente = '".$res['componente']."'");
				   		while($res_nome_componente = mysqli_fetch_array($sql_nome_componente)){ 
							$componente = $res_nome_componente['componente'];
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['data_hora']; ?></td>
              <td><? echo $res['ip']; ?></td>
              <td><a href="?p=visao_geral_de_alunos&aluno=<? echo $res_aluno['code_aluno']; ?>"><? echo $res_aluno['nome_aluno']; ?></a></td>
              <td><? echo $res_escola['code_serie']; ?>° ano - <? echo $res_escola['tipo_turma']; ?></td>
              <td><? echo $componente; ?></td>
              <td><? echo $res['atividade']; ?></td>
              <td><? echo $res['forma_contato']; ?></td>
              <td><a href="arquivos/<? echo $res['anexos']; ?>"><? echo $res['anexos']; ?></a></td>
              <td><? echo $res['feedback']; ?></td>
            </tr>
         <? }}}} ?>
        </table>
        
      </div><!-- row -->  
      
      
  
  
  
      <div class="row">
        <div class="col-sm">
          <p class="h5 text-black"><strong style="color:#F00;"><strong>Últimas acessos</strong></strong></p>
        </div><!-- col-sm -->
        
        <table class="table table-striped">
          <thead>
            <tr>
              <th width="17" scope="col">#</th>
              <th width="135" scope="col">Data.</th>
              <th width="99" scope="col">IP</th>
              <th width="304" scope="col">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0; $nome_escola = 0; $componente = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM conta_acessos WHERE usuario = '".$_GET['code']."' ORDER BY id DESC LIMIT 50");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['data_completa']; ?></td>
              <td><? echo $res['ip']; ?></td>
              <td>&nbsp;</td>
            </tr>
         <? } ?>
        </table>
        
      </div><!-- row -->        
        
      
      
  
  
  
      <div class="row">
        <div class="col-sm">
          <p class="h5 text-black"><strong style="color:#F00;"><strong>Últimas ações do professor</strong></strong></p>
        </div><!-- col-sm -->
        
        <table class="table table-striped">
          <thead>
            <tr>
              <th width="17" scope="col">#</th>
              <th width="135" scope="col">Data.</th>
              <th width="99" scope="col">IP</th>
              <th width="304" scope="col">Ação;</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0; $nome_escola = 0; $componente = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM acao_professor WHERE usuario = '".$_GET['code']."' ORDER BY id DESC LIMIT 50");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['data_completa']; ?></td>
              <td><? echo $res['ip']; ?></td>
              <td><? echo $res['acao']; ?></td>
            </tr>
         <? } ?>
        </table>
        
      </div><!-- row -->       
  
  
  
      <div class="row">
        <div class="col-sm">
          <p class="h5 text-black"><strong style="color:#F00;"><strong>Últimas páginas visitadas</strong></strong></p>
        </div><!-- col-sm -->
        
        <table class="table table-striped">
          <thead>
            <tr>
              <th width="17" scope="col">#</th>
              <th width="132" scope="col">Data.</th>
              <th width="31" scope="col">IP</th>
              <th width="346" scope="col">URL acessada</th>
              <th width="27" scope="col">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0; $nome_escola = 0; $componente = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM grava_url WHERE usuario = '".$_GET['code']."' ORDER BY id DESC LIMIT 50");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['data_completa']; ?></td>
              <td><? echo $res['ip']; ?></td>
              <td><? 
			  	$url_gerada = $res['url'];
				
				for($k=0; $k<90; $k++){
					echo $url_gerada[$k];
				}
			  
			  ?>...</td>
              <td><a rel="superbox[iframe][900x150]" href="scripts/mostrar_url.php?data_hora=<? echo $res['data_completa']; ?>&url=<? echo base64_encode($url_gerada); ?>"><img src="img/olho_vizua.png" width="20" height="20" border="0" title="Visualizar url completa" /></a></td>
            </tr>
         <? } ?>
        </table>
        
      </div><!-- row -->        
  
  </div>
    <!-- container -->
</div><!-- container_tuod -->
</body>
</html>
