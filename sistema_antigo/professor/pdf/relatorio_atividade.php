<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<? require "../../conexao.php"; ?>

</head>

<body>
<div class="container_tuod"> <? $turma = $_GET['turma']; $mes_at = $_GET['mes']; $componente = $_GET['componente']; $professor = $_GET['operador']; ?>
  <div class="container">
      <div class="row">
        <div class="col-sm">
  		<?
				   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
	         		while($res_turma = mysqli_fetch_array($sql_turma)){
			  
		?>
        </div>
        <table class="table table-striped" border="1">
          <thead>
            <tr>
              <th width="13%" scope="col"><img src="../../img/logo.png" alt="" width="100" height="100" /></th>
              <th colspan="4" align="center" scope="col"><h2>RELAT&Oacute;RIO DE ATIVIDADES ONLINE MENSAL</h2>
              <p>&nbsp;</p></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">COMPONENTE</th>
              <td colspan="4" rowspan="2">
             <strong> Mês:</strong> <?
             
			 if($mes_at == '01'){
			 	echo "JANEIRO";
			 }elseif($mes_at == '02'){
			 	echo "FEVEREIRO";
			 }elseif($mes_at == '03'){
			 	echo "MARÇO";
			 }elseif($mes_at == '04'){
			 	echo "ABRIL";
			 }elseif($mes_at == '05'){
			 	echo "MAIO";
			 }elseif($mes_at == '06'){
			 	echo "JUNHO";
			 }elseif($mes_at == '07'){
			 	echo "JULHO";
			 }elseif($mes_at == '08'){
			 	echo "AGOSTO";
			 }elseif($mes_at == '09'){
			 	echo "SETEMBRO";
			 }elseif($mes_at == '10'){
			 	echo "OUTUBRO";
			 }elseif($mes_at == '11'){
			 	echo "NOVEMBRO";
			 }else{
			 	echo "DEZEMBRO";
			 }
			 
			 ?>
              <hr />
              <strong>Professor:</strong> 
              <?
				$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$_GET['operador']."'");
				while($res_professor = mysqli_fetch_array($sql_professor)){
					echo $res_professor['nome_escola'];
				}
			  ?>              
              </td>
            </tr>
            <tr>
              <th scope="row">
               <?
				$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['componente']."'");
				while($res_componente = mysqli_fetch_array($sql_componente)){
					echo $res_componente['componente'];
				}
			  ?>
              </th>
            </tr>
            <tr>
              <th scope="row">COD.</th>
              <td width="33%"><strong>ESCOLA</strong></td>
              <td width="17%"><strong>ANO</strong></td>
              <td width="19%"><strong>TURMA</strong></td>
              <td width="18%"><strong>TURNO</strong></td>
            </tr>
            <tr>
              <th scope="row"><? echo $turma; ?></th>
              <td>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</td>
              <td><? echo $res_turma['code_serie']; ?>° ano</td>
              <td><? echo $res_turma['tipo_turma']; ?></td>
              <td><? echo $res_turma['turno']; ?></td>
            </tr>
          </tbody>
        </table>
    </div>
      <? } ?>
        <br />
       
<table class="table table-striped">
          <thead>
            <tr>
              <th colspan="8" align="center" bgcolor="#006699" scope="col">ATIVIDADES DO M&Ecirc;S DE 
              <?
			 if($mes_at == '01'){
			 	echo "JANEIRO";
			 }elseif($mes_at == '02'){
			 	echo "FEVEREIRO";
			 }elseif($mes_at == '03'){
			 	echo "MARÇO";
			 }elseif($mes_at == '04'){
			 	echo "ABRIL";
			 }elseif($mes_at == '05'){
			 	echo "MAIO";
			 }elseif($mes_at == '06'){
			 	echo "JUNHO";
			 }elseif($mes_at == '07'){
			 	echo "JULHO";
			 }elseif($mes_at == '08'){
			 	echo "AGOSTO";
			 }elseif($mes_at == '09'){
			 	echo "SETEMBRO";
			 }elseif($mes_at == '10'){
			 	echo "OUTURBO";
			 }elseif($mes_at == '11'){
			 	echo "NOVEMBRO";
			 }else{
			 	echo "DEZEMBRO";
			 }
			 
			 ?>
              
              </th>
            </tr>
          </thead>
          <thead>
            <tr>
              <th width="4%" scope="col">#</th>
              <th width="9%" scope="col">COD.</th>
              <th width="39%" scope="col">OBJETIVO</th>
              <th width="12%" scope="col">ENTREGA</th>
              <th width="15%" scope="col">ENTREGUE</th>
              <th width="9%" scope="col">FALTA</th>
              <th width="12%" scope="col">FREQU&Ecirc;NCIA</th>
            </tr>
          </thead>
          <?
          $i = 0; 
		   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '$mes_at' AND componente = '$componente' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
		   if(mysqli_num_rows($sql_atividades) == ''){
			   echo "<div class='alert alert-danger' role='alert'>Ainda não foi postado atividades no mês informado!</div>";
		   }else{
		  ?>
          <tbody>
          <? while($res_atividades = mysqli_fetch_array($sql_atividades)){ $i++;?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res_atividades['code_atividade']; ?></td>
              <td><a style="color:#000;" rel="superbox[iframe][400x500]" target="_blank" href="../../?p=2&turma=<? echo $turma; ?>&ik=<? echo base64_encode($res_atividades['id']); ?>&aluno=<?
              	
				$alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."' LIMIT 1");
				   while($res_alunos = mysqli_fetch_array($alunos)){
					   echo $res_alunos['code_aluno'];
				  }
			  
              ?>&disciplina=<? echo $_GET['componente']; ?>"><? echo $res_atividades['objetivo']; ?></a></td>
              <td><? echo $res_atividades['dia']; ?>/<? echo $res_atividades['mes']; ?>/<? echo $res_atividades['ano']; ?></td>
              <td><? $conta_alunos = 0;
			  $total_alunos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."' AND impresso != 'SIM' AND transferido != 'SIM'"));
               if($res_atividades['tipo_envio'] == 'arquivo'){
				   $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
				   
				   while($res_enviados = mysqli_fetch_array($enviados)){
					   $verifica_impresso = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_enviados['code_aluno']."'");
						 while($res_alunos = mysqli_fetch_array($verifica_impresso)){
							 if($res_alunos['impresso'] == 'SIM' || $res_alunos['transferido'] == 'SIM'){
						}else{
							$conta_alunos++;
						}}
				  }
			   }
			   echo $conta_alunos;
			  ?></td>
              <td><? echo $total_alunos-($conta_alunos);?></td>
              <td><? echo number_format(($conta_alunos*100)/$total_alunos,1); ?>%</td>
            </tr>
            <? }} ?>
          </tbody>
	  </table>       
        
    </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>