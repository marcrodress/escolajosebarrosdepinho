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
        <p class="h5 text-primary"><strong>Listar alunos</strong></p>
        <form method="post" enctype="multipart/form-data" class="form-inline">
          <div class="form-group mx-sm-3 mb-2" style="margin:0 0 0 -20px;">
            <input name="nome_aluno" type="input" class="form-control" id="inputPassword2" style="margin:0 0 0 -15px;" width="400" placeholder="Digire o nome do aluno">
          </div>
          <input name="enviar" type="submit" class="btn btn-primary mb-2" id="enviar" value="Buscar">
        </form>
        <? if(isset($_POST['enviar'])){
			$nome_aluno = $_POST['nome_aluno'];
			$sql = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE nome_aluno LIKE '%$nome_aluno%' OR code_aluno = '$nome_aluno'");
			if(mysqli_num_rows($sql) == ''){
				echo "<script language='javascript'>window.alert('Não foi encontrado nenhum aluno com as informações digitadas! $nome_aluno');</script>";
			}else{
			
		?>
         <table width="868" border="1" class="table table-bordered table-striped" style="border:1px solid #000;">
          <thead class="thead-light">
            <tr>
              <th width="227" scope="col">Nome do aluno</th>
              <th width="83" scope="col">CPF</th>
              <th width="34" scope="col">S&eacute;rie</th>
              <th width="41" scope="col">Turma</th>
              <th width="37" scope="col">Turno</th>
              <th width="48" scope="col">Sala</th>
              <th width="177" style="text-align: center; vertical-align: middle;" scope="col">Telefone</th>
              <th width="169" scope="col">A&ccedil;&otilde;es</th>
            </tr>
          </thead>
          <?
           while($res = mysqli_fetch_array($sql)){
		  ?>
          <tr style="font:10px Arial, Helvetica, sans-serif;" scope="row">
            <td style="text-align: left; vertical-align: middle;"><? echo strtoupper($res['nome_aluno']); ?></td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res['cpf']; ?></td>
            
            <? 
			 $sql_turmas_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res['code_aluno']."' AND status = 'Ativo' LIMIT 1");
			 while($res_turmas_alunos = mysqli_fetch_array($sql_turmas_alunos)){

			 $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_turmas_alunos['turma']."'");
			 while($res_turmas = mysqli_fetch_array($sql_turmas)){
			?>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_turmas['code_serie']; ?>° ano</td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_turmas['tipo_turma']; ?></td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_turmas['turno']; ?></td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_turmas['sala']; ?></td>
            <? }} ?>
            
            <td style="text-align: center; vertical-align: middle;"><? 
				
			
				$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE aluno = '".$res['code_aluno']."' AND tipo = 'Telefone'");
				 while($res_verifica = mysqli_fetch_array($sql_verifica)){
					 $contato = $res_verifica['contato'];
					 
                     $contato = str_replace(" ", "", $contato); 
                     $contato = str_replace(".", "", $contato);
                     $contato = str_replace("(", "", $contato); 
                     $contato = str_replace(")", "", $contato);
                                         
                         echo "<a href='https://api.whatsapp.com/send/?phone=55$contato&text&app_absent=0' target='_blank'>$contato</a>";
                         
                         echo " / ";					 
					 
				}
			
			
			 ?></td>
<td style="text-align: center; vertical-align: middle;">

              <a href="scripts/justificar_falta.php?aluno=<? echo $res['code_aluno']; ?>&operador=<? echo $operador; ?>" rel="superbox[iframe][800x400]"><img src="../img/justificar.png" width="20" title="Faltas justificadas" height="20" border="0" /></a>



              <a rel="superbox[iframe][400x250]" href="scripts/contato_alunos.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/busca_ativa_celular.png" width="20" height="20" border="0"  title="Dados de contato"/></a>
              
              <a rel="superbox[iframe][1050x400]" href="scripts/informacao_vacinacao_aluno.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/vacinacao.png" width="20" height="20" border="0" title="Informações de vacinação" /></a>
              
              
              <a rel="superbox[iframe][670x400]" href="scripts/documentacao_aluno.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/documentos.png" width="20" height="20" border="0" title="Upload Documentos" /></a>
              
              
              <a rel="superbox[iframe][420x200]" href="scripts/controla_acesso_aluno.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/logo.png" width="20" height="20" border="0" title="Controle de acesso" /></a>
              
              
              <a href="?p=cadastrar_aluno&etapa=2&code=<? echo $res['nome_aluno']; ?>&code_aluno=<? echo $res['code_aluno']; ?>"><img src="../img/atualizar_cadastro.png" width="20" height="20" border="0" title="Atualizar cadastro" /></a>
              
              
              
              
               <a rel="superbox[iframe][750x400]" href="scripts/matricular_turma.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/turma.png" width="30" height="20" border="0" title="Matricular aluno" /></a>
                             
              <!-- <a href=""><img src="../img/ficha_cadastral.png" width="20" height="20" border="0" title="Ficha cadastral e desempenho do aluno" /></a> -->
            </td>
          </tr>
          <? } ?>
        </table>        
		
		<? }}?>
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
