<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/turmas.css" rel="stylesheet" type="text/css" />
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
        <div class="col-sm"><p></p>
        <p class="h4 text-primary">Professores</p>
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
              <th width="83" scope="col">Opções</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0;
		   $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE tipo = 'PROFESSOR' AND status = 'Ativo'");
		    while($res_1 = mysqli_fetch_array($sql_1)){ $i++; $code_professor = $res_1['code'];
			$sql_2 = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_1['cpf']."'");
		    while($res_2 = mysqli_fetch_array($sql_2)){
		  ?>
            <tr>
              <th scope="row"><? echo $res_1['id']; ?></th>
              <td><? echo $res_1['code']; ?></td>
              <td align="left"><? echo strtoupper($res_2['nome']); ?></td>
              <td><? echo $res_1['login']; ?></td>
              <td><? 
			  $sql_funcao = mysqli_query($conexao_bd, "SELECT * FROM contato_colaboradores WHERE cpf = '".$res_1['cpf']."' AND email != '' ORDER BY id DESC LIMIT 1");
			   while($res_funcao = mysqli_fetch_array($sql_funcao)){
			    
				echo $res_funcao['email'];
				
			   
			   }
			  ?></td>
              <td>
			 <? 
			  $sql_funcao = mysqli_query($conexao_bd, "SELECT * FROM contato_colaboradores WHERE cpf = '".$res_1['cpf']."' AND telefone != '' ORDER BY id DESC LIMIT 1");
			   while($res_funcao = mysqli_fetch_array($sql_funcao)){
				echo $res_funcao['telefone'];
				
			   }
			  ?>
              </td>
              <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE professor = '".$res_1['code']."' AND escola = '$operador'")); ?></td>
              <td>
                <a href="?p=professores&pg=excluir&professor=<? echo $res_2['code']; ?>"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="15" height="15" border="0" title="Excluir professor" /></a> <a href="?p=visao_geral_de_alunos&amp;aluno=<? echo $res_alunos['code_aluno']; ?>"></a>
              
              <a href="?p=visao_geral_professor&code=<? echo $code_professor; ?>"><img src="../img/relatorio_completo.png" alt="" width="15" height="15" border="0" title="Vis&atilde;o geral do professor" /></a>
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