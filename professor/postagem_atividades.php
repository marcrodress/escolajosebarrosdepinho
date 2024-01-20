<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
body table{
	font:13px Arial, Helvetica, sans-serif;
	}
#container_tuod{
	background:#FFF;
}
</style>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>

<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm"><p></p>
        <p class="h5 text-primary"><strong>Atividades</strong></p>
  		  <table border="0" class="table">
           <thead class="thead-dark">
              <tr>
                <th  bgcolor="#669999"><strong>SELECIONE O ANO:</strong></th >
                <th  bgcolor="#669999"><strong>SELECIONE O COMPONENTE:</strong></th >
                <th  bgcolor="#669999">SELECIONE O M&Ecirc;S</th >
              </tr>
           </thead>
              <tr>
                <td><form name="form" id="form">
           <form name="form" id="form">
            <select class="form-control" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
              <option>Selecione a turma</option>
             <?
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
			 ?>
              <option value="?p=postagem_atividades&ano=<? echo $res_turmas['code_turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>"><? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; ?></option>
              <? } ?>
            </select>
          </form>
                </form></td>
                <td><select name="jumpMenu2" class="form-control" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
                    <option>Selecione</option>
				    <?
					 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas");
					  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
					?>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $res_disciplinas['code']; ?>&mes=<? echo $_GET['mes']; ?>"><? echo $res_disciplinas['componente']; ?></option>
                  	<? } ?>
               </select></td>
                <td><select name="jumpMenu2" size="1" class="form-control" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
                  <option value=""></option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=01">JANEIRO</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=02">FEVEREIRO</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=03">MAR&Ccedil;O</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=04">ABRIL</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=05">MAIO</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=06">JUNHO</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=07">JULHO</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=08">AGOSTO</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=09">SETEMBRO</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=10">OUTUBRO</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=11">NOVEMBRO</option>
                  <option value="?p=postagem_atividades&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&mes=12">DEZEMBRO</option>
				    <?
					 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas");
					  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
					?>
                  	<? } ?>
               </select></td>
              </tr>
  		  </table>
          
          <table class="table table-striped" style="border-radius:2px; border:1px solid #039;">
          <thead class="thead-dark">
            <tr>
              <th colspan="10" align="center" bgcolor="#006699" scope="col"><strong>
                <? 
			  $turma = $_GET['ano'];
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){ $fase = $res_turmas['fase'];
              ?>
                <? echo $res_turmas['code_serie']; ?><strong>&deg; ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; } ?> </strong>- ATIVIDADES DO M&Ecirc;S DE <?
                 
				 if($_GET['mes'] == '01'){
					 echo "JANEIRO";
				 }elseif($_GET['mes'] == '02'){					 
					 echo "FEVEREIRO";
				 }elseif($_GET['mes'] == '03'){					 
					 echo "MARÇO";
				 }elseif($_GET['mes'] == '04'){					 
					 echo "ABRIL";
				 }elseif($_GET['mes'] == '05'){					 
					 echo "MAIO";
				 }elseif($_GET['mes'] == '06'){					 
					 echo "JUNHO";
				 }elseif($_GET['mes'] == '07'){					 
					 echo "JULHO";
				 }elseif($_GET['mes'] == '08'){					 
					 echo "AGOSTO";
				 }elseif($_GET['mes'] == '09'){					 
					 echo "SETEMBRO";					 					 					 					 					 					 				 }elseif($_GET['mes'] == '10'){					 
					 echo "OUTUBRO";					 					 					 					 					 					 				 }elseif($_GET['mes'] == '11'){					 
					 echo "NOVEMBRO";
				 }else{
					 echo "DEZEMBRO";
				 }
				
				?></strong>
              <script type="text/javascript">
				function MM_jumpMenu(targ,selObj,restore){ //v3.0
				  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
				  if (restore) selObj.selectedIndex=0;
				}
			   </script></th>
            </tr>
          </thead>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">PROFESSOR.</th>
              <th scope="col">OBJETIVO</th>
              <th scope="col">ENTREGA</th>
              <th scope="col">TOTAL</th>
              <th scope="col">ENTREGUE</th>
              <th scope="col">FALTA</th>
              <th scope="col">FREQU&Ecirc;NCIA</th>
              <th scope="col" align="right">              
              <a href="pdf/relatorio_atividade.php?turma=<? echo $_GET['ano']; ?>&componente=<? echo @$_GET['componente']; ?>&operador=<? echo $operador; ?>&mes=<? echo $_GET['mes']; ?>" target="_blank"><img src="img/impressora.jfif" alt="" width="23" height="23" border="0" title="Imprimir relatório" /></a>
              
              <a style="float:right;" href="pdf/relatorio_atividade_aluno.php?turma=<? echo $_GET['ano']; ?>&componente=<? echo @$_GET['componente']; ?>&operador=<? echo $operador; ?>&mes=<? echo $_GET['mes']; ?>" target="_blank"><img src="img/impressora2.png" alt="" width="23" height="23" border="0" title="Imprimir relatório por aluno" /></a>
              
              </th>
            </tr>
          </thead>
          <?
          $i = 0;
		   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '".$_GET['mes']."' AND turma = '".$_GET['ano']."' AND componente = '".$_GET['componente']."'");
		   if(mysqli_num_rows($sql_atividades) == ''){
			   echo "<div class='alert alert-danger' role='alert'>Ainda não foi postado atividades no mês informado!</div>";
		   }else{
		  ?>
          <tbody>
          <? while($res_atividades = mysqli_fetch_array($sql_atividades)){ $i++;?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? 
				$usuario = $res_atividades['usuario'];
				$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$usuario'");
				 while($res_professor = mysqli_fetch_array($sql_professor)){
					 $sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_professor['cpf']."'");
						while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
							echo $res_colaborador['nome'];
				 	   }
				}
			  
			  
			   ?></td>
              <td><? $objetivo = $res_atividades['objetivo']; 
			  	
				for($i=0; $i<=40; $i++){
					echo $objetivo[$i];
				}
			  	
			  ?>...</td>
              <td><? echo $res_atividades['dia']; ?>/<? echo $res_atividades['mes']; ?>/<? echo $res_atividades['ano']; ?></td>
              
              <td><?
			  echo $total_alunos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['ano']."' AND impresso != 'SIM' AND transferido != 'SIM'"));
			  ?></td>
              
              
              <td><? $conta_alunos = 0;
			  $total_alunos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['ano']."' AND impresso != 'SIM' AND transferido != 'SIM'"));
               if($res_atividades['tipo_envio'] == 'arquivo'){
				   $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
				   while($res_enviados = mysqli_fetch_array($enviados)){
					 $verifica_impresso = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res_enviados['code_aluno']."' AND turma = '".$_GET['ano']."'");
						 while($res_alunos = mysqli_fetch_array($verifica_impresso)){
						   if($res_alunos['impresso'] != 'SIM' || $res_alunos['transferido'] != 'SIM'){
							$conta_alunos++;
						}
					  }
				  }
			
			
			
			
		  }elseif($res_atividades['tipo_envio'] == 'multipla'){ 
					$verifica_aluno = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['ano']."' AND impresso != 'SIM' AND transferido != 'SIM'");
					 while($res_alunos = mysqli_fetch_array($verifica_aluno)){
						$sql_atividade_aluno = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."'");
						if(mysqli_num_rows($sql_atividade_aluno) >= 1){  
							$conta_alunos++;
					 	}
						 
					}
			   }				  
				  
				  
			   echo $conta_alunos;
			  ?>&nbsp;</td>
              <td><? 
			  echo $total_alunos-($conta_alunos);?></td>
              <td><? echo number_format(($conta_alunos*100)/$total_alunos,1); ?>%</td>
              <td><a rel="superbox[iframe][400x500]" href="../?p=2&turma=<? echo $_GET['ano']; ?>&ik=<? echo base64_encode($res_atividades['id']); ?>&aluno=<?
              	
				$alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['ano']."' LIMIT 1");
				   while($res_alunos = mysqli_fetch_array($alunos)){
					   echo $res_alunos['aluno'];
				  }
			  
              ?>&disciplina=<? echo $_GET['componente']; ?>"><img src="img/visualizar.png" width="20" height="20" border="0" title="Visualizar atividade" /></a>
              <? if($fase == 'ANOS FINAIS'){ ?>
              <a target="_blank" href="pdf/imprimir_plano_de_aula.php?componente=<? echo $res_atividades['componente']; ?>&turma=<? echo $_GET['ano']; ?>&professor=<? echo $res_atividades['usuario']; ?>&tipo=arquivo&ik=<? echo base64_encode($res_atividades['id']); ?>"><img src="../img/plano_de_aula.png" width="20" height="20" border="0" title="Plano de aula" /></a>  
			  <? } ?>
              
              <? if($fase == 'ANOS INICIAS'){ ?>
              <a target="_blank" href="pdf/imprimir_plano_de_aula_iniciais.php?componente=<? echo $res_atividades['componente']; ?>&turma=<? echo $_GET['ano']; ?>&professor=<? echo $res_atividades['usuario']; ?>&tipo=arquivo&ik=<? echo base64_encode($res_atividades['id']); ?>"><img src="../img/plano_de_aula.png" width="20" height="20" border="0" title="Plano de aula" /></a>  
			  <? } ?>
              
                              

              <a rel="superbox[iframe][250x120]" href="scripts/link_atividade.php?ik=<? echo base64_encode($res_atividades['id']); ?>"><img src="img/link.png" width="20" height="20" border="0" title="Link da atividade" /></a>
                            
              </td>
            </tr>
            <? }} ?>
          </tbody>
		</table>
          
          
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>