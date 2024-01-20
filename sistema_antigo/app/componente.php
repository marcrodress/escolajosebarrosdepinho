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
      <strong style="color:#069;"><strong>Participação geral: </strong><?
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
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=08">Agosto</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=09">Setembro</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=10">Outubro</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=11">Novembro</option>
		    <option value="?p=atividade&componente=<? echo $_GET['componente']; ?>&mes=12">Dezembro</option>
        </select>
        <strong style="color:#060; margin:0 0 0 2px;"><strong>Mês:  </strong>
        <?
         
		 if($_GET['mes'] == '08'){
			 echo "Agosto";
		 }elseif($_GET['mes'] == '08'){
			 echo "Setembro";
		 }elseif($_GET['mes'] == '08'){
			 echo "Outubro";
		 }elseif($_GET['mes'] == '08'){
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
           <strong style="color:#069; font:12px Arial, Helvetica, sans-serif;"><strong>3° Bimestre:</strong> -</strong>  
           | <strong style="color:#069; font:12px Arial, Helvetica, sans-serif;"><strong>4° Bimestre:</strong> -</strong>
  		</div><!-- col -->
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
          <th width="62" scope="col">Atividade</th>
          <th width="74" scope="col">Status</th>
          <th width="50" scope="col"></th>
        </tr>
      </thead>
      <tbody>
	  <? while($res_atividade = mysqli_fetch_array($sql_atividade)){ ?>
        <tr>
          <td><? echo $res_atividade['dia']; ?>/<? echo $res_atividade['mes']; ?>/<? echo $res_atividade['ano']; ?></td>
          <td>
          <?
		  $sql_busca_atividade = 0;
		  
		  if($res_atividade['tipo_envio'] == 'arquivo'){
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividade['code_atividade']."' AND code_aluno = '$aluno' AND data != ''");
		  }elseif($res_atividade['tipo_envio'] == 'varios'){
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividade['code_atividade']."' AND code_aluno = '$aluno' AND data != ''");
		  }else{
           $sql_busca_atividade = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividade['code_atividade']."' AND aluno = '$aluno'");
		  }
		   
		   
		   if(mysqli_num_rows($sql_busca_atividade) == ''){
           		echo "<img src='../professor/img/errado_atividade.png' width='25' height='25' />";
		   }else{
           		echo "<img src='../professor/img/correto_atividade.png' width='25' height='25' />";
		   } ?>          
          </td>
          <td>
          <?  if(mysqli_num_rows($sql_busca_atividade) == ''){ ?>
          <a href="../index.php?p=2&onde=app&turma=<? echo $_GET['turma']; ?>&ik=<? echo base64_encode($res_atividade['id']); ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $_GET['componente']; ?>" class="btn btn-danger">Entregar</a>
          <? }else{ ?>
          <a href="../index.php?p=2&onde=app&turma=<? echo $_GET['turma']; ?>&ik=<? echo base64_encode($res_atividade['id']); ?>&aluno=<? echo $aluno; ?>&disciplina=<? echo $_GET['componente']; ?>" class="btn btn-success">Verificar</a>          
          <? } ?>
          </td>
        </tr>
      <? } ?>
      </tbody>
    </table>
      <? } ?>

</div><!-- container -->
</body>
</html>