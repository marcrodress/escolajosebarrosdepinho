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
        <a style="margin:5px 0 0 0;" href="scripts/cadastrar_turma.php" rel="superbox[iframe][340x300]" class="btn btn-success">Cadastrar turma</a>
        <a style="margin:5px 0 0 0;" href="scripts/cadastrar_aluno.php" rel="superbox[iframe][340x230]" class="btn btn-info">Cadastrar aluno</a>
        <hr />
        <p class="h4 text-primary">Turmas cadastradas</p>
        <? if(@$_GET['acao'] == 'excluir'){
        
		echo "<div class='p-3 mb-2 bg-info text-white'>Escola excluída com sucesso! Aguarde..</div>";
		
		$escola = $_GET['escola'];
		
		mysqli_query($conexao_bd, "DELETE FROM escolas WHERE code_escola = '$escola'");
		
		?>
		
		  <script type="text/javascript">
              function redirectTime(){
                 window.location = "?p=escolas"
              }
           </script>
           <body onLoad="setTimeout('redirectTime()', 3000)">
		
		
		<? }?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">COD.</th>
              <th scope="col">Escola</th>
              <th scope="col">Componente</th>
              <th scope="col">Série</th>
              <th scope="col">Turma</th>
              <th scope="col">Turno</th>
              <th scope="col">N° alunos</th>
              <th scope="col">Opções</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE usuario = '$operador'");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['code_turma']; ?></td>
              <td><? 
				  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM escolas WHERE code_escola = '".$res['code_escola']."'");
				   while($res_escola = mysqli_fetch_array($sql_escola)){
					   echo $res_escola['nome_escola'];
				   }
			  ?></td>
              <td><? echo $res['componente']; ?></td>
              <td><? echo $res['code_serie']; ?>° ano</td>
              <td><? echo $res['tipo_turma']; ?></td>
              <td><? echo $res['turno']; ?></td>
              <td >56</td>
              <td>
              
              <script language=javascript>
				function confirmacao(){
				 if (confirm("Se confirmar, tudo relativo a essa escola será excluída. Você tem certeza?"))
				  window.location='?p=escolas&acao=excluir&escola=<? echo $res['code_escola']; ?>';
				}
				</script>
              
              <a onclick="return confirmacao();"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="20" height="20" title="Excluir" /></a>

              <a href="scripts/transferir_alunos.php?turma=<? echo $res['code_turma']; ?>" rel="superbox[iframe][350x150]"> <img src="img/transferir.png" width="20" height="20" border="0" title="Transferir alunos dessa turma para outra" /></a>

              
              <a href="?p=turmas&turma=<? echo $res['code_turma']; ?>&acao=mostrar"> <img src="img/verificar_alunos.jpg" width="25" height="25" border="0" title="Verificar alunos" /></a>
              
              
              </td>
            </tr>
            <? if(@$_GET['acao'] == 'mostrar' && $_GET['turma'] == $res['code_turma']){ ?>

            
            <tr>
              <th colspan="9" align="center" bgcolor="#00CCFF" scope="row">HIST&Oacute;RICO DE ALUNOS DESSA TURMA</th>
            </tr>
            <tr>
              <th colspan="9" scope="row">
              <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th align="center" scope="col">N° da chamada</th>
                  <th scope="col">Cod. Aluno</th>
                  <th scope="col">Turma</th>
                  <th scope="col">Nome do aluno</th>
                  <th scope="col">Frequência</th>
                  <th scope="col">Desempenho</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>
              <?
			   $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."'");
			   while($res_alunos = mysqli_fetch_array($sql_alunos)){
			  ?>
                <tr>
                  <th align="center" scope="row"><? echo $res_alunos['n_chamada']; ?></th>
                  <td><? echo $res_alunos['code_aluno']; ?></td>
                  <td><? echo $res_alunos['turma']; ?></td>
                  <td><? echo $res_alunos['nome_aluno']; ?></td>
                  <td>77%</td>
                  <td>5</td>
                  
                <script language=javascript>
				function confirmacaoo(){
				 if (confirm("Se confirmar, tudo relativo a esse aluno será excluída e não será possível recuperar. Você tem certeza?"))
				  window.location='?p=turmas&turma=<? echo $_GET['turma'];  ?>&acao=excluir_aluno&id=<? echo $res_alunos['id']; ?>';
				}
				</script>     
                  
                  <td><a onclick="return confirmacaoo();"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" alt="" width="20" height="20" title="Excluir aluno dessa turma" /></a>
                  
                  <img src="img/boletim.png" width="20" title="Emitir boletim do aluno" height="20" /></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
                          </th>
            </tr>
           <? } ?>
            
            
         <? } ?>
        </table>
        
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
            
            
            <? if(@$_GET['acao'] == 'excluir_aluno'){
              $turma = $_GET['turma'];
			  mysqli_query($conexao_bd, "DELETE FROM alunos WHERE id = '".$_GET['id']."'");
			  
			  echo "<script language='javascript'>window.location='?p=turmas&turma=$turma&acao=mostrar';</script>";
			 
			}?>