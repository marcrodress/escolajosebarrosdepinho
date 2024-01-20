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

        <p class="h4 text-primary">Todas as turmas</p>
        
        
		<table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">COD.</th>
              <th scope="col">Escola</th>
              <th scope="col">Série</th>
              <th scope="col">Turma</th>
              <th scope="col">Turno</th>
              <th scope="col">N° alunos</th>
              <th scope="col">Laudo</th>
              <th scope="col">Impresso</th>
              <th scope="col">Rend%.</th>
              <th scope="col">Opções</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0; $nome_escola = 0; $componente = 0;
			$sql_escola = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_serie = '1' OR code_serie = '2' OR code_serie = '3' OR code_serie = '4' OR code_serie = '5' OR code_serie = '6' OR code_serie = '7' OR code_serie = '8' OR code_serie = '9'");
				while($res_escola = mysqli_fetch_array($sql_escola)){ $i++;
				$conta_laudo = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res_escola['code_turma']."' AND laudado = 'SIM'"));
				if($conta_laudo >=1){
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res_escola['code_escola']; ?></td>
              <td>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</td>
              <td><? echo $res_escola['code_serie']; ?>° ano</td>
              <td><? echo $res_escola['tipo_turma']; ?></td>
              <td><? echo $res_escola['turno']; ?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res_escola['code_turma']."'"));?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res_escola['code_turma']."' AND laudado = 'SIM'"));?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res_escola['code_turma']."' AND impresso = 'SIM'"));?></td>
              <td >&nbsp;</td>
              <td>
                
                <a href="?p=aee&turma=<? echo $res_escola['code_turma']; ?>&componente=<? echo $res['disciplina']; ?>&acao=mostrar&?operador=<? echo $operador; ?>"> <img src="img/verificar_alunos.jpg" width="25" height="25" border="0" title="Verificar alunos" /></a>
                
                <a rel="superbox[iframe][200x100]" href="scripts/lancar_nota.php?aluno=<? echo $res_alunos['code_aluno']; ?>&turma=<? echo $res_alunos['turma']; ?>&componente=<? echo $res['disciplina']; ?>&p=1&operador=<? echo $operador ?>"><img src="../img/boletim_escolar.png" width="25" height="25" border="0" /></a>
                
                
              <a href="?p=lancar_frequencia&turma=<? echo $res_escola['code_turma']; ?>&mes=<? echo date("m"); ?>"><img src="img/atividades.png" width="25" height="25" border="0" title="Lançar frequência" /></a></td>
            </tr>
            
         <? }} ?>
        </table>

        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
