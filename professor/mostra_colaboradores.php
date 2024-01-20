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

<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm"><p></p>
        <p class="h5 text-primary"><strong>Colabodores</strong></p>
        <hr />
        
        <form name="" method="post" enctype="multipart/form-data">
        	<input style="padding:10px; margin:0 0 5px 0; font:Arial, Helvetica, sans-serif; font-size:15px; width:300px;" type="text" name="colaborador" placeholder="Digite o nome do colaborador" /> <input style="padding:10px; font:Arial, Helvetica, sans-serif; font-size:15px; width:100px;" type="submit" name="buscar" value="Buscar" />
        </form>
        
        <? if(isset($_POST['buscar'])){ $colaborador = $_POST['colaborador'];
		 $sql = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE status != 'Excluido' AND nome LIKE '%$colaborador%'");
		 if(mysqli_num_rows($sql) == ''){
            echo "<div class='alert alert-info' role='alert'>Ainda não existe colaboradores cadastrados!</div>";
		 }else{
		?>
        
         <table width="1000" border="1" class="table table-bordered table-striped" style="border:1px solid #000;">
          <thead class="thead-light">
            <tr>
              <th width="39" scope="col">Status</th>
              <th width="256" scope="col">Colaborador</th>
              <th width="119" scope="col">CPF</th>
              <th width="52" scope="col">Vinculo</th>
              <th width="43" scope="col">Cargo</th>
              <th width="121" scope="col">Telefone</th>
              <th width="324" scope="col">A&ccedil;&otilde;es</th>
            </tr>
          </thead>
          <?
           while($res = mysqli_fetch_array($sql)){
		  ?>
          <tr style="font:10px Arial, Helvetica, sans-serif;" scope="row">
            <td style="text-align: center; vertical-align: middle;"><? echo strtoupper($res['status']); ?></td>
            <td style="text-align: left; vertical-align: middle;"><? echo strtoupper($res['nome']); ?></td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res['cpf']; ?></td>
            <?
			  $sql_funcao = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_contratos WHERE cpf = '".$res['cpf']."' ORDER BY id DESC  LIMIT 1 ");
			   while($res_funcao = mysqli_fetch_array($sql_funcao)){
			?>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_funcao['vinculo']; ?></td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_funcao['cargo']; ?></td>
            <? } ?>
            <td style="text-align: center; vertical-align: middle;">
            <?
			  $sql_funcao = mysqli_query($conexao_bd, "SELECT * FROM contato_colaboradores WHERE cpf = '".$res['cpf']."' AND telefone != '' ORDER BY id DESC  LIMIT 1 ");
			   while($res_funcao = mysqli_fetch_array($sql_funcao)){
			    
				echo $res_funcao['telefone'];
			   
			   }
			?>
            </td>
            <td style="text-align: center; vertical-align: middle;">
              
              <a href="javascript:func()" onclick="confirmacao('<? echo $res['cpf']; ?>', 'Excluido')"><img src="../img/deleta.png" width="20" height="20" border="0" title="Excluir cadastro" /></a>
              
              <? if($res['status'] == 'Inativo'){ ?>
              <a href="javascript:func()" onclick="confirmacao('<? echo $res['cpf']; ?>', 'Ativo')"><img src="../img/ativar.png" width="20" height="20" border="0" title="Ativar cadastro" /></a>
              <? } ?>
              <? if($res['status'] == 'Ativo'){ ?>
              <a href="javascript:func()" onclick="confirmacao('<? echo $res['cpf']; ?>', 'Inativo')"><img src="../img/pausa.png" width="20" height="20" border="0" title="Inativar cadastro" /></a>
              <? } ?>
              
              
              <a rel="superbox[iframe][400x250]" href="scripts/contato_colaboradores.php?cpf=<? echo $res['cpf']; ?>"><img src="../img/busca_ativa_celular.png" width="20" height="20" border="0"  title="Dados de contato"/></a>
              
              <a rel="superbox[iframe][1050x400]" href="scripts/informacao_vacinacao.php?cpf=<? echo $res['cpf']; ?>"><img src="../img/vacinacao.png" width="20" height="20" border="0" title="Informações de vacinação" /></a>
              
              
              <a rel="superbox[iframe][670x400]" href="scripts/documentacao.php?cpf=<? echo $res['cpf']; ?>"><img src="../img/documentos.png" width="20" height="20" border="0" title="Upload Documentos" /></a>
              
              
              <a rel="superbox[iframe][420x200]" href="scripts/controla_acesso.php?cpf=<? echo $res['cpf']; ?>"><img src="../img/logo.png" width="20" height="20" border="0" title="Controle de acesso" /></a>
              
              
              <a href="?p=novocolaborador&etapa=2&cpf=<? echo $res['cpf']; ?>"><img src="../img/atualizar_cadastro.png" width="20" height="20" border="0" title="Atualizar cadastro" /></a>
              <a rel="superbox[iframe][900x550]" href="scripts/contratos_de_trabalho.php?cpf=<? echo $res['cpf']; ?>"><img src="../img/trabalho.png" width="20" height="20" border="0" title="Contratos de trabalho" /></a>
              <a rel="superbox[iframe][850x550]" href="scripts/assinatura_digital.php?cpf=<? echo $res['cpf']; ?>"><img src="../img/assinatura_digital.png" width="23" height="23" border="0" title="Assinatura digital" /></a>
              
              <a rel="superbox[iframe][1250x550]" href="scripts/escolaridade_colaboradores.php?cpf=<? echo $res['cpf']; ?>"><img src="../img/formatura.png" width="20" height="20" border="0" title="Informações de escolaridade" /></a>
              
              <img src="../img/ficha_cadastral.png" width="20" height="20" title="Ficha cadastral" />
            </td>
          </tr>
          <? } ?>
        </table>
        <? }} ?>
        
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>

<script>
	function confirmacao(cpf, acao) {
		var confirmacao = confirm("Deseja realmente executar essa ação?");
		if(confirmacao === true){
			 window.location.href = "?p=mostra_colaboradores&acao="+acao+"&pg=1&cpf=&cpf="+cpf;
		}
	}
	
</script>


<? if(@$_GET['pg'] == '1'){

$cpf = $_GET['cpf'];
$acao = $_GET['acao'];




mysqli_query($conexao_bd, "UPDATE coladorares SET status = '$acao' WHERE cpf = '$cpf'");
mysqli_query($conexao_bd, "UPDATE acesso_sistema SET status = '$acao' WHERE cpf = '$cpf'");

mysqli_query($conexao_bd, "INSERT INTO controle_acessos (colaborador, operador, data, ip, acao) VALUES ('$cpf', '$operador', '$data_completa', '$ip', '$acao')");


echo "<script language='javascript'>window.location='?p=mostra_colaboradores';</script>";

}?>