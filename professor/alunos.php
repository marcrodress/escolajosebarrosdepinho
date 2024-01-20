<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/turmas.css" rel="stylesheet" type="text/css" />
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
        <br />
        <p class="h4 text-primary">Alunos matriculados</p>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome do aluno</th>
            </tr>
          </thead>
          <tbody>
          <? $key = $_GET['key']; $turma = 0;
          $sql_consulta = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE nome_aluno LIKE '%$key%'");
		  while($res_consulta = mysqli_fetch_array($sql_consulta)){
			  
          $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res_consulta['code_aluno']."' LIMIT 1");
		  while($res_turma = mysqli_fetch_array($sql_turma)){
			  
			  $turma = $res_turma['turma'];
		  }
		  ?>
            <tr>
              <th scope="row">1</th>
              <td><a href="?p=visao_geral_de_alunos&aluno=<? echo $res_consulta['code_aluno']; ?>&turma=<? echo $turma; ?>"><? echo strtoupper($res_consulta['nome_aluno']); ?></a></td>
            </tr>
          <? } ?>  
        </table>
        
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>