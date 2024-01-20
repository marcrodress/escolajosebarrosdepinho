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
</head>

<body>

<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm">
        <hr />
        <p class="h4 text-primary"><strong>Relatório de vacinação geral</strong></p>
        <table width="873" border="1" class="table table-striped table-bordered">
        <thead class="thead-dark">
          <tr>
            <th width="255"><strong>TURMA</strong></th>
            <th width="193"><strong>1° DOSE</strong></th>
            <th width="213"><strong>2° DOSE</strong></th>
            <th width="184"><strong>3° DOSE</strong></th>
          </tr>
         </thead>
          <?  $total_alunos = 0; $total = 0; $total2 = 0; $total3 = 0; $vacinados_1 = 0;  $vacinados_2 = 0; $vacinados_3 = 0;
		   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_serie = '1' OR code_serie = '2' OR code_serie = '3' OR code_serie = '4' OR code_serie = '5' OR code_serie = '6' OR code_serie = '7' OR code_serie = '8' OR code_serie = '9' ORDER BY code_serie ASC");
		   while($res_turma = mysqli_fetch_array($sql_turma)){
		  ?>
          <tr>
            <th><? echo $res_turma['code_serie']; ?>° ANO - <? echo $res_turma['tipo_turma']; ?></th>
            <th><?
              $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res_turma['code_turma']."' AND status = 'Ativo' AND transferido != 'SIM'");
			   while($res_alunos = mysqli_fetch_array($sql_alunos)){ $total_alunos++;
				   $sql_vacinacao = mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE aluno = '".$res_alunos['aluno']."'");
				   if(mysqli_num_rows($sql_vacinacao) >=1){
					    while($res_vacinacao = mysqli_fetch_array($sql_vacinacao)){
							if($res_vacinacao['n_dose'] == '1' || $res_vacinacao['n_dose'] == 'ÚNICA'){
								$total++; $vacinados_1++;
							}
					   }
				   	
				   }
			  }
			  
			  if($total == 0){
				   echo "0";
			  }else{
				   echo $total; echo " | "; echo number_format(($total*100)/mysqli_num_rows($sql_alunos)); echo "%";
			  }
			  		
			  unset($total);
			?></th>
            <th>
<?
              $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res_turma['code_turma']."' AND status = 'Ativo' AND transferido != 'SIM'");
			   while($res_alunos = mysqli_fetch_array($sql_alunos)){
				   $sql_vacinacao = mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE aluno = '".$res_alunos['aluno']."'");
				   if(mysqli_num_rows($sql_vacinacao) >=1){
					    while($res_vacinacao = mysqli_fetch_array($sql_vacinacao)){
							if($res_vacinacao['n_dose'] == '2'){
								$total2++; $vacinados_2++;
							}
					   }
				   	
				   }
			  }
			  
			  if($total2 == 0){
				   echo "0";
			  }else{
				   echo $total2;  echo " | "; echo number_format(($total2*100)/mysqli_num_rows($sql_alunos)); echo "%";
			  }
			  
			  unset($total2);
			?>            
            </th>
            <th>
<?
              $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$res_turma['code_turma']."' AND status = 'Ativo' AND transferido != 'SIM'");
			   while($res_alunos = mysqli_fetch_array($sql_alunos)){
				   $sql_vacinacao = mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE aluno = '".$res_alunos['aluno']."'");
				   if(mysqli_num_rows($sql_vacinacao) >=1){
					    while($res_vacinacao = mysqli_fetch_array($sql_vacinacao)){
							if($res_vacinacao['n_dose'] == '3'){
								$total3++; $vacinados_3++;
							}
					   }
				   	
				   }
			  }
			  
			  if($total3 == 0){
				   echo "0";
			  }else{
				   echo $total3;  echo " | "; echo number_format(($total3*100)/mysqli_num_rows($sql_alunos)); echo "%";
			  }
			  
			  unset($total3);
			?>            
            </th>
          </tr>
          <? } ?>
          <thead class="thead-dark">
          <tr>
            <th height="20"><strong>RELATÓRIO FINAL DE VACINADOS</strong></th>
            <th><strong><? echo $vacinados_1; echo " | "; echo number_format(($vacinados_1*100)/$total_alunos); echo "%"; ?> ALUNOS</strong></th>
            <th><strong><? echo $vacinados_2; echo " | "; echo number_format(($vacinados_2*100)/$total_alunos); echo "%"; ?> ALUNOS</strong></th>
            <th><strong><? echo $vacinados_3; echo " | "; echo number_format(($vacinados_3*100)/$total_alunos); echo "%"; ?> ALUNOS</strong></th>
          </tr>
          <tr>
            <th><strong>RELATÓRIO FINAL DE NÃO VACINADOS</strong></th>
            <th><? echo ($total_alunos-$vacinados_1); ?></th>
            <th><? echo ($total_alunos-$vacinados_2); ?></th>
            <th><? echo ($total_alunos-$vacinados_3); ?></th>
          </tr>
          </thead>
        </table> 
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>