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
        <form class="form-inline">
          <div class="form-group mx-sm-3 mb-2" style="margin:0 0 0 -20px;">
            <input style="margin:0 0 0 -15px;" type="input" width="400" class="form-control" id="inputPassword2" placeholder="Digire o nome do aluno">
          </div>
          <input type="submit" class="btn btn-primary mb-2" value="Buscar">
        </form>
        <hr />
        
        <? $quantidade = 0;
		
		@$pag = $_GET['pag'];
	   
	   if($pag>0){
		   $pag = $pag;
	   }else{
		   $pag = 1;
	   }
	   
	   $quantidade = 10;
	   $inicio = ($pag*$quantidade)-$quantidade;  
		
		
		 $sql = mysqli_query($conexao_bd, "SELECT * FROM alunos LIMIT $inicio, $quantidade");
		 if(mysqli_num_rows($sql) == ''){
            echo "<div class='alert alert-info' role='alert'>Ainda não existe alunos cadastrados!</div>";
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
              <th width="102" scope="col">Telefone</th>
              <th width="244" scope="col">A&ccedil;&otilde;es</th>
            </tr>
          </thead>
          <?
           while($res = mysqli_fetch_array($sql)){
		  ?>
          <tr style="font:10px Arial, Helvetica, sans-serif;" scope="row">
            <td style="text-align: left; vertical-align: middle;"><? echo strtoupper($res['nome_aluno']); ?></td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res['cpf']; ?></td>
            
            <?
			 $sql_turmas_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res['code_aluno']."' ORDER BY id DESC LIMIT 1");
			 while($res_turmas_alunos = mysqli_fetch_array($sql_turmas_alunos)){

			 $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_turmas_alunos['turma']."'");
			 while($res_turmas = mysqli_fetch_array($sql_turmas)){
			?>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_turmas['code_serie']; ?>° ano</td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_turmas['tipo_turma']; ?></td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_turmas['turno']; ?></td>
            <td style="text-align: center; vertical-align: middle;"><? echo $res_turmas['sala']; ?></td>
            <? }} ?>
            
            <td style="text-align: center; vertical-align: middle;">&nbsp;</td>
            <td style="text-align: center; vertical-align: middle;">
              
              <a href="?p=mostra_colaboradores&cpf=<? echo $res['cpf']; ?>&acao=Excluido&pg=1"><img src="../img/deleta.png" width="20" height="20" border="0" title="Excluir cadastro" /></a>
              
              <? if($res['status'] == 'Inativo'){ ?>
              <a href="?p=mostra_colaboradores?aluno=<? echo $res['code_aluno']; ?>&acao=Ativo&pg=1"><img src="../img/ativar.png" width="20" height="20" border="0" title="Ativar cadastro" /></a>
              <? } ?>
              <? if($res['status'] == 'Ativo'){ ?>
              <a href="?p=mostra_colaboradores&aluno=<? echo $res['code_aluno']; ?>&acao=Inativo&pg=1"><img src="../img/pausa.png" width="20" height="20" border="0" title="Inativar cadastro" /></a>
              <? } ?>
              
              
              <a rel="superbox[iframe][400x250]" href="scripts/contato_alunos.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/busca_ativa_celular.png" width="20" height="20" border="0"  title="Dados de contato"/></a>
              
              <a rel="superbox[iframe][1050x400]" href="scripts/informacao_vacinacao.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/vacinacao.png" width="20" height="20" border="0" title="Informações de vacinação" /></a>
              
              
              <a rel="superbox[iframe][670x400]" href="scripts/documentacao.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/documentos.png" width="20" height="20" border="0" title="Upload Documentos" /></a>
              
              
              <a rel="superbox[iframe][420x200]" href="scripts/controla_acesso.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/logo.png" width="20" height="20" border="0" title="Controle de acesso" /></a>
              
              
              <a href="?p=cadastrar_aluno&etapa=2&code=<? echo $res['nome_aluno']; ?>&code_aluno=<? echo $res['code_aluno']; ?>"><img src="../img/atualizar_cadastro.png" width="20" height="20" border="0" title="Atualizar cadastro" /></a>
              
              
              
              
               <a rel="superbox[iframe][750x400]" href="scripts/matricular_turma.php?aluno=<? echo $res['code_aluno']; ?>"><img src="../img/turma.png" width="30" height="20" border="0" title="Matricular aluno" /></a>
                             
              <a href=""><img src="../img/ficha_cadastral.png" width="20" height="20" border="0" title="Ficha cadastral e desempenho do aluno" /></a>
            </td>
          </tr>
          <? } ?>
        </table>
        <? } ?>
                
        <?
        $sql_2 = mysqli_query($conexao_bd, "SELECT * FROM alunos");
        $conta = mysqli_num_rows($sql_2);
        
        $paginas = ceil($conta/$quantidade);
        $links = 6;
        ?>
        
        <a class='btn btn-info' href="?p=listar_alunos&pag=1">Primeira página</a> 
        
        <?
        
        for($i = $pag-$links; $i <=-1; $i++){
                    if($i<=0){
                        }else{
                            echo "<a class='btn btn-info' href='?p=listar_alunos&pag=".$i."'>".$i."</a> ";	
                    }
        }
        echo "<a class='btn btn-info'>$pag</a> ";
        
        for($i = $pag+1; $i <= $pag+$links; $i++){
                if($i>$paginas){
                }else{
                            echo "<a class='btn btn-info' href='?p=listar_alunos&pag=".$i."'&p=listar_alunos>".$i."</a> ";	
                
       			 }
        }
        ?>
        <a class='btn btn-info' href="?p=listar_alunos&pag=<? echo $paginas; ?>">Última página</a>
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>

<? if(@$_GET['pg'] == '1'){

$cpf = $_GET['cpf'];
$acao = $_GET['acao'];

mysqli_query($conexao_bd, "UPDATE coladorares SET status = '$acao' WHERE cpf = '$cpf'");
mysqli_query($conexao_bd, "UPDATE acesso_sistema SET status = '$acao' WHERE cpf = '$cpf'");

echo "<script language='javascript'>window.location='?p=mostra_colaboradores';</script>";

}?>