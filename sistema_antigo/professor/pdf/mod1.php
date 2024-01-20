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
<?
$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM professor WHERE operador = '$professor'");
while($res_professor = mysqli_fetch_array($sql_professor)){
?>
<table class="table">
  <thead>
    <tr>
      <th width="11%" scope="col"><img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Brasao_sao_goncalo_do_amarante_ce.JPG" width="120" height="100" /></th>
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
    <?
	 $sql_escolas = mysqli_query($conexao_bd, "SELECT * FROM escolas WHERE usuario = '$professor'");
	 while($res_escola = mysqli_fetch_array($sql_escolas)){
	?>
    <tr>
      <th><? echo $res_escola['code_escola']; ?></th>
      <td><? echo $res_escola['nome_escola']; ?></td>
      <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_escola = '".$res_escola['code_escola']."'")); ?></td>
      <td>
              <?
              
			   $soma_alunos = 0;
			   $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_escola = '".$res_escola['code_escola']."'");
			    while($res_turmas = mysqli_fetch_array($sql_turmas)){
					
					$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res_turmas['code_turma']."'");
					    while($res_aluno = mysqli_fetch_array($sql_alunos)){
						 $soma_alunos++;
						}
					
				}
			  
			   echo $soma_alunos;
			  
			  ?>      
      </td>
    </tr>
    <? } ?>
  </tbody>
</table>
<? } ?>
</body>
</html>