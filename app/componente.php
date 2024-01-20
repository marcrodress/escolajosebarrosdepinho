<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body img{

}
</style>
</head>

<body>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<div class="container">
  <div class="row">
    <div class="col-sm">
     <div class="text-center" style="background:#0C9;">   
        <select class="form-control form-control-sm" name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
		    <option value="">Selecione o componente</option>
		    <option value="?p=atividade&componente=96461&mes=<? echo $_GET['mes']; ?>">Matemática</option>
		    <option value="?p=atividade&componente=96514&mes=<? echo $_GET['mes']; ?>">Português</option>
		    <option value="?p=atividade&componente=95616&mes=<? echo $_GET['mes']; ?>">Ciências</option>
		    <option value="?p=atividade&componente=99981&mes=<? echo $_GET['mes']; ?>">História</option>
		    <option value="?p=atividade&componente=390341&mes=<? echo $_GET['mes']; ?>">Geografia</option>
		    <option value="?p=atividade&componente=639811&mes=<? echo $_GET['mes']; ?>">Inglês</option>
		    <option value="?p=atividade&componente=74235&mes=<? echo $_GET['mes']; ?>">Ensino religioso</option>
		    <option value="?p=atividade&componente=9621345&mes=<? echo $_GET['mes']; ?>">Educação física</option>
		    <option value="?p=atividade&componente=36244&mes=<? echo $_GET['mes']; ?>">Artes</option>
        </select>
     </div><!-- text-center -->
     <h6 style="font:10px Arial, Helvetica, sans-serif;"><strong>PROFESSOR:</strong> 
     <?
	  $sql_professor_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE turma = '$turma' AND disciplina = '".$_GET['componente']."'");
	   while($res_professor_componente = mysqli_fetch_array($sql_professor_componente)){
		   $sql_acesso = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_professor_componente['professor']."'");
			 while($res_prof = mysqli_fetch_array($sql_acesso)){
				 $professor = $res_prof['cpf'];		   
				 
				 
				 $sql_contato_colaboradores = mysqli_query($conexao_bd, "SELECT * FROM contato_colaboradores WHERE cpf = '$professor' AND telefone != '' LIMIT 1");
				 
				 $sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '$professor'");
				 while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
					 $professor = $res_colaborador['nome'];
				 
				  while($res_contato = mysqli_fetch_array($sql_contato_colaboradores)){
							
							 $contato = $res_contato['telefone'];
							 $contato = str_replace(" ", "", $contato); 
							 $contato = str_replace(".", "", $contato);
							 $contato = str_replace("(", "", $contato); 
							 $contato = str_replace(")", "", $contato);
							 
			 }				 
		   }
		 }
	  }
	  
	  
	  
	 ?>
     <? echo $professor; ?> <a href='https://api.whatsapp.com/send/?phone=55<? echo $contato; ?>&text&app_absent=0' target='_blank'><img src="../professor/img/whatsapp.png" width="22" height="22" border="0" /></a></h6>
    </div><!-- col-sm -->
  </div><!-- row -->
  <hr />
    <div class="row">
    <div class="col-3">
    
    <? 
	 if($_GET['componente'] == '96461'){ 
     	echo "<img src='../img/matematica.png'  width='71' height='78' style='margin:0 10px 7px 0' />";
	 }elseif($_GET['componente'] == '96514'){
     	echo "<img src='../img/portugues.png'  width='71' height='78' style='margin:0 10px 7px 0' />";
	 }elseif($_GET['componente'] == '95616'){
     	echo "<img src='../img/ciencias.png'  width='71' height='78' style='margin:0 10px 7px 0' />";
	 }elseif($_GET['componente'] == '99981'){
     	echo "<img src='../img/historia.png'  width='71' height='78' style='margin:0 10px 7px 0' />";
	 }elseif($_GET['componente'] == '390341'){
     	echo "<img src='../img/geografia.png'  width='71' height='78' style='margin:0 10px 7px 0' />";
	 }elseif($_GET['componente'] == '639811'){
     	echo "<img src='../img/ingles.png'  width='71' height='78' style='margin:0 10px 7px 0' />";
	 }elseif($_GET['componente'] == '9621345'){
     	echo "<img src='../img/educacao_fisica.png'  width='71' height='78' style='margin:0 10px 7px 0' />";
	 }elseif($_GET['componente'] == '36244'){
     	echo "<img src='../img/artes.png'  width='71' height='78' style='margin:0 10px 7px 0' />";
	 }elseif($_GET['componente'] == '74235'){
     	echo "<img src='../img/religiao.png'  width='71' height='78' style='margin:0 10px 7px 0' />";
	 }
	?>
     
    </div><!-- col-sm -->
    <div class="col" style="text-align:left;">
      <strong style="color:#069;"><strong>Participação: </strong><?
                   $enviado = 0; $nota = 0; $data_entrega = 0; $total_questao = 0; $certo = 0; $total_atividades = 0;
                   $sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND code_dia_atividade < '$code_hoje'");
				    while($res_atividade = mysqli_fetch_array($sql_atividades)){
						if($res_atividade['code_dia_atividade'] <= $code_hoje){
							$total_atividades++;
						}
					}
				
                       
                   $enviados = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$aluno' AND data != ''"));
				   
				   $percentual_frequencia = ($enviados*100)/$total_atividades;
				   if($percentual_frequencia > 100){
					   echo "100";
				   }else{
                       echo number_format($percentual_frequencia,1);
				   }
				
                  ?>%</strong>
      
        <select class="form-control" name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
		    <option value="">Selecione o mês</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=01">Janeiro</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=02">Fevereiro</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=03">Março</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=04">Abril</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=05">Maio</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=06">Junho</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=07">Julho</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=08">Agosto</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=09">Setembro</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=10">Outubro</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=11">Novembro</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=12">Dezembro</option>
        </select>
        <strong style="color:#060; margin:0 0 0 2px;"><strong>Mês:  </strong>
        <?
         
		 if($_GET['mes'] == '01'){
			 echo "Janeiro";
		 }elseif($_GET['mes'] == '02'){
			 echo "Janeiro";
		 }elseif($_GET['mes'] == '03'){
			 echo "Março";
		 }elseif($_GET['mes'] == '04'){
			 echo "Abril";
		 }elseif($_GET['mes'] == '05'){
			 echo "Maio";	
		 }elseif($_GET['mes'] == '06'){
			 echo "Junho";
		 }elseif($_GET['mes'] == '07'){
			 echo "Julho";			 			 
		 }elseif($_GET['mes'] == '08'){
			 echo "Agosto";
		 }elseif($_GET['mes'] == '09'){
			 echo "Setembro";
		 }elseif($_GET['mes'] == '10'){
			 echo "Outubro";
		 }elseif($_GET['mes'] == '11'){
			 echo "Novembro";
		 }else{
			 echo "Dezembro";
		 }
		
		?>
        </strong>
    </div><!-- coluna -->
    </div><!-- row -->

    <div class="row" style="text-align:center;">
        <div class="col">
           <strong style="color:#069; font:12px Arial, Helvetica, sans-serif;"><strong>1° Bim.:</strong> 
		   <? require "atualizar_nota.php";
		   $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '$turma' AND aluno = '$aluno' AND componente = '".$_GET['componente']."' AND bimestre = '1'");
		    
			while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				 $media1 = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
				
			}
			
			    if($media1 >= 6){
				   echo "$media1";
			   }else{
				   if($res_notas_bimestrais['re'] <= 0){
					echo "$media1";
				   }else{
				   echo number_format(($media1+$res_notas_bimestrais['re'])/2);
				   }
			   }
		   ?>,0</strong>  | 
           <strong style="color:#069; font:12px Arial, Helvetica, sans-serif;"><strong>2° Bim.: </strong><strong style="color:#069; font:12px Arial, Helvetica, sans-serif;">
           <? require "atualizar_nota.php";
		   $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '$turma' AND aluno = '$aluno' AND componente = '".$_GET['componente']."' AND bimestre = '2'");
		    
			while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				 $media2 = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
				
			}
			
			
			    if($media2 >= 6){
				   echo "$media2";
			   }else{
				   if($res_notas_bimestrais['re'] <= 0){
					echo "$media2";
				   }else{
				   echo number_format(($media2+$res_notas_bimestrais['re'])/2);
				   }
			   }
		   ?>
           ,0</strong> </strong> |  
           <strong style="color:#069; font:12px Arial, Helvetica, sans-serif;"><strong>3° Bim.: </strong><strong style="color:#069; font:12px Arial, Helvetica, sans-serif;">
           <? require "atualizar_nota.php";
		   $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '$turma' AND aluno = '$aluno' AND componente = '".$_GET['componente']."' AND bimestre = '3'");
		    
			while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				 $media3 = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3);
				
			}
			
			
			    if($media3 >= 6){
				   echo "$media3";
			   }else{
				   if($res_notas_bimestrais['re'] <= 0){
					echo "$media3";
				   }else{
				   echo number_format(($media3+$res_notas_bimestrais['re'])/2);
				   }
			   }
		   ?>
           ,0</strong> </strong> |
      <strong style="color:#069; font:12px Arial, Helvetica, sans-serif;"><strong>4° Bim.: </strong> </strong></div><!-- col -->
    </div><!-- row -->

      <?
	   $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE componente = '".$_GET['componente']."' AND turma = '$turma' AND mes = '".$_GET['mes']."' ORDER BY code_dia_atividade DESC");
	   if(mysqli_num_rows($sql_atividade) == ''){
		   echo "<div class='alert alert-danger' role='alert'>O professor não lançou atividade no mês selecionado!</div>";
	   }else{
	  ?>    
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="62" scope="col">Data</th>
          <th width="36" scope="col"><img src="https://cdn-icons-png.flaticon.com/512/82/82239.png" width="25" height="30" /></th>
          <th width="36" scope="col"><img src="https://xerfanconsultoria.com/wp-content/uploads/2021/08/evaluating.png" width="25" height="25" /></th>
          <th width="50" scope="col"></th>
        </tr>
      </thead>
      <tbody>
	  <? while($res_atividade = mysqli_fetch_array($sql_atividade)){ ?>
        <tr>
          <td><? echo $res_atividade['dia']; ?>/<? echo $res_atividade['mes']; ?>/<? echo $res_atividade['ano']; ?></td>
          <td><?
            $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividade['code_atividade']."' AND code_aluno = '$aluno' AND presente = 'SIM'");
			if(mysqli_num_rows($sql_busca_atividade) <=0){
				echo "<img src='../professor/img/errado_atividade.png' title='Faltou' width='25' height='25' />";
			 }else{
				echo "<img src='../professor/img/correto_atividade.png' title='Presente' width='25' height='25' />";				
			 } ?></td>
          <td><?
		  $sql_busca_atividade = 0;
		  
		  if($res_atividade['tipo_envio'] == 'arquivo'){
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividade['code_atividade']."' AND code_aluno = '$aluno' AND data != ''");
		  }elseif($res_atividade['tipo_envio'] == 'varios'){
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividade['code_atividade']."' AND code_aluno = '$aluno' AND data != ''");
		  }else{
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividade['code_atividade']."' AND aluno = '$aluno'");
		  }
		   
		   
		   if(mysqli_num_rows($sql_busca_atividade) == ''){
           		echo "<img src='../professor/img/errado_atividade.png' title='Atividade não realizada' width='25' height='25' />";
		   }else{
           		echo "<img src='../professor/img/correto_atividade.png' title='Atividade realziada' width='25' height='25' />";
		   }
		  ?></td>
          <td>
          <?  if(mysqli_num_rows($sql_busca_atividade) == ''){ ?>
			  <?
               $sqlPlanoAula = mysqli_query($conexao_bd, "SELECT * FROM plano_de_aula WHERE id_aula = '".$res_atividade['id']."' AND modalidade = 'ONLINE'");
               if(mysqli_num_rows($sqlPlanoAula)>=1){
              ?>
              <a href="../index.php?p=2&onde=app&turma=<? echo $turma; ?>&ik=<? echo base64_encode($res_atividade['id']); ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $_GET['componente']; ?>" class="btn btn-danger">Entregar</a>
              <? } ?>
          
		  <? }else{ if(mysqli_num_rows($sqlPlanoAula)>=1){  ?>
          <a href="../index.php?p=2&onde=app&turma=<? echo $turma; ?>&ik=<? echo base64_encode($res_atividade['id']); ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $_GET['componente']; ?>" class="btn btn-success">Verificar</a>          
          <? }} ?>
          </td>
        </tr>
      <? } ?>
      </tbody>
    </table>
      <? } ?>

</div><!-- container -->
</body>
</html>