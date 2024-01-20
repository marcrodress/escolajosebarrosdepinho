<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
#container_tuod{
	background:#FFF;
}
</style>
</head>

<body>
<div class="container_tuod"> <? $turma = $_GET['turma']; $atividade = $_GET['atividade']; ?>
    <div class="container">
      <div class="row">
        <div class="col-sm">
		<a style="margin:5px 0 0 0;" href="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&mes=02" class="btn btn-info">Voltar</a>
        
  		<?
		 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '".$_GET['atividade']."'");
		  while($res_atividade = mysqli_fetch_array($sql_atividades)){
				   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_atividade['turma']."'");
	         		while($res_turma = mysqli_fetch_array($sql_turma)){
			  
		?>
        <p class="h5 text-primary"><strong>Atividades online</strong></p>
        <div class="alert alert-primary" role="alert"><strong>Objetivo:</strong> <? echo $res_atividade['objetivo'] ?>
        <hr />
        </div>
        <strong>SÉRIE:</strong> <? echo $res_turma['code_serie'] ?>° ANO - <strong>TURMA:</strong> <? echo $res_turma['tipo_turma'] ?><strong> - TURNO:</strong> <? echo $res_turma['turno'] ?><strong> - COMPONENTE:</strong> <? echo $res_turma['componente'] ?>
        </div>
        <? }} ?>
        
        <table class="table table-striped table-hover">
           <thead>
            <tr>
              <th scope="col">STATUS</th>
              <th scope="col">N° CHAMADA</th>
              <th scope="col">NOME</th>
              <th scope="col">ENTREGA</th>
              <th scope="col">NOTA</th>
              <th scope="col">ACERTO</th>
              <th scope="col">ERRO</th>
              <th scope="col">% APROV</th>
              <th scope="col" align="center"><a target="_blank" href="pdf/relatorio_multipla_escolha.php?turma=<? echo $_GET['turma'] ?>&atividade=<? echo $_GET['atividade'] ?>"><img src="img/impressora.jfif" width="25" height="25" border="0" /></a></th>
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
              <td>
			  <?
				$sql_questoes = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE aluno = '".$res_alunos['code_aluno']."' AND atividade = '".$_GET['atividade']."'");
			   if(mysqli_num_rows($sql_data) >= 1){      
			  ?>            
                <script language=javascript>
				function confirmafcao(){
				 if (confirm("Se confirmar, o aluno poderá fazer a avaliação novamente. Deseja continuar?"))
				  window.location='?p=fazer_correcao_multiplica&turma=<? echo $_GET['turma']; ?>&acao=excluir&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>';
				}
				</script>
              
                <a onclick="return confirmafcao();" href="?p=fazer_correcao_multiplica&turma=<? echo $_GET['turma']; ?>&acao=excluir&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="20" height="20" border="0" title="Excluir" /></a>


              <a rel="superbox[iframe][500x400]" href="scripts/mostrar_respostas.php?turma=<? echo $_GET['turma']; ?>&acao=confirmar&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>"><img src="img/olho.png" width="20" height="20" border="0" title="Confirmar entrega de atividade" /></a>
              <? } ?>              
              </td>
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

<? if(isset($_POST['nota'])){

$code_aluno = @$_POST['code_aluno'];
$nota = @$_POST['nota'];
if($nota >= 0 && $nota <= 10){

mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET nota = '$nota', status = 'CORRIGIDO' WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '$code_aluno'");
echo "<script language='javascript'>window.alert('Informação registrada com sucesso!');</script>";
 }else{
echo "<script language='javascript'>window.alert('A nota da atividade deve está no intervalo de 0 a 10!');</script>"; 
 }
}?>



<? if(@$_GET['acao'] == 'confirmar'){


$turma = $_GET['turma'];
$tipo_envio = $_GET['tipo_envio'];
$atividade = $_GET['atividade'];
$code_aluno = $_GET['aluno'];

$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$atividade' AND code_aluno = '$code_aluno'");
if(mysqli_num_rows($sql_atividade) == ''){
mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '', '$code_aluno', '$atividade', '10')");
echo "<script language='javascript'>window.alert('Informação registrada!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=$tipo_envio&atividade=$atividade';</script>";

}else{

mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET status = 'CORRIGIDO', nota = '10' WHERE code_atividade = '$atividade' AND code_aluno = '$code_aluno'");
echo "<script language='javascript'>window.alert('Informação registrada!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=$tipo_envio&atividade=$atividade';</script>";
	
}


}?>






<? if(@$_GET['acao'] == 'excluir'){

$code_atividade = $_GET['atividade'];
$code_aluno = $_GET['aluno'];

mysqli_query($conexao_bd, "DELETE FROM questoes_atividades_alunos WHERE atividade = '$code_atividade' AND aluno = '$code_aluno'");

$turma = $_GET['turma'];
$tipo_envio = $_GET['tipo_envio'];
$atividade = $_GET['atividade'];

echo "<script language='javascript'>window.alert('Informação excluída!');window.location='?p=fazer_correcao_multiplica&turma=$turma&tipo_envio=$tipo_envio&atividade=$atividade';</script>";

}?>