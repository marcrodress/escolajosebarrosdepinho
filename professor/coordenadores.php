<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/coordenadores.css" rel="stylesheet" type="text/css" />
<style>
body table{
	font:12px Arial, Helvetica, sans-serif;
	}
#container_tuod{
	background:#FFF;
	font:10px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm">
        <a style="margin:5px 0 0 0;" rel="superbox[iframe][370x320]" href="scripts/professores.php?operador=<? echo $operador; ?>" class="btn btn-success">Cadastrar coordenador</a>
        <hr />
        <p class="h4 text-primary">Coordenadores cadastrados</p>
        <table class="table table-striped">
          <thead>
            <tr>
              <th width="17" scope="col">ID</th>
              <th width="28" scope="col">COD.</th>
              <th width="265" align="left" scope="col">Nome</th>
              <th width="32" scope="col">Login</th>
              <th width="40" scope="col">E-mail</th>
              <th width="110" scope="col">Telefone</th>
              <th width="63" scope="col">N&deg; Dis.</th>
              <th width="24" scope="col">Tipo</th>
              <th width="83" scope="col">Opções</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0;
		   $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM professor WHERE escola = '$operador'");
		    while($res_1 = mysqli_fetch_array($sql_1)){ $i++;
			$sql_2 = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_1['professor']."'");
		    while($res_2 = mysqli_fetch_array($sql_2)){
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res_2['code']; ?></td>
              <td align="left"><? echo $res_2['nome_escola']; ?></td>
              <td><? echo $res_2['login']; ?></td>
              <td><? echo $res_2['email']; ?></td>
              <td><? echo $res_2['telefone']; ?></td>
              <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE professor = '".$res_1['professor']."' AND escola = '$operador'")); ?></td>
              <td><? 
			  		$tipo_acesso = mysqli_query($conexao_bd, "SELECT * FROM professor WHERE professor = '".$res_1['professor']."'");
					 while($res_acesso = mysqli_fetch_array($tipo_acesso)){
						 echo $res_acesso['tipo'];
					 }
					
					
				  ?></td>
              <td>
                <a href="?p=professores&pg=excluir&professor=<? echo $res_2['code']; ?>"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="15" height="15" border="0" title="Excluir professor" /></a>
                <a rel="superbox[iframe][370x399]" href="scripts/professores.php?operador=<? echo $operador; ?>&p=1&ed=ed&code_professor=<? echo $res_2['code']; ?>"><img src="https://image.flaticon.com/icons/png/512/1159/1159633.png" width="15" height="15" border="0" /></a>
              <a href="?p=visao_geral_de_alunos&amp;aluno=<? echo $res_alunos['code_aluno']; ?>"></a>
              
              
              
              <a href="?p=visao_geral_professor&code=<? echo $res_2['code']; ?>"><img src="../img/relatorio_completo.png" alt="" width="15" height="15" border="0" title="Vis&atilde;o geral do professor" /></a>
              </td>
            </tr>
        <? }} ?>
        </table>
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
<? if(@$_GET['pg'] == 'excluir'){

mysqli_query($conexao_bd, "DELETE FROM professor WHERE escola = '$operador' AND professor = '".$_GET['professor']."'");
echo "<script language='javascript'>window.location='?p=professores';</script>";

}?>