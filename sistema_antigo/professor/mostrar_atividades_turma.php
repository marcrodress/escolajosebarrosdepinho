<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="jquery.superbox.css" type="text/css" media="all" />
<link href="../img/index.png" rel="shortcut icon" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informa��es. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>
<style>
#container_tuod{
	background:#FFF;
}
</style>
</head>

<body>
<? mysqli_query($conexao_bd, "DELETE FROM atividades WHERE usuario = '$operador' AND objetivo = ''"); ?>
<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm">
  		<p class="h5 text-primary"><strong>Atividades da turma</strong></p>
        <a href="scripts/postar_atividade.php?turma=<? echo @$_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&operador=<? echo $operador; ?>" rel="superbox[iframe][600x520]" class="btn btn-large btn-success">Postar nova atividade</a> <hr/>

        <?
				   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	         		while($res_turma = mysqli_fetch_array($sql_turma)){
			  
		?>
        <p class="h6 text-dark">
        <strong>S�RIE:</strong> <? echo $res_turma['code_serie'] ?>� ANO - <strong>TURMA:</strong> <? echo $res_turma['tipo_turma'] ?><strong> - TURNO:</strong> <? echo $res_turma['turno'] ?><strong> - COMPONENTE:</strong> <? 
		
		 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['componente']."'");
		  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
			 echo $componente = $res_disciplinas['componente'];
		  }
		
		?>
        </p>
        <? } ?>        
        <table class="table table-striped">
          <thead>
            <tr>
              <th colspan="9" align="center" bgcolor="#006699" scope="col">ATIVIDADES DO M&Ecirc;S DE JANEIRO
              <script type="text/javascript">
				function MM_jumpMenu(targ,selObj,restore){ //v3.0
				  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
				  if (restore) selObj.selectedIndex=0;
				}
			   </script>
              <form name="" method="post" action="" enctype="multipart/form-data">
              <select size="1" name="mes_filtro" class="form-control" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
                <option value="">ESCOLHER O M�S</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=01">JANEIRO</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=02">FEVEREIRO</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=03">MAR&Ccedil;O</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=04">ABRIL</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=05">MAIO</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=06">JUNHO</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=07">JULHO</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=08">AGOSTO</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=09">SETEMBRO</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=10">OUTUBRO</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=11">NOVEMBRO</option>
                <option value="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=12">DEZEMBRO</option>
              </select>
              </form>
              </th>
            </tr>
          </thead>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">COD.</th>
              <th scope="col">OBJETIVO</th>
              <th scope="col">ENTREGA</th>
              <th scope="col">ENTREGUE</th>
              <th scope="col">FALTA</th>
              <th scope="col">FREQU&Ecirc;NCIA</th>
              <th scope="col" align="right">              
              <a href="pdf/relatorio_atividade.php?turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&operador=<? echo $operador; ?>&mes=<? echo $_GET['mes']; ?>" target="_blank"><img src="img/impressora.jfif" alt="" width="23" height="23" border="0" title="Imprimir relat�rio" /></a>
              
              <a style="float:right;" href="pdf/relatorio_atividade_aluno.php?turma=<? echo $_GET['turma']; ?>&componente=<? echo @$_GET['componente']; ?>&operador=<? echo $operador; ?>&mes=<? echo $_GET['mes']; ?>" target="_blank"><img src="img/impressora2.png" alt="" width="23" height="23" border="0" title="Imprimir relat�rio por aluno" /></a>
              
              </th>
            </tr>
          </thead>
          <?
          $i = 0;
		   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '".$_GET['mes']."' AND turma = '".$_GET['turma']."' AND componente = '".$_GET['componente']."' ORDER BY code_entrega DESC");
		   if(mysqli_num_rows($sql_atividades) == ''){
			   echo "<div class='alert alert-danger' role='alert'>Ainda n�o foi postado atividades no m�s informado!</div>";
		   }else{
		  ?>
          <tbody>
          <? while($res_atividades = mysqli_fetch_array($sql_atividades)){ $i++;?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res_atividades['code_atividade']; ?></td>
              <td><? $objetivo = $res_atividades['objetivo']; 
			  	
				for($i=0; $i<=40; $i++){
					echo $objetivo[$i];
				}
			  	
			  ?>...</td>
              <td><? echo $res_atividades['dia']; ?>/<? echo $res_atividades['mes']; ?>/<? echo $res_atividades['ano']; ?></td>
              <td><? $conta_alunos = 0;
			  $total_alunos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."' AND impresso != 'SIM' AND transferido != 'SIM'"));
               if($res_atividades['tipo_envio'] == 'arquivo'){
				   $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
				   
				   while($res_enviados = mysqli_fetch_array($enviados)){
					   $verifica_impresso = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_enviados['code_aluno']."'");
						 while($res_alunos = mysqli_fetch_array($verifica_impresso)){
							 if($res_alunos['impresso'] == 'SIM' || $res_alunos['transferido'] == 'SIM'){
						}else{
							$conta_alunos++;
						}}
				  }
			   }
			   echo $conta_alunos;
			  ?></td>
              <td><? echo $total_alunos-($conta_alunos);?></td>
              <td><? echo number_format(($conta_alunos*100)/$total_alunos,1); ?>%</td>
              <td>
                
                <a href="excluir/atividade.php?id=<? echo $res_atividades['id']; ?>&componente=<? echo @$_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>&mes=<? echo $_GET['mes']; ?>" rel="superbox[iframe][300x100]"><img src="img/deleta.jpg" width="20" height="20" border="0" title="Excluir" /></a>              
              
              <a rel="superbox[iframe][400x500]" href="../?p=2&turma=<? echo $_GET['turma']; ?>&ik=<? echo base64_encode($res_atividades['id']); ?>&aluno=<?
              	
				$alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."' LIMIT 1");
				   while($res_alunos = mysqli_fetch_array($alunos)){
					   echo $res_alunos['code_aluno'];
				  }
			  
              ?>&disciplina=<? echo $_GET['componente']; ?>"><img src="img/visualizar.png" width="20" height="20" border="0" title="Visualizar atividade" /></a>
              
              <a rel="superbox[iframe][450x200]" href="scripts/transferir_atividade.php?componente=<? echo @$_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>&professor=<? echo $operador; ?>&tipo=<? echo $res_atividades['tipo_envio']; ?>&ik=<? echo base64_encode($res_atividades['id']); ?>"><img src="img/transferir_atividade.png" width="20" height="20" border="0" title="Transferir atividade para outra turma" /></a>
				
              <a rel="superbox[iframe][400x300]" href="upload_plano/?componente=<? echo @$_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>&professor=<? echo $operador; ?>&tipo=<? echo $res_atividades['tipo_envio']; ?>&ik=<? echo base64_encode($res_atividades['id']); ?>">
              <img src="../img/<? if($res_atividades['plano'] == ''){ echo "upload_plano.png"; }else{ echo "upload_plano_feito.png"; }?>" style="border-radius:2px;" width="25" height="20" border="0" title="Fazer upload do plano de aula" />
              </a>


              <a rel="superbox[iframe][250x120]" href="scripts/link_atividade.php?ik=<? echo base64_encode($res_atividades['id']); ?>"><img src="img/link.png" width="20" height="20" border="0" title="Link da atividade" /></a>
              
              <a href="scripts/postar_atividade.php?p=c&code_atividade=<? echo $res_atividades['code_atividade']; ?>&componente=<? echo @$_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>" rel="superbox[iframe][600x520]"><img src="img/edita.png" width="20" height="20" border="0" title="Editar dados dessa atividade" /> </a>
              
              <a href="?p=<? if($res_atividades['tipo_envio'] == 'arquivo'){ echo "fazer_correcao"; }else{ echo "fazer_correcao_multiplica"; }?>&turma=<? echo $_GET['turma']; ?>&tipo_envio=<? echo $res_atividades['tipo_envio']; ?>&componente=<? echo @$_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>&atividade=<? echo $res_atividades['code_atividade']; ?>"><img src="img/correcao.jfif" width="20" height="20" border="0" title="Fazer a corre��o dessa atividade" /></a>
              
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