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

</head>

<body>
<?

if($_GET['nota'] == ''){ 

$componente = $_GET['componente'];
$turma = $_GET['turma'];
$bimestre = $_POST['bimestre'];
if($bimestre == ''){
	$bimestre = $_GET['bimestre'];
}else{
$bimestre = $_POST['bimestre'];
}


$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma'");
 while($res_alunos = mysqli_fetch_array($sql_alunos)){  $total_enviados = 0;
	 
	 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['code_aluno']."' AND turma = '$turma' AND componente = '$componente' AND bimestre = '$bimestre'");
	 
	 
	 if(mysqli_num_rows($sql_notas_bimestrais) == ''){
		 mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (turma, aluno, componente, bimestre, at, ap, ab, re) VALUES ('$turma', '".$res_alunos['code_aluno']."', '$componente', '$bimestre', '', '', '', '')");
		 
		 
	    $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre'");
		$total_atividades = mysqli_num_rows($sql_atividades);
		
            while($res_atividades = mysqli_fetch_array($sql_atividades)){
              $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."' AND data != ''");
			   if(mysqli_num_rows($enviados) != ''){
				   $total_enviados++;
			   }
			}
		

		$nota_at = number_format(($total_enviados*10)/$total_atividades);
		
		mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET at = '$nota_at' WHERE bimestre = '$bimestre' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '$componente'");	
		 
		 
		 
		 
		 
		 
	 }else{
	   

		
	    $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre'");
		$total_atividades = mysqli_num_rows($sql_atividades);
		
            while($res_atividades = mysqli_fetch_array($sql_atividades)){
              $enviados = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['code_aluno']."' AND data != ''");
			   if(mysqli_num_rows($enviados) != ''){
				   $total_enviados++;
			   }
			}
		

		$nota_at = number_format(($total_enviados*10)/$total_atividades);
		
		mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET at = '$nota_at' WHERE bimestre = '$bimestre' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '$componente'");	
	 
		 
		 
		 
	}
	 
	 
	
}




echo "<script language='javascript'>window.location='?p=lancar_nota&componente=$componente&turma=$turma&operador=$operador&bimestre=$bimestre&nota=1';</script>";

}

?>






<? if($_GET['nota'] != ''){ ?>
<div class="container_tuod"> <? $turma = $_GET['turma']; $componente = $_GET['componente']; ?>
  <div class="container">
    <div class="row">
      <div class="col-sm">
		<a style="margin:5px 0 20px 0;" href="?p=turmas" class="btn btn-info">Voltar</a>
        <?
			
				   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	         		while($res_turma = mysqli_fetch_array($sql_turma)){
			  
		?><br />
        <p class="h5 text-primary"><strong>Controle de notas do <? echo $_GET['bimestre']; ?>° Bimestre</strong></p>
        <strong>SÉRIE:</strong> <? echo $res_turma['code_serie'] ?>° ANO - <strong>TURMA:</strong> <? echo $res_turma['tipo_turma'] ?><strong> - TURNO:</strong> <? echo $res_turma['turno'] ?><strong> - COMPONENTE:</strong> <? 
		 
		 $sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
		
		 ?>
      </div>
      <? } ?>

     <a href="?p=lancar_nota&componente=<? echo $_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>&operador=<? echo $_GET['operador']; ?>&bimestre=<? echo $_GET['bimestre']; ?>&nota="><img style="margin:15px;" src="../img/atualizar.png" width="25" height="25" border="0" title="Atualizar notas" /></a>

      <table width="873" style="text-align:center;" class="table table-striped table-hover">
         <thead>
           <tr>
             <th width="68" scope="col">N°</th>
             <th width="412" style="text-align:left;" scope="col">NOME</th>
             <th width="46" align="center" scope="col">AT</th>
             <th width="39" align="center" scope="col">AP</th>
             <th width="36" align="center" scope="col">AB</th>
             <th width="45" align="center" scope="col">MP</th>
              <th width="42" align="center" scope="col">RE</th>
             <th width="35" align="center" scope="col">MB</th>
             <th width="71" align="center" scope="col">
             
             
             
             <a target="_blank" href="pdf/relatorio_enviado.php?turma=<? echo $_GET['turma'] ?>&amp;atividade=<? echo $_GET['atividade'] ?>"><img src="img/impressora.jfif" alt="" width="25" height="25" border="0" /></a></th>
           </tr>
        </thead>
          
        <tbody>
          <? $i = 0;
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  $aluno = 0;
		  ?>
          <tr>
            <th><? echo $res_alunos['n_chamada']; ?></th>
            <td  style="text-align:left;" ><? echo $res_alunos['nome_aluno']; ?>
            
                <? if($res_alunos['transferido'] == 'SIM'){ ?> <img src="../img/transferido.png" width="20" height="10" /> <? } ?>
                <? if($res_alunos['suprido'] == 'SIM'){ ?> <img src="../img/suprido.png" width="20" height="10" /> <? } ?>
       		    <? if($res_alunos['impresso'] == 'SIM'){ ?> <img src="img/amarelo.png" width="20" height="10" /> <? } ?>
                <? if($res_alunos['especial'] == 'SIM'){ ?> <img src="img/roxo.fw.png" width="20" height="10" /> <? } ?>
              
            </td>
            
            
            <form name="" method="post" action="" enctype="multipart/form-data">
            <?
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['code_aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '".$_GET['bimestre']."'");
			 
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				  
			?>
            <td><input style="border:1px solid #CCC; border-radius:5px; border:1px solid #CCC; text-align:center;" name="textfield" type="text" disabled="disabled" id="textfield" size="5" value="<? echo $res_notas_bimestrais['at']; ?>,0" /></td>
            <td>
            <input name="nota_ap" type="text" style="border:1px solid #CCC; border-radius:5px; border:1px solid #CCC; text-align:center;" size="5" maxlength="4" value="<? echo $res_notas_bimestrais['ap']; ?>" />
            </td>
            <td><input style="border:1px solid #CCC; border-radius:5px; border:1px solid #CCC; text-align:center;" name="nota_ab" type="text" id="textfield3" size="5" value="<? echo $res_notas_bimestrais['ab']; ?>" /></td>
            <td><? echo $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3); ?>,0</td>
            <td><? if($media < 6){ ?><input style="border:1px solid #CCC; border-radius:5px; border:1px solid #CCC; text-align:center;" name="nota_re" type="text" id="textfield4" size="5" value="<? echo $res_notas_bimestrais['re']; ?>" /><? } ?></td>
            <td>
             <?
               if($media >= 6){
				   echo "$media,0";
			   }else{
				   echo number_format(($media+$res_notas_bimestrais['re'])/2);echo ",0";
			   }
			   
			   
			 ?>
            </td>
            <td><input type="submit" name="alterar" value="" style="border:1px solid #CCC ; width:1px; height:1px; cursor:auto;" /></td>
          </tr>
		   <input type="hidden" name="aluno" value="<? echo $res_alunos['code_aluno']; ?>" />         
		   <input type="hidden" name="bimestre" value="<? echo $_GET['bimestre']; ?>" />         
		   <input type="hidden" name="componente" value="<? echo $_GET['componente']; ?>" />         
          </form>
          <? } ?>
          
          
          
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
<? } ?>
</body>
</html>
<? if(isset($_POST['alterar'])){

$aluno = $_POST['aluno'];
$bimestre = $_POST['bimestre'];
$componente = $_POST['componente'];
$nome_componente = 0;

$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '$componente'");
while($res_componente = mysqli_fetch_array($sql_componente)){
	$nome_componente = $res_componente['componente'];
}




$nota_ap = $_POST['nota_ap'];
$nota_ab = $_POST['nota_ab'];
$nota_re = $_POST['nota_re'];

$nota_ap = number_format(str_replace(",", ".", $nota_ap));
$nota_ab = number_format(str_replace(",", ".", $nota_ab));
$nota_re = number_format(str_replace(",", ".", $nota_re));

 


if($nota_ap < 0 || $nota_ap > 10){
	echo "<script language='javascript'>window.alert('A nota deve ser um número inteiro em um intervalo entre 0 e 10');</script>";
}elseif($nota_ab < 0 || $nota_ab > 10){
	echo "<script language='javascript'>window.alert('A nota deve ser um número inteiro em um intervalo entre 0 e 10');</script>";
}elseif($nota_re < 0 || $nota_re > 10){
	echo "<script language='javascript'>window.alert('A nota deve ser um número inteiro em um intervalo entre 0 e 10');</script>";
}else{

mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET ap = '$nota_ap', ab = '$nota_ab', re = '$nota_re' WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre'");



mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $operador, FEZ ALTERAÇÃO DE NOTAS REFERENTE AO $bimestre° BIMESTRE DO COMPONENTE $nome_componente, DISCENTE: $aluno', '$operador')");

mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$operador', 'CREDITO', '5', 'ALTERAÇÃO AO REGISTRO DE NOTAS BIMESTRAIS', '$data')");


 echo "<script language='javascript'>window.location='';</script>";

}
 
}?>
