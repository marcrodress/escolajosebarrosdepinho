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
<? mysqli_query($conexao_bd, "DELETE FROM escolas WHERE usuario = '$operador' AND nome_escola = ''"); ?>

<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm">
        <a style="margin:5px 0 0 0;" href="scripts/cadastrar_escola.php?operador=<? echo $operador; ?>" rel="superbox[iframe][280x100]" class="btn btn-success">Cadastrar escola</a>
        <hr />
        <p class="h4 text-primary">Escola cadastradas</p>
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
              <th scope="col">N° turmas</th>
              <th scope="col">N° alunos</th>
              <th scope="col">Opções </th>
              <th scope="col"><a href="pdf/mod1.php?professor=<? echo $operador; ?>" target="_blank"><img src="img/impressora.jfif" alt="" width="23" height="23" border="0" title="Imprimir relatório" /></a></th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM escolas WHERE usuario = '$operador'");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['code_escola']; ?></td>
              <td><? echo $res['nome_escola']; ?></td>
              <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_escola = '".$res['code_escola']."'")); ?></td>
              <td>
              <?
              
			   $soma_alunos = 0;
			   $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_escola = '".$res['code_escola']."'");
			    while($res_turmas = mysqli_fetch_array($sql_turmas)){
					
					$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res_turmas['code_turma']."'");
					    while($res_aluno = mysqli_fetch_array($sql_alunos)){
						 $soma_alunos++;
						}
					
				}
			  
			   echo $soma_alunos;
			  
			  ?>
              </td>
              <td colspan="2">
                
                  <a href="excluir/escola.php?id=<? echo $res['id']; ?>" rel="superbox[iframe][300x100]"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="20" height="20" title="Excluir" /></a>              
                
                <a href="scripts/cadastrar_escola.php?escola=<? echo $res['code_escola']; ?>" rel="superbox[iframe][280x100]"> <img src="https://image.flaticon.com/icons/png/512/1159/1159633.png" width="20" height="20" border="0" title="Alterar nome" /></a>
              </td>
            </tr>
         <? } ?>
        </table>
        
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>