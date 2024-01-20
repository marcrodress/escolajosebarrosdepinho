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
</head>

<body>
<? mysqli_query($conexao_bd, "DELETE FROM turmas WHERE usuario = '$operador' AND code_escola = ''"); ?>

<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm">
        <a style="margin:5px 0 0 0;"rel="superbox[iframe][500x100]" href="scripts/filtro_infrequencia_relatorio_semanal.php?inicio=<? echo $_GET['inicio']; ?>&final=<? echo $_GET['final']; ?>&turma=&p=turma" class="btn btn-success">Alterar turma</a>
        <hr />
        <p class="h4 text-primary">Turmas cadastradas</p>
 		<table width="1000" class="table  table-striped table-bordered" border="0">
        <thead class="thead-dark">
          <tr>
            <th colspan="3"><h6 style="padding:0; margin:0;"><strong>
			<?
             $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
             while($res_turma = mysqli_fetch_array($sql_turmas)){
            ?>
            	<? echo $res_turma['fase']; ?>: <? echo $res_turma['code_serie']; ?>°: <? echo $res_turma['tipo_turma']; ?> - <? echo $res_turma['turno']; ?> - Sala: <? echo $res_turma['sala']; ?>
            <? } ?>
            
            - 
            
            <?
            
				$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$_GET['inicio']."'");
				while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
					echo $code_hoje = $res_code_vencimento['vencimento'];
				}
				echo " à ";
				$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$_GET['final']."'");
				while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
					echo $code_hoje = $res_code_vencimento['vencimento'];
				}				
			
			?>
            
            </strong></h6></th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td width="97"><strong>N° CHAMADA</strong></td>
            <td width="478"><strong>NOME</strong></td>
            <td width="411"><strong>TELEFONES</strong></td>
          </tr>
          
          <? $inicio_atividade = $_GET['inicio']; $fim_atividade = $_GET['final'];
			   
		   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND laudado != 'SIM' AND transferido != 'SIM' AND impresso != 'SIM'");
		   while($res_turma = mysqli_fetch_array($sql_turma)){
			   
		   $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_turma['aluno']."'");
		   while($res_aluno = mysqli_fetch_array($sql_aluno)){
			   
			   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."'");
			   
			     while($res_atividades = mysqli_fetch_array($sql_atividades)){

					 if($res_atividades['code_dia_atividade'] <= $fim_atividade && $res_atividades['code_dia_atividade'] >= $inicio_atividade){

					 $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_turma['aluno']."' AND code_atividade = '".$res_atividades['code_atividade']."' AND data != ''");
					 
					 if(mysqli_num_rows($sql_atividades_enviadas) >= 1){
						 $verifica_aluno = 1;
					 }
					 
					 $sql_atividade_multipla_escolha = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE aluno = '".$res_turma['aluno']."' AND atividade = '".$res_atividades['code_atividade']."'");
					 if(mysqli_num_rows($sql_atividade_multipla_escolha) >= 1){
						 $verifica_aluno = 1;
					 }					 
					 
				    }
				}
		  
		  if($verifica_aluno == 0){   
		  ?>          
          <tr>
            <td align="center"><? echo $res_turma['n_chamada']; ?></td>
            <td><? echo strtoupper($res_aluno['nome_aluno']); ?></td>
            <td>
            
			<a rel="superbox[iframe][400x250]" href="scripts/contato_alunos.php?aluno=<? echo $res_turma['aluno']; ?>"><img src="../img/editar_contato.png" width="15" height="15" title="Editar informações de contato" /></a>
            
            
            
            
            
			<?
				$sql = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE aluno = '".$res_turma['aluno']."' AND tipo = 'Telefone'");
				 while($res = mysqli_fetch_array($sql)){
					 $contato = $res['contato'];
					 
				 $contato = str_replace(" ", "", $contato); 
				 $contato = str_replace(".", "", $contato);
				 $contato = str_replace("(", "", $contato); 
				 $contato = str_replace(")", "", $contato);
				 					 
					 echo "<a href='https://api.whatsapp.com/send/?phone=55$contato&text&app_absent=0' target='_blank'>$contato</a>";
					 
					 echo " / ";
				}
			?> 
            
 <a rel="superbox[iframe][390x400]" href="scripts/informar_busca_ativa_atividade_coordenacao.php?atividade=COORD.<? echo $nome; ?>&operador=<? echo $operador; ?>&professor=COORD.<? echo $nome; ?>&aluno=<? echo $res_turma['aluno']; ?>"><img src="../img/busca_ativa_celular.png" title="Informar busca ativa" alt="" width="20" height="20" border="0" /></a>

            </td>
          </tr>
          <? }}$verifica_aluno = 0; } ?>
          </tbody>
        </table>
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>