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
<? mysqli_query($conexao_bd, "DELETE FROM turmas WHERE usuario = '$operador' AND code_escola = ''"); ?>

<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm">
        <a style="margin:5px 0 0 0;" href="scripts/cadastrar_componente.php?operador=<? echo $operador; ?>" rel="superbox[iframe][340x250]" class="btn btn-success">Cadastrar componente</a>
        <hr />
        <p class="h4 text-primary">Turmas cadastradas</p>
        <? if(@$_GET['acao'] == 'excluir'){
        
		echo "<div class='p-3 mb-2 bg-info text-white'>Turma excluída com sucesso! Aguarde..</div>";
		
		$turma = $_GET['turma'];
		
		mysqli_query($conexao_bd, "DELETE FROM turmas WHERE code_turma = '$turma'");
		
		?>
		
		  <script type="text/javascript">
              function redirectTime(){
                 window.location = "?p=turmas"
              }
           </script>
           <body onLoad="setTimeout('redirectTime()', 3000)">
		
		
		<? }?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">COD.</th>
              <th scope="col">Escola</th>
              <th scope="col">Série</th>
              <th scope="col">Turma</th>
              <th scope="col">Turno</th>
              <th scope="col">N° alunos</th>
              <th scope="col">Opções</th>
              <th scope="col"><a href="pdf/turmas.php?professor=<? echo $operador; ?>" target="_blank"><img src="img/impressora.jfif" alt="" width="23" height="23" border="0" title="Imprimir relatório" /></a></th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_escola = '$operador'");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['code_turma']; ?></td>
              <td><? 
				  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
				   while($res_escola = mysqli_fetch_array($sql_escola)){
					   echo strtoupper($res_escola['nome_escola']);
				   }
			  ?></td>
              <td><? echo $res['code_serie']; ?>° ano</td>
              <td><? echo $res['tipo_turma']; ?></td>
              <td><? echo $res['turno']; ?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['code_turma']."'"));?></td>
              <td colspan="2">

                  <a href="scripts/adicionar_aluno.php?turma=<? echo $res['code_turma']; ?>&operador=<? echo $operador; ?>" rel="superbox[iframe][340x170]"><img src="img/adicionar_aluno.png" title="Adicionar aluno a esta turma" width="20" height="20" border="0" title="Excluir" /></a>              

              
                <a href="excluir/turmas.php?id=<? echo $res['id']; ?>&turma=<? echo $_GET['turma']; ?>&mes=<? echo $_GET['mes']; ?>" rel="superbox[iframe][300x100]"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="20" height="20" border="0" title="Excluir" /></a>              

                <a rel="superbox[iframe][950x400]" href="scripts/disciplinas.php?turma=<? echo $res['code_turma']; ?>&acao=mostrar_disciplinas&operador=<? echo $operador; ?>"><img src="img/professor.png" width="25" height="20" border="0" title="Alocar professores" /></a>
                
                <a href="?p=anos&turma=<? echo $res['code_turma']; ?>&acao=mostrar_disciplinas&?operador=<? echo $operador; ?>"> <img src="img/verificar_alunos.jpg" width="25" height="25" border="0" title="Alocar professores" /></a>
              
              <a href="?p=mostrar_atividades_turma&turma=<? echo $res['code_turma']; ?>&mes=<? echo date("m"); ?>"><img src="img/atividades.png" width="25" height="25" border="0" title="Verificar atividades" /></a></td>
            </tr>



            <? if(@$_GET['acao'] == 'mostrar' && $_GET['turma'] == $res['code_turma']){ ?>

            
            <tr>
              <th colspan="10" align="center" bgcolor="#00CCFF" scope="row">HIST&Oacute;RICO DE ALUNOS DESSA TURMA</th>
            </tr>
            <tr>
              <th colspan="10" scope="row">
              <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th align="center" scope="col">N&deg;</th>
                  <th scope="col">Nome do aluno</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Frequência</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>
              <?
			   $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."'");
			   while($res_alunos = mysqli_fetch_array($sql_alunos)){
			  ?>
                <tr>
                  <th align="center" scope="row"><? echo $res_alunos['n_chamada']; ?></th>
                  <td><? echo $res_alunos['nome_aluno']; ?></td>
                  <td><? echo $res_alunos['telefone']; ?></td>
                  <td>
				  <?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE usuario = '$operador' AND turma = '".$res_alunos['turma']."'");
                   $total_atividades = mysqli_num_rows($sql_atividades);
                 
                   while($res_atividades = mysqli_fetch_array($sql_atividades)){
                       
                       if($res_atividades['tipo_envio'] == 'arquivo'){
                           $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."' AND data != ''");
                           if(mysqli_num_rows($enviados) >= 1){ $enviado++; }
                       }else{
                           $enviados = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['code_aluno']."'");
                           $total_questao = mysqli_num_rows($enviados);
                           if(mysqli_num_rows($enviados) >= 1){ $enviado++; }		   
                       }
                       
                  }
                        echo number_format(($enviado*100)/$total_atividades,1);
                  ?>                  
                  %</td>
                  <td>
               
                  <a href="excluir/aluno.php?id=<? echo $res_alunos['id']; ?>&turma=<? echo $_GET['turma']; ?>&mes=<? echo $_GET['mes']; ?>" rel="superbox[iframe][300x100]"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="20" height="20" border="0" title="Excluir" /></a>              

                <a href="scripts/cadastrar_aluno.php?aluno=<? echo $res_alunos['code_aluno']; ?>&operador=<? echo $operador ?>" rel="superbox[iframe][340x260]"> <img src="https://image.flaticon.com/icons/png/512/1159/1159633.png" width="20" height="20" border="0" title="Alterar nome" /></a>

                <a rel="superbox[iframe][200x100]" href="scripts/mes_boletim.php?aluno=<? echo $res_alunos['code_aluno']; ?>&turma=<? echo $res_alunos['turma']; ?>&operador=<? echo $operador ?>"><img src="img/boletim.png" width="20" height="20" border="0" title="Emitir boletim do aluno" /></a></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
                          </th>
            </tr>
           <? } ?>
            
            
         <? } ?>
        </table>
        
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
            
            
            <? if(@$_GET['acao'] == 'excluir_aluno'){
              $turma = $_GET['turma'];
			  mysqli_query($conexao_bd, "DELETE FROM alunos WHERE id = '".$_GET['id']."'");
			  
			  echo "<script language='javascript'>window.location='?p=turmas&turma=$turma&acao=mostrar';</script>";
			 
			}?>