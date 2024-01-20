<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
body table{
	font:13px Arial, Helvetica, sans-serif;
	}
#container_tuod{
	background:#FFF;
}
</style>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<div class="container_tuod">
    <div class="container">
      <div class="row">
        </p>
        <form name="form" id="form">
            <select class="form-control" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
              <option>Selecione a turma</option>
             <?
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
			 ?>
              <option value="?p=notas_baixas&turma=<? echo $res_turmas['code_turma']; ?>&bimestre=<? echo $_GET['bimestre']; ?>"><? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; ?></option>
              <? } ?>
            </select>
        </form>
            
        <form name="form" id="form">
            <select name="jumpMenu" size="1" class="form-control" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
              <option value="">Selecione o bimestre</option>
              <option value="?p=notas_baixas&turma=<? echo $_GET['turma']; ?>&bimestre=1">1° bimestre</option>
              <option value="?p=notas_baixas&turma=<? echo $_GET['turma']; ?>&bimestre=2">2° bimestre</option>
              <option value="?p=notas_baixas&turma=<? echo $_GET['turma']; ?>&bimestre=3">3° bimestre</option>
              <option value="?p=notas_baixas&turma=<? echo $_GET['turma']; ?>&bimestre=4">4° bimestre</option>
            </select>            
        </form>
         </p>
        <table width="1000" class="table">
        <thead class="thead-light">
            <tr>
              <th colspan="11" scope="col" align="center"><h5 style="padding:0; margin:0;" align="center"><strong>TURMA: 
			  
			  <? 
			  $turma = $_GET['turma'];
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
              ?>
              			  
			  <? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; } ?>
              
              </strong> 
              <a target="_blank" href="pdf/imprimir_relatorio_livro_didatico.php?turma=<? echo $turma; ?>"><img src="../img/impressora.png" alt="" width="25" height="25" border="0" align="right" style="padding:0; margin:0;" title="Imprimir relatório" /></a></h5></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th width="17" scope="row">N&deg;</th>
              <td><strong>NOME DO ALUNO</strong></td>
              <td width="81"><strong>PORTUGU&Ecirc;S</strong></td>
              <td width="86"><strong>MATEM&Aacute;TICA</strong></td>
              <td width="62"><strong>HIST&Oacute;RIA</strong></td>
              <td width="77"><strong>GEOGRAFIA</strong></td>
              <td width="61"><strong>CI&Ecirc;NCIAS</strong></td>
              <td width="50"><strong>INGL&Ecirc;S</strong></td>
              <td width="94"><strong>ED. F&Iacute;SICA</strong></td>
              <td width="43"><strong>ARTES</strong></td>
              <td width="62"><strong>RELIGI&Atilde;O</strong></td>
            </tr>
           <? $i = 0; $bimestre = $_GET['bimestre'];
		   $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM'");
		    while($res_1 = mysqli_fetch_array($sql_1)){ $i++;
			
			$sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND media < 6");
			if(mysqli_num_rows($sql_notas_bimestrais) >= 1){
			
			$sql_2 = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_1['aluno']."'");
		    while($res_2 = mysqli_fetch_array($sql_2)){ 
				
		  ?>
            <tr>
              <th scope="row"><? echo $res_1['n_chamada']; ?></th>
              <td><? echo strtoupper($res_2['nome_aluno']); ?></td>
              <td align="center"><?
               $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND componente = '96514'");
			    while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					$media = number_format($res_notas_bimestrais['media'],1);
					if($media < 6){
						echo "<p class='text-danger'><strong>$media</strong></p>";
					}else{
						echo $media;
					}
					}
			  ?></td>
              
              <td align="center"><?
               $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND componente = '96461'");
			    while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					$media = number_format($res_notas_bimestrais['media'],1);
					if($media < 6){
						echo "<p class='text-danger'><strong>$media</strong></p>";
					}else{
						echo $media;
					}
					}
			  ?></td>
              <td align="center"><?
               $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND componente = '99981'");
			    while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					$media = number_format($res_notas_bimestrais['media'],1);
					if($media < 6){
						echo "<p class='text-danger'><strong>$media</strong></p>";
					}else{
						echo $media;
					}
					}
			  ?></td>
              
              <td align="center"><?
               $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND componente = '390341'");
			    while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					$media = number_format($res_notas_bimestrais['media'],1);
					if($media < 6){
						echo "<p class='text-danger'><strong>$media</strong></p>";
					}else{
						echo $media;
					}
					}
			  ?></td>
              <td align="center"><?
               $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND componente = '95616'");
			    while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					$media = number_format($res_notas_bimestrais['media'],1);
					if($media < 6){
						echo "<p class='text-danger'><strong>$media</strong></p>";
					}else{
						echo $media;
					}
					}
			  ?></td>
              <td align="center"><?
               $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND componente = '639811'");
			    while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					$media = number_format($res_notas_bimestrais['media'],1);
					if($media < 6){
						echo "<p class='text-danger'><strong>$media</strong></p>";
					}else{
						echo $media;
					}
					}
			  ?></td>
              <td align="center"><?
               $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND componente = '9621345'");
			    while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					$media = number_format($res_notas_bimestrais['media'],1);
					if($media < 6){
						echo "<p class='text-danger'><strong>$media</strong></p>";
					}else{
						echo $media;
					}
					}
			  ?></td>
              <td align="center"><?
               $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND componente = '36244'");
			    while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					$media = number_format($res_notas_bimestrais['media'],1);
					if($media < 6){
						echo "<p class='text-danger'><strong>$media</strong></p>";
					}else{
						echo $media;
					}
					}
			  ?></td>
              <td style="padding:0; margin:0;" align="center"><?
               $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_1['aluno']."' AND bimestre = '$bimestre' AND componente = '74235'");
			    while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
					$media = number_format($res_notas_bimestrais['media'],1);
					if($media < 6){
						echo "<p class='text-danger' style='padding:0; margin:0;'><strong>$media</strong></p>";
					}else{
						echo $media;
					}
					}
			  ?></td>
            </tr>
            <? }}} ?>
        </table>

        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>