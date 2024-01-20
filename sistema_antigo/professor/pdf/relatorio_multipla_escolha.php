<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<? require "../../conexao.php"; $professor = $_GET['professor']; ?>
</head>

<body>
<div class="container_tuod"> <? $turma = $_GET['turma']; $atividade = $_GET['atividade']; ?>
    <div class="container">
      <div class="row">
        <div class="col-sm">
  		<?
		 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '".$_GET['atividade']."'");
		  while($res_atividade = mysqli_fetch_array($sql_atividades)){
				   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_atividade['turma']."'");
	         		while($res_turma = mysqli_fetch_array($sql_turma)){
			  
		?>
        </div>
        <table class="table table-striped" border="1">
          <thead>
            <tr>
              <th width="13%" scope="col"><img src="../../img/logo.png" alt="" width="100" height="100" /></th>
              <th colspan="4" align="center" scope="col"><h2>RELAT&Oacute;RIO DE ATIVIDADE ONLINE</h2>
              <h4 class="h6"><? echo $res_atividade['objetivo']; ?></h6></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">COMPONENTE</th>
              <td colspan="4" rowspan="2"><? echo $res_atividade['objetivo']; ?>
              <hr />
              <strong>Professor:</strong> 
              <?
				$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM professor WHERE operador = '".$res_atividade['usuario']."'");
				while($res_professor = mysqli_fetch_array($sql_professor)){
					echo $res_professor['nome'];
				}
			  ?>              
              </td>
            </tr>
            <tr>
              <th scope="row">MATEM&Aacute;TICA</th>
            </tr>
            <tr>
              <th scope="row">COD.</th>
              <td width="33%"><strong>ESCOLA</strong></td>
              <td width="17%"><strong>ANO</strong></td>
              <td width="19%"><strong>TURMA</strong></td>
              <td width="18%"><strong>TURNO</strong></td>
            </tr>
            <tr>
              <th scope="row"><? echo $res_atividade['code_atividade']; ?></th>
              <td><? 
			   $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM escolas WHERE code_escola = '".$res_turma['code_escola']."'");
			    while($res_escola = mysqli_fetch_array($sql_escola)){
					echo $res_escola['nome_escola'];
				}
			  
			  ?></td>
              <td><? echo $res_turma['code_serie']; ?>° ano</td>
              <td><? echo $res_turma['tipo_turma']; ?></td>
              <td><? echo $res_turma['turno']; ?></td>
            </tr>
          </tbody>
        </table>
        </div>
        <? }} ?>
        <br />
        
        <table border="1" class="table table-striped table-hover">
           <thead>
            <tr>
              <th width="11%" scope="col">STATUS</th>
              <th width="12%" scope="col">N° CHAMADA</th>
              <th width="19%" scope="col">NOME</th>
              <th width="14%" scope="col">ENTREGA</th>
              <th width="9%" scope="col">NOTA</th>
              <th width="12%" scope="col">ACERTO</th>
              <th width="8%" scope="col">ERRO</th>
              <th width="15%" scope="col">% APROV</th>
             </tr>
          </thead>
          
          <tbody>
          <? $i = 0;
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  $aluno = 0;
		  $aluno = $res_alunos['code_aluno'];
		  ?>
            <tr>
            
              <?
              
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$_GET['atividade']."' AND aluno = '".$res_alunos['code_aluno']."'");
			  ?>
              <th scope="row" <? if(mysqli_num_rows($sql_data) == ''){ ?> bgcolor="#F7C6B9" <? } ?>><? 
			   if(mysqli_num_rows($sql_data) == ''){
			   	echo "<strong class='text-danger'>NÃO ENTREGUE</strong>";
			   }else{
				echo "ENTREGUE";
			   }
			   ?>
               </th>
              <th><? echo $res_alunos['n_chamada']; ?></th>
              <td><? echo $res_alunos['nome_aluno']; ?></td>
              <td><? 
				$sql_questoes = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE aluno = '".$res_alunos['code_aluno']."' AND atividade = '".$_GET['atividade']."' LIMIT 1");
			   while($res_questoes = mysqli_fetch_array($sql_questoes)){
				   echo $res_questoes['data_completa'];
			   }
			   ?></td>
              <td>
			  <?
				$sql_questoes = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE aluno = '".$res_alunos['code_aluno']."' AND atividade = '".$_GET['atividade']."'");
				$total = mysqli_num_rows($sql_questoes);
				
				$sql_questoes = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE aluno = '".$res_alunos['code_aluno']."' AND atividade = '".$_GET['atividade']."' AND correto = 'SIM'");
				$certo = mysqli_num_rows($sql_questoes);
				
				echo ($certo*10)/$total;
				
			  ?>                
              </td>
              <td>
			  <?
				$sql_questoes = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE aluno = '".$res_alunos['code_aluno']."' AND atividade = '".$_GET['atividade']."' AND correto = 'SIM'");
				echo $certo = mysqli_num_rows($sql_questoes);
			  ?>              
              </td>
              <td>
			  <?
				$sql_questoes = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE aluno = '".$res_alunos['code_aluno']."' AND atividade = '".$_GET['atividade']."' AND correto = 'NAO'");
				echo mysqli_num_rows($sql_questoes);
			  ?>     
              </td>
              <td><? echo number_format(($certo*100)/$total,1); ?>%</td>
            </tr>
          <? } ?>
          </tbody>
	  </table>        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>