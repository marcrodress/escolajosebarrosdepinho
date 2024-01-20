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
        </p>
          <form name="form" id="form">
            <select class="form-control" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
              <option>Selecione a turma</option>
             <?
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
			 ?>
              <option value="?p=entrega_livros&turma=<? echo $res_turmas['code_turma']; ?>"><? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; ?></option>
              <? } ?>
            </select>
          </form>
         </p>
        <table width="1000" class="table">
        <thead class="thead-light">
            <tr>
              <th colspan="11" scope="col" align="center"><h5 style="padding:0; margin:0;" align="center"><strong>CONTROLE DE LIVROS DID&Aacute;TICOS: 
			  
			  
			  <? 
			  $turma = $_GET['turma'];
			  $sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
			   while($res_turmas = mysqli_fetch_array($sql_turmas)){
              ?>
              			  
			  <? echo $res_turmas['code_serie']; ?>° ANO - TURMA: <? echo $res_turmas['tipo_turma']; ?> - TURNO: <? echo $res_turmas['turno']; } ?>
              
              </strong> 
              <a target="_blank" href="pdf/imprimir_relatorio_livro_didatico.php?turma=<? echo $turma; ?>"><img align="right" src="../img/impressora.png" alt="" width="25" height="25" title="Imprimir relatório" style="padding:0; margin:0;" /></a></h5></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th width="18" scope="row">N&deg;</th>
              <td width="350"><strong>NOME DO ALUNO</strong></td>
              <td align="center" width="80"><strong>PORTUGU&Ecirc;S</strong></td>
              <td align="center" width="85"><strong>MATEM&Aacute;TICA</strong></td>
              <td align="center" width="66"><strong>HIST&Oacute;RIA</strong></td>
              <td align="center" width="78"><strong>GEOGRAFIA</strong></td>
              <td align="center" width="66"><strong>CI&Ecirc;NCIAS</strong></td>
              <td align="center" width="55"><strong>INGL&Ecirc;S</strong></td>
              <td width="58" align="center"><strong>ARTES</strong></td>
              <td align="center" width="67"><strong>RELIGI&Atilde;O</strong></td>
              <td width="29"></td>
            </tr>
           <? $i = 0; 
		   $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM'");
		    while($res_1 = mysqli_fetch_array($sql_1)){ $i++;
			$aluno = $res_1['aluno'];
			$sql_2 = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_1['aluno']."'");
		    while($res_2 = mysqli_fetch_array($sql_2)){
		  ?>
          <form name="" method="post" action="" enctype="multipart/form-data">
          <input type="hidden" name="aluno" value="<? echo $res_1['aluno']; ?>" />
            <tr>
              <th scope="row"><? echo $res_1['n_chamada']; ?></th>
              <td><? echo strtoupper($res_2['nome_aluno']); ?></td>
              <td align="center">
              <?
               
			  $sql_p_96514 = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros WHERE p_96514 = 'SIM' AND turma = '$turma' AND aluno = '$aluno'"));	
			  ?>
              
              <input name="p_96514" type="checkbox" id="radio" title="Português" <? if($sql_p_96514 >= 1){ ?> checked="checked" <? } ?>value="SIM" /></td>
              
              <td align="center">
			  <?
			  $sql_m_96461 = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros WHERE m_96461 = 'SIM' AND turma = '$turma' AND aluno = '$aluno'"));	
			  ?>              
              
              <input type="checkbox" name="m_96461"  <? if($sql_m_96461 >= 1){ ?> checked="checked" <? } ?> value="SIM" title="Matemática" /></td>
              <td align="center">
			  <?
			  $sql_h_99981 = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros WHERE h_99981 = 'SIM' AND turma = '$turma' AND aluno = '$aluno'"));	
			  ?>               
              <input type="checkbox" name="h_99981"  <? if($sql_h_99981 >= 1){ ?> checked="checked" <? } ?> value="SIM" title="História" /></td>
              
              <td align="center">
			  <?
			  $sql_g_390341 = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros WHERE g_390341 = 'SIM' AND turma = '$turma' AND aluno = '$aluno'"));	
			  ?>              
              <input type="checkbox" name="g_390341" <? if($sql_g_390341 >= 1){ ?> checked="checked" <? } ?> value="SIM" title="Geografia" /></td>
              <td align="center">
			  <?
			  $sql_c_95616 = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros WHERE c_95616 = 'SIM' AND turma = '$turma' AND aluno = '$aluno'"));	
			  ?>                
              <input type="checkbox" name="c_95616" <? if($sql_c_95616 >= 1){ ?> checked="checked" <? } ?> value="SIM" title="Ciências" /></td>
              <td align="center">
			  <?
			  $sql_i_639811 = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros WHERE i_639811 = 'SIM' AND turma = '$turma' AND aluno = '$aluno'"));	
			  ?>               
              <input type="checkbox" name="i_639811" <? if($sql_i_639811 >= 1){ ?> checked="checked" <? } ?> value="SIM" title="Inglês" /></td>
              <td align="center">
                <?
			  $sql_a_36244 = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros WHERE a_36244 = 'SIM' AND turma = '$turma' AND aluno = '$aluno'"));	
			  ?>                
              <input type="checkbox" name="a_36244" <? if($sql_a_36244 >= 1){ ?> checked="checked" <? } ?> value="SIM" title="Artes" /></td>
              <td align="center">
			  <?
			  $sql_r_74235 = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros WHERE r_74235 = 'SIM' AND turma = '$turma' AND aluno = '$aluno'"));	
			  ?>                    
              <input type="checkbox" name="r_74235" <? if($sql_r_74235 >= 1){ ?> checked="checked" <? } ?> value="SIM" title="Regilião" /></td>
              <td align="center"><input type="submit" name="ok" id="button" value="ok" /></td>
            </tr>
          </form>
        <? }} ?>
        </table>
        
        <? if(isset($_POST['ok'])){
			
			$aluno = $_POST['aluno'];
			$p_96514 = $_POST['p_96514'];
			$m_96461 = $_POST['m_96461'];
			$h_99981 = $_POST['h_99981'];
			$g_390341 = $_POST['g_390341'];
			$c_95616 = $_POST['c_95616'];
			$i_639811 = $_POST['i_639811'];
			$ed_9621345 = $_POST['ed_9621345'];
			$a_36244 = $_POST['a_36244'];
			$r_74235 = $_POST['r_74235'];
			
			$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM controle_livros WHERE turma = '$turma' AND aluno = '$aluno'");
			if(mysqli_num_rows($sql_verifica) == ''){
				
				mysqli_query($conexao_bd, "INSERT INTO controle_livros (turma, aluno, observacao, p_96514, m_96461, h_99981, g_390341, c_95616, i_639811, ed_9621345, a_36244, r_74235) VALUES ('$turma', '$aluno', '', '$p_96514', '$m_96461', '$h_99981', '$g_390341', '$c_95616', '$i_639811', '$ed_9621345', '$a_36244', '$r_74235')");

			}else{
			$sql_verifica = mysqli_query($conexao_bd, "UPDATE controle_livros SET p_96514 = '$p_96514', m_96461 = '$m_96461', h_99981 = '$h_99981', g_390341 = '$g_390341', c_95616 = '$c_95616', i_639811 = '$i_639811', ed_9621345 = '$ed_9621345', a_36244 = '$a_36244', r_74235 = '$r_74235' WHERE aluno = '$aluno' AND turma = '$turma'");
			}
			echo "<script language='javascript'>window.location='';</script>";
			
        
		
		}?>
        
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
<? if(@$_GET['pg'] == 'excluir'){

mysqli_query($conexao_bd, "DELETE FROM professor WHERE escola = '$operador' AND professor = '".$_GET['professor']."'");
echo "<script language='javascript'>window.location='?p=professores';</script>";

}?>