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
        <p class="h5 text-primary"><strong>Planos de aula aguardando visto - ANOS FINAIS</strong></p>
        <hr />
        
        <table border="0" class="table">
           <thead class="thead-dark">
              <tr>
                <th  bgcolor="#669999"><strong>SELECIONE O ANO:</strong></th >
              </tr>
           </thead>
              <tr>
                <td><form name="form" id="form">
                  <form name="form" id="form">
                    <select class="form-control" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
                      <option>Selecione a turma</option>
                      <?
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE coordenador = '$operador'");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
			 ?>
                      <option value="?p=plano_de_aula_pendente&ano=<? echo $res_turmas['code_turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>"><? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; ?></option>
                      <? } ?>
                    </select>
                  </form>
                </form></td>
              </tr>
  		  </table>
  	
    	  <?
		   $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula WHERE turma = '".$_GET['ano']."' AND status_coordenacao = 'AGUARDA'");
		   
		  	if(mysqli_num_rows($sql_verifica) == ''){
				echo "<div class='p-3 mb-2 bg-info text-white'>Não existe planos para serem avaliada!</div>";
			}else{
		   ?>
            <table width="1000" class="table table-bordered table-striped" border="1">
              <thead class="thead-dark">
                <tr>
                  <th colspan="10" align="center" bgcolor="#006699" scope="col"><strong>
                    <? 
                  $turma = $_GET['ano'];
                  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
                   while($res_turmas = mysqli_fetch_array($sql_turmas)){
                  ?>
                    <? echo $res_turmas['code_serie']; ?><strong>&deg; ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; } ?></strong></strong>
                  <script type="text/javascript">
                    function MM_jumpMenu(targ,selObj,restore){ //v3.0
                      eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
                      if (restore) selObj.selectedIndex=0;
                    }
                   </script></th>
                </tr>
              </thead>            
              <tr>
                <td width="100" bgcolor="#999999" align="center"><strong>DATA DA AULA</strong></td>
                <td width="111" bgcolor="#999999" align="center"><strong>COMPOENTE</strong></td>
                <td width="99" bgcolor="#999999" align="center"><strong>HABILIDADE</strong></td>
                <td width="247" bgcolor="#999999" align="left"><strong>DOCENTE</strong></td>
                <td width="311" bgcolor="#999999" align="left"><strong>OBJETIVO</strong></td>
                <td width="92" bgcolor="#999999" align="center">&nbsp;</td>
              </tr>
              <? while($res_plano_final = mysqli_fetch_array($sql_verifica)){ ?>
              <tr>
                <td align="center"><? 
					$componente = 0;
					$professor = 0;
					$ik = 0;
					$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".$res_plano_final['id_aula']."'");
					if(mysqli_num_rows($sql_atividade) == ''){
						mysqli_query($conexao_bd, "DELETE FROM plano_de_aula WHERE id_aula = '".$res_plano_final['id_aula']."'");
						echo "<script language='javascript'>window.location='';</script>";
					}else{
					 while($res_atividade = mysqli_fetch_array($sql_atividade)){
						 
							$componente = $res_atividade['componente'];
							$professor = $res_atividade['usuario'];
							$ik = base64_encode($res_atividade['id']);
						 
						 $sql_data = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_atividade['code_dia_atividade']."'");
						 while($res_data = mysqli_fetch_array($sql_data)){
							echo $res_data['vencimento'];
	
				 ?></td>
                <td align="center">
                <?
					$sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_atividade['componente']."'");
					 while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
						 echo $res_disciplinas['componente'];
					}
				?>
                </td>
                <td align="center"><? echo $res_plano_final['habilidade']; ?></td>
                <td align="left">
                <?
					$sql_acesso_sistema = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_atividade['usuario']."'");
					 while($res_acesso_sistema = mysqli_fetch_array($sql_acesso_sistema)){
					
					  $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_acesso_sistema['cpf']."'");
					    while($res_coladorares = mysqli_fetch_array($sql_coladorares)){						
						
						 echo strtoupper($res_coladorares['nome']);
					}
					 }
				?>                
                </td>
                <? }}} ?>
                <td align="left"><? echo strtoupper($res_plano_final['objetivo']); ?></td>
                <td align="center">
               
                <a onclick="confirm('Sua assinatura digital aparecerá ao final deste plano, deseja continuar?')" href="?p=plano_de_aula_pendente&id=<? echo $res_plano_final['id']; ?>&acao=visto&turma=<? echo $res_plano_final['turma']; ?>" ><img src="img/CORRETO.png" width="25" height="25" title="Confirmar visto neste plano?" /></a> 
                
                <a rel="superbox[iframe][405x250]" href="scripts/rejeitar_plano_final.php?id=<? echo $res_plano_final['id']; ?>"><img src="img/errado_atividade.png" width="20" height="20" border="0" title="Rejeitar " /></a>
                
                
                <a target="_blank" href="pdf/imprimir_plano_de_aula.php?componente=<? echo $componente; ?>&turma=<? echo $_GET['ano']; ?>&professor=<? echo $professor; ?>&tipo=arquivo&ik=<? echo $ik; ?>"><img src="img/impressora2.png" width="20" height="20" border="0" /></a>
                
                </td>
              </tr>
              <? } ?>
            </table>
		   <? } ?>
          </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
<? if(@$_GET['acao'] == 'visto'){
	
	mysqli_query($conexao_bd, "UPDATE plano_de_aula SET status_coordenacao = 'VISTO' WHERE id = '".$_GET['id']."'");
	
	$turma = $_GET['turma'];
		
	echo "<script language='javascript'>window.location='?p=plano_de_aula_pendente&ano=$turma';</script>";

}?>