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
       <h5><strong>COMUNIDADE ATENDIDAS</strong></h5>
       <? if($_GET['k'] == ''){ ?>       
       <a href="?p=cadastrar_transportes&k=cad" class="btn btn-success" style="width:200px; margin:10px;"><strong>Cadastrar nova comunidade</strong></a>
       <? } ?>
       
       
       
       <? if($_GET['k'] == 'cad'){ ?>
	   <form name="" method="post" action="" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Digite o nome da comunidade" /> <input type="submit" name="cad" value="Cadastrar" />
       </form>
        
        <? if(isset($_POST['cad'])){
        
		 $nome = strtoupper($_POST['nome']);
		 if($nome == ''){
		 	echo "<script language='javascript'>window.alert('Digite o nome da rota!');</script>";
		 }else{
			 
			 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM rotas_escolares WHERE rota = '$nome'");
			 if(mysqli_num_rows($sql_verifica)>=1){
				echo "<script language='javascript'>window.alert('Rota já cadastrada!');</script>";
			 }else{
				 $code_rota = rand();
				 mysqli_query($conexao_bd, "INSERT INTO rotas_escolares (code, rota) VALUES ('$code_rota', '$nome')");
					echo "<script language='javascript'>window.alert('Rota cadastrada com sucesso!');window.location='';</script>";
			 }
		 }
	   }?>
       
       
       <? } ?>
	
    	<br /><br />
        <table class="table table-striped" width="800" border="1">
          <tr>
            <td width="94"><strong>COD.</strong></td>
            <td width="182"><strong>COMUNIDADE</strong></td>
            <td width="173"><strong>ROTA</strong></td>
            <td width="293"><strong>QUANT. ALUNOS</strong></td>
            <td width="24"><img src="img/impressora2.png" width="25" height="25" /></td>
          </tr>
          <?
           $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM rotas_escolares");
		   while($res = mysqli_fetch_array($sql_verifica)){
		  ?>
          <tr>
            <td><? echo $res['code']; ?></td>
            <td><? echo $res['rota']; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><img src="img/deleta.jpg" width="20" height="20" /></td>
          </tr>
          <? } ?>
        </table>


      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>