<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>


</head>

<body>
<div class="container_tuod"> <? $turma = $_GET['turma']; $componente = $_GET['componente']; $aluno = $_GET['aluno']; $mes_at = $_POST['mes']; $professor = $_GET['operador']; ?>
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
            <th width="13%" scope="col"><img src="http://www.escolaleornebelem.com/img/logo.fw.png" alt="" width="120" height="100" /></th>
            <th colspan="4" align="center" scope="col"><h2>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</h2>
            <h2>RELAT&Oacute;RIO MENSAL DE TURMA</h2></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">COMPONENTE</th>
            <td colspan="2" rowspan="2">
		      <strong>Aluno:</strong>
              <?
				$sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$_GET['aluno']."' LIMIT 1");
				while($res_aluno = mysqli_fetch_array($sql_aluno)){
					echo $res_aluno['nome_aluno'];
				}
			  ?>   		
              <hr />
              <strong>Professor:</strong> 
              <?
				$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE disciplina = '$componente' AND turma = '$turma'");
				while($res_professor = mysqli_fetch_array($sql_professor)){
					
					$sql_prof = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_professor['professor']."'");
					 while($res_prof = mysqli_fetch_array($sql_prof)){
						 echo $res_prof['nome_escola'];
					}
					
					
				}
			  ?>              
            
           </td>
            <td colspan="2" rowspan="2"> <strong> Mês:</strong> <?
             
			 if($mes_at == '01'){
			 	echo "Janeiro";
			 }elseif($mes_at == '02'){
			 	echo "Fevereiro";
			 }elseif($mes_at == '03'){
			 	echo "Março";
			 }elseif($mes_at == '04'){
			 	echo "Abril";
			 }elseif($mes_at == '05'){
			 	echo "Maio";
			 }elseif($mes_at == '06'){
			 	echo "Junho";
			 }elseif($mes_at == '07'){
			 	echo "Julho";
			 }elseif($mes_at == '08'){
			 	echo "Agosto";
			 }elseif($mes_at == '09'){
			 	echo "Setembro";
			 }elseif($mes_at == '10'){
			 	echo "Outubro";
			 }elseif($mes_at == '11'){
			 	echo "Novembro";
			 }else{
			 	echo "DEZEMBRO";
			 }
			 
			 ?>
            <hr />
           <strong>Frequência:</strong> 
              <?
               $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
			   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '$mes_at' AND usuario = '$professor' AND turma = '$turma'");
			    $total_atividades = mysqli_num_rows($sql_atividades);
			 
			   while($res_atividades = mysqli_fetch_array($sql_atividades)){
				   
				   if($res_atividades['tipo_envio'] == 'arquivo'){
					   $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$_GET['aluno']."'");
					   if(mysqli_num_rows($enviados) >= 1){ $enviado++; }
				   }else{
					   $enviados = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$_GET['aluno']."'");
					   $total_questao = mysqli_num_rows($enviados);
					   if(mysqli_num_rows($enviados) >= 1){ $enviado++; }		   
				   }
				   
			  }
				    echo number_format(($enviado*100)/$total_atividades,1);
			  ?>%
            </td>
          </tr>
          <tr>
            <th scope="row"><?
            $sql_disciplina = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['componente']."'");
			while($res_disciplina = mysqli_fetch_array($sql_disciplina)){
				echo $res_disciplina['componente'];
			}
						
			?></th>
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
            <td><? 
			   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
			    while($res_turma = mysqli_fetch_array($sql_turma)){
			 
			   $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_turma['code_escola']."'");
			    while($res_escola = mysqli_fetch_array($sql_escola)){
				 	echo $res_escola['nome_escola'];

			  
			  ?></td>
            <td><? echo $res_turma['code_serie']; ?>° ano</td>
            <td><? echo $res_turma['tipo_turma']; ?></td>
            <td><? echo $res_turma['turno']; ?></td>
          </tr>
          <? }} ?>
        </tbody>
      </table>
    </div>
      <? } ?>
        <br />
       
<table class="table table-striped">
          <thead>
            <tr>
              <th width="4%" scope="col">#</th>
              <th colspan="2" scope="col">NOME DO ALUNO</th>
              <th width="15%" scope="col">ENTREGA MAX.</th>
              <th width="15%" scope="col">SITUA&Ccedil;&Atilde;O</th>
              <th width="15%" scope="col">D. ENTREGA</th>
              <th width="12%" scope="col">NOTA</th>
            </tr>
          </thead>
          <?
          $i = 0; 
		   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '$mes_at' AND componente = '$componente' AND turma = '$turma'");
		   if(mysqli_num_rows($sql_atividades) == ''){
			   echo "<div class='alert alert-danger' role='alert'>Ainda não foi postado atividades no mês informado!</div>";
		   }else{
		  ?>
          <tbody>
          <? while($res_atividades = mysqli_fetch_array($sql_atividades)){ $i++;?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td width="9%"><? echo $res_atividades['habilidade']; ?></td>
              <td width="35%"><? echo $res_atividades['objetivo']; ?></td>
              <td><? echo $res_atividades['dia']; ?>/<? echo $res_atividades['mes']; ?>/<? echo $res_atividades['ano']; ?></td>
              <? $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0;
               if($res_atividades['tipo_envio'] == 'arquivo'){
				   $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$_GET['aluno']."'");
				   if(mysqli_num_rows($enviados) >= 1){ 
				   	$enviado = 1; 
					while($res_enviados = mysqli_fetch_array($enviados)){
						$nota = $res_enviados['nota']; 
						$data_entrega = $res_enviados['data']; 
					}
				   
				   }
			   }else{
				   $enviados = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$_GET['aluno']."'");
				   $total_questao = mysqli_num_rows($enviados);
				   if(mysqli_num_rows($enviados) >= 1){ 
				   	$enviado = 1; 
					while($res_enviados = mysqli_fetch_array($enviados)){
						 $data_entrega = $res_enviados['data_completa'];
						if($res_enviados['correto'] == 'SIM'){
							$certo++;
						}
					}
					
					$nota = ($certo*10)/$total_questao;
				   
				   }		   
			   }
			  ?>
              <td <? if($enviado == 0){?> bgcolor="#FC8A7A" <? } ?>><? if($enviado == 0){ echo "NÃO ENTREGUE"; }else{ echo "ENTREGUE"; } ?></td>
              <td <? if($enviado == 0){?> bgcolor="#FC8A7A" <? } ?>><? if($enviado == 0){  }else{ echo $data_entrega; } ?></td>
              <td <? if($enviado == 0){?> bgcolor="#FC8A7A" <? } ?>><? if($enviado == 0){ }else{ echo number_format($nota,1); } ?></td>
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