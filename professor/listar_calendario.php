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
		  <h5 class="text-info" style="margin:5px;"><strong>Calendário letivo</strong></h5>
 		  <form name="form" id="form">
 		    <select class="form-control" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
 		      <option value="Selecione o m&ecirc;s">Selecione o m&ecirc;s</option>
 		      <option value="?p=listar_calendario&mes=01&ano=<? echo date("Y"); ?>">Janeiro</option>
 		      <option value="?p=listar_calendario&mes=02&ano=<? echo date("Y"); ?>">Feveiro</option>
 		      <option value="?p=listar_calendario&mes=03&ano=<? echo date("Y"); ?>">Mar&ccedil;o</option>
 		      <option value="?p=listar_calendario&mes=04&ano=<? echo date("Y"); ?>">Abril</option>
 		      <option value="?p=listar_calendario&mes=05&ano=<? echo date("Y"); ?>">Maio</option>
 		      <option value="?p=listar_calendario&mes=06&ano=<? echo date("Y"); ?>">Junho</option>
 		      <option value="?p=listar_calendario&mes=07&ano=<? echo date("Y"); ?>">Julho</option>
 		      <option value="?p=listar_calendario&mes=08&ano=<? echo date("Y"); ?>">Agosto</option>
 		      <option value="?p=listar_calendario&mes=09&ano=<? echo date("Y"); ?>">Setembro</option>
 		      <option value="?p=listar_calendario&mes=10&ano=<? echo date("Y"); ?>">Outubro</option>
 		      <option value="?p=listar_calendario&mes=11&ano=<? echo date("Y"); ?>">Novembro</option>
 		      <option value="?p=listar_calendario&mes=12&ano=<? echo date("Y"); ?>">Dezembro</option>
            </select>
	      </form>
          
          <br />
          
            <table width="1000" border="1" class="table table-bordered">
              <thead class="thead-info">
                <tr>
                  <th width="37" scope="col">Data</th>
                  <th width="36" scope="col">Tipo</th>
                  <th width="905" scope="col">Acontecimento</th>
                </tr>
              </thead>
              <tbody>
              <?
			  
			  $mes_calendario = $_GET['mes'];
			  $mes_calendarios = $_GET['mes']+1;
			  

			  $ano_calendario = $_GET['ano'];
			  $dia_calendario = 01;
			  if($dia_calendario < 10){
			  	$dia_calendario = "0$dia_calendario";
			  }
			  if($mes_calendarios < 10){
			  	$mes_calendarios = "0$mes_calendarios";
			  }
			  

			  
			  
			  $data_calendario = "$dia_calendario/$mes_calendario/$ano_calendario ";
			  
			  if($mes_calendarios >= 12){
				  $mes_calendarios = 01;
				  $ano_calendario = $ano_calendario+1;
			  }
			  			  if($mes_calendarios < 10 && $_GET['mes'] >= 12){
			  	$mes_calendarios = "0$mes_calendarios";
			  }
			  
			  $data_calendarios = "$dia_calendario/$mes_calendarios/$ano_calendario";
			  
			  $code_primeiro = 0;
			  $code_ultimo = 0;
			  
			  $sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data_calendario'");
				while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
					  $code_primeiro = $res_code_vencimento['codigo'];
			 }
			 
			  $sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data_calendarios'");
				while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
					  $code_ultimo = $res_code_vencimento['codigo']-1;
			 }							  
               
			   $total_registros = $code_ultimo-$code_primeiro;
			   
			   $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo BETWEEN '$code_primeiro' AND '$code_ultimo'");
			    mysqli_num_rows($sql_calendario);
			    while($res_calendario = mysqli_fetch_array($sql_calendario)){
			  ?>
              
              <thead class="thead-dark">
              
                <tr>
                  <th  scope="row"><? echo $res_calendario['vencimento']; ?></th >
                  <?
                  
				   $sql_verifica_atividade = mysqli_query($conexao_bd, "SELECT * FROM calendativo_letivo WHERE data = '".$res_calendario['codigo']."'");
				   while($sql_verifica_atividade = mysqli_fetch_array($sql_verifica_atividade)){
				  ?>
                  <th ><? echo $sql_verifica_atividade['tipo']; ?></th >
                  <th >
				  		<? 
						
						if($sql_verifica_atividade['ordem'] == 'INICIO'){ echo "<strong>INICIO: </strong>"; }
						if($sql_verifica_atividade['ordem'] == 'FIM'){ echo "<strong>FIM: </strong>"; }
						
						echo $sql_verifica_atividade['titulo']; ?>
                        
                  </th >
                  <? } ?>
                </tr>
                </thead>
                <? } ?>
              </tbody>
            </table>
          
          
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>