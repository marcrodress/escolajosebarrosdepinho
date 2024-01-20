<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<? require "../../conexao.php"; $operador = $_GET['operador'];?>

</head>

<body>
<table class="table">
  <thead class="table-primary">
    <tr>
      <th colspan="4">INFORMA&Ccedil;&Otilde;ES DA TURMA</th>
    </tr>
  </thead>
  <tbody>
  <?
  
  $turma = $_GET['turma'];
  $operador = $_GET['operador'];
  
  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
  while($res_turma = mysqli_fetch_array($sql_turma)){
  ?>
    <tr>
      <th>COD.: <? echo $turma; ?></th>
      <td><strong>ANO:</strong> <? echo $res_turma['code_serie']; ?>° ano</td>
      <td><strong>TURMA:</strong> <? echo $res_turma['tipo_turma']; ?></td>
      <td><strong>TURNO:</strong> <? echo $res_turma['turno']; ?></td>
    </tr>
  <? } ?>
    <tr>
      <th class="table-success" colspan="4" scope="row">COMPONENTES CURRICULARES</th>
    </tr>
    <tr>
      <th>COMPONENTE</th>
      <td><strong>PROFESSOR</strong></td>
      <td colspan="2"><strong>ALOCA&Ccedil;&Atilde;O DE PROFESSOR</strong></td>
    </tr>
    <?
	 $sql_disciplina = mysqli_query($conexao_bd, "SELECT * FROM disciplinas");
	 while($res_disc = mysqli_fetch_array($sql_disciplina)){
	?>
    <tr>
      <th><? echo $res_disc['componente']; ?></th>
      <td>
      <?
       $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE disciplina = '".$res_disc['code']."' AND turma = '$turma'");
	   while($res_turma = mysqli_fetch_array($sql_turma)){
		   
		   $sql_acesso = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_turma['professor']."'");
		   while($res_acesso = mysqli_fetch_array($sql_acesso)){
			   
			   $sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_acesso['cpf']."'");
				   while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
			        echo $res_colaborador['nome'];
				   }
		   }
	   }
	  ?>
      </td>
      <td colspan="2">
      <? if(mysqli_num_rows($sql_turma) >= 1){ ?>
       <a class="btn btn-danger" href="?turma=<? echo $_GET['turma']; ?>&acao=tirar&operador=<? echo $_GET['operador']; ?>&disciplina=<? echo $res_disc['code'] ?>&professor=<? 
	          $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE disciplina = '".$res_disc['code']."' AND turma = '$turma'");
	   while($res_turma = mysqli_fetch_array($sql_turma)){
		   echo $res_turma['professor'];
	   }
	   
	   
	   ?>">Excluir professor</a>
	  <? } ?>

      
      <? if(mysqli_num_rows($sql_turma) <= 0){ ?>
      <form method="post" name="form" id="form">
      <input type="hidden" name="disciplina" value="<? echo $res_disc['code'] ?>" />
        <select style="font:12px Arial, Helvetica, sans-serif; padding:7px;" name="professor" size="1">
          <option value=""></option>
        <?
		 $sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE tipo = 'PROFESSOR' AND status = 'Ativo'");
		 while($res_professor = mysqli_fetch_array($sql_professor)){
		 $sql = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_professor['cpf']."'");
		 while($res = mysqli_fetch_array($sql)){
		?>
          <option value="<? echo $res_professor['code']; ?>"><? echo $res['nome']; ?></option>
        <? }} ?>
        </select>
        <input type="submit" name="alocar" value="Lotar" />
      </form>
      
      <? } ?>
      </td>
    </tr>
    <? } ?>
  </tbody>
</table>
<? if(isset($_POST['alocar'])){

$disciplina = $_POST['disciplina'];
$professor = $_POST['professor'];

mysqli_query($conexao_bd, "INSERT INTO disciplinas_turmas (professor, disciplina, escola, turma) VALUES ('$professor', '$disciplina', '$operador', '$turma')");

echo "<script language='javascript'>window.location=window.location='?turma=$turma&acao=mostrar_disciplinas&operador=$operador';</script>";

}?>




</body>
</html>


<? if(@$_GET['acao'] == 'tirar'){

$disciplina = $_GET['disciplina'];
$professor = $_GET['professor'];

mysqli_query($conexao_bd, "DELETE FROM disciplinas_turmas WHERE disciplina = '$disciplina' AND turma = '$turma'");

echo "<script language='javascript'>window.location=window.location='?turma=$turma&acao=mostrar_disciplinas&operador=$operador';</script>";

}?>