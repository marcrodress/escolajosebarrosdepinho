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
        <div class="col-sm">
        <br />
       	  <h5><strong>Conteúdo/Objeto de conhecimento</strong></h5>
            
  		  <table border="0" class="table">
           <thead class="thead-dark">
              <tr>
                <th  bgcolor="#669999"><strong>SELECIONE O ANO:</strong></th >
                <th  bgcolor="#669999"><strong>SELECIONE O COMPONENTE:</strong></th >
              </tr>
           </thead>
              <tr>
                <td><form name="form" id="form">
                  <select name="jumpMenu" size="1" class="form-control" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
                    <option>Selecione</option>
                    <option value="?p=conteudo&ano=1&componente=<? echo $_GET['componente']; ?>">1° Ano</option>
                    <option value="?p=conteudo&ano=2&componente=<? echo $_GET['componente']; ?>">2° Ano</option>
                    <option value="?p=conteudo&ano=3&componente=<? echo $_GET['componente']; ?>">3° Ano</option>
                    <option value="?p=conteudo&ano=4&componente=<? echo $_GET['componente']; ?>">4° Ano</option>
                    <option value="?p=conteudo&ano=5&componente=<? echo $_GET['componente']; ?>">5° Ano</option>
                    <option value="?p=conteudo&ano=6&componente=<? echo $_GET['componente']; ?>">6° Ano</option>
                    <option value="?p=conteudo&ano=7&componente=<? echo $_GET['componente']; ?>">7° Ano</option>
                    <option value="?p=conteudo&ano=8&componente=<? echo $_GET['componente']; ?>">8° Ano</option>
                    <option value="?p=conteudo&ano=9&componente=<? echo $_GET['componente']; ?>">9° Ano</option>
                  </select>
                </form></td>
                <td><select name="jumpMenu2" class="form-control" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
                    <option>Selecione</option>
				    <?
					 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas");
					  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
					?>
                  <option value="?p=conteudo&ano=<? echo $_GET['ano']; ?>&componente=<? echo $res_disciplinas['code']; ?>"><? echo $res_disciplinas['componente']; ?></option>
                  	<? } ?>
               </select></td>
              </tr>
  		  </table>
          
        
        
        <? if(@$_GET['ano'] != NULL && $_GET['componente'] != NULL){ ?>  
        
        <a href="scripts/adicionar_conteudo.php?ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>" rel="superbox[iframe][370x130]" class="btn btn-warning">Cadastrar novo conteúdo/objeto do conhecimento</a>
        <table border="1" class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th colspan="4" scope="col"><? echo $_GET['ano']; ?>&deg; ANO - 				    <?
					 $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['componente']."'");
					  while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
						   echo $res_disciplinas['componente'];
					  }
					?></th>
            </tr>
          </thead>
          <thead class="thead-light">
            <tr>
              <td><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
              <td align="center"><strong>Q&deg; UTILIZA&Ccedil;&Otilde;ES</strong></td>
              <td align="center"><img src="img/deleta.jpg" width="20" height="20" /><img src="img/edita.png" width="20" height="20" /></td>
            </tr>
            </thead>
		   <?
		    $sql_habilidades = mysqli_query($conexao_bd, "SELECT * FROM habilidades WHERE ano = '".$_GET['ano']."' AND componente = '".$_GET['componente']."' AND conteudo != ''");
			  while($res_habilidades = mysqli_fetch_array($sql_habilidades)){
			?>
            <tr>
              <td><? echo $res_habilidades['conteudo']; $eixo = strtoupper($res_habilidades['conteudo']); ?></td>
              <td align="center"><? echo $qu_u = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula WHERE conteudo = '$eixo'")); ?></td>
              <td align="center">
              	  <? if($qu_u <= 0){ ?>
                <script language="Javascript">
					function confirmacao(id) {
						 var resposta = confirm("Deseja remover esse registro?");
						 if (resposta == true) {
							  window.location.href = "?p=conteudo&acao=excluir&ano=<? echo $_GET['ano']; ?>&componente=<? echo $_GET['componente']; ?>&id="+id;
						 }
					}
				  </script>
                  <a href="javascript:func()"
onclick="confirmacao('<? echo $res_habilidades['id'];?>')"><img src="img/deleta.jpg" width="20" height="20" border="0" /></a>
              	  <? } ?> 
                   
              	<a href="scripts/adicionar_conteudo.php?ano=<? echo $_GET['ano']; ?>&id=<? echo $res_habilidades['id'];?>&componente=<? echo $_GET['componente']; ?>" rel="superbox[iframe][370x130]"><img src="img/edita.png" width="20" height="20" border="0" /></a>

                
                </td>
            </tr>
            <? } ?>
          </tbody>
        </table>
        
        <? } ?>  
          
          
          
        </div>
      </div>
    </div>
</div>
</body>
</html>
<? if(@$_GET['b'] == '3'){
$ano = $_GET['ano'];
$componente = $_GET['componente'];
$acao = $_GET['acao'];

mysqli_query($conexao_bd, "UPDATE habilidades SET status = '$acao' WHERE id = '".$_GET['id']."'");
echo "<script language='javascript'>window.location='?p=conteudo&ano=$ano&componente=$componente';</script>";
}?>


<? if(@$_GET['acao'] == 'excluir'){
$ano = $_GET['ano'];
$componente = $_GET['componente'];

mysqli_query($conexao_bd, "DELETE FROM habilidades WHERE id = '".$_GET['id']."'");
echo "<script language='javascript'>window.location='?p=conteudo&ano=$ano&componente=$componente';</script>";
}?>