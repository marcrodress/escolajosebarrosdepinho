<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Language" content="pt-br, en, fr, it">
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
 		<h4 class="h4">Suas aulas de hoje</h4>
        <?
		 $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_dia_atividade  = '$code_hoje' AND usuario = '$operador'");
		 if(mysqli_num_rows($sql_turmas) == ''){
		  echo "<div class='alert alert-info' role='alert'>Não foi encontrado plano de aula para hoje!</div>";
		 }else{
			 while($res_turmas = mysqli_fetch_array($sql_turmas)){
				 $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_turmas['turma']."'");
					 while($res_turma = mysqli_fetch_array($sql_turma)){
				 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_turmas['componente']."'");
					 while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
		?>
         <div class="alert alert-primary" role="alert"><a style="text-decoration:none;" href="../correcao.php?turma=<? echo $res_turmas['turma']; ?>&atividade=<? echo $res_turmas['code_atividade']; ?>"><strong>COMPONENTE: <? echo $res_disciplinas['componente']; ?> | <? echo $res_turma['code_serie']; ?>° ANO - <? echo $res_turma['fase']; ?> | TURMA: <? echo $res_turma['tipo_turma']; ?> | TURNO: <? echo $res_turma['turno']; ?> | SALA: <? echo $res_turma['sala']; ?></strong></a></div>
		<? }}}} ?>
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
