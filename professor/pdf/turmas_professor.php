<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<? require "../../conexao.php"; $professor = $_GET['professor']; ?>
</head>

<body>
<? $i = 0; $nome_escola = 0; $componente = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE professor = '$operador'");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		   
				  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res['turma']."'");
				   while($res_escola = mysqli_fetch_array($sql_escola)){
					   
					   $sql_nome_escola = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res['escola']."'");
				   		while($res_nome_escola = mysqli_fetch_array($sql_nome_escola)){
							$nome_escola = $res_nome_escola['nome_escola'];
						}
						
					   $sql_nome_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['disciplina']."'");
				   		while($res_nome_componente = mysqli_fetch_array($sql_nome_componente)){
							$componente = $res_nome_componente['componente'];
						}
						
?>
<table class="table">
  <thead>
    <tr>
      <th width="11%" scope="col"><img src="../../img/logo.png" width="100" height="100" /></th>
      <th colspan="3" align="center" scope="col"><h1 class="h2">Relat&oacute;rio de escolas</h1></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th colspan="4" align="left"><strong>Professor: </strong><? echo $res_professor['nome']; ?></th>
    </tr>
    <tr>
      <th scope="row">COD.</th>
      <td width="37%"><strong>Nome da escola</strong></td>
      <td width="33%"><strong>N&deg; turma</strong></td>
      <td width="19%"><strong>N&deg; alunos</strong></td>
    </tr>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['turma']; ?></td>
              <td><? echo $nome_escola; ?></td>
              <td><? echo $componente; ?></td>
              <td><? echo $res_escola['code_serie']; ?>° ano</td>
              <td><? echo $res_escola['tipo_turma']; ?></td>
              <td><? echo $res_escola['turno']; ?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['turma']."'"));?></td>
    <? }} ?>
  </tbody>
</table>
</body>
</html>