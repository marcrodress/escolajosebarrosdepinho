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
      <div class="row">
       <h5><strong>COMUNIDADE ATENDIDAS</strong></h5>
       <? if($_GET['k'] == ''){ ?>       
       <a href="?p=cadastrar_transportes&k=cad" class="btn btn-success" style="width:200px; margin:10px;"><strong>Cadastrar nova comunidade</strong></a>
       <? } ?>
       
       
       
       <? if($_GET['k'] == 'cad'){ ?>
	   <form name="" method="post" action="" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Digite o nome da comunidade" /> <input type="submit" name="cad" value="Cadastrar" />
       </form>
        
        <? if(isset($_POST['cad'])){
        
		 $nome = strtoupper($_POST['nome']);
		 if($nome == ''){
		 	echo "<script language='javascript'>window.alert('Digite o nome da rota!');</script>";
		 }else{
			 
			 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM rotas_escolares WHERE rota = '$nome'");
			 if(mysqli_num_rows($sql_verifica)>=1){
				echo "<script language='javascript'>window.alert('Rota já cadastrada!');</script>";
			 }else{
				 $code_rota = rand();
				 mysqli_query($conexao_bd, "INSERT INTO rotas_escolares (code, rota) VALUES ('$code_rota', '$nome')");
					echo "<script language='javascript'>window.alert('Rota cadastrada com sucesso!');window.location='';</script>";
			 }
		 }
	   }?>
       
       
       <? } ?>
	
    	<br /><br />
        <table class="table table-striped" width="800" border="1">
          <tr>
            <td width="70" align="center"><strong>COD.</strong></td>
            <td width="154" align="center"><strong>COMUNIDADE</strong></td>
            <td width="99" align="center"><strong>ROTA</strong></td>
            <td width="135" align="center"><strong>QUANT. ALUNOS</strong></td>
            <td width="121" align="center"><strong>TRANSPORTE</strong></td>
            <td width="78" align="center"><strong>MANH&Atilde;</strong></td>
            <td width="60" align="center"><strong>TARDE</strong></td>
            <td width="31" align="center"><img src="img/impressora2.png" width="25" height="25" /></td>
          </tr>
          <?
           $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM rotas_escolares");
		   while($res = mysqli_fetch_array($sql_verifica)){
		  ?>
          <tr>
            <td align="center"><? echo $res['code']; ?></td>
            <td align="center"><? echo $res['rota']; ?></td>
            <td align="center"><? 
					$sql_rota_escola = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar_comunidades WHERE comunidade = '".$res['code']."'"); 
					 while($res_escola = mysqli_fetch_array($sql_rota_escola)){
						 
						 $sql_rota = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar WHERE code = '".$res_escola['rota']."'");
						  while($res_rota = mysqli_fetch_array($sql_rota)){
							  echo $res_rota['rota'];
						 }
						 
					}
				
				
				?>
                </td>
            <td align="center"><a target="_blank" href="pdf/alunos_comunidade.php?localidade=<? echo $res['code']; ?>"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE localidade = '".$res['code']."'")); ?></a></td>
            <td align="center"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE localidade = '".$res['code']."' AND transporte_escolar = 'SIM'")); ?></td>
            <td align="center"><? $manha = 0;
					$alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE localidade = '".$res['comunidade']."' AND transporte_escolar = 'SIM'");
					 while($res_aluno = mysqli_fetch_array($alunos)){
						$sql_turmas_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res_aluno['code_aluno']."'");
						  while($res_turmas = mysqli_fetch_array($sql_turmas_alunos)){
							  $sql_turma_horario = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_turmas['turma']."' AND turno = 'MANHÃ'");
							  if(mysqli_num_rows($sql_turma_horario) >= 1){ $manha++;
							  }
						}
					}				
				echo $manha;
			?></td>
            
            <script language="Javascript">
			function confirmacao(id) {
				 var resposta = confirm("Deseja remover esta localidade?");
				 if (resposta == true) {
					  window.location.href = "?p=cadastrar_transportes&acao=excluir&id="+id;
				 }
			}
			</script>
            
            <td align="center">&nbsp;</td>
            <td align="center">
            <a href="javascript:func()"
onclick="confirmacao('<? echo $res['id']; ?>')"><img src="img/deleta.jpg" width="20" title="Deletar comunidade" height="20" border="0" /></a>
           </td>
          </tr>
          <? } ?>
        </table>
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
<? if($_GET['acao'] == 'excluir'){

mysqli_query($conexao_bd, "DELETE FROM rotas_escolares WHERE id = '".$_GET['id']."'");
echo "<script language='javascript'>window.location='?p=cadastrar_transportes';</script>";

}?>