<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="../jquery.superbox-min.js"></script>
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
<? require "../../conexao.php"; ?>

</head>

<body>
<div class="container_tuod"> <? $turma = $_GET['turma']; $mes_at = $_GET['mes']; $professor = $_GET['operador']; ?>
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
					echo strtoupper($res_professor['nome_escola']);
				}
			  ?>               
              </td>
            </tr>
            <tr>
              <th scope="row">               <?
				$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['componente']."'");
				while($res_componente = mysqli_fetch_array($sql_componente)){
					echo $res_componente['componente'];
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
              <th colspan="7" align="center" bgcolor="#0099CC" scope="col">ATIVIDADES DO M&Ecirc;S DE 
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
              <th width="5%" scope="col">#</th>
              <th width="40%" scope="col">ALUNO</th>
              <? $total_atividades = 0;
				$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '$mes_at' AND componente = '".$_GET['componente']."' AND turma = '$turma' ORDER BY code_dia_atividade ASC");
				while($res_atividades = mysqli_fetch_array($sql_atividades)){ $total_atividades++;
			  ?>
              <th scope="col"><? echo $res_atividades['dia']; ?>/<? echo $res_atividades['mes']; ?></th>
              <? } ?>
              <th width="30%" scope="col">FREQU&Ecirc;NCIA</th>
            </tr>
          </thead>
          <tbody>
          <? 
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$turma."' AND transferido != 'SIM'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $soma_atividade_aluno = 0;
		  $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_alunos['aluno']."'");
		  while($res_aluno = mysqli_fetch_array($sql_aluno)){ $soma_atividade_aluno = 0;
		  ?>
            <tr>
              <th scope="row"><? echo $res_alunos['n_chamada']; ?></th>
              <td><? echo strtoupper($res_aluno['nome_aluno']); ?></td>
              
              <? 
				$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE mes = '$mes_at' AND componente = '".$_GET['componente']."' AND turma = '$turma'");
				while($res_atividades = mysqli_fetch_array($sql_atividades)){
					$tipo_envio = 0;
					$enviado = 0;
					
					$tipo_envio = $res_atividades['tipo_envio'];
					
					if($tipo_envio == 'arquivo'){
					
					$sql_arquivo = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."'");
					
					$status_envio = NULL;
					$data_envio = NULL;
					$arquivo_atividade = NULL;
					
					 while($res_arquivo = mysqli_fetch_array($sql_arquivo)){
						 $status_envio = $res_arquivo['status'];
						 $arquivo_atividade = $res_arquivo['arquivo'];
						 $data_envio = $res_arquivo['data'];
					}
					
						if(mysqli_num_rows($sql_arquivo) >= 1 && $data_envio == NULL){
							$enviado = 2;
						}
						
						if($status_envio != NULL){
							$enviado = 1;
						}
							
						
						if($enviado == 1){ $soma_atividade_aluno++; }
						
						
					}
					
					if($tipo_envio == 'multipla'){
						
						$sql_verifica_multipla = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE aluno = '".$res_alunos['aluno']."' AND atividade = '".$res_atividades['code_atividade']."'");
						if(mysqli_num_rows($sql_verifica_multipla) >= 1){ $enviado = 1; $soma_atividade_aluno++;
						}
					}
						
					
			  ?>

              <th scope="col">
			    <? if($enviado == 1){ ?> <a href="#" onclick="javascript:abrirJanela('mostrar_atividade.php?arquivo_artividade=<? echo $arquivo_atividade; ?>&aluno=<? echo $res_alunos['aluno']; ?>&atividade=<? echo $res_atividades['code_atividade']; ?>', 900, 600);"><img src="../img/correto_atividade.png" width="25" height="25" /><? if($status_envio == 'AGUARDA'){ ?>.<? } ?></a>
			    <? }elseif($enviado == 2){ ?><a href="#" onclick="javascript:abrirJanela('mostrar_atividade.php?arquivo_artividade=<? echo $arquivo_atividade; ?>&aluno=<? echo $res_alunos['aluno']; ?>&atividade=<? echo $res_atividades['code_atividade']; ?>', 900, 600);"><img src="../img/olho_nao.fw.png" title="<?
                     
					 $sql_visualiza = mysqli_query($conexao_bd, "SELECT * FROM visualiza_atividade WHERE atividade = '".$res_atividades['id']."' AND aluno = '".$res_alunos['aluno']."'");
					  while($res_visualiza = mysqli_fetch_array($sql_visualiza)){
						  echo $res_visualiza['data'];
						  echo "<-->";
					  }
				     
				   ?>" width="25" height="25" /></a>
			    <? }else{ ?>
                <a href="#" onclick="javascript:abrirJanela('mostrar_atividade.php?arquivo_artividade=<? echo $arquivo_atividade; ?>&aluno=<? echo $res_alunos['aluno']; ?>&atividade=<? echo $res_atividades['code_atividade']; ?>', 900, 600);"><img src="../img/errado_atividade.png" width="25" height="25" /></a><? } ?>
              </th>
			  <? } // WHILE QUE GERA AS COLUGAS DAS ATIVIDAS ?>
              <td><? echo number_format(($soma_atividade_aluno*100)/$total_atividades,1); ?>%</td>
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
<script type="text/javascript">
<!--
function abrirJanela(pagina, largura, altura) {
// Definindo centro da tela
var esquerda = (screen.width - largura)/2;
var topo = (screen.height - altura)/2;
// Abre a nova janela
minhaJanela = window.open(pagina,'','height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
}
-->
</script>