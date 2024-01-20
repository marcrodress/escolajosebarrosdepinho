<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
          <p class="h4 text-black">Visão geral de aluno</p>
        </div><!-- col-sm -->
      </div><!-- row -->
      
      <hr />
      
      <? $turma = $_GET['turma'];
		$sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$_GET['aluno']."'");
	     while($res_aluno = mysqli_fetch_array($sql_aluno)){
			 
			 
			 
	  ?>
      <div class="row">
        <div class="col-1">
          <img style="border:3px solid #000; border-radius:10px;" src="http://mod1.ecommerce10.com.br/images/semimagem.png" width="100" height="100" />
        </div>
        <div class="col">
          <h2 style="margin:0 0 0 10px;"><strong><? 
		  
		  $sql_nome_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$_GET['aluno']."'");
		   while($res_aluno = mysqli_fetch_array($sql_nome_aluno)){
		   	echo strtoupper($res_aluno['nome_aluno']); 
		 }
		  ?></strong></h2>
          <?
		  
			$sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
	    	 while($res_turma = mysqli_fetch_array($sql_turma)){
		  ?>
          <h5 style="margin:0 0 0 10px;" class="text-primary">Ano: <? echo $res_turma['code_serie']; ?>° ano Turma: <? echo $res_turma['tipo_turma']; ?> Turno: <? echo $res_turma['turno']; ?> <br />
			  <strong  class="text-warning">Participação: <?
			  
				 $conta_atividades = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND code_dia_atividade < '$code_hoje'"));
					  
				 $sql_atividades_enviadas = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND data != ''"));
				 
				  echo number_format(($sql_atividades_enviadas*100)/$conta_atividades);
				?>%</strong>
          </h5>
         <? } ?>
        </div>
      </div><!-- row -->
      <? } ?>
      
      <hr />
      <h4 style="color:#F00;"><strong>Frequência</strong></h4> <? $turma = $_GET['turma']; ?>
      <hr />
          <table style="text-align:center; font:12px Arial, Helvetica, sans-serif;" class="table table-bordered">
          <thead>
            <tr>
              <th width="102" style="border:1px solid #FFF;" scope="col"><img src="../img/frequencia_escolar.png" width="50" height="30" /></th>
              <th width="95" scope="col"><strong>PORTUGU&Ecirc;S</strong></th>
              <th width="116" scope="col"><strong>MATEM&Aacute;TICA</strong></th>
              <th width="108" scope="col"><strong>GEOGRAFIA</strong></th>
              <th width="104" scope="col"><strong>HIST&Oacute;RIA</strong></th>
              <th width="103" scope="col"><strong>INGL&Ecirc;S</strong></th>
              <th width="99" scope="col"><strong>CI&Ecirc;NCIAS</strong></th>
              <th width="107" scope="col"><strong>EDU. F&Iacute;SICA</strong></th>
              <th width="139" scope="col"><strong>ENS. RELIGIOSO</strong></th>
              <th colspan="2" scope="col"><strong>ARTES</strong></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><strong style="font:12px Arial, Helvetica, sans-serif; text-align:center;"><strong>1&deg; Bimestre</strong></strong></th>
                <th scope="col">
                <?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '1' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=1&aluno=<? echo $_GET['aluno']; ?>&componente=96514&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
                </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '1' AND componente = '96461' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=1&aluno=<? echo $_GET['aluno']; ?>&componente=96461&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '1' AND componente = '390341' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=1&aluno=<? echo $_GET['aluno']; ?>&componente=390341&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '1' AND componente = '99981' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=1&aluno=<? echo $_GET['aluno']; ?>&componente=99981&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '1' AND componente = '639811' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=1&aluno=<? echo $_GET['aluno']; ?>&componente=639811&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '1' AND componente = '95616' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=1&aluno=<? echo $_GET['aluno']; ?>&componente=95616&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '1' AND componente = '9621345' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=1&aluno=<? echo $_GET['aluno']; ?>&componente=9621345&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '1' AND componente = '74235' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=1&aluno=<? echo $_GET['aluno']; ?>&componente=74235&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th width="65" scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '1' AND componente = '36244' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=1&aluno=<? echo $_GET['aluno']; ?>&componente=36244&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              
            <tr>
              <th scope="row"><strong style="font:12px Arial, Helvetica, sans-serif; text-align:center;"><strong>2&deg; Bimestre</strong></strong></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '2' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=2&aluno=<? echo $_GET['aluno']; ?>&componente=96514&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '2' AND componente = '96461' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=2&aluno=<? echo $_GET['aluno']; ?>&componente=96461&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '2' AND componente = '390341' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=2&aluno=<? echo $_GET['aluno']; ?>&componente=390341&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '2' AND componente = '99981' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=2&aluno=<? echo $_GET['aluno']; ?>&componente=99981&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '2' AND componente = '639811' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=2&aluno=<? echo $_GET['aluno']; ?>&componente=639811&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '2' AND componente = '95616' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=2&aluno=<? echo $_GET['aluno']; ?>&componente=95616&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '2' AND componente = '9621345' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."'");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=2&aluno=<? echo $_GET['aluno']; ?>&componente=9621345&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '2' AND componente = '74235' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
               <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=2&aluno=<? echo $_GET['aluno']; ?>&componente=74235&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '2' AND componente = '36244' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
                <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=2&aluno=<? echo $_GET['aluno']; ?>&componente=36244&turma=<? echo $turma; ?>"><? echo $conta; ?>%</a>
              </th>
            <tr>
              <th scope="row"><strong style="font:12px Arial, Helvetica, sans-serif; text-align:center;"><strong>3&deg; Bimestre</strong></strong></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '3' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=3&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '3' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=3&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '3' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=3&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '3' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=3&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '3' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=3&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '3' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=3&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '3' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=3&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '3' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=3&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '3' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=3&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
            <tr>
              <th scope="row"><strong style="font:12px Arial, Helvetica, sans-serif; text-align:center;"><strong>4&deg; Bimestre</strong></strong></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '4' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=4&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '4' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=4&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '4' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=4&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '4' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=4&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '4' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=4&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '4' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=4&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '4' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=4&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '4' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=4&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
              <th scope="col"><?
				 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE periodo = '4' AND componente = '96514' AND turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				 $conta_atividades = mysqli_num_rows($sql_atividades);
				 $conta_atividades_enviadas = 0;
				  while($res_atividades = mysqli_fetch_array($sql_atividades)){
					  
				 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						$conta_atividades_enviadas++;
					}
				  }
				  $conta = number_format(($conta_atividades_enviadas*100)/$conta_atividades,1);
				?>
              <a rel="superbox[iframe][1000x600]" href="scripts/mostrar_relatorio_atividades.php?periodo=4&amp;aluno=<? echo $_GET['aluno']; ?>&amp;componente=96514&amp;turma=<? echo $turma; ?>"><? echo $conta; ?>%</a></th>
         </table>
          <h4 style="color:#F00;"><strong>Notas</strong></h4>
      <hr />
      <table style="text-align:center; font:12px Arial, Helvetica, sans-serif;" class="table table-bordered">
            <thead>
              <tr>
                <th width="102" style="border:1px solid #FFF;" scope="col"><img src="../img/frequencia_escolar.png" alt="" width="50" height="30" /></th>
                <th width="95" scope="col"><strong>PORTUGU&Ecirc;S</strong></th>
                <th width="116" scope="col"><strong>MATEM&Aacute;TICA</strong></th>
                <th width="108" scope="col"><strong>GEOGRAFIA</strong></th>
                <th width="104" scope="col"><strong>HIST&Oacute;RIA</strong></th>
                <th width="103" scope="col"><strong>INGL&Ecirc;S</strong></th>
                <th width="99" scope="col"><strong>CI&Ecirc;NCIAS</strong></th>
                <th width="107" scope="col"><strong>EDU. F&Iacute;SICA</strong></th>
                <th width="139" scope="col"><strong>ENS. RELIGIOSO</strong></th>
                <th colspan="2" scope="col"><strong>ARTES</strong></th>
              </tr>
        </thead>
            <tbody>
              <tr>
                <th scope="row"><strong style="font:12px Arial, Helvetica, sans-serif; text-align:center;"><strong>1&deg; Bimestre</strong></strong></th>
                <th scope="col">
				<?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '1'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?><a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&bimestre=1&componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96461' AND bimestre = '1'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=1&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '390341' AND bimestre = '1'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=1&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '639811' AND bimestre = '1'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=1&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '639811' AND bimestre = '1'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=1&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=1&amp;componente=96514">
                  <?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '95616' AND bimestre = '1'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '9621345' AND bimestre = '1'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=1&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '74235' AND bimestre = '1'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=1&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th width="65" scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '36244' AND bimestre = '1'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=1&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
              </tr>
              <tr>
                <th scope="row"><strong style="font:12px Arial, Helvetica, sans-serif; text-align:center;"><strong>2&deg; Bimestre</strong></strong></th>
                <th scope="col"> <?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '2'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                  <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=2&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96461' AND bimestre = '2'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                  <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=2&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '390341' AND bimestre = '2'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                  <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=2&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '639811' AND bimestre = '2'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                  <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=2&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '639811' AND bimestre = '2'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                  <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=2&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=2&amp;componente=96514">
                  <?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '95616' AND bimestre = '2'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                  <? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '9621345' AND bimestre = '2'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                  <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=2&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '74235' AND bimestre = '2'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                  <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=2&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '36244' AND bimestre = '2'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                  <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=2&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
              </tr>
              <tr>
                <th scope="row"><strong style="font:12px Arial, Helvetica, sans-serif; text-align:center;"><strong>3&deg; Bimestre</strong></strong></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=3&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=3&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=3&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=3&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=3&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=3&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=3&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=3&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=3&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
              </tr>
              <tr>
                <th scope="row"><strong style="font:12px Arial, Helvetica, sans-serif; text-align:center;"><strong>4&deg; Bimestre</strong></strong></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '4'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=4&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '4'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=4&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '3'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=4&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '4'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=4&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '4'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=4&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '4'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=4&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '4'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=4&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '4'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=4&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
                <th scope="col"><?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '96514' AND bimestre = '4'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
                <a rel="superbox[iframe][440x120]" href="scripts/detalhes_nota.php?aluno=<? echo $_GET['aluno']; ?>&amp;bimestre=4&amp;componente=96514"><? echo number_format($media);echo ",0"; $media = 0; ?></a></th>
              </tr>
            </tbody>
          </table>
      <?
					$sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '95616' AND bimestre = '4'");
					  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas)){
						  $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
						  
						  if($media < 6 && $res_notas_bimestrais['re'] >= 1){
							  $media = ($media+$res_notas_bimestrais['re'])/2;
						  }
						  
					 }
					 
				?>
<h4 style="color:#F00;"><strong>Busca ativa</strong></h4>
      <hr />
          <table style="text-align:center; font:12px Arial, Helvetica, sans-serif;" class="table table-bordered">
            <thead>
              <tr>
                <th width="90" style="border:1px solid #FFF;" scope="col"><img src="../img/frequencia_escolar.png" alt="" width="50" height="30" /></th>
                <th width="88" scope="col"><strong>PORTUGU&Ecirc;S</strong></th>
                <th width="105" scope="col"><strong>MATEM&Aacute;TICA</strong></th>
                <th width="97" scope="col"><strong>GEOGRAFIA</strong></th>
                <th width="81" scope="col"><strong>HIST&Oacute;RIA</strong></th>
                <th width="76" scope="col"><strong>INGL&Ecirc;S</strong></th>
                <th width="71" scope="col"><strong>CI&Ecirc;NCIAS</strong></th>
                <th width="140" scope="col"><strong>EDU. F&Iacute;SICA</strong></th>
                <th width="163" scope="col"><strong>ENS. RELIGIOSO</strong></th>
                <th width="41" scope="col"><strong>ARTES</strong></th>
                <th colspan="2" scope="col"><strong>COORD.</strong></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row"><strong style="font:12px Arial, Helvetica, sans-serif; text-align:center;"><strong>Quantidade</strong></strong></th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '96514'"));
				
				?>
                
				<? if($conta == ''){ echo "0"; }else{?>
                <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_professor.php?aluno=<? echo $_GET['aluno']; ?>&componente=96514"><? echo $conta; ?></a>
                <? } ?>
                
                
                </th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '96461'"));
				
				?>
                  <? if($conta == ''){ echo "0"; }else{?>
                  <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_professor.php?aluno=<? echo $_GET['aluno']; ?>&amp;componente=96461"><? echo $conta; ?></a>
                <? } ?></th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '390341'"));
				
				?>
                  <? if($conta == ''){ echo "0"; }else{?>
                  <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_professor.php?aluno=<? echo $_GET['aluno']; ?>&amp;componente=390341"><? echo $conta; ?></a>
                <? } ?></th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '99981'"));
				
				?>
                  <? if($conta == ''){ echo "0"; }else{?>
                  <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_professor.php?aluno=<? echo $_GET['aluno']; ?>&amp;componente=99981"><? echo $conta; ?></a>
                <? } ?></th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '639811'"));
				
				?>
                  <? if($conta == ''){ echo "0"; }else{?>
                  <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_professor.php?aluno=<? echo $_GET['aluno']; ?>&amp;componente=96461"><? echo $conta; ?></a>
                <? } ?></th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '95616'"));
				
				?>
                  <? if($conta == ''){ echo "0"; }else{?>
                  <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_professor.php?aluno=<? echo $_GET['aluno']; ?>&amp;componente=639811"><? echo $conta; ?></a>
                <? } ?></th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '9621345'"));
				
				?>
                  <? if($conta == ''){ echo "0"; }else{?>
                  <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_professor.php?aluno=<? echo $_GET['aluno']; ?>&amp;componente=95616"><? echo $conta; ?></a>
                <? } ?></th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '74235'"));
				
				?>
                  <? if($conta == ''){ echo "0"; }else{?>
                  <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_professor.php?aluno=<? echo $_GET['aluno']; ?>&amp;componente=74235"><? echo $conta; ?></a>
                <? } ?></th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa WHERE aluno = '".$_GET['aluno']."' AND componente = '36244'"));
				
				?>
                  <? if($conta == ''){ echo "0"; }else{?>
                  <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_professor.php?aluno=<? echo $_GET['aluno']; ?>&amp;componente=36244"><? echo $conta; ?></a>
                <? } ?></th>
                <th scope="col"><?
                 
				 $conta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM busca_ativa_coodenacao WHERE aluno = '".$_GET['aluno']."'"));
				
				?>
                  <? if($conta == ''){ echo "0"; }else{?>
                  <a rel="superbox[iframe][900x500]" href="scripts/mostra_busca_ativa_coordenador.php?aluno=<? echo $_GET['aluno']; ?>"><? echo $conta; ?></a>
                <? } ?></th>
              </tr>
            </tbody>
      </table>
          <hr />
          <p>&nbsp;</p>
          
          
          
      <h4 style="color:#F00;"><strong>Hist&oacute;rico de acessos</strong></h4>
      <hr />
          <table style="text-align:center; font:12px Arial, Helvetica, sans-serif;" class="table table-bordered">
            <thead>
              <tr>
                <th width="94" style="border:1px solid #FFF;" scope="col"><img src="../img/acessos.png" alt="" width="50" height="30" /></th>
                <th width="204" scope="col"><strong>DATA</strong></th>
                <th width="176" scope="col"><strong>IP </strong></th>
                <th width="330" scope="col"><strong>COMPONENTE</strong></th>
                <th width="254" scope="col"><strong>PROFESSOR</strong></th>
              </tr>
            </thead>
            <tbody>
            <?
             
			 $sql_acessos = mysqli_query($conexao_bd, "SELECT * FROM visualiza_atividade WHERE aluno = '".$_GET['aluno']."' ORDER BY id DESC LIMIT 50");
			  while($res_acessos = mysqli_fetch_array($sql_acessos)){
			?>
              <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col"><? echo $res_acessos['data']; ?></th>
                <th scope="col"><a target='_blank' href='https://www.ip2location.com/demo/<? echo $res_acessos['ip']; ?>'><? echo $res_acessos['ip']; ?></a></th>
                <th scope="col"><?
                 
				 $sql_busca_componente = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".$res_acessos['atividade']."'");
					while($res_busca_componente = mysqli_fetch_array($sql_busca_componente)){
						$sql_disciplina = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_busca_componente['componente']."'");
						while($res_disciplinas = mysqli_fetch_array($sql_disciplina)){
							echo $res_disciplinas['componente'];
						}
					}
				?></th>
                <th scope="col"><?
                 
				 $sql_busca_componente = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '".$res_acessos['atividade']."'");
					while($res_busca_componente = mysqli_fetch_array($sql_busca_componente)){
						
						$sql_disciplina = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_busca_componente['usuario']."'");
						while($res_disciplinas = mysqli_fetch_array($sql_disciplina)){
							echo $res_disciplinas['nome_escola'];
						}
					}
				?></th>             
              </tr>
            <? } ?>
            </tbody>
      </table>
          <hr />
          <p>&nbsp;</p>          
  </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
