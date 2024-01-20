<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>

<body>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">N° questão</th>
      <th scope="col">Item correto</th>
      <th scope="col">Resposta aluno</th>
      <th scope="col">Correto</th>
    </tr>
  </thead>
  <tbody>
  <?
  $sql_questao = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$_GET['atividade']."'");
  while($res_questao = mysqli_fetch_array($sql_questao)){
  ?>
    <tr>
      <th scope="row"><? echo $res_questao['id_questao']; ?></th>
      <td><? echo $res_questao['correta']; ?></td>
      <?
	  $sql_resp_aluno = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$_GET['atividade']."' AND aluno = '".$_GET['aluno']."' AND questao = '".$res_questao['id_questao']."'");
	  while($res_aluno = mysqli_fetch_array($sql_resp_aluno)){
	  ?>
      <td><? echo $res_aluno['item']; ?></td>
      <td><? echo $res_aluno['correto']; ?></td>
      <? } ?>
      
    </tr>
   <? } ?>
  </tbody>
</table>
</body>
</html>