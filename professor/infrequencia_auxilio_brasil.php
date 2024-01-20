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
              <option value="?p=infrequencia_auxilio_brasil&turma=<? echo $res_turmas['code_turma']; ?>"><? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; ?></option>
              <? } ?>
            </select>
          </form>
         </p>
        <table width="1000" class="table">
        <thead class="thead-light">
            <tr>
              <th colspan="12" scope="col" align="center"><h5 style="padding:0; margin:0;" align="center"><strong>TURMA: 
			  
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
              <td width="270"><strong>NOME DO ALUNO</strong></td>
              <td width="45"><strong>FREQ%</strong></td>
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
           <? $i = 0; 
		   $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma'");
		    while($res_1 = mysqli_fetch_array($sql_1)){ $i++;
			$aluno = $res_1['aluno'];
			
			
			
			
			$sql_2 = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_1['aluno']."'");
		    while($res_2 = mysqli_fetch_array($sql_2)){ 
				
				$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' LIMIT 50");
				$conta_atividades = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' LIMIT 50"));
				 while($res_atividades = mysqli_fetch_array($sql_atividades)){
						
						if($res_atividades['tipo_envio'] == 'arquivo'){
							 $sql_atividade_aluno = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_2['code_aluno']."'"); 
							 if(mysqli_num_rows($sql_atividade_aluno) >= 1){
								 $soma_atividade++;
							 }
						}else{
							
							 $sql_atividade_aluno = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_2['code_aluno']."' LIMIT 1"); 
							 if(mysqli_num_rows($sql_atividade_aluno) >= 1){
								 $soma_atividade++;
							 }							
							
						}
					 
					}
				
				
				$percentual = number_format($soma_atividade*100)/$conta_atividades;
				
				
				
		   if($percentual >= 75){
		  ?>
            <tr>
              <th scope="row"><? echo $res_1['n_chamada']; ?></th>
              <td><? echo strtoupper($res_2['nome_aluno']); ?></td>
              <td><? echo $percentual; ?>%</td>
              <td align="center">&nbsp;</td>
              
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
        <? $soma_atividade = 0; }}} ?>
        </table>

        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>