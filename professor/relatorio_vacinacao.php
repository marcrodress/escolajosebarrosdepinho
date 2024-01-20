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
        <p class="h5 text-primary"><strong>Relatório de vacinação COVID-19</strong></p>
        <hr />
        <form name="form" id="form">
          <select name="jumpMenu" class="form-control form-control-lg" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
            <option value="">Selecione a profiss&atilde;o</option>
            <option value="?p=relatorio_vacinacao&profissao=PROFESSOR">Professor</option>
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
            <th width="78">Fun&ccedil;&atilde;o</th>
            <th width="316">Nome do colaborador</th>
            <th width="207" align="center">1&deg; dose</th>
            <th width="166" align="center">2&deg; dose</th>
            <th width="199" align="center">3&deg; dose</th>
          </tr>
          <?
           $sql_coladorares = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE status = 'Ativo'");
		    while($res_coladorares = mysqli_fetch_array($sql_coladorares)){
		  ?>          
          <tr>
            <td><?
               $sql_colaboradores_contratos = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_contratos WHERE status = 'Ativo' AND cpf = '".$res_coladorares['cpf']."' AND cargo = 'PROFESSOR' LIMIT 1");		   
                while($res_colaboradores_contratos = mysqli_fetch_array($sql_colaboradores_contratos)){
					echo $res_colaboradores_contratos['cargo'];
			   }
              ?></td>
            <td><? echo $res_coladorares['nome']; ?></td>
            <td>
              <?
               $sql_vacinacao = mysqli_query($conexao_bd, "SELECT * FROM vacinacao WHERE tipo_vacina = 'COVID-19' AND cpf = '".$res_coladorares['cpf']."' AND n_dose = '1° DOSE'");
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
               $sql_vacinacao = mysqli_query($conexao_bd, "SELECT * FROM vacinacao WHERE tipo_vacina = 'COVID-19' AND cpf = '".$res_coladorares['cpf']."' AND n_dose = '2° DOSE'");
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
               $sql_vacinacao = mysqli_query($conexao_bd, "SELECT * FROM vacinacao WHERE tipo_vacina = 'COVID-19' AND cpf = '".$res_coladorares['cpf']."' AND n_dose = '3° DOSE'");
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
          <? } ?>
          <tr>
            <td colspan="2" align="right">Doses aplicadas aplicadas</td>
            <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao WHERE tipo_vacina = 'COVID-19' AND n_dose = '1° DOSE'")); ?></td>
            <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao WHERE tipo_vacina = 'COVID-19' AND n_dose = '2° DOSE'")); ?></td>
            <td><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao WHERE tipo_vacina = 'COVID-19' AND n_dose = '3° DOSE'")); ?></td>
          </tr>
          <tr>
            <td colspan="2" align="right">A serem aplicadas</td>
            <td><? echo mysqli_num_rows($sql_coladorares) - mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao WHERE tipo_vacina = 'COVID-19' AND n_dose = '1° DOSE'")); ?></td>
            <td><? echo mysqli_num_rows($sql_coladorares) - mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao WHERE tipo_vacina = 'COVID-19' AND n_dose = '2° DOSE'")); ?></td>
            <td><? echo mysqli_num_rows($sql_coladorares) - mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM vacinacao WHERE tipo_vacina = 'COVID-19' AND n_dose = '3° DOSE'")); ?></td>
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