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
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm"><p></p>
        <p class="h5 text-primary"><strong>Relatório de vacinação COVID-19 por turma</strong></p>
        <hr />
        <form name="form" id="form">
          <select name="jumpMenu" class="form-control form-control-lg" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
            <option value="">Selecione a turma</option>
				<?
                    $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_serie = '1' OR code_serie = '2' OR code_serie = '3' OR code_serie = '4' OR code_serie = '5' OR code_serie = '6' OR code_serie = '7' OR code_serie = '8' OR code_serie = '9' ORDER BY code_serie ASC");
                    while($res_turma = mysqli_fetch_array($sql_turma)){
                ?>
            <option value="?p=relatorio_por_tuma&turma=<? echo $res_turma['code_turma']; ?>"><? echo $res_turma['code_serie']; ?>° ANO - <? echo $res_turma['tipo_turma']; ?> - TURMA: <? echo $res_turma['turno']; ?></option>
          	<? } ?>
          </select>
        </form>

<hr />

<table width="1000" border="1" class="table table-bordered">
  <thead class="thead-dark">
          <tr>
            <td colspan="5" align="center"><h5 style="padding:0; margin:0;"><strong>RELAT&Oacute;RIO DE VACINA&Ccedil;&Atilde;O COVID-19</strong> 
           
            <img align="right" src="../img/compartilhar.png" width="20" height="20" title="Compartilhar relatório" />
 
            <img align="right" style="margin:0 5px 0 5px;" src="img/impressora2.png" width="20" height="20" title="Iimprimir relatório" /> 
           </h5>
           </td>
          </tr>
          <tr>
            <th width="17">N&deg;</th>
            <th width="429">Nome do colaborador</th>
            <th width="181" align="center">1&deg; dose</th>
            <th width="164" align="center">2&deg; dose</th>
            <th width="175" align="center">3&deg; dose</th>
          </tr>
          <?
           $sql_turmas_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE status = 'Ativo' AND turma = '".$_GET['turma']."' AND transferido != 'SIM'");
		    while($res_alunos = mysqli_fetch_array($sql_turmas_alunos)){
				$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_alunos['aluno']."'");
				    while($res_alunos_nome = mysqli_fetch_array($sql_alunos)){				
		  ?>          
          <tr>
            <td><? echo $res_alunos['n_chamada']; ?></td>
            <td style="font:12px Arial, Helvetica, sans-serif;"><a rel="superbox[iframe][1050x400]" href="scripts/informacao_vacinacao_aluno.php?aluno=<? echo $res_alunos['aluno']; ?>"><? echo strtoupper($res_alunos_nome['nome_aluno']); ?></a> | 
            
<? 
				
			
				$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE aluno = '".$res_alunos['aluno']."' AND tipo = 'Telefone'");
				 while($res_verifica = mysqli_fetch_array($sql_verifica)){
					 $contato = $res_verifica['contato'];
					 
                     $contato = str_replace(" ", "", $contato); 
                     $contato = str_replace(".", "", $contato);
                     $contato = str_replace("(", "", $contato); 
                     $contato = str_replace(")", "", $contato);
                                         
                         echo "<a href='https://api.whatsapp.com/send/?phone=55$contato&text&app_absent=0' target='_blank'>$contato</a>";
                         
                         echo " / ";					 
					 
				}
			
			
			 ?>            
            </td>
            <td>
              <?
               $sql_vacinacao = mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE tipo_vacina = 'COVID-19' AND aluno = '".$res_alunos['aluno']."' AND n_dose = '1'");
			   if(mysqli_num_rows($sql_vacinacao) == ''){
				   echo "NÃO TOMOU";
			   }else{			   
                while($res_vacinacao = mysqli_fetch_array($sql_vacinacao)){
					echo $res_vacinacao['fabricante'];
					echo " | ";
					echo $res_vacinacao['data_aplicacao'];
				}
			   }
              ?>              
            </td>
            <td>
			  <?
               $sql_vacinacao = mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE tipo_vacina = 'COVID-19' AND aluno = '".$res_alunos['aluno']."' AND n_dose = '2'");
			   if(mysqli_num_rows($sql_vacinacao) == ''){
				   echo "NÃO TOMOU";
			   }else{			   
                while($res_vacinacao = mysqli_fetch_array($sql_vacinacao)){
					echo $res_vacinacao['fabricante'];
					echo " | ";
					echo $res_vacinacao['data_aplicacao'];
				}
			   }
              ?>             
            </td>
            <td>
			  <?
               $sql_vacinacao = mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE tipo_vacina = 'COVID-19' AND aluno = '".$res_alunos['aluno']."' AND n_dose = '3'");
			   if(mysqli_num_rows($sql_vacinacao) == ''){
				   echo "NÃO TOMOU";
			   }else{
                while($res_vacinacao = mysqli_fetch_array($sql_vacinacao)){
					echo $res_vacinacao['fabricante'];
					echo " | ";
					echo $res_vacinacao['data_aplicacao'];
				}
			   }
              ?>             
            </td>
          </tr>
          <? }} ?>
          <tr>
            <td colspan="2" align="right">Doses aplicadas aplicadas</td>
            <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE tipo_vacina = 'COVID-19' AND n_dose = '1'")); ?></td>
            <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE tipo_vacina = 'COVID-19' AND n_dose = '2'")); ?></td>
            <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE tipo_vacina = 'COVID-19' AND n_dose = '3'")); ?></td>
          </tr>
          <tr>
            <td colspan="2" align="right">A serem aplicadas</td>
            <td><? echo mysqli_num_rows($sql_turmas_alunos)-mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE tipo_vacina = 'COVID-19' AND n_dose = '1'")); ?></td>
            <td><? echo mysqli_num_rows($sql_turmas_alunos)-mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE tipo_vacina = 'COVID-19' AND n_dose = '2'")); ?></td>
            <td><? echo mysqli_num_rows($sql_turmas_alunos)-mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE tipo_vacina = 'COVID-19' AND n_dose = '3'")); ?></td>
          </tr>
         </thead>
      </table>

        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>

<? if(@$_GET['pg'] == '1'){

$cpf = $_GET['cpf'];
$acao = $_GET['acao'];

mysqli_query($conexao_bd, "UPDATE coladorares SET status = '$acao' WHERE cpf = '$cpf'");
mysqli_query($conexao_bd, "UPDATE acesso_sistema SET status = '$acao' WHERE cpf = '$cpf'");

echo "<script language='javascript'>window.location='?p=mostra_colaboradores';</script>";

}?>