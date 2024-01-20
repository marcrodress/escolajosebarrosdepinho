<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="jquery.superbox.css" type="text/css" media="all" />
<link href="../img/index.png" rel="shortcut icon" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informações. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>
<style>
#container_tuod{
	background:#FFF;
}
body,td,th {
	color: #000;
	font:12px Arial, Helvetica, sans-serif;
	text-transform:uppercase;
}
</style>
</head>

<body>
<? if($_GET['acao'] == 'ativargg'){

$aluno = $_GET['aluno'];
$dia_t = $_GET['dia'];
$mes_t = $_GET['mes'];
$ano_t = $_GET['ano'];
$turma = $_GET['turma'];

mysqli_query($conexao_bd, "INSERT INTO registro_aee (ip, dia, mes, ano, data_completa, turma, aluno, usuario, dia_atividade, mes_atividade, ano_atividade) VALUES ('$ip', '$dia', '$mes', '$ano', '$data_completa', '$turma', '$aluno', '$operador', '$dia_t', '$mes_t', '$ano_t')");

$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND dia = '$dia_t' AND mes = '$mes_t' AND ano = '$ano_t'");
while($res_atividade = mysqli_fetch_array($sql_atividade)){
	
	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$aluno' AND code_atividade = '".$res_atividade['code_atividade']."'");
	if(mysqli_num_rows($sql_verifica) == ''){
		mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '$operador', '$aluno', '".$res_atividade['code_atividade']."', '10')");
	}else{
		while($res_verifica = mysqli_fetch_array($sql_verifica)){
			
			$data_enviado = $res_verifica['data'];
			$arquivo = $res_verifica['arquivo'];
			
			if($data_enviado == ''){
				mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET data = '$data', arquivo = '$operador', status = 'CORRIGIDO', nota = '10' WHERE code_aluno = '$aluno' AND code_atividade = '".$res_atividade['code_atividade']."'");
			}
			
			
		}
	}

	echo "<script language='javascript'>window.location='?p=lancar_frequencia&turma=$turma&mes=$mes_t';</script>";
	
}
}?>


<? if($_GET['acao'] == 'excluir'){

$aluno = $_GET['aluno'];
$dia_t = $_GET['dia'];
$mes_t = $_GET['mes'];
$ano_t = $_GET['ano'];
$turma = $_GET['turma'];

mysqli_query($conexao_bd, "DELETE FROM registro_aee WHERE aluno = '$aluno' AND turma = '$turma' AND dia_atividade = '$dia_t' AND mes_atividade = '$mes_t' AND ano_atividade = '$ano_t'");


$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND dia = '$dia_t' AND mes = '$mes_t' AND ano = '$ano_t'");
while($res_atividade = mysqli_fetch_array($sql_atividade)){
	
	mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas WHERE arquivo = '$operador' AND code_atividade = '".$res_atividade['code_atividade']."' AND code_aluno = '$aluno'");
		echo "<script language='javascript'>window.location='?p=lancar_frequencia&turma=$turma&mes=$mes_t';</script>";

}
}?>






<? if($_GET['acao'] == 'ativar'){

$aluno = $_GET['aluno'];
$dia_t = $_GET['dia'];
$mes_t = $_GET['mes'];
$ano_t = $_GET['ano'];
$turma = $_GET['turma'];

mysqli_query($conexao_bd, "INSERT INTO registro_aee (ip, dia, mes, ano, data_completa, turma, aluno, usuario, dia_atividade, mes_atividade, ano_atividade) VALUES ('$ip', '$dia', '$mes', '$ano', '$data_completa', '$turma', '$aluno', '$operador', '$dia_t', '$mes_t', '$ano_t')");

$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND dia = '$dia_t' AND mes = '$mes_t' AND ano = '$ano_t'");
while($res_atividade = mysqli_fetch_array($sql_atividade)){
	
	mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '', '$aluno', '".$res_atividade['code_atividade']."', '10')");
	
}
}?>







<? 
$colspan = 0;
			   for($i=1; $i<=31; $i++){ if($i<10){ if($i<10){  $dia_t = "0$i"; }else{  $dia_t = $i; }
			  	
					$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE dia = '$dia_t' AND mes = '".$_GET['mes']."' AND ano = '$ano' AND turma = '".$_GET['turma']."' LIMIT 1");
					if(mysqli_num_rows($sql_atividade) >= 1){
						$colspan++;
					}}
			
			
		} ?>


<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm">
  		<p class="h5 text-primary"><strong>Lançar frequência dE ALUNOS AEE</strong></p>

      
        <table class="table table-striped">
          <thead>
            <tr>
              <th colspan="<? echo $colspan+7; ?>" align="center" bgcolor="#006699" scope="col">ATIVIDADES DO M&Ecirc;S DE JANEIRO
              <script type="text/javascript">
				function MM_jumpMenu(targ,selObj,restore){ //v3.0
				  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
				  if (restore) selObj.selectedIndex=0;
				}
			   </script>
              <form name="" method="post" action="" enctype="multipart/form-data">
              <select size="1" name="mes_filtro" class="form-control" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
                <option value="">ESCOLHER O MÊS</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=01">JANEIRO</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=02">FEVEREIRO</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=03">MAR&Ccedil;O</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=04">ABRIL</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=05">MAIO</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=06">JUNHO</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>mes=07">JULHO</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=08">AGOSTO</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=09">SETEMBRO</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=10">OUTUBRO</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=11">NOVEMBRO</option>
                <option value="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&mes=12">DEZEMBRO</option>
              </select>
              </form>
              </th>
            </tr>
          </thead>
          <thead>
            <tr>
              <th bgcolor="#CCCCCC" scope="col"></th>
              <th bgcolor="#CCCCCC" scope="col"><strong>NOME DO ALUNO</strong></th>
			  <? for($i=1; $i<=31; $i++){ if($i<10){  $dia_t = "0$i"; }else{  $dia_t = $i; }
			  	
					$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE dia = '$dia_t' AND mes = '".$_GET['mes']."' AND ano = '$ano' AND turma = '".$_GET['turma']."' LIMIT 1");
					if(mysqli_num_rows($sql_atividade) == ''){
					}else{
				  ?>
				  <td><? echo $dia_t; ?></td>
                  <? } ?>
              
              
              
              <? } ?>
            </tr>
          </thead>
          <?
          $k = 0;
		   $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE especial = 'SIM' AND turma = '".$_GET['turma']."'");
		   if(mysqli_num_rows($sql_alunos) == ''){
			   echo "<div class='alert alert-danger' role='alert'>Nesta turma não existe aluno atendimento pelo AEE!</div>";
		   }else{
		  ?>
          <tbody>
          <? while($res_alunos = mysqli_fetch_array($sql_alunos)){ $k++;?>
            <tr>
              <th scope="row"><? echo $k; ?></th>
              <td><? echo $res_alunos['nome_aluno']; ?></td>
			  <? for($i=1; $i<=31; $i++){ if($i<10){  $dia_t = "0$i"; }else{  $dia_t = $i; }
			  	
					$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE dia = '$dia_t' AND mes = '".$_GET['mes']."' AND ano = '$ano' AND turma = '".$_GET['turma']."' LIMIT 1");
					if(mysqli_num_rows($sql_atividade) == ''){
					}else{
				  ?>
				  <td>
				  <?
					$sql_registro_aee = mysqli_query($conexao_bd, "SELECT * FROM registro_aee WHERE aluno = '".$res_alunos['code_aluno']."' AND turma = '".$_GET['turma']."' AND dia_atividade = '$dia_t' AND mes_atividade = '".$_GET['mes']."' AND ano_atividade = '$ano'");
					
				  if(mysqli_num_rows($sql_registro_aee) == ''){ ?>
				  <a href="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&dia=<? echo $dia_t; ?>&mes=<? echo $_GET['mes']; ?>&ano=<? echo $ano; ?>&acao=ativargg&aluno=<? echo $res_alunos['code_aluno']; ?>"><img src="img/correto_atividade.png" title="Lançar frequência deste dia" width="15" height="15" /></a>	 
				  <? }else{ ?>
				  <a href="?p=lancar_frequencia&turma=<? echo $_GET['turma']; ?>&dia=<? echo $dia_t; ?>&mes=<? echo $_GET['mes']; ?>&ano=<? echo $ano; ?>&acao=excluir&aluno=<? echo $res_alunos['code_aluno']; ?>"><img src="img/errado_atividade.png" title="Excluir frequência desse aluno neste dia" width="15" height="15" /></a>	 						
				  <? } ?>
                  </td>
                  <? } ?>
              
              
              
              <? } ?>
            
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