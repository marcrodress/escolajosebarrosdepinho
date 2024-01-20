<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/coordenadores.css" rel="stylesheet" type="text/css" />
<style>
body table{
	font:12px Arial, Helvetica, sans-serif;
	}
#container_tuod{
	background:#FFF;
	font:10px Arial, Helvetica, sans-serif;
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
      <div class="row">
        <div class="col-sm">
        <a style="margin:5px 0 0 0;" href="scripts/cadastrar_novo_recurso.php?operador=<? echo $operador; ?>" rel="superbox[iframe][340x230]" class="btn btn-success">Cadastrar novo recurso</a>
        <hr />
        </p>
          <form name="form" id="form">
            <select class="form-control" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
              <option>Selecione o recurso e a turma</option>
             <?
			  $sql_controle_livros_extra = mysqli_query($conexao_bd, "SELECT * FROM controle_recursos WHERE ano = '$ano' AND status = 'Ativo'");
			   while($res_livros_extra = mysqli_fetch_array($sql_controle_livros_extra)){
				
				  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_livros_extra['turma']."'");
				   while($res_turmas = mysqli_fetch_array($sql_turmas)){
			 ?>
              <option value="?p=outros_recursos&&livro=<? echo $res_livros_extra['code_livro']; ?>&turma=<? echo $res_turmas['code_turma']; ?>">RECURSO: <? echo strtoupper($res_livros_extra['nome_livro']); ?> - <? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; ?></option>
              <? }} ?>
            </select>
          </form>
         </p>
        <table width="1000" class="table">
        <thead class="thead-light">
            <tr>
              <th colspan="4" scope="col" align="center"><h5 align="center"><strong>
              
              <? $turma = $_GET['turma']; $livro = $_GET['livro']; $devolver = 0;
			  $sql_controle_livros_extra = mysqli_query($conexao_bd, "SELECT * FROM controle_recursos WHERE code_livro = '$livro'");
			   while($res_livros_extra = mysqli_fetch_array($sql_controle_livros_extra)){ $devolver = $res_livros_extra['devolver'];
				
				  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_livros_extra['turma']."'");
				   while($res_turmas = mysqli_fetch_array($sql_turmas)){
					   
			 
			  ?>

				<? echo strtoupper($res_livros_extra['nome_livro']); ?> - <? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno'];  ?>              
              </strong> 
              <a target="_blank" href="pdf/imprimir_relatorio_recurso.php?turma=<? echo $turma; ?>&livro=<? echo $livro; ?>"><img src="../img/impressora.png" alt="" width="25" height="25" border="0" align="right" style="padding:0; margin:0;" title="Imprimir relatório" /></a></h5>
              
              <? }} ?>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th width="18" scope="row">N&deg;</th>
              <td width="461"><strong>NOME DO ALUNO</strong></td>
              <td width="472" align="center"><strong>NOME DO LIVRO/COLE&Ccedil;&Atilde;O</strong></td>
              <td width="29"></td>
            </tr>
           <? $i = 0; 
		   $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma'");
		    while($res_1 = mysqli_fetch_array($sql_1)){ $i++;
			$aluno = $res_1['aluno'];
			$sql_2 = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_1['aluno']."'");
		    while($res_2 = mysqli_fetch_array($sql_2)){
		  ?>
          <form name="" method="post" action="" enctype="multipart/form-data">
          <input type="hidden" name="aluno" value="<? echo $res_1['aluno']; ?>" />
            <tr>
              <th scope="row"><? echo $res_1['n_chamada']; ?></th>
              <td><? echo $res_2['nome_aluno']; ?></td>
              
              <td align="center">
              <? $sql_recebido = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_recursos_aluno WHERE turma = '$turma' AND aluno = '$aluno' AND ano = '$ano' AND recebido = 'SIM'")); ?>
              <input name="recebido" type="checkbox" value="SIM" <? if($sql_recebido >= 1){ ?>checked="checked" <? } ?>/>
              Recebido 
			
            	
              <? if($devolver == 'SIM'){ ?>

              <? $sql_entregue = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_recursos_aluno WHERE turma = '$turma' AND aluno = '$aluno' AND ano = '$ano' AND entregue = 'SIM'")); ?>
              <input name="entregue" type="checkbox" value="SIM" <? if($sql_entregue >= 1){ ?>checked="checked" <? } ?>/>
             Entregue
             <? } ?>
             </td>
              
              <td align="center"><input type="submit" name="ok" id="button" value="ok" /></td>
            </tr>
          </form>
        <? }} ?>
        </table>
        
        <? if(isset($_POST['ok'])){
			
			$aluno = $_POST['aluno'];
			$recebido = $_POST['recebido'];
			$entregue = $_POST['entregue'];

			$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM controle_recursos_aluno WHERE turma = '$turma' AND aluno = '$aluno' AND ano = '$ano'");
			if(mysqli_num_rows($sql_verifica) == ''){
				
				mysqli_query($conexao_bd, "INSERT INTO controle_recursos_aluno (aluno, turma, livro, ano, entregue, recebido) VALUES ('$aluno', '$turma', '$livro', '$ano', '$entregue', '$recebido')");

			}else{
			$sql_verifica = mysqli_query($conexao_bd, "UPDATE controle_recursos_aluno SET entregue = '$entregue', recebido = '$recebido' WHERE aluno = '$aluno' AND turma = '$turma' AND ano = '$ano'");
			}
			echo "<script language='javascript'>window.location='';</script>";
			
        
		
		}?>
        
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
