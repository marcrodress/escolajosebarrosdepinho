<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Language" content="pt-br, en, fr, it">
<style>
#container_tuod{
	background:#FFF;
}
</style>
<?
mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$operador', 'CREDITO', '5', 'Acesso ao turmas', '$data')");
?>
</head>

<body>

<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm">
        <? if($tipo == ''){ ?>
        <a style="margin:5px 0 0 0;" href="scripts/cadastrar_turma.php?operador=<? echo $operador; ?>" rel="superbox[iframe][340x300]" class="btn btn-success">Cadastrar turma</a>
        <hr />
        <? } ?>
        <p class="h4 text-primary">Suas turmas</p>
        
        
        <?
		 $sql_verifica_tipo = mysqli_query($conexao_bd, "SELECT * FROM professor WHERE professor = '$operador' AND tipo = 'AEE'");
		 if(mysqli_num_rows($sql_verifica_tipo) >=1 ){
		?>	 


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
              <th scope="col">Laudo</th>
              <th scope="col">Impresso</th>
              <th scope="col">Rend%.</th>
              <th scope="col">Opções</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0; $nome_escola = 0; $componente = 0;
		   
				  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM turmas");
				   while($res_escola = mysqli_fetch_array($sql_escola)){ $i++;
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res_escola['code_escola']; ?></td>
              <td>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</td>
              <td><? echo $res_escola['code_serie']; ?>° ano</td>
              <td><? echo $res_escola['tipo_turma']; ?></td>
              <td><? echo $res_escola['turno']; ?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['turma']."'"));?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['turma']."' AND especial = 'SIM'"));?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['turma']."' AND impresso = 'SIM'"));?></td>
              <td >&nbsp;</td>
              <td>
                
                <a href="?p=turmas&turma=<? echo $res['turma']; ?>&componente=<? echo $res['disciplina']; ?>&acao=mostrar&?operador=<? echo $operador; ?>"> <img src="img/verificar_alunos.jpg" width="25" height="25" border="0" title="Verificar alunos" /></a>
                
                <a rel="superbox[iframe][200x100]" href="scripts/lancar_nota.php?aluno=<? echo $res_alunos['code_aluno']; ?>&turma=<? echo $res_alunos['turma']; ?>&componente=<? echo $res['disciplina']; ?>&p=1&operador=<? echo $operador ?>"><img src="../img/boletim_escolar.png" width="25" height="25" border="0" /></a>
                
                
              <a href="?p=lancar_frequencia&turma=<? echo $res_escola['code_turma']; ?>&mes=<? echo date("m"); ?>"><img src="img/atividades.png" width="25" height="25" border="0" title="Lançar frequência" /></a></td>
            </tr>
            
         <? } ?>
        </table>


		
		<? }else{ ?>
        
        <table class="table table-striped" style="font:12px Arial, Helvetica, sans-serif;">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">COD.</th>
              <th scope="col">Escola</th>
              <th scope="col">Componente</th>
              <th scope="col">Série</th>
              <th scope="col">Turma</th>
              <th scope="col">Turno</th>
              <th scope="col">N° alunos</th>
              <th scope="col">Laudo</th>
              <th scope="col">Impresso</th>
              <th scope="col">Rend%.</th>
              <th scope="col">Opções</th>
              <th scope="col"><a href="pdf/turmas_professor.php?professor=<? echo $operador; ?>" target="_blank"><img src="img/impressora.jfif" alt="" width="23" height="23" border="0" title="Imprimir relatório" /></a></th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0; $nome_escola = 0; $componente = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE professor = '$operador'");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		   
				  $sql_escola = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res['turma']."'");
				   while($res_escola = mysqli_fetch_array($sql_escola)){
					   
					   $sql_nome_escola = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res['escola']."'");
				   		while($res_nome_escola = mysqli_fetch_array($sql_nome_escola)){
							$nome_escola = $res_nome_escola['nome_escola'];
						}
						
					   $sql_nome_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['disciplina']."'");
				   		while($res_nome_componente = mysqli_fetch_array($sql_nome_componente)){
							$componente = $res_nome_componente['componente'];
						}
						
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['turma']; ?></td>
              <td><? echo $nome_escola; ?></td>
              <td><? echo $componente; ?></td>
              <td><? echo $res_escola['code_serie']; ?>° ano</td>
              <td><? echo $res_escola['tipo_turma']; ?></td>
              <td><? echo $res_escola['turno']; ?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['turma']."'"));?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['turma']."' AND especial = 'SIM'"));?></td>
              <td ><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['turma']."' AND impresso = 'SIM'"));?></td>
              <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$res['code_turma']."' AND transferido != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res['code_turma']."' AND componente = '".$res['disciplina']."' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			   $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			   echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>%</td>
              <td colspan="2">
                
                <a href="?p=turmas&turma=<? echo $res['turma']; ?>&componente=<? echo $res['disciplina']; ?>&acao=mostrar&?operador=<? echo $operador; ?>"> <img src="img/verificar_alunos.jpg" width="25" height="25" border="0" title="Verificar alunos" /></a>
                
                <a rel="superbox[iframe][200x100]" href="scripts/lancar_nota.php?turma=<? echo $res['turma']; ?>&componente=<? echo $res['disciplina']; ?>&p=1&operador=<? echo $operador ?>"><img src="../img/boletim_escolar.png" width="25" height="25" border="0" title="Lançar notas bimestrais" /></a>
                
                
              <a href="?p=mostrar_atividades_turma&turma=<? echo $res['turma']; ?>&componente=<? echo $res['disciplina']; ?>&mes=<? echo date("m"); ?>"><img src="img/atividades.png" width="25" height="25" border="0" title="Verificar atividades" /></a></td>
            </tr>
            <? if(@$_GET['acao'] == 'mostrar' && $_GET['turma'] == $res['turma']){ ?>

            
            <tr>
              <th colspan="13" align="center" bgcolor="#00CCFF" scope="row">HIST&Oacute;RICO DE ALUNOS DESSA TURMA</th>
            </tr>
            <tr>
              <th colspan="13" scope="row">
              <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th align="center" scope="col">N&deg;</th>
                  <th scope="col">Nome do aluno</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">3&deg; Bimestre</th>
                  <th scope="col">4&deg; Bimestre</th>
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
                  <td><? echo $res_alunos['nome_aluno']; ?>
                    <? if($res_alunos['transferido'] == 'SIM'){ ?>
                    <img src="../img/transferido.png" width="20" height="10" />
                    <? } ?>
                    <? if($res_alunos['suprido'] == 'SIM'){ ?>
                    <img src="../img/suprido.png" width="20" height="10" />
                    <? } ?>
                    <? if($res_alunos['impresso'] == 'SIM'){ ?>
                    <img src="img/amarelo.png" width="20" height="10" />
                    <? } ?>
                    <? if($res_alunos['especial'] == 'SIM'){ ?>
                    <img src="img/roxo.fw.png" width="20" height="10" />
                    <? } ?></td>
                  <td><? if($res_alunos['telefone'] != '' || $res_alunos['telefone2'] != ''){ ?>
                  
                 <?
				 $telefone = $res_alunos['telefone'];
				 $telefone = str_replace(" ", "", $telefone); 
				 $telefone = str_replace(".", "", $telefone);
				 $telefone = str_replace("(", "", $telefone); 
				 $telefone = str_replace(")", "", $telefone);
				 
				 $telefone2 = $res_alunos['telefone2'];
				 $telefone2 = str_replace(" ", "", $telefone2); 
				 $telefone2 = str_replace(".", "", $telefone2);
				 $telefone2 = str_replace("(", "", $telefone2); 
				 $telefone2 = str_replace(")", "", $telefone2);				 	
				 ?>
                  
                  
                    <a href="https://wa.me/55<? echo $telefone; ?>" title="Contato via WhatsApp" target="_blank"><? echo $res_alunos['telefone']; ?></a> / <a href="https://wa.me/55<? echo $telefone2; ?>" title="Contato via WhatsApp" target="_blank"><? echo $res_alunos['telefone2']; ?></a>
                    <? } ?>                    <a rel="superbox[iframe][390x400]" href="scripts/informar_busca_ativa_atividade.php?atividade=<? echo $id_atividade; ?>&operador=<? echo $operador; ?>&professor=<? echo $operador; ?>&componente=<? echo $componente; ?>&aluno=<? echo $res_alunos['code_aluno']; ?>"><img src="../img/busca_ativa_celular.png" width="20" height="20" border="0" title="Informar busca ativa" /></a>

                   </td>
                  <td align="center">
				  <?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$res_alunos['turma']."' AND componente = '".$_GET['componente']."'");
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
                  <td align="center">&nbsp;</td>
                  <td>
                    
                    <a rel="superbox[iframe][200x100]" href="scripts/mes_boletim.php?aluno=<? echo $res_alunos['code_aluno']; ?>&turma=<? echo $res_alunos['turma']; ?>&componente=<? echo $res['disciplina']; ?>&p=1&operador=<? echo $operador ?>"><img src="img/boletim.png" width="20" height="20" border="0" title="Emitir boletim do aluno" /></a></td>
                </tr>
              <? } ?>
              </tbody>
            </table>
                          </th>
            </tr>
           <? } ?>
            
            
         <? }} ?>
        </table>
        
        <? } // VERIFICA SE O PROFESSOR É DO AEE ?>
        
        
        <hr />
        <img src="img/amarelo.png" width="20" height="10" /> Atividade impressa
        <img src="img/roxo.fw.png" width="20" height="10" /> Atividade online
        
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