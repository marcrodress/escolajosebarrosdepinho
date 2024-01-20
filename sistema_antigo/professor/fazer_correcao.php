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
		<a style="margin:5px 0 0 0;" href="?p=mostrar_atividades_turma&turma=<? echo $_GET['turma']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>" class="btn btn-info">Voltar</a>
        <?
		$id_atividade = 0;
		 $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '".$_GET['atividade']."'");
		  while($res_atividade = mysqli_fetch_array($sql_atividades)){
				
				$id_atividade = $res_atividade['id'];
				
				   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_atividade['turma']."'");
	         		while($res_turma = mysqli_fetch_array($sql_turma)){
			  
		?>
        <p class="h5 text-primary"><strong>Atividades online</strong></p>
        <div class="alert alert-primary" role="alert"<strong>Objetivo:</strong> <? echo $res_atividade['objetivo'] ?>
        </div>
        <strong>SÉRIE:</strong> <? echo $res_turma['code_serie'] ?>° ANO - <strong>TURMA:</strong> <? echo $res_turma['tipo_turma'] ?><strong> - TURNO:</strong> <? echo $res_turma['turno'] ?><strong> - COMPONENTE:</strong> <? echo $res_turma['componente'] ?>
        </div>
        <? }} ?>
        
        <table class="table table-striped table-hover">
           <thead>
            <tr>
              <th scope="col">STATUS</th>
              <th scope="col">N°</th>
              <th scope="col">NOME</th>
              <th scope="col">ENTREGA</th>
              <th scope="col">NOTA</th>
              <th scope="col">TRABALHO</th>
              <th scope="col">
                
                <a href="?p=fazer_correcao&acao=frequencia&turma=<? echo $_GET['turma']; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>&atividade=<? echo $_GET['atividade']; ?>" onclick="return confirm('Tem certeza que deseja aplicar frequência a todos os alunos nesta atividade?');"><img src="img/corretos.png" width="25" height="25" border="0" title="Aplicar frequência a todos os alunos" /></a>
                
                <a href="?p=fazer_correcao&acao=frequencia_excluir&turma=<? echo $_GET['turma']; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&componente=<? echo $_GET['componente']; ?>&mes=<? echo $_GET['mes']; ?>&atividade=<? echo $_GET['atividade']; ?>" onclick="return confirm('Todas as frequências e atividades enviadas serão excluídas. Deseja continuar?');"> <img src="img/errado.png" width="25" height="25" border="0" title="Apagar a frequência a todos os alunos" /></a>
                
                
                
                
                
                
              <a target="_blank" href="pdf/relatorio_enviado.php?turma=<? echo $_GET['turma'] ?>&atividade=<? echo $_GET['atividade'] ?>"><img src="img/impressora.jfif" width="25" height="25" border="0" /></a></th>
             </tr>
          </thead>
          
          <tbody>
          <? $i = 0;
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  $aluno = 0;
		  $aluno = $res_alunos['code_aluno'];
		  $telefone = $res_alunos['telefone'];
		  
		  	 $telefone = str_replace(" ", "", $telefone); 
			 $telefone = str_replace(".", "", $telefone);
			 $telefone = str_replace("(", "", $telefone); 
			 $telefone = str_replace(")", "", $telefone);
		  
		  ?>
            <tr>
            
              <?
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."' AND data != ''");
			  ?>
              <th scope="row" <? $status_envio = 0; if(mysqli_num_rows($sql_data) == ''){ ?> bgcolor="#F7C6B9" <? } ?>><? 
			   if(mysqli_num_rows($sql_data) == ''){
			   	echo "<strong class='text-danger'>NÃO ENTREGUE</strong>";
			   }else{
				echo $status_envio = "ENTREGUE";
			   }
			   ?>
               </th>
              <th><? echo $res_alunos['n_chamada']; ?></th>
              <td><? echo $res_alunos['nome_aluno']; ?>
                  <? if($res_alunos['transferido'] == 'SIM'){ ?> <img src="../img/transferido.png" width="20" height="10" /> <? } ?>
                  <? if($res_alunos['suprido'] == 'SIM'){ ?> <img src="../img/suprido.png" width="20" height="10" /> <? } ?>
        		  <? if($res_alunos['impresso'] == 'SIM'){ ?> <img src="img/amarelo.png" width="20" height="10" /> <? } ?>
                  <? if($res_alunos['especial'] == 'SIM'){ ?> <img src="img/roxo.fw.png" width="20" height="10" /> <? } ?>
              
              </td>
              <td><?
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
			   while($res_data = mysqli_fetch_array($sql_data)){
				   if($res_data['data'] == ''){
			  ?>

              
				   <img src='img/olho_vizua.png' title='<?
                     
					 $sql_visualiza = mysqli_query($conexao_bd, "SELECT * FROM visualiza_atividade WHERE atividade = '$id_atividade' AND aluno = '".$res_alunos['code_aluno']."'");
					  while($res_visualiza = mysqli_fetch_array($sql_visualiza)){
						  echo $res_visualiza['data'];
						  echo "<-->";
					  }
				     
				   ?>' width='15' height='15'>
			  <?
				   }else{
				   echo $res_data['data'];
				   }
				   
			   }
			  ?>
                      <a rel="superbox[iframe][390x400]" href="scripts/informar_busca_ativa_atividade.php?atividade=<? echo $id_atividade; ?>&operador=<? echo $operador; ?>&professor=<? echo $usuario; ?>&componente=<? echo $_GET['componente']; ?>&aluno=<? echo $aluno; ?>"><img src="../img/busca_ativa_celular.png" width="20" height="20" border="0" title="Informar busca ativa" /></a>
              </td>
              <td>
			  <?
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
			   while($res_data = mysqli_fetch_array($sql_data)){              
			  ?>              
              <form name="" method="post" action="" enctype="multipart/form-data">
              <input style="border:1px solid #CCC; width:70px; text-align:center; border-radius:5px;" value="<? echo $res_data['nota']; ?>" name="nota" type="number" size="5" />
              <input type="hidden" name="turma" value="<? echo $_GET['turma']; ?>" />
              <input type="hidden" name="tipo_envio" value="<? echo $_GET['tipo_envio']; ?>" />
              <input type="hidden" name="atividade" value="<? echo $_GET['atividade']; ?>" />
              <input type="hidden" name="code_aluno" value="<? echo $res_alunos['code_aluno']; ?>" />
              </form>
              <? } ?>
              </td>
              <td>
			  <?
			  $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas_extras WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
			  while($res_data = mysqli_fetch_array($sql_data)){
				  $arquivo = $res_data['arquivo'];
				  if($arquivo != ''){
				  echo "<a target='_blank' href='arquivos/$arquivo'><img src='../img/baixar.png' width='15' height='15'></a> ";
				  }
			  }
			  ?>              
              </td>
              <td>
              
                <script language=javascript>
				function confirmafcao(){
				 if (confirm("Se você excluir esse envio os dados serão perdidos. Deseja continuar?"))
				  window.location='?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=excluir&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>';
				}
				</script>


			   <?
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
			   if(mysqli_num_rows($sql_data) >= 1){      
			   ?>              
                <a onclick="return confirmafcao();" href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=excluir&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="20" height="20" border="0" title="Excluir" /></a>
				<? } ?>




			  <?
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."' AND status = 'CORRIGIDO'");
			   if(mysqli_num_rows($sql_data) <= 0){      
			  ?>
              <a href="?p=fazer_correcao&turma=<? echo $_GET['turma']; ?>&acao=confirmar&aluno=<? echo $aluno; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&atividade=<? echo $_GET['atividade']; ?>">          
              <img src="img/CORRETO.png" width="25" height="25" border="0" title="Confirmar entrega de atividade" /></a>
              <? } ?>
              


              
              
              <? 
			  
			   $sql_data = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."'");
			   while($res_data = mysqli_fetch_array($sql_data)){			  
			  
			  if($res_data['arquivo'] == ''){ ?>
              <a rel="superbox[iframe][400x150]" href="scripts/enviar_atividade.php?atividade=<? echo $_GET['atividade']; ?>&aluno=<? echo $aluno; ?>"><img src="img/upload.png" width="25" height="25" border="0" /></a>
              <? }} ?>
              
           <a href="https://api.whatsapp.com/send/?phone=55<? echo $telefone ?>&text&app_absent=0" target="_blank"><img src="img/whatsapp.png" width="25" height="20" title="Entrar em contato com o aluno" border="0" /></a>
             </td>
            </tr>
          <? } ?>
          </tbody>
		</table>   
        
             
        </div><!-- col-sm -->
                <hr />
        <img src="img/amarelo.png" width="20" height="10" /><strong> Atividade impressa</strong>
        <img src="img/roxo.fw.png" width="20" height="10" /> <strong>Atendimento educacional especializado - AEE   </strong>   
        <img src="../img/transferido.png" width="20" height="10" /><strong>Aluno transferido</strong>        
        <img src="../img/suprido.png" width="20" height="10" /> <strong>Aluno suprido    </strong>  
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>

<? if(isset($_POST['nota'])){

$code_aluno = @$_POST['code_aluno'];
$nota = @$_POST['nota'];
if($nota >= 0 && $nota <= 10){
	
	mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$operador', 'CREDITO', '5', 'ALTERAÇÃO DE NOTA', '$data')");

mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET nota = '$nota', status = 'CORRIGIDO' WHERE code_atividade = '".$_GET['atividade']."' AND code_aluno = '$code_aluno'");
echo "<script language='javascript'>window.alert('Informação registrada com sucesso!');window.location='';</script>";
 }else{
echo "<script language='javascript'>window.alert('A nota da atividade deve está no intervalo de 0 a 10!');</script>"; 
 }

	mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, CORRIGIU AS INSFORMAÇÕES DE NOTA DA $code_atividade DA ALUNA $code_aluno', '$operador')");
 
 
}?>



<? if(@$_GET['acao'] == 'confirmar'){


$turma = $_GET['turma'];
$tipo_envio = $_GET['tipo_envio'];
$atividade = $_GET['atividade'];
$code_aluno = $_GET['aluno'];

mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$operador', 'CREDITO', '5', 'CONFIRMAÇÃO DE ATIVIDADE', '$data')");


$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$atividade' AND code_aluno = '$code_aluno'");
if(mysqli_num_rows($sql_atividade) == ''){
mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '', '$code_aluno', '$atividade', '10')");
echo "<script language='javascript'>window.alert('Informação registrada!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=$tipo_envio&atividade=$atividade';</script>";

}else{

mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET status = 'CORRIGIDO', data = '$data', nota = '10' WHERE code_atividade = '$atividade' AND code_aluno = '$code_aluno'");
echo "<script language='javascript'>window.alert('Informação registrada!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=$tipo_envio&atividade=$atividade';</script>";
	
}

	mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, CORRIGIU AS INSFORMAÇÕES DA ATIVIDADE $code_atividade DA ALUNA $code_aluno', '$operador')");



}?>






<? if(@$_GET['acao'] == 'excluir'){

$code_atividade = $_GET['atividade'];
$code_aluno = $_GET['aluno'];

mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas WHERE code_atividade = '$code_atividade' AND code_aluno = '$code_aluno'");

	mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, EXCLUIU AS INSFORMAÇÕES DA ATIVIDADE $code_atividade DA ALUNA $code_aluno', '$operador')");

mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$operador', 'CREDITO', '5', 'EXCLUSÃO DE ATIVIDADE', '$data')");

$turma = $_GET['turma'];
$tipo_envio = $_GET['tipo_envio'];
$atividade = $_GET['atividade'];

echo "<script language='javascript'>window.alert('Informação excluída!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=$tipo_envio&atividade=$atividade';</script>";

}?>




<? if(@$_GET['acao'] == 'frequencia'){


$turma = $_GET['turma'];
$tipo_envio = $_GET['tipo_envio'];
$atividade = $_GET['atividade'];

$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma' AND transferido != 'SIM'");
  while($res_alunos = mysqli_fetch_array($sql_alunos)){
 	
	$sql_atividade_enviada = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['code_aluno']."' AND code_atividade = '$atividade'");
	if(mysqli_num_rows($sql_atividade_enviada) == ''){
		mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '', '".$res_alunos['code_aluno']."', '$atividade', '10')");
	}

 }


$turma = $_GET['turma'];
$tipo_envio = $_GET['tipo_envio'];
$atividade = $_GET['atividade'];

echo "<script language='javascript'>window.alert('Informação registrada!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=$tipo_envio&atividade=$atividade';</script>";


}?>




<? if(@$_GET['acao'] == 'frequencia_excluir'){


$turma = $_GET['turma'];
$tipo_envio = $_GET['tipo_envio'];
$atividade = $_GET['atividade'];

 	
	$sql_atividade_enviada = mysqli_query($conexao_bd, "DELETE FROM atividades_enviadas WHERE code_atividade = '$atividade'");


echo "<script language='javascript'>window.alert('Informação registrada!');window.location='?p=fazer_correcao&turma=$turma&tipo_envio=$tipo_envio&atividade=$atividade';</script>";


}?>